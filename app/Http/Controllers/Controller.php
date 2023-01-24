<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function embed($link = '')
    {

        if (strpos($link, 'youtube.com')) {
            $link_arry = explode("&t",$link);
            $embed_link = str_replace("watch?v=", "embed/", $link_arry[0]);
            return $embed_link;
        } else if(strpos($link, 'vimeo.com')){
            $embed_link = str_replace("vimeo.com/", "player.vimeo.com/video/", $link);
            return $embed_link;
        }
        else if(strpos($link, 'youtu.be')){
            $embed_link = str_replace("youtu.be/", "youtube.com/embed/", $link);
            return $embed_link;
        }
        else {
            return $link;
        }
    }
}
