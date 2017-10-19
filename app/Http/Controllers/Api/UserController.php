<?php

namespace App\Http\Controllers\Api;
use App\User;
use Illuminate\Http\Request;
use App\Http\Services\UserManagement;
use App\Http\Services\PostManagement;
use App\Http\Services\FormValidation;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController
{
	private $postmanagement;
    private $usermanagement;

	public function __construct
    (
        PostManagement $postmanagement,
        UserManagement $usermanagement,
        FormValidation $validate
    )
    {
        $this->postmanagement      =      $postmanagement;
        $this->usermanagement      =      $usermanagement;
        $this->validate            =      $validate;
    }

	public function getAllUserData($data)
	{
		
		$response_data = [
            'data' => [
                'user'              =>      $data,
                'posts'           	=>      $this->postmanagement->getAuthorPost($data['id'])
            ],
            'status' => 200
        ];

        return $response_data;

	}

	public function login(Request $request)
    {
        $email  	=   $request['email'];
        $password   =   $request['password'];
        
        $user = null;

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $user = Auth::user();
        }

        if(!$user){
            
            $response_data = [
                'status'            =>      500,
                'message'           =>      "Invalid Login Credentials"
            ];
            return response($response_data, 500)->header('Content-Type', 'application/json');
        }
        
        return response($this->getAllUserData($user), 200)->header('Content-Type', 'application/json');

    }

    public function register(Request $request)
    {
    	
    	$validator = $this->validate->uservalidation($request->all());   

        if ($validator->fails())
        {
        	foreach ($validator->messages()->getMessages() as $field_name => $messages)
    		{
		        var_dump($messages); // messages are retrieved (publicly)
		    }

            return response(
                $data = [
                    "Message"   =>      "All fields are required"
                ], 
            500)->header('Content-Type', 'application/json');
        }

        return 400;
    	$passkey = Hash::make($request['password']);

    	$userData = [
    		'name'		=>		$request['name'],
    		'email'		=>		$request['email'],
    		'role'		=>		$request['role'],
    		'password'	=>		$passkey
    	];

    	 User::create($userData);

    	 return response(
    	 	$data = [
    	 		"message"	=>	"New User Created"
    	 	], 200)->header('Content-Type', 'application/json');

    }
}