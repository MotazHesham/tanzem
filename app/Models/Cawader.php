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

    public const HAS_SKILLS_RADIO = [
        '0' => 'no',
        '1' => 'yes',
    ];

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
        'longitude',
        'latitude',
        'companies_and_institution_id',
        'desceiption',
        'has_skills',
        'out_of_zone',
        'experience_years',
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
        return $this->belongsToMany(CawaderSpecialization::class,'cawader_specialization','cawader_id','specialization_id');
    }

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function companies_and_institution()
    {
        return $this->belongsTo(CompaniesAndInstitution::class, 'companies_and_institution_id');
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
