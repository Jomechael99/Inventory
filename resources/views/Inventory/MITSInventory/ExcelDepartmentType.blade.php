@extends('Inventory.main')


@section('content')

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

        <div class="box">
             <form method="post" action="{{ route('ExcelDepartmentType') }}" >
              <table id="example1" class="table table-bordered table-striped text-center">
            <thead>
                <tr>
                    <th> Department </th>
                    <th> Actions </th>
                </tr>
            </thead>

            <tbody class="text-center">
                 
                 @foreach($datavalue as $datavalue)
                 
                <tr>
                    <td> 
                    
                    @if ($datavalue -> Department_Type == "")
                        {{ $datavalue -> Department }}
                    @else                    
                    {{ $datavalue -> Department_Type }}
                    @endif

                    </td>
                    <td> <input type="checkbox" name="depttype[]" value="{{ $datavalue -> Department_Type }}">
                         <input type="hidden" name="deptid" value="{{ $datavalue -> Department }}"> </td>
                    
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