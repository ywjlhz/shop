<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

        <title>产品中心</title>

        <link href="/Public/Admin/css/mine.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <style>
            .tr_color{background-color: #9F88FF}
        </style>
        <div class="div_head">
            <span>
                <span style="float: left;">当前位置是：产品中心-》品牌管理</span>
                <span style="float: right; margin-right: 8px; font-weight: bold;">
                    <a style="text-decoration: none;" href="<?php echo U('brand/add');?>">【添加品牌】</a>
                </span>
            </span>
        </div>
        <div></div>
        <div class="div_search">
            <span>
                <form action="#" method="get">
                    品牌<select name="s_product_mark" style="width: 100px;">
                        <option selected="selected" value="0">请选择</option>
                        <option value="1">苹果apple</option>
                    </select>
                    <input value="查询" type="submit" />
                </form>
            </span>
        </div>
        <div style="font-size: 13px; margin: 10px 5px;">
            <table class="table_a" border="1" width="100%">
                <tbody><tr style="font-weight: bold;">
                        <td>序号</td>
                        <td>品牌名称</td>
                        <td>品牌排序</td>
                        <td>创建时间</td>
                        <td>更新时间</td>
                        <td align="center" colspan="2" style="text-align: center">操作</td>
                    </tr>
                <?php if(is_array($datas)): foreach($datas as $key=>$val): ?><tr>
                        <td><?php echo ($val["id"]); ?></td>
                        <td><a href="#"><?php echo ($val["brand_name"]); ?></a></td>
                        <td><?php echo ($val["brand_sort"]); ?></td>
                        <td><?php echo (date('Y-m-d H:i:s',$val["created_time"])); ?></td>
                        <td><?php echo (date('Y-m-d H:i:s',$val["updated_time"])); ?></td>
                        <td><a href="<?php echo U('brand/edit','id='.$val['id']);?>">修改</a></td>
                        <!--<td><a onclick="del(<?php echo ($val[id]); ?>)" href="javascript:void(0)">删除</a></td>-->
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
            $.get("/index.php/Admin/Brand/del", {'id':id},
                    function (data) {
                        if(data==1) {
                            trObj.remove();
                        }else {
                            alert(data);
                        }
                    },'text');
        })
//        function del(id) {
//            if(confirm('是否删除')) {
//                location.href='/index.php/Admin/Brand/del/id/'+id;
//            }
//        }
    </script>
</html>