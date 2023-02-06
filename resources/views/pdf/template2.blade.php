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
    color: white;
    }

    #task tr{background-color: #ff7400b5;}
    #task tr:nth-child(even){background-color: #ff7400;}

    #task tr:hover {background-color: #ddd;}

    #task th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #ff7400;
    color: white;
    }
    .c-green{
        color: #ff7400;
    }
    .c-white{
        color: white;
    }
    .t-center{
        text-align: center;
    }
    </style>
</head>
<body>
    @php
    $p=1;
    $a=1;
    $d=1;
    $o=1;
    $date = date("Y-m-d");
    @endphp
<div>
    <div style="padding: 50px; background-color: #ff7400;">
        <h1 class="c-white t-center">{{ $proyek['project_name'] }} Proyek Status Report</h1>
    </div>
    <div style="padding-top: 20px;">
    <div style="padding: 10px; background-color: #ddd; margin-top:10px; display: inline-block; border-radius: 5%;">Export Date: {{$date}}</div>
    <div style="padding: 10px; background-color: #ddd; margin-top:10px; display: inline-block; border-radius: 5%;">Status Project: {{$date}}</div>
    <div style="padding: 10px; background-color: #ddd; margin-top:10px; display: inline-block; border-radius: 5%;">End Project: {{$date}}</div>
    </div>
    <div>
    @php 
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
                        <th scope="row">{{ $d++ }}</th>
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
        <h4>Open Task</h4>
                <table id="task">
                    <tr>
                        <th>#</th>
                        <th>Task Name</th>
                        <th>Start Date</th>
                        <th>Status</th>
                    </tr>
            @foreach($data as $i => $item)
                @if($item['status'] == 'Open')
                
                    <tr>
                        <th scope="row">{{ $o++ }}</th>
                        <td>{{ $item['title'] }}</td>
                        <td>
                        {{ $item['start'] }}
                        </td>
                        <td>
                        {{ $item['status'] }}
                        </td>
                    </tr>
                
                @endif
            @endforeach
            </table>
        @endif
    </div>
        
        
    </div>
</body>
</html>