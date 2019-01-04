<html lang="en"><!--<![endif]--><head>
<meta charset="utf-8">

<!-- Viewport Metatag -->
<meta name="viewport" content="width=device-width,initial-scale=1.0">

<!-- Required Stylesheets -->
<link rel="stylesheet" type="text/css" href="/static/public/bootstrap/css/bootstrap.min.css" media="screen">
<link rel="stylesheet" type="text/css" href="/static/public/css/fonts/ptsans/stylesheet.css" media="screen">
<link rel="stylesheet" type="text/css" href="/static/public/css/fonts/icomoon/style.css" media="screen">

<link rel="stylesheet" type="text/css" href="/static/public/css/login.css" media="screen">

<link rel="stylesheet" type="text/css" href="/static/public/css/mws-theme.css" media="screen">

<title>MWS Admin - Login Page</title>

</head>

<body>

    <div id="mws-login-wrapper">
        <div id="mws-login">
            <h1>登录后台</h1>
            <div class="mws-login-lock"><i class="icon-lock"></i></div>
            <div id="mws-login-form">
                <form class="mws-form" action="/adminlogin" method="post" novalidate="novalidate">
                @if(session('error'))
                    <div class="mws-form-message warning">
                      {{session('error')}}
                    </div>
                @endif
                    <div class="mws-form-row">
                        <div class="mws-form-item">
                            <input type="text" name="username" class="mws-login-username required" placeholder="管理员" value="{{old('username')}}">
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <div class="mws-form-item">
                            <input type="password" name="password" class="mws-login-password required" placeholder="密码">
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <input type="submit" value="登录" class="btn btn-success mws-login-button">
                    </div>
                    {{csrf_field()}}
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript Plugins -->
    <script src="/static/public/js/libs/jquery-1.8.3.min.js"></script>
    <script src="/static/public/js/libs/jquery.placeholder.min.js"></script>
    <script src="/static/public/custom-plugins/fileinput.js"></script>
    
    <!-- jQuery-UI Dependent Scripts -->
    <script src="/static/public/jui/js/jquery-ui-effects.min.js"></script>

    <!-- Plugin Scripts -->
    <script src="/static/public/plugins/validate/jquery.validate-min.js"></script>

    <!-- Login Script -->
    <script src="/static/public/js/core/login.js"></script>



</body></html>