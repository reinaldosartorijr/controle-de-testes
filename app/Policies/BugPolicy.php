<?php

namespace App\Policies;

use App\Models\Bug;
use App\Models\CompanyUser;
use App\Models\Item;
use App\Models\User;
use Illuminate\Auth\Access\Response;


class BugPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        
    }

    public function create_bug(User $user, Item $item)
    {
        $userRole = $item->system->company->members()->withPivot('role_id')->where('user_id',$user->id)->where('role_id', 4)->exists();
        return $userRole ? Response::allow() : Response::deny('Você não tem permissão para criar bugs');
    }

    public function view_bug(User $user, Bug $bug)
    {
        $userRole = $bug->item->system->company->members()->withPivot('role_id')->where('user_id',$user->id)->where('role_id', 4)->exists();
        return $userRole ? Response::allow() : Response::deny('Você não tem permissão para visualizar este bug');
    }

    public function update_bug(User $user, Bug $bug)
    {
        $userRole = $bug->item->system->company->members()->withPivot('role_id')->where('user_id',$user->id)->where('role_id', 4)->exists();
        return $userRole ? Response::allow() : Response::deny('Você não tem permissão para atualizar este bug');
    }

    public function delete_bug(User $user, Bug $bug)
    {
        $userRole = $bug->item->system->company->members()->withPivot('role_id')->where('user_id',$user->id)->where('role_id', 4)->exists();
        return $userRole ? Response::allow() : Response::deny('Você não tem permissão para deletar este bug');
    }

}
