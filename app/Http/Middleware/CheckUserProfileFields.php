<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserProfileFields
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Check if user is authenticated and has a profile
        if ($user) {
            // Check if all required fields are filled
            $requiredFields = ['name', 'email', 'gender_id'];
            foreach ($requiredFields as $field) {
                if (empty($user->{$field})) {
                    // Redirect user to complete profile
                    return redirect()->route('profile.show')
                        ->with('warning', 'Please fill out all fields in your profile information before continuing.');
                }
            }

            return $next($request);
        }
    }
}
