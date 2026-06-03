<?php

namespace App\Policies;

use App\Models\Item;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ItemPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function view_item(User $user, Item $item)
    {
        return $item->created_by === $user->id || $item->tester_id === $user->id || $item->developer_id === $user->id ? 
            Response::allow() : 
            Response::deny('Você não tem permissão para visualizar este item');
    }

    public function update_item(User $user, Item $item)
    {
        return $item->created_by === $user->id || $item->tester_id === $user->id ? 
            Response::allow() : 
            Response::deny('Você não tem permissão para atualizar este item');
    }

    public function delete_item(User $user, Item $item) {
        return $item->created_by === $user->id ? 
            Response::allow() : 
            Response::deny('Você não tem permissão para deletar este item');
    }

}
