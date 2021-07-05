<html lang="en">
<head>
    <title>Laravel Ajax jquery Validation Tutorial</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>
<body>

<div class="container panel panel-default ">
    <h2 style="margin-top: 12px; text-align: center" class="alert alert-success">Company Form</h2><br>
    <form id="contactForm" enctype="multipart/form-data">
        <div class="form-group">
            <input type="text" name="name" class="form-control" required placeholder="Enter Name" id="name">
        </div>

        <div class="form-group">
            <input type="email" name="email" class="form-control" required placeholder="Enter Email" id="email">
        </div>

        <div class="form-group">
            <textarea  name="address" id="" class="form-control" required placeholder="Enter Address"></textarea>
        </div>

        <div class="form-group">
            <input type="file" name="file" class="form-control" accept=".csv"  required id="file">
        </div>
        <div class="form-group">
            <button class="btn btn-success" id="submit">Submit</button>
        </div>
    </form>
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
    <h2 style="margin-top: 12px; text-align: center" class="alert alert-success">Listing Company Data</h2><br>
    <div class="row">
        <div class="col-12">
            <table class="table table-bordered" id="">
                <thead>
                <tr>
                    <th>Company Name</th>
                    <th>Company Email</th>
                    <th>Company Address</th>
                    <td>Action</td>
                </tr>
                </thead>
                <tbody id="users-crud">
                @foreach($companies as $company)
                    <tr>
                        <td>{{ $company['name'] }}</td>
                        <td>{{ $company['email'] }}</td>
                        <td>{{ $company['address'] }}</td>
                        <td><a href="{{ url('edit/'.$company->id) }}" id="show-user" class="btn btn-info">View Report</a></td>     @endforeach
                    </tr>
                </tbody>
            </table>
{{--            {{ $users->links() }}--}}
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
<script type="text/javascript">

    var total = {!! json_encode($total) !!}
    var ctx = document.getElementById('myChart');
    var companyName = {!! json_encode($companyName) !!}
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: companyName,
            datasets: [{
                label: 'Company Earning',
                data:total,
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
    $('#contactForm').on('submit',function(e){
        e.preventDefault();
        var form = $('#contactForm')[0];
        var data = new FormData(form);
        data.append('_token',"{{ csrf_token() }}");
        $.ajax({
            url: "/form-submit",
            type:"POST",
            enctype: 'multipart/form-data',
            data:data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success:function(response){
                console.log(response);
            },
        });
    });
</script>
</body>
</html>
