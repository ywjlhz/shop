<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>修改商品</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <link href="/Public/Admin/css/mine.css" type="text/css" rel="stylesheet">
    </head>

    <body>

        <div class="div_head">
            <span>
                <span style="float:left">当前位置是：个人管理-》修改口令</span>
                <span style="float:right;margin-right: 8px;font-weight: bold">
                    <a style="text-decoration: none" href="" onclick="fn()">【返回】</a>
                </span>
                <script>
                    function fn() {
                        window.history.go(-1);
                    }
                </script>
            </span>
        </div>
        <div></div>

        <div style="font-size: 13px;margin: 10px 5px">
            <form action="<?php echo U('admin/edit');?>" method="post" enctype="multipart/form-data" target="_top">
            <table border="1" width="100%" class="table_a">
                <input type="hidden" name="admin_id" value='<?php echo ($_SESSION['login_info']['id']); ?>'>
                <tr>
                    <td>原密码</td>
                    <td><input type="password" name="admin_oldpwd" /><span></span></td>
                </tr>
                <tr>
                    <td>新密码</td>
                    <td><input type="password" name="admin_newpwd" /></td>
                </tr>
                <tr>
                    <td>重复密码</td>
                    <td><input type="password" name="admin_repeatpwd" /><span></span></td>
                </tr>

                <tr>
                    <td colspan="2" align="center">
                        <input type="button" value="修改" id="btn">
                    </td>
                </tr>  
            </table>
            </form>
        </div>
    </body>
    <script src="/Public/Admin/js/jquery-1.7.2.js"></script>
    <script>
        var pd = 1;
        var pd2 = 1;
        $('input[name=admin_oldpwd]').blur(function () {
            var data = {
                'id':$('input[name=admin_id]').val(),
                'oldpwd':$('input[name=admin_oldpwd]').val()
            }
            $.post("<?php echo U('admin/yzpwd');?>",data,function (datas) {
            $('input[name=admin_oldpwd]+span').html('');
            $('input[name=admin_oldpwd]+span').html(datas['msg']);
                pd=datas['status'];
            },'json')
        })
        $('input[name=admin_repeatpwd]').keyup(function () {
            if($('input[name=admin_newpwd]').val()!=$('input[name=admin_repeatpwd]').val()) {
                $('input[name=admin_repeatpwd]+span').html('');
                $('input[name=admin_repeatpwd]+span').html('<font color="red">两次输入的密码不一致</font>');
            }else {
                $('input[name=admin_repeatpwd]+span').html('');
                $('input[name=admin_repeatpwd]+span').html('<font color="#7cfc00">√</font>');
                pd2=0;
            }
        })
        $('#btn').click(function () {
            if(pd==0 && pd2==0) {
                $('form').submit();
            }
        })
    </script>
</html>