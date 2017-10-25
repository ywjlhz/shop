<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>添加商品</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <link href="/Public/Admin/css/mine.css" type="text/css" rel="stylesheet">
    </head>

    <body>

        <div class="div_head">
            <span>
                <span style="float:left">当前位置是：商品管理-》添加商品信息</span>
                <span style="float:right;margin-right: 8px;font-weight: bold">
                    <a style="text-decoration: none" href="<?php echo U('goods/index');?>">【返回】</a>
                </span>
            </span>
        </div>
        <div></div>

        <div style="font-size: 13px;margin: 10px 5px">
            <form action="<?php echo U('goods/add');?>" method="post" enctype="multipart/form-data">
            <table border="1" width="100%" class="table_a">
                <input type="hidden" name="goods_id" value="<?php echo ($datas["id"]); ?>">
                <tr>
                    <td>商品名称</td>
                    <td><input type="text" name="goods_name" /></td>
                </tr>
                <tr>
                    <td>商品货号</td>
                    <td><input type="text" name="goods_number" /></td>
                </tr>
                <tr>
                    <td>商品分类</td>
                    <td>
                        <select name="category_id">
                            <option value="-1">请选择</option>
                            <?php if(is_array($cate_data)): foreach($cate_data as $key=>$b): ?><option value="<?php echo ($b["id"]); ?>"><?php echo (str_repeat('&nbsp;',$b["level"]*4)); echo ($b["category_name"]); ?></option><?php endforeach; endif; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>商品品牌</td>
                    <td>
                        <select name="brand_id">
                            <option value="-1">请选择</option>
                            <?php if(is_array($brand_data)): foreach($brand_data as $key=>$b): ?><option value="<?php echo ($b["id"]); ?>"><?php echo ($b["brand_name"]); ?></option><?php endforeach; endif; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>商品类型</td>
                    <td>
                        <select name="cate_id" id="cate">
                            <option value="-1">请选择</option>
                            <?php if(is_array($ctype_data)): foreach($ctype_data as $key=>$b): ?><option value="<?php echo ($b["id"]); ?>"><?php echo ($b["cate_name"]); ?></option><?php endforeach; endif; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>商品属性</td>
                    <td>
                        <div id="attribute"></div>
                    </td>
                </tr>
                <tr>
                    <td>商品价格</td>
                    <td><input type="text" name="goods_price" /></td>
                </tr>
                <tr>
                    <td>商品图片</td>
                    <td><input type="file" name="goods_big_img" /></td>
                </tr>
                <tr>
                    <td>商品库存</td>
                    <td><input type="text" name="goods_count" /></td>
                </tr>
                <tr>
                    <td>商品排序</td>
                    <td><input type="text" name="goods_sort" /></td>
                </tr>
                <tr>
                    <td>商品详细描述</td>
                    <td>
                        <textarea name="goods_description"></textarea>
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" value="添加">
                    </td>
                </tr>  
            </table>
            </form>
        </div>
    </body>
    <script src="/Public/Admin/js/jquery-1.7.2.js"></script>
    <script>
        $('#cate').change(function () {
            //获取值
            var cid = $(this).val();
            //发送ajax请求将类型ID传递
            $.get("<?php echo U('Attribute/getAttribute/');?>",{'cate_id':cid},function (data) {
                //获取json对象长度
                var length = data.length;
                var str=''
                //使用字符串拼接
                for(var i=0;i<length;i++) {
                    var option='';
                    if(data[i].attr_type==2) {
                        //如果属性值的类型是2,则拼装一个下拉框
                        //将属性值,转换成数组遍历出来
                        val = data[i].attr_value.split(',');
                        for(var j=0;j<val.length;j++) {
                            option+='<option value="'+val[j]+'">'+val[j]+'</option>';
                        }
                        //组装一个select框
                        str+='<div><div class=""><a class="create_attr" href="javascript:void(0)">[+]</a>'+data[i].attr_name+'：<select name="goods_attr_val['+data[i].id+'][]">'+option+'</select></div></div>';
                    }else {
                        //组装一个input框
                        str+= data[i].attr_name+'<input name="goods_attr_val['+data[i].id+'][]" type="text">';
                    }
                }
                $('#attribute').html(str);
            },'json')
        })

        $('.create_attr').live('click',function () {
            //动态增加点击事件
            //克隆+父级div
            var selectObj = $(this).parent().clone();
            //将[+]移除
            selectObj.find('a').remove();
            //在之前增加[-]
            selectObj.prepend('<a href="javascript:void(0)" class="del_attr">[-]</a>');
            //追加到页面中
            $(this).parent().parent().append(selectObj);
        })
        $('.del_attr').live('click',function () {
            //点击[-],删除此条select
            $(this).parent().remove();
        })
    </script>
</html>