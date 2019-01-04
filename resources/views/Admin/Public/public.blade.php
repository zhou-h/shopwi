<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--><html lang="en"><!--<![endif]-->
<head>
<meta charset="utf-8">

<!-- Viewport Metatag -->
<meta name="viewport" content="width=device-width,initial-scale=1.0">

<!-- Plugin Stylesheets first to ease overrides -->
<link rel="stylesheet" type="text/css" href="/static/public/plugins/colorpicker/colorpicker.css" media="screen">
<link rel="stylesheet" type="text/css" href="/static/public/custom-plugins/wizard/wizard.css" media="screen">

<!-- Required Stylesheets -->
<link rel="stylesheet" type="text/css" href="/static/public/bootstrap/css/bootstrap.min.css" media="screen">
<link rel="stylesheet" type="text/css" href="/static/public/css/fonts/ptsans/stylesheet.css" media="screen">
<link rel="stylesheet" type="text/css" href="/static/public/css/fonts/icomoon/style.css" media="screen">

<link rel="stylesheet" type="text/css" href="/static/public/css/mws-style.css" media="screen">
<link rel="stylesheet" type="text/css" href="/static/public/css/icons/icol16.css" media="screen">
<link rel="stylesheet" type="text/css" href="/static/public/css/icons/icol32.css" media="screen">

<!-- Demo Stylesheet -->
<link rel="stylesheet" type="text/css" href="/static/public/css/demo.css" media="screen">

<!-- jQuery-UI Stylesheet -->
<link rel="stylesheet" type="text/css" href="/static/public/jui/css/jquery.ui.all.css" media="screen">
<link rel="stylesheet" type="text/css" href="/static/public/jui/jquery-ui.custom.css" media="screen">

<!-- Theme Stylesheet -->
<link rel="stylesheet" type="text/css" href="/static/public/css/mws-theme.css" media="screen">
<link rel="stylesheet" type="text/css" href="/static/public/css/themer.css" media="screen">
<link rel="stylesheet" type="text/css" href="/static/public/css/my.css" media="screen">


<title>@yield('title')</title>

</head>

<body>
    <!-- Header -->
    <div id="mws-header" class="clearfix">
    
        <!-- Logo Container -->
        <div id="mws-logo-container">
        
            <!-- Logo Wrapper, images put within this wrapper will always be vertically centered -->
            <div id="mws-logo-wrap">
                <img src="/static/public/images/mws-logo.png" alt="mws admin">
            </div>
        </div>
        
        <!-- User Tools (notifications, logout, profile, change password) -->
        <div id="mws-user-tools" class="clearfix">
        
            <!-- Notifications -->
            <div id="mws-user-notif" class="mws-dropdown-menu">
                <a href="#" data-toggle="dropdown" class="mws-dropdown-trigger"><i class="icon-exclamation-sign"></i></a>
                
                <!-- Unread notification count -->
                <!-- <span class="mws-dropdown-notif">35</span> -->
                
                <!-- Notifications dropdown -->
                <div class="mws-dropdown-box">
                    <div class="mws-dropdown-content">
                        <ul class="mws-notifications">
                            <li class="read">
                                <a href="#">
                                    <span class="message">
                                        Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                    </span>
                                    <span class="time">
                                        January 21, 2012
                                    </span>
                                </a>
                            </li>
                            <li class="read">
                                <a href="#">
                                    <span class="message">
                                        Lorem ipsum dolor sit amet
                                    </span>
                                    <span class="time">
                                        January 21, 2012
                                    </span>
                                </a>
                            </li>
                            <li class="unread">
                                <a href="#">
                                    <span class="message">
                                        Lorem ipsum dolor sit amet
                                    </span>
                                    <span class="time">
                                        January 21, 2012
                                    </span>
                                </a>
                            </li>
                            <li class="unread">
                                <a href="#">
                                    <span class="message">
                                        Lorem ipsum dolor sit amet
                                    </span>
                                    <span class="time">
                                        January 21, 2012
                                    </span>
                                </a>
                            </li>
                        </ul>
                        <div class="mws-dropdown-viewall">
                            <a href="#">View All Notifications</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Messages -->
            <div id="mws-user-message" class="mws-dropdown-menu">
                <a href="#" data-toggle="dropdown" class="mws-dropdown-trigger"><i class="icon-envelope"></i></a>
                
                <!-- Unred messages count -->
                <!-- <span class="mws-dropdown-notif">35</span> -->
                
                <!-- Messages dropdown -->
                <div class="mws-dropdown-box">
                    <div class="mws-dropdown-content">
                        <ul class="mws-messages">
                            <li class="read">
                                <a href="#">
                                    <span class="sender">John Doe</span>
                                    <span class="message">
                                        Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                    </span>
                                    <span class="time">
                                        January 21, 2012
                                    </span>
                                </a>
                            </li>
                            <li class="read">
                                <a href="#">
                                    <span class="sender">John Doe</span>
                                    <span class="message">
                                        Lorem ipsum dolor sit amet
                                    </span>
                                    <span class="time">
                                        January 21, 2012
                                    </span>
                                </a>
                            </li>
                            <li class="unread">
                                <a href="#">
                                    <span class="sender">John Doe</span>
                                    <span class="message">
                                        Lorem ipsum dolor sit amet
                                    </span>
                                    <span class="time">
                                        January 21, 2012
                                    </span>
                                </a>
                            </li>
                            <li class="unread">
                                <a href="#">
                                    <span class="sender">John Doe</span>
                                    <span class="message">
                                        Lorem ipsum dolor sit amet
                                    </span>
                                    <span class="time">
                                        January 21, 2012
                                    </span>
                                </a>
                            </li>
                        </ul>
                        <div class="mws-dropdown-viewall">
                            <a href="#">View All Messages</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- User Information and functions section -->
            <div id="mws-user-info" class="mws-inset">
            
                <!-- User Photo -->
                <div id="mws-user-photo">
                    <img src="/static/public/example/profile.jpg" alt="User Photo">
                </div>
                
                <!-- Username and Functions -->
                <div id="mws-user-functions">
                    <div id="mws-username">
                        {{session('usernames')}}
                    </div>
                    <ul>
                        <li><a href="/admin123/{{session('uid')}}/edit">更改密码</a></li>
                        <li><a href="/adminlogin">退出</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Start Main Wrapper -->
    <div id="mws-wrapper">
    
        <!-- Necessary markup, do not remove -->
        <div id="mws-sidebar-stitch"></div>
        <div id="mws-sidebar-bg"></div>
        
        <!-- Sidebar Wrapper -->
        <div id="mws-sidebar">
        
            <!-- Hidden Nav Collapse Button -->
            <div id="mws-nav-collapse">
                <span></span>
                <span></span>
                <span></span>
            </div>
            
            <!-- Searchbox -->
            <div id="mws-searchbox" class="mws-inset">
                <form action="typography.html">
                    <input type="text" class="mws-search-input" placeholder="Search...">
                    <button type="submit" class="mws-search-submit"><i class="icon-search"></i></button>
                </form>
            </div>
            
            <!-- Main Navigation -->
            <div id="mws-navigation">
                <ul>
                 <li>
                        <a href="#"><i class="icon-user"></i>管理员理管理</a>
                        <ul class="closed">
                            <li><a href="/admins/create">管理员添加</a></li>
                            <li><a href="/admins">管理员列表</a></li>
                            <li><a href="/role/create">添加角色</a></li>
                            <li><a href="/role">角色列表</a></li>
                            <li><a href="/nodeauth/create">添加权限</a></li>
                            <li><a href="/nodeauth">权限列表</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="icon-user"></i>会员管理</a>
                        <ul class="closed">
                            <!-- <li><a href="/user/create">会员添加</a></li> -->
                            <li><a href="/user">会员列表</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="icon-user"></i> 分类管理</a>
                        <ul class="closed">
                            <li><a href="/cate/create">分类添加</a></li>
                            <li><a href="/cate">分类列表</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="icon-th-list"></i> 商品管理</a>
                        <ul class="closed">
                            <li><a href="/goods/create">商品添加</a></li>
                            <li><a href="/goods">商品列表</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="icon-th-list"></i>收藏管理</a>
                        <ul class="closed">
                            <li><a href="/collects">收藏列表</a></li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="#"><i class="icon-user"></i> 订单管理</a>
                        <ul class="closed">
                            <li><a href="/order">订单列表</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="icon-user"></i> 轮播图管理</a>
                        <ul class="closed">
                            <li><a href="/banner/create">轮播图添加</a></li>
                            <li><a href="/banner">轮播图列表</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="icon-user"></i> 友情链接管理</a>
                        <ul class="closed">
                            <li><a href="/link/create">友情链接添加</a></li>
                            <li><a href="/link">友情链接列表</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="icon-user"></i> 公告管理</a>
                        <ul class="closed">
                            <li><a href="/notice/create">公告添加</a></li>
                            <li><a href="/notice">公告列表</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="icon-user"></i> 广告管理</a>
                        <ul class="closed">
                            <li><a href="/advertisement/create">广告添加</a></li>
                            <li><a href="/advertisement">广告列表</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="icon-user"></i> 评论管理</a>
                        <ul class="closed">
                            <li><a href="/judge">评论列表</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="icon-user"></i> 站内信管理</a>
                        <ul class="closed">
                            <li><a href="/letter/create">发站内信</a></li>
                            <li><a href="/letter">站内信列表</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="icon-user"></i>反馈意见</a>
                        <ul class="closed">
                            <li><a href="/adminfeedback">反馈意见列表</a></li>
                        </ul>
                    </li>
                </ul>
            </div>         
        </div>
        
        <!-- Main Container Start -->
        <div id="mws-container" class="clearfix">
                @if(session('success'))
                    <div class="mws-form-message success">
                        {{session('success')}}
                    </div>
                    @endif
                    @if(session('error'))
                    <div class="mws-form-message error">
                        {{session('error')}}
                    </div>
                @endif
                @section('content')
                @show
        </div>
        <!-- Main Container End -->
        
    

    <!-- JavaScript Plugins -->
    <script src="/static/public/js/libs/jquery-1.8.3.min.js"></script>
    <script src="/static/public/js/libs/jquery.mousewheel.min.js"></script>
    <script src="/static/public/js/libs/jquery.placeholder.min.js"></script>
    <script src="/static/public/custom-plugins/fileinput.js"></script>
    
    <!-- jQuery-UI Dependent Scripts -->
    <script src="/static/public/jui/js/jquery-ui-1.9.2.min.js"></script>
    <script src="/static/public/jui/jquery-ui.custom.min.js"></script>
    <script src="/static/public/jui/js/jquery.ui.touch-punch.js"></script>

    <!-- Plugin Scripts -->
    <script src="/static/public/plugins/datatables/jquery.dataTables.min.js"></script>
    <!--[if lt IE 9]>
    <script src="js/libs/excanvas.min.js"></script>
    <![endif]-->
    <script src="/static/public/plugins/flot/jquery.flot.min.js"></script>
    <script src="/static/public/plugins/flot/plugins/jquery.flot.tooltip.min.js"></script>
    <script src="/static/public/plugins/flot/plugins/jquery.flot.pie.min.js"></script>
    <script src="/static/public/plugins/flot/plugins/jquery.flot.stack.min.js"></script>
    <script src="/static/public/plugins/flot/plugins/jquery.flot.resize.min.js"></script>
    <script src="/static/public/plugins/colorpicker/colorpicker-min.js"></script>
    <script src="/static/public/plugins/validate/jquery.validate-min.js"></script>
    <script src="/static/public/custom-plugins/wizard/wizard.min.js"></script>

    <!-- Core Script -->
    <script src="/static/public/bootstrap/js/bootstrap.min.js"></script>
    <script src="/static/public/js/core/mws.js"></script>

    <!-- Themer Script (Remove if not needed) -->
    <script src="/static/public/js/core/themer.js"></script>

    <!-- Demo Scripts (remove if not needed) -->
    <script src="/static/public/js/demo/demo.dashboard.js"></script>

</body>
</html>