<?php // Code within app\Helpers\Helper.php

namespace App\Helper;

use Pusher\Pusher;
class AssetHelper
{

    public static function FileSave($fileName,$folderName){

        if($fileName){
            $dir = 'uploads/'.$folderName.'/';
            $file = $fileName;
            $name = sha1(microtime()) . "." . $file->extension();
            $file->move($dir,$name);
            return $dir.$name;
            
        }
    }


    public static function Notification($userid){

        $options = array(
            'cluster' => 'ap2',
            'useTLS' => true
        );


        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );


        $data = ['from' => $userid];
        $pusher->trigger('my-channel', 'my-event', $data);
    }

    public static function selected($routeName, $parameters = [], $class = 'active')
        {
            if (!route_has($routeName)) {
                return '';
            }
    
            return '/' . request()->path() == route($routeName, $parameters, false) ? $class : '';
        }

}