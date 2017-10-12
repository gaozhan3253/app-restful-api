<?php

namespace App\Api;

use App\Http\Controllers\Controller;
use Dingo\Api\Routing\Helpers;
use Illuminate\Contracts\Validation\Validator;

class BaseController extends Controller
{
    use Helpers;

    protected function formatValidationErrors(Validator $validator)
    {
        $message = $validator->errors()->first();
        return $this->response()->error($message,500);
//        return  ['message'=>$message,'status_code' => 500];
    }
}
