<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{URL::asset('/assets/bower/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="{{URL::asset('/assets/bower/metisMenu/dist/metisMenu.min.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{URL::asset('/assets/css/sb-admin-2.css')}}" rel="stylesheet">

    @yield('head')
    
    <!-- Custom Fonts -->
    <link href="{{URL::asset('/assets/bower/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <!-- <link href='http://fonts.useso.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'> -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
        <!-- jQuery -->
    <script src="{{URL::asset('/assets/bower/jquery/dist/jquery.min.js')}}"></script>
</head>

<body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <i class="fa fa-navicon"></i>
                </button>
                <a class="navbar-brand" href="{{URL::asset('/')}}">SEMI-GRID</a>
            </div>
            <!-- /.navbar-header -->
            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="#">
                                <div>
                                    <strong>彭赣州</strong>
                                    <span class="pull-right text-muted"><small><em>Yesterday</em></small></span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>彭赣州</strong>
                                    <span class="pull-right text-muted"><small><em>Yesterday</em></small></span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted"><small><em>Yesterday</em></small></span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-tasks fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks">
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>招新页面</strong>
                                        <span class="pull-right text-muted"><small>40% Complete</small></span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only"><small>40% Complete (success)</small></span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Laravel 后台管理框架</strong>
                                        <span class="pull-right text-muted"><small>20% Complete</small></span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                            <span class="sr-only"><small>20% Complete</small></span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Angular.js semi-grid.com</strong>
                                        <span class="pull-right text-muted"><small>60% Complete</small></span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only"><small>60% Complete (warning)</small></span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>网易云音乐Chrome扩展app</strong>
                                        <span class="pull-right text-muted"><small>80% Complete</small></span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            <span class="sr-only"><small>80% Complete (danger)</small></span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Tasks</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-tasks -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> New Comment
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> Message Sent
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i> New Task
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="{{URL::asset('/admin/profile')}}"><i class="fa fa-user fa-fw"></i>{{$user->name}}</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{{URL::asset('/admin/logout')}}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                	<button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="{{URL::asset('/admin')}}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#blog"><i class="fa fa-terminal fa-fw"></i> Blog<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{URL::asset('/admin/blog/articles')}}"><i class="fa fa-file-code-o fa-fw"></i> Articles</a>
                                </li>
                                <li>
                                    <a href="{{URL::asset('/admin/blog/tags')}}"><i class="fa fa-tags fa-fw"></i> Tags</a>
                                </li>
                                <li>
                                    <a href="{{URL::asset('/admin/blog/draft')}}"><i class="fa fa-file-text-o fa-fw"></i> Draft</a>
                                </li>
                                <li>
                                    <a href="{{URL::asset('/admin/blog/trash')}}"><i class="fa fa-trash-o fa-fw"></i> Trash</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#frontend"><i class="fa fa-leaf fa-fw"></i> Front-End UI</a>
                        </li>
                        <li>
                            <a href="{{URL::asset('/admin/blog/createarticle')}}"><i class="fa fa-edit fa-fw"></i> Write Something Now<i class="fa fa-question-circle" style="padding-left: 0.5em" title="Write down what happened today or share some good idea if you have."></i></a>
                        </li>
                        <li>
                            <a href="#resume"><i class="fa fa-at fa-fw"></i> Resume</a>
                        </li>
                        <li>
                            <a href="#work"><i class="fa fa-laptop fa-fw"></i> Work<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{URL::asset('/admin/work/done')}}"><i class="fa fa-star"></i> What have I done<i class="fa fa-question-circle" style="padding-left: 0.5em" title="Show all project I had done."></i></a>
                                </li>
                                <li>
                                    <a href="{{URL::asset('/admin/work/doing')}}"><i class="fa fa-star-half-o"></i> What I'm doing<i class="fa fa-question-circle" style="padding-left: 0.5em" title="Show all project I'm doing."></i></a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <div id="page-wrapper">
            @yield('content')
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- Bootstrap Core JavaScript -->
    <script src="{{URL::asset('/assets/bower/bootstrap/dist/js/bootstrap.js')}}"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{URL::asset('/assets/bower/metisMenu/dist/metisMenu.min.js')}}"></script>
    <!-- Custom Theme JavaScript -->
    <script src="{{URL::asset('/assets/js/sb-admin-2.js')}}"></script>
    @yield('script')
</body>
</html>