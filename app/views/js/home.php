<?php $config = new Config(); ?>
<script src="<?php echo $config->base_url('dist/plugin/Chart.js/Chart.js'); ?>"></script>
<script>

    <?php echo 'var url = "'.$config->base_url('home/counts').'";';?>
    $.ajax({
        url: url,
        type: 'GET',
        success: function (jim) {
            var data = jQuery.parseJSON(jim);
            $('.target').html(data.target);
            $('.population').html(data.countPopulation);
            $('.percentage').html(data.profilePercentage+'%');
        }
    });

    <?php echo 'var url = "'.$config->base_url('home/charts').'";';?>
    var jim = [];
    $.ajax({
        url: url,
        type: 'GET',
        success: function(data) {
            var jim = jQuery.parseJSON(data);
            //chart created docs
            var ctx = document.getElementById("montlyProgress");
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: jim.months,
                    datasets: [{
                        label: '',
                        data: jim.count,
                        backgroundColor: [
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 206, 86, 1)',
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
            //end chart created docs
        }
    });
</script>