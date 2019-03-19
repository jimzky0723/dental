<?php
$config = new Config();
$status = isset($_SESSION['status']) ? $_SESSION['status']:null;
unset($_SESSION['status']);
if($status=='serviceAdded'){
    ?>
    <script>
        Lobibox.notify('success', {
            msg: 'Successfully added!'
        });
    </script>
    <?php
}
?>

<script>
    $('.btn-status').on('click',function(){
        var date = $('#date').val();
        var profile_id = $('#profile_id').val();
        var brgy_id = $('#brgy_id').val();
        var bracket_id = $('#bracket_id').val();
        var femalestatus = $('input[name=femalestatus]:checked').val();

        $('.modal_date').val(date);
        $('.modal_profile_id').val(profile_id);
        $('.modal_barangay_id').val(brgy_id);
        $('.modal_bracket_id').val(bracket_id);
        $('.modal_female_status').val(femalestatus);

    });

    $('.btn-tooth').on('click',function(){
        var id = $(this).data('id');
        var service = $(this).data('service');
        var area = $(this).data('area');

        var date = $('#date').val();
        var profile_id = $('#profile_id').val();
        var brgy_id = $('#brgy_id').val();
        var bracket_id = $('#bracket_id').val();
        var femalestatus = $('input[name=femalestatus]:checked').val();

        $('.modal_date').val(date);
        $('.modal_profile_id').val(profile_id);
        $('.modal_barangay_id').val(brgy_id);
        $('.modal_bracket_id').val(bracket_id);
        $('.modal_tooth_no').val(id);
        $('.modal_female_status').val(femalestatus);
        $('.tooth_name').html(id);
        $('#'+area).modal('show');
    });

    $('input[type="checkbox"]').on('change',function(){
        var status = this.checked ? true : false;
        var code = $(this).val();

        if(code=='ORAL_EXAM'){
            if(status==true){
                $('.chart1').removeClass('hide');
            }else{
                $('.chart1').addClass('hide');
            }
        }

        if(code=='PERMANENT_FILLING'){
            if(status==true){
                $('.chart2').removeClass('hide');
            }else{
                $('.chart2').addClass('hide');
            }
        }

        if(code=='TEMPORARY_FILLING'){
            if(status==true){
                $('.chart3').removeClass('hide');
            }else{
                $('.chart3').addClass('hide');
            }
        }

        if(code=='TOOTH_EXTRACTION'){
            if(status==true){
                $('.chart4').removeClass('hide');
            }else{
                $('.chart4').addClass('hide');
            }
        }

    });

    function showChart1(form)
    {
        var code = form.val();
        if(code==='code_TF' || code==='code_PFCo'|| code==='code_PFAm'|| code==='code_D'){
            $('.chart1').removeClass('hide');
        }else{
            $('.chart1').addClass('hide');
        }
    }

    function showCode(btn)
    {

        var number = btn.val();

        if(btn.hasClass('btn-default')){
            btn.removeClass('btn-default').addClass('btn-success');
            if(number==1){
                $('.modal_b1').val('1');
            }
            if(number==2){
                $('.modal_b2').val('1');
            }
            if(number==3){
                $('.modal_b3').val('1');
            }
            if(number==4){
                $('.modal_b4').val('1');
            }
            if(number==5){
                $('.modal_b5').val('1');
            }
        }else{
            btn.removeClass('btn-success').addClass('btn-default');
            if(number==1){
                $('.modal_b1').val('0');
            }
            if(number==2){
                $('.modal_b2').val('0');
            }
            if(number==3){
                $('.modal_b3').val('0');
            }
            if(number==4){
                $('.modal_b4').val('0');
            }
            if(number==5){
                $('.modal_b5').val('0');
            }
        }
        var b1= $('.modal_b1').val();
        var b2= $('.modal_b2').val();
        var b3= $('.modal_b3').val();
        var b4= $('.modal_b4').val();
        var b5= $('.modal_b5').val();

        var code = b1+b2+b3+b4+b5;
        $('.modal_code').val(code);
    }
</script>
