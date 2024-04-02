<?php

namespace App\Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\User\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $users = User::all();
            return [
                "payload" => $users,
                "status" => 200
            ];
        } catch (\Exception $e) {
            return [
                "error" => "Internal Server Error",
                "status" => 500
            ];
        }
    }

    public function login(Request $request)
    {
        // Define validation rules
        $rules = [
            'matricule' => 'required|string',
            'password' => 'required|string',
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
            // Attempt to authenticate the user
            if (Auth::attempt($request->only('matricule', 'password'))) {
                $user = Auth::user();
                // Retrieve the authenticated user
                if ($user->isactive == 1){
                
                // Generate token for the user
                $token = $user->createToken('auth-token')->plainTextToken;

                // Return token in response
                return [
                    'payload' => ['user' => $user, 'token' => $token],
                    'status' => 200
                ];
            }else{
                return [
                    'error' => 'User is not active',
                    'status' => 403
                ];
            }
            }

            // If authentication fails, return error response
            return [
                'error' => 'Unauthorized',
                'status' => 401
            ];
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
                'status' => 500
            ];
        }
    }

    public function register(Request $request)
    {
        // Define validation rules for user registration
        $rules = [
            'matricule' => 'required|string|max:255|unique:users',
            'firstname'=>'required|string|max:255',
            'lastname'=>'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'shift_id' => 'required',
            'profile_group_id' => 'nullable',
            'role_id' => 'required',
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
            // Create the new user
            $user = User::create([
                'matricule' => $request->matricule,
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'shift_id' => $request->shift_id,
                'profile_group_id' => $request->profile_group_id,
                'role_id' => $request->role_id,
                'password' => Hash::make("123456")
            ]);

            // Generate token for the user

            // Return token and user in response
            return [
                "payload" => $user,
                "message" => "User created successfully",
                "status" => 201
            ];
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
                'status' => 500
            ];
        }
    }

    public function logout(Request $request)
    {
        try {
            // Récupérer l'utilisateur actuellement authentifié

            // Supprimer tous les tokens d'authentification de l'utilisateur
            //  $user->tokens()->delete();
            auth()->user()->tokens()->delete();
            $user = Auth::user();
            // Déconnecter l'utilisateur
            // Auth::logout();

            return [
                'message' => 'User logged out successfully',
                'user' => $user,
                'status' => 200
            ];
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
                'status' => 500
            ];
        }
    }


    public function delete(Request $request)
    {
        $id = $request->input('id');
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return [
                "payload" => "Deleted successfully",
                "status" => 204
            ];
        } catch (ModelNotFoundException $e) {
            return [
                "error" => "User not found",
                "status" => 404
            ];
        } catch (\Exception $e) {
            return [
                "error" => "Internal Server Error",
                "status" => 500
            ];
        }
    }

    public function updatePassword(Request $request)
    {
        $oldPassword = $request->input('old_password');
        $newPassword = $request->input('new_password');
        $rules = [
            'old_password' => 'required|string|min:6',
            'new_password' => 'required|string|min:6',
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
            $user = Auth::user();
            if (Hash::check($oldPassword, $user->password)) {
                $hashedPassword = Hash::make($newPassword);
                $user->password = $hashedPassword;
                $user->save();

                return [
                    "message" => "Password updated successfully",
                    "status" => 200
                ];
            } else {
                return [
                    "error" => "Old password is incorrect",
                    "status" => 400
                ];
            }
        } catch (\Exception $e) {
            // Return error response if user is not found or any other exception occurs
            return [
                "error" => "Error updating password: " . $e->getMessage(),
                "status" => 500
            ];
        }
    }

    public function resetPassword(Request $request)
    {
        $id = $request->input('id');
        // Validate the request data
        
        try {
            $user = User::findOrFail($id);
            $hashedPassword = Hash::make("123456");
            $user->password = $hashedPassword;
            $user->save();
            return [
                "payload" => $user,
                "message" => "Password updated successfully",
                "status" => 200
            ];
        } catch (\Exception $e) {
            // Return error response if user is not found or any other exception occurs
            return [
                "error" => "Error updating password: " . $e->getMessage(),
                "status" => 500
            ];
        }
    }

    public function show($id)
    {
        try {
            $user = User::findOrFail($id);
            return [
                "payload" => $user,
                "status" => 200
            ];
        } catch (ModelNotFoundException $e) {
            return [
                "error" => "User not found",
                "status" => 404
            ];
        }
    }

    public function update(Request $request)
    {
        try {
            $id = $request->input('id');
            $user = User::findOrFail($id);
            $rules = [
                'matricule' => [
                    'string',
                    'max:255',
                    Rule::unique('users', 'matricule')->ignore($user->id), // Ignore the unique rule for the current user's matricule
                ],
                'firstname' => 'string|max:255',
                'lastname'=> 'string|max:255',
                'isactive' => 'integer|between:0,1',
                'email' => [
                    'email',
                    'max:255',
                    Rule::unique('users', 'email')->ignore($user->id), // Ignore the unique rule for the current user's email
                ],
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return [
                    "error" => $validator->errors()->first(), // Get the first validation error message
                    "status" => 422
                ];
            }
            $user->update($request->all());
            return [
                "payload" => $user,
                "status" => 200
            ];
        } catch (ModelNotFoundException $e) {
            return [
                "error" => "User not found",
                "status" => 404
            ];
        }
        
    }
}
