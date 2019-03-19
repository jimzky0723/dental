<?php
$config = new Config();
$status = isset($_SESSION['status']) ? $_SESSION['status']:null;
unset($_SESSION['status']);
if($status=='dataAdded'){
?>
    <script>
        Lobibox.notify('success', {
            msg: 'Data uploaded successfully!'
        });
    </script>
<?php
}
?>

<?php
if($status=='dataSaved'){
    ?>
    <script>
        Lobibox.notify('success', {
            msg: 'Successfully added!'
        });
    </script>
    <?php
}
?>

<?php
if($status=='dataUpdated'){
    ?>
    <script>
        Lobibox.notify('success', {
            msg: 'Successfully updated!'
        });
    </script>
    <?php
}
?>

<?php
if($status=='dataRemoved'){
    ?>
    <script>
        Lobibox.notify('success', {
            msg: 'Successfully deleted!'
        });
    </script>
    <?php
}
?>

<?php
if($status=='dataDuplicate'){
    ?>
    <script>
        Lobibox.notify('error', {
            msg: 'Duplicate Data!'
        });
    </script>
    <?php
}
?>

<script>
    $('#head').on("change",function(){
        var head = $(this).val();
        if(head=='NO'){
            $('.relation').removeClass('hide');
        }else{
            $('.relation').addClass('hide');
        }
    });

    $('a[href="#familyProfile"]').on('click',function(){
        <?php echo 'var url="'.$config->base_url('population/member').'";';?>
        var id = $(this).data('id');
        $('.family-list').html('<center><img src="<?php echo $config->base_url('dist/img/spin.gif')?>" width="100"></center>');
        $.ajax({
            url: url+'/'+id,
            type: 'GET',
            success: function(data){
                var jim = jQuery.parseJSON(data);
                var content = '<ul class="list-group">';
                jQuery.each(jim,function(i,val){
                    content += '<li class="list-group-item">';
                    content += val.lname+', '+val.fname+' '+val.mname+' '+val.suffix;
                    content += '<br/><small>('+val.relation+')</small>';
                    content += '</li>';
                });
                content += '</ul>';
                $('.family-list').html(content);
            }
        });

    });
</script>


