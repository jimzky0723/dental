<?php
$controller = new Controller();
$config = new Config();
$param = new Parameter();
$id = $data['id'];
$date = isset($_SESSION['dateProfile']) ? $_SESSION['dateProfile'] : date('Y-m-d');
$bracket = $data['bracket'];

$path = $config->base_url('tooth/');
$param = new Parameter();
$current_doctor = isset($_SESSION['doctor_id']) ? $_SESSION['doctor_id'] : 0;

$doctor_name = 'None';
if($current_doctor!=0){
    $name = $controller->info('doctors',$current_doctor);
    $doctor_name = 'Dr. '.$name->fname.' '.$name->mname.' '.$name->lname.' '.$name->suffix;
}

?>
<?php $controller->view('sidebar/services',$data); ?>
<style>
    label {
        cursor: pointer;
    }
    .btn-circle {
        border-radius: 50%;
    }
    .btn-tooth {
        padding: 0px;
    }
    table tr td {
        padding:7px 3px;
    }
    .status {
        font-size: 0.7em;
        font-weight: bold;
        color:red;
        padding:0px;
        margin:0px;
        line-height: 10px;
    }
</style>
<div class="col-md-9 wrapper">
    <div class="alert alert-jim">
        <h2 class="page-header">Oral Services
            <?php if(isset($data['bracket'])): ?>
                <?php $user = $controller->info('profile',$id); ?>
                <small>[ Name: <?php echo $user->fname; ?> <?php echo $user->mname; ?> <?php echo $user->lname; ?> <?php echo $user->suffix; ?>
                    | Age: <?php echo $data['bracket']['age']; ?> ]</small>
            <?php endif; ?>
        </h2>
        <div class="services">
            <?php
            $gender = $controller->getValue('profile','sex','id',$id);
            ?>

            <input type="hidden" name="date" id="date" value="<?php echo $date; ?>" />
            <input type="hidden" name="profileID" id="profile_id" value="<?php echo $id; ?>" />
            <input type="hidden" name="brgy_id" id="brgy_id" value="<?php echo $bracket['brgy_id']; ?>" />
            <input type="hidden" name="bracket_id" id="bracket_id" value="<?php echo $bracket['bracket_id']; ?>" />
            <?php if($doctor_name=='None'): ?>
                <div class="list_services">
                    <div class="alert alert-warning">
                        <p class="text-danger">Please select a dentist!</p>
                    </div>
                </div>
            <?php elseif(!$bracket): ?>
                <div class="list_services">
                    <div class="alert alert-warning">
                        <p class="text-danger">Please select date and profile!</p>
                    </div>
                </div>
            <?php elseif(!$gender):?>
                <div class="list_services">
                    <div class="alert alert-warning">
                        <p class="text-danger">Please update gender of this profile!</p>
                    </div>
                </div>

            <?php else: ?>
                <?php $bracket_id = $bracket['bracket_id']; ?>
                <?php if(($bracket_id==5 || $bracket_id == 6) && $gender=='Female'): ?>

                    <ul class="list-group">
                        <li class="list-group-item">
                            <label>
                                <input type="radio" name="femalestatus" value="pregnant" required />
                                Pregnant
                            </label>
                        </li>
                        <li class="list-group-item">
                            <label>
                                <input type="radio" checked name="femalestatus" value="non" required />
                                Non-Pregnant
                            </label>
                        </li>
                    </ul>

                <?php endif; ?>
                <h4>
                    Current Dentist: <font class="text-info"><?php echo $doctor_name;?></font>
                </h4>
                <div class="table-responsive">
                    <table width="100%" class="table-bordered text-center">
                        <tr>
                            <td colspan="3"></td>
                            <?php for($i=55;$i>=51;$i--): ?>
                                <?php
                                $area='secondLeft';
                                if($i<=53){
                                    $area='firstLeft';
                                }
                                ?>
                                <td>
                                    <?php
                                    $sub = "where profile_id=$id and tooth_no=$i";
                                    $code = $controller->moreInfo('oral_exam',$sub,'desc');
                                    $img = '00000';
                                    if(($code && $code->code!='00000')||($code && $code->status=='code_PR')){
                                        $img = $code->code;
                                        $codeName = $param->codeName($code->status);
                                        echo '<small class="status">'.$codeName.'</small><br/>';
                                    }
                                    ?>
                                    <button type="button" data-area="<?php echo $area;?>" data-id="<?php echo $i;?>" data-service="Oral Exam" class="btn-tooth btn btn-circle btn-default btn-sm">
                                        <img src="<?php echo $path.$img.'.png'?>" width="40px" />
                                    </button>
                                    <br />
                                    <?php echo $i; ?>
                                </td>
                            <?php endfor; ?>
                            <?php for($i=61;$i<=65;$i++): ?>
                                <?php
                                $area='secondRight';
                                if($i<=63){
                                    $area='firstRight';
                                }
                                ?>
                                <td>
                                    <?php
                                    $sub = "where profile_id=$id and tooth_no=$i";
                                    $code = $controller->moreInfo('oral_exam',$sub,'desc');
                                    $img = '00000';
                                    if(($code && $code->code!='00000')||($code && $code->status=='code_PR')){
                                        $img = $code->code;
                                        $codeName = $param->codeName($code->status);
                                        echo '<small class="status">'.$codeName.'</small><br/>';
                                    }
                                    ?>
                                    <button type="button" data-area="<?php echo $area;?>" data-id="<?php echo $i;?>" data-service="Oral Exam" class="btn-tooth btn btn-circle btn-default btn-sm">
                                        <img src="<?php echo $path.$img.'.png'?>" width="40px" />
                                    </button>
                                    <br />
                                    <?php echo $i; ?>
                                </td>
                            <?php endfor; ?>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <?php for($i=18;$i>=11;$i--): ?>
                                <?php
                                $area='secondLeft';
                                if($i<=13){
                                    $area='firstLeft';
                                }
                                ?>
                                <td>
                                    <?php
                                    $sub = "where profile_id=$id and tooth_no=$i";
                                    $code = $controller->moreInfo('oral_exam',$sub,'desc');
                                    $img = '00000';
                                    if(($code && $code->code!='00000')||($code && $code->status=='code_PR')){
                                        $img = $code->code;
                                        $codeName = $param->codeName($code->status);
                                        echo '<small class="status">'.$codeName.'</small><br/>';
                                    }
                                    ?>
                                    <button type="button" data-area="<?php echo $area;?>" data-id="<?php echo $i;?>" data-service="Oral Exam" class="btn-tooth btn btn-circle btn-default btn-sm">
                                        <img src="<?php echo $path.$img.'.png'?>" width="40px" />
                                    </button>
                                    <br />
                                    <?php echo $i; ?>
                                </td>
                            <?php endfor; ?>
                            <?php for($i=21;$i<=28;$i++): ?>
                                <?php
                                $area='secondRight';
                                if($i<=23){
                                    $area='firstRight';
                                }
                                ?>
                                <td>
                                    <?php
                                    $sub = "where profile_id=$id and tooth_no=$i";
                                    $code = $controller->moreInfo('oral_exam',$sub,'desc');
                                    $img = '00000';
                                    if(($code && $code->code!='00000')||($code && $code->status=='code_PR')){
                                        $img = $code->code;
                                        $codeName = $param->codeName($code->status);
                                        echo '<small class="status">'.$codeName.'</small><br/>';
                                    }
                                    ?>
                                    <button type="button" data-area="<?php echo $area;?>" data-id="<?php echo $i;?>" data-service="Oral Exam" class="btn-tooth btn btn-circle btn-default btn-sm">
                                        <img src="<?php echo $path.$img.'.png'?>" width="40px" />
                                    </button>
                                    <br />
                                    <?php echo $i; ?>
                                </td>
                            <?php endfor; ?>
                        </tr>
                        <tr>
                            <?php for($i=48;$i>=41;$i--): ?>
                                <?php
                                $area='secondLeft';
                                if($i<=43){
                                    $area='firstLeft';
                                }
                                ?>
                                <td>
                                    <?php
                                    $sub = "where profile_id=$id and tooth_no=$i";
                                    $code = $controller->moreInfo('oral_exam',$sub,'desc');
                                    $img = '00000';
                                    if(($code && $code->code!='00000')||($code && $code->status=='code_PR')){
                                        $img = $code->code;
                                        $codeName = $param->codeName($code->status);
                                        echo '<small class="status">'.$codeName.'</small><br/>';
                                    }
                                    ?>
                                    <button type="button" data-area="<?php echo $area;?>" data-id="<?php echo $i;?>" data-service="Oral Exam" class="btn-tooth btn btn-circle btn-default btn-sm">
                                        <img src="<?php echo $path.$img.'.png'?>" width="40px" />
                                    </button>
                                    <br />
                                    <?php echo $i; ?>
                                </td>
                            <?php endfor; ?>
                            <?php for($i=31;$i<=38;$i++): ?>
                                <?php
                                $area='secondRight';
                                if($i<=33){
                                    $area='firstRight';
                                }
                                ?>
                                <td>
                                    <?php
                                    $sub = "where profile_id=$id and tooth_no=$i";
                                    $code = $controller->moreInfo('oral_exam',$sub,'desc');
                                    $img = '00000';
                                    if(($code && $code->code!='00000')||($code && $code->status=='code_PR')){
                                        $img = $code->code;
                                        $codeName = $param->codeName($code->status);
                                        echo '<small class="status">'.$codeName.'</small><br/>';
                                    }
                                    ?>
                                    <button type="button" data-area="<?php echo $area;?>" data-id="<?php echo $i;?>" data-service="Oral Exam" class="btn-tooth btn btn-circle btn-default btn-sm">
                                        <img src="<?php echo $path.$img.'.png'?>" width="40px" />
                                    </button>
                                    <br />
                                    <?php echo $i; ?>
                                </td>
                            <?php endfor; ?>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <?php for($i=85;$i>=81;$i--): ?>
                                <?php
                                $area='secondLeft';
                                if($i<=83){
                                    $area='firstLeft';
                                }
                                ?>
                                <td>
                                    <?php
                                    $sub = "where profile_id=$id and tooth_no=$i";
                                    $code = $controller->moreInfo('oral_exam',$sub,'desc');
                                    $img = '00000';
                                    if(($code && $code->code!='00000')||($code && $code->status=='code_PR')){
                                        $img = $code->code;
                                        $codeName = $param->codeName($code->status);
                                        echo '<small class="status">'.$codeName.'</small><br/>';
                                    }
                                    ?>
                                    <button type="button" data-area="<?php echo $area;?>" data-id="<?php echo $i;?>" data-service="Oral Exam" class="btn-tooth btn btn-circle btn-default btn-sm">
                                        <img src="<?php echo $path.$img.'.png'?>" width="40px" />
                                    </button>
                                    <br />
                                    <?php echo $i; ?>
                                </td>
                            <?php endfor; ?>
                            <?php for($i=71;$i<=75;$i++): ?>
                                <?php
                                $area='secondRight';
                                if($i<=73){
                                    $area='firstRight';
                                }
                                ?>
                                <td>
                                    <?php
                                    $sub = "where profile_id=$id and tooth_no=$i";
                                    $code = $controller->moreInfo('oral_exam',$sub,'desc');
                                    $img = '00000';
                                    if(($code && $code->code!='00000')||($code && $code->status=='code_PR')){
                                        $img = $code->code;
                                        $codeName = $param->codeName($code->status);
                                        echo '<small class="status">'.$codeName.'</small><br/>';
                                    }
                                    ?>
                                    <button type="button" data-area="<?php echo $area;?>" data-id="<?php echo $i;?>" data-service="Oral Exam" class="btn-tooth btn btn-circle btn-default btn-sm">
                                        <img src="<?php echo $path.$img.'.png'?>" width="40px" />
                                    </button>
                                    <br />
                                    <?php echo $i; ?>
                                </td>
                            <?php endfor; ?>
                            <td colspan="3"></td>
                        </tr>
                    </table>
                </div>
                <div class="clearfix"></div>
                <?php
                $sub = "where profile_id=$id";
                $health_services = $controller->records('oral_health_service',$sub,'id');

                ?>


                    <h3 class="page-header">Services Rendered <button type="button" data-toggle="modal" data-target="#healthStatus" class="btn-status btn-sm btn-submit btn btn-info"><i class="fa fa-plus"></i> Add Service</button></h3>
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr>
                            <th>Date Examined</th>
                            <th>Service</th>
                            <th>Tooth # / Remarks</th>
                            <th>Examined By</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if($health_services): ?>
                            <?php foreach($health_services as $row): ?>
                            <tr>
                                <td>
                                    <?php echo date('M d, Y',strtotime($row->dateProfile)); ?>
                                </td>
                                <td>
                                    <?php echo $param->serviceName($row->service); ?>
                                </td>
                                <td>
                                    <?php if($row->tooth_no): ?>
                                        Tooth # <?php echo $row->tooth_no; ?>
                                    <?php endif; ?>

                                    <?php if($row->remarks): ?>
                                        <?php echo nl2br($param->codeName($row->remarks)); ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php
                                    $name = $controller->info('doctors',$row->doctor_id);
                                    echo 'Dr. '.$name->fname.' '.$name->mname.' '.$name->lname.' '.$name->suffix;
                                    ?>
                                </td>
                                <td>
                                    <a href="<?php echo $config->base_url('services/remove/oralservices/'.$row->id.'/'.$id)?>" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-xs">
                                        <i class="fa fa-trash"></i> Remove
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5">
                                    <div class="alert alert-warning">
                                        <i class="fa fa-warning"></i> No services availed!
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>

                <hr />
            <?php endif; ?>
            <a href="<?php echo $config->base_url('services/'.$id);?>" class="btn-submit btn btn-default"><i class="fa fa-arrow-left"></i> Back to Oral Exam</a>
        </div>
    </div>
</div>
<?php $controller->view('modal/tooth_services'); ?>
