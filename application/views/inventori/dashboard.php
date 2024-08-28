
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <!-- Main content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Sistem Informasi Inventori (SIMI)</h1>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <?php if($this->session->userdata('role_id')==1){?>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                            <h3 class="card-title">Log Data</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                            <table id="item" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>User</th>
                                    <th>Aktivitas</th>
                                    <th>Created At</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=1; foreach ($logdata as $ld) {?>
                                <tr>
                                    <td><?=$i++;?></td>
                                    <td><?=$ld['username']?></td>
                                    <td><?=$ld['act_note']?></td>
                                    <td><?=strftime('%d %B %Y', strtotime($ld['act_date']))?></td>
                                </tr>
                                <?php }?>
                                </tbody>
                            </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <?php } ?>
            <!-- /.content -->
            <?php if($this->session->userdata('role_id') == 2){?>
            <!-- Dashboard List -->
            <section class="content" id="dashboard-section">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama Cluster</th>
                                        <th>Kode Item</th>
                                        <th>Nama Item</th>
                                        <th>Total Item</th>
                                        <th>Jenis</th>
                                        <th>Harga Satuan</th>
                                        <th>Info Detail</th>
                                    </tr>
                                </thead>
                                <tbody id="data-list">
                                    <?php if (!empty($dashboard_data)) : ?>
                                        <?php foreach ($dashboard_data as $cluster) : ?>
                                            <tr>
                                                <td><?= $cluster['nama_cluster']; ?></td>
                                                <td><?= $cluster['kode_item']; ?></td>
                                                <td><?= $cluster['nama']; ?></td>
                                                <td><?= $cluster['total_items']; ?></td>
                                                <td><?= $cluster['jenis']; ?></td>
                                                <td><?= $cluster['harga_satuan']; ?></td>
                                                <td><a href="#" class="more-info" data-report="<?= $cluster['kode_item']; ?>" data-item-name="<?= $cluster['nama']; ?>">More info</a></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="7">No data available</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Additional Chart Section -->
            <section class="content" id="additional-chart-section" style="display: none;">
                <div class="container-fluid">
                    <div class="row">
                        <!-- Chart Section -->
                        <div class="col-md-8">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title" id="chart-title">Grafik Bulanan</h3>
                                    <div class="float-right d-flex align-items-center">
                                        <!-- Dropdown for selecting chart type -->
                                        <div class="form-group mr-2 mb-0">
                                            <select id="chart-type-selector" class="form-control">
                                                <option value="line">Stok</option>
                                                <option value="bar">Pembelian/Penggunaan</option>
                                            </select>
                                        </div>
                                        <!-- Back button -->
                                        <button id="back-button-chart" class="btn btn-danger">Back</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="chartContainer" style="height: 400px;">
                                        <canvas id="lineChartUnique"></canvas>
                                    </div>
                                    <div id="noDataText" style="display: none; text-align: center; color: red;">No Data</div>
                                </div>
                            </div>
                        </div>

                        <!-- Date Picker Section for Line Chart -->
                        <div class="col-md-4 ml-auto" id="lineChartDatePickers">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Date Picker (Line Chart)</h3>
                                </div>
                                <div class="card-body">
                                    <!-- Date Start -->
                                    <div class="form-group">
                                        <label>Select Start Month:</label>
                                        <div class="input-group date" id="datestart" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" data-target="#datestart" />
                                            <div class="input-group-append" data-target="#datestart" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Date End -->
                                    <div class="form-group">
                                        <label>Select End Month:</label>
                                        <div class="input-group date" id="dateend" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" data-target="#dateend" />
                                            <div class="input-group-append" data-target="#dateend" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Date Picker Section for Bar Chart -->
                        <div class="col-md-4 ml-auto" id="barChartDatePicker" style="display: none;">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Select Month and Year (Bar Chart)</h3>
                                </div>
                                <div class="card-body">
                                    <!-- Month and Year Picker -->
                                    <div class="form-group">
                                        <label>Select Month:</label>
                                        <div class="input-group date" id="monthYearPicker" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" data-target="#monthYearPicker" />
                                            <div class="input-group-append" data-target="#monthYearPicker" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
            <script>
                var $j = jQuery.noConflict();
            </script>
            <?php }?>
        </div>

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="<?= base_url('assets/img/AdminLTELogo.png') ?>" alt="AdminLTELogo" height="60" width="60">
        </div>
    </div>

    <aside class="control-sidebar control-sidebar-dark"></aside>

    <!-- REQUIRED SCRIPTS -->
    <script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
    
    <script src="<?= base_url('assets/plugins/moment/moment.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- DataTables  & Plugins -->
    <script src="<?=base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
    <script src="<?=base_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')?>"></script>
    <script src="<?=base_url('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')?>"></script>
    <script src="<?=base_url('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')?>"></script>
    <script src="<?=base_url('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')?>"></script>
    <script src="<?=base_url('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')?>"></script>
    <script src="<?=base_url('assets/plugins/jszip/jszip.min.js')?>"></script>
    <script src="<?=base_url('assets/plugins/pdfmake/pdfmake.min.js')?>"></script>
    <script src="<?=base_url('assets/plugins/pdfmake/vfs_fonts.js')?>"></script>
    <script src="<?=base_url('assets/plugins/datatables-buttons/js/buttons.html5.min.js')?>"></script>
    <script src="<?=base_url('assets/plugins/datatables-buttons/js/buttons.print.min.js')?>"></script>
    <script src="<?=base_url('assets/plugins/datatables-buttons/js/buttons.colVis.min.js')?>"></script>
    
    <script src="<?= base_url('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/daterangepicker/daterangepicker.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/chart.js/Chart.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/adminlte.js') ?>"></script>

    <script>
        $(function () {
                    $('#item').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                    });
        });
        $j(document).ready(function() {
            let lineChartUnique; // Unique variable for this chart
            let currentItemCode = ""; // Store the currently selected item code

            function initializeLineChartUnique(data, chartType = 'line') {
            const ctx = document.getElementById('lineChartUnique').getContext('2d');
            if (lineChartUnique) {
                lineChartUnique.destroy(); // Destroy the old chart before creating a new one
            }

            const chartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: 'white',
                            precision: 0,
                            callback: function(value) {
                                return Math.floor(value).toFixed(0);
                            }
                        }
                    },
                    x: {
                        ticks: {
                            color: 'white'
                        }
                    }
                },
                elements: {
                    line: {
                        tension: 0,
                        borderWidth: 5
                    },
                    point: {
                        radius: 6
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: 'white'
                        }
                    }
                }
            };

            if (chartType === 'line') {
                lineChartUnique = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: data.labels,
                        datasets: [{
                            label: `Total Quantity for ${data.item_name}`,
                            data: data.data,
                            borderColor: 'lightcoral',
                            borderWidth: 5,
                            backgroundColor: 'transparent',
                            pointBackgroundColor: 'white',
                            pointBorderColor: 'lightcoral',
                            pointBorderWidth: 2,
                            pointRadius: 6,
                        }]
                    },
                    options: chartOptions
                });
            } else if (chartType === 'bar') {
                lineChartUnique = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: data.labels,
                        datasets: [{
                            label: 'Pembelian',
                            data: Object.values(data.data.purchase),
                            backgroundColor: 'lightcoral',
                            borderColor: 'white',
                            borderWidth: 1
                        }, {
                            label: 'Pemakaian',
                            data: Object.values(data.data.usage),
                            backgroundColor: 'lightblue',
                            borderColor: 'white',
                            borderWidth: 1
                        }]
                    },
                    options: chartOptions
                });
            }
        }

            $j('.more-info').on('click', function(event) {
                event.preventDefault();
                const kodeItem = $j(this).data('report');
                currentItemCode = kodeItem;
                const chartType = $j('#chart-type-selector').val();

                $j('#lineChartUnique').remove(); 
                $j('#chartContainer').append('<canvas id="lineChartUnique"></canvas>');

                $j.ajax({
                    url: '<?= site_url('inventori/proses/more_info') ?>',
                    type: 'POST',
                    data: { kode_item: currentItemCode, chart_type: chartType },
                    success: function(response) {
                        const data = JSON.parse(response);
                        initializeLineChartUnique(data, chartType);
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX error: ', status, error);
                    }
                });

                $j('#dashboard-section').slideUp('slow', function() {
                    $j('#additional-chart-section').slideDown('slow');
                });
                $j('#chart-title').text(`Grafik Bulanan - ${kodeItem}`);
            });

            $j('#chart-type-selector').on('change', function() {
                const selectedChartType = $j(this).val();
                if (selectedChartType === 'bar') {
                    $j('#lineChartDatePickers').hide();
                    $j('#barChartDatePicker').show();
                } else {
                    $j('#barChartDatePicker').hide();
                    $j('#lineChartDatePickers').show();
                }
                if (currentItemCode) {
                    $j('.more-info[data-report="' + currentItemCode + '"]').trigger('click');
                }
            });

            $j('#back-button-chart').on('click', function() {
                $j('#additional-chart-section').slideUp('slow', function() {
                    $j('#dashboard-section').slideDown('slow');
                });
            });

            // Datetime picker initialization for Line Chart (Month-Year only)
            $j('#datestart').datetimepicker({
                format: 'YYYY-MM',
                viewMode: 'months'
            });

            $j('#dateend').datetimepicker({
                format: 'YYYY-MM',
                viewMode: 'months',
                useCurrent: false
            });

            $j("#datestart").on("change.datetimepicker", function(e) {
                $j('#dateend').datetimepicker('minDate', e.date);
            });

            $j("#dateend").on("change.datetimepicker", function(e) {
                $j('#datestart').datetimepicker('maxDate', e.date);
            });

            // Datetime picker initialization for Bar Chart (Month-Year only)
            $j('#monthYearPicker').datetimepicker({
                format: 'YYYY-MM',
                viewMode: 'months'
            });

            $j('#monthYearPicker').on('change.datetimepicker', function(e) {
                const selectedMonthYear = e.date.format('YYYY-MM');
                if ($j('#chart-type-selector').val() === 'bar') {
                    const barChartData = getBarChartDataForMonth(selectedMonthYear);
                    initializeLineChartUnique(barChartData, 'bar');
                }
            });
        });
    </script>
</body>

</html>