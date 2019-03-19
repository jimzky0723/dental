<?php

class Password extends Controller
{
    public function __construct()
    {
        $this->auth();
    }

    public function index()
    {
        $data['js'] = 'js/password';
        $data['main'] = 'password';
        $this->view('layout',$data);
    }

    public function change()
    {
        $current = sha1($_POST['current']);
        $id = $_SESSION['id'];
        $try = isset($_SESSION['tryPass']) ? $_SESSION['tryPass']:0;
        $password = $this->getValue('users','password','id',$id);
        if($current == $password) {
            if($_POST['new']==$_POST['confirm']){
                $update = array(
                    'password' => sha1($_POST['new']),
                    'currentID' => $id,
                );
                $this->update('users',$update);
                $_SESSION['status'] = 'updated';
                $_SESSION['tryPass'] = 0;
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }else{
                $_SESSION['status'] = 'notsame';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        } else {

            if($try>1){
                $config = new Config();
                header('Location:'.$config->base_url('logout'));
            }else{
                $_SESSION['status'] = 'incorrect';
                $_SESSION['tryPass'] += 1;
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        }
    }
}