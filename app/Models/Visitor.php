<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Visitor extends Model
{
    use SoftDeletes;

    public const VISITOR_TYPE_SELECT = [
        'individual'  => 'فرد',
        'family_author' => 'صاحب العائلة',
        'family_individual'  => 'فرد في عائلة',
    ];

    public $table = 'visitors';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'national',
        'visitor_type',
        'parent_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function visitorVisitorsFamilies()
    {
        return $this->hasMany(VisitorsFamily::class, 'visitor_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function parent()
    {
        return $this->belongsTo(Visitor::class, 'parent_id');
    }

    public function family_members()
    {
        return $this->hasMany(Visitor::class, 'parent_id');
    }

    public function events()
    {
        return $this->belongsToMany(Event::class)->withPivot(['status','created_at','updated_at']);
    }

    public function brands()
    {
        return $this->belongsToMany(Brand::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
