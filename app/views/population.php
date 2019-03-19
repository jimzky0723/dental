<?php
$controller = new Controller();
$config = new Config();
$population = $data['population'];
$profileKeyword = '';
if(isset($_SESSION['profileKeyword'])){
    $profileKeyword = $_SESSION['profileKeyword'];
}
?>
<div class="col-md-12 wrapper">
    <div class="alert alert-jim">
        <h2 class="page-header">Manage Population</h2>
        <form class="form-inline" method="POST" action="<?php echo $config->base_url('population'); ?>">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Quick Search" name="keyword" value="<?php echo $profileKeyword; ?>" autofocus>
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i> Search</button>
                <?php if($profileKeyword!=''): ?>
                <button type="submit" class="btn btn-warning" name="viewAll" value="true"><i class="fa fa-search"></i> View All</button>
                <?php endif; ?>
                <a href="<?php echo $config->base_url('population/add/head'); ?>" class="btn btn-info"><i class="fa fa-user-plus"></i> Add Family Head Profile</a>
            </div>
        </form>
        <div class="page-divider"></div>
        <div class="table-responsive">
            <?php if($population): ?>
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th></th>
                    <th>Family ID</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Suffix</th>
                    <th>Age</th>
                    <th>Sex</th>
                    <th>Barangay</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($population as $p): ?>
                <tr>
                    <td nowrap="TRUE">
                        <form action="<?php echo $config->base_url('population/details/'); ?>" method="post">
                            <button type="submit" class="btn btn-xs btn-success" value="<?php echo $p->id; ?>" name="currentID"><i class="fa fa-eye"></i> View</button>
                            <a href="<?php echo $config->base_url('population/add/member/' . $p->familyID); ?>" class="btn btn-xs btn-info">
                                <i class="fa fa-user-plus"></i> Add Member
                            </a>
                        </form>
                    </td>
                    <td>
                        <a href="#familyProfile" data-id="<?php echo $p->familyID ; ?>" data-toggle="modal" class="title-info">
                            <?php echo  $p->familyID; ?>
                        </a>
                    </td>
                    <td class="<?php if($p->head=='YES') echo 'text-bold text-primary';?>"><?php echo ($p->lname) ; ?></td>
                    <td class="<?php if($p->head=='YES') echo 'text-bold text-primary';?>"><?php echo ($p->fname) ; ?></td>
                    <td class="<?php if($p->head=='YES') echo 'text-bold text-primary';?>"><?php echo ($p->mname) ; ?></td>
                    <td><?php echo  $p->suffix ; ?></td>
                    <td>
                        <?php
                        $param = new Parameter();
                        $age = $param->getAge($p->dob);
                        $tmp = '';

                        if($age==0){
                            $age = $param->getAgeMonth($p->dob);
                            $tmp = 'M/o';
                        }
                        if($age==0){
                            $age = $param->getAgeDay($p->dob);
                            $tmp = 'D/o';
                        }
                        if($tmp){
                            echo '<small class="text-info">('.$age.' '.$tmp.')</small>';
                        }else{
                            echo $age;
                        }
                        ?>
                    </td>
                    <td><?php echo $p->sex ; ?></td>
                    <td><?php echo  $controller->getValue('barangay','description','id',$p->barangay_id) ; ?></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <div class="text-center">
                <ul class="pagination">
                <?php
                    $param = new Parameter();
                    $paging_info = $param->get_paging_info($data['total'],25,$data['page']);
                ?>
                <?php if($paging_info['curr_page'] > 1) : ?>
                    <li><a href="?page=1" title='Page 1'>First</a></li>
                    <li><a href="?page=<?php echo ($paging_info['curr_page'] - 1); ?>" title='Page <?php echo ($paging_info['curr_page'] - 1); ?>'>Prev</a></li>
                <?php endif; ?>

                <?php
                //setup starting point

                //$max is equal to number of links shown
                $max = 7;

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
            <?php else: ?>
            <div class="alert alert-info">
                <p class="text-info"><i class="fa fa-info-circle fa-lg text-bold"></i> You don't have any profiles in your location!</p>
            </div>
            <?php endif; ?>
        </div>
    </div>

</div>
<div class="modal fade" role="dialog" id="familyProfile">
    <div class="modal-dialog modal-sm" role="document">
        <input type="hidden" name="currentID" id="currentID">
        <div class="modal-content">
            <div class="modal-body">
                <fieldset>
                    <legend><i class="fa fa-users"></i> Family Member</legend>
                    <div class="family-list">
                        <center>
                            <img src="<?php echo $config->base_url('dist/img/spin.gif')?>" width="100" />
                        </center>
                    </div>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php $controller->view('modal/upload'); ?>
