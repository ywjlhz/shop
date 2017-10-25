<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

        <title>权限列表</title>

        <link href="/Public/Admin/css/mine.css" type="text/css" rel="stylesheet" />
         <script src="/Public/Admin/js/jquery-1.7.2.js" type="text/javascript"></script>
    </head>
    <body>
        <style>
            .tr_color{background-color: #9F88FF}
        </style>
        <div class="div_head">
            <span>
                <span style="float: left;">当前位置是：角色管理-》权限列表</span>
                <span style="float: right; margin-right: 8px; font-weight: bold;">
                    <a style="text-decoration: none;" href="<?php echo U('role/index');?>">【返回角色管理】</a>
                </span>
            </span>
        </div>
        <div></div>
      
        <div style="font-size: 13px; margin: 10px 5px;">
        <form action="<?php echo U('edit');?>" method="post" name='access'>
            <input type="hidden" value="<?php echo ($role_data["id"]); ?>" name="role_id">
            <table id="menu_list" class="table_a" border="1" width="100%">
                <tbody>
                    <tr>
                         <td>当前角色：</td>
                         <td colspan="5"><?php echo ($role_data["role_name"]); ?></td>
                    </tr>
                    <?php if(is_array($datas)): foreach($datas as $key=>$d): ?><tr>
                            <td>
                                <input data-id="<?php echo ($d["id"]); ?>" class="checkpart" name='menu_id[]' value="<?php echo ($d["id"]); ?>" type="checkbox" <?php if(in_array($d['id'],$access_data)): ?>checked<?php endif; ?>><?php echo ($d["menu_name"]); ?>
                            </td>
                            <td>
                                <?php if(is_array($d['_child'])): foreach($d['_child'] as $key=>$dd): ?><div>
                                        <input data-id=<?php echo ($dd["id"]); ?> class="checkmidpart menu_<?php echo ($d["id"]); ?>" menu="menu_<?php echo ($dd["id"]); ?>" name='menu_id[]' value="<?php echo ($dd["id"]); ?>" <?php if(in_array($dd['id'],$access_data)): ?>checked<?php endif; ?> type="checkbox"/><?php echo ($dd["menu_name"]); ?>
                                        <?php if(is_array($dd['_child'])): foreach($dd['_child'] as $key=>$ddd): ?><input name='menu_id[]'  class="menu_<?php echo ($d["id"]); ?> menu_<?php echo ($dd["id"]); ?>" value="<?php echo ($ddd["id"]); ?>" <?php if(in_array($ddd['id'],$access_data)): ?>checked<?php endif; ?> type="checkbox"/><?php echo ($dd["menu_name"]); endforeach; endif; ?>
                                    </div><?php endforeach; endif; ?>
                            </td>
                        </tr><?php endforeach; endif; ?>
                </tbody>
            </table>
            <table class="table_a" border="1" width="100%">
                <tbody>
                     <tr >
                        <td  style="text-align: center;"><input class="checkall" type="checkbox" /> 全选/反选</td>
                        <td>&nbsp <input type="submit" name="保存"/></td>
                     </tr>
                </tbody>
            </table>
            </form>
        </div>
    </body>
    <script>
        //一级菜单被点击时控制二级菜单和三级菜单改变
        $('.checkpart').click(function () {
            var id = $(this).attr('data-id');
            $('.menu_'+id).attr('checked',$(this).is(':checked'));
        })
        var p=0;
        //二级菜单点击时控制一级和三级菜单改变
        $('.checkmidpart').click(function () {
            var id = $(this).attr('data-id');
            //控制三级
            $('.menu_'+id).attr('checked',$(this).is(':checked'));
            //控制一级
            $(this).parents('tr').children().children().attr('checked',$(this).is(':checked'));
        })
        $('.checkall').click(function () {
            $('#menu_list :checkbox').attr('checked',$(this).is(':checked'));
        })
    </script>
   
</html>