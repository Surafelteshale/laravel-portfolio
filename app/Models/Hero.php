<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    protected $fillable = [
        'title',
        'sub_title',
        'btn_text',
        'btn_url',
        'image',
    ];
}
