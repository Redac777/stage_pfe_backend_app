<?php

namespace App\Modules\Box\Http\Controllers;

use Illuminate\Http\Request;

class BoxController
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view("Box::welcome");
    }
}
