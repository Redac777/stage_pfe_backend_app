<?php

namespace App\Modules\Users\Http\Controllers;

use Illuminate\Http\Request;

class UsersController
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view("Users::welcome");
    }
}
