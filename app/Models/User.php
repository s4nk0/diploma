<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Scout\Searchable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;
    use Searchable;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'phone_number',
        'email',
        'password',
        'gender_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function getEmailAttribute($value)
    {
        if (!strripos($value, '@')){
            return null;
        }

        return $value;
    }

    public function profileIsComplete(){

    }


    public function ad(){
        return $this->hasMany(Ad::class);
    }

    public function liked_ad(){
        return $this->belongsToMany(Ad::class,'user_ad_likes','user_id','ad_id');
    }

    public function liked_ad_gets(){
        return $this->belongsToMany(AdGet::class,'user_ad_get_likes','user_id','ad_get_id');
    }

    public function adGet(){
        return $this->hasMany(AdGet::class);
    }

    public function gender(){
        return $this->hasOne(Gender::class,'id','gender_id');
    }

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function hasRoles($roles){
        return count(array_intersect($roles,$this->roles->pluck('title')->toArray()));
    }

    public function toSearchableArray(): array
    {
        return [
            'name'=>$this->name,
            'phone_number'=>$this->phone_number,
            'email'=>$this->email,
        ];
    }
}
