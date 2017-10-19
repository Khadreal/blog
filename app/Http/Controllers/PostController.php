<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\FormValidation;
use App\Category;
use App\Image;
use App\Post;
use Auth;

class PostController extends Controller
{
	private $validate;

    public function __construct
    (
    	FormValidation $validate
    )
    {
    	$this->validate 			=		$validate;
    }

    public function savePost(Request $request)
    {	
    	$validator = $this->validate->createPost($request->all());
    	$post = new Post;
    	$slug = str_slug($request['title'], "-");
    	if ($validator->fails()) 
    	{
    		session()->flash('form-error', 'alert');
    		return back()->withErrors($validator)
                        ->withInput();
    	}
    	else
    	{
    		if ($request->hasFile('image')) 
    		{
	            $image = $request->file('image');
	            $name = time().'.'.$image->getClientOriginalExtension();
	            $destinationPath = public_path('/images');
	            $image->move($destinationPath, $name);
	            $name = 'images' . "/" . $name;
	            $data = [
	                'image'  =>     $name,
	            ];

	            $featured = Image::create($data);  
	            $featuredId = $featured->id;

	            $postData = [
	            	'author_id'		=>		Auth::user()->id,
	            	'title'			=>		$request['title'],
	            	'body'			=>		$request['content'],
	            	'category_id'	=>		$request['category'],
	            	'slug'			=>		$slug,
	            	'image_id'		=>		$featuredId,
	            	'publish'		=>		$request['status']
	            ];

	            $post::create($postData);
	            return back()->with('message', 'success');
	        }
	        else
	        {
	        	$postData = [
	            	'author_id'		=>		Auth::user()->id,
	            	'title'			=>		$request['title'],
	            	'body'			=>		$request['content'],
	            	'category_id'	=>		$request['category'],
	            	'slug'			=>		$slug,
	            	'publish'		=>		$request['status']
	            ];

	            $post::create($postData);
	            return back()->with('message', 'success');
	        }	
    	}
    }

    public function addCategory(Request $request)
    {
    	$category = new Category;
    	$validator = $this->validate->addCategory($request->all());
    	if ($validator->fails()) 
    	{
    		session()->flash('form-error', 'alert');
    		return back()->withErrors($validator)
                        ->withInput();
    	}
    	else
    	{
    		$data = [
    			'title'			=>	$request['name'],
    			'description'	=>	$request['description'],
    			'slug'			=>	str_slug($request['name'], "-")
    		];
    		$category::create($data);
    		return back()->with('message', 'success');
    	}
    }
}
