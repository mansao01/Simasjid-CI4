<!-- ./Grafik Dana Kegiatan -->
<div class="col-lg-12">
    <div class="card">
        <div class="card-header border-0">
            <div class="d-flex justify-content-between">
                <h3 class="card-title">Dana Kegiatan</h3>
            </div>
        </div>
        <div class="card-body">
            <div class="position-relative mb-4">
                <canvas id="sales-chart-1" height="200"></canvas>
            </div>
        </div>
    </div>
    <!-- /.card -->
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
<!-- ./Menampilkan Data Dana Kegiatan -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById("sales-chart-1").getContext("2d");

        var salesChart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: <?= json_encode(array_column($dana_kegiatan, 'kegiatan')) ?>,
                datasets: [{
                    label: "Pemasukan",
                    backgroundColor: "rgba(54, 162, 235, 0.2)",
                    borderColor: "rgba(54, 162, 235, 1)",
                    borderWidth: 1,
                    data: <?= json_encode(array_column($dana_kegiatan, 'total_pemasukan')) ?>,
                }, {
                    label: "Pengeluaran",
                    backgroundColor: "rgba(255, 99, 132, 0.2)",
                    borderColor: "rgba(255, 99, 132, 1)",
                    borderWidth: 1,
                    data: <?= json_encode(array_column($dana_kegiatan, 'total_pengeluaran')) ?>,
                }]
            },
            options: {
                scales: {
                    x: {
                        ticks: {
                            autoSkip: false, // Menonaktifkan penjajaran otomatis
                            maxRotation: -90, // Rotasi maksimum label (dalam derajat)
                            minRotation: -90, // Rotasi minimum label (dalam derajat)
                            padding: 10, // Padding antara label dan sumbu
                            mirror: true // Memperluas label di luar sumbu
                        }
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>