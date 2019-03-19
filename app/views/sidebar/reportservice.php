<?php
$con = new Controller();

$bracket = $con->records('brackets','','id','asc');

$id = $_SESSION['id'];
$muncity_id = $con->getValue('users','muncity','id',$id);
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

$barangay = $con->records('barangay',$sub,'description','asc');
$service = $con->records('services','','description','asc');
$config = new Config();
$daterange = $data['daterange'];
?>
<div class="col-md-3 wrapper">
    <div class="panel panel-jim">
        <div class="panel-heading">
            <h3 class="panel-title">Filter Result</h3>
        </div>
        <div class="panel-body">
            <form class="form-inline" method="POST" action="<?php echo $config->base_url('report'); ?>">
                <table width="100%">
                    <tr>
                        <td>
                            <label>Date Range</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control active" id="reservation" name="daterange" value="<?php echo $daterange; ?>" placeholder="Input date range here..." autocomplete="off">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td> <br>
                            <label>Name</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </div>
                                <input type="text" class="form-control" name="name" value="<?php echo isset($data['name']) ? $data['name']: null; ?>" placeholder="Input name" autocomplete="off">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <br>
                            <label>Age Bracket</label>
                            <select name="bracket_id" class="form-control select2" style="width: 100%">
                                <option value="">Select All</option>
                                <?php $bracket_id = isset($data['bracket_id']) ? $data['bracket_id']: null; ?>
                                <?php foreach($bracket as $b): ?>
                                <option value="<?php echo $b->id; ?>"
                                        <?php if($bracket_id==$b->id): ?>
                                    selected
                                    <?php endif; ?>
                                    ><?php echo $b->description; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <br />
                            <label>Barangay</label>
                            <select name="barangay_id" class="form-control select2" style="width: 100%">
                                <option value="">Select All</option>
                                <?php $brgy_id = isset($data['barangay_id']) ? $data['barangay_id']: null; ?>
                                <?php foreach($barangay as $b): ?>
                                <option value="<?php echo $b->id; ?>"
                                        <?php if($brgy_id==$b->id): ?>
                                    selected
                                    <?php endif; ?>
                                    ><?php echo $b->description; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <br />
                            <label>Service Availed</label>
                            <select name="service_id" class="form-control select2" style="width: 100%">
                                <option value="">Select All</option>
                                <?php $service_id = isset($data['service_id']) ? $data['service_id']: null; ?>
                                <?php foreach($service as $s): ?>
                                <option value="<?php echo $s->id; ?>"
                                        <?php if($service_id==$s->id): ?>
                                    selected
                                    <?php endif; ?>
                                    ><?php echo $s->description; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <br />
                            <button type="submit" class="btn btn-success col-sm-12"><i class="fa fa-filter"></i> Filter</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
