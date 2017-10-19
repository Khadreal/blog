<?php

namespace App\Http\Services;
use Illuminate\Support\Facades\DB;
use App\Post;


class PostManagement 
{
	public function getAuthorPost($id)
	{
		try {
            $response = DB::table('posts')->where('author_id', $id)->get();
            return $response;
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
        }
	}	


    public function getPost()
    {
        try {
            $response = Post::where('publish',1)->with('image')->get();
            return $response;
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
        }
    }   


	public function InactivePost()
	{
		try {
            $response = Post::where('publish',0)->with('image')->get();
            return $response;
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
        }
	}	


	public function getFeaturedImage($data)
	{
		try {
            $response = DB::table('images')->where('id', $data)->get();
            return $response;
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
        }
	}

    public function getCategoryId($data)
    {
        try {
            $response = DB::table('category')->where('slug', $data)->value('id');
            return $response;
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
        }
    }	

}