<?php
$controller = new Controller();
$config = new Config();
$param = new Parameter();
$id = $data['id'];
$date = isset($_SESSION['dateProfile']) ? $_SESSION['dateProfile'] : date('Y-m-d');
$bracket = $data['bracket'];

$path = $config->base_url('tooth/')
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
            <form class="form-inline form-submit" method="POST" action="<?php echo $config->base_url('services/add'); ?>">
                <input type="hidden" name="date" id="date" value="<?php echo $date; ?>" />
                <input type="hidden" name="profileID" value="<?php echo $id; ?>" />
                <input type="hidden" name="brgy_id" value="<?php echo $bracket['brgy_id']; ?>" />
                <input type="hidden" name="bracket_id" value="<?php echo $bracket['bracket_id']; ?>" />
                <?php if(!$bracket): ?>
                    <div class="list_services">
                        <div class="alert alert-warning">
                            <p class="text-danger">Please select date and profile!</p>
                        </div>
                    </div>
                <?php else: ?>
                <?php $bracket_id = $bracket['bracket_id']; ?>
                <?php if($bracket_id==5 || $bracket_id == 6): ?>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <label>
                                <input type="radio" name="femalestatus" value="male" required />
                                Male
                            </label>
                        </li>
                        <li class="list-group-item">
                            <label>
                                <input type="radio" name="femalestatus" value="pregnant" required />
                                Pregnant
                            </label>
                        </li>
                        <li class="list-group-item">
                            <label>
                                <input type="radio" name="femalestatus" value="non" required />
                                Non-Pregnant
                            </label>
                        </li>
                    </ul>
                <?php endif; ?>
                <ul class="list-group">
                    <li class="list-group-item">
                        <label>
                            <input type="checkbox" name="services[]" value="ORAL_EXAM" />
                            Oral Exam
                        </label>
                    </li>
                    <li class="list-group-item chart1 hide">
                        <div class="table-responsive">
                            <table width="100%" class="table-bordered text-center">
                                <tr>
                                    <td colspan="3"></td>
                                    <?php for($i=55;$i>=51;$i--): ?>
                                        <td>
                                            <button type="button" data-id="<?php echo $i;?>" data-service="Oral Exam" class="btn-tooth btn btn-circle btn-default btn-sm">
                                                <img src="<?php echo $path.'empty.png'?>" width="40px" />
                                            </button>
                                            <br />
                                            <?php echo $i; ?>
                                        </td>
                                    <?php endfor; ?>
                                    <?php for($i=61;$i<=65;$i++): ?>
                                        <td><button type="button" class="btn btn-circle btn-default btn-sm"><?php echo $i; ?></button></td>
                                    <?php endfor; ?>
                                    <td colspan="3"></td>
                                </tr>
                                <tr>
                                    <?php for($i=18;$i>=11;$i--): ?>
                                        <td><button type="button" class="btn btn-circle btn-default btn-sm"><?php echo $i; ?></button></td>
                                    <?php endfor; ?>
                                    <?php for($i=21;$i<=28;$i++): ?>
                                        <td><button type="button" class="btn btn-circle btn-default btn-sm"><?php echo $i; ?></button></td>
                                    <?php endfor; ?>
                                </tr>
                                <tr>
                                    <?php for($i=48;$i>=41;$i--): ?>
                                        <td><button type="button" class="btn btn-circle btn-default btn-sm"><?php echo $i; ?></button></td>
                                    <?php endfor; ?>
                                    <?php for($i=31;$i<=38;$i++): ?>
                                        <td><button type="button" class="btn btn-circle btn-default btn-sm"><?php echo $i; ?></button></td>
                                    <?php endfor; ?>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <?php for($i=85;$i>=81;$i--): ?>
                                        <td><button type="button" class="btn btn-circle btn-default btn-sm"><?php echo $i; ?></button></td>
                                    <?php endfor; ?>
                                    <?php for($i=71;$i<=75;$i++): ?>
                                        <td><button type="button" class="btn btn-circle btn-default btn-sm"><?php echo $i; ?></button></td>
                                    <?php endfor; ?>
                                    <td colspan="3"></td>
                                </tr>
                            </table>
                        </div>
                    </li>

                    <li class="list-group-item">
                        <label>
                            <input type="checkbox" name="services[]" value="SCALING" />
                            Oral Prophylaxis / Scaling
                        </label>
                    </li>

                    <li class="list-group-item">
                        <label>
                            <input type="checkbox" name="services[]" value="PERMANENT_FILLING" />
                            Permanent Fillings
                        </label>
                    </li>
                    <li class="list-group-item chart2 hide">
                        <div class="table-responsive">
                            <table width="100%" class="table-bordered text-center">
                                <tr>
                                    <td colspan="3"></td>
                                    <?php for($i=55;$i>=51;$i--): ?>
                                        <td>
                                            <button type="button" data-id="<?php echo $i;?>" data-service="Oral Exam" class="btn-tooth btn btn-circle btn-default btn-sm"><?php echo $i; ?></button>
                                        </td>
                                    <?php endfor; ?>
                                    <?php for($i=61;$i<=65;$i++): ?>
                                        <td><button type="button" class="btn btn-circle btn-default btn-sm"><?php echo $i; ?></button></td>
                                    <?php endfor; ?>
                                    <td colspan="3"></td>
                                </tr>
                                <tr>
                                    <?php for($i=18;$i>=11;$i--): ?>
                                        <td><button type="button" class="btn btn-circle btn-default btn-sm"><?php echo $i; ?></button></td>
                                    <?php endfor; ?>
                                    <?php for($i=21;$i<=28;$i++): ?>
                                        <td><button type="button" class="btn btn-circle btn-default btn-sm"><?php echo $i; ?></button></td>
                                    <?php endfor; ?>
                                </tr>
                                <tr>
                                    <?php for($i=48;$i>=41;$i--): ?>
                                        <td><button type="button" class="btn btn-circle btn-default btn-sm"><?php echo $i; ?></button></td>
                                    <?php endfor; ?>
                                    <?php for($i=31;$i<=38;$i++): ?>
                                        <td><button type="button" class="btn btn-circle btn-default btn-sm"><?php echo $i; ?></button></td>
                                    <?php endfor; ?>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <?php for($i=85;$i>=81;$i--): ?>
                                        <td><button type="button" class="btn btn-circle btn-default btn-sm"><?php echo $i; ?></button></td>
                                    <?php endfor; ?>
                                    <?php for($i=71;$i<=75;$i++): ?>
                                        <td><button type="button" class="btn btn-circle btn-default btn-sm"><?php echo $i; ?></button></td>
                                    <?php endfor; ?>
                                    <td colspan="3"></td>
                                </tr>
                            </table>
                        </div>
                    </li>

                    <li class="list-group-item">
                        <label>
                            <input type="checkbox" name="services[]" value="TEMPORARY_FILLING" />
                            Temporary Fillings
                        </label>
                    </li>
                    <li class="list-group-item chart3 hide">
                        <div class="table-responsive">
                            <table width="100%" class="table-bordered text-center">
                                <tr>
                                    <td colspan="3"></td>
                                    <?php for($i=55;$i>=51;$i--): ?>
                                        <td>
                                            <button type="button" data-id="<?php echo $i;?>" data-service="Oral Exam" class="btn-tooth btn btn-circle btn-default btn-sm"><?php echo $i; ?></button>
                                        </td>
                                    <?php endfor; ?>
                                    <?php for($i=61;$i<=65;$i++): ?>
                                        <td><button type="button" class="btn btn-circle btn-default btn-sm"><?php echo $i; ?></button></td>
                                    <?php endfor; ?>
                                    <td colspan="3"></td>
                                </tr>
                                <tr>
                                    <?php for($i=18;$i>=11;$i--): ?>
                                        <td><button type="button" class="btn btn-circle btn-default btn-sm"><?php echo $i; ?></button></td>
                                    <?php endfor; ?>
                                    <?php for($i=21;$i<=28;$i++): ?>
                                        <td><button type="button" class="btn btn-circle btn-default btn-sm"><?php echo $i; ?></button></td>
                                    <?php endfor; ?>
                                </tr>
                                <tr>
                                    <?php for($i=48;$i>=41;$i--): ?>
                                        <td><button type="button" class="btn btn-circle btn-default btn-sm"><?php echo $i; ?></button></td>
                                    <?php endfor; ?>
                                    <?php for($i=31;$i<=38;$i++): ?>
                                        <td><button type="button" class="btn btn-circle btn-default btn-sm"><?php echo $i; ?></button></td>
                                    <?php endfor; ?>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <?php for($i=85;$i>=81;$i--): ?>
                                        <td><button type="button" class="btn btn-circle btn-default btn-sm"><?php echo $i; ?></button></td>
                                    <?php endfor; ?>
                                    <?php for($i=71;$i<=75;$i++): ?>
                                        <td><button type="button" class="btn btn-circle btn-default btn-sm"><?php echo $i; ?></button></td>
                                    <?php endfor; ?>
                                    <td colspan="3"></td>
                                </tr>
                            </table>
                        </div>
                    </li>

                    <li class="list-group-item">
                        <label>
                            <input type="checkbox" name="services[]" value="TOOTH_EXTRACTION" />
                            Tooth Extraction
                        </label>
                    </li>
                    <li class="list-group-item chart4 hide">
                        <div class="table-responsive">
                            <table width="100%" class="table-bordered text-center">
                                <tr>
                                    <td colspan="3"></td>
                                    <?php for($i=55;$i>=51;$i--): ?>
                                        <td>
                                            <button type="button" data-id="<?php echo $i;?>" data-service="Oral Exam" class="btn-tooth btn btn-circle btn-default btn-sm"><?php echo $i; ?></button>
                                        </td>
                                    <?php endfor; ?>
                                    <?php for($i=61;$i<=65;$i++): ?>
                                        <td><button type="button" class="btn btn-circle btn-default btn-sm"><?php echo $i; ?></button></td>
                                    <?php endfor; ?>
                                    <td colspan="3"></td>
                                </tr>
                                <tr>
                                    <?php for($i=18;$i>=11;$i--): ?>
                                        <td><button type="button" class="btn btn-circle btn-default btn-sm"><?php echo $i; ?></button></td>
                                    <?php endfor; ?>
                                    <?php for($i=21;$i<=28;$i++): ?>
                                        <td><button type="button" class="btn btn-circle btn-default btn-sm"><?php echo $i; ?></button></td>
                                    <?php endfor; ?>
                                </tr>
                                <tr>
                                    <?php for($i=48;$i>=41;$i--): ?>
                                        <td><button type="button" class="btn btn-circle btn-default btn-sm"><?php echo $i; ?></button></td>
                                    <?php endfor; ?>
                                    <?php for($i=31;$i<=38;$i++): ?>
                                        <td><button type="button" class="btn btn-circle btn-default btn-sm"><?php echo $i; ?></button></td>
                                    <?php endfor; ?>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <?php for($i=85;$i>=81;$i--): ?>
                                        <td><button type="button" class="btn btn-circle btn-default btn-sm"><?php echo $i; ?></button></td>
                                    <?php endfor; ?>
                                    <?php for($i=71;$i<=75;$i++): ?>
                                        <td><button type="button" class="btn btn-circle btn-default btn-sm"><?php echo $i; ?></button></td>
                                    <?php endfor; ?>
                                    <td colspan="3"></td>
                                </tr>
                            </table>
                        </div>
                    </li>
                </ul>

                <ul class="list-group">
                    <li class="list-group-item">
                        <label>
                            <input type="checkbox" name="services[]" value="GUM_TREATMENT" />
                            Gum Treatment
                        </label>
                    </li>
                    <div class="clearfix"></div>
                    <hr />
                    <button type="submit" class="btn-submit btn btn-success"><i class="fa fa-send"></i> Submit</button>
                    <?php endif; ?>
            </form>
        </div>
    </div>
</div>
<?php $controller->view('modal/tooth'); ?>
