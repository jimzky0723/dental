<?php
$config = new Config();
$status = isset($_SESSION['status']) ? $_SESSION['status']:null;
unset($_SESSION['status']);
if($status=='serviceDeleted'){
    ?>
    <script>
        Lobibox.notify('success', {
            msg: 'Successfully deleted!'
        });
    </script>
    <?php
}
?>
<script>
    $('#reservation').daterangepicker();

    $('a[href="#remove"]').on('click',function(){
        var id = $(this).data('id');
        $('#currentID').val(id);
    });
</script>