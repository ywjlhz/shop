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
                <span style="float:left">当前位置是：商品管理-》修改商品信息</span>
                <span style="float:right;margin-right: 8px;font-weight: bold">
                    <a style="text-decoration: none" href="<?php echo U('goods/index');?>">【返回】</a>
                </span>
            </span>
        </div>
        <div></div>

        <div style="font-size: 13px;margin: 10px 5px">
            <form action="<?php echo U('goods/edit');?>" method="post" enctype="multipart/form-data">
            <table border="1" width="100%" class="table_a">
                <input type="hidden" name="id" value="<?php echo ($goods_data["id"]); ?>" />
                <tr>
                    <td>商品名称</td>
                    <td><input type="text" name="goods_name" value="<?php echo ($goods_data["goods_name"]); ?>" /></td>
                </tr>
                <tr>
                    <td>商品分类</td>
                    <td>
                        <select name="category_id">
                            <option value="-1">请选择</option>
                            <?php if(is_array($cate_data)): foreach($cate_data as $key=>$c): ?><option <?php if($goods_data['category_id'] == $c['id']): ?>selected<?php endif; ?> value="<?php echo ($c["id"]); ?>"><?php echo (str_repeat('&nbsp;',$c["level"]*4)); echo ($c["category_name"]); ?></option><?php endforeach; endif; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>商品品牌</td>
                    <td>
                        <select name="brand_id">
                            <option>请选择</option>
                            <?php if(is_array($brand_data)): foreach($brand_data as $key=>$b): ?><option <?php if($goods_data['brand_id'] == $b['id']): ?>selected<?php endif; ?> value="<?php echo ($b["id"]); ?>"><?php echo ($b["brand_name"]); ?></option><?php endforeach; endif; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>商品价格</td>
                    <td><input type="text" name="goods_price" value="<?php echo ($goods_data["goods_price"]); ?>" /></td>
                </tr>
                <tr>
                    <td>商品图片</td>
                    <td><input type="file" name="goods_big_img" value="<?php echo ($goods_data["goods_big_img"]); ?>" /></td>
                </tr>
                <tr>
                    <td>商品详细描述</td>
                    <td>
                        <textarea name="goods_description"><?php echo ($goods_data["goods_description"]); ?></textarea>
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" value="修改">
                    </td>
                </tr>  
            </table>
            </form>
        </div>
    </body>
</html>