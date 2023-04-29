<?php

namespace App\Http\Controllers\API;

use App\Enums\PhoneNumberEnum;
use App\Enums\PhoneVerificationsStatuses;
use App\Facades\SMS;
use App\Http\Controllers\Controller;
use App\Http\Requests\OTPVerifyCodeRequest;
use App\Models\PhoneVerification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function OTPSendCode(Request $request){
        $validatedData = $request->validate([
            'phone_number' => ['required','regex:'.PhoneNumberEnum::REGEX->value],
        ]);

        //проверка на время
        $phoneVerifications = PhoneVerification::where('phone_number',$validatedData)->where('status',PhoneVerificationsStatuses::PENDING->value)->get();

        $phoneVerifications->each(function ($phoneVerification) {
            if ($phoneVerification->created_at->diffInMinutes(Carbon::now()) > 1) {
                $phoneVerification->status = PhoneVerificationsStatuses::EXPIRED;
                $phoneVerification->save();
            }
        });

        $phoneVerificationsUpdated = PhoneVerification::where('phone_number',$validatedData)->where('status',PhoneVerificationsStatuses::PENDING->value)->get();
        if ($phoneVerificationsUpdated->count()){
            return response()->json([
                'success'=>false,
                'errors'=>[
                    'phone_number'=>[
                        'Мы уже отправили код'
                    ]
                ],
                'message'=>'Мы уже отправили код',
            ]);
        }

        $phoneVerification = PhoneVerification::create($validatedData);
        return  $phoneVerification->verification_code;
//        return SMS::sendCode($phoneVerification->phone_number,$phoneVerification->verification_code);
    }

    public function OTPVerifyCode(OTPVerifyCodeRequest $request){
        $user = User::where('phone_number',$request->phone_number)->first();
        PhoneVerification::where('phone_number',$request->phone_number)->update(['status'=>PhoneVerificationsStatuses::VERIFIED]);
        if (!$user){
            //если это новый юзер
            $user =  User::create([
                'phone_number' => $request->phone_number,
            ]);

            $user->roles()->attach(2);
        }
        return $this->login($user);
    }

    private function login($user){
        Auth::login($user);

        // Authentication passed...
        return response()->json([
            'success'=>true,
            'data'=>[
                'token'=>Auth::user()->createToken(Auth::user()->phone_number)->plainTextToken,
                'user'=>Auth::user(),
            ],
            'message'=>'User logged in',
        ]);
    }

    public function logout(Request $request)
    {
        if (Auth::guard('sanctum')->check()){
            $user = Auth::guard('sanctum')->user();
            $user->tokens()->find($request->bearerToken())->delete();

            return response()->json([
                'success'=>true,
                'message' => 'Success'
            ]);
        }

        return response()->json([
            'success'=>true,
            'message' => 'Вы уже вышли'
        ],Response::HTTP_ALREADY_REPORTED);
    }

    public function emailLogin(Request $request){
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken($user->email)->plainTextToken;
            return response()->json([
                'message' => 'Successfully logged in',
                'data'=>[
                    'token'=>$token,
                    'user'=>$user,
                ],
            ]);
        } else {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }

    public function emailRegister(Request $request, CreatesNewUsers $createsNewUsers)
    {
        $user = $createsNewUsers->create($request->all());
        $token = $user->createToken($user->email)->plainTextToken;

        return response()->json([
            'message' => 'Successfully registered',
            'data' => [
                'token'=>$token,
                'user'=>$user,
            ]
        ],Response::HTTP_CREATED);
    }

}
