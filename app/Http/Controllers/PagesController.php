<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Image;
use App\Category;
use Auth;
use DB;
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
    	return view('errors.404');
    }

    public function addCategory()
    {
    	$role = Auth::user()->role;

    	if($role == "author" || $role == "admin")
    	{
    		return view('pages.category');	
    	}
    	return view('errors.404');
    }

    public function getCategoryPost($slug)
    {
        
        $catId = $this->postmanagement->getCategoryId($slug);

        $posts = Post::where('publish',1)->where('category_id', $catId)->with('image')->orderBy('created_at','desc')->paginate(15);

        return view('pages.category-post', compact('posts'));
    }

    public function singlePost($slug)
    {
        
        $post = Post::where('slug',$slug)->with('image')->get();
        if($post->isEmpty()){
            return view('errors.404');
        }
        return view('pages.single', compact('post'));

        
    }
}
