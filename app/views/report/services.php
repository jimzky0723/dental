<?php
$controller = new Controller();
$config = new Config();
$param = new Parameter();
$total = $data['totalRecords'];
$profiles = $data['profiles'];
$daterange = $data['daterange'];
$bracket_id = $data['bracket_id'];
$barangay_id = $data['barangay_id'];
$service_id = $data['service_id'];
$name = $data['name'];
?>
<?php $controller->view('sidebar/reportservice',$data); ?>
<div class="col-md-9 wrapper">
    <div class="alert alert-jim">
        <div class="result pull-right text-bold text-right">
            <div class="text-info">Date: <?php echo $daterange ; ?></div>
            <div class=" text-success">Result: <?php echo $total ; ?></div>
        </div>
        <h2 class="page-header">Services Availed</h2>
        <div class="clearfix"></div>
        <?php if(count($profiles)): ?>
        <div class="table-responsive">
            <table class="table table-striped talble-hover">
                <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Age</th>
                    <th>Service Availed</th>
                    <th>Barangay</th>
                    <th>Date</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php $holder = 0;?>
                <?php foreach($profiles as $p): ?>
                <tr>
                    <td class="text-bold text-success">
                        <?php if($holder!=$p->profile_id): ?>
                        <?php
                        $user = $controller->info('profile',$p->profile_id);
                        ?>
                        <?php echo $user->lname ; ?>, <?php echo $user->fname ; ?> <?php echo $user->mname ; ?> <?php echo $user->suffix ; ?>
                        <?php else: ?>
                        <?php $holder=$p->profile_id; ?>
                        <?php endif; ?>
                    </td>
                    <td class="text-info">
                        <?php if($holder!=$p->profile_id): ?>
                        <?php echo $param->getStaticAge($user->dob,$p->dateProfile);?>
                        <?php endif; ?>
                    </td>
                    <td class="text-info">
                        <?php echo $controller->getValue('services','description','id',$p->service_id); ?>
                    </td>
                    <td class="text-info">
                        <?php if($holder!=$p->profile_id): ?>
                        <?php $holder = $p->profile_id; ?>
                        <?php echo $controller->getValue('barangay','description','id',$p->barangay_id) ; ?>
                        <?php endif; ?>
                    </td>
                    <td class="text-info"><?php echo date('M d, Y',strtotime($p->dateProfile)) ; ?></td>
                    <td><a href="#remove" data-toggle="modal" data-id="<?php echo $p->id ; ?>" class="text-danger"><i class="fa fa-times"></i></a></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="text-center">
            <?php
            $last = ceil($data['total'] / $data['limit']);
            $start = 1;
            if($last>1):
                ?>
                <ul class="pagination">
                    <li class="disabled"><span>Page</span></li>
                    <?php for($i=1;$i<=$last;$i++): ?>
                        <?php if($i==$data['page']): ?>
                            <li class="active"><span><?php echo $i; ?></span></li>
                        <?php else: ?>
                            <li><a href="?page=<?php echo $i; ?>" rel="next"><?php echo $i; ?></a></li>
                        <?php endif; ?>
                    <?php endfor; ?>
                    <li class="<?php if($last==$data['page']) echo 'disabled'; ?>"><a href="?page=<?php echo $last; ?>" rel="next">Last</a></li>
                </ul>
            <?php endif; ?>
        </div>
        <?php else: ?>
        <div class="alert alert-warning">
            <p class="text-warning"><i class="fa fa-warning"></i> No data!</p>
        </div>
        <?php endif; ?>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="remove">
    <div class="modal-dialog modal-sm" role="document">
        <form method="POST" action="<?php echo $config->base_url('report/removeService') ; ?>">

            <div class="modal-content">
                <input type="hidden" name="currentID" id="currentID" />
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
<?php $controller->view('modal/upload'); ?>
