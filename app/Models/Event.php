<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Event extends Model implements HasMedia
{
    use SoftDeletes;
    use HasMediaTrait;
    use Auditable;

    public const STATUS_SELECT = [
        'pending'  => 'Pending',
        'active' => 'Active',
        'refused'  => 'Refused',
        'closed'   => 'Closed',
    ];

    public $table = 'events';

    protected $appends = [
        'photo',
        'photos',
        'videos',
    ];

    protected $dates = [
        'start_date',
        'end_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'city_id',
        'address',
        'latitude',
        'longitude',
        'area',
        'company_id',
        'cost',
        'status',
        'client_id',
        'government_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
        $this->addMediaConversion('preview2')->fit('crop', 220, 220);
        $this->addMediaConversion('preview3')->fit('crop', 320, 320);
    }

    public function eventBrands()
    {
        return $this->hasMany(Brand::class, 'event_id', 'id');
    }

    public function eventsVisitors()
    {
        return $this->belongsToMany(Visitor::class)->withPivot(['status','created_at','updated_at']);
    }

    public function getStartDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getEndDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getStartTimeAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.time_format')) : null;
    }

    public function setStartTimeAttribute($value)
    {
        $this->attributes['start_time'] = $value ? Carbon::createFromFormat(config('panel.time_format'), $value)->format('H:i:s') : null;
    }

    public function getEndTimeAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.time_format')) : null;
    }

    public function setEndTimeAttribute($value)
    {
        $this->attributes['end_time'] = $value ? Carbon::createFromFormat(config('panel.time_format'), $value)->format('H:i:s') : null;
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function getPhotoAttribute()
    {
        $file = $this->getMedia('photo')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
            $file->preview2   = $file->getUrl('preview2');
            $file->preview3   = $file->getUrl('preview3');
        }

        return $file;
    }

    public function company()
    {
        return $this->belongsTo(CompaniesAndInstitution::class, 'company_id');
    }

    public function available_gates()
    {
        return $this->belongsToMany(Gate::class);
    }

    public function specializations()
    {
        return $this->belongsToMany(Specialization::class);
    }

    public function cawaders()
    {
        return $this->belongsToMany(Cawader::class)->withPivot(['supervisor_id','hours','amount','extra_hours','status']);
    }


    public function attendance()
    {
        return $this->belongsToMany(Cawader::class,'event_attendance_pivot','event_id','cawader_id')
                    ->withPivot(['type','out_of_zone','attendance1','attendance2','out_of_zone_minutes','longitude','latitude','distance'])
                    ->withTimestamps();
    }
    public function reviews()
    {
        return $this->belongsToMany(Visitor::class,'event_review','event_id','visitor_id')->withPivot('review','rate','created_at','updated_at');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function government()
    {
        return $this->belongsTo(GovernmentalEntity::class, 'government_id');
    }

    public function getPhotosAttribute()
    {
        $files = $this->getMedia('photos');
        $files->each(function ($item) {
            $item->url = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview = $item->getUrl('preview');
        });

        return $files;
    }

    public function getVideosAttribute()
    {
        return $this->getMedia('videos');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
