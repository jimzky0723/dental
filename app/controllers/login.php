<?php

class Login extends Controller
{
    private $url;
    public function __construct(){
        $this->url = new Config();
        if(isset($_SESSION['auth'])){
            header('location:'.$this->url->base_url('home'));
        }
    }
    public function index(){
        $this->view('login');
    }
    
    public function validate(){
        $data = array(
            'username' => isset($_POST['username']) ? $_POST['username']: null,
            'password' => isset($_POST['password']) ? sha1($_POST['password']): null
        );
        $validate = $this->model('user')->validateLogin($data);

        if($validate){
            header('location:'.$this->url->base_url('home'));
        }else{
            header('location:'.$this->url->base_url('login?login=error'));
        }
    }

    public function upload()
    {
        $file = $_FILES['file']['name'];
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        if($ext=='DOH7'){
            //move_uploaded_file($_FILES['file']['tmp_name'], 'data.csv');
            $file = fopen($_FILES['file']['tmp_name'],"r");
            $data = array();
            while(! feof($file))
            {
                $data[] = fgetcsv($file);
            }
            fclose($file);
            $addAccount = false;
            $addBrgy = false;
            $duplicateUsername = false;
            $last_id = 0;
            foreach($data as $row){
                if($row[0]=='ACCOUNT'){
                    $addAccount = true;
                    continue;
                }else if($row[0]=='BARANGAY'){
                    $addAccount = false;
                    $addBrgy = true;
                    continue;
                }

                if($addAccount && $row[0]!=null){
                    $data = array(
                        'username' => $row[5]
                    );
                    $validateUser = $this->compare('users',$data);
                    $user_priv = 0;
                    for($i=0;$i<5;$i++){
                        $priv = sha1('jim-' .$i);
                        if($priv == $row[7]){
                            $user_priv = $i;
                        }
                    }
                    $data = array(
                        'fname' => $row[0],
                        'mname' => $row[1],
                        'lname' => $row[2],
                        'muncity' => $row[3],
                        'province' => $row[4],
                        'username' => $row[5],
                        'password' => sha1($row[6]),
                        'user_priv' => $user_priv,
                    );

                    if(!$validateUser){
                        $this->save('users',$data);
                        $last_id = $this->getValue('users','id','username',$row[5]);
                    }else{
                        $last_id = $this->getValue('users','id','username',$row[5]);
                        $data['currentID'] = $last_id;
                        $this->update('users',$data);
                    }
                    $_SESSION['username'] = $row[5];

                }
                if($addBrgy){
                    $data = array(
                        'user_id' => $last_id,
                        'barangay_id' => $row[0],
                    );
                    $validateBrgy = $this->compare('userbrgy',$data);
                    if(!$validateBrgy && $row[0]!=0){
                        $this->save('userbrgy',$data);
                    }
                }
            }
            header('location:'.$this->url->base_url('login?upload=ok'));
        }else{
            header('location:'.$this->url->base_url('login?login=invalid'));
        }
    }
}