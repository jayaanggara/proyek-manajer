<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $proyek['project_name'] }} Export Task List - {{ date("Y-m-d") }}</title>
    <style>
        @page{
            margin:1cm 1cm 1cm 2cm;
        }
        *{
        font-family: Arial, Helvetica, sans-serif;
    }
    .w-100{
        width: 100%;
    }
    .col-6{
        text-align: left;
        width: 50%;
        padding: 5px;
    }

    #task {
    border-collapse: collapse;
    width: 100%;
    margin-top: 10px;
    }

    #task td, #task th {
    border: 1px solid #ddd;
    padding: 8px;
    }

    #task tr:nth-child(even){background-color: #f2f2f2;}

    #task tr:hover {background-color: #ddd;}

    #task th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #167564;
    color: white;
    }
    .c-green{
        color: #167564;
    }
    </style>
</head>
<body>
<div>
        <h1 class="c-green">Activity Report</h1>
    </div>
    <div>
    <div class="w-100">
            <div class="w-100">
                <table class="w-100">
                    <tr>
                      <th class="col-6">Firstname</th>
                      <th class="col-6">Lastname</th>
                    </tr>
                    <tr>
                      <td>
                        <table>
                            <tr>
                              <td>Project Name</td>
                              <td>:</td>
                              <td>{{ $proyek['project_name'] }}</td>
                            </tr>
                            <tr>
                              <td>Status</td>
                              <td>:</td>
                              <td>{{ $proyek['status'] }}</td>
                            </tr>
                          </table>
                      </td>
                      <td>
                        <table>
                            <tr>
                              <td>Company Name</td>
                              <td>:</td>
                              <td>{{ $proyek['company_name'] }}</td>
                            </tr>
                            <tr>
                              <td>End Date Proyek</td>
                              <td>:</td>
                              <td>{{ $proyek['end_date'] }}</td>
                            </tr>
                          </table>
                      </td>
                    </tr>
                  </table>
            </div>
        </div>
    </div>
    <hr></hr>
    <div>
    @php 
    $p=1;
    $a=1;
    $d=1;
    $o=1;
    $date = date("Y-m-d");
    $progressPending = 0;
    foreach($data as $i => $item){
    if($item['status'] == 'Pending'){
        $progressPending++;
    }
    }
    
    $progresscomplete = 0;
    foreach($data as $i => $item){
    if($item['status'] == 'complete'){
        $progresscomplete++;
    }
    }

    $progressOpen = 0;
    foreach($data as $i => $item){
    if($item['status'] == 'Open'){
        $progressOpen++;
    }
    }

    $progres = 0;
    foreach($data as $i => $item){
    if($item['status'] == 'Progres'){
        $progres++;
    }
    }

    @endphp
        @if($progressPending > 0)
            @foreach($data as $i => $item)
                @if($item['status'] == 'Pending')
                <h4>Pending Task</h4>
                <table id="task">
                    <tr>
                        <th>#</th>
                        <th>Task Name</th>
                        <th>Start Date</th>
                        <th>Status</th>
                    </tr>
                    <tr>
                        <th scope="row">{{ $p++ }}</th>
                        <td>{{ $item['title'] }}</td>
                        <td>
                        {{ $item['start'] }}
                        </td>
                        <td>
                        {{ $item['status'] }}
                        </td>
                    </tr>
                </table>
                @endif
            @endforeach
        @endif
        

        @if($progresscomplete > 0)
            @foreach($data as $i => $item)
                @if($item['status'] == 'complete')
                <h4>Complete Task</h4>
                    <table id="task">
                        <tr>
                            <th>#</th>
                            <th>Task Name</th>
                            <th>Start Date</th>
                            <th>Status</th>
                        </tr>

                        <tr>    
                            <th scope="row">{{ $a++ }}</th>
                            <td>{{ $item['title'] }}</td>
                            <td>
                            {{ $item['start'] }}
                            </td>
                            <td>
                            {{ $item['status'] }}
                            </td>
                        </tr>
                    </table>
                @endif
            @endforeach
        @endif

        @if($progres > 0)
            @foreach($data as $i => $item)
                @if($item['status'] == 'Progres')
                <h4>Progress Task</h4>
                <table id="task">
                    <tr>
                        <th>#</th>
                        <th>Task Name</th>
                        <th>Start Date</th>
                        <th>Status</th>
                    </tr>
                    <tr>
                        <th scope="row">{{ $i+1 }}</th>
                        <td>{{ $item['title'] }}</td>
                        <td>
                        {{ $item['start'] }}
                        </td>
                        <td>
                        {{ $item['status'] }}
                        </td>
                    </tr>
                </table>
                @endif
            @endforeach
        @endif
        

        @if($progressOpen > 0)
            @foreach($data as $i => $item)
                @if($item['status'] == 'Open')
                <h4>Open Task</h4>
                <table id="task">
                    <tr>
                        <th>#</th>
                        <th>Task Name</th>
                        <th>Start Date</th>
                        <th>Status</th>
                    </tr>
                    <tr>
                        <th scope="row">{{ $i+1 }}</th>
                        <td>{{ $item['title'] }}</td>
                        <td>
                        {{ $item['start'] }}
                        </td>
                        <td>
                        {{ $item['status'] }}
                        </td>
                    </tr>
                </table>
                @endif
            @endforeach
        @endif
    </div>
    <div>
        <h3 class="c-green">Export Date:</h3>
        <div>{{$date}}</div>
        
    </div>
</body>
</html>