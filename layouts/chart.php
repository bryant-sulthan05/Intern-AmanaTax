<?php
$chart = mysqli_query($config, "SELECT MONTHNAME(updated_at) as monthname, SUM(total) as jumlah FROM transaction WHERE status = 'approved' GROUP BY monthname ORDER BY updated_at");
foreach ($chart as $data) {
    $month[] = $data['monthname'];
    $jumlah[] = $data['jumlah'];
}
?>
<style>
    @media only screen and (max-width: 426px) {
        .chart-section {
            padding: 0px;
            margin-top: 20px;
        }
    }

    @media only screen and (min-width: 992px) {
        .chart-section {
            padding: 50px;
            margin-top: 0px;
        }
    }
</style>
<div class="table-container">
    <div class="container w-100 chart-section">
        <canvas id="myChart"></canvas>
    </div>
</div>
<script>
    const labels = <?= json_encode($month) ?>;
    const data = {
        labels: labels,
        datasets: [{
            label: 'Keuangan Tahunan',
            data: <?= json_encode($jumlah) ?>,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(201, 203, 207, 0.2)'
            ],
            borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
            ],
            borderWidth: 1
        }]
    };
    const config = {
        type: 'bar',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
    };

    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
</script>