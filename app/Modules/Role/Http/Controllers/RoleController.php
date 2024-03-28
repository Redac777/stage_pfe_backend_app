<?php

namespace App\Modules\Role\Http\Controllers;

use Illuminate\Http\Request;

class RoleController
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view("Role::welcome");
    }
}
