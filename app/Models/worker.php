<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class worker extends Model
{
    use HasFactory;
    protected $table = 'workers';

    // The attributes that are mass assignable.
    protected $fillable = ['position','name','hire_date','cv_path','concernedoffre'];



}
