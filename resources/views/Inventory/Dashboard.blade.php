@extends('Inventory.main') @section('content')

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
   
    <?php 
    
        $validate = Session::get('validator');
        Session::remove('validator');
    
    ?>
    
    <div class="box">
        <div id="chartContainer" style="height: 300px; width: 100%;"></div>
    </div>
    @if(auth::guard('admins')->user()->type == 1)
    <div class="box">
       
       <div class="box">
           
           <span class="text-center"> <h5> <b> Date Range Excel Download </b> </h5> </span>
           
           
       </div>
       
       
        <div class="form-group">
               <form method="post" action="{{ route('ExportExcelViewDateRange') }}">
                <br>
              <div class="container col-md-12 col-sm-offset-3">

                    <div class="form-group col-md-3">
                        <label>Start Date : </label>
                        <input type="text" id="startdate" name="startdate" class="form-control" placeholder="Start Date">
                    </div>


                    <div class="form-group col-md-3">
                        <label>End Date : </label>
                        <input type="text" id="enddate" name="enddate" class="form-control" placeholder="End Date">
                    </div>


                </div>
            
            <div class="input-group col-md-9 col-md-offset-5">
                <br>
                
                <button type="submit" class="btn btn-primary btn-md"> Get the excel file </button>    
                
                <div><br></div>
            </div>
              {{ csrf_field() }}
               </form>
                <!-- /.input group -->
              </div>
      
    </div>
    @endif
    @if(auth::guard('admins')->user()->type == 1)
   
    <div class="box">
        <div class="box">
           
           <span class="text-center"> <h5> <b> Date Insertion Excel Download </b> </h5> </span>
           
           
       </div>
       
           <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th align="center"> Date of Insertion </th>
                    <th width="20%"> Action </th>
                </tr>
            </thead>

            <tbody class="text-center">

                @foreach($data as $data)

                <tr>

                    <td> {{ Carbon\Carbon::parse($data -> Date_Inserted)->toFormattedDateString() }} </td>
                    <td>
                        <a href="{{ route('ExportForm', ['id' => $data -> Date_Inserted ]) }}" class="btn btn-info btn-sm"> Export MITS Transaction </a>
                    </td>

                </tr>
                @endforeach

            </tbody>

        </table>


    </div>
    @endif
    @if(auth::guard('admins')->user()->type == 1)
   
    <div class="box">
       <div class="box">
           
           <span class="text-center"> <h5> <b> Department Excel Download </b> </h5> </span>
           
           
       </div>
       
        <table id="example3" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th align="center"> Department Name </th>
                    <th width="20%"> Action </th>
                </tr>
            </thead>

            <tbody class="text-center">
            
            
                @foreach($data1 as $data1)

                <tr>
                    <td>{{ $data1 -> Department}}</td>
                    <td>
                        <a href="{{ route('ViewDepartmentType', ['id' => $data1 -> Dept_Code ]) }}" class="btn btn-info btn-sm"> Department Excel File </a>
                    </td>
                </tr>

                @endforeach




            </tbody>

        </table>


    </div>
    @endif


</div>
<!--/.main-->


@endsection @section('scripts')

<script type="text/javascript">
    $(function() {
        $('#example1').DataTable()
        $('#example2').DataTable({
            'paging': true,
            'info': true,
            'autoWidth': false
        });
        $('#example3').DataTable({
            'paging': true,
            'info': true,
            'autoWidth': false
        });
      
           $('#startdate').daterangepicker({
                maxDate: new Date(),
               singleDatePicker: true,
               
           });
          $('#enddate').daterangepicker({
                maxDate: new Date(),
               singleDatePicker: true,
               
           });
        
         var valid = $('#validate').val();
            if (valid == 1){
                swal("Data is null!!", "Please pick another date","error");
             }

    });
    
    var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light1", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "Most Transact Items"
	},
	axisY: {
		title: "Items (Pcs)"
	},
	data: [{        
		type: "column",  
		showInLegend: true,
		dataPoints: [ 
            @foreach($data2 as $data2)
			{ y: {{$data2->Total_Quantity}} , label: "{{$data2->ProductName}}" },
			@endforeach
		]
	}]
});
chart.render();

        
</script>

@endsection
