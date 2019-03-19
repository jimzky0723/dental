<?php
$controller = new Controller();
$config = new Config();

$id = $_SESSION['id'];
$muncity_id = $controller->getValue('users','muncity','id',$id);
$sub = 'where muncity_id =' . $muncity_id;

$priv = $_SESSION['priv'];
if($_SESSION['priv']==2){
    $sub = 'where id != 0';
    $tmp = 'where user_id = '.$_SESSION['id'];
    $tmpBrgy = $this->records('userbrgy',$tmp);
    $c = count($tmpBrgy);
    $i = 1;
    if($c > 0){
        $sub .= ' AND (';
        foreach($tmpBrgy as $row){
            $sub .= ' id = '.$row->barangay_id;
            if($i<$c){
                $sub .= ' OR';
                $i++;
            }
        }
        $sub .= ') ';
    }
}

$brgy = $controller->records('barangay',$sub,'description','asc');
$last_id = $controller->getLastID('profile','id');
$last_id += 1;
$ctrlNo = str_pad($last_id, 4, '0', STR_PAD_LEFT);
$idNo = str_pad($id, 4, '0', STR_PAD_LEFT);
$profileID = date('mdY').'-'.$idNo.'-'.$ctrlNo;
?>
<style>
    .table tr td:first-child {
        background: #f5f5f5;
        text-align: right;
        vertical-align: middle;
        font-weight: bold;
        padding: 3px;
    }
    .table tr td {
        border:1px solid #bbb !important;
    }
</style>
<div class="col-md-9 wrapper">
    <div class="alert alert-jim">
        <h2 class="page-header">
            <i class="fa fa-user-plus"></i>
            Add Family Head
        </h2>
        <div class="page-divider"></div>
        <form action="<?php echo $config->base_url('population/saveprofile/head');?>" method="post" class="form-submit">
            <table class="table table-bordered table-hover" border="1">
                <tr>
                    <td>Family Profile ID :<br /><small style="font-weight: 100;" class="text-info">(or Philhealth ID #)</small></td>
                    <td><input type="text" name="familyID" value="<?php echo $profileID; ?>" class="form-control" required /> </td>
                </tr>
                <tr>
                    <td>First Name :</td>
                    <td><input type="text" name="fname" class="form-control" required /> </td>
                </tr>
                <tr>
                    <td>Middle Name :</td>
                    <td><input type="text" name="mname" class="form-control" /> </td>
                </tr>
                <tr>
                    <td>Last Name :</td>
                    <td><input type="text" name="lname" class="form-control" required /> </td>
                </tr>
                <tr>
                    <td>Suffix :</td>
                    <td>
                        <select name="suffix" class="form-control select2" id="suffix" style="width: 100%">
                            <option value="">Select...</option>
                            <option>Jr.</option>
                            <option>Sr.</option>
                            <option>I</option>
                            <option>II</option>
                            <option>III</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Birth Date :</td>
                    <td><input type="date" name="dob" class="form-control" required /> </td>
                </tr>
                <tr>
                    <td>Sex :</td>
                    <td>
                        <label style="cursor: pointer;"><input type="radio" name="sex" value="Male" required> Male</label>
                        &nbsp;&nbsp;&nbsp;
                        <label style="cursor: pointer;"><input type="radio" name="sex" value="Female" required> Female</label>

                    </td>
                </tr>
                <tr>
                    <td>Barangay :</td>
                    <td>
                        <select name="barangay_id" class="form-control select2" required id="suffix" style="width: 100%">
                            <option value="">Select...</option>
                            <?php foreach($brgy as $row): ?>
                            <option value="<?php echo $row->id; ?>"><?php echo $row->description; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <a href="<?php echo $config->base_url('population'); ?>" class="btn btn-sm btn-default">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                        <button type="submit" class="btn btn-success btn-sm btn-submit">
                            <i class="fa fa-send"></i> Submit
                        </button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php $controller->view('sidebar/home'); ?>
<?php $controller->view('modal/upload'); ?>
