@extends('Inventory.main')


@section('content')

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

        <div class="box">
             <form method="post" action="{{ route('ViewExport') }}" >
              <table id="example1" class="table table-bordered table-striped text-center">
            <thead>
                <tr>
                    <th align="center"> MITS </th>
                    <th width="20%"> Employee Name </th>
                    <th> Department </th>
                    <th> Actions </th>
                </tr>
            </thead>

            <tbody class="text-center">
                 
                 @foreach($datavalue as $datavalue)
                 
                <tr>
                   
                    <td><b>MITS</b> #{{ $datavalue -> MITS }}</td>
                    <td> {{ $datavalue -> Emp_Lname }}&nbsp;,&nbsp;{{ $datavalue -> Emp_Fname }} </td>
                    
                    <td> {{ $datavalue -> Department }} </td>
                    <td> <input type="checkbox" name="mits[]" value="{{ $datavalue -> MITS }}"></td>
                    
                </tr>

                 @endforeach
              
              
            </tbody>

        </table>
        
        <button class="btn btn-primary" type="submit" style="float: right; margin-right: 20px;"> Submit the Button </button>
        <br>
        <br>
        <br>
        {{ csrf_field() }}
        
        </form>

     
           
            
        </div>
   
   
    </div>





@endsection


@section('scripts')
    
    <script>
        
        
    </script>
    

@endsection