<?php
    $config = new Config();
?>
<div class="modal fade" role="dialog" id="remove">
    <div class="modal-dialog modal-sm" role="document">
        <form method="GET" action="<?php echo $config->base_url('delete'); ?>">
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