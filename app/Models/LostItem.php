<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LostItem extends Model
{
    use HasFactory;

    /**
     * 一括代入を許可するカラムを指定
     */
    protected $fillable = [
        'name',
        'category',
        'color',
        'found_place',
        'found_date',
        'image_path',
        'description',
        'status',
    ];
}