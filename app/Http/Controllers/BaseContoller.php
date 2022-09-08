<?php

namespace App\Http\Controllers ;
use App\Http\Controllers\Controller as Controller;

use Illuminate\Http\Request;

class BaseContoller extends Controller
{
    // sending response json 
    function sendResponse($results,$message)
    {
        $response=[
            'success'=>true,
            'data'=>$results,
            'message'=>$message
        ];
        return response()->json($response,200);
    }


    //send errors response

    function sendError($error,$errorMessage=[],$code=404){
        $response=[
            'success'=>false,
            'message'=>$error
        ];

        if(!empty($errorMessage)){
        $response['data']=$errorMessage;
        }


        return response()->json($response,$code);
    }
}
