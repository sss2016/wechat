<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>报名</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        .sign{
            width: 700px;
            height: 110px;
            line-height: 110px;
            margin: 80px auto;
            font-size: 40px;
        }
        .form_input{
            height: 110px;
            border-radius: 20px;
        }
        .form_submit{
            color: white;
            display: block;
            width: 700px;
            height: 110px;
            margin: 0 auto;
            font-size: 40px;
            border-radius: 20px;
            background-color: rgb(32, 160, 255);
        }
    </style>
</head>
<body>

<form role="form" style="margin-top: 500px;" action="{{ asset( 'sign' ) }} " method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <div class="col-sm-11">
            <input type="text" class="form-control form_input sign" id="name" name="name"
                   placeholder="请输入姓名">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-11">
            <input type="text" class="form-control form_input sign" id="num" name="num"
                   placeholder="请输入电话号码">
        </div>
    </div>
    <button type="submit" class="btn btn-default form_submit">提交</button>
</form>
</body>
</html>
