<?php

    if (! function_exists('keyword')) {
    function Langkeyword()
    {
        if(session('locale')=="ar"){
            return "ar_";
        }else{
            return "";
        }
    }
}
