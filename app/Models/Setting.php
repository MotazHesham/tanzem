<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use SoftDeletes;

    public $table = 'settings';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'address',
        'phone_1',
        'phone_2',
        'email_1',
        'email_2',
        'facebook',
        'gmail',
        'linkedin',
        'instagram',
        'twitter',
        'latitude',
        'longitude',
        'home_text_1',
        'home_text_2',
        'about_us',
        'caders_text',
        'events_text',
        'news_text',
        'how_we_work_header',
        'how_we_work_1',
        'how_we_work_2',
        'how_we_work_3',
        'said_about_tanzem',
        'organizers_text',
        'contact_us_text',
        'goals',
        'terms_cawader',
        'terms_company',
        'terms_visitor',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
