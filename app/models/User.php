<?php


class User extends Model
{
    protected $table;

    public function __construct(){
        $this->table = 'users';
    }

    public function getName($id){
        if($id!=0){
            $q = "SELECT * FROM $this->table where id=$id";
            $r = $this->db()->query($q);
            $row = $r->fetch_object();
            return $row->fname.' '.$row->lname;
        }
        return false;
    }

    public function validateLogin($data){
        $user = $data['username'];
        $pass = $data['password'];
        $q = "select * from $this->table where username='$user' and password='$pass'";
        $r = $this->db()->query($q);
        if($r->num_rows==1){
            $row = $r->fetch_object();
            $_SESSION['auth'] = true;
            $_SESSION['priv'] = $row->user_priv;
            $_SESSION['id'] = $row->id;
            $_SESSION['name'] = $row->fname.' '.$row->lname;
            $_SESSION['fname'] = $row->fname;

            $controller = new Controller();
            $_SESSION['muncity'] = $controller->getValue('muncity','description','id',$row->muncity);
            $_SESSION['province'] = $controller->getValue('province','description','id',$row->province);
            return true;
        }else{
            return false;
        }
    }

    public function checkUsername($username){
        $q = "select * from $this->table where username='$username'";
        $r = $this->db()->query($q);
        if($r->num_rows > 0){
            return true;
        }else{
            return false;
        }
    }

    public function checkUsernameUpdate($username,$id){
        $q = "select * from $this->table where username='$username' AND id!=$id";
        $r = $this->db()->query($q);
        if($r->num_rows > 0){
            return true;
        }else{
            return false;
        }
    }

    public function getRecords(){
        $id = $_COOKIE['id'];
        $q = "select * from $this->table where id!=$id";
        $r = $this->db()->query($q);
        return $r;
    }

    public function getInfo($id){
        $c = new Controller();
        return $c->info('users',$id);
    }
}