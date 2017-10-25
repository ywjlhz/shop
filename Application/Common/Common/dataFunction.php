<?php
/**
 * Created by PhpStorm.
 * User: Yang
 * Date: 2017/9/18
 * Time: 21:03
 */

//商品上下架
function getGoodsStatus($val)
{
    $arr = array(
        '0'=>'删除',
        '1'=>'<font color="#9acd32">下架</font>',
        '-1'=>'<font color="red">上架</font>'
    );
    return $arr[$val];
}
//角色状态
function getRoleStatus($val)
{
    $arr = array(
        '0'=>'禁用',
        '1'=>'启用'
    );
    return $arr[$val];
}
//权限菜单状态
function getMenuStatus($val)
{
    $arr = array(
        '1'=>'显示',
        '0'=>'不显示'
    );
    return $arr[$val];
}
//属性菜单属性值类型
function getAttrType($val)
{
    $arr = array(
        '1'=>'输入框',
        '2'=>'下拉框'
    );
    return $arr[$val];
}
//属性值录入方式
function getAttrInsertType($val)
{
    $arr = array(
        '1'=>'手动录入',
        '2'=>'选择录入'
    );
    return $arr[$val];
}