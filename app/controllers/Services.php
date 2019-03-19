<?php

class Services extends Controller {

    public function __construct()
    {
        $this->auth();
    }

    public function index($id=null)
    {
        if($_POST){
            $_SESSION['profileKeyword'] = $_POST['profileKeyword'];
            $_SESSION['dateProfile'] = $_POST['date'];
        }

        $muncity_id = $this->getValue('users','muncity','id',$_SESSION['id']);

        $sub = 'WHERE muncity_id = '.$muncity_id;

        if(isset($_SESSION['profileKeyword'])){
            $keyword = $_SESSION['profileKeyword'];
            $sub .= ' AND (fname like "%'.$keyword.'%" OR mname like "%'.$keyword.'%" OR lname like "%'.$keyword.'%" OR familyID like "%'.$keyword.'%")';
        }
        if($_SESSION['priv']==2){
            $tmp = 'where user_id = '.$_SESSION['id'];
            $tmpBrgy = $this->records('userbrgy',$tmp);
            $c = count($tmpBrgy);
            $i = 1;
            if($c > 0){
                $sub .= ' AND (';
                foreach($tmpBrgy as $row){
                    $sub .= ' barangay_id = '.$row->barangay_id;
                    if($i<$c){
                        $sub .= ' OR';
                        $i++;
                    }
                }
                $sub .= ') ';
            }
        }
        $sub .= ' order by lname asc';
        $page = 1;
        $limit = 10;
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        $data['population'] = $this->paginate('profile',$limit,$page,$sub);

        $data['page'] = $page;
        $data['total'] = $this->count('profile',$sub);
        $data['limit'] = $limit;
        $data['js'] = 'js/services';
        $data['main'] = 'services';
        $data['bracket'] = null;
        $data['id'] = $id;
        if($this->validateID($id)){
            $data['bracket'] = $this->bracketServices($id);
        }
        $this->view('layout',$data);
    }

    public function oral($id=null)
    {
        if($_POST){
            $_SESSION['profileKeyword'] = $_POST['profileKeyword'];
            $_SESSION['dateProfile'] = $_POST['date'];
        }

        $muncity_id = $this->getValue('users','muncity','id',$_SESSION['id']);

        $sub = 'WHERE muncity_id = '.$muncity_id;

        if(isset($_SESSION['profileKeyword'])){
            $keyword = $_SESSION['profileKeyword'];
            $sub .= ' AND (fname like "%'.$keyword.'%" OR mname like "%'.$keyword.'%" OR lname like "%'.$keyword.'%" OR familyID like "%'.$keyword.'%")';
        }
        if($_SESSION['priv']==2){
            $tmp = 'where user_id = '.$_SESSION['id'];
            $tmpBrgy = $this->records('userbrgy',$tmp);
            $c = count($tmpBrgy);
            $i = 1;
            if($c > 0){
                $sub .= ' AND (';
                foreach($tmpBrgy as $row){
                    $sub .= ' barangay_id = '.$row->barangay_id;
                    if($i<$c){
                        $sub .= ' OR';
                        $i++;
                    }
                }
                $sub .= ') ';
            }
        }
        $sub .= ' order by lname asc';
        $page = 1;
        $limit = 10;
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        $data['population'] = $this->paginate('profile',$limit,$page,$sub);

        $data['page'] = $page;
        $data['total'] = $this->count('profile',$sub);
        $data['limit'] = $limit;
        $data['js'] = 'js/services';
        $data['main'] = 'oralservices';
        $data['bracket'] = null;
        $data['id'] = $id;
        if($this->validateID($id)){
            $data['bracket'] = $this->bracketServices($id);
        }
        $this->view('layout',$data);
    }
    public function validateID($id){
        $muncity_id = $this->getValue('users','muncity','id',$_SESSION['id']);
        $sub = 'WHERE muncity_id = '.$muncity_id;
        if($_SESSION['priv']==2){
            $tmp = 'where user_id = '.$_SESSION['id'];
            $tmpBrgy = $this->records('userbrgy',$tmp);
            $c = count($tmpBrgy);
            $i = 1;
            if($c > 0){
                $sub .= ' AND (';
                foreach($tmpBrgy as $row){
                    $sub .= ' barangay_id = '.$row->barangay_id;
                    if($i<$c){
                        $sub .= ' OR';
                        $i++;
                    }
                }
                $sub .= ') ';
            }
        }
        $sub .= ' AND id='.$id;
        $check = $this->count('profile',$sub);
        if($check > 0){
            return true;
        }
        return false;
    }

    public function bracketServices($id){
        $option = null;
        $param = new Parameter();
        $dob = $this->getValue('profile','dob','id',$id);
        $brgy_id = $this->getValue('profile','barangay_id','id',$id);
        $age = $param->getAge($dob);
        if($age==0){
            $age = $param->getAgeMonth($dob).' M/o';
            $option = 'B';
            if($age==0){
                $option = 'A';
                $age = $param->getAgeDay($dob).' D/o';
                if($age>=28){
                    $option = 'B';
                }
            }
        }
        $bracket_id = 0;
        if($option=='A'){
            $bracket_id = 1;
        }else if($option=='B'){
            $bracket_id = 2;
        }else if($age >= 1 && $age <= 5){
            $bracket_id = 3;
        }else if($age >= 6 && $age <= 9){
            $bracket_id = 4;
        }else if($age >= 10 && $age <= 19){
            $bracket_id = 5;
        }else if($age >= 20 && $age <= 49){
            $bracket_id = 6;
        }else if($age >= 50 && $age <= 59){
            $bracket_id = 7;
        }else if($age >= 60){
            $bracket_id = 8;
        }

        $q = "SELECT services.id,services.description
            left join bracketservices on services.id=bracketservices.service_id
            left join brackets on bracketservices.bracket_id = brackets.id
            where brackets.id = ".$bracket_id."
            ";
        $rs = $this->db()->query($q);
        $services = array();
        if($rs){
            while($row = $rs->fetch_object()){
                $services[] = $row;
            }
        }
        $data = array(
            'services' => $services,
            'age' => $age,
            'dob' => $dob,
            'id' => $id,
            'brgy_id' => $brgy_id,
            'bracket_id' => $bracket_id,
            'dob' => $dob
        );
        return $data;
    }

    public function add()
    {
        echo '<pre>';
        print_r($_POST);

        $date = date('Y-m-d',strtotime($_POST['date']));
        $profileID = $_POST['profileID'];
        $brgy_id = $_POST['brgy_id'];
        $muncity_id = $this->getValue('barangay','muncity_id','id',$brgy_id);
        $bracket_id = $_POST['bracket_id'];
        if(isset($_POST['services'])):
        for($i=0; $i<count($_POST['services']); $i++)
        {
            $s = $_POST['services'];

            $data = array(
                'profile_id' => $profileID,
                'service_id' => $s[$i],
                'bracket_id' => $bracket_id,
                'barangay_id' => $brgy_id,
                'muncity_id' => $muncity_id,
                'dateProfile' => $date,
            );
            $validateService = $this->compare('profileservices',$data);
            if(!$validateService){
                $this->save('profileservices',$data);

                $code = $this->getValue('services','code','id',$s[$i]);
                if($_POST['femalestatus']){
                    $sex = "Female";
                    if($_POST['femalestatus']=='male'){
                        $sex = "Male";
                    }
                    $update = array(
                        'sex' => $sex,
                        'currentID' => $profileID
                    );
                    $this->update('profile',$update);

                    $data = array(
                        'dateProfile' => $date,
                        'profile_id' => $profileID,
                        'barangay_id' => $brgy_id,
                        'muncity_id' => $muncity_id,
                        'status' => $_POST['femalestatus'],
                        'code' => $code,
                    );
                    $check = $this->compare('femalestatus',$data);
                    if(!$check){
                        $this->save('femalestatus',$data);
                    }
                }
            }
        }
        endif;
        if(isset($_POST['cases'])) :
        for($i=0; $i<count($_POST['cases']); $i++)
        {
            $s = $_POST['cases'];
            $validCase = array(
                'dateProfile' => $date,
                'profile_id' => $profileID,
                'barangay_id' => $brgy_id,
                'muncity_id' => $muncity_id,
                'bracket_id' => $bracket_id,
                'case_id' => $s[$i],
            );
            $check = $this->compare('profilecases',$validCase);
            if(!$check){
                $this->save('profilecases',$validCase);
            }
        }
        endif;

        $validOption = array(
            'dateProfile' => $date,
            'profile_id' => $profileID,
            'barangay_id' => $brgy_id,
            'muncity_id' => $muncity_id
        );
        if(isset($_POST['weight'])){
            $validOption['status'] = $_POST['weight'];
            $validOption['serviceoption.option'] = 'weight';
            $check = $this->compare('serviceoption',$validOption);
            if(!$check) {
                $this->save('serviceoption',$validOption);
            }
        }

        if(isset($_POST['height'])){
            $validOption['status'] = $_POST['height'];
            $validOption['serviceoption.option'] = 'height';
            $check = $this->compare('serviceoption',$validOption);
            if(!$check){
                $this->save('serviceoption',$validOption);
            }
        }

        if(isset($_POST['bp'])){

            $validOption['status'] = $_POST['bp'];
            $validOption['serviceoption.option'] = 'bp';

            $check = $this->compare('serviceoption',$validOption);
            if(!$check){
                $this->save('serviceoption',$validOption);
            }
        }
        $_SESSION['status'] = 'serviceAdded';
        $config = new Config();
        header('location:'.$config->base_url('services'));
    }

    public function oral_exam($type=null)
    {
        echo '<pre>';
        $config = new Config();
        $muncity_id = $this->getValue('profile','muncity_id','id',$_POST['profile_id']);
        $doctor_id = isset($_SESSION['doctor_id']) ? $_SESSION['doctor_id'] : 0;
        $data = array(
            'dateProfile' => date('Ymd',strtotime($_POST['date'])),
            'profile_id' => $_POST['profile_id'],
            'doctor_id' => $doctor_id,
            'bracket_id' => $_POST['bracket_id'],
            'barangay_id' => $_POST['barangay_id'],
            'muncity_id' => $muncity_id,
            'tooth_no' => $_POST['tooth_no'],
            'female_status' => $_POST['female_status'],
            'code' => $_POST['code'],
            'status' => $_POST['status']
        );
        $profile_id = $_POST['profile_id'];
        $tooth_no = $_POST['tooth_no'];
        $sub = "where profile_id=$profile_id and tooth_no=$tooth_no";

        $rec = $this->records('oral_exam',$sub);
        foreach($rec as $row):
            $this->delete('oral_exam',$row->id);
        endforeach;

        if($_POST['status']==='code_Normal'){
            $profile_id = $_POST['profile_id'];
            $tooth_no = $_POST['tooth_no'];
            $sub = "where profile_id=$profile_id and tooth_no=$tooth_no";

            $rec = $this->records('oral_exam',$sub);
            foreach($rec as $row):
                $this->delete('oral_exam',$row->id);
            endforeach;
            header('Location:'.$config->base_url('services/'.$_POST['profile_id']));
        }else{
            if($_POST['status']==='code_M'|| $_POST['status']==='code_UE'){
                $data['code'] = 'missing';
            }else if($_POST['status']==='code_RF'){
                $data['code'] = 'root_fragment';
            }else if($_POST['status']==='code_RF'){
                $data['code'] = 'root_fragment';
            }else if($_POST['status']==='code_RCT'){
                $data['code'] = '00001';
            }else if($_POST['status']==='code_CR'){
                $data['code'] = '11111';
            }
            $data['unique_id'] = implode('', $data);
            $this->saveIgnore('oral_exam',$data);
            if($type=='services'){
                $data = array(
                    'dateProfile' => date('Ymd',strtotime($_POST['date'])),
                    'profile_id' => $_POST['profile_id'],
                    'doctor_id' => $doctor_id,
                    'bracket_id' => $_POST['bracket_id'],
                    'barangay_id' => $_POST['barangay_id'],
                    'muncity_id' => $muncity_id,
                    'service' => $_POST['status'],
                    'tooth_no' => $_POST['tooth_no'],
                    'female_status' => $_POST['female_status']
                );
                $data['unique_id'] = implode('', $data);
                $this->saveIgnore('oral_health_service',$data);
                print_r($data);
                header('Location:'.$config->base_url('services/oral/'.$_POST['profile_id']));
            }else{
                header('Location:'.$config->base_url('services/'.$_POST['profile_id']));
            }
        }
    }

    public function health_status()
    {
        echo '<pre>';
        $config = new Config();
        $muncity_id = $this->getValue('profile','muncity_id','id',$_POST['profile_id']);
        $doctor_id = isset($_SESSION['doctor_id']) ? $_SESSION['doctor_id'] : 0;
        $data = array(
            'dateProfile' => date('Ymd',strtotime($_POST['date'])),
            'profile_id' => $_POST['profile_id'],
            'doctor_id' => $doctor_id,
            'bracket_id' => $_POST['bracket_id'],
            'barangay_id' => $_POST['barangay_id'],
            'muncity_id' => $muncity_id,
            'female_status' => $_POST['female_status']
        );

        $status = $_POST['status'];
        if(count($status)){
            foreach($status as $row){
                $data['unique_id'] = null;
                $data['status'] = $row;
                $data['unique_id'] = implode('', $data);
                $this->saveIgnore('oral_health_status',$data);
            }
        }
        header('Location:'.$config->base_url('services/'.$_POST['profile_id']));
    }

    public function select_doctor()
    {
        $config = new Config();
        $_SESSION['doctor_id'] = $_POST['doctor_id'];
        header('Location:'.$config->base_url('services'));
    }

    public function oral_services()
    {
        echo '<pre>';
        $config = new Config();
        $muncity_id = $this->getValue('profile','muncity_id','id',$_POST['profile_id']);
        $doctor_id = isset($_SESSION['doctor_id']) ? $_SESSION['doctor_id'] : 0;
        $data = array(
            'dateProfile' => date('Ymd',strtotime($_POST['date'])),
            'profile_id' => $_POST['profile_id'],
            'doctor_id' => $doctor_id,
            'bracket_id' => $_POST['bracket_id'],
            'barangay_id' => $_POST['barangay_id'],
            'muncity_id' => $muncity_id,
            'female_status' => $_POST['female_status']
        );
        if(count($_POST['status'])){
            foreach($_POST['status'] as $row){
                $data['unique_id'] = null;
                $data['service'] = $row;
                $data['unique_id'] = implode('',$data);
                $this->saveIgnore('oral_health_service',$data);
            }
        }
        if($_POST['others']){
            $data['remarks'] = null;
            $data['unique_id'] = null;
            $data['service'] = 'others';
            $data['unique_id'] = implode('',$data);
            $data['remarks'] = $_POST['others'];
            $this->saveIgnore('oral_health_service',$data);
        }

        if($_POST['reffered']){
            $data['remarks'] = null;
            $data['unique_id'] = null;
            $data['service'] = 'reffered';
            $data['unique_id'] = implode('',$data);
            $data['remarks'] = $_POST['reffered'];
            $this->saveIgnore('oral_health_service',$data);
        }

        if($_POST['ofc']){
            $data['remarks'] = null;
            $data['unique_id'] = null;
            $data['service'] = 'ofc';
            $data['unique_id'] = implode('',$data);
            $data['remarks'] = $_POST['ofc'];
            $this->saveIgnore('oral_health_service',$data);
        }
        header('Location:'.$config->base_url('services/oral/'.$_POST['profile_id']));
        //print_r($data);


    }

    public function remove($table,$id=0,$profile_id=0){
        $config = new Config();
        if($table=='healthStatus'){
            $this->delete('oral_health_status',$id);
            header('location:' . $config->base_url('services/'.$profile_id));
        }else if($table=='oralservices'){
            $this->delete('oral_health_service',$id);
            header('location:' . $config->base_url('services/oral/'.$profile_id));
        }
    }
}