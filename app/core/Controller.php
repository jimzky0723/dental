<?php


class Controller
{
    protected $table;
    public function __construct(){
        $this->table = isset($_SESSION['table']) ? $_SESSION['table']: null;
    }

    public function records($table,$sub = null, $order='id',$sort='desc', $select=null, $join=null){
        if($select){
            $q = "SELECT $select from $table";
        }else{
            $q = "SELECT * from $table";
        }

        if($join){
            $q .= ' LEFT JOIN '.$join;
        }

        if($sub){
            $q = $q .' '.$sub;
        }
        $q = $q . " order by $order $sort";
        $rs = $this->db()->query($q);
        $data = array();
        if($rs){
            while($row = $rs->fetch_object()){
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function paginate($table,$limit=10,$page=1, $sub=null, $select=null, $join=null){
        $offset = ($page - 1) * $limit;
        if($select){
            $q = "SELECT $select from $table";
        }else{
            $q = "SELECT * from $table";
        }

        if($join){
            $q .= ' LEFT JOIN '.$join;
        }
        if($sub){
            $q = $q .' '.$sub;
        }
        $q = $q." LIMIT $limit OFFSET $offset";
        $rs = $this->db()->query($q);
        $data = array();
        if($rs){
            while($row = $rs->fetch_object()){
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function count($table,$sub=null, $select=null, $join=null){
        if($select){
            $q = "SELECT count($select) as count from $table";
        }else{
            $q = "SELECT count(*) as count from $table";
        }
        if($join){
            $q .= ' LEFT JOIN '.$join;
        }
        if($sub){
            $q = $q .' '.$sub;
        }
        $r = $this->db()->query($q);
        if($r){
            $row = $r->fetch_object();
            if($row){
                return $row->count;
            }else{
                return null;
            }

        }
        return 0;
    }


    public function save($table,$data){
        $var = array();
        $val = array();
        foreach($data as $key => $value):
            $var[] = $key;
            $val[] = "'".$value."'";
        endforeach;
        $new_var = implode(',',$var);
        $new_val = implode(',',$val);

        $q = "INSERT INTO $table ($new_var) values ($new_val)";
        $this->db()->query($q);
    }

    public function saveIgnore($table,$data){
        $var = array();
        $val = array();
        foreach($data as $key => $value):
            $var[] = $key;
            $val[] = "'".$value."'";
        endforeach;
        $new_var = implode(',',$var);
        $new_val = implode(',',$val);

        $q = "INSERT IGNORE $table ($new_var) values ($new_val)";
        $this->db()->query($q);
    }

    public function info($table,$id){
        $q = "SELECT * FROM $table where id=$id";
        $r = $this->db()->query($q);
        $row = $r->fetch_object();
        return $row;
    }

    public function moreInfo($table,$sub,$sort){
        $q = "SELECT * FROM $table ";
        $q .= $sub;
        $q .= " order by id $sort";
        $r = $this->db()->query($q);
        $row = $r->fetch_object();
        return $row;
    }

    public function update($table,$data){
        $c = count($data);
        $i = 3;
        $tmp = array();
        $q = "UPDATE $table SET ";
        foreach($data as $key => $value):

            if($key=='update' || $key=='delete' || $key=='currentID'){
                continue;
            }else{
                $tmp[] = $key.'="'.$value.'"';

            }
        endforeach;
        $value = implode(',',$tmp);
        $q .= "$value WHERE id=".$data['currentID']."";
        $this->db()->query($q);
    }

    public function compare($table,$data,$id=0){
        $tmp = '';
        $q = "SELECT * FROM $table WHERE ";
        foreach($data as $key => $value):
            if($key=='update' || $key=='delete' || $key=='currentID'){
                continue;
            }else{
                $tmp .= $key.'="'.$value.'" AND ';

            }
        endforeach;
        $q .= $tmp." id!=$id";
        $r = $this->db()->query($q);
        if($r->num_rows > 0){
            return true;
        }
        return false;
    }

    public function getID($table,$data){
        $tmp = '';
        $q = "SELECT id FROM $table WHERE ";
        foreach($data as $key => $value):
            if($key=='update' || $key=='delete' || $key=='currentID'){
                continue;
            }else{
                $tmp .= $key.'="'.$value.'" AND ';

            }
        endforeach;
        $q .= $tmp." id!=0";
        $r = $this->db()->query($q);
        if($r->num_rows > 0){
            $row = $r->fetch_object();
            return $row->id;
        }
        return 0;
    }

    public function delete($table,$id){
        $q = "DELETE FROM $table WHERE id=$id";
        $this->db()->query($q);
    }
    public function db(){
        $model = new Model();
        return $model->db();        
    }

    public function model($model)
    {
        require_once 'app/models/'. $model .'.php';
        return new $model();
    }
    
    public function view($view, $data = [])
    {
        require_once 'app/views/'.$view.'.php';
    }
    
    public function auth(){
        $url = new Config();
        if(!isset($_SESSION['auth'])){
            header('location:'.$url->base_url('login'));
        }
    }

    public function access(){
        $url = new Config();
        if($_SESSION['type']!='Admin'){
            return false;
        }
        return true;
    }

    public function log($act,$action=null){
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $user = $_COOKIE['id'];
        if($action=='login'){
            $user = null;
        }

        $data = array(
            'user' => $user,
            'activity' => $act,
            'ipaddress' => $ip
        );
        $_SESSION['table'] = 'tbllog';
        $this->save($data);

    }

    public function getValue($table,$result,$column, $value){
        $q = "select $result as result from $table where $column='$value'";
        $r = $this->db()->query($q);
        if($r->num_rows>0){
            //return $r;
            $row = $r->fetch_object();
            return $row->result;
        }
        return null;
    }

    public function getLastID($table,$order){
        $q = "select $order as result from $table order by $order desc limit 1";
        $r = $this->db()->query($q);
        if($r->num_rows>0){
            //return $r;
            $row = $r->fetch_object();
            return $row->result;
        }
        return null;
    }

}