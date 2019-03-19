<?php

class Population extends Controller
{
    public function __construct()
    {
        $this->auth();
    }

    public function index()
    {
        if($_POST){
            $_SESSION['profileKeyword'] = $_POST['keyword'];
        }

        if(isset($_POST['viewAll'])){
            unset($_SESSION['profileKeyword']);
        }
        $muncity_id = $this->getValue('users','muncity','id',$_SESSION['id']);

        $sub = 'WHERE profile.muncity_id = '.$muncity_id;

        if(isset($_SESSION['profileKeyword'])){
            $keyword = $_SESSION['profileKeyword'];
            $sub .= ' AND (profile.fname like "%'.$keyword.'%" OR profile.mname like "%'.$keyword.'%" OR profile.lname like "%'.$keyword.'%" OR profile.familyID like "%'.$keyword.'%")';
        }
        if($_SESSION['priv']==2){
            $tmp = 'where user_id = '.$_SESSION['id'];
            $tmpBrgy = $this->records('userbrgy',$tmp);
            $c = count($tmpBrgy);
            $i = 1;
            if($c > 0){
                $sub .= ' AND (';
                foreach($tmpBrgy as $row){
                    $sub .= ' profile.barangay_id = '.$row->barangay_id;
                    if($i<$c){
                        $sub .= ' OR';
                        $i++;
                    }
                }
                $sub .= ') ';
            }
        }
        $sub .= ' order by profile.lname asc';
        $page = 1;
        $limit = 25;
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        $select = 'profile.id, profile.fname, profile.mname,profile.lname, profile.sex, profile.dob, profile.head, profile.relation, profile.suffix, profile.barangay_id, profile.familyID';
        $data['population'] = $this->paginate('profile',$limit,$page,$sub,$select);
        $data['page'] = $page;
        $data['total'] = $this->count('profile',$sub);
        $data['limit'] = $limit;
        $data['main'] = 'population';
        $data['js'] = 'js/population';
        $this->view('layout',$data);
    }

    public function add($type,$familyID=null){
        $data['js'] = 'js/population';
        if($type=='head'){
            $data['main'] = 'profile/addHead';
            $this->view('layout',$data);
        }else if($type=='member'){
            $data['main'] = 'profile/member';
            $data['familyID'] = $familyID;
            $this->view('layout',$data);
        }
    }

    public function saveprofile($type){
        $config = new Config();
        $fname = ($_POST['fname']);
        $mname = ($_POST['mname']);
        $lname = ($_POST['lname']);
        $muncity_id = $this->getValue('users','muncity','id',$_SESSION['id']);
        $unique_id = $fname.''.$mname.''.$lname.''.$_POST['suffix'].''.$_POST['barangay_id'].''.$muncity_id;
        $familyID = $_POST['familyID'];
        $suffix = $_POST['suffix'];
        $dob = $_POST['dob'];
        $sex = $_POST['sex'];
        $brgy_id = $_POST['barangay_id'];
        $dateNow = $dateNow = date('Y-m-d H:i:s');
        $province_id = $this->getValue('users','province','id',$_SESSION['id']);
        $relation = $_POST['relation'];
        if($type=='head'){
            $q = "INSERT INTO profile(familyID, sex, unique_id, head, relation, fname,mname,lname,suffix,dob,barangay_id,muncity_id,province_id,created_at,updated_at)
                VALUES('$familyID','$sex','$unique_id','YES', 'Head', '".$fname."',
                '".$mname."','".$lname."','$suffix','".date('Y-m-d',strtotime($dob))."',
                '$brgy_id','$muncity_id','$province_id','$dateNow','$dateNow')
                ON DUPLICATE KEY UPDATE
                familyID = '$familyID',
                sex = '$sex'
            ";
        }else{
            $q = "INSERT INTO profile(familyID,sex,unique_id, head, relation, fname,mname,lname,suffix,dob,barangay_id,muncity_id,province_id, created_at, updated_at)
                VALUES('$familyID','$sex','$unique_id', 'NO', '$relation', '".$fname."',
                '".$mname."','".$lname."','$suffix','".date('Y-m-d',strtotime($dob))."',
                '$brgy_id','$muncity_id','$province_id','$dateNow','$dateNow')
            ON DUPLICATE KEY UPDATE
                familyID = '$familyID',
                sex = '$sex'
            ";
        }
        $data = array(
            'unique_id' => $unique_id
        );
        $check = $this->compare('profile',$data);
        if($check){
            $_SESSION['status'] = 'dataDuplicate';
        }else{
            $_SESSION['status'] = 'dataSaved';
            $this->db()->query($q);
        }
        if($type=='head'){
            header('location:'.$config->base_url('population/add/head'));
        }else{
            header('location:'.$config->base_url('population/add/member/' . $familyID));
        }
    }

    public function details()
    {
        $id = $_POST['currentID'];
        $_SESSION['toDelete'] = $id;
        $data['info'] = $this->info('profile',$id);
        $data['main'] = 'profile/update';
        $data['js'] = 'js/population';
        $this->view('layout',$data);
    }

    public function updateprofile()
    {
        echo '<pre>';
        $config = new Config();
        $head = $_POST['head'];
        if($head=='YES'){
            $_POST['relation'] = 'Head';
        }
        $fname = ($_POST['fname']);
        $mname = ($_POST['mname']);
        $lname = ($_POST['lname']);
        $muncity_id = $this->getValue('users','muncity','id',$_SESSION['id']);
        $unique_id = $fname.''.$mname.''.$lname.''.$_POST['suffix'].''.$_POST['barangay_id'].''.$muncity_id;

        $data = array(
            'unique_id' => $unique_id
        );
        $check = $this->compare('profile',$data,$_POST['currentID']);
        if(!$check){
            $data = array(
                'unique_id' => $unique_id,
                'head' => $_POST['head'],
                'fname' => $_POST['fname'],
                'mname' => $_POST['mname'],
                'lname' => $_POST['lname'],
                'suffix' => $_POST['suffix'],
                'dob' => $_POST['dob'],
                'sex' => $_POST['sex'],
                'barangay_id' => $_POST['barangay_id']
            );
            $muncity_id = $this->getValue('users','muncity','id',$_SESSION['id']);
            $data['relation'] = $_POST['relation'];
            $data['familyID'] = $_POST['familyID'];
            $data['muncity_id'] = $muncity_id;
            $data['province_id'] = $this->getValue('users','province','id',$_SESSION['id']);
            $data['currentID'] = $_POST['currentID'];
            $this->update('profile',$data);
            $_SESSION['status'] = 'dataUpdated';
            header('location:'.$config->base_url('population'));
        }else{
            $_SESSION['status'] = 'dataDuplicate';
            header('location:'.$config->base_url('population'));
        }
        print_r($_POST);
    }

    public function remove(){
        $config = new Config();
        $id = $_SESSION['toDelete'];
        unset($_SESSION['toDelete']);
        $this->delete('profile',$id);
        $_SESSION['status'] = 'dataRemoved';
        header('location:'.$config->base_url('population'));
    }

    public function member($id){

        $sub = "where familyID='$id'";
        $members = $this->records('profile',$sub,'fname');
        echo json_encode($members);
    }
}