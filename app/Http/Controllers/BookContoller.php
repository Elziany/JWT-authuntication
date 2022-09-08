<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseContoller as BaseContoller;

class BookContoller extends BaseContoller
{
    function __construct(){
        return $this->middleware('auth:api');
    }
  function test(){
    return $this->sendError('validtion',['email is required','name is required']);
  }
}
