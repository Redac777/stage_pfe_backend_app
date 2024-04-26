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
            'profile_group_id' => 'required',
            'checker_number' => 'nullable|numeric',
            'deckman_number' => 'nullable|numeric',
            'assistant' => 'nullable|boolean'
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
                    'shift_id' => $request->shift_id,
                    'profile_group_id' => $request->profile_group_id,
                    'checker_number' => $request->checker_number,
                    'deckman_number' => $request->deckman_number,
                    'assistant' => $request->assistant
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

    public function getByDate(Request $request)
    {
        $rules = [
            'date' => 'required|date',
            'shift_id' => 'required',
            'profile_group_id' => 'required'
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
            // Convert the input date to a format suitable for querying
            $date = date('Y-m-d', strtotime($request->date));

            // Retrieve planning records created on the specified date
            $planningRecords = Planning::whereDate('created_at', $date)->where('shift_id', $request->shift_id)
                ->where('profile_group_id', $request->profile_group_id)->get();

            return [
                "payload" => $planningRecords,
                "message" => "Planning records retrieved successfully",
                "status" => 200
            ];
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
                'status' => 500
            ];
        }
    }
}
