<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Image;
use App\Category;
use Auth;
use App\Http\Services\PostManagement;

class PagesController extends Controller
{
    private $postmanagement;
    //
    public function __construct
    (
        PostManagement $postmanagement
    )
    {
        $this->postmanagement      =      $postmanagement;
    }
    public function index()
    {
    	$posts = Post::where('publish',1)->with('image')->orderBy('created_at','desc')->paginate(15);
    	//return $posts;
    	return view('pages.index', compact('posts'));
    }


    public function createPost()
    {
        $category = Category::all();
        
    	$role = Auth::user()->role;

    	if($role == "author" || $role == "admin")
    	{
    		return view('pages.create-post', compact('category'));	
    	}
    	return 404;
    }

    public function addCategory()
    {
    	$role = Auth::user()->role;

    	if($role == "author" || $role == "admin")
    	{
    		return view('pages.category');	
    	}
    	return 404;
    }

    public function getCategoryPost($slug)
    {
        
        $getId = $this->postmanagement->getCategoryId($slug);
       
        $posts = Post::whereColumn([
            ['publish', '=', 1],
            ['category_id', $getId]
            ])->with('image')->orderBy('created_at','desc')->paginate(15);
        return $posts;
    }
}
