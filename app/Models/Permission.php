<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $table = "permissions";
    protected $fillable = ['name_key', 'name', 'status'];

    public function role()
    {
        return $this->belongsToMany(Role::class);
    }
}
