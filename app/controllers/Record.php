<?php

class Record extends Controller
{
    public function __construct()
    {
        $this->auth();
    }

    public function index()
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

            $addProfile = 0;
            $addService = 0;
            $addCase = 0;
            $addStatus = 0;
            $addServiceOption = 0;

            foreach($data as $row){

                if($row[0]=='PROFILE')
                {
                    $addProfile++;
                    continue;
                }else if($row[0]=='SERVICES'){
                    $addProfile = 0;
                    $addService++;
                    continue;
                }else if($row[0]=='CASES'){
                    $addService = 0;
                    $addCase++;
                    continue;
                }else if($row[0]=='STATUS'){
                    $addCase = 0;
                    $addStatus++;
                    continue;
                }else if($row[0]=='SERVICE OPTION'){
                    $addStatus = 0;
                    $addServiceOption++;
                    continue;
                }

                if($row[0]=='FAMILY ID' && $addProfile==1){
                    $addProfile++;
                    continue;
                }else if($row[0]=='DATE CREATED' && $addService==1){
                    $addService++;
                    continue;
                }else if($row[0]=='DATE CREATED' && $addStatus==1){
                    $addStatus++;
                    continue;
                }else if($row[0]=='DATE CREATED' && $addCase==1){
                    $addCase++;
                    continue;
                }else if($row[0]=='DATE CREATED' && $addServiceOption==1){
                    $addServiceOption++;
                    continue;
                }
                $dateNow = date('Y-m-d H:i:s');
                if($addProfile==2 && $row[0]!=null){
                    $fname = html_entity_decode(htmlentities($row[3]));
                    $mname = html_entity_decode(htmlentities($row[4]));
                    $lname = html_entity_decode(htmlentities($row[5]));
                    $unique_id = $fname.''.$mname.''.$lname.''.$row[6].''.$row[9].''.$row[10];
                    $q = "INSERT INTO profile(unique_id, familyID, head, relation, fname,mname,lname,suffix,dob,sex,barangay_id,muncity_id,province_id,created_at,updated_at)
                            VALUES('$unique_id', '$row[0]','$row[1]', '$row[2]', '".$fname."',
                            '".$mname."','".$lname."','$row[6]','".date('Y-m-d',strtotime($row[7]))."','$row[8]',
                            '$row[9]','$row[10]','$row[11]','$dateNow','$dateNow')
                            ON DUPLICATE KEY UPDATE
                                familyID = '$row[0]',
                                sex = '$row[8]',
                                relation = '$row[2]',
                                head = '$row[1]'
                        ";
                    $this->db()->query($q);

                }
                if($addService==2 && $row[0]!=null){
                    $fname = html_entity_decode(htmlentities($row[1]));
                    $mname = html_entity_decode(htmlentities($row[2]));
                    $lname = html_entity_decode(htmlentities($row[3]));
                    $profile_id = $fname.''.$mname.''.$lname.''.$row[4].''.$row[7].''.$row[8];
                    $unique_id = date('mdY',strtotime($row[0])).''.$profile_id.''.$row[6].''.$row[5];
                    $q = "INSERT IGNORE profileservices(unique_id, dateProfile, profile_id, service_id, bracket_id, barangay_id, muncity_id,created_at,updated_at)
                            VALUES('$unique_id','$row[0]', '$profile_id', '$row[5]', '$row[6]', '$row[7]', '$row[8]','$dateNow','$dateNow')
                        ";
                    $this->db()->query($q);
                }

                if($addCase==2 && $row[0]!=null){
                    $fname = html_entity_decode(htmlentities($row[1]));
                    $mname = html_entity_decode(htmlentities($row[2]));
                    $lname = html_entity_decode(htmlentities($row[3]));
                    $profile_id = $fname.''.$mname.''.$lname.''.$row[4].''.$row[7].''.$row[8];
                    $unique_id = date('mdY',strtotime($row[0])).''.$profile_id.''.$row[6].''.$row[5];
                    $q = "INSERT IGNORE profilecases(unique_id, dateProfile, profile_id, case_id, bracket_id, barangay_id, muncity_id,created_at,updated_at)
                            VALUES('$unique_id', '$row[0]', '$profile_id', '$row[5]', '$row[6]', '$row[7]', '$row[8]','$dateNow','$dateNow')
                        ";
                    $this->db()->query($q);
                }

                if($addStatus==2 && $row[0]!=null){
                    $fname = html_entity_decode(htmlentities($row[1]));
                    $mname = html_entity_decode(htmlentities($row[2]));
                    $lname = html_entity_decode(htmlentities($row[3]));
                    $profile_id = $fname.''.$mname.''.$lname.''.$row[4].''.$row[7].''.$row[8];
                    $unique_id = date('mdY',strtotime($row[0])).''.$profile_id.''.$row[5].''.$row[6];
                    $q = "INSERT IGNORE femalestatus(unique_id, dateProfile, profile_id, status, code, barangay_id, muncity_id,created_at,updated_at)
                            VALUES('$unique_id', '$row[0]', '$profile_id', '$row[5]', '$row[6]', '$row[7]', '$row[8]','$dateNow','$dateNow')
                        ";
                    $this->db()->query($q);
                }

                if($addServiceOption==2 && $row[0]!=null){
                    $fname = html_entity_decode(htmlentities($row[1]));
                    $mname = html_entity_decode(htmlentities($row[2]));
                    $lname = html_entity_decode(htmlentities($row[3]));
                    $profile_id = $fname.''.$mname.''.$lname.''.$row[4].''.$row[7].''.$row[8];
                    $unique_id = date('mdY',strtotime($row[0])).''.$profile_id.''.$row[5].''.$row[6];
                    $q = "INSERT IGNORE serviceoption(unique_id, dateProfile, profile_id, serviceoption.option, serviceoption.status, barangay_id, muncity_id,created_at,updated_at)
                            VALUES('$unique_id', '$row[0]', '$profile_id', '$row[5]', '$row[6]', '$row[7]', '$row[8]','$dateNow','$dateNow')
                        ";
                    $this->db()->query($q);
                }
            }
        }else{
            echo 'Invalid';
        }
        $config = new Config();

        $_SESSION['status'] = 'dataAdded';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        //header('location:'.$config->base_url('population'));
    }

    public function getFamilyID($row){
        $data = array(
            'muncity_id' => $row[10],
            'description' => $row[0]
        );
        $check = $this->compare('familyprofile',$data);
        if(!$check){
            $this->save('familyprofile',$data);
            return $this->getID('familyprofile',$data);
        }

        return $this->getID('familyprofile',$data);
    }

    public function getProfileID($row)
    {
        $data = array(
            'fname' => $row[1],
            'mname' => $row[2],
            'lname' => $row[3],
            'suffix' => $row[4],
            'barangay_id' => $row[7],
            'muncity_id' => $row[8],
        );
        return $this->getID('profile',$data);
    }

    public function download()
    {
        $year = $_POST['year'];
        $month = $_POST['month'];
        $start = $year.'-'.$month.'-01';
        $time = strtotime($start);
        $end = date("Y-m-d", strtotime("+1 month", $time));
        $user = $this->info('users',$_SESSION['id']);
        $tmpMonth = date('M',strtotime($start));
        $filename = $user->username.'-OFFLINE-'.$tmpMonth.'-'.date('Y-m-d');

        $sub = "WHERE muncity_id=".$user->muncity;
        $sub .= " AND created_at >= '$start'";
        $sub .= " AND created_at <= '$end'";

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
            }else{
                $sub .= 'id!=0';
            }
        }
        $profile = $this->records('profile',$sub);


        $sub = "WHERE muncity_id=$user->muncity";
        $sub .= " AND created_at >= '$start'";
        $sub .= " AND created_at <= '$end'";
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
            }else{
                $sub .= 'id!=0';
            }
        }
        $profileservices = $this->records('profileservices',$sub);

        $sub = "WHERE muncity_id=$user->muncity";
        $sub .= " AND created_at >= '$start'";
        $sub .= " AND created_at <= '$end'";
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
            }else{
                $sub .= 'id!=0';
            }
        }
        $profilecases = $this->records('profilecases',$sub);

        $sub = "WHERE muncity_id=$user->muncity";
        $sub .= " AND created_at >= '$start'";
        $sub .= " AND created_at <= '$end'";
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
            }else{
                $sub .= 'id!=0';
            }
        }
        $femalestatus = $this->records('femalestatus',$sub);


        $sub = "WHERE muncity_id=$user->muncity";
        $sub .= " AND created_at >= '$start'";
        $sub .= " AND created_at <= '$end'";
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
            }else{
                $sub .= 'id!=0';
            }
        }
        $serviceoption = $this->records('serviceoption',$sub);


        $data = array(
            'filename' => $filename,
            'profile' => $profile,
            'profileservices' => $profileservices,
            'profilecases' => $profilecases,
            'femalestatus' => $femalestatus,
            'serviceoption' => $serviceoption,
        );
        $this->view('report/download',$data);
    }
}