<?php
namespace App\Traits;
trait ErrorTrait {
    public function sendError($message, $validation=[], $code=406)
    {
       $response=[
            'status'     => 'fail',
            'code'       => $code,
            'message'    => $message,
            'validation' => $validation,
            'data'       => []
        ];
        return response()->json($response, $code);
    }

}