<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>添加后台菜单</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <link href="/Public/Admin/css/mine.css" type="text/css" rel="stylesheet">
        
    </head>

    <body>

        <div class="div_head">
            <span>
                <span style="float:left">当前位置是：系统管理-》添加菜单</span>
                <span style="float:right;margin-right: 8px;font-weight: bold">
                    <a style="text-decoration: none" href="<?php echo U('index');?>">【返回】</a>
                </span>
            </span>
        </div>
        <div></div>

        <div style="font-size: 13px;margin: 10px 5px">
            <form action="" method="post" enctype="multipart/form-data" >
            <table border="1" width="100%" class="table_a">
                <input type="hidden" name="id" value="<?php echo ($datas["id"]); ?>">
                <tr>
                    <td>菜单名称</td>
                    <td><input type="text" name="menu_name" value="<?php echo ($datas["menu_name"]); ?>"/></td>
                </tr>
               
                <tr>
                    <td>菜单级别</td>
                    <td>
                        <select name="pid">

                            <option value="0">顶级菜单</option>
                            <?php if(is_array($data)): foreach($data as $key=>$d): ?><option value="<?php echo ($d["id"]); ?>" <?php if($datas['pid'] == $d['id']): ?>selected<?php endif; ?>><?php echo (str_repeat('&nbsp',$d["level"]*4)); echo ($d["menu_name"]); ?></option><?php endforeach; endif; ?>
                           
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>控制器名称</td>
                    <td><input type="text" name="menu_controller" value="<?php echo ($datas["menu_controller"]); ?>"/></td>
                </tr>
                <tr>
                    <td>方法名称</td>
                    <td><input type="text" name="menu_action" value="<?php echo ($datas["menu_action"]); ?>"/></td>
                </tr>
                 
                <tr>
                    <td>是否显示</td>
                    <td>
                        <input type="radio" value="1" name="is_show" <?php echo ($datas['is_show']==1?'checked':''); ?>>是
                        <input type="radio" value="0" name="is_show" <?php if($datas['is_show'] == 0): ?>checked<?php endif; ?>>否
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