@extends('Inventory.main')
 @section('content')

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

     <?php

            	$validate = Session::get('validator');
            	Session::remove('validator');
    
    ?>

   
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">MITS Form</h3>
        </div>
        <div class="panel-body">

            <form method="POST" action="{{ route('AddMITSForm') }}" id="MITSForm">

                <div class="container col-md-12 col-sm-offset-3">

                    <div class="form-group col-md-3">
                        <label>First Name</label>
                        <input type="text" name="firstname" class="form-control" placeholder="First Name...">
                    </div>


                    <div class="form-group col-md-3">
                        <label>Last Name</label>
                        <input type="text" name="lastname" class="form-control" placeholder="Last Name...">
                    </div>


                </div>
                <div class="container col-md-12 col-sm-offset-3">

                    <div class="form-group col-md-6">
                        <label>Department</label>
                        <input type="text" name="deptname" class="form-control" placeholder="Department">
                    </div>



                </div>

                <div class="container col-md-12 col-sm-offset-3">

                    <div class="form-group col-md-6">
                        <label>Date of Request</label>
                        <input type="date" name="datereq" id="txtDate" class="form-control" placeholder="Last Name...">
                    </div>

                </div>

                <div class="container col-md-12 col-sm-offset-3">

                    <div class="form-group col-md-3">
                        <label>MITS</label>
                        <input type="text" name="mits" id="mits" class="form-control" placeholder="MITS... " >
                    </div>


                    <div class="form-group col-md-3">
                        <label>MRS</label>
                        <input type="text" name="mrs" class="form-control" placeholder="MRS">
                    </div>


                </div>

                <div class="container col-md-12 col-sm-offset-3">

                    <div class="form-group col-md-6">
                        <label>Item Name </label>
                        <input type="text" name="product" class="form-control" placeholder="Item Name..." id="tags">

                    </div>


                </div>

                <div class="container col-md-12 col-sm-offset-3">

                    <div class="form-group col-md-6">
                        <label>Item Particulars </label>
                        <input type="text" class="form-control" disabled id="parti">
                        <input type="text" name="parti" id="parti2" class="hidden">
                        <input type="text" name="prodid" id="prodid" class="hidden">
                    </div>

                </div>

                <div class="container col-md-12 col-sm-offset-3">

                    @if ($uom == null)

                    <div class="form-group col-md-3">
                        <label>Unit of Measure</label>
                        <input type="text" name="uom" id="uomnull" class="form-control" placeholder="Unit Of Measure" required>
                    </div>

                    @else

                    <div class="form-group col-md-3">
                        <label>Unit of Measure</label>
                        <select class="form-control" id="uomselect" name="uom">
                        @foreach($uom as $unit)

                            <option value="{{ $unit -> OUM}}"> {{ $unit -> OUM }} </option>

                        @endforeach
                    </select>

                        <input type="text" id="uomtext" name="uom" class="form-control" placeholder="Unit Of Measure">

                        <input type="checkbox" id="check">&nbsp;Note:
                        <font color="red"> Please check this if unit of measure is not the selection. </font>
                    </div>







                    @endif


                    <div class="form-group col-md-3">
                        <label>Quantity</label>
                        <input type="text" name="quantity" id="quantity" class="form-control" placeholder="Quantity">
                    </div>


                </div>

                <div class="container col-md-12 col-sm-offset-3">

                    <div class="form-group col-md-6">
                        <label>Product Code </label>
                        <input type="text" name="prodcode" id="prodcode" class="form-control">
                    </div>

                </div>

                <div class="container col-md-12 col-sm-offset-3">

                    <div class="form-group col-md-6">
                        <label>Remarks </label>
                        <textarea class="form-control" name="remarks" id="remarks" style="resize: none;"></textarea>
                    </div>

                </div>

                <div class="container col-md-12 col-sm-offset-6">
                    <div class="form-group col-md-6">

                        <button type="submit" class="btn btn-md btn-success">Proceed to Adding</button> &nbsp;
                        <button type="button" class="btn btn-md btn-danger">Clear</button>

                    </div>
                </div>
                <input type="text" value="{{ $validate }}" id="validate" class="hidden">
							
                {{ csrf_field() }}

            </form>

        </div>

    </div>
</div>

</div>

@endsection @section('scripts')

<script type="text/javascript">
    $(function() {

        $("#uomtext").hide();

        $("#tags").autocomplete({
            source: 'http://localhost:8000/MITS/MITSSearch',
            minLength: 1,
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

        $('#MITSForm').validate({
            rules: {
                firstname: {
                    required: true,
                },
                lastname: {
                    required: true,
                },
                deptname: {
                    required: true,
                },
                datereq: {
                    required: true,
                },
                mits: {
                    required: true,
                },
                product: {
                    required: true,
                },
                uomnull: {
                    required: true,
                },
                uomselect: {
                    required: true,
                },
                uomtext: {
                    required: true,
                },
                quantity: {
                    required: true,
                }


            },
            messages: {
                firstname: {
                    required: "Please input the First Name",
                },
                lastname: {
                    required: "Please input the Last Name",
                },
                deptname: {
                    required: "Please input the Department",
                },
                datereq: {
                    required: "Please input the Date",
                },
                mits: {
                    required: "Please input the MITS #",
                },
                product: {
                    required: "Please input the Item",
                },
                uomnull: {
                    required: "Please input the Unit of Measure",
                },
                uomselect: {
                    required: "Please select the Unit of Measure",
                },
                uomtext: {
                    required: "Please input the Unit of Measure",
                },
                quantity: {
                    required: "Please input the Quantity",
                },


            }
        });

        $('#check').click(function() {
            if ($("#check").is(':checked')) {
                $('#uomselect').hide();
                $('#uomselect').prop("disabled", true);
                $('#uomtext').prop("disabled", false);
                $('#uomtext').show();
            } else {

                
                $('#uomselect').prop("disabled", false);
                $('#uomtext').prop("disabled", true);
                
                $('#uomtext').hide();
                $('#uomselect').show();

            }
        });

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
        
         $("#mits").keydown(function (e) {
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
        
        var valid = $('#validate').val();
		 
        
        if (valid == 1){
		 	swal("MITS Duplicate!!", "Please check if the MITS # is Wrong / Duplicate ","error");
		 }
		 else if (valid == 2){
		 		swal("MITS Added!!", "Sucessfully Added","success");
		 }
    

    }); // end of jquery script

</script>

@endsection
