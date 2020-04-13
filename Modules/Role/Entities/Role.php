<?php

namespace Modules\Role\Entities;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    protected $fillable = ['name', 'display_name', 'description'];
}
