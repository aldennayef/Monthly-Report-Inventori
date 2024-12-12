<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Informasi Inventori (SIMI) - Dynamic Data</title>

    <!-- Load jQuery -->
    <script src="<?= base_url('assets/inventori/js/jquery.min.js'); ?>"></script>
    <!-- Load Moment.js -->
    <script src="<?= base_url('assets/inventori/js/moment.min.js'); ?>"></script>
    <!-- Load Tempus Dominus Datepicker -->
    <link rel="stylesheet" href="<?= base_url('assets/inventori/css/fontawesome.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/inventori/css/tempusdominus-bootstrap-4.min.css'); ?>">
    <script src="<?= base_url('assets/inventori/js/tempusdominus-bootstrap-4.min.js'); ?>"></script>

    <!-- Load Chart.js for line chart -->
    <script src="<?= base_url('assets/inventori/js/chart.min.js'); ?>"></script>

    <!-- Load ECharts for bar chart -->
    <script src="<?= base_url('assets/inventori/js/echarts.min.js'); ?>"></script>

    <!-- Custom CSS for this chart -->
    <style>
        .unique-chart-container canvas {
            background-color: transparent !important;
        }

        #uniqueLineChart {
            max-width: 100% !important;
            width: auto !important;
            display: none;
        }

        .col-sm-6.text-right {
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        #jenisFilter {
            width: 150px;
        }

        body.dark-mode {
            background-color: #333;
            color: white;
        }

        body.dark-mode .card-title,
        body.dark-mode th,
        body.dark-mode td,
        body.dark-mode label,
        body.dark-mode select {
            color: white;
        }

        body.light-mode {
            background-color: #fff;
            color: black;
        }

        body.light-mode .card-title,
        body.light-mode th,
        body.light-mode td,
        body.light-mode label,
        body.light-mode select {
            color: black;
        }

        .chart-container {
            position: relative;
            height: 400px;
            width: 100%;
            margin-left: auto;
            margin-bottom: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        canvas {
            display: block;
            max-width: 100%;
            margin: 0 auto;
        }

        .unique-chart-container .chartjs-render-monitor,
        .unique-chart-container #echartBar {
            max-width: 100%;
            margin: 0 auto;
        }

        .echarts-tooltip {
            background: none !important;
            border: none !important;
            box-shadow: none !important;
        }

        #loadingMessage {
            font-size: 18px;
            color: #666;
            text-align: center;
            display: block;
        }

        #chartContainer {
            position: relative;
            height: 400px;
            width: 100%;
        }

        #uniqueLineChart,
        #echartBar {
            width: 100%;
            height: 100%;
        }

        #loadingMessage {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        #noDataText {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            /* Menutupi seluruh area chart */
            background-color: #fff;
            /* Latar belakang solid untuk light mode */
            color: black;
            /* Warna teks untuk light mode */
            font-size: 24px;
            display: flex;
            /* Menggunakan flexbox untuk menengahkan teks */
            justify-content: center;
            align-items: center;
            z-index: 10;
            /* Pastikan berada di atas elemen lainnya */
            display: none;
            /* Sembunyikan secara default */
        }

        /* Dark mode styling */
        body.dark-mode #noDataText {
            background-color: #343a40;
            /* Warna yang sama dengan background utama pada dark mode */
            color: white;
            /* Warna teks untuk dark mode */
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed dark-mode">

    <div class="wrapper">
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Sistem Informasi Inventori (SIMI)</h1>
                        </div>

                        <!-- Tampilkan filter hanya jika pengguna adalah manager -->
                        <?php if ($this->session->userdata('role_id') == 2): ?>
                        <div class="col-sm-6 text-right">
                            <!-- Dynamic PHP Filter -->
                            <div class="form-group">
                                <label for="jenisFilter">Filter by Jenis:</label>
                                <select id="jenisFilter" class="form-control" style="width: 150px;">
                                    <option value="">All</option>
                                    <?php foreach ($jenis_items as $jenis) : ?>
                                        <option value="<?= $jenis ?>" <?= ($this->input->get('jenis') == $jenis) ? 'selected' : '' ?>>
                                            <?= $jenis ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Dashboard List for Manager and Others -->
            <section class="content" id="dashboard-section">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Tampilkan tabel hanya jika pengguna adalah manager -->
                            <?php if ($this->session->userdata('role_id') == 2): ?>
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
                                            <tr data-jenis="<?= $cluster['jenis']; ?>">
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
                                            <td colspan="7">No data available or unauthorized access</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            <?php else: ?>
                                <div>No access for this role</div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Additional Chart Section -->
            <section class="content" id="additional-chart-section" style="display: none;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8 unique-chart-container">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title" id="chart-title">Grafik Bulanan</h3>
                                    <div class="float-right d-flex align-items-center">
                                        <div class="form-group mr-2 mb-0">
                                            <select id="chart-type-selector" class="form-control">
                                                <option value="line">Stok</option>
                                                <option value="bar">Pembelian/Pemakaian</option>
                                            </select>
                                        </div>
                                        <button id="back-button-chart" class="btn btn-danger">Back</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="chartContainer" class="chart-container">
                                        <canvas id="uniqueLineChart"></canvas>
                                        <div id="loadingMessage" style="display:none;">Loading...</div>
                                        <div id="echartBar" style="width: 100%; height: 100%; display: none;"></div>
                                        <div id="noDataText">No Data Available</div> <!-- Pesan tidak ada data -->
                                    </div>
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
                                    <div class="form-group">
                                        <label>Select Start Month:</label>
                                        <div class="input-group date" id="datestart" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" data-target="#datestart" />
                                            <div class="input-group-append" data-target="#datestart" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
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
        </div>

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="<?= base_url('assets/img/AdminLTELogo.png') ?>" alt="AdminLTELogo" height="60" width="60">
        </div>
    </div>

    <aside class="control-sidebar control-sidebar-dark"></aside>

    <!-- REQUIRED SCRIPTS -->
    <script>
    var $j = jQuery.noConflict();

    $j(document).ready(function () {
        let uniqueLineChart; 
        let echartInstance; 
        let currentItemCode = ""; 
        let startMonth = null;
        let endMonth = null;
        let isChartVisible = false; // Status chart

        // Fungsi untuk mendapatkan mode saat ini (dark atau light)
        function getCurrentMode() {
            return $j('body').hasClass('dark-mode') ? 'dark' : 'light';
        }

        // Fungsi untuk mendapatkan warna chart berdasarkan mode
        function getChartColors(mode) {
            return mode === 'dark' ? { textColor: '#ffffff', gridColor: '#444444' } : { textColor: '#000000', gridColor: '#dddddd' };
        }

        // Inisialisasi Chart Garis (Line Chart)
        function initializeLineChart(data, mode) {
            const colors = getChartColors(mode);
            const ctx = document.getElementById('uniqueLineChart').getContext('2d');
            if (uniqueLineChart) {
                uniqueLineChart.destroy();
            }

            uniqueLineChart = new Chart(ctx, {
                type: 'line',
                data: data,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    elements: {
                        line: {
                            tension: 0.2
                        },
                        point: {
                            radius: 3
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: colors.gridColor,
                            },
                            ticks: {
                                color: colors.textColor,
                                callback: function(value) {
                                    return Number.isInteger(value) ? value : null;
                                }
                            }
                        },
                        x: {
                            grid: {
                                color: colors.gridColor,
                            },
                            ticks: {
                                color: colors.textColor
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            labels: {
                                color: colors.textColor
                            }
                        }
                    }
                }
            });

            setTimeout(function() {
                uniqueLineChart.resize();
                uniqueLineChart.update();
            }, 1000);
        }

        // Inisialisasi Chart Batang (Bar Chart)
        function initializeBarChart(data, mode) {
            const colors = getChartColors(mode);
            const echartBar = document.getElementById('echartBar');

            if (echartInstance) {
                echartInstance.dispose();
            }

            echartInstance = echarts.init(echartBar);

            const option = {
                tooltip: {
                    trigger: 'axis',
                    axisPointer: {
                        type: 'none'
                    }
                },
                legend: {
                    textStyle: {
                        color: colors.textColor
                    }
                },
                xAxis: {
                    type: 'category',
                    data: data.labels,
                    axisLabel: {
                        color: colors.textColor
                    },
                    axisLine: {
                        lineStyle: {
                            color: colors.gridColor
                        }
                    }
                },
                yAxis: {
                    type: 'value',
                    axisLabel: {
                        color: colors.textColor
                    },
                    axisLine: {
                        lineStyle: {
                            color: colors.gridColor
                        }
                    },
                    splitLine: {
                        lineStyle: {
                            color: colors.gridColor
                        }
                    }
                },
                series: [
                    {
                        name: 'Pembelian',
                        type: 'bar',
                        barWidth: '20%',
                        emphasis: {
                            focus: 'none',
                        },
                        label: {
                            show: true,
                            position: 'inside'
                        },
                        data: data.datasets[0].data
                    },
                    {
                        name: 'Pemakaian',
                        type: 'bar',
                        barWidth: '20%',
                        emphasis: {
                            focus: 'none',
                        },
                        label: {
                            show: true,
                            position: 'inside'
                        },
                        data: data.datasets[1].data
                    }
                ]
            };

            echartInstance.setOption(option);
        }

        // Fungsi untuk membersihkan Bar Chart
        function clearBarChart() {
            if (echartInstance) {
                echartInstance.clear();
            }
        }

        // Fungsi untuk menonaktifkan Date Pickers
        function disableDatePickers() {
            $j('#datestart').datetimepicker('disable');
            $j('#dateend').datetimepicker('disable');
        }

        // Fungsi untuk mengaktifkan Date Pickers
        function enableDatePickers() {
            $j('#datestart').datetimepicker('enable');
            $j('#dateend').datetimepicker('enable');
        }

        // Fungsi untuk menonaktifkan Dropdowns
        function disableDropdowns() {
            $j('#chart-type-selector').prop('disabled', true);
            $j('#jenisFilter').prop('disabled', true);
        }

        // Fungsi untuk mengaktifkan Dropdowns
        function enableDropdowns() {
            $j('#chart-type-selector').prop('disabled', false);
            $j('#jenisFilter').prop('disabled', false);
        }

        // Fungsi untuk memuat data Line Chart
        function loadLineChartData(kodeItem, itemName, startMonth, endMonth, mode) {
            console.log('Sending data to server:', 'Kode Item:', kodeItem, 'Start Month:', startMonth || 'All Data', 'End Month:', endMonth || 'All Data');

            $j('#loadingMessage').show();
            disableDatePickers();
            disableDropdowns();
            $j('#uniqueLineChart').hide();
            $j('#echartBar').hide(); // Pastikan bar chart disembunyikan saat memuat line chart
            $j('#noDataText').hide(); // Ensure this element is hidden initially

            // Cek apakah date picker kosong
            if (!startMonth && !endMonth) {
                // Jika kedua date picker kosong, kirimkan permintaan untuk semua data
                startMonth = ''; // Kosongkan untuk semua data
                endMonth = '';   // Kosongkan untuk semua data
            }

            $j.ajax({
                url: '<?= site_url('inventori/proses/more_info') ?>',
                type: 'POST',
                data: { kode_item: kodeItem, chart_type: 'line', start_month: startMonth, end_month: endMonth },
                success: function (response) {
                    const data = JSON.parse(response);
                    if (data.error) {
                        // Menangani error yang dikirim dari server
                        $j('#loadingMessage').hide();
                        $j('#uniqueLineChart').hide();
                        $j('#noDataText').text(data.error).show(); // Menampilkan pesan error
                        isChartVisible = false; // Status chart tidak terlihat
                        enableDatePickers();
                        enableDropdowns();
                        return;
                    }

                    if (data.labels && data.labels.length > 0 && data.data.length > 0) {
                        setTimeout(function() {
                            $j('#loadingMessage').hide();
                            $j('#uniqueLineChart').show();
                            isChartVisible = true; // Status chart terlihat
                            enableDatePickers();
                            enableDropdowns();

                            initializeLineChart({
                                labels: data.labels,
                                datasets: [{
                                    label: `Total Quantity for ${itemName}`,
                                    data: data.data,
                                    borderColor: 'lightcoral',
                                    borderWidth: 2,
                                    pointBackgroundColor: 'white',
                                    pointBorderColor: 'lightcoral',
                                    pointBorderWidth: 2,
                                    pointRadius: 5,
                                    backgroundColor: 'transparent',
                                }]
                            }, mode);
                        }, 1000);
                    } else {
                        // Jika tidak ada data
                        $j('#loadingMessage').hide();
                        $j('#uniqueLineChart').hide();
                        isChartVisible = false; // Status chart tidak terlihat
                        $j('#noDataText').text('No Data Available').show(); // Menampilkan pesan tidak ada data
                        enableDatePickers(); // Pastikan date pickers masih bisa digunakan
                        enableDropdowns(); // Pastikan dropdown bisa digunakan meskipun tidak ada data
                    }
                },
                error: function (xhr, status, error) {
                    console.error('AJAX error: ', status, error);
                    $j('#loadingMessage').hide();
                    $j('#uniqueLineChart').hide();
                    $j('#noDataText').text('Error loading data').show(); // Menampilkan pesan error
                    enableDatePickers(); // Pastikan date pickers masih bisa digunakan
                    enableDropdowns();
                }
            });
        }

        // Fungsi untuk memuat data Bar Chart
        function loadBarChartData(kodeItem, month, mode) {
            $j('#uniqueLineChart').hide();
            $j('#noDataText').hide();

            $j.ajax({
                url: '<?= site_url('inventori/proses/more_info') ?>',
                type: 'POST',
                data: { kode_item: kodeItem, chart_type: 'bar', month: month },
                success: function (response) {
                    try {
                        const data = JSON.parse(response);
                        if (data && data.labels && data.labels.length > 0 && data.data) {
                            $j('#echartBar').show();
                            $j('#noDataText').hide();

                            const purchaseData = data.labels.map(label => data.data.purchase[label] || 0);
                            const usageData = data.labels.map(label => data.data.usage[label] || 0);

                            initializeBarChart({
                                labels: data.labels,
                                datasets: [
                                    { label: 'Pembelian', data: purchaseData },
                                    { label: 'Pemakaian', data: usageData }
                                ]
                            }, mode);
                        } else {
                            clearBarChart();
                            $j('#echartBar').hide();
                            $j('#noDataText').text('No Data Available').show(); // Menampilkan pesan tidak ada data
                            isChartVisible = false; // Status chart tidak terlihat
                            enableDatePickers(); // Pastikan date pickers masih bisa digunakan
                        }
                    } catch (e) {
                        console.error('Error parsing JSON:', e);
                        clearBarChart();
                        $j('#echartBar').hide();
                        $j('#noDataText').text('Error loading data').show(); // Menampilkan pesan error
                        enableDatePickers(); // Pastikan date pickers masih bisa digunakan
                    }
                },
                error: function (xhr, status, error) {
                    console.error('AJAX error:', status, error);
                    clearBarChart();
                    $j('#echartBar').hide();
                    $j('#noDataText').text('Error loading data').show(); // Menampilkan pesan error
                    enableDatePickers(); // Pastikan date pickers masih bisa digunakan
                }
            });
        }

        // Event handler untuk perubahan pada filter jenis
        $j('#jenisFilter').on('change', function() {
            const selectedJenis = $j(this).val();
            const url = new URL(window.location.href);
            if (selectedJenis) {
                url.searchParams.set('jenis', selectedJenis);
            } else {
                url.searchParams.delete('jenis');
            }
            window.location.href = url.toString();
        });

        // Event handler untuk klik tombol "More Info"
        $j('.more-info').on('click', function(event) {
            event.preventDefault();
            const kodeItem = $j(this).data('report');
            const itemName = $j(this).data('item-name');
            currentItemCode = kodeItem;
            const mode = getCurrentMode();

            $j('#chart-title').text(`Grafik Bulanan - ${itemName}`);
            const startMonth = $j('#datestart input').val();
            const endMonth = $j('#dateend input').val();

            loadLineChartData(kodeItem, itemName, startMonth, endMonth, mode);

            $j('.col-sm-6.text-right').hide();
            $j('#dashboard-section').slideUp('slow', function () {
                $j('#additional-chart-section').slideDown('slow', function () {
                    if (uniqueLineChart) {
                        uniqueLineChart.resize();
                        uniqueLineChart.update();
                    }
                });
            });
        });

        // Event handler untuk perubahan pada selector tipe chart
        $j('#chart-type-selector').on('change', function () {
            const chartType = $j(this).val();
            const mode = getCurrentMode();

            if (uniqueLineChart) {
                uniqueLineChart.destroy();
                uniqueLineChart = null;
                $j('#uniqueLineChart').hide();
            }

            if (chartType === 'bar') {
                $j('#lineChartDatePickers').hide();
                $j('#barChartDatePicker').show();

                const today = moment().format('YYYY-MM');
                $j('#monthYearPicker').datetimepicker('date', today);
                loadBarChartData(currentItemCode, today, mode);
            } else {
                $j('#barChartDatePicker').hide();
                $j('#echartBar').hide(); // Pastikan bar chart disembunyikan saat kembali ke line chart
                clearBarChart(); // Hapus instance bar chart
                $j('#lineChartDatePickers').show();
                if (currentItemCode) {
                    loadLineChartData(currentItemCode, $j('#chart-title').text(), $j('#datestart input').val(), $j('#dateend input').val(), mode);
                }
            }
        });

        // Event handler untuk tombol kembali
        $j('#back-button-chart').on('click', function () {
            // Reset chart type selector ke default 'line'
            $j('#chart-type-selector').val('line');

            // Reset date pickers ke default (show line chart date pickers)
            $j('#lineChartDatePickers').show();
            $j('#barChartDatePicker').hide();

            // Reset date pickers ke Januari dan Desember tahun ini
            const startOfYear = moment().startOf('year').format('YYYY-MM');
            const endOfYear = moment().endOf('year').format('YYYY-MM');
            $j('#datestart').datetimepicker('date', startOfYear); // Set start date to January
            $j('#dateend').datetimepicker('date', endOfYear); // Set end date to December

            // Pastikan input field menampilkan tanggal yang di-set
            $j('#datestart input').val(startOfYear);
            $j('#dateend input').val(endOfYear);

            // Sembunyikan chart section, tampilkan dashboard section
            $j('#additional-chart-section').slideUp('slow', function () {
                $j('#dashboard-section').slideDown('slow', function () {
                    $j('.col-sm-6.text-right').show();
                    // Hapus semua chart yang mungkin masih terlihat
                    if (uniqueLineChart) {
                        uniqueLineChart.destroy();
                        uniqueLineChart = null;
                    }
                    $j('#uniqueLineChart').hide();
                    if (echartInstance) {
                        echartInstance.dispose();
                        echartInstance = null;
                    }
                    $j('#echartBar').hide();
                    $j('#noDataText').hide();
                    $j('#loadingMessage').hide();

                    // Kosongkan kode item saat kembali ke list
                    currentItemCode = '';
                });
            });
        });

        // Inisialisasi Date Pickers
        $j('#datestart').datetimepicker({
            format: 'YYYY-MM',
            viewMode: 'months',
            useCurrent: false
        });

        $j('#dateend').datetimepicker({
            format: 'YYYY-MM',
            viewMode: 'months',
            useCurrent: false
        });

        $j('#monthYearPicker').datetimepicker({
            format: 'YYYY-MM',
            viewMode: 'months'
        });

        // Event handler untuk klik pada ikon date picker
        $j('#datestart, #dateend').on('click', function() {
            if (!isChartVisible) {
                $j('#uniqueLineChart').hide(); // Pastikan chart tetap tersembunyi
            }
        });

        // Event handler untuk perubahan pada datestart
        $j('#datestart').on('change.datetimepicker', function(e) {
            startMonth = e.date.format('YYYY-MM');
            $j('#dateend').datetimepicker('minDate', e.date);
            checkAndLoadLineChart();  // Cek jika kedua date picker sudah dipilih
        });

        // Event handler untuk perubahan pada dateend
        $j('#dateend').on('change.datetimepicker', function(e) {
            endMonth = e.date.format('YYYY-MM');
            $j('#datestart').datetimepicker('maxDate', e.date);
            checkAndLoadLineChart();  // Cek jika kedua date picker sudah dipilih
        });

        // Fungsi untuk memeriksa dan memuat Line Chart jika date pickers sudah dipilih
        function checkAndLoadLineChart() {
            const mode = getCurrentMode();
            if (startMonth && endMonth) {
                loadLineChartData(currentItemCode, $j('#chart-title').text(), startMonth, endMonth, mode);
            } else {
                // Jika salah satu atau kedua date picker kosong, panggil fungsi tanpa batasan tanggal
                loadLineChartData(currentItemCode, $j('#chart-title').text(), '', '', mode); // Menggunakan string kosong untuk mengambil semua data
            }
        }

        // Event handler untuk perubahan pada monthYearPicker (Bar Chart)
        $j('#monthYearPicker').on('change.datetimepicker', function(e) {
            const selectedMonth = e.date.format('YYYY-MM');
            const mode = getCurrentMode();
            if ($j('#chart-type-selector').val() === 'bar') {
                loadBarChartData(currentItemCode, selectedMonth, mode);
            }
        });

        // Observer untuk mendeteksi perubahan mode (dark/light) dan memperbarui chart
        const observer = new MutationObserver(() => {
            const mode = getCurrentMode();
            if (uniqueLineChart) {
                initializeLineChart(uniqueLineChart.data, mode);
            }
            if (echartInstance) {
                const echartOption = echartInstance.getOption();
                initializeBarChart({
                    labels: echartOption.xAxis[0].data,
                    datasets: [
                        { label: 'Pembelian', data: echartOption.series[0].data },
                        { label: 'Pemakaian', data: echartOption.series[1].data }
                    ]
                }, mode);
            }
        });

        observer.observe(document.body, {
            attributes: true,
            attributeFilter: ['class']
        });

        // Inisialisasi saat halaman pertama kali dimuat
        $j(window).on('load', function() {
            const mode = getCurrentMode();
            const firstItem = $j('.more-info').first();
            const startMonth = moment().startOf('year').format('YYYY-MM'); // Januari
            const endMonth = moment().endOf('year').format('YYYY-MM'); // Desember
            
            // Set date picker start dan end ke Jan - Des tahun ini
            $j('#datestart').datetimepicker('date', startMonth);
            $j('#dateend').datetimepicker('date', endMonth);

            // Pastikan input field menampilkan tanggal yang di-set
            $j('#datestart input').val(startMonth);
            $j('#dateend input').val(endMonth);

            // Jika ada item pertama, load chart untuk item tersebut dengan range Jan - Des
            if (firstItem.length > 0) {
                currentItemCode = firstItem.data('report');
                const itemName = firstItem.data('item-name');
                loadLineChartData(currentItemCode, itemName, startMonth, endMonth, mode);
            }
        });
    });
</script>



</body>

</html>
