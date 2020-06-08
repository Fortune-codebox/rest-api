<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Validator;
use App\Helper\Functions\ApiReturnResponse;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ApiReturnResponse;

    protected function validateRequest(Request $request, $rules)
    {
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            $response = [
                'status' => false,
                'message' => $this->getErrorMessages($validator),
                'data' => [],
                'status_code' => 400
            ];
            return $this->apiResponse(false, $this->getErrorMessages($validator), [], 400);
        }
        return [
            'status' => true
        ];
    }
}