<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

        <title>商品列表</title>

        <link href="/Public/Admin/css/mine.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <style>
                .tr_color{background-color: #9F88FF}
            </style>
        <div id="content">
            <div class="div_head">
            <span>
                <span style="float: left;">当前位置是：商品管理-》商品列表</span>
                <span style="float: right; margin-right: 8px; font-weight: bold;">
                    <a style="text-decoration: none;" href="<?php echo U('goods/add');?>">【添加商品】</a>
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
                        <td>商品名称</td>
                        <td>品牌</td>
                        <td>分类</td>
                        <td>库存</td>
                        <td>价格</td>
                        <td>图片</td>
                        <td>缩略图</td>
                        <td>创建时间</td>
                        <td align="center" colspan="4">操作</td>
                    </tr>
                    <?php if(is_array($datas)): foreach($datas as $key=>$d): ?><tr id="product1">
                            <td><?php echo ($d["id"]); ?></td>
                            <td><a href="<?php echo U('home/goods/detail','id='.$d['id']);?>" target="_blank"><?php echo ($d["goods_name"]); ?></a></td>
                            <td><?php echo ($d["brand_name"]); ?></td>
                            <td><?php echo ($d["category_name"]); ?></td>
                            <td><?php echo ($d["goods_count"]); ?></td>
                            <td><?php echo ($d["goods_price"]); ?></td>
                            <td><img src="/Public/Upload/goods/<?php echo ($d["goods_big_img"]); ?>" height="60" width="60"></td>
                            <td><img src="/Public/Upload/goods/<?php echo ($d["goods_thumb_img"]); ?>" height="40" width="40"></td>
                            <td><?php echo (date('Y-m-d H:i:s',$d["created_time"])); ?></td>
                            <td><a href="<?php echo U('goods/photos','id='.$d['id']);?>">相册管理</a></td>
                            <td><a class="goods_display" data-id="<?php echo ($d["id"]); ?>" href="javascript:void(0);"><?php echo (getGoodsStatus($d["display"])); ?></a></td>
                            <td><a href="<?php echo U('goods/edit','id='.$d['id']);?>">修改</a></td>
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
        </div>
    </body>
    <script src="/Public/Admin/js/jquery-1.7.2.js"></script>
    <script>
        function dateformat(time) {
            var date=new Date(time*1000);
            var y = date.getFullYear();
            var m = date.getMonth()+1>=10?date.getMonth()+1:'0'+(date.getMonth()+1);
            var d = date.getDate()>=10?date.getDate():'0'+date.getDate();
            var H = date.getHours()>=10?date.getHours():'0'+date.getHours();
            var i = date.getMinutes()>=10?date.getMinutes():'0'+date.getMinutes();
            var s = date.getSeconds()>=10?date.getMinutes():'0'+date.getSeconds();
            var datestr = y+'-'+m+'-'+d+' '+H+':'+i+':'+s;
            return datestr;
        }

        function fn(page) {
            $.get('/index.php/Admin/Goods/ajaxindex',{'page':page},function (data) {
                var str ='<tbody><tr style="font-weight: bold;"><td>序号</td><td>商品名称</td><td>品牌</td><td>分类</td><td>库存</td><td>价格</td><td>图片</td><td>缩略图</td><td>创建时间</td><td align="center" colspan="3">操作</td></tr>';
                for(var key in data.datas) {
                    var datetime=(dateformat(data.datas[key].created_time));
                    var param = data.datas[key].id;
                    var display = data.datas[key].display==1?'<font color="#9acd32">下架</font>':'<font color="red">上架</font>';
                    str+='<tr id="product1"><td>'+data.datas[key].id+'</td><td><a href="/index.php/home/goods/detail/id/'+param+'" target="_blank">'+data.datas[key].goods_name+'</a></td><td>'+data.datas[key].brand_name+'</td><td>'+data.datas[key].category_name+'</td><td>'+data.datas[key].goods_count+'</td><td>'+data.datas[key].goods_price+'</td><td><img src="/Public/Upload/goods/'+data.datas[key].goods_big_img+'" height="60" width="60"></td><td><img src="/Public/Upload/goods/'+data.datas[key].goods_thumb_img+'" height="40" width="40"></td> <td>'+datetime+'</td><td><a href="/index.php/Admin/Goods/photos/id/'+data.datas[key].id+'">相册管理</a></td><td><a class="goods_display" data-id="'+data.datas[key].id+'" href="javascript:void(0);">'+display+'</a></td><td><a href="/index.php/Admin/Goods/edit/id/'+data.datas[key].id+'">修改</a></td><td class="del"><a href="javascript:void(0);">删除</a></td></tr>';
                }
                str+='<tr><td colspan="20" style="text-align: center;">'+data.paging+'</td></tr>';
                $('.table_a').html(str);
        },'json');
        }




        $('.goods_display').live('click',function () {
            var id= $(this).attr('data-id');
            _this = $(this);
            $.get('/index.php/Admin/Goods/goodsDisplay',{'id':id},function (data) {
                _this.html(data.msg);
            },'json')
        })
        $('.del').live('click',function () {
            var id=$(this).parents('tr').children().first().text();
            var trObj = $(this).parents('tr');
            $.get("/index.php/Admin/Goods/del", {'id':id},
                function (data) {
                    if(data.status==1) {
                        trObj.remove();
                    }else {
                        alert(data.msg);
                    }
                },'json');
        })

    </script>
</html>