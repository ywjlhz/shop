<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

        <title>相册列表</title>

        <link href="/Public/Admin/css/mine.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <style>
            .tr_color{background-color: #9F88FF}
        </style>
        <div class="div_head">
            <span>
                <span style="float: left;">当前位置是：相册管理-》<?php echo ($data["goods_name"]); ?>的相册列表</span>
              
            </span>
        </div>
        <div></div>
        
        <div style="font-size: 13px; margin: 10px 5px;">
            <table class="table_a" border="1" width="100%">
                <tbody><tr style="font-weight: bold;">
                        <td>序号</td>
                        <td>大图</td>
                        <td>缩略图</td>
                        <td align="center">操作</td>
                    </tr>
                <?php if(is_array($datas)): foreach($datas as $key=>$d): ?><tr >
                        <td><?php echo ($d["id"]); ?></td>
                        <td><img src="/Public/Upload/goods/<?php echo ($d["big_img"]); ?>" height="60" width="60"></td>
                        <td><img src="/Public/Upload/goods/<?php echo ($d["thumb_img"]); ?>" height="40" width="40"></td>
                        <td><a href="javascript:void(0);" class="del" data-id="<?php echo ($d["id"]); ?>">删除</a></td>
                    </tr><?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
         <form action="<?php echo U('goods/photosadd');?>" method="post" enctype="multipart/form-data" >
         <div style="font-size: 13px; margin: 10px 5px;">
            <table class="table_a" border="1" width="100%">
                <input type="hidden" value="<?php echo ($data["id"]); ?>" name="goods_id">
                    <tr style="font-weight: bold;">
                        <td>选择图片<a href="javascript:void(0);" id='add'>[+]</a></td>
                       
                    </tr>
                  <tbody id="img_files">
                    <tr>
                        <td><input type="file" name='image[]'/></td>
                    </tr>
                </tbody>

            </table>
             <input type="submit" value="确认保存">
         </div>
         </form>
    </body>
    <script src="/Public/Admin/js/jquery-1.7.2.js"></script>
    <script>
        $('#add').live('click',function () {
            $('#img_files').append('<tr><td><a href="javascript:void(0)" class="file_del">[-]</a><input type="file" name="image[]"/></td></tr>')
        })
        $('.file_del').live('click',function () {
            $(this).parents('tr').remove();
        })

        $('.del').click(function () {
            var id = $(this).attr('data-id');
            var _this = $(this);
            $.get('/index.php/Admin/Goods/photosdel',{'id':id},function (datas) {
                if(datas['status']==0) {
                    _this.parents('tr').remove();
                }else {
                    alert(datas['msg']);
                }
            },'json')
        })
    </script>
</html>