@extends('Inventory.main') @section('content')

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

    <?php
    
        $DelMITS = Session::get('DelMITS');
        Session::remove('DelMITS');
    
    ?>

        <input type="text" value="{{ $DelMITS }}" id="DelMITS" hidden>

        <div class="panel panel-primary">
            <div class="panel-heading text-center">
                Material Insurance / Transfer Slip
            </div>

           
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div>
                            @if(auth::guard('admins')->user()->type == 1)
                            <button type="button" class="btn btn-info btn-lg" style="float: right;" data-toggle="modal" data-target="#myModal" data-keyboard="true"> Add New MITS  </button>
                            <div id="myModal" class="modal fade" role="dialog" tabindex='-1'>
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title"> Department </h4>
                                        </div>
                                        <div class="modal-body">

                                            <form method="post" id="deptform" action="{{ route('NewMITS') }}">

                                                <div class="row">

                                                    <div class="container col-md-12">

                                                        <div class="form-group col-md-6">
                                                            <label>First Name</label>
                                                            <input type="text" name="firstname" class="form-control" placeholder="First Name..." required>
                                                        </div>


                                                        <div class="form-group col-md-6">
                                                            <label>Last Name</label>
                                                            <input type="text" name="lastname" class="form-control" placeholder="Last Name..." required>
                                                        </div>


                                                    </div>

                                                    <div class="container col-md-12">

                                                        <div class="form-group col-md-12">
                                                            <label>Department</label>
                                                            <input type="text" name="department" class="form-control" placeholder="Department name..." list="department" required>
                                                            <datalist id="department">
                                                               
                                                               @foreach($deptlist as $deptlist)
                                                               
                                                                <option value="{{ $deptlist -> Dept_Code }}"> {{ $deptlist -> Department }} </option>
                                                                   
                                                               
                                                               @endforeach()
                                                               
                                                                
                                                            </datalist>

                                                        </div>
                                                    </div>

                                                    <div class="container col-md-12">

                                                        <div class="form-group col-md-12">
                                                            <label>Department Type</label>
                                                            <input type="text" name="departmenttype" class="form-control" placeholder="Department Type..." list="departmenttype">
                                                            <datalist id="departmenttype">
                                                               
                                                               @foreach($depttype as $depttype)
                                                               
                                                                <option value="{{ $depttype -> Department_Type }}"> {{ $depttype -> Department_Type }} </option>
                                                                   
                                                               
                                                               @endforeach()
                                                               
                                                                
                                                            </datalist>

                                                        </div>
                                                    </div>

                                                    <div class="container col-md-12">

                                                        <div class="form-group col-md-12">
                                                            <label>Date of Received</label>
                                                            <input type="date" name="datereq" id="txtDate" class="form-control" required>
                                                        </div>

                                                    </div>
                                                    <div class="container col-md-12">

                                                        <div class="form-group col-md-6">
                                                            <label>MITS</label>
                                                            <input type="text" name="mits" id="mits" class="form-control" placeholder="MITS... " required>
                                                        </div>


                                                        <div class="form-group col-md-6">
                                                            <label>MRS</label>
                                                            <input type="text" name="mrs" class="form-control" placeholder="MRS">
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

                        </div>

                        @endif
                        <div class="box">

                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="example2" class="table table-bordered table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th>Department</th>
                                            <th>Department Type</th>
                                            <th>Name</th>
                                            <th>Date</th>
                                            <th>MITS</th>
                                            <th>MRS</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($dept as $dept)
                                        <tr>
                                            <td>{{ $dept -> Department }}</td>
                                            <td>{{ $dept -> Department_Type }}</td>
                                            <td>{{ $dept -> Emp_Lname}} , {{ $dept -> Emp_Fname }}
                                            </td>
                                            <td>{{ Carbon\Carbon::parse($dept -> Date_Of_Received)->format('F j, Y')}}</td>
                                            <td>{{ $dept -> MITS }}</td>
                                            <td>{{ $dept -> MRS }}</td>
                                            <td class="text-center">
                                                <div class="btn-group-vertical">
                                                    <a href="{{ route('MITSTransaction', ['id' => $dept -> MITS ]) }}" type="button" class="btn btn-primary btn-xs"><span class="fa fa-plus"> View/Update Transaction </span></a>
                                                    @if(auth::guard('admins')->user()->type == 1)
                                                    <a href="{{ route('deleteMITS', ['id' => $dept -> MITS ]) }}" class="btn btn-danger btn-xs"><span class="fa fa-times"> Delete Transaction</span></a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                </div>
            </section>


            <!-- -->

        </div>



</div>




@endsection @section('scripts')

<script>
    $(function() {

        $('#example2').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false,
            'responsive': true,

        })
    })


    var dateControler = {
        currentDate: null
    }

    $(document).on("change", "#txtDate", function(event, ui) {
        var now = new Date();
        var selectedDate = new Date($(this).val());

        if (selectedDate > now) {
            $(this).val(dateControler.currentDate)
        } else {
            dateControler.currentDate = $(this).val();
        }
    });

    $("#mits").keydown(function(e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            // Allow: Ctrl/cmd+A
            (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Allow: Ctrl/cmd+C
            (e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Allow: Ctrl/cmd+X
            (e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

    var deletion = $('#DelMITS').val();

    if (deletion == 1) {

        swal("Transaction Deleted!!", "Sucessfully Deleted", "success");
    } else if (deletion == 2) {
        swal("Transaction Not Deleted!!", "Please Retry The Deletion", "error");
    }

</script>

@endsection
