<?php

namespace App\Policies;

use App\Models\System;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SystemPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function view_system(User $user, System $system)
    {
        return $system = System::with('company')
                ->findOrFail($system->id)
                ->company
                ->members()
                ->where('user_id', $user->id)
                ->exists() ? 
        Response::allow() : 
        Response::deny('Você não tem permissão para visualizar este sistema');

    }

    public function create_system(User $user, System $system)
    {
        return  $system->company->user_id === $user->id ? 
            Response::allow() : 
            Response::deny('Você não tem permissão para criar sistemas para esta empresa');
    }

    public function update_system(User $user, System $system)
    {
        return $system->company->user_id === $user->id ? 
            Response::allow() : 
            Response::deny('Você não tem permissão para atualizar este sistema');
    }

    public function delete_system(User $user, System $system)
    {
        
        if($system->items()->count() > 0) {
            return Response::deny('Você não tem permissão para excluir este sistema porque ele possui itens');
        }

        return $system->company->user_id === $user->id ? 
            Response::allow() : 
            Response::deny('Você não tem permissão para deletar este sistema');
    }

    public function system_items_analyst(User $user, System $system)
    {
        return $system = System::with('company')
                ->findOrFail($system->id)
                ->company
                ->members()
                ->where('user_id', $user->id)
                ->where('role_id', 2) // Analista
                ->exists() ? 
        Response::allow() : 
        Response::deny('Você não tem permissão para visualizar este sistema');

    }
}
