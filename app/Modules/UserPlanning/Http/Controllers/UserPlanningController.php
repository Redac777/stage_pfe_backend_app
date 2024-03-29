<?php

namespace App\Modules\UserPlanning\Http\Controllers;

use Illuminate\Http\Request;

class UserPlanningController
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view("UserPlanning::welcome");
    }
}
