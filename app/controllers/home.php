<?php

class Home extends Controller
{
    private $url;
    public function __construct()
    {
        $this->auth();
    }

    public function index()
    {
        $data['main'] = 'index';
        $data['js'] = 'js/home';
        $this->view('layout',$data);
    }

    public function counts()
    {
        $id = $_SESSION['id'];
        $user = $this->info('users',$id);
        $muncity_id = $user->muncity;
        $user_priv = $user->user_priv;


        $con = new Controller();
        $sub = "WHERE muncity_id=" . $muncity_id;
        $q = "select sum(target) as count from barangay where muncity_id=$muncity_id";
        if($_SESSION['priv']==2){
            $sub .= ' AND id != 0';
            $tmp = 'where user_id = '.$_SESSION['id'];
            $tmpBrgy = $this->records('userbrgy',$tmp);
            $c = count($tmpBrgy);
            $i = 1;
            if($c > 0){
                $sub .= ' AND (';
                $q .= ' AND (';
                foreach($tmpBrgy as $row){
                    $sub .= ' barangay_id = '.$row->barangay_id;
                    $q .= ' id = '.$row->barangay_id;
                    if($i<$c){
                        $sub .= ' OR';
                        $q .= ' OR';
                        $i++;
                    }
                }
                $sub .= ') ';
                $q .= ') ';
            }
        }
        $countPopulation = $con->count('profile',$sub);
        $rs = $this->db()->query($q);
        $target = $rs->fetch_object()->count;
        if($target==0){
            $target=$countPopulation;
        }

        if($countPopulation==0){
            $profilePercentage = 0;
        }else{
            $profilePercentage = ($countPopulation / $target) * 100;
        }


        $data = array(
            'countPopulation' => number_format($countPopulation),
            'target' => number_format($target),
            'profilePercentage' => number_format($profilePercentage,1),
        );
        echo json_encode($data);
    }

    public function charts(){
        $user = $this->info('users',$_SESSION['id']);
        $where = "WHERE muncity_id = $user->muncity";
        if($_SESSION['priv']==2){
            $where .= ' AND id != 0';
            $tmp = 'where user_id = '.$_SESSION['id'];
            $tmpBrgy = $this->records('userbrgy',$tmp);
            $c = count($tmpBrgy);
            $i = 1;
            if($c > 0){
                $where .= ' AND (';
                foreach($tmpBrgy as $row){
                    $where .= ' barangay_id = '.$row->barangay_id;
                    if($i<$c){
                        $where .= ' OR';
                        $i++;
                    }
                }
                $where .= ') ';
            }
        }
        for($i=1; $i<=12; $i++){
            $new = str_pad($i, 2, '0', STR_PAD_LEFT);
            $current = '01.'.$new.'.'.date('Y');
            $data['months'][] = date('M/y',strtotime($current));
            $startdate = date('Y-m-d',strtotime($current));
            $end = '01.'.($new+1).'.'.date('Y');
            if($new==12){
                $end = '12/31/'.date('Y');
            }
            $enddate = date('Y-m-d',strtotime($end));

            $sub = $where;
            $sub .= " AND dateProfile >= '$startdate'";
            $sub .= " AND dateProfile <= '$enddate'";

            $sub .= " GROUP BY profile_id";
            $con = new Controller();
            $count = $con->records('profileservices',$sub);
            $data['count'][] = count($count);
        }
        echo json_encode($data);
    }
}