<?php

namespace App\Modules\Planning\Http\Controllers;

use Illuminate\Http\Request;

class PlanningController
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view("Planning::welcome");
    }
}
