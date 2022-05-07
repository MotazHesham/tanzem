<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventReviews extends Model
{
    //
    public $table = 'event_review';

    protected $fillable = [
        'event_id',
        'visitor_id',
        'rate',
        'review',
        'created_at',
        'updated_at',
   
    ];
    public function visitor(){

        return $this->belongsTo(Visitor::class, 'visitor_id');
    }
}
