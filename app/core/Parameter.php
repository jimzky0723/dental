<?php

class Parameter extends Controller
{
    static function getStaticAge($dob,$date)
    {
        $d1 = strtotime($dob);
        $d2 = strtotime($date);
        $min_date = min($d1, $d2);
        $max_date = max($d1, $d2);

        $age = 0;
        while (($min_date = strtotime("+1 YEAR", $min_date)) <= $max_date) {
            $age++;
        }

        if($age == 0){
            $d1 = strtotime($dob);
            $d2 = strtotime($date);
            $min_date = min($d1, $d2);
            $max_date = max($d1, $d2);

            while (($min_date = strtotime("+1 MONTH", $min_date)) <= $max_date) {
                $age++;
            }
            if($age == 0){
                $d1 = strtotime($dob);
                $d2 = strtotime($date);
                $min_date = min($d1, $d2);
                $max_date = max($d1, $d2);

                while (($min_date = strtotime("+1 DAY", $min_date)) <= $max_date) {
                    $age++;
                }
                return '<small>('.$age.' D/o)</small>';
            }
            return '<small>('.$age.' M/o)</small>';
        }
        return $age;
    }

    static function getAge($date){
        //date in mm/dd/yyyy format; or it can be in other formats as well
        $birthDate = date('m/d/Y',strtotime($date));
        //explode the date to get month, day and year
        $birthDate = explode("/", $birthDate);
        //get age from date or birthdate
        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
            ? ((date("Y") - $birthDate[2]) - 1)
            : (date("Y") - $birthDate[2]));
        return $age;
    }

    static function getAgeMonth($date){
        $d1 = strtotime($date);
        $d2 = strtotime(date('Y-m-d'));
        $min_date = min($d1, $d2);
        $max_date = max($d1, $d2);

        $i = 0;
        while (($min_date = strtotime("+1 MONTH", $min_date)) <= $max_date) {
            $i++;
        }
        return $i;
    }

    static function getAgeDay($date){
        $d1 = strtotime($date);
        $d2 = strtotime(date('Y-m-d'));
        $min_date = min($d1, $d2);
        $max_date = max($d1, $d2);

        $i = 0;
        while (($min_date = strtotime("+1 DAY", $min_date)) <= $max_date) {
            $i++;
        }
        return $i;
    }

    static function validateService($bracket_id,$code)
    {
        $con = new Controller();
        $service_id = $con->getID('services',array('code' => $code));
        $compare = array(
            'bracket_id' => $bracket_id,
            'service_id' => $service_id,
        );
        $validate = $con->compare('bracketservices',$compare);
        if($validate){
            return true;
        }
        return false;
    }

    static function codeName($code)
    {
        switch($code){
            case "code_M":
                return "M";
            case "code_RF":
                return "RF";
            case "code_TF":
                return "TF";
            case "code_PFCo":
                return "PF / Co";
            case "code_PFAm":
                return "PF / Am";
            case "code_D":
                return "D";
            case "code_UE":
                return "UE";
            case "code_PR":
                return "Present";
            case "code_RCT":
                return "RCT";
            case "code_CR":
                return "Cr";
            case "caries":
                return "Dental Caries";
            case "gingivitis":
                return "Gingivitis";
            case "perio":
                return "Perio Disease";
            case "debris":
                return "Oral Debris";
            case "calculus":
                return "Calculus";
            case "anomalies":
                return "Dento-facial Anomalies";
            case "upon_oral_exam":
                return "Upon Oral Examination";
            case "upon_complete_rehab":
                return "Upon Complete Oral Rehab";
            case "hospital":
                return "Hospital";
            case "public_clinic":
                return "Other Public Dental Clinic";
            case "private_clinic":
                return "Private Clinic";
            default:
                return $code;
        }
    }

    static function serviceName($code)
    {
        switch($code){
            case "code_M":
                return "Extraction";
            case "code_TF":
                return "Temporary Filling";
            case "code_PFCo":
                return "Permanent Filling - Composite";
            case "code_PFAm":
                return "Permanent Filling - Composite";
            case "reffered":
                return "Reffered";
            case "others":
                return "Other Services";
            case "drill":
                return "Completed Toothbrushing Drill";
            case "counselling":
                return "Given Counselling / Education";
            case "abscess":
                return "Oral Abscess Drained";
            case "operative":
                return "Post Operative Treatment";
            case "fluoride":
                return "Completed Fluoride Therapy";
            case "sealant":
                return "Sealant";
            case "gum":
                return "Gum Treatment";
            case "scaling":
                return "OP / Scaling";
            case "ofc":
                return "Orally Fit Children";
            default:
                return "N/A";
        }
    }

    static function get_paging_info($tot_rows,$pp,$curr_page)
    {
        $pages = ceil($tot_rows / $pp); // calc pages

        $data = array(); // start out array
        $data['si']        = ($curr_page * $pp) - $pp; // what row to start at
        $data['pages']     = $pages;                   // add the pages
        $data['curr_page'] = $curr_page;               // Whats the current page

        return $data; //return the paging data

    }
}