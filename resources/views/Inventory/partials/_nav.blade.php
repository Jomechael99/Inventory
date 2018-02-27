    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span></button>
                <a class="navbar-brand" href="#"><span>UNAI &nbsp; </span>Admin</a>
                <!--<ul class="nav navbar-top-links navbar-right">

                    <li class="dropdown"><a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <em class="fa fa-envelope"></em><span class="label label-danger">15</span>
                    </a>
                        <ul class="dropdown-menu dropdown-messages">
                            <li>
                                <div class="dropdown-messages-box"><a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="http://placehold.it/40/30a5ff/fff">
                                    </a>
                                    <div class="message-body"><small class="pull-right">3 mins ago</small>
                                        <a href="#"><strong>John Doe</strong> commented on <strong>your photo</strong>.</a>
                                    <br /><small class="text-muted">1:24 pm - 25/03/2015</small></div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="dropdown-messages-box"><a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="http://placehold.it/40/30a5ff/fff">
                                    </a>
                                    <div class="message-body"><small class="pull-right">1 hour ago</small>
                                        <a href="#">New message from <strong>Jane Doe</strong>.</a>
                                    <br /><small class="text-muted">12:27 pm - 25/03/2015</small></div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="all-button"><a href="#">
                                    <em class="fa fa-inbox"></em> <strong>All Messages</strong>
                                </a></div>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <em class="fa fa-bell"></em><span class="label label-info">5</span>
                    </a>
                        <ul class="dropdown-menu dropdown-alerts">
                            <li><a href="#">
                                <div><em class="fa fa-envelope"></em> 1 New Message
                                    <span class="pull-right text-muted small">3 mins ago</span></div>
                            </a></li>
                            <li class="divider"></li>
                            <li><a href="#">
                                <div><em class="fa fa-heart"></em> 12 New Likes
                                    <span class="pull-right text-muted small">4 mins ago</span></div>
                            </a></li>
                            <li class="divider"></li>
                            <li><a href="#">
                                <div><em class="fa fa-user"></em> 5 New Followers
                                    <span class="pull-right text-muted small">4 mins ago</span></div>
                            </a></li>
                        </ul>
                    </li>
                </ul> -->
            </div>
        </div><!-- /.container-fluid -->
    </nav>
    <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
        <div class="profile-sidebar">
            <div class="profile-userpic">
                <img src="{{ asset('Picture/admin.png') }}" class="img-responsive" alt="">
            </div>
            <div class="profile-usertitle">
                <div class="profile-usertitle-name"> {{ Auth::guard('admins')->user()->username }} </div>
                <span> @if(auth::guard('admins')->user()->type == 1)
                            <h5>Administrator</h5>
                       @elseif(auth::guard('admins')->user()->type == 2)
                            <h5>Non Administrator</h5>
                       @endif
                 </span>

            </div>
            <div class="clear"></div>
        </div>
        <div class="divider"></div>
        <ul class="nav menu">
            <li class="{{ (Request::is('MITS/Dashboard') ? 'active' : '')}}"><a href="{{ route('InventoryDashboard') }}"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
            <li class="parent"><a data-toggle="collapse" data-target="#sub-item-1">
                <em class="fa fa-cube">&nbsp;</em> Inventory <span data-toggle="collapse" href="" class="icon pull-right"><em class="fa fa-plus"></em></span>
                </a>
                <ul class="children collapse" id="sub-item-1">
                    <li><a class="{{ (Request::is('MITS/Inventory Items') ? 'active' : '')}}" href="{{ route('InventoryItems') }}">
                        <span class="">&nbsp;</span> Add Product
                    </a></li>

                </ul>
            </li>
            <!--<li class="{{ (Request::is('MITS/MITSForm') ? 'active' : '')}}"><a href="{{ route('MITSForm') }}"><em class="fa fa-wpforms">&nbsp;</em>MITS Form</a></li> -->
            <li class="{{ (Request::is('MITS/MITSMain') ? 'active' : '')}}"><a href="{{ route('MITSFormMain') }}"><em class="fa fa-wpforms">&nbsp;</em>MITS</a></li>
            @if(Auth::guard('admins')->user()->type == 1)
            <li class="{{ (Request::is('MITS/Accounts') ? 'active' : '')}}"><a href="{{ route('getAccounts') }}"><em class="fa fa-users">&nbsp;</em>Accounts</a></li>
            @endif
            <li><a href="{{ route('Logout') }}"><em class="fa fa-power-off">&nbsp;</em>Logout</a></li>
           
        </ul>
    </div><!--/.sidebar-->
