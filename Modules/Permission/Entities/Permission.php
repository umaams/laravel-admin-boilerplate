<?php

namespace Modules\Permission\Entities;

use Laratrust\Models\LaratrustPermission;

class Permission extends LaratrustPermission
{
    protected $fillable = ['name', 'parent_permission_id', 'display_name', 'description'];

    public function permissions()
    {
        return $this->hasMany('Modules\Permission\Entities\Permission', 'parent_permission_id', 'id');
    }

    public function childrenPermissions()
    {
        return $this->hasMany('Modules\Permission\Entities\Permission', 'parent_permission_id', 'id')->with('permissions');
    }

    public function parent_permission()
    {
        return $this->belongsTo('Modules\Permission\Entities\Permission', 'parent_permission_id', 'id');
    }
}
