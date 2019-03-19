<?php

class Config
{
    public function base_url($url)
    {
        return 'http://'.$_SERVER['HTTP_HOST'].'/native/tsekap2/'.$url;
    }
}