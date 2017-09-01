<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>报名</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        .sign{
            width: 700px;
            height: 110px;
            line-height: 110px;
            font-size: 40px;
        }
        .form_input{
            height: 110px;
            border-radius: 20px;
            margin: 80px auto;
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
        .alert{
            width: 100%;
            height: 110px;
            font-size: 40px;
            position: fixed;
            top: 200px;
            display: none;
            z-index: 10000;
            text-align: center;
            border-radius: 20px;
        }
    </style>
</head>
<body>
<div id='myAlert' class='alert'>
    <span id="info-text" style="display: block; margin-top: 10px"></span>
</div>
<form role="form" style="margin-top: 500px;">
    <div class="form-group">
        <input type="text" class="form-control form_input sign" id="name" name="name"
               placeholder="请输入姓名">

    </div>
    <div class="form-group">
        <input type="text" class="form-control form_input sign" id="num" name="num"
               placeholder="请输入电话号码">
    </div>

</form>
<button type="button" class="form_submit" onclick="prof()">提交</button>

<script>
    function prof() {
        var name = document.getElementById('name').value.trim();
        var num = document.getElementById('num').value.trim();
        var personreg=new RegExp("[\u4e00-\u9fa5a-zA-Z]");
        if(!(personreg.test(name))){
            tipinfo("名字不合法！","warning");
        }else if(!(/^1(3|4|5|7|8)\d{9}$/.test(num))&&!(/^0\d{2,3}-?\d{7,8}$/.test(num))){
            tipinfo("电话号码不合法！","warning") ;
        }else {
            submit(name,num);
        }
    }
    function tipinfo(info,type) {
        $('#info-text').html('<strong>'+info+'</strong>');
        $('#myAlert').attr('class','alert alert-'+type);
        $('#myAlert').fadeIn();
        $('#myAlert').fadeOut(2000);
    }
    function submit(name,num) {
        var tip=""
        $.post('/sign',{'_token':'{{csrf_token()}}',
            'name': name,
            'num':num
        },function (data) {
            data = JSON.parse(data);
            if(data.code==0){
                tipinfo("提交成功！","success");
            }else {
                tipinfo(data.msg);
            }
        })
    }
</script>
</body>
</html>
