<?php
namespace App\Traits;
trait ResponseTrait {
    public function sendResponse($result=[], $message='')
    {
       $response=[
            'status'   => 'success',
            'code'     => 200,
            'message'  => $message,
            'data'     => $result
        ];
        return response()->json($response, 200);
    }


}