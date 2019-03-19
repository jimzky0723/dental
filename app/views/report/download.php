<?php
$con = new Controller();
$filename = $data['filename'];
$profile = $data['profile'];
$profileservices = $data['profileservices'];
$profilecases = $data['profilecases'];
$femalestatus = $data['femalestatus'];
$serviceoption = $data['serviceoption'];

$filename = "Content-Disposition: attachment; filename=$filename.DOH7";
// output headers so that the file is downloaded rather than displayed
header('Content-Type: text/csv; charset=utf-8');
header($filename);

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
//fputcsv($output, array('Column 1', 'Column 2', 'Column 3'));
fputcsv($output, array('PROFILE'));
fputcsv($output, array('FAMILY ID','HEAD','RELATION TO HEAD','FIRST NAME','MIDDLE NAME','LAST NAME','SUFFIX','BIRTHDAY','SEX','BARANGAY ID','MUNICIPAL / CITY ID','PROVINCE ID'));
// fetch the data
//mysql_connect('localhost', 'root', '');
//mysql_select_db('sdn_v2');
//$rows = mysql_query('SELECT fname,mname,lname FROM users');

// loop over the rows, outputting them
//while ($row = mysql_fetch_assoc($rows)) fputcsv($output, $row);
//
foreach($profile as $row){
    $data = array(
        'familyID' => $con->getValue('familyprofile','description','id',$row->familyID),
        'head' => $row->head,
        'relation' => $row->relation,
        'fname' => $row->fname,
        'mname' => $row->mname,
        'lname' => $row->lname,
        'suffix' => $row->suffix,
        'dob' => $row->dob,
        'sex' => $row->sex,
        'barangay_id' => $row->barangay_id,
        'muncity_id' => $row->muncity_id,
        'province_id' => $row->province_id,
    );
    fputcsv($output, $data);
}

fputcsv($output, array('SERVICES'));
fputcsv($output, array('DATE CREATED','FIRST NAME','MIDDLE NAME','LAST NAME','SUFFIX','SERVICE ID','BRACKET ID','BARANGAY ID','MUNICIPAL / CITY ID'));
foreach($profileservices as $row){
    $rows = $con->info('profile',$row->profile_id);
    $data = array(
        'dateProfile' => $row->dateProfile,
        'fname' => $rows->fname,
        'mname' => $rows->mname,
        'lname' => $rows->lname,
        'suffix' => $rows->suffix,
        'service_id' => $row->service_id,
        'bracket_id' => $row->bracket_id,
        'barangay_id' => $row->barangay_id,
        'muncity_id' => $row->muncity_id,
    );
    fputcsv($output, $data);

}

fputcsv($output, array('CASES'));
fputcsv($output, array('DATE CREATED','FIRST NAME','MIDDLE NAME','LAST NAME','SUFFIX','CASE ID','BRACKET ID','BARANGAY ID','MUNICIPAL / CITY ID'));
foreach($profilecases as $row){
    $rows = $con->info('profile',$row->profile_id);
    $data = array(
        'dateProfile' => $row->dateProfile,
        'fname' => $rows->fname,
        'mname' => $rows->mname,
        'lname' => $rows->lname,
        'suffix' => $rows->suffix,
        'case_id' => $row->case_id,
        'bracket_id' => $row->bracket_id,
        'barangay_id' => $row->barangay_id,
        'muncity_id' => $row->muncity_id,
    );
    fputcsv($output, $data);
}

fputcsv($output, array('STATUS'));
fputcsv($output, array('DATE CREATED','FIRST NAME','MIDDLE NAME','LAST NAME','SUFFIX','STATUS','CODE','BARANGAY ID','MUNICIPAL / CITY ID'));
foreach($femalestatus as $row){
    $rows = $con->info('profile',$row->profile_id);
    $data = array(
        'dateProfile' => $row->dateProfile,
        'fname' => $rows->fname,
        'mname' => $rows->mname,
        'lname' => $rows->lname,
        'suffix' => $rows->suffix,
        'status' => $row->status,
        'code' => $row->code,
        'barangay_id' => $row->barangay_id,
        'muncity_id' => $row->muncity_id,
    );
    fputcsv($output, $data);
}

fputcsv($output, array('SERVICE OPTION'));
fputcsv($output, array('DATE CREATED','FIRST NAME','MIDDLE NAME','LAST NAME','SUFFIX','OPTION','STATUS','BARANGAY ID','MUNICIPAL / CITY ID'));
foreach($serviceoption as $row){
    $rows = $con->info('profile',$row->profile_id);
    $data = array(
        'dateProfile' => $row->dateProfile,
        'fname' => $rows->fname,
        'mname' => $rows->mname,
        'lname' => $rows->lname,
        'suffix' => $rows->suffix,
        'option' => $row->option,
        'status' => $row->status,
        'barangay_id' => $row->barangay_id,
        'muncity_id' => $row->muncity_id,
    );
    fputcsv($output, $data);
}
