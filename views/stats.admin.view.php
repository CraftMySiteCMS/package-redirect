<?php
$title = REDIRECT_DASHBOARD_TITLE_STATS;
$description = REDIRECT_DASHBOARD_DESC_STATS;

$scripts = '<script rel="script" src="'.getenv("PATH_SUBFOLDER").'app/package/redirect/views/ressources/js/main.js"></script>';

ob_start();
/* @var redirectModel[] $redirect */
?>

<!-- Chart.js (stats charts) -->
<script src="<?=getenv("PATH_SUBFOLDER")?>admin/resources/vendors/chart.js/Chart.min.js"></script>

<canvas id="chartGlobal"></canvas>


<script>
    //CONFIG
    function random_rgb() {
        var o = Math.round, r = Math.random, s = 255;
        return 'rgb(' + o(r()*s) + ',' + o(r()*s) + ',' + o(r()*s) + ')';
    }

//todo juste show n° click / redirect

    var ctx = document.getElementById('chartGlobal').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['1', '2', '3', '4', '5'],
            datasets: [{
                label: 'Affichage des statistiques de redirection',
                data: [12, 19, 3, 5, 2],
                backgroundColor: [
                    random_rgb(),
                    random_rgb(),
                    random_rgb(),
                    random_rgb(),
                    random_rgb(),
                    random_rgb()
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>


<?php $content = ob_get_clean(); ?>

<?php require(getenv("PATH_ADMIN_VIEW").'template.php'); ?>
