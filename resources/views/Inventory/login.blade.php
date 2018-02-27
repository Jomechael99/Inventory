<!DOCTYPE html>
<html>

@include('inventory.partials._head')



<body class="" style="background-image: url({{ asset('Picture/UN.jpg')}});">

<div class="content">

  <?php 

      $swall = Session::get('swal');
      Session::remove('swal');

  
  ?>

  <div class="col-md-6 col-off-set-6" style="margin-left: 25%;">
    <div class="panel panel-info"> 
        <div class="panel-heading text-center"> Admin Login
        </div>
          
             <div class="panel-body">
                 
                <form method="post" action="{{ route('LoginAccount') }}">
                 
               <div class="form-group">
                   
                <div class="input-group col-md-8 col-md-offset-2">
                <span class="input-group-addon"><label class="fa fa-user"></label></span>
                <input type="text" class="form-control" placeholder="Username" name="username" required="true">
                
              </div>   
              
              <br>
              
               <div class="form-group">
                   
                <div class="input-group col-md-8 col-md-offset-2">
                <span class="input-group-addon"><label class="fa fa-lock"></label></span>
                <input type="password" class="form-control" name="password" placeholder="Password" required="true">
                
              </div>
              
              <input type="text" value="{{ $swall }}" id="swal" hidden>

              <br>
              
              <button class="btn btn-info col-md-6 col-md-offset-3"> Login </button>   
                 
             </div>
             
             {{ csrf_field() }}
             
             
             </form>
              
    
    </div>
  </div>
   


</div>



@include('inventory.partials._javascript')

<script type="text/javascript">

  $(function(){

    var swally = $('#swal').val();
    
    if(swally == 1){
      swal("Successfully Login", "You are redirecting to another page", "sucesss");
    }
    else if(swally == 2){
      swal("Incorrect Password / Username", "Please input again !!", "error");
    }

  });


</script>

</body>

</html>
