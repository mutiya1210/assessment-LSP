<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Category extends Model
{
    use Softdeletes;

    // protected $filable = [
    //     'name','photo','slug'
    // ];

    protected $guarded = [];

    protected $hidden= [

    ];
}
