<?php

use Jenssegers\Agent\Agent;
use App\Models\UserActivity;
use App\Models\AuthorActivity;
use App\Models\User;
use App\Models\Author;

if (!function_exists('GettingDevicesInformation')) {
    /**
     * Returns a human readable file size
     *
     * @param integer $bytes
     * Bytes contains the size of the bytes to convert
     *
     * @param integer $decimals
     * Number of decimal places to be returned
     *
     * @return string a string in human readable format
     *
     * */
    function GettingDevicesInformation($user_id,$user_type){
        $user;
        if($user_type == "User"){
            //REMİNDER burda bunları değişken şeklinde yapmayı dene
            $user = User::where("id","=",$user_id)->first();
        }else if($user_type == "Author"){
            $user = Author::where("id","=",$user_id)->first();
        }
        if($user){
            $agent = new Agent();
            $platform = $agent->platform();
            $browser = $agent->browser();
            $isDesktop = $agent->isDesktop();

            if($user_type == "User"){
                // Sendin Request::ip() to IP LOCATİON API
                $activity = new UserActivity;
                $activity->platform = $platform." ".$agent->version($platform);
                $activity->browser = $browser." ".$agent->version($browser);
                if($isDesktop){
                    $activity->device = "Web";
                }else{
                    $activity->device = $agent->device();
                }

                $activity->ip_address = \Request::ip();
                $activity->user_id = $user->id;
                $activity->save();
            }else if($user_type == "Author"){
                // Sendin Request::ip() to IP LOCATİON APİ

                $activity = new AuthorActivity;
                $activity->platform = $platform." ".$agent->version($platform);
                $activity->browser = $browser." ".$agent->version($browser);
                if($isDesktop){
                    $activity->device = "Web";
                }else{
                    $activity->device = $agent->device();
                }

                $activity->ip_address = \Request::ip();
                $activity->user_id = $user->id;
                $activity->save();
            }
        }
    }
}


?>
