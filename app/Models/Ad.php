<?php

namespace App\Models;

use App\Traits\ElasticSearchable;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Laravel\Scout\Searchable;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Ad extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia, Searchable, ElasticSearchable;

    protected $fillable = [
        'user_id',
        'city_id',
        'apartment_condition_id',
        'apartment_furniture_status_id',
        'ad_gender_type_id',
        'description',
        'price',
        'price_com',
        'price_pledge',
        'rooms_count',
        'roommate_count',
        'bathrooms_count',
        'balconies_count',
        'loggias_count',
        'floor_from',
        'floor',
        'square_general',
        'square_living',
        'square_kitchen',
        'kitchen_studio',
        'coordinates',
        'location',
        'contact_name',
        'contact_email',
        'phone_number',
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

    protected $table = 'ad';

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }

    public function apartment_condition(){
        return $this->hasOne(ApartmentCondition::class,'id','apartment_condition_id');
    }

    public function gender_type(){
        return $this->hasOne(AdGenderType::class,'id','ad_gender_type_id');
    }

    public function liked_users(){
        return $this->belongsToMany(User::class,'user_ad_likes','ad_id','user_id');
    }

    public function apartment_bathrooms(){
        return $this->belongsToMany(ApartmentBathroom::class,'ad_apartment_bathroom','ad_id','apartment_bathroom_id');
    }

    public function apartment_bathrooms_types(){
        return $this->belongsToMany(ApartmentBathroomType::class,'ad_apartment_bathroom_type','ad_id','apartment_bathroom_type_id');
    }

    public function apartment_furniture(){
        return $this->belongsToMany(ApartmentFurniture::class,'ad_apartment_furniture','ad_id','apartment_furniture_id');
    }

    public function apartment_furniture_status(){
        return $this->hasOne(ApartmentFurnitureStatus::class,'id','apartment_furniture_status_id');
    }

    public function apartment_facilities(){
        return $this->belongsToMany(ApartmentFacilities::class,'ad_apartment_facilities','ad_id','apartment_facilities_id');
    }

    public function apartment_bathroom_types(){
        return $this->belongsToMany(ApartmentBathroomType::class,'ad_apartment_bathroom_type','ad_id','apartment_bathroom_type_id');
    }

    public function apartment_securities(){
        return $this->belongsToMany(ApartmentSecurity::class,'ad_apartment_security','ad_id','apartment_security_id');
    }

    public function window_directions(){
        return $this->belongsToMany(WindowDirection::class,'ad_window_direction','ad_id','ad_window_direction_id');
    }

    public function apartment_for(){
        return $this->belongsToMany(ApartmentFor::class,'ad_apartment_for','ad_id','apartment_for_id');
    }


    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();
    }

    protected function makeAllSearchableUsing(EloquentBuilder $query)
    {
        return $query->with(['user','city']);
    }

    public function toSearchableArray(): array
    {
        return [
            'description'=>$this->description,
            'price'=>$this->description,
            'price_com'=>$this->price_com,
            'price_pledge'=>$this->price_pledge,
            'rooms_count'=>$this->rooms_count,
            'roommate_count'=>$this->roommate_count,
            'bathrooms_count'=>$this->bathrooms_count,
            'balconies_count'=>$this->balconies_count,
            'loggias_count'=>$this->loggias_count,
            'floor_from'=>$this->floor_from,
            'floor'=>$this->floor,
            'square_general'=>$this->square_general,
            'square_living'=>$this->square_living,
            'square_kitchen'=>$this->square_kitchen,
            'kitchen_studio'=>$this->kitchen_studio,
            'coordinates'=>$this->coordinates,
            'location'=>$this->location,
            'contact_name'=>$this->contact_name,
            'contact_email'=>$this->contact_email,
            'phone_number'=>$this->phone_number,
        ];
    }
}