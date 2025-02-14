<?php

namespace App\Models;

use App\Core\Model;

class RolePermission extends Model
{
    protected $table = 'role_permissions';
    
    protected $fillable = [
        'role',
        'permission_id'
    ];

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }
}
