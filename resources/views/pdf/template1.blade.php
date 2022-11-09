<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>template 1</title>
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
        <h1 class="c-green">Daily Activity Report</h1>
        <h2 class="c-green">Employee Information</h2>
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
                              <td>Employee Name</td>
                              <td>:</td>
                              <td>........</td>
                            </tr>
                            <tr>
                              <td>Review Period</td>
                              <td>:</td>
                              <td>........</td>
                            </tr>
                          </table>
                      </td>
                      <td>
                        <table>
                            <tr>
                              <td>Employee Name</td>
                              <td>:</td>
                              <td>........</td>
                            </tr>
                            <tr>
                              <td>Review Period</td>
                              <td>:</td>
                              <td>........</td>
                            </tr>
                          </table>
                      </td>
                    </tr>
                  </table>
            </div>
        </div>
    </div>
    <div>
    @php 
    $p=1;
    $a=1;
    $d=1;
    $o=1;
    $date = date("Y-m-d");
    @endphp
    <table id="task">
                <tr>
                    <th>#</th>
                    <th>Task Name</th>
                    <th>Date Complated</th>
                    <th>Status</th>
                </tr>
        @foreach($data as $i => $item)
        @if($item['status'] == 'Pending')
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
        @endif
        @endforeach
        </table>
        <table id="task">
                <tr>
                    <th>#</th>
                    <th>Task Name</th>
                    <th>Date Complated</th>
                    <th>Status</th>
                </tr>
        @foreach($data as $i => $item)
        @if($item['status'] == 'Complated')

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

        @endif
        @endforeach
        </table>
        @foreach($data as $i => $item)
        @if($item['status'] == 'Progres')
    <table id="task">
                <tr>
                    <th>#</th>
                    <th>Task Name</th>
                    <th>Date Complated</th>
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
        
        @foreach($data as $i => $item)
        @if($item['status'] == 'Open')
    <table id="task">
                <tr>
                    <th>#</th>
                    <th>Task Name</th>
                    <th>Date Complated</th>
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
    </div>
    <div>
        <h3 class="c-green">Export Date:</h3>
        <div>{{$date}}</div>
        
    </div>
</body>
</html>