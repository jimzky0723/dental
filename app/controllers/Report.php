<?php

class Report extends Controller {

    public function __construct()
    {
        $this->auth();
    }

    public function index()
    {
        $keyword = array(
            'daterange' => null,
            'bracket_id' => null,
            'barangay_id' => null,
            'service_id' => null,
            'name' => null,
        );
        if($_POST){
            $_SESSION['filterResult'] = $_POST;
        }

        if(isset($_SESSION['filterResult'])){
            $keyword = $_SESSION['filterResult'];
        }

        $daterange = $keyword['daterange'];
        $bracket_id = $keyword['bracket_id'];
        $barangay_id = $keyword['barangay_id'];
        $service_id = $keyword['service_id'];
        $name = $keyword['name'];

        $startdate = date('Y-m-d', strtotime('today - 30 days'));
        $enddate = date('Y-m-d');

        if($daterange){
            $temp1 = explode('-',$daterange);
            $temp2 = array_slice($temp1, 0, 1);
            $tmp = implode(',', $temp2);
            $startdate = date('Y-m-d',strtotime($tmp));

            $temp3 = array_slice($temp1, 1, 1);
            $tmp = implode(',', $temp3);
            $enddate = date('Y-m-d',strtotime($tmp));
        }else{
            $daterange = date('m/d/Y',strtotime($startdate)).' - '.date('m/d/Y',strtotime($enddate));
        }

        $q2 = "
            SELECT profileservices.profile_id FROM profileservices
            LEFT JOIN profile on profileservices.profile_id=profile.id
            WHERE profileservices.dateProfile >= '$startdate'
            AND  profileservices.dateProfile <= '$enddate'
            AND (
                    profile.fname like '%$name%' OR
                    profile.mname like '%$name%' OR
                    profile.lname like '%$name%'
                )
        ";

        $join = "profile on profileservices.profile_id = profile.id";
        $select = "profileservices.profile_id,profileservices.service_id,profileservices.barangay_id,profileservices.id,profileservices.dateProfile";
        $sub = "where profileservices.dateProfile >= '$startdate'
                AND profileservices.dateProfile <= '$enddate'
                AND (
                    profile.fname like '%$name%' OR
                    profile.mname like '%$name%' OR
                    profile.lname like '%$name%'
                )";

        if($service_id){
            $sub .= " AND profileservices.service_id=".$service_id;
            $q2 .= " AND profileservices.service_id=".$service_id;
        }
        if($bracket_id){
            $sub .= " AND profileservices.bracket_id=".$bracket_id;
            $q2 .= " AND profileservices.bracket_id=".$bracket_id;
        }
        if($barangay_id){
            $sub .= " AND profileservices.barangay_id=".$barangay_id;
            $q2 .= " AND profileservices.barangay_id=".$barangay_id;
        }

        $muncity_id = $this->getValue('users','muncity','id',$_SESSION['id']);
        $sub .= " AND profileservices.muncity_id=".$muncity_id;
        $q2 .= " AND profileservices.muncity_id=".$muncity_id;

        if($_SESSION['priv']==2){
            $tmp = 'where user_id = '.$_SESSION['id'];
            $tmpBrgy = $this->records('userbrgy',$tmp);
            $c = count($tmpBrgy);
            $i = 1;
            if($c > 0){
                $sub .= ' AND (';
                $q2 .= ' AND (';
                foreach($tmpBrgy as $row){
                    $sub .= ' profileservices.barangay_id = '.$row->barangay_id;
                    $q2 .= ' profileservices.barangay_id = '.$row->barangay_id;
                    if($i<$c){
                        $sub .= ' OR';
                        $q2 .= ' OR';
                        $i++;
                    }
                }
                $sub .= ') ';
                $q2 .= ') ';
            }
        }

        $page = 1;
        $limit = 15;
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }

        $sub .= ' order by dateProfile desc, profile_id asc';

        $profiles = $this->paginate('profileservices',$limit,$page,$sub,$select,$join);

        $rs2 = $this->db()->query($q2);
        $tmp = array();
        if($rs2){
            while($row = $rs2->fetch_object()){
                $tmp[] = $row;
            }
        }
        $total = count($tmp);
        $q2 .= ' '.' GROUP BY profileservices.profile_id';
        $rs2 = $this->db()->query($q2);
        $tmp = array();
        if($rs2){
            while($row = $rs2->fetch_object()){
                $tmp[] = $row;
            }
        }
        $totalRecords = count($tmp);

        $data = array(
            'totalRecords' => $totalRecords,
            'total'=>$total,
            'limit' =>$limit,
            'page' =>$page,
            'profiles'=> $profiles,
            'daterange'=>$daterange,
            'bracket_id' => $bracket_id,
            'barangay_id'=>$barangay_id,
            'service_id'=>$service_id,
            'name'=>$name,
        );
        $data['main'] = 'report/services';
        $data['js'] = 'js/report';
        $this->view('layout',$data);
    }

    public function cases()
    {
        $keyword = array(
            'daterange' => null,
            'bracket_id' => null,
            'barangay_id' => null,
            'case_id' => null,
            'name' => null,
        );
        if($_POST){
            $_SESSION['filterCase'] = $_POST;
        }

        if(isset($_SESSION['filterCase'])){
            $keyword = $_SESSION['filterCase'];
        }

        $daterange = $keyword['daterange'];
        $bracket_id = $keyword['bracket_id'];
        $barangay_id = $keyword['barangay_id'];
        $case_id = $keyword['case_id'];
        $name = $keyword['name'];

        $startdate = date('Y-m-d', strtotime('today - 30 days'));
        $enddate = date('Y-m-d');

        if($daterange){
            $temp1 = explode('-',$daterange);
            $temp2 = array_slice($temp1, 0, 1);
            $tmp = implode(',', $temp2);
            $startdate = date('Y-m-d',strtotime($tmp));

            $temp3 = array_slice($temp1, 1, 1);
            $tmp = implode(',', $temp3);
            $enddate = date('Y-m-d',strtotime($tmp));
        }else{
            $daterange = date('m/d/Y',strtotime($startdate)).' - '.date('m/d/Y',strtotime($enddate));
        }

        $q2 = "
            SELECT profilecases.profile_id FROM profilecases
            LEFT JOIN profile on profilecases.profile_id=profile.id
            WHERE profilecases.dateProfile >= '$startdate'
            AND  profilecases.dateProfile <= '$enddate'
            AND (
                    profile.fname like '%$name%' OR
                    profile.mname like '%$name%' OR
                    profile.lname like '%$name%'
                )
        ";

        $join = "profile on profilecases.profile_id = profile.id";
        $select = "profilecases.profile_id,profilecases.case_id,profilecases.barangay_id,profilecases.id,profilecases.dateProfile";
        $sub = "where profilecases.dateProfile >= '$startdate'
                AND profilecases.dateProfile <= '$enddate'
                AND (
                    profile.fname like '%$name%' OR
                    profile.mname like '%$name%' OR
                    profile.lname like '%$name%'
                )";

        if($case_id){
            $sub .= " AND profilecases.case_id=".$case_id;
            $q2 .= " AND profilecases.case_id=".$case_id;
        }
        if($bracket_id){
            $sub .= " AND profilecases.bracket_id=".$bracket_id;
            $q2 .= " AND profilecases.bracket_id=".$bracket_id;
        }
        if($barangay_id){
            $sub .= " AND profilecases.barangay_id=".$barangay_id;
            $q2 .= " AND profilecases.barangay_id=".$barangay_id;
        }

        $muncity_id = $this->getValue('users','muncity','id',$_SESSION['id']);
        $sub .= " AND profilecases.muncity_id=".$muncity_id;
        $q2 .= " AND profilecases.muncity_id=".$muncity_id;

        if($_SESSION['priv']==2){
            $tmp = 'where user_id = '.$_SESSION['id'];
            $tmpBrgy = $this->records('userbrgy',$tmp);
            $c = count($tmpBrgy);
            $i = 1;
            if($c > 0){
                $sub .= ' AND (';
                $q2 .= ' AND (';
                foreach($tmpBrgy as $row){
                    $sub .= ' profilecases.barangay_id = '.$row->barangay_id;
                    $q2 .= ' profilecases.barangay_id = '.$row->barangay_id;
                    if($i<$c){
                        $sub .= ' OR';
                        $q2 .= ' OR';
                        $i++;
                    }
                }
                $sub .= ') ';
                $q2 .= ') ';
            }
        }

        $page = 1;
        $limit = 15;
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        $sub .= ' order by dateProfile desc, profile_id asc';

        $profiles = $this->paginate('profilecases',$limit,$page,$sub,$select,$join);

        $rs2 = $this->db()->query($q2);
        $tmp = array();
        if($rs2){
            while($row = $rs2->fetch_object()){
                $tmp[] = $row;
            }
        }
        $total = count($tmp);
        $q2 .= ' '.' GROUP BY profilecases.profile_id';
        $rs2 = $this->db()->query($q2);
        $tmp = array();
        if($rs2){
            while($row = $rs2->fetch_object()){
                $tmp[] = $row;
            }
        }
        $totalRecords = count($tmp);

        $data = array(
            'totalRecords' => $totalRecords,
            'total'=>$total,
            'limit' =>$limit,
            'page' =>$page,
            'profiles'=> $profiles,
            'daterange'=>$daterange,
            'bracket_id' => $bracket_id,
            'barangay_id'=>$barangay_id,
            'case_id'=>$case_id,
            'name'=>$name,
        );
        $data['main'] = 'report/cases';
        $data['js'] = 'js/report';
        $this->view('layout',$data);
    }

    public function removeService()
    {
        $id = $_POST['currentID'];

        $rs = $this->info('profileservices',$id);
        $service_id = $rs->service_id;
        $code = $this->getValue('services','code','id',$service_id);
        $data = array(
            'dateProfile' => $rs->dateProfile,
            'profile_id' => $rs->profile_id,
            'code' => $code,
        );
        $this->delete('femalestatus',$this->getID('femalestatus',$data));

        $option = array(
            'dateProfile' => $rs->dateProfile,
            'profile_id' => $rs->profile_id,
        );
        $option['serviceoption.option'] = 'service';
        if($code=='WM'){
            $option['serviceoption.option'] = 'weight';
        }else if($code=='HM'){
            $option['serviceoption.option'] = 'height';
        }else if($code=='BP'){
            $option['serviceoption.option'] = 'bp';
        }
        $this->delete('serviceoption',$this->getID('serviceoption',$option));

        $this->delete('profileservices',$id);
        $_SESSION['status'] = 'serviceDeleted';
        $config = new Config();
        header('location:'.$config->base_url('report'));
    }

    public function removeCase()
    {
        $id = $_POST['currentID'];
        $id;
        $this->delete('profilecases',$id);
        $_SESSION['status'] = 'serviceDeleted';
        $config = new Config();
        header('location:'.$config->base_url('report/cases'));
    }
}