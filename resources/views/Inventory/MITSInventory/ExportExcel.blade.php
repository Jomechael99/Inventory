<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            border-collapse: collapse;

        }

        thead,
        tbody {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        td,th,tr{
            border: 1px solid #dddddd;
        }

    </style>

</head>

<body>

    <table border = 1>
        <thead>
            <tr>
                <th> Department </th>
                <th> Employee Name </th>
                <th> Date </th>
                <th> MITS </th>
                <th> MRS </th>
                <th> QTY </th>
                <th> UOM </th>
                <th> Furniture </th>
                <th> Telecoms </th>
                <th> Computer Equipment </th>
                <th> Office Equipment </th>
                <th> Appliances </th>
                <th> Electrical Equipment </th>
                <th> Office Supplies </th>
                <th> Product Code </th>
                <th> Remarks </th>
            </tr>
        </thead>

        <tbody>

               @foreach($data2 as $key)
                @foreach($key as $key2)
                     <tr>
                     <td> {{ $key2 -> Department  }} - {{ $key2 -> Department_Type }}</td>
                     <td> {{ $key2 -> Emp_Lname }},{{ $key2 -> Emp_Fname }}</td>
                     <td>   {{ Carbon\Carbon::parse($key2 -> Date_Of_Received )->format('F j, Y')}}</td>
                     
                     <td> {{ $key2 -> MITS }}</td>
                     <td> {{ $key2 -> MRS }}</td>
                     <td>{{ $key2 -> QTY}}</td>
                     <td>{{ $key2 -> OUM }}</td>
                     <td>
                         @if($key2 -> Particular == 'Furniture')
                            {{ $key2 -> ProductName }}
                         @endif
                         
                     </td>
                     <td>@if($key2 -> Particular == 'Telecoms')
                            {{ $key2 -> ProductName }}
                         @endif
                     </td>
                     <td>
                         @if($key2 -> Particular == 'Computer Equipment')
                            {{ $key2 -> ProductName }}
                         @endif
                         
                     </td>
                     <td>
                         @if($key2 -> Particular == 'Office Equipment')
                            {{ $key2 -> ProductName }}
                         @endif
                         
                     </td>
                     <td>
                         @if($key2 -> Particular == 'Appliances')
                            {{ $key2 -> ProductName }}
                         @endif
                         
                     </td>
                     <td>
                         @if($key2 -> Particular == 'Electrical Equipment')
                            {{ $key2 -> ProductName }}
                         @endif
                         
                     </td>
                     <td>
                         @if($key2 -> Particular == 'Office Supplies')
                           
                            {{ $key2 -> ProductName }}
                           
                         @endif
                         
                     </td>
                     <td>{{ $key2 -> Product_Code }}</td>
                     <td>{{ $key2 -> Remarks }}</td>    
                     </tr>
                      
                @endforeach 
               @endforeach
                       
                        
        </tbody>


    </table>



</body>

</html>
