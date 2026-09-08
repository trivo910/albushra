<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = [
        'question',
        'answer',
        'sort_order',
        'show_on_home',
    ];

    protected $casts = [
        'show_on_home' => 'boolean',
    ];
}
