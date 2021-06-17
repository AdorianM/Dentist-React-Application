<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Dentist;

class UserController extends Controller
{

    private $status_code = 200;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);
        $user = User::create($request->all());
        return response()->json(['message'=> 'user created', 
        'user' => $user]);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($name)
    {
        $user = array();
        if($name != "") {
            $user = User::where("name", $name)->first();
            return $user;
        }    
    }

    /*public function login_any(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $role = "user";
        $email_status = User::where("email", $request->email)->first();
        if(is_null($email_status)) {
            $email_status = Dentist::where("email", $request->email)->first();
            $role = "dentist";
        }

        if(!is_null($email_status)) {
            if($role == "user") {
                
            }
        }
    }*/

    /**
     * Login bro
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $email_status = User::where("email", $request->email)->first();
        if(!is_null($email_status)) {
            $password_status = User::where("email", $request->email)->where("password", $request->password)->first();

            // if password is correct
            if(!is_null($password_status)) {
                $user = $this->userDetail($request->email);
                return response()->json(["status" => $this->status_code, "success" => true, "message" => "You have logged in successfully", "data" => $user]);
            }

            else {
                return response()->json(["status" => "failed", "success" => false, "message" => "Unable to login. Incorrect password."]);
            }
        } else {
            $email_status = Dentist::where("email", $request->email)->first();
            if(!is_null($email_status)) {
                $password_status = Dentist::where("email", $request->email)->where("password", $request->password)->first();
    
                // if password is correct
                if(!is_null($password_status)) {
                    $dentist = $this->dentistDetail($request->email);
                    return response()->json(["status" => $this->status_code, "success" => true, "message" => "You have logged in successfully", "data" => $dentist]);
                }
    
                else {
                    return response()->json(["status" => "failed", "success" => false, "message" => "Unable to login. Incorrect password."]);
                }
            }
        }
    }

    public function userDetail($email) {
        $user               =       array();
        if($email != "") {
            $user           =       User::where("email", $email)->first();
            return $user;
        }
    }

    public function dentistDetail($email) {
        $dentist               =       array();
        if($email != "") {
            $dentist           =       Dentist::where("email", $email)->first();
            return $dentist;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  long  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required'
        ]);

        //$user = User::where("name", $request->name())->first();
        $user = User::where("id", $id)->first();

        $user->name = $request->name();
        $user->email = $request->email();
        $user->password = $request->password();
        $user->save();

        return response()->json([
            'message' => 'User updated!',
            'user' => $user
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  AppUser  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($user)
    {
        $user->delete();
        return response()->json([
            'message' => 'user deleted'
        ]);
    }


    public function changeUser(Request $request) {
        $user = User::where('id', $request->id)->first();
        $user->email = $request->email;
        $user->password = $request->password;
        $user->name = $request->name;
        $user->save();
    
        return response()->json(["status" => 201, "success" => true, "message" => "You have changed your credentials", "data" => $user]);
      }
}
