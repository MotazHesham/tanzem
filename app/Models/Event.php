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

    public $table = 'events';

    protected $appends = [
        'photo',
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
        'company_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function eventBrands()
    {
        return $this->hasMany(Brand::class, 'event_id', 'id');
    }

    public function eventsVisitors()
    {
        return $this->belongsToMany(Visitor::class);
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

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
