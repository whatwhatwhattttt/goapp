
<!DOCTYPE html>
<html>
<head>
</head>
<body class="hold-transition login-page">
<div class="login-box">

    <div class="login-box-body">
        <p class="login-box-msg">登陆</p>

        <form action="/admin/login" method="post">
            {{ csrf_field() }}
            <div class="form-group has-feedback">
                <input name="username" type="text" class="form-control" placeholder="名字">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input name="password" type="password" class="form-control" placeholder="密码">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">登陆</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->



</body>
</html>
