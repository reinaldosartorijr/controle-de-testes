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

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'company_users')
                    ->withPivot('role_id');
    }    

    public function systems()
    {
        return $this->hasMany(System::class);
    }
}
