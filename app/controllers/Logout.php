<?php

class Logout extends Controller
{
    function index(){
        session_destroy();
        $url = new Config();
        header("location:".$url->base_url('login'));
    }
}