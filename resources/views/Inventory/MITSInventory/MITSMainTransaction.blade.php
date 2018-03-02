@extends('Inventory.main') @section('content')

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

    <?php
    
        $newreq = Session::get('newreq');
        Session::remove('newreq');
        $DelProd = Session::get('DelProd');
        Session::remove('DelProd');
    
    
    ?>

        <input type="text" value="{{ $newreq }}" id="newreq" hidden>
        <input type="text" value="{{ $DelProd}}" id="DelProd" hidden>


        <div class="panel panel-primary">
            <div class="panel-heading text-center">
                 <span> List of Items | MITS   #{{ $mitsid }} </span>
                
               
            </div>

            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        @if(auth::guard('admins')->user()->type == 1)
                        <a href="{{ route('getAddingItem', ['id' => $mitsid]) }}" class="btn btn-success" style="float: right;"> Proceed to Adding of Item </a>
                        <a href="{{ route('MITSFormMain') }}" class="btn btn-warning" style="float:left"> Back </a>
                        <br><br>
                        @endif

                        <!-- /.row -->



                        <div class="box">
                            
                            
                                <div class="box-body">
                                                   
                                                    <table id="example2" class="table table-bordered table-hover" style="border: 10px;">
                                                        <thead>
                                                            <tr>

                                                                <th width="3%">MITS</th>
                                                                <th width="2%">Unit of Measure</th>
                                                                <th>Quantity</th>
                                                                <th>Product Name</th>
                                                                <th>Product Serial #</th>
                                                                <th>Remarks / Description </th>
                                                                @if(auth::guard('admins')->user()->type == 1)
                                                                <th>Actions</th>
                                                                @endif
                                                            </tr>
                                                        </thead>
                                                        <tbody class="text-center">
                                                            @foreach($trans as $trans)
                                                            <tr>

                                                                <td>{{ $trans->MITS}}</td>
                                                                <td>{{ $trans->OUM}}</td>
                                                                <td>{{ $trans->QTY}}</td>
                                                                <td>{{ $trans->ProductName}}</td>
                                                                <td>{{ $trans->ProductCode}}</td>
                                                                <td>{{ $trans->Remarks}}</td>
                                                                @if(auth::guard('admins')->user()->type == 1)
                                                                <td>

                                                                    <div class="btn-group-vertical">

                                                                        <a href="{{ route('deleteProduct', ['id' => $trans -> Transno, 'id2' => $trans -> MITS ])}}" class="btn btn-danger btn-xs"><span class="fa fa-times"> Delete Product</span></a>

                                                                    </div>
                                                                </td>
                                                                @endif

                                                            </tr>
                                                            @endforeach

                                                        </tbody>

                                                    </table>
                                                </div>
                                
                            </div>


                           
                            <!-- /.col-->


                            <!-- /.box-header -->

                            <!-- /.box-body -->
                        </div>



                   
                </div>
            </section>



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
                    'autoWidth': true,
                });


                $("#tags").autocomplete({
                    source: 'http://localhost:8000/MITS/MITSSearch',
                    minLength: 1,
                    appendTo: "#productform",
                    select: function(event, ui) {
                        $('#tags').val(ui.item.value);
                        $('#prodid').val(ui.item.id);
                        if (ui.item.particular == 1) {
                            $('#parti').val("Furniture");
                            $('#parti2').val("Furniture");
                        } else if (ui.item.particular == 2) {
                            $('#parti').val("Telecom");
                            $('#parti2').val("Telecom");
                        } else if (ui.item.particular == 3) {
                            $('#parti').val("Computer Equipment");
                            $('#parti2').val("Computer Equipment");
                        } else if (ui.item.particular == 4) {
                            $('#parti').val("Office Equipment");
                            $('#parti2').val("Office Equipment");
                        } else if (ui.item.particular == 5) {
                            $('#parti').val("Appliances");
                            $('#parti2').val("Appliances");
                        } else if (ui.item.particular == 6) {
                            $('#parti').val("Electrical Equipment");
                            $('#parti2').val("Electrical Equipment");
                        } else if (ui.item.particular == 7) {
                            $('#parti').val("Office Supplies");
                            $('#parti2').val("Office Supplies");
                        } else if (ui.item.particular == null) {
                            $('#parti').val("");
                            $('#parti2').val("");
                        } else {
                            $('#parti').val("");
                            $('#parti2').val("");
                        }
                    }
                });


                //   $('#uomselecttext').hide();



                //               

                var newreq = $('#newreq').val();

                if (newreq == 1) {
                    swal("MITS Duplicate!!", "Please check if MITS is Exist", "error");
                } else if (newreq == 2) {
                    swal("MITS Transaction Added!!", "Sucessfully Added", "success");
                }

                var delprod = $('#DelProd').val();

                if (delprod == 1) {
                    swal("Item in Transaction Deleted!!", "Sucessfully Deleted", "success");
                } else if (delprod == 2) {
                    swal("Error in Deletion of Item!!", "Please retry the Deletion", "error");
                }


                // Dynamic Form

                var rowCount = $('table >tbody:last >tr').length;
                if (rowCount == 1) {
                    document.getElementsByClassName('btn-remove')[0].disabled = true;
                }

                $(document).on('click', '.btn-add', function(e) {
                    e.preventDefault();

                    var controlForm = $('table');
                    var currentEntry = $('table>tbody>tr:last');
                    var newEntry = $(currentEntry.clone()).appendTo(controlForm);
                    newEntry.find('input').val(''); //Remove the Data - as it is cloned from the above

                    //Add the button  
                    var rowCount = $('table >tbody:last >tr').length;
                    if (rowCount > 1) {
                        var removeButtons = document.getElementsByClassName('btn-remove');
                        for (var i = 0; i < removeButtons.length; i++) {
                            removeButtons.item(i).disabled = false;
                        }
                    }

                }).on('click', '.btn-remove', function(e) {
                    $(this).parents('tr:first').remove();

                    //Disable the Remove Button
                    var rowCount = $('table >tbody:last >tr').length;
                    if (rowCount == 1) {
                        document.getElementsByClassName('btn-remove')[0].disabled = true;
                    }

                    e.preventDefault();
                    return false;
                });



            });

        </script>

        @endsection
