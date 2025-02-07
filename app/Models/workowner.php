<?php

namespace App\Models;

//use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Authenticatablelluminate\Foundation\Auth\User  ;   
use app\Models\User;
class workowner extends User
{
    use HasFactory;
    public function publish()
    {
        return $this->HasMany(offre::class, 'work_owner_id');
    }
    

}
        
