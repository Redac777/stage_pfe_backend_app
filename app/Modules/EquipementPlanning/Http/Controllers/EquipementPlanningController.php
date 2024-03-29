<?php

namespace App\Modules\EquipementPlanning\Http\Controllers;

use Illuminate\Http\Request;

class EquipementPlanningController
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view("EquipementPlanning::welcome");
    }
}
