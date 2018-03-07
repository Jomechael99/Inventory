@extends('Inventory.main')

@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

            <?php

                $swal = Session::get('swal');
                Session::remove('swal');
                
                
                $swaldel = Session::get('swaldel');
                Session::remove('swaldel');
    
            ?>

            <input type="text" value="{{ $swal }}" id="swalg" class="hidden">
            <input type="text" value="{{ $swaldel }}" id="swaldel" class="hidden">
                                          

     <button type="button" class="btn btn-info btn-lg" style="float: right;" data-toggle="modal" data-target="#myModal" data-keyboard="true"> Add New Department  </button>
                            <div id="myModal" class="modal fade" role="dialog" tabindex='-1'>
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title"> Department </h4>
                                        </div>
                                        <div class="modal-body">

                                            <form method="post" id="deptform" action="{{ route('AddDepartment') }}">

                                                <div class="row">

                                                   

                                                    <div class="container col-md-12">

                                                        <div class="form-group col-md-12">
                                                            <label>Department Name</label>
                                                            <input type="text" name="deptname" id="deptname" class="form-control" required>
                                                        </div>

                                                    </div>
                                                    <div class="container col-md-12">

                                                        <div class="form-group col-md-12">
                                                            <label>Department Code</label>
                                                            <input type="text" name="deptcode" id="deptcode" class="form-control" required>
                                                        </div>

                                                    </div>
                                                    

                                                    <div class="container col-md-12 col-md-offset-3">
                                                        <div class="form-group">

                                                            <button type="submit" class="btn btn-md btn-success">Proceed to Adding</button> &nbsp;
                                                            <button type="reset" value="Reset" class="btn btn-md btn-danger">Clear</button>&nbsp;
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>

                                                    </div>



                                                </div>

                                                {{ csrf_field() }}

                                            </form>



                                        </div>
                                        <div class="modal-footer">

                                        </div>
                                    </div>

                                </div>
                            </div>

                            <br>
                            <br>
                            <br>

    <div class="box">

    <div class="panel panel-default">
                    <!-- /.box-header -->
                    <div class="panel-body">
                        <div class="table-responsive no-padding">
                        <table id="example2" class="table table-bordered table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th>Department</th>
                                            <th>Department Code</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($DeptList as $Dept)
                                            <tr>
                                                <td> {{ $Dept -> Department }} </td>
                                                <td> {{ $Dept -> Dept_Code }}</td>
                                                <td> 
                                                
                                                <a class="btn btn-danger btn-sm" href="{{ route('DeleteDepartment', ['id' => $Dept -> Dept_Code ])}}"> Delete  </a>
                                                    
                                                </td>
                                                
                                            </tr>
                                        @endforeach
                                    </tbody>

                            


                            </table>
                        </div>
                    </div>
                </div>
    </div>

</div>
@endsection

@section('scripts')

<script>
    $(function() {

        $('#example2').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': true,
            'responsive': true,

        });

        
		var swalg = $('#swalg').val();
        
		var swaldel = $('#swaldel').val();


        if (swal == 0){
		 	swal("Department Duplicate!!", "Please Change the Dept Code","error");
		 }  
		 else if (swal == 1){
		 		swal("Department Added!!", "Sucessfully Added","success");
		 }

         
        if (swaldel == 2){
		 	swal("Error in Deleting!!", "Please retry the deletion","error");
		 }
		 else if (swaldel == 1){
		 		swal("Successfully Deleted!!", "Sucessfully Deleted","success");
		 }

    })

</script>

@endsection