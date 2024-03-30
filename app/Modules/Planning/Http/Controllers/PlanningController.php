<?php

namespace App\Modules\Planning\Http\Controllers;

use App\Modules\Planning\Models\Planning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlanningController
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $rules = [
            'shift_id' => 'required',
        ];

        // Validate the request data
        $validator = Validator::make($request->all(), $rules);

        // If validation fails, return error response
        if ($validator->fails()) {
            return [
                "error" => $validator->errors()->first(),
                "status" => 422
            ];
        }
        try {
            // Create a new planning record
            $planning = Planning::create(
                [
                    'shift_id'=>$request->shift_id
                ]
                );
            

            return [
                "payload" => $planning,
                "message" => "Planning created successfully",
                "status" => 201
            ];

        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
                'status' => 500
            ];
        }
    }
}
