<?php

namespace App\Modules\ProfileGroup\Http\Controllers;

use Illuminate\Http\Request;

class ProfileGroupController
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view("ProfileGroup::welcome");
    }
}
