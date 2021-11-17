<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class CompaniesAndInstitution extends Model implements HasMedia
{
    use SoftDeletes;
    use HasMediaTrait;

    public $table = 'companies_and_institutions';

    protected $appends = [
        'galery',
        'videos',
    ];
    
    protected $dates = [
        'commerical_expiry',
        'licence_expiry',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'commerical_num',
        'commerical_expiry',
        'licence_num',
        'licence_expiry',
        'user_id', 
        'city_id',
        'about_company',
        'facebook',
        'gmail',
        'linked',
        'instagram',
        'twitter',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
        $this->addMediaConversion('preview2')->fit('crop', 220, 220);
    }

    public function companyEvents()
    {
        return $this->hasMany(Event::class, 'company_id', 'id');
    }

    public function cawaders()
    {
        return $this->hasMany(Cawader::class, 'companies_and_institution_id', 'id');
    }

    public function getCreatedAtAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function getCommericalExpiryAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setCommericalExpiryAttribute($value)
    {
        $this->attributes['commerical_expiry'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getLicenceExpiryAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setLicenceExpiryAttribute($value)
    {
        $this->attributes['licence_expiry'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function specializations()
    {
        return $this->belongsToMany(Specialization::class);
    }

    public function getGaleryAttribute()
    {
        $files = $this->getMedia('galery');
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

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }


    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
