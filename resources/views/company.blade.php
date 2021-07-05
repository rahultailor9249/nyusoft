<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
<div class="container">
    <h2 style="margin-top: 12px;" class="alert alert-success">{{ $company->name }} company details</h2><br>
    <div class="row">
        <div class="col-12">
            <table class="table table-bordered" id="">
                <thead>
                <tr>
                    <th>Company Name</th>
                    <td>{{ $company->name }}</td>
                </tr>
                <tr>
                    <th>Company Email</th>
                    <td>{{ $company->email }}</td>
                </tr>
                <tr>
                    <th>Company Address</th>
                    <td>{{ $company->address }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Chart</div>
                    <div class="panel-body">
                        <canvas id="myChart" width="800" height="400"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="container">
    <div class="row">
    <div class="col-12">
            <table class="table table-bordered" id="">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Age</th>
                        <th>Earning2016</th>
                        <th>Earning2017</th>
                        <th>Earning2018</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($company->employee as $employee)
                        <tr>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->age }}</td>
                            <td>{{ $employee->earing2016 }}</td>
                            <td>{{ $employee->earing2017 }}</td>
                            <td>{{ $employee->earing2018 }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                <a href="{{ url('/')}}">Back to company detail</a>
            </div>
        </div>
    </div>
    </div>
</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
<script>
    var Yeartotal = {!! json_encode($Yeartotal) !!}
    var ctx = document.getElementById('myChart');
    var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [2016,2017,2018],
                datasets: [{
                    label: 'Company Earning',
                    data:Yeartotal,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: false
                    }
                }
            }
        });
</script>
