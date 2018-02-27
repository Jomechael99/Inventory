@extends('Inventory.main')

@section('content')

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

            <button type="button" class="btn btn-success col-md-3 col-sm-offset-9" data-toggle="modal" data-target="#ImportExcel" data-keyboard="true"> Add Non Administrator Accounts </button>
                <div class="modal fade" id="ImportExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-center" id="ItemModal">Add Non Administrator Accounts</h5>
                            </div>
                            <div class="modal-body">

                                {!! Form::open(array('route' => 'postAccounts','method'=>'POST')) !!}

                                <div class="form-group">
                                    <label> Username : </label>
                                    <input type="text" class="form-control" name="username" placeholder="Username" required>
                                    <br>
                                    <label> Password : </label>
                                    <input type="password" class="form-control" id="firstpass" pattern=".{8,12}" required title="8 to 12 characters" name="password1" placeholder="Password" required>
                            
                                    
                                </div>

                                <div class="modal-footer">

                                    <button type="submit" class="btn btn-primary" id="save"> Save changes </button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                </div>

                                {{ csrf_field() }} {!! Form::close() !!}

                            </div>
                        </div>
                    </div>
                </div>
 

   
    <br>
    <br>

    <div class="box">

        <table id="example3" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th width="10%"> Account ID </th>
                    <th > Account Username </th>
                    <th width="20%"> Action </th>
                </tr>
            </thead>

            <tbody class="text-center">
                @foreach($user as $user)   
                <tr>    
                    <td> USER - {{ $user -> id }}</td>
                    <td> {{ $user -> username }} </td>
                    <td> <a class="btn btn-danger btn-sm" href="{{ route('deleteAccounts', ['id' => $user -> id])}}" ><span class="fa fa-times"> Delete Accounts </span> </a> </td>
                </tr>
                @endforeach

            </tbody>

        </table>


    </div>


</div>

@endsection

@section('scripts')

    <script type="text/javascript">

        $(function(){
            $('#example3').DataTable({
            'paging': true,
            'info': true,
            'autoWidth': false
        });

        
        });


    </script>

@endsection