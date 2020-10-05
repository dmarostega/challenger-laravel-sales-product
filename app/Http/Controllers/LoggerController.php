<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Log;
use App\Logger;
use App\User;
use Illuminate\Support\Facades\Auth;

class LoggerController extends Controller
{
    
    public function index(User $user = null){

        if($user === null){
            $user = Auth::user();
        }

        return view('logger.index',[
            'logs' => Logger::where('user_id','=',$user->id)->get(),
            'user' => $user
        ]);
    }
}
