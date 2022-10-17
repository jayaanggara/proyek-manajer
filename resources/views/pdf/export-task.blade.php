<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        @page{
            margin:3cm 3cm 3cm 4cm;
        }
    </style>
</head>
<body>
    <div>
    <table>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Status</th> 
                    <th>Deadline</th> 
                </tr>
            
            @foreach($data as $i => $item)
            <tr>
                
            <th scope="row">{{ $i+1 }}</th>
            <td>{{ $item['title'] }}</td>
            <td>
               {{ $item['status'] }}
            </td>
            <td>
               {{ $item['deadline'] }}
            </td>
            </tr>
            @endforeach
        </table>
    </div>

</body>
</html>