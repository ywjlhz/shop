<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>增加分类</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <link href="/Public/Admin/css/mine.css" type="text/css" rel="stylesheet">
    </head>

    <body>

        <div class="div_head">
            <span>
                <span style="float:left">当前位置是：分类管理-》添加分类信息</span>
                <span style="float:right;margin-right: 8px;font-weight: bold">
                    <a style="text-decoration: none" href="<?php echo U('index');?>">【返回】</a>
                </span>
            </span>
        </div>
        <div></div>

        <div style="font-size: 13px;margin: 10px 5px">
            <form action="/index.php/Admin/Category/add.html" method="post" >
            <table border="1" width="100%" class="table_a">
                <tr>
                    <td>分类名称</td>
                    <td><input type="text" name="category_name" /></td>
                </tr>
                 <tr>
                    <td>上级分类</td>
                    <td>
                        <select name="pid">
                            <option value='0' selected="selected">顶级分类</option>
                            <?php if(is_array($datas)): foreach($datas as $key=>$d): ?><option value="<?php echo ($d["id"]); ?>"><?php echo ($d["category_name"]); ?></option><?php endforeach; endif; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>分类排序</td>
                    <td><input type="text" name="category_sort" /></td>
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
</html>