@extends('Inventory.main') @section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border text-center">
                    <h3 class="box-title ">MITS Description</h3>
                </div>
                <div class="box-body">
                    <dl class="dl-horizontal" style="margin-left: 30%;">
                        @foreach($dept as $dept)

                        <dt> Employee Name : </dt>
                        <dd> {{ $dept -> Emp_Lname }} , {{ $dept -> Emp_Fname }} </dd>
                        <dt> Department : </dt>
                        <dd> {{ $dept -> Department }} </dd>
                        <dt> Date Of Received : </dt>
                        <dd> {{ Carbon\Carbon::parse($dept -> Date_Of_Received)->format('F j, Y')}} </dd>

                        @endforeach
                    </dl>
                </div>
                <div class="panel panel-default">
                    <!-- /.box-header -->
                    <div class="panel-body">
                        <div class="table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th width="8%">MITS</th>
                                    <th width="8%">MRS</th>
                                    <th width="12%">UOM</th>
                                    <th width="7%">QTY</th>
                                    <th>Product Code</th>
                                    <th>Remarks</th>
                                    <th>Item Product</th>
                                    <th>Item Particulars</th>
                                    <th>Actions</th>
                                </tr>

                                <tr>
                                    @foreach($mits as $mits)
                                    <tr>
                                        <td> {{ $mits -> MITS }} </td>
                                        <td> {{ $mits -> MRS }} </td>
                                        <td> {{ $mits -> OUM }} </td>
                                        <td> {{ $mits -> QTY }} </td>
                                        <td> {{ $mits -> Product_Code }} </td>
                                        <td> {{ $mits -> Remarks }} </td>
                                        <td> {{ $mits -> ProductName }} </td>
                                        <td>

                                            @if( $mits -> Particular = 1) Furniture @elseif( $mits -> Particular = 2) Telecom @elseif( $mits -> Particular = 3) Computer Equipment @elseif( $mits -> Particular = 4) Office Equipment @elseif( $mits -> Particular = 5) Appliances @elseif( $mits -> Particular = 6) Electrical Equipment @elseif( $mits -> Particular = 7) Office Supplies @endif

                                        </td>
                                        <td class="text-center"> <a class="btn btn-warning btn-xs"> <span class="fa fa-times"> Remove </span> </a></td>
                                    </tr>
                                    @endforeach

                                   
                                        <td class="form-group"> <input type="text" class="form-control"></td>
                                        <td class="form-group"> <input type="text" class="form-control"></td>
                                        <td class="form-group">
                                            <select class="form-control" style="height: 46px;">
                                        <option value="1"> Hello
                                            
                                        </option>
                                    </select>
                                        </td>
                                        <td class="form-group"> <input type="text" class="form-control"></td>
                                        <td class="form-group"> <textarea class="form-control" style="height: 46px;"></textarea></td>
                                        <td class="form-group"> <textarea class="form-control" style="height: 46px;"></textarea></td>
                                        <td class="form-group"> <input type="text" class="form-control"></td>
                                        <td class="form-group"> <input type="text" class="form-control"></td>
                                        <td> <button class="btn btn-info btn-xs" id="adddata" style="width: 65px; margin-top: 10px;"> <span class="fa fa-plus"> Insert </span>  </button></td>

                                </tr>


                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</div>

@endsection @section('scripts') @endsection
