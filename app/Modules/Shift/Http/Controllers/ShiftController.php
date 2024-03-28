<?php

namespace App\Modules\Shift\Http\Controllers;

use Illuminate\Http\Request;

class ShiftController
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view("Shift::welcome");
    }
}
