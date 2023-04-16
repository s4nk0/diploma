<?php

namespace App\Models;

use App\Traits\ElasticSearchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Laravel\Scout\Searchable;

class AdGet extends Model
{
    use HasFactory, SoftDeletes, Searchable, ElasticSearchable;

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
        'views'
    ];

    protected $appends = [
        'createdAtDiffForHumans',
    ];

    public function getCreatedAtDiffForHumansAttribute()
    {
        Carbon::setLocale('ru');
        $date = Carbon::parse($this->created_at);
        return  $date->diffForHumans();
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
