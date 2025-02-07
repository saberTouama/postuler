<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class offre extends Model
{
    use HasFactory;
    protected $casts = [
        'description' => 'array',
        'tools' => 'array',
    ];
    protected $fillable = ['description',
'titre', 'company', 'lieu', 'nb_post', 'site','tool1','tool2','tool3','tool4','works','skills','points'
    ];
    public function workowner()
    {
        return $this->belongsTo(Workowner::class, 'workowner');
    }
    public function workers()
    {
        return $this->belongsToMany(Worker::class, 'offreworker');
    }
    public function catigory(){
        return $this->belongsTo(Catigory::class, 'catigory_id');
    }
}
