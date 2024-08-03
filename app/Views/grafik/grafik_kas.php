<!-- ./Grafik -->
<div class="col-lg-12">
    <div class="card">
        <div class="card-header border-0">
            <div class="d-flex justify-content-between">
                <h3 class="card-title">Kas Masjid</h3>
            </div>
        </div>
        <div class="card-body">
            <div class="position-relative mb-4">
                <canvas id="sales-chart" height="200"></canvas>
            </div>
        </div>
    </div>
    <!-- /.card -->
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById("sales-chart").getContext("2d");

        // Menggabungkan nama bulan dan tahun
        var labels = <?= json_encode(array_map(function($item) {
            return $item['nama_bulan'] . ' ' . $item['tahun'];
        }, $sales_data)) ?>;

        var salesChart = new Chart(ctx, {
            type: "line",
            data: {
                labels: labels,
                datasets: [{
                    label: "Pemasukan",
                    backgroundColor: "rgba(54, 162, 235, 0.2)",
                    borderColor: "rgba(54, 162, 235, 1)",
                    borderWidth: 1,
                    data: <?= json_encode(array_column($sales_data, 'total_kas_masuk')) ?>,
                }, {
                    label: "Pengeluaran",
                    backgroundColor: "rgba(255, 99, 132, 0.2)",
                    borderColor: "rgba(255, 99, 132, 1)",
                    borderWidth: 1,
                    data: <?= json_encode(array_column($sales_data, 'total_kas_keluar')) ?>,
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
    });
</script>
