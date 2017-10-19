<?php

namespace App\Http\Services;
use Illuminate\Support\Facades\DB;


class UserManagement 
{
	public function getUserId($data)
	{
		try {
            $response = DB::table('users')->where('email', $data)->value('id');;
            return $response;
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
        }
	}	
}
