<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = ['name', 'document', 'email', 'phone', 'user_id'];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
