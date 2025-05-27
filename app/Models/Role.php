<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasUuids;
    
    protected $table = 'roles';
    protected $fillable = [
        'nama'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }



}
