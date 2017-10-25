<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

        <title>分类管理</title>

        <link href="/Public/Admin/css/mine.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <style>
            .tr_color{background-color: #9F88FF}
        </style>
        <div class="div_head">
            <span>
                <span style="float: left;">当前位置是：分类管理-》分类列表</span>
                <span style="float: right; margin-right: 8px; font-weight: bold;">
                    <a style="text-decoration: none;" href="<?php echo U('add');?>">【添加分类】</a>
                </span>
            </span>
        </div>
        <div></div>
      
        <div style="font-size: 13px; margin: 10px 5px;">
            <table class="table_a" border="1" width="100%">
                <tbody><tr style="font-weight: bold;">
                        <td>序号</td>
                        <td>分类名称</td>
                        <td>所属上级分类</td>
                        <td>品牌排序</td>
                        <td align="center" colspan="2">操作</td>
                    </tr>

                    <?php if(is_array($datas)): foreach($datas as $key=>$d): ?><tr id="product1">
                        <td><?php echo ($d["id"]); ?></td>
                        <td><?php echo (str_repeat('&nbsp;',$d["level"]*3)); echo ($d["category_name"]); ?></td>
                        <td><a href="#"><?php echo ($d["pcate_name"]); ?></a></td>
                        <td><?php echo ($d["category_sort"]); ?></td>
                        <td><a href="<?php echo U('edit','id='.$d['id']);?>">修改</a></td>
                        <td class="del"><a href="javascript:void(0);">删除</a></td>
                    </tr><?php endforeach; endif; ?>
                    <tr>
                        <td colspan="20" style="text-align: center;">
                            <?php echo ($paging); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
    <script src="/Public/Admin/js/jquery-1.7.2.js"></script>
    <script>
        $('.del').click(function () {
            var id=$(this).parents('tr').children().first().text();
            var trObj = $(this).parents('tr');
            $.get("/index.php/Admin/Category/del", {'id':id},
                function (data) {
                    if(data==1) {
                        trObj.remove();
                    }else {
                        alert(data);
                    }
                },'text');
        })
    </script>
</html>