<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>增加商品属性</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <link href="/Public/Admin/css/mine.css" type="text/css" rel="stylesheet">
    </head>

    <body>

        <div class="div_head">
            <span>
                <span style="float:left">当前位置是：商品管理-》添加属性</span>
                <span style="float:right;margin-right: 8px;font-weight: bold">
                    <a style="text-decoration: none" href="<?php echo U('index');?>">【返回】</a>
                </span>
            </span>
        </div>
        <div></div>

        <div style="font-size: 13px;margin: 10px 5px">
            <form action="/index.php/Admin/Attribute/edit/id/2.html" method="post" >
            <table border="1" width="100%" class="table_a">
                <input type="hidden" name='id' value="<?php echo ($data["id"]); ?>">
                <tr>
                    <td>属性名称</td>
                    <td><input type="text" name="attr_name"  value="<?php echo ($data["attr_name"]); ?>"/></td>
                </tr>
                <tr>
                    <td>所属商品类型</td>
                    <td>
                        <select name="cate_id">

                            <option value="0">请选择</option>
                            <?php if(is_array($datas)): foreach($datas as $key=>$d): ?><option value="<?php echo ($d["id"]); ?>" <?php if($data['cate_id'] == $d['id']): ?>selected<?php endif; ?>><?php echo ($d["cate_name"]); ?></option><?php endforeach; endif; ?>
                           
                        </select>
                    </td>
                </tr>
                 <tr>
                    <td>属性值的类型</td>
                    <td>
                        <input type="radio" value="1" name="attr_type" <?php if($data['attr_type'] == 1): ?>checked<?php endif; ?>/>输入框
                        <input type="radio" value="2" name="attr_type" <?php if($data['attr_type'] == 2): ?>checked<?php endif; ?>/>下拉框
                    </td>
                </tr>
                 <tr>
                    <td>属性值录入方式</td>
                    <td>
                        <input type="radio" value="1" name="attr_insert_type" <?php if($data['attr_insert_type'] == 1): ?>checked<?php endif; ?>/>手工录入
                        <input type="radio" value="2" name="attr_insert_type" <?php if($data['attr_insert_type'] == 2): ?>checked<?php endif; ?>/>列表选择
                    </td>
                </tr>
                 <tr>
                    <td>可选值列表</td>
                    <td><textarea name="attr_value" rows="10"><?php echo ($data["attr_value"]); ?></textarea></td>
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