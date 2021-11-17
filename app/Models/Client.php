<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'clients';

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
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function clientEvents()
    {
        return $this->hasMany(Event::class, 'client_id', 'id');
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

    public function specializations()
    {
        return $this->belongsToMany(Specialization::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
