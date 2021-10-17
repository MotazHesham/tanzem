<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cawader extends Model
{
    use SoftDeletes;
    use Auditable;

    public const DEGREE_SELECT = [
        'Literate without Certificate' => 'Literate without Certificate',
        'Primary Certificate'          => 'Primary Certificate',
        'middle school certificate'    => 'middle school certificate',
        'High School Certificate'      => 'High School Certificate',
        'Diploma'                      => 'Diploma',
        'Bachelors Degree'             => 'Bachelors Degree',
        'Masters Degree'               => 'Masters Degree',
    ];

    public $table = 'cawaders';

    protected $dates = [
        'dob',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'dob',
        'city_id',
        'degree',
        'working_hours',
        'identity_number',
        'user_id',
        'companies_and_institution_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getDobAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDobAttribute($value)
    {
        $this->attributes['dob'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function specializations()
    {
        return $this->belongsToMany(Specialization::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function companies_and_institution()
    {
        return $this->belongsTo(CompaniesAndInstitution::class, 'companies_and_institution_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
