<?php

namespace App\Policies;

use App\Models\User;
use App\Models\worker;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Access\Response;

class WorkerPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, worker $worker): bool
    {
        if ($user->role=='admin' or $user->role=='workowner'){
            return true;}
            else{
                return false;
            }
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, worker $worker): bool
    {
       return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, worker $worker): bool
    {
        $offer=$worker->concernedoffre;
        $userIds = DB::table('users')
    ->select('id')
    ->whereIn('id', function($query) use ($offer) {
        $query->select('workowner')
              ->from('offres')
              ->where('offres.id', '=', $offer);
    })
    ->get();

// Extract the IDs from the Collection and convert them to an array
$userIdsArray = $userIds->pluck('id')->toArray();

// Check if the user's ID is in the array of IDs
if ( $user->role == 'admin' or ($user->role == 'workowner' && in_array($user->id, $userIdsArray)))  
        
            {return true;} else {return false;}
        
        }
            
    

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, worker $worker): bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, worker $worker): bool
    {
        if ($user->role=='admin' or $user->role=='workowner'){
            return true;}
            else{
                return false;
            }
    }
    public function store(User $user, worker $worker): bool{
        return true;
    }
}
