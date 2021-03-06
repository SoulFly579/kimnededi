<?php

use Illuminate\Support\Carbon;
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
    function GettingDevicesInformation($user_id,$user_type)
    {

        if($user_type == "User"){
            //REMİNDER burda bunları değişken şeklinde yapmayı dene
            $user = User::where("id","=",$user_id)->first();
        }else if($user_type == "Author"){
            $user = Author::where("id","=",$user_id)->first();
        }
        if($user){
            $agent = new Agent();
            $platform = $agent->platform();
            // Ubuntu, Windows, OS X, ...
            $browser = $agent->browser();
            // Chrome, IE, Safari, Firefox, ...
            if($user_type == "User"){
                $activity = new UserActivity;
                $activity->platform = $platform;
                $activity->browser = $browser;
                $activity->device = $agent->device();
                $activity->ip_address = \Request::ip();
                $activity->user_id = $user->id;
                $activity->save();
            }else if($user_type == "Author"){
                $activity = new AuthorActivity;
                $activity->platform = $platform;
                $activity->browser = $browser;
                $activity->device = $agent->device();
                $activity->ip_address = \Request::ip();
                $activity->user_id = $user->id;
                $activity->save();
            }
        }
    }
}
if (!function_exists('PercentageRatioCalculation')) {
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
    function PercentageRatioCalculation($like,$dislike)
    {
        if($like <= 0){
            return "%0";
        }else if($dislike <= 0 ){
            return "%100";
        }else{
            $rate = $like+$dislike;
            $percentageRatio = ($like*100)/$rate;
            return (int)$percentageRatio;
        }
    }

    function PrecentageRatioCalculationForArticles($allArticles,$selfArticles){
        if($allArticles->count() <= 0){
            return "%0";
        }else if($selfArticles->count() == $allArticles->count()){
            return "%100";
        }else{
            $percentageRatio = ($selfArticles->count()*100)/$allArticles->count();
            return (int)$percentageRatio;
        }
    }

    function PrecentageRatioCalculationForLike($allLikes,$allDislikes){
        if($allLikes->count() <= 0){
            return "%0";
        }else if($allDislikes->count() <= 0){
            return "%100";
        }else{
            $percentageRatio = ($allLikes->count()*100)/$allDislikes->count();
            return (int)$percentageRatio;
        }
    }
}

?>
