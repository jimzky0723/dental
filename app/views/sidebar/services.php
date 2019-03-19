<?php
//$bracket = Bracket::orderBy('id','asc')->get();
//$barangay = Barangay::where('muncity_id',Auth::user()->muncity)->orderBy('description','asc')->get();
//$service = Service::orderBy('description','asc')->get();
$config = new Config();
$controller = new Controller();
$con = new Controller();
$population = $data['population'];
$id = $data['id'];
$dentist = $controller->records('doctors',null,'lname','asc');
$current_doctor = isset($_SESSION['doctor_id']) ? $_SESSION['doctor_id'] : 0;
?>
<span id="url" data-link="{{ asset('date_in') }}"></span>
<div class="col-md-3 wrapper">
    <div class="panel panel-jim">
        <div class="panel-heading">
            <h3 class="panel-title">Select Dentist</h3>
        </div>
        <div class="panel-body">
            <form method="POST" action="<?php echo $config->base_url('services/select_doctor');?>">
                <div class="form-group">
                    <select class="select2 form-control" name="doctor_id">
                        <option value="">Select Dentist</option>
                        <?php foreach($dentist as $row): ?>
                            <option
                                <?php if($current_doctor==$row->id) echo 'selected';?>
                                value="<?php echo $row->id;?>">Dr. <?php echo $row->fname.' '.$row->mname.' '.$row->lname; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="col-sm-12 btn btn-success btn-select"><i class="fa fa-user-md"></i> Select</button>
                </div>
            </form>
        </div>
    </div>

    <div class="panel panel-jim">
        <div class="panel-heading">
            <h3 class="panel-title">Filter Result</h3>
        </div>
        <div class="panel-body">
            <form class="form-inline" method="POST" action="<?php echo $config->base_url('services'); ?>">
                <table width="100%">
                    <tr>
                        <td>
                            <label>Select Date</label><br />
                            <?php $date = isset($_SESSION['dateProfile']) ? $_SESSION['dateProfile']: Date('Y-m-d'); ?>
                            <input type="date" value="<?php echo $date; ?>" class="form-control" name="date" style="width: 100%;" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <br>
                            <label>Search Profile</label>
                            <?php $keyword = isset($_SESSION['profileKeyword']) ? $_SESSION['profileKeyword']: null;?>
                            <input type="text" style="width: 100%;" class="form-control" name="profileKeyword" value="<?php echo $keyword;?>" placeholder="Search Profile" />
                        </td>
                    </tr>
                    <tr>
                        <td><br>
                            <button type="submit" class="col-sm-12 btn btn-success btn-select"><i class="fa fa-filter"></i> Filter</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

    <div class="panel panel-jim">
        <div class="panel-heading">
            <h3 class="panel-title">Select Profile</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-hover">
            <?php foreach($population as $row): ?>
                <tr>
                    <td>
                        <div class="pull-right">
                            <?php
                                $tmp = null;
                                if(isset($_GET['page'])){
                                    $tmp = '?page=' . $_GET['page'];
                                }
                            ?>
                            <a href="<?php echo $config->base_url('services/'.$row->id.''.$tmp)?>" class="btn btn-sm btn-success"><i class="fa fa-arrow-right"></i> </a>
                        </div>
                        <?php echo $row->fname;?>
                        <?php echo $row->mname;?>
                        <?php echo $row->lname;?>
                        <?php echo $row->suffix;?>
                        <br />
                        <small class="text-info">[<?php echo $row->familyID;?>]</small>
                    </td>
                </tr>
            <?php endforeach; ?>
            </table>
            <?php if(count($population)<1): ?>
            <div class="alert alert-warning">
                <font class="text-warning">No profile found!</font>
            </div>
            <?php endif; ?>
            <div class="text-center">
                <ul class="pagination">
                    <?php
                    $param = new Parameter();
                    $paging_info = $param->get_paging_info($data['total'],10,$data['page']);
                    ?>
                    <?php if($paging_info['curr_page'] > 1) : ?>
                        <li><a href="?page=1" title='Page 1'>First</a></li>
                        <li><a href="?page=<?php echo ($paging_info['curr_page'] - 1); ?>" title='Page <?php echo ($paging_info['curr_page'] - 1); ?>'>Prev</a></li>
                    <?php endif; ?>

                    <?php
                    //setup starting point

                    //$max is equal to number of links shown
                    $max = 3;

                    if($paging_info['curr_page'] < $max)
                        $sp = 1;
                    elseif($paging_info['curr_page'] >= ($paging_info['pages'] - floor($max / 2)) )
                        $sp = $paging_info['pages'] - $max + 1;
                    elseif($paging_info['curr_page'] >= $max)
                        $sp = $paging_info['curr_page']  - floor($max/2);
                    ?>
                    <!-- If the current page >= $max then show link to 1st page -->
                    <?php if($paging_info['curr_page'] >= $max) : ?>

                        <li><a href="?page=1" title='Page 1'>1</a></li>
                        <li><span>...</span> </li>

                    <?php endif; ?>

                    <!-- Loop though max number of pages shown and show links either side equal to $max / 2 -->
                    <?php for($i = $sp; $i <= ($sp + $max -1);$i++) : ?>

                        <?php
                        if($i > $paging_info['pages'])
                            continue;
                        ?>

                        <?php if($paging_info['curr_page'] == $i) : ?>

                            <li class="active"><span class='bold'><?php echo $i; ?></span></li>

                        <?php else : ?>

                            <li><a href="?page=<?php echo $i; ?>" title='Page <?php echo $i; ?>'><?php echo $i; ?></a></li>

                        <?php endif; ?>

                    <?php endfor; ?>


                    <!-- If the current page is less than say the last page minus $max pages divided by 2-->
                    <?php if($paging_info['curr_page'] < ($paging_info['pages'] - floor($max / 2))) : ?>

                        <li><span>...</span> </li>
                        <li><a href="?page=<?php echo $paging_info['pages']; ?>" title='Page <?php echo $paging_info['pages']; ?>'><?php echo $paging_info['pages']; ?></a></li>

                    <?php endif; ?>

                    <!-- Show last two pages if we're not near them -->
                    <?php if($paging_info['curr_page'] < $paging_info['pages']) : ?>

                        <li><a href="?page=<?php echo ($paging_info['curr_page'] + 1); ?>" title='Page <?php echo ($paging_info['curr_page'] + 1); ?>'>Next</a></li>

                        <li><a href="?page=<?php echo $paging_info['pages']; ?>" title='Page <?php echo $paging_info['pages']; ?>'>Last</a></li>

                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

