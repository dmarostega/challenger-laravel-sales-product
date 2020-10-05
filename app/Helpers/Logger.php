<?php

namespace App\Helpers;

use App\Logger;
use Illuminate\Support\Facades\Auth;

class Log{

    private static $register;
    
    public static function in($activity,$message){
        if(self::$register===null){
            self::$register = new Logger();
        }

        self::$register->user_id = Auth::user()->id;
        self::$register->activity = $activity;
        self::$register->message = $message;

        self::$register->save();
    }

    public static function add($obj,$fieldOrString = 'name'){
        $name = explode('\\',get_class($obj)) ;
        $name = end($name);

        self::in('ADD',"Added $name:  {$obj->id}, ".  ( isset( $obj->{$fieldOrString} ) ? $obj->{$fieldOrString} : $fieldOrString) );
    }

    public static function create($obj,$fieldOrString = 'name'){
        $name = explode('\\',get_class($obj)) ;
        $name = end($name);

        self::in('CREATE',"Created $name:  {$obj->id}, ".  ( isset( $obj->{$fieldOrString} ) ? $obj->{$fieldOrString} : $fieldOrString) );
    }

    public static function edit($obj,$fieldOrString = 'name'){
        $name = explode('\\',get_class($obj)) ;
        $name = end($name);

        self::in('EDIT',"Edited $name:  {$obj->id}, ".  ( isset( $obj->{$fieldOrString} ) ? $obj->{$fieldOrString} : $fieldOrString) );
    }

    
    public static function remove($obj,$fieldOrString = 'name'){
        $name = explode('\\',get_class($obj)) ;
        $name = end($name);

        self::in('REMOVE',"Removed $name:  {$obj->id}, ".  ( isset( $obj->{$fieldOrString} ) ? $obj->{$fieldOrString} : $fieldOrString) );
    }
    
}