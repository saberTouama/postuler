<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class offer_tools extends Model
{
    use HasFactory;
    protected $table = 'offer_tools';
    protected $fillable=['offer_id','tool_id'];
}
