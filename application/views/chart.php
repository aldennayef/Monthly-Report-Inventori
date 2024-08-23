<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $user['sub_department'] ?> Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') ?>">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') ?>">
    <!-- daterangepicker -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/daterangepicker/daterangepicker.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/css/adminlte.min.css') ?>">

    <style>
        .form-group.select-report {
            width: 150px;
            margin-bottom: 0;
        }

        .form-group.select-report select {
            padding: 0.25rem;
            font-size: 0.875rem;
        }

        .card-header {
            padding-right: 1rem;
        }

        .sidebar-search-results {
            display: none !important;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed dark-mode">
    <div class="wrapper">
    <?php if($this->session->userdata('role_id')!=1 && $this->session->userdata('role_id')!=4){ ?>
        <!-- Overview Chart Section -->
        <section class="content" id="chart-section">
            <div class="container-fluid">
                <div class="row">
                    <!-- Overview Line Chart -->
                    <div class="col-lg-8 col-md-12">
                        <div class="card card-primary">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title" id="overview-line-chart-title">Overview Line Chart</h3>
                                <div class="form-group select-report ml-auto">
                                    <label for="lineChartReportSelect" class="sr-only">Select Report:</label>
                                    <select id="lineChartReportSelect" class="form-control">
                                        <!-- Options will be dynamically added here -->
                                    </select>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="overviewLineChartContainer" style="height: 526.5px;">
                                    <canvas id="overviewLineChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-12">
                        <!-- Overview Bar Chart -->
                        <div class="card card-primary mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title" id="overview-bar-chart-title">Overview Bar Chart</h3>
                                <div class="form-group select-report">
                                    <label for="barChartReportSelect" class="sr-only">Select Report:</label>
                                    <select id="barChartReportSelect" class="form-control">
                                        <!-- Options will be dynamically added here -->
                                    </select>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="overviewBarChartContainer" style="height: 200px;">
                                    <canvas id="overviewBarChart" style="height: 200px;"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Overview Donut Chart -->
                        <div class="card card-primary">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title" id="overview-donut-chart-title">Overview Donut Chart</h3>
                                <div class="form-group select-report">
                                    <label for="donutChartReportSelect" class="sr-only">Select Report:</label>
                                    <select id="donutChartReportSelect" class="form-control">
                                        <!-- Options will be dynamically added here -->
                                    </select>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="overviewDonutChartContainer" style="height: 200px;">
                                    <canvas id="overviewDonutChart" style="height: 200px;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>
        <!-- Additional Chart Section -->
        <section class="content" id="additional-chart-section" style="display: none;">
            <div class="container-fluid">
                <div class="row" id="username-container">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Report</th>
                                <th>Total Value</th>
                                <th>Report Name</th>
                                <th>Unit</th>
                                <th>Sub-Department</th>
                                <th>More Info</th>
                            </tr>
                        </thead>
                        <tbody id="data-list">
                            <!-- List items will be dynamically added here -->
                        </tbody>
                    </table>
                </div>
                <!-- End Additional Chart Section -->
            </div>
        </section>

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="<?= base_url('assets/img/AdminLTELogo.png') ?>" alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?php
                                if ($this->session->userdata('role_id') == 1) {
                                    echo base_url('butterfly');
                                } elseif ($this->session->userdata('role_id') == 2) {
                                    echo base_url('maloch');
                                } elseif ($this->session->userdata('role_id') == 3) {
                                    echo base_url('zephys');
                                } elseif ($this->session->userdata('role_id') == 4) {
                                    echo base_url('gon');
                                } else {
                                    echo base_url('errorpage'); // fallback jika role_id tidak sesuai
                                }
                                ?>" class="nav-link">Home</a>
                </li>
                <?php if ($this->session->userdata('role_id') == 1) { ?>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="#" id="backupLink" class="nav-link">Backup Data</a>
                    </li>
                <?php } ?>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" id="darkModeSwitch" role="button">
                        <i class="fas fa-sun"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?php
                        if ($this->session->userdata('role_id') == 1) {
                            echo base_url('butterfly');
                        } elseif ($this->session->userdata('role_id') == 2) {
                            echo base_url('maloch');
                        } elseif ($this->session->userdata('role_id') == 3) {
                            echo base_url('zephys');
                        } elseif ($this->session->userdata('role_id') == 4) {
                            echo base_url('gon');
                        } else {
                            echo base_url('errorpage'); // fallback jika role_id tidak sesuai
                        }
                        ?>" class="brand-link">
                <img src="<?= base_url('assets/gambar/indofood-dashboard.png') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light"><?= $user['department'] ?></span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?= base_url('assets/img/user2-160x160.jpg') ?>" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?= $user['nama'] ?></a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <?php if($this->session->userdata('role_id')!=1 && $this->session->userdata('role_id')!=4){?>
                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item menu-open">
                            <a href="<?php
                                        if ($this->session->userdata('role_id') == 1) {
                                            echo base_url('butterfly');
                                        } elseif ($this->session->userdata('role_id') == 2) {
                                            echo base_url('maloch');
                                        } elseif ($this->session->userdata('role_id') == 3) {
                                            echo base_url('zephys');
                                        } elseif ($this->session->userdata('role_id') == 4) {
                                            echo base_url('gon');
                                        } else {
                                            echo base_url('errorpage'); // fallback jika role_id tidak sesuai
                                        }
                                        ?>" class="nav-link active">
                                <i class="nav-icon fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-header">FEATURES</li>
                        <?php foreach ($menu as $m) : ?>
                            <li class="nav-item">
                                <a href="<?= base_url($m['link_href']) ?>" class="nav-link">
                                    <i class="nav-icon far fa-circle text-info"></i>
                                    <p><?= $m['menu'] ?></p>
                                </a>
                            </li>
                        <?php endforeach; ?>
                        <li class="nav-header">ACTIONS</li>
                        <li class="nav-item">
                            <a href="<?= base_url('modul') ?>" class="nav-link">
                                <i class="nav-icon fas fa-book-open"></i>
                            <p>Modul</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('logout') ?>" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div id="username-container">
                    <!-- Username specific containers will be dynamically added here -->
                </div>
            </div>
        </section>

        <div id="additional-info" style="display: none;">
            <div class="row">
                <!-- Chart -->
                <div class="col-md-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title" id="chart-title">Grafik Bulanan</h3>
                            <button id="back-button" class="btn btn-danger float-right" style="display: none;">Back</button>
                        </div>
                        <div class="card-body">
                            <div id="chartContainer" style="height: 300px;"></div>
                            <div id="barChartContainer" style="margin-top: 20px; display: none;">
                                <canvas id="detailBarChart" style="height: 300px;"></canvas>
                            </div>
                            <div id="noDataText" style="display: none; text-align: center; color: red;">No Data</div>
                        </div>
                    </div>
                </div>

                <!-- Date Picker -->
                <div class="col-md-4 ml-auto">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Date Picker</h3>
                        </div>
                        <div class="card-body" id="lineChartDatePickers">
                            <!-- Date Start -->
                            <div class="form-group">
                                <label>Date Start:</label>
                                <div class="input-group date" id="datestart" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#datestart" />
                                    <div class="input-group-append" data-target="#datestart" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <!-- Date End -->
                            <div class="form-group">
                                <label>Date End:</label>
                                <div class="input-group date" id="dateend" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#dateend" />
                                    <div class="input-group-append" data-target="#dateend" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <!-- Date range -->
                            <div class="form-group">
                                <label>Date range:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                    </div>
                                    <span id="date-range" class="form-control float-right"></span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" id="barChartDatePickerContainer" style="display: none;">
                            <div class="form-group">
                                <label>Select Month:</label>
                                <div class="input-group date" id="barchartdate" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#barchartdate" />
                                    <div class="input-group-append" data-target="#barchartdate" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <aside class="control-sidebar control-sidebar-dark">
    </aside>
    </div>

    <!-- REQUIRED SCRIPTS -->
    <script src="<?= base_url('assets/plugins/jquery/jquery-fix.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/bootstrap/js/popper.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/moment/moment.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4-fix.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/daterangepicker/daterangepicker.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/chart/chart-fix.js') ?>"></script>
    <script src="<?= base_url('assets/js/adminlte.js') ?>"></script>

    <script>
        const baseUrl = "<?= base_url(); ?>";
        const userId = "<?= $user['id'] ?>"; // Assuming the user's ID is available in PHP
        let overviewLineChart = null;
        let overviewBarChart = null;
        let overviewDonutChart = null;
        let lineChart = null;
        let detailBarChart = null;

        const getColorSettings = () => {
            const isDarkMode = document.body.classList.contains('dark-mode');
            const colorSettings = {
                scales: {
                    y: {
                        ticks: {
                            color: isDarkMode ? 'white' : 'black'
                        }
                    },
                    x: {
                        ticks: {
                            color: isDarkMode ? 'white' : 'black'
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: isDarkMode ? 'white' : 'black'
                        }
                    }
                }
            };
            return colorSettings;
        };

        const createChart = (chartType, chartId, data, chartOptions = {}) => {
            const ctx = document.getElementById(chartId).getContext('2d');
            const config = {
                type: chartType,
                data: data,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    ...getColorSettings(),
                    scales: {
                        y: {
                            beginAtZero: true
                        },
                        x: {}
                    },
                    elements: {
                        line: {
                            fill: false,
                            tension: 0,
                            borderWidth: 5
                        },
                        point: {
                            backgroundColor: 'white',
                            borderColor: 'lightcoral',
                            borderWidth: 2,
                            radius: 6
                        }
                    },
                    tooltips: {
                        callbacks: {
                            label: function (tooltipItem, data) {
                                const dataset = data.datasets[tooltipItem.datasetIndex];
                                const value = dataset.data[tooltipItem.index];
                                return `${value.toLocaleString()}`;
                            }
                        }
                    }
                }
            };
            const chart = new Chart(ctx, { ...config, options: { ...config.options, ...chartOptions } });
            return chart;
        };

        const createBarChart = (chartId, data) => {
            const ctx = document.getElementById(chartId).getContext('2d');
            const colors = [
                'rgba(255, 99, 132, 0.9)',
                'rgba(54, 162, 235, 0.9)',
                'rgba(255, 206, 86, 0.9)',
                'rgba(75, 192, 192, 0.9)',
                'rgba(153, 102, 255, 0.9)',
                'rgba(255, 159, 64, 0.9)',
                'rgba(201, 203, 207, 0.9)',
                'rgba(255, 99, 71, 0.9)',
                'rgba(60, 179, 113, 0.9)',
                'rgba(106, 90, 205, 0.9)'
            ];
            const borderColors = colors.map(color => color.replace('0.9', '0.8'));

            console.log('Creating bar chart with data:', data); // Tambahkan log ini

            const datasets = Object.keys(data.values).map((status, index) => {
                const colorIndex = index % colors.length;
                return {
                    label: status,
                    data: data.values[status],
                    backgroundColor: colors[colorIndex],
                    borderColor: borderColors[colorIndex],
                    borderWidth: 1,
                    barThickness: 'flex',
                    maxBarThickness: 50
                };
            });

            const config = {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: datasets
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    ...getColorSettings(),
                    scales: {
                        y: {
                            beginAtZero: true,
                            stacked: false
                        },
                        x: {
                            stacked: false,
                            barPercentage: 0.5,
                            categoryPercentage: 0.5
                        }
                    },
                    tooltips: {
                        callbacks: {
                            label: function (tooltipItem, data) {
                                const dataset = data.datasets[tooltipItem.datasetIndex];
                                const value = dataset.data[tooltipItem.index];
                                const satuan = dataset.satuan || '';
                                return `${value.toLocaleString()} ${satuan}`;
                            }
                        }
                    }
                }
            };
            const chart = new Chart(ctx, config);
            return chart;
        };

        const createDonutChart = (chartId, data) => {
            const ctx = document.getElementById(chartId).getContext('2d');
            const colors = [
                'rgba(255, 99, 132, 0.9)',
                'rgba(54, 162, 235, 0.9)',
                'rgba(255, 206, 86, 0.9)',
                'rgba(75, 192, 192, 0.9)',
                'rgba(153, 102, 255, 0.9)',
                'rgba(255, 159, 64, 0.9)',
                'rgba(201, 203, 207, 0.9)',
                'rgba(255, 99, 71, 0.9)',
                'rgba(60, 179, 113, 0.9)',
                'rgba(106, 90, 205, 0.9)'
            ];

            const config = {
                type: 'doughnut',
                data: {
                    labels: data.labels,
                    datasets: [{
                        data: data.values,
                        backgroundColor: colors,
                        borderColor: colors.map(color => color.replace('0.9', '0.8')),
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    ...getColorSettings(),
                    tooltips: {
                        callbacks: {
                            label: function (tooltipItem, data) {
                                const value = data.datasets[0].data[tooltipItem.index];
                                return `${value.toLocaleString()}`;
                            }
                        }
                    }
                }
            };

            if (overviewDonutChart) {
                overviewDonutChart.destroy();
            }
            overviewDonutChart = new Chart(ctx, config);
            return overviewDonutChart;
        };

        const getOverviewChartData = (report, chartType) => {
            $.ajax({
                url: baseUrl + 'welcome/chart_data',
                dataType: 'json',
                method: 'get',
                data: {
                    report: report
                },
                success: response => {
                    const { data } = response;
                    console.log('Overview chart data received:', data); // Tambahkan log ini
                    if (!data || !Array.isArray(data)) {
                        console.error('Invalid data received:', data);
                        if (chartType === 'line') {
                            $('#overviewLineChartContainer').empty();
                        } else if (chartType === 'bar') {
                            $('#overviewBarChartContainer').empty();
                        } else if (chartType === 'donut') {
                            $('#overviewDonutChartContainer').empty();
                        }
                        return;
                    }

                    if (chartType === 'line') {
                        const groupedData = data.reduce((acc, curr) => {
                            if (!acc[curr.periode]) {
                                acc[curr.periode] = 0;
                            }
                            acc[curr.periode] += parseInt(curr.value);
                            return acc;
                        }, {});

                        const labels = Object.keys(groupedData).sort();
                        const values = labels.map(label => groupedData[label]);

                        const chartData = {
                            labels: labels,
                            datasets: [{
                                label: report,
                                data: values,
                                backgroundColor: 'transparent',
                                borderColor: 'lightcoral',
                                borderWidth: 5,
                                pointBackgroundColor: 'white',
                                pointBorderColor: 'lightcoral',
                                pointBorderWidth: 2,
                                pointRadius: 6
                            }]
                        };

                        if (overviewLineChart) {
                            overviewLineChart.destroy();
                        }
                        overviewLineChart = createChart('line', 'overviewLineChart', chartData);
                    } else if (chartType === 'bar') {
                        const latestPeriod = data.reduce((latest, current) => {
                            return (latest.periode > current.periode) ? latest : current;
                        }).periode;

                        const latestData = data.filter(item => item.periode === latestPeriod);

                        const statusData = {};
                        const labels = [...new Set(latestData.map(item => item.sub_report))];

                        latestData.forEach(item => {
                            if (!statusData[item.status]) {
                                statusData[item.status] = Array(labels.length).fill(0);
                            }
                            const labelIndex = labels.indexOf(item.sub_report);
                            statusData[item.status][labelIndex] += parseInt(item.value);
                        });

                        const chartData = {
                            labels: labels,
                            values: statusData
                        };

                        if (overviewBarChart) {
                            overviewBarChart.destroy();
                        }
                        overviewBarChart = createBarChart('overviewBarChart', chartData);
                    } else if (chartType === 'donut') {
                        const latestPeriod = data.reduce((latest, current) => {
                            return (latest.periode > current.periode) ? latest : current;
                        }).periode;

                        const latestData = data.filter(item => item.periode === latestPeriod);

                        const subReportData = latestData.reduce((acc, curr) => {
                            if (!acc[curr.sub_report]) {
                                acc[curr.sub_report] = 0;
                            }
                            acc[curr.sub_report] += parseInt(curr.value);
                            return acc;
                        }, {});

                        const labels = Object.keys(subReportData);
                        const values = labels.map(label => subReportData[label]);

                        const chartData = {
                            labels: labels,
                            values: values
                        };

                        if (overviewDonutChart) {
                            overviewDonutChart.destroy();
                        }
                        overviewDonutChart = createDonutChart('overviewDonutChart', chartData);
                    }
                },
                error: (xhr, status, error) => {
                    console.error('Error fetching data:', error);
                    if (chartType === 'line') {
                        $('#overviewLineChartContainer').empty();
                    } else if (chartType === 'bar') {
                        $('#overviewBarChartContainer').empty();
                    } else if (chartType === 'donut') {
                        $('#overviewDonutChartContainer').empty();
                    }
                }
            });
        };

        const getChartData = (report, startDate, endDate, callback) => {
            $.ajax({
                url: baseUrl + 'welcome/chart_data',
                dataType: 'json',
                method: 'get',
                data: {
                    start: startDate,
                    end: endDate,
                    report: report
                },
                success: response => {
                    const { data } = response;
                    console.log('Chart data received:', data); // Tambahkan log ini
                    if (!data || !Array.isArray(data)) {
                        console.error('Invalid data received:', data);
                        $('#chartContainer').empty();
                        $('#noDataText').show();
                        return;
                    }

                    $('#noDataText').hide();
                    const groupedData = data.reduce((acc, curr) => {
                        if (!acc[curr.periode]) {
                            acc[curr.periode] = 0;
                        }
                        acc[curr.periode] += parseInt(curr.value);
                        return acc;
                    }, {});

                    const labels = Object.keys(groupedData).sort();
                    const values = labels.map(label => groupedData[label]);

                    console.log('Processed chart data:', { labels, values }); // Tambahkan log ini

                    if (callback && typeof callback === 'function') {
                        callback(values);
                    }

                    const canvasId = `${report}_chart`;
                    const canvas = document.createElement('canvas');
                    canvas.id = canvasId;
                    canvas.height = 100;
                    $('#chartContainer').empty().append(canvas);

                    const chartData = {
                        labels: labels,
                        datasets: [{
                            label: report,
                            data: values,
                            backgroundColor: 'transparent',
                            borderColor: 'lightcoral',
                            borderWidth: 5,
                            pointBackgroundColor: 'white',
                            pointBorderColor: 'lightcoral',
                            pointBorderWidth: 2,
                            pointRadius: 6
                        }]
                    };

                    $('#chart-title').text(`Grafik Bulanan - ${report}`);

                    if (lineChart) {
                        lineChart.destroy();
                    }
                    lineChart = createChart('line', canvasId, chartData);
                    lineChart.options.onClick = (event, elements) => handleChartPointClick(event, elements, lineChart);

                    $('#back-button').show();
                    $('#back-button').off('click').on('click', function () {
                        $('#additional-info').slideUp('slow', function () {
                            $('#username-container').slideDown('slow');
                            $('#barChartContainer').hide();
                            if (detailBarChart) {
                                detailBarChart.destroy();
                            }
                            $('#back-button').hide();
                            $('#datestart').datetimepicker('date', null);
                            $('#dateend').datetimepicker('date', null);
                            $('#date-range').text('');
                        });
                        $('#noDataText').hide();
                    });
                },
                error: (xhr, status, error) => {
                    console.error('Error fetching data:', error);
                    $('#chartContainer').empty();
                    $('#noDataText').show();
                }
            });
        };

        const getDetailData = (report, periode, callback) => {
            const formattedPeriode = moment(periode, 'YYYY-MM').startOf('month').format('YYYY-MM-DD');
            $.ajax({
                url: baseUrl + 'welcome/get_detail_data',
                dataType: 'json',
                method: 'get',
                data: {
                    report: report,
                    periode: formattedPeriode
                },
                success: response => {
                    console.log('Detail data received:', response); // Tambahkan log ini
                    if (callback && typeof callback === 'function') {
                        callback(response);
                    }
                },
                error: (xhr, status, error) => {
                    console.error('Error fetching detail data:', error);
                }
            });
        };

        const handleChartPointClick = (event, elements, chart) => {
            if (elements.length) {
                const element = elements[0];
                const datasetIndex = element.datasetIndex;
                const index = element.index;
                const report = chart.data.datasets[datasetIndex].label;
                const periode = chart.data.labels[index];

                console.log('Clicked point:', { report, periode });

                setBarChartDate(periode);

                getDetailData(report, periode, data => {
                    console.log('Processed data for chart:', data); // Tambahkan log ini
                    $('#noDataText').hide();
                    if (data && data.length > 0) {
                        const labels = [];
                        const values = {};
                        let satuan = '';

                        data.forEach(item => {
                            if (!labels.includes(item.sub_report)) {
                                labels.push(item.sub_report);
                            }
                            if (!values[item.status]) {
                                values[item.status] = Array(labels.length).fill(0);
                            }
                            const labelIndex = labels.indexOf(item.sub_report);
                            values[item.status][labelIndex] = parseInt(item.value);
                            satuan = item.satuan;
                        });

                        $('#chartContainer').fadeOut(500, function () {
                            $('#barChartContainer').fadeIn(500);
                            $('#barChartDatePickerContainer').show();
                            $('#lineChartDatePickers').hide();
                            $('#back-button').show();
                            if (detailBarChart) {
                                detailBarChart.destroy();
                            }
                            detailBarChart = createBarChart('detailBarChart', {
                                labels,
                                values,
                                satuan
                            });

                            $('#back-button').off('click').on('click', function () {
                                $('#barChartContainer').fadeOut(500, function () {
                                    $('#chartContainer').fadeIn(500);
                                    $('#back-button').show();
                                    if (detailBarChart) {
                                        detailBarChart.destroy();
                                    }
                                    $('#barChartDatePickerContainer').hide();
                                    $('#lineChartDatePickers').show();
                                    $('#noDataText').hide();
                                    $('#back-button').off('click').on('click', function () {
                                        $('#additional-info').slideUp('slow', function () {
                                            $('#username-container').slideDown('slow');
                                            $('#barChartContainer').hide();
                                            if (detailBarChart) {
                                                detailBarChart.destroy();
                                            }
                                            $('#back-button').hide();
                                            $('#datestart').datetimepicker('date', null);
                                            $('#dateend').datetimepicker('date', null);
                                            $('#date-range').text('');
                                            $('#noDataText').hide();
                                        });
                                    });
                                });
                            });
                        });
                    } else {
                        $('#barChartContainer').hide();
                        if (detailBarChart) {
                            detailBarChart.destroy();
                        }
                        $('#noDataText').show();
                    }
                });
            }
        };

        const setBarChartDate = (periode) => {
            const date = moment(periode, 'YYYY-MM').toDate();
            $('#barchartdate').datetimepicker('date', date);
        };

        const createListItem = (report, totalValue, reportName, satuan, user_sub_department) => {
            const formattedValue = totalValue.toLocaleString();
            return `
                <tr>
                    <td>${reportName}</td>
                    <td>${formattedValue}</td>
                    <td>${report}</td>
                    <td>${satuan}</td>
                    <td>${user_sub_department}</td>
                    <td><a href="#" class="more-info" data-report="${report}">More info</a></td>
                </tr>
            `;
        };

        const getBoxesData = () => {
            $.ajax({
                url: baseUrl + 'welcome/chart_data',
                dataType: 'json',
                method: 'get',
                success: response => {
                    const { boxes } = response;

                    if (!boxes || !Array.isArray(boxes)) {
                        console.error('Invalid boxes data received:', boxes);
                        return;
                    }

                    console.log(boxes); // Tambahkan log ini

                    const groupedBoxes = boxes.reduce((acc, box) => {
                        if (!acc[box.report]) {
                            acc[box.report] = [];
                        }
                        acc[box.report].push(box);
                        return acc;
                    }, {});

                    const dataList = $('#data-list');
                    dataList.empty();

                    Object.keys(groupedBoxes).forEach(reportName => {
                        const reportBoxes = groupedBoxes[reportName];
                        reportBoxes.forEach(box => {
                            const report = box.report;
                            const satuan = box.satuan;
                            const totalValue = box.total_value;
                            const user_sub_department = box.user_sub_department;
                            dataList.append(createListItem(report, totalValue, reportName, satuan, user_sub_department));
                        });
                    });

                    $(document).on('click', '.more-info', function (event) {
                        event.preventDefault();
                        const report = $(this).data('report');

                        $('#username-container').slideUp('slow', function () {
                            $('#additional-info').slideDown('slow');
                            getChartData(report, '', '');
                        });
                    });
                },
                error: (xhr, status, error) => {
                    console.error('Error fetching data:', error);
                }
            });
        };

        const populateReportDropdown = () => {
            $.ajax({
                url: baseUrl + 'welcome/get_reports',
                dataType: 'json',
                method: 'get',
                success: response => {
                    const { reports } = response;
                    if (!reports || !Array.isArray(reports)) {
                        console.error('Invalid reports data received:', reports);
                        return;
                    }
                    const lineChartReportSelect = $('#lineChartReportSelect');
                    const barChartReportSelect = $('#barChartReportSelect');
                    const donutChartReportSelect = $('#donutChartReportSelect');

                    lineChartReportSelect.empty();
                    barChartReportSelect.empty();
                    donutChartReportSelect.empty();

                    lineChartReportSelect.append('<option value="">Select Report</option>');
                    barChartReportSelect.append('<option value="">Select Report</option>');
                    donutChartReportSelect.append('<option value="">Select Report</option>');

                    reports.forEach(report => {
                        lineChartReportSelect.append(`<option value="${report}">${report}</option>`);
                        barChartReportSelect.append(`<option value="${report}">${report}</option>`);
                        donutChartReportSelect.append(`<option value="${report}">${report}</option>`);
                    });

                    const lastSelectedLineReport = localStorage.getItem(`selectedLineReport_${userId}`);
                    const lastSelectedBarReport = localStorage.getItem(`selectedBarReport_${userId}`);
                    const lastSelectedDonutReport = localStorage.getItem(`selectedDonutReport_${userId}`);

                    if (lastSelectedLineReport) {
                        lineChartReportSelect.val(lastSelectedLineReport);
                        getOverviewChartData(lastSelectedLineReport, 'line');
                    }

                    if (lastSelectedBarReport) {
                        barChartReportSelect.val(lastSelectedBarReport);
                        getOverviewChartData(lastSelectedBarReport, 'bar');
                    }

                    if (lastSelectedDonutReport) {
                        donutChartReportSelect.val(lastSelectedDonutReport);
                        getOverviewChartData(lastSelectedDonutReport, 'donut');
                    }
                },
                error: (xhr, status, error) => {
                    console.error('Error fetching reports:', error);
                }
            });
        };

        $(document).ready(function () {
            $('#lineChartReportSelect').on('change', function () {
                const selectedReport = $(this).val();
                if (selectedReport) {
                    localStorage.setItem(`selectedLineReport_${userId}`, selectedReport);
                    getOverviewChartData(selectedReport, 'line');
                }
            });

            $('#barChartReportSelect').on('change', function () {
                const selectedReport = $(this).val();
                if (selectedReport) {
                    localStorage.setItem(`selectedBarReport_${userId}`, selectedReport);
                    getOverviewChartData(selectedReport, 'bar');
                }
            });

            $('#donutChartReportSelect').on('change', function () {
                const selectedReport = $(this).val();
                if (selectedReport) {
                    localStorage.setItem(`selectedDonutReport_${userId}`, selectedReport);
                    getOverviewChartData(selectedReport, 'donut');
                }
            });

            $('#datestart').datetimepicker({
                viewMode: 'months',
                format: 'YYYY-MM'
            });

            $('#dateend').datetimepicker({
                viewMode: 'months',
                format: 'YYYY-MM'
            });

            $('#barchartdate').datetimepicker({
                viewMode: 'months',
                format: 'YYYY-MM'
            });

            $('#datestart, #dateend').on('change.datetimepicker', function () {
                const dateStart = $('#datestart').datetimepicker('date') ? $('#datestart').datetimepicker('date').format('YYYY-MM') : '';
                const dateEnd = $('#dateend').datetimepicker('date') ? $('#dateend').datetimepicker('date').format('YYYY-MM') : '';
                $('#date-range').text(`${dateStart} - ${dateEnd}`);

                const report = $('#chart-title').text().split(' - ')[1];
                if (report) {
                    if (dateStart && dateEnd) {
                        getChartData(report, dateStart, dateEnd);
                    } else {
                        getChartData(report, '', '');
                    }
                }
            });

            $('#barchartdate').on('change.datetimepicker', function () {
                const selectedMonth = $('#barchartdate').datetimepicker('date') ? $('#barchartdate').datetimepicker('date').format('YYYY-MM') : '';
                const report = $('#chart-title').text().split(' - ')[1];
                if (report && selectedMonth) {
                    getDetailData(report, selectedMonth, data => {
                        $('#noDataText').hide();
                        if (data && data.length > 0) {
                            const labels = [];
                            const values = {};
                            let satuan = '';

                            data.forEach(item => {
                                if (!labels.includes(item.sub_report)) {
                                    labels.push(item.sub_report);
                                }
                                if (!values[item.status]) {
                                    values[item.status] = Array(labels.length).fill(0);
                                }
                                const labelIndex = labels.indexOf(item.sub_report);
                                values[item.status][labelIndex] = parseInt(item.value);
                                satuan = item.satuan;
                            });

                            $('#chartContainer').fadeOut(500, function () {
                                $('#barChartContainer').fadeIn(500);
                                if (detailBarChart) {
                                    detailBarChart.destroy();
                                }
                                detailBarChart = createBarChart('detailBarChart', {
                                    labels,
                                    values,
                                    satuan
                                });
                                $('#back-button').show();
                            });
                        } else {
                            $('#barChartContainer').hide();
                            if (detailBarChart) {
                                detailBarChart.destroy();
                            }
                            $('#noDataText').show();
                        }
                    });
                }
            });

            $('#barChartContainer').hide();
            $('#back-button').hide();

            // Show the list when clicking in the search bar
            $('.form-control-sidebar').on('focus', function () {
                $('#chart-section').hide();
                $('#additional-chart-section').show();
                $(this).siblings('.input-group-append').find('.btn-sidebar i').removeClass('fa-search').addClass('fa-times');
            });

            // Show the chart overview when the clear button is clicked
            $('.btn-sidebar').on('click', function () {
                if ($('.form-control-sidebar').val() === '') {
                    $('#chart-section').show();
                    $('#additional-chart-section').hide();
                    $(this).find('i').removeClass('fa-times').addClass('fa-search');
                } else {
                    $('.form-control-sidebar').val('');
                    $('#chart-section').show();
                    $('#additional-chart-section').hide();
                    $(this).find('i').removeClass('fa-times').addClass('fa-search');
                }
            });

            $('.form-control-sidebar').on('input', function () {
                const searchTerm = $(this).val().toLowerCase();
                const rows = $('#data-list tr');

                rows.each(function () {
                    const row = $(this);
                    const report = row.find('td:eq(0)').text().toLowerCase();
                    const subReport = row.find('td:eq(2)').text().toLowerCase();
                    const unit = row.find('td:eq(3)').text().toLowerCase();
                    const subDepartment = row.find('td:eq(4)').text().toLowerCase();

                    if (report.includes(searchTerm) || subReport.includes(searchTerm) || unit.includes(searchTerm) || subDepartment.includes(searchTerm)) {
                        row.show();
                    } else {
                        row.hide();
                    }
                });
            });

            getBoxesData();
            populateReportDropdown();
        });

        if (localStorage.getItem('theme') === 'dark' || localStorage.getItem('theme') === null) {
            document.body.classList.add('dark-mode');
            document.getElementById('darkModeSwitch').innerHTML = '<i class="fas fa-sun"></i>';
        } else {
            document.body.classList.remove('dark-mode');
            document.getElementById('darkModeSwitch').innerHTML = '<i class="fas fa-moon"></i>';
        }

        document.getElementById('darkModeSwitch').addEventListener('click', function () {
            document.body.classList.toggle('dark-mode');

            if (document.body.classList.contains('dark-mode')) {
                localStorage.setItem('theme', 'dark');
                document.getElementById('darkModeSwitch').innerHTML = '<i class="fas fa-sun"></i>';
            } else {
                localStorage.setItem('theme', 'light');
                document.getElementById('darkModeSwitch').innerHTML = '<i class="fas fa-moon"></i>';
            }
            updateChartsForMode();
        });

        const updateChartsForMode = () => {
            if (overviewLineChart) overviewLineChart.options = { ...overviewLineChart.options, ...getColorSettings() };
            if (overviewBarChart) overviewBarChart.options = { ...overviewBarChart.options, ...getColorSettings() };
            if (overviewDonutChart) overviewDonutChart.options = { ...overviewDonutChart.options, ...getColorSettings() };
            if (lineChart) lineChart.options = { ...lineChart.options, ...getColorSettings() };
            if (detailBarChart) detailBarChart.options = { ...detailBarChart.options, ...getColorSettings() };

            if (overviewLineChart) overviewLineChart.update();
            if (overviewBarChart) overviewBarChart.update();
            if (overviewDonutChart) overviewDonutChart.update();
            if (lineChart) lineChart.update();
            if (detailBarChart) detailBarChart.update();
        };

        document.addEventListener('DOMContentLoaded', function () {
            updateChartsForMode();
        });
    </script>

</body>

</html>
