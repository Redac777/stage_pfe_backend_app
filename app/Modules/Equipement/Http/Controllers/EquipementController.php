<?php

namespace App\Modules\Equipement\Http\Controllers;

use Illuminate\Http\Request;

class EquipementController
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view("Equipement::welcome");
    }
}
