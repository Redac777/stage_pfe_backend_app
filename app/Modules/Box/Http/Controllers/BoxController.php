<?php

namespace App\Modules\Box\Http\Controllers;

use App\Modules\Box\Models\Box;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BoxController
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $rules = [
            'start_time' => 'required|string ',
            'ends_time' => 'required|string ',
            'break' => 'nullable|boolean',
            'role' => 'nullable|string',
            'user_id' => 'nullable',
            'planning_id' => 'required',
            'equipement_id' => 'nullable',
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
            // Create a new box record
            $box = Box::create(
                [
                    'start_time' => $request->start_time,
                    'ends_time' => $request->ends_time,
                    'break' => $request->break,
                    'role' => $request->role,
                    'user_id' => $request->user_id,
                    'planning_id' => $request->planning_id,
                    'equipement_id' => $request->equipement_id
                ]
                );
            

            return [
                "payload" => $box,
                "message" => "Box created successfully",
                "status" => 201
            ];

        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
                'status' => 500
            ];
        }
    }

    public function getBoxesByPlanningId(Request $request)
{
    try{
        $boxes = Box::with(['user', 'equipement','planning'])->where('planning_id', $request->planning_id)->get();

        return [
            "payload" => $boxes,
            "status" => 200
        ];
    }
    catch(\Exception $e){
        return [
            "error" => $e->getMessage(),
            "status" => 500
        ];
    }
    
}

public function update(Request $request)
{
    try {
        $id = $request->input('id');
        $box = Box::findOrFail($id);
        $rules = [
            'start_time' => 'string',
            'ends_time' => 'string',
            'break' => 'boolean',
            'role' => 'string|nullable',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return [
                "error" => $validator->errors()->first(),
                "status" => 422
            ];
        }
        $box->update($request->all());
        return [
            "payload" => $box,
            "status" => 200
        ];
    } catch (ModelNotFoundException $e) {
        return [
            "error" => "Box not found",
            "status" => 404
        ];
    }
}


}
