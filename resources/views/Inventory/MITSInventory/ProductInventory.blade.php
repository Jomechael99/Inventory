@extends('Inventory.main') @section('content')

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">List of Products</h3>
            </div>

            <?php

            	$validate = Session::get('validator');
            	Session::remove('validator');

            	$deletion = Session::get('deletion');
            	Session::remove('deletion');
            
                $excelvalid = Session::get('excelvalidator');
                Session::remove('excelvalidator');

            ?>

                <input type="text" id="excelvalid" value="{{ $excelvalid }}" class="hidden">



                <!-- /.box-header -->

                <!-- Button trigger modal -->
                @if( Auth::guard('admins')->user()->type == 1)
                <button type="button" class="btn btn-success col-sm-offset-8" data-toggle="modal" data-target="#ImportExcel" data-keyboard="true"> Import Excel File </button>
                <div class="modal fade" id="ImportExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-center" id="ItemModal">Import / Restore Execel File</h5>
                            </div>
                            <div class="modal-body">

                                {!! Form::open(array('route' => 'AddExcel','method'=>'POST','files'=>'true')) !!}

                                <div class="form-group">

                                    <label> Excel File </label> {!! Form::file('excelfile', array('class' => 'form-control', 'accept' => '.csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel', 'required' => 'true')) !!}

                                </div>

                                <div class="modal-footer">

                                    <button type="submit" class="btn btn-primary"> Save changes </button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                </div>

                                {{ csrf_field() }} {!! Form::close() !!}

                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if(Auth::guard('admins')->user()-> type == 1)
                <button type="button" class="btn btn-primary col-md-offset-0" data-toggle="modal" data-target="#AddItem" data-keyboard="true">
					    Add Item To The Product List
					  </button>

                <!-- Modal -->
                <div class="modal fade" id="AddItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-center" id="ItemModal">Item Information</h5>
                            </div>
                            <div class="modal-body">

                                <form method="post" action="{{ route('AddItem') }}" id="ItemForm">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">


                                    <div class="form-group">
                                        <label for="ItemName">Item Name: </label>
                                        <input type="text" class="form-control" name="ItemName" placeholder="Item Name" id="Items">
                                    </div>
                                    <div class="form-group">
                                        <label for="ItemPart">Item Particulars</label>
                                        <select class="form-control" name="ItemPart">
									     	<option value="">Select..</option>
									        <option value="Furniture"> Furniture </option>
									        <option value="Telecom"> Telecom </option>
									        <option value="Computer Equipment"> Computer Equipment </option>
									        <option value="Office Equipment"> Office Equipment </option>
									        <option value="Appliances"> Appliances </option>
											<option value="Electrical Equipment"> Electrical Equipment </option>
											<option value="Office Supplies"> Office Supplies </option>
										 </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="Product Code"> Product Code: </label>
                                        <input type="text" name="prodcode" class="form-control" placeholder="Product Code..">
                                    </div>


                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary"> Save changes </button>
                                    </div>
                                    <input type="text" value="{{ $validate }}" id="validate" class="hidden">
                                    <input type="text" value="{{ $deletion }}" id="delete" class="hidden"> {{ csrf_field() }}

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th> Product No </th>
                                <th> Item Name </th>
                                <th> Particulars</th>
                                <th> Product Code</th>
                                <th> Total Quantity</th>
                                @if(Auth::guard('admins')->user()-> type == 1)
                                <th class="text-center"> Action </th>
                                @endif
                            </tr>
                        </thead>

                        <tbody class="text-center">
                            @foreach($product as $product)

                            <tr>

                                <td> <b> PROD-{{ $product -> ProductID }} </b> </td>
                                <td> {{ $product -> ProductName }}</td>
                                <td> {{ $product -> Particular}}</td>
                                <td> {{ $product -> Product_Code }}</td>
                                <td> {{ $product -> Total_Quantity}} Pcs</td>
                                @if(Auth::guard('admins')->user()->type == 1)
                                <td>
                                    <a href="{{ route('DeleteItems', $product->ProductNo) }}" class="btn btn-danger"> Delete </button>
								</td>
                                @endif
                            								@endforeach <!-- end of foreach -->

                            </tr>


                </tbody>

                                </table>
            </div>
            <!-- /.box-body -->
          </div>

    	</div>
    </div> <!-- End -->


@endsection

@section('scripts')
	<script>

    $(function() {
            $('#example1').DataTable()
            $('#example2').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': false,
                'ordering' : true,
                'info': true,
                'autoWidth': false
            })
        
		$('#AddItem').modal({

			'keyboard' : true,
			'show' : false,

		});

		$('#AddItem').on('hidden.bs.modal', function(e){

			$(this).find("input,select").val('').end();

		});


		// Validation

		$('#ItemForm').validate({
			rules: {
				ItemName: {
					required: true,
				},
				ItemPart: {
					required: true,
				}

			},
			messages: {
				ItemName: {
					required: "Please input the Item Name",
				},
				ItemPart: {
					required: "Please Select The Item Particulars",
				}
			}
		});

		 var valid = $('#validate').val();
		  var del = $('#delete').val();
            var excel = $('#excelvalid').val();




		 if (valid == 1){
		 	swal("Item Duplicate!!", "Please add other items","error");
		 }
		 else if (valid == 2){
		 		swal("Item Added!!", "Sucessfully Added","success");
		 }

		 if (del == 1){

		 	swal("Item Deleted!!", "Sucessfully Deleted","success");
		 }
		 else if (del == 2){
		 		swal("Item Not Deleted!!", "Please Retry The Deletion","error");
		 }
      
           if (excel == 1){
                swal("Error in Excel File!!", "Please add other Excel File","error");
             }
             else if (excel == 2){
                    swal("Excel File Added!!", "Sucessfully Added","success");
             }



  }); // End of Function



</script>


@endsection
