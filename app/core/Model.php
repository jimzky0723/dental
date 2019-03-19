<?php

class Model
{
    public function db()
    {
        $host = "localhost";
        $user = "root";
        $pass = "";
        $db = "doh_tsekap_offline_v2";
        $port ="3306";

        return $con = mysqli_connect($host,$user,$pass,$db,$port);
    }
}