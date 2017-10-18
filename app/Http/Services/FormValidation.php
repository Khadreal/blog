<?php

namespace App\Http\Services;
use Validator;

class FormValidation
{
    //
    public function createPost($data)
    {
        $validator = Validator::make($data, [
            'title'      =>  'required|string|max:155',
            'content'    =>  'required',
            'category'   =>  'required',
            'image'      =>  'mimes:jpeg,bmp,png|max:2000'
        ]);
        return $validator;
    }

    public function addCategory($data)
    {
        $validator = Validator::make($data, [
            'name'          =>  'required|string|max:155',
            'description'   =>  'max:300'
        ]);
        return $validator;
    }

}
