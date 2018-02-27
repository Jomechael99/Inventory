<!DOCTYPE html>
<html>

@include('inventory.partials._head')



<body class="">

@include('inventory.partials._nav')

<div class="content">


	@yield('content')


</div>



@include('inventory.partials._javascript')
@yield('scripts')

</body>

</html>
