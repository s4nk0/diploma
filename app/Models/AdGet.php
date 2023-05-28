<?php

namespace App\Models;

use App\Traits\ElasticSearchable;
use App\Traits\withModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Laravel\Scout\Searchable;

class AdGet extends Model
{
    use HasFactory, SoftDeletes, Searchable, ElasticSearchable, withModelTrait;

    protected $fillable = [
        'rooms_count',
        'roommate_count',
        'user_id',
        'price',
        'city_id',
        'coordinates',
        'location',
        'animals',
        'ad_gender_type_id',
        'description',
        'contact_name',
        'phone_number',
        'contact_email',
        'price_from',
        'views',
        'status_moderation_id'
    ];

    protected $appends = [
        'createdAtDiffForHumans',
        'user_liked'
    ];

    public function getUserLikedAttribute(){

        if (Auth::check()){
            return (bool)$this->liked_users()->where('user_id', Auth::user()->id)->where('ad_get_id', $this->id)->first();
        }
        return false;
    }

    public function getCreatedAtDiffForHumansAttribute()
    {
        Carbon::setLocale('ru');
        $date = Carbon::parse($this->created_at);
        return  $date->diffForHumans();
    }

    public function status_moderation(){
        return $this->hasOne(StatusModeration::class,'id','status_moderation_id');
    }

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }

    public function liked_users(){
        return $this->belongsToMany(User::class,'user_ad_get_likes','ad_get_id','user_id');
    }

    public function gender_type(){
        return $this->hasOne(AdGenderType::class,'id','ad_gender_type_id');
    }

    public function toSearchableArray(): array
    {
        return [
            'city_id'=>$this->city_id,
            'ad_gender_type_id'=> $this->ad_gender_type_id,
            'contact_name'=>$this->contact_name,
            'phone_number'=>$this->phone_number,
            'contact_email'=>$this->contact_email,
            'price_from'=>$this->price_from,
            'description'=>$this->description,
            'rooms_count'=>$this->rooms_count,
            'roommate_count'=>$this->roommate_count,
            'price'=>$this->price,
            'location'=>$this->location,
            'animals'=>$this->animals,
        ];
    }
}
