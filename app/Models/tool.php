<?php

namespace App\Models;

use App\Models\offre;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class tool extends Model
{
    use HasFactory;
    public function offres()
{
    return $this->belongsToMany(offre::class, 'offer_tools');
}
}
