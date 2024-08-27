@extends('layout.admin_layout')
@section('layout')
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Earnings (Monthly)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalordersThisMonth}} LE</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300" style="color: #4e73df;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Earnings (Annual)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalordersThisYear}} LE</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-yellow-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Orders (Monthly)
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-blue-800">{{$no_ordersThisMonth}}</div>
                            </div>
                            <div class="col">
                                <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-info" role="progressbar"
                                        style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-green-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Users (Monthly)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$usersThisMonth}}</div>
                    </div>
                    <div class="col-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1.7em" fill="gray" viewBox="0 0 640 512"><path d="M72 88a56 56 0 1 1 112 0A56 56 0 1 1 72 88zM64 245.7C54 256.9 48 271.8 48 288s6 31.1 16 42.3V245.7zm144.4-49.3C178.7 222.7 160 261.2 160 304c0 34.3 12 65.8 32 90.5V416c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V389.2C26.2 371.2 0 332.7 0 288c0-61.9 50.1-112 112-112h32c24 0 46.2 7.5 64.4 20.3zM448 416V394.5c20-24.7 32-56.2 32-90.5c0-42.8-18.7-81.3-48.4-107.7C449.8 183.5 472 176 496 176h32c61.9 0 112 50.1 112 112c0 44.7-26.2 83.2-64 101.2V416c0 17.7-14.3 32-32 32H480c-17.7 0-32-14.3-32-32zm8-328a56 56 0 1 1 112 0A56 56 0 1 1 456 88zM576 245.7v84.7c10-11.3 16-26.1 16-42.3s-6-31.1-16-42.3zM320 32a64 64 0 1 1 0 128 64 64 0 1 1 0-128zM240 304c0 16.2 6 31 16 42.3V261.7c-10 11.3-16 26.1-16 42.3zm144-42.3v84.7c10-11.3 16-26.1 16-42.3s-6-31.1-16-42.3zM448 304c0 44.7-26.2 83.2-64 101.2V448c0 17.7-14.3 32-32 32H288c-17.7 0-32-14.3-32-32V405.2c-37.8-18-64-56.5-64-101.2c0-61.9 50.1-112 112-112h32c61.9 0 112 50.1 112 112z"/></svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
            <div class="dropdown no-arrow">
                <!-- <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                    aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-header">Dropdown Header:</div>
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div> -->
            </div>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="chart-area">
                <canvas id="myAreaChartt"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Prepare the data for the chart
        var months = @json($months);
        var sums = @json($sums);

        // Create the chart
        var ctx = document.getElementById('myAreaChartt').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                    label: 'Revenue',
                    data: sums,
                    fill: true,
                    backgroundColor: 'rgba(78, 115, 223, 0.1)',
                    borderColor: 'rgba(78, 115, 223, 1)',
                    pointRadius: 3,
                    pointBackgroundColor: 'rgba(78, 115, 223, 1)',
                    pointBorderColor: 'rgba(78, 115, 223, 1)',
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: 'rgba(78, 115, 223, 1)',
                    pointHoverBorderColor: 'rgba(78, 115, 223, 1)',
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                }],
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                scales: {
                    x: {
                        display: true,
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        display: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        },
                        ticks: {
                            beginAtZero: true,
                            callback: function (value, index, values) {
                                return '$' + value;
                            }
                        }
                    }
                },
                legend: {
                    display: false
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                    callbacks: {
                        label: function (tooltipItem, data) {
                            var label = data.datasets[tooltipItem.datasetIndex].label || '';
                            var value = tooltipItem.yLabel;
                            return label + ': $' + value;
                        }
                    }
                }
            }
        });
    });
</script>

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Number Of Visitors</h6>
            <!-- <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
            </div> -->
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="chart-pie pt-4 pb-2">
                <canvas id="myChart"></canvas>
            </div>
            <div class="mt-4 text-center small">
                <span class="mr-2">
                    <i class="fas fa-circle text-primary"></i> Number Of Visitors This Month Is <span style="color: red;">{{$no_visitors}}</span>
                </span>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Fetch the number of visitors
        var no_visitors = <?php echo $no_visitors; ?>;
       

        // Create the chart
        var ctx = document.getElementById('myChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Number Of Visitors'],
                datasets: [{
                    data: [no_visitors],
                    backgroundColor: ['#4e73df'],
                    hoverBackgroundColor: ['#2e59d9'],
                    hoverBorderColor: 'rgba(234, 236, 244, 1)',
                }],
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                cutoutPercentage: 80,
                legend: {
                    display: false
                },
                tooltips: {
                    backgroundColor: 'rgb(255,255,255)',
                    bodyFontColor: '#858796',
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                plugins: {
                    datalabels: {
                        display: true,
                        color: 'white',
                        font: {
                            weight: 'bold'
                        },
                        formatter: function (value, context) {
                            return value;
                        }
                    }
                }
            }
        });
    });
</script>
</div>

<!-- Content Row -->


<div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">New Orders</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                        <th>User Name</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Total</th>
                        <th>Order Status</th>
                        <th style="color: green;">See Details</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                        <th>User Name</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>Total</th>
                            <th>Order Status</th>
                            <th style="color: green;">See Details</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($ordersThisMonth as $item)
                        @php
                        $encrypted_id = Crypt::encryptString($item->id);
                        @endphp
                        <tr>
                            <td>{{$item->name}}</td>
                            <td>{{$item->phone}}</td>
                            <td>{{$item->address}}</td>
                            <td>{{$item->city}}</td>
                            <td>{{$item->grand_total}}</td>
                            @if($item->order_status == 0)
                            <td>Wating</td>
                            @elseif($item->order_status == 1)
                            <td>OWay</td>
                            @else
                            <td>Done</td>
                            @endif
                            <th style="color: green;"><a href="/admin/Order/Details/{{$encrypted_id}}"> <i class="fas fa-eye"></i></a></th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection