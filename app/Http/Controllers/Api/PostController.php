<?php 

namespace App\Http\Controllers\Api;
use App\User;
use App\Post;
use App\Image;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Services\PostManagement;
use App\Http\Services\UserManagement;
use App\Http\Services\FormValidation;
use App\Http\Controllers\Controller;


class PostController extends Controller
{
    private $postmanagement;
    private $usermanagement;
    private $validate;

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

    public function allPost()
    {
        $posts = $this->postmanagement->getPost();

        $nodata = [
            'post'      =>      "No Post"
        ];

        if($posts->isEmpty()){
            return response($nodata, 500)->header('Content-Type', 'application/json');   
        }

        $response_data = [
            'post'              =>      $posts
        ];

        return response($response_data, 200)->header('Content-Type', 'application/json');
    }

    
    public function InactivePost()
    {
        $posts = $this->postmanagement->InactivePost();

        $nodata = [
            'post'      =>      "No Post"
        ];

        if($posts->isEmpty()){
            return response($nodata, 500)->header('Content-Type', 'application/json');   
        }

        $response_data = [
            'post'              =>      $posts
        ];

        return response($response_data, 200)->header('Content-Type', 'application/json');
    }

    public function createPost(Request $request)
    {
        $validator = $this->validate->createPost($request->all());

        if ($validator->fails()) {
            return response(
                $data = [
                    "Message"   =>      "Check your form field"
                ], 
            500)->header('Content-Type', 'application/json');
        }

        $author_id = $this->usermanagement->getUserId($request['email']);

        $featuredId = null;

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
        }

        $postData = [
            'author_id'     =>      $author_id,
            'title'         =>      $request['title'],
            'body'          =>      $request['content'],
            'category_id'   =>      $request['category'],
            'slug'          =>      str_slug($request['title'], "-"),
            'image_id'      =>      $featuredId,
            'publish'       =>      $request['status']
        ];

        Post::create($postData);

        return response(
            $data = [
                "Message"       =>      "Post successfully created"
            ],
            200)->header('Content-Type', 'application/json');   
    }

    public function addCategory(Request $request)
    {
        $validator = $this->validate->addCategory($request->all());   

        if ($validator->fails())
        {
            return response(
                $data = [
                    "Message"   =>      "The Category title is required"
                ], 
            500)->header('Content-Type', 'application/json');
        }

        $data = [
            'title'             =>      $request['name'],
            'description'       =>      $request['description'],
            'slug'              =>      str_slug($request['name'], "-")
        ];

        Category::create($data);

        return response(
            $data = [
                "Message"       =>      "Category successfully added"
            ],
            200)->header('Content-Type', 'application/json');   

    }
}