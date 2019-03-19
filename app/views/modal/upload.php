<?php
    $config = new Config();
?>

<div class="modal fade" role="dialog" id="uploadData">
    <div class="modal-dialog modal-sm" role="document">
        <form method="POST" action="<?php echo $config->base_url('record/upload'); ?>" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <i class="fa fa-file-excel-o"></i> UPLOAD DATA
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="file" name="file" class="form-control" required accept=".DOH7" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="submit" class="btn btn-success btn-sm btn-submit" ><i class="fa fa-download"></i> Upload</button>
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" role="dialog" id="downloadData">
    <div class="modal-dialog modal-sm" role="document">
        <form method="POST" action="<?php echo $config->base_url('record/download'); ?>" class="form-submit">
            <div class="modal-content">
                <div class="modal-header">
                    <i class="fa fa-calendar"></i> Select Year
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <select class="form-control chosen-select" name="month" required>
                            <?php
                                $monthNow = date('m');
                            ?>
                            <option value="">Select Month...</option>
                            <option <?php if($monthNow=='01') echo 'selected'; ?> value="01">January</option>
                            <option <?php if($monthNow=='02') echo 'selected'; ?> value="02">February</option>
                            <option <?php if($monthNow=='03') echo 'selected'; ?> value="03">March</option>
                            <option <?php if($monthNow=='04') echo 'selected'; ?> value="04">April</option>
                            <option <?php if($monthNow=='05') echo 'selected'; ?> value="05">May</option>
                            <option <?php if($monthNow=='06') echo 'selected'; ?> value="06">June</option>
                            <option <?php if($monthNow=='07') echo 'selected'; ?> value="07">July</option>
                            <option <?php if($monthNow=='08') echo 'selected'; ?> value="08">August</option>
                            <option <?php if($monthNow=='09') echo 'selected'; ?> value="09">September</option>
                            <option <?php if($monthNow=='10') echo 'selected'; ?> value="10">October</option>
                            <option <?php if($monthNow=='11') echo 'selected'; ?> value="11">November</option>
                            <option <?php if($monthNow=='12') echo 'selected'; ?> value="12">December</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control chosen-select" name="year" required>
                            <option value="">Select Year...</option>
                            <?php $yearNow = date('Y'); ?>
                            <?php $current = date('Y'); ?>
                            <?php for($i=10;$i>0;$i--): ?>
                            <option <?php if($current==$yearNow) echo 'selected'; ?>><?php echo $yearNow; ?></option>
                            <?php $yearNow-- ;?>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="submit" class="btn btn-success btn-sm btn-submit" ><i class="fa fa-download"></i> Download</button>
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->