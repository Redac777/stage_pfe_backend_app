<?php

namespace App\Modules\Department\Http\Controllers;

use Illuminate\Http\Request;

class DepartmentController
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view("Department::welcome");
    }
}
