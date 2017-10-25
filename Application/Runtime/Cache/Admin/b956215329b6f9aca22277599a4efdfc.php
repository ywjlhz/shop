<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

        <title>权限菜单列表</title>

        <link href="/Public/Admin/css/mine.css" type="text/css" rel="stylesheet" />
        <script src="/Public/Admin/js/jquery-1.7.2.js" type="text/javascript"></script>
        <style type="text/css">
            a {
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <style>
            .tr_color{background-color: #9F88FF}
        </style>
        <div class="div_head">
            <span>
                <span style="float: left;">当前位置是：系统管理-》菜单列表</span>
                <span style="float: right; margin-right: 8px; font-weight: bold;">
                    <a style="text-decoration: none;" href="<?php echo U('add');?>">【添加菜单】</a>
                </span>
            </span>
        </div>
        <div></div>
        
        <div style="font-size: 13px; margin: 10px 5px;">
            <table class="table_a" border="1" width="100%">
                <tbody><tr style="font-weight: bold;">
                        <td>序号</td>
                        <td>菜单名称</td>
                         <td>控制器名</td>
                          <td>方法名称</td>
                      
                        <td>是否显示</td>

                        <td align="center" colspan="2">操作</td>
                    </tr>
        <?php if(is_array($datas)): foreach($datas as $key=>$d): ?><tr >
                        <td><?php echo ($d["id"]); ?></td>
                        <td><a href="#"><?php echo (str_repeat('&nbsp;',$d["level"]*8)); echo ($d["menu_name"]); ?></a></td>
                        <td><?php echo ($d["menu_controller"]); ?></td>
                         <td><?php echo ($d["menu_action"]); ?></td>
                        <td><?php echo (getMenustatus($d["is_show"])); ?></td>
                        <td><a href="<?php echo U('edit','id='.$d['id']);?>">修改</a></td>
                        <td><a class="del" href="javascript:void(0);" data-id="<?php echo ($d["id"]); ?>"> 删除</a></td>
                    </tr><?php endforeach; endif; ?>  
                   
                   
                   
                </tbody>
            </table>
        </div>
    </body>
    <script src="/Public/Admin/js/jquery-1.7.2.js"></script>
    <script type="text/javascript">
        $('.del').click(function () {
            var _this = $(this);
            var id = $(this).attr('data-id');
            $.get('<?php echo U("menu/menuyz");?>',{'id':id},function (data) {
                if(data['status']==0) {
                    alert(data['msg']);
                }else {
                    if(confirm(data['msg'])==true) {
                        $.get('<?php echo U("menu/del");?>',{'id':id},function (data) {
                            alert(data['msg']);
                            if(data['status']==0) {
                                _this.parents('tr').remove();
                            }
                        },'json')
                    }else {
                        $.get('<?php echo U("menu/del");?>',{'id':0},function (data) {

                        },'json')
                    }
                }
            },'json');
        })
    </script>
</html>