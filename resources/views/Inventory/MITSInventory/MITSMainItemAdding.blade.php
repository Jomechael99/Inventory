@extends('Inventory.main')


@section('content')

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

    <div class="panel panel-primary">
       <div class="panel-heading text-center"> Item Transaction </div>
        <div class="panel-body">
            <form method="post" action="{{ route('MITSAddProduct', ['id' => $id] ) }}">
             <table id="example2" class="table table-bordered table-hover" style="border: 10px;">
                                                    
            <thead>
                <tr>
                   <th width="10%"><label>MITS</label></th>
                    <th width="15%"><label>Unit of Measure</label></th>
                    <th width="10%"><label>Quantity</label></th>
                    <th><label>Product Code</label></th>
                    <th><label>Product Serial</label></th>
                    <th><label>Remarks / Description </label></th>
                    <th width="5%">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr class="text-center">
                   <td>{{ $id }}</td>
                    <td><input class="form-control" name="uom[]" type="text" placeholder="Unit of Measure" list="uom" required autocomplete="off" />
                        <datalist id="uom">
                           
                           @foreach($uom as $uom)
                           
                           <option value="{{ $uom -> OUM }}">  </option>
                           
                           @endforeach
                            
                        </datalist>
                    </td>
                    <td><input class="form-control" name="quantity[]" type="number" placeholder="Qty" required min="0"/></td>
                    <td><input class="form-control" name="product[]" id="datalist"  list="product" placeholder="Product Code" required  autocomplete="off" />
                        <datalist id="product">
                            
                            @foreach($product as $prod)
                            
                            <option value="{{ $prod -> ProductNo }}" > {{ $prod -> ProductName  }} </option>
                        
                            
                            @endforeach
                        </datalist>
                    
                    </td>
                     <td><input class="form-control" name="productcode[]" type="text" placeholder="Product Serial" /></td>
                    <td><input class="form-control" name="remarks[]" type="text" placeholder="Remarks" /></td>
                    <td>
                        <button class="btn btn-danger btn-remove form-control" type="button">
                            <i class="glyphicon glyphicon-minus gs"> Remove</i>
                        </button>
                        <button class="btn btn-success btn-add form-control" type="button">
                           <i class="glyphicon glyphicon-plus gs"></i> 
                           <b> Add</b>
                        </button>

                    </td>
                </tr>
            </tbody>
            

        </table>
        {{ csrf_field() }}
        <button class="btn btn-info btn-md" type="submit"> Submit the Items </button>
        </form>

        
        </div>
    </div>

</div>


@endsection


@section('scripts')

    <script>
        
            $(document).ready(function() {
    //Disable the Remove Button
    var rowCount = $('table >tbody:last >tr').length;
    if(rowCount == 1) {
        document.getElementsByClassName('btn-remove')[0].disabled = true;
    }
    
    $(document).on('click', '.btn-add', function(e) {
        e.preventDefault();
        
        var controlForm = $('table');
        var currentEntry = $('table>tbody>tr:last');
        var newEntry = $(currentEntry.clone()).appendTo(controlForm);
        newEntry.find('input').val('');                                         //Remove the Data - as it is cloned from the above
        
        //Add the button  
        var rowCount = $('table >tbody:last >tr').length;
        if(rowCount > 1) {
            var removeButtons = document.getElementsByClassName('btn-remove');
            for(var i = 0; i < removeButtons.length; i++) {
                removeButtons.item(i).disabled = false;
            }
        }
        
        
           
         
    }).on('click', '.btn-remove', function(e) {
        $(this).parents('tr:first').remove();
        
        //Disable the Remove Button
        var rowCount = $('table >tbody:last >tr').length;
        if(rowCount == 1) {
            document.getElementsByClassName('btn-remove')[0].disabled = true;
        }

        e.preventDefault();
        return false;
    });
            
         $('#datalist').change(function(){
            
             var asd = $('#datalist').val();
             
            
             
             
         });         
                
            
        });

    </script>

@endsection