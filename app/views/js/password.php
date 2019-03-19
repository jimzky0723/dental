<?php
$status = isset($_SESSION['status']) ? $_SESSION['status']:null;
unset($_SESSION['status']);
$try = isset($_SESSION['tryPass']) ? $_SESSION['tryPass']:0;
?>
<?php if($status=='updated'): ?>
<script>
    Lobibox.notify('success', {
        msg: 'Password successfully changed!'
    });
</script>
<?php endif; ?>
<?php if($status=='incorrect'): ?>
<?php
if($try>1){
    $msg = 'You have '.(3-$try).' try left!';
} else{
    $msg = 'You have '.(3-$try).' tries left!';
}
?>
<script>
    Lobibox.notify('error', {
        msg: 'Current password is incorrect. <?php echo $msg;?>'
    });
</script>
<?php endif; ?>
<?php if($status=='notsame') : ?>
<script>
    Lobibox.notify('error', {
        msg: 'Password did not match!'
    });
</script>
<?php endif; ?>