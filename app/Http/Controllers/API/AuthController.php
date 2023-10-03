<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StudentRequest;
use App\Models\User;
use Hash;
use Auth;

class AuthController extends Controller
{

    public function register(StudentRequest $request)
    {


             /**
 * @OA\Post(
 * path="/register",
 * summary="Sign Up",
 * description="Sign Up APi",
 * operationId="authRegister",
 * tags={"auth"},
 * @OA\RequestBody(
 *    required=true,
 *    description="Pass user credentials",
 *    @OA\JsonContent(
 *       required={"first_name","last_name","phone","email","password","password_confirmation"},
 *       @OA\Property(property="first_name", type="string", format="text", example="Danish"),
 *       @OA\Property(property="last_name", type="string", format="text", example="Khan"),
 *       @OA\Property(property="phone", type="number", format="number", example="03122661624"),
 *       @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
 *       @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
 *       @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
 *       @OA\Property(property="persistent", type="boolean", example="true"),
 *    ),
 * ),
 * @OA\Response(
 *    response=422,
 *    description="Wrong credentials response",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
 *        )
 *     )
 * )
 */

        try {
            
            $user = User::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'password' => Hash::make($request['password']),
            ]);
 
            $user->assignRole('Student');
            $userResponse['status'] = true;
            $userResponse['message'] = 'Successfully Register';
            $userResponse['data'] = $user;
            $userResponse['error'] = false;

            return response()->json([
                $userResponse,
            ]);

            } catch (\Exception $e) {
            $userResponse['status'] = false;
            $userResponse['message'] = 'error';
            $userResponse['data'] = $e->getMessage();
            $userResponse['error'] = true;

            return response()->json([
                $userResponse,
            ]);
        }

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */


     /**
 * @OA\Post(
 * path="/login",
 * summary="Sign in",
 * description="Login by email, password",
 * operationId="authLogin",
 * tags={"auth"},
 * @OA\RequestBody(
 *    required=true,
 *    description="Pass user credentials",
 *    @OA\JsonContent(
 *       required={"email","password"},
 *       @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
 *       @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
 *       @OA\Property(property="persistent", type="boolean", example="true"),
 *    ),
 * ),
 * @OA\Response(
 *    response=422,
 *    description="Wrong credentials response",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
 *        )
 *     )
 * )
 */


    public function login(Request $request)
    {

        if (Auth::attempt($request->only('email', 'password'))) {
            
            $user = Auth::user();      
            if ($user['roles'][0]['name']=='Student') {
                $userResponse['status'] = true;
                $userResponse['message'] = 'Login Succussfully';
                $userResponse['token'] = auth()->user()->createToken('API Token')->plainTextToken;
                $userResponse['data'] = $user;
                $userResponse['error'] = false;

                return response()->json([
                    $userResponse
                ]); 

            }else{
                Auth::logout();
                $userResponse['status'] = false;
                $userResponse['message'] = 'User Not Authroized.';
                $userResponse['data'] = [];
                $userResponse['error'] = true;

                return response()->json([
                    $userResponse
                ]);

            }
            
        }
            $userResponse['status'] = false;
            $userResponse['message'] = 'These credentials do not match our records.';
            $userResponse['data'] = [];
            $userResponse['error'] = true;

            return response()->json([
                $userResponse
            ]); 

    }
}
