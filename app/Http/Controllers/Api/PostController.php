<?php 

namespace App\Http\Controllers\Api;
use App\User;
use App\Post;
use App\Http\Services\PostManagement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class PostController extends Controller
{
    private $postmanagement;

    public function __construct
    (
        PostManagement $postmanagement
    )
    {
        $this->postmanagement      =      $postmanagement;
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
}