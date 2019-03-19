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

$info = $data['info'];
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
            <i class="fa fa-user"></i>
            Profile Details
        </h2>
        <div class="page-divider"></div>
        <form action="<?php echo $config->base_url('population/updateprofile/head');?>" method="post" class="form-submit">
            <table class="table table-bordered table-hover" border="1">
                <input type="hidden" name="currentID" value="<?php echo $info->id; ?>" />
                <tr>
                    <td>Family Profile ID :<br /><small style="font-weight: 100;" class="text-info">(or Philhealth ID #)</small></td>
                    <td><input type="text" name="familyID" value="<?php echo $info->familyID; ?>" class="form-control" required /> </td>
                </tr>
                <tr>
                    <td>Family Head? :</td>
                    <td>
                        <select name="head" id="head" class="form-control select2" id="suffix" style="width: 100%" required>
                            <option value="">Select...</option>
                            <option <?php if($info->head=='YES') echo 'selected'; ?> value="YES">YES</option>
                            <option <?php if($info->head=='NO') echo 'selected'; ?> value="NO">NO</option>
                        </select>
                    </td>
                </tr>
                <tr class="relation <?php if($info->head=='YES') echo 'hide'; ?>" >
                    <td>Relation to Head :</td>
                    <td>
                        <select name="relation" id="relation" class="form-control select2" id="suffix" style="width: 100%">
                            <option value="">Select...</option>
                            <option <?php if($info->relation=='Son') echo 'selected'; ?>>Son</option>
                            <option <?php if($info->relation=='Daughter') echo 'selected'; ?>>Daughter</option>
                            <option <?php if($info->relation=='Wife') echo 'selected'; ?>>Wife</option>
                            <option <?php if($info->relation=='Husband') echo 'selected'; ?>>Husband</option>
                            <option <?php if($info->relation=='Father') echo 'selected'; ?>>Father</option>
                            <option <?php if($info->relation=='Mother') echo 'selected'; ?>>Mother</option>
                            <option <?php if($info->relation=='Brother') echo 'selected'; ?>>Brother</option>
                            <option <?php if($info->relation=='Sister') echo 'selected'; ?>>Sister</option>
                            <option <?php if($info->relation=='Nephew') echo 'selected'; ?>>Nephew</option>
                            <option <?php if($info->relation=='Niece') echo 'selected'; ?>>Niece</option>
                            <option <?php if($info->relation=='Grandfather') echo 'selected'; ?>>Grandfather</option>
                            <option <?php if($info->relation=='Grandmother') echo 'selected'; ?>>Grandmother</option>
                            <option <?php if($info->relation=='Grandson') echo 'selected'; ?>>Grandson</option>
                            <option <?php if($info->relation=='Granddaughter') echo 'selected'; ?>>Granddaughter</option>
                            <option <?php if($info->relation=='Cousin') echo 'selected'; ?>>Cousin</option>
                            <option <?php if($info->relation=='Relative') echo 'selected'; ?>>Relative</option>
                            <option <?php if($info->relation=='Sister in Law') echo 'selected'; ?>>Sister in Law</option>
                            <option <?php if($info->relation=='Brother in Law') echo 'selected'; ?>>Brother in Law</option>
                            <option <?php if($info->relation=='Father in Law') echo 'selected'; ?>>Father in Law</option>
                            <option <?php if($info->relation=='Mother in Law') echo 'selected'; ?>>Mother in Law</option>
                            <option <?php if($info->relation=='Deceased') echo 'selected'; ?>>Deceased</option>
                            <option <?php if($info->relation=='Others') echo 'selected'; ?>>Others</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>First Name :</td>
                    <td><input type="text" name="fname" value="<?php echo $info->fname; ?>" class="form-control" required /> </td>
                </tr>
                <tr>
                    <td>Middle Name :</td>
                    <td><input type="text" name="mname" value="<?php echo $info->mname; ?>" class="form-control" /> </td>
                </tr>
                <tr>
                    <td>Last Name :</td>
                    <td><input type="text" name="lname" value="<?php echo $info->lname; ?>" class="form-control" required /> </td>
                </tr>
                <tr>
                    <td>Suffix :</td>
                    <td>
                        <select name="suffix" class="form-control select2" id="suffix" style="width: 100%">
                            <option value="">Select...</option>
                            <option <?php if($info->suffix=='Jr.') echo 'selected'; ?>>Jr.</option>
                            <option <?php if($info->suffix=='Sr.') echo 'selected'; ?>>Sr.</option>
                            <option <?php if($info->suffix=='I') echo 'selected'; ?>>I</option>
                            <option <?php if($info->suffix=='II') echo 'selected'; ?>>II</option>
                            <option <?php if($info->suffix=='III') echo 'selected'; ?>>III</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Birth Date :</td>
                    <td><input type="date" name="dob" class="form-control" value="<?php echo $info->dob; ?>" required /> </td>
                </tr>
                <tr>
                    <td>Sex :</td>
                    <td>
                        <label style="cursor: pointer;"><input type="radio" <?php if($info->sex=='Male') echo 'checked'; ?> name="sex" value="Male" required> Male</label>
                        &nbsp;&nbsp;&nbsp;
                        <label style="cursor: pointer;"><input type="radio" <?php if($info->sex=='Female') echo 'checked'; ?> name="sex" value="Female" required> Female</label>

                    </td>
                </tr>
                <tr>
                    <td>Barangay :</td>
                    <td>
                        <select name="barangay_id" class="form-control select2" required id="suffix" style="width: 100%">
                            <option value="">Select...</option>
                            <?php foreach($brgy as $row): ?>
                                <option <?php if($info->barangay_id==$row->id) echo 'selected'; ?> value="<?php echo $row->id; ?>"><?php echo $row->description; ?></option>
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
                            <i class="fa fa-pencil"></i> Update
                        </button>
                        <button type="button" class="btn btn-danger btn-sm btn-submit" data-target="#remove" data-toggle="modal">
                            <i class="fa fa-trash"></i> Delete
                        </button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<div class="modal fade" role="dialog" id="remove">
    <div class="modal-dialog modal-sm" role="document">
        <form method="GET" action="<?php echo $config->base_url('population/remove'); ?>">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <p class="text-danger">Are you sure you want to delete this record?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
                    <button type="submit" class="btn btn-danger btn-sm" ><i class="fa fa-trash"></i> Yes</button>
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php $controller->view('sidebar/home'); ?>
<?php $controller->view('modal/upload'); ?>
