<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="Generator" content="YONGDA v1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="Keywords" content="YONGDA商城" />
    <meta name="Description" content="YONGDA商城" />

    <title>YONGDA商城 - Powered by YongDa</title>

    <link href="/Public/Home/css/style.css" rel="stylesheet" type="text/css" />

</head>
<body class="index_body">
<div class="block clearfix" style="position: relative; height: 98px;">
    <a href="#" name="top"><img class="logo" src="/Public/Home/images/logo.gif"></a>
    <div id="topNav" class="clearfix">
        <?php if(session('?uid')): ?><div style="float: left;">
                <font id="ECS_MEMBERZONE">
                    <div id="append_parent"></div>
                    <font class="f4_b"><?php echo (session('username')); ?></font>，欢迎您回来！
                    <a href="<?php echo U('login/login');?>"> 用户中心</a>
                    <a href="<?php echo U('login/logout');?>">退出</a>
                </font>
            </div>
        <?php else: ?>
        <div style="float: left;">
            <font id="ECS_MEMBERZONE">
                <div id="append_parent"></div>
                欢迎光临本店
                <a href="<?php echo U('login/login');?>"> 登录</a>
                <a href="<?php echo U('login/reg');?>">注册</a>
            </font>
        </div><?php endif; ?>
        <div style="float: right;">
            <a href="<?php echo U('cart/index');?>">查看购物车</a>
            |
            <a href="#">选购中心</a>
            |
            <a href="#">标签云</a>
            |
            <a href="#">报价单</a>
        </div>
    </div>
    <div id="mainNav" class="clearfix">
        <a href="<?php echo U('index/index');?>" class="cur">首页<span></span></a>
        <?php if(is_array($header_category_datas)): foreach($header_category_datas as $key=>$d): ?><a href="<?php echo U('goods/showlist','id='.$d['id']);?>"><?php echo ($d["category_name"]); ?><span></span></a><?php endforeach; endif; ?>
        <a href="#">优惠活动<span></span></a>
        <a href="#">留言板<span></span></a>
    </div>
    <script src="/Public/Home/js/jquery-1.7.2.js"></script>
    <script>
        $('#mainNav')
    </script>
</div>

<div class="header_bg">
    <div style="float: left; font-size: 14px; color:white; padding-left: 15px;">
    </div>

    <form id="searchForm" method="get" action="#">
        <input name="keywords" id="keyword" type="text" />
        <input name="imageField" value=" " class="go" style="cursor: pointer; background: url('/Public/Home/images/sousuo.gif') no-repeat scroll 0% 0% transparent; width: 39px; height: 20px; border: medium none; float: left; margin-right: 15px; vertical-align: middle;" type="submit" />

    </form>
</div>
<div class="blank5"></div>
<div class="header_bg_b">
    <div class="f_l" style="padding-left: 10px;">
        <img src="/Public/Home/images/biao6.gif" />
        北京市区，现在下单(截至次日00:30已出库)，<b>明天上午(9-14点)</b>送达 <b>免运费火热进行中！</b>
    </div>
    <div class="f_r" style="padding-right: 10px;">
        <img style="vertical-align: middle;" src="/Public/Home/images/biao3.gif">
        <span class="cart" id="ECS_CARTINFO">
                        <a href="#" title="查看购物车">您的购物车中有 0 件商品，总计金额 ￥0.00元。</a></span>
        <a href="#"><img style="vertical-align: middle;" src="/Public/Home/images/biao7.gif"></a>

    </div>
</div>

		
        <div class="block box">
            <div class="blank"></div>
            <div id="ur_here">
                当前位置: <a href="#">首页</a> <code>&gt;</code> <a href="#"><?php if(is_array($datas)): $i = 0; $__LIST__ = array_slice($datas,1,1,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; echo ($vo["category_name"]); endforeach; endif; else: echo "" ;endif; ?>类型</a>
            </div>
        </div>
        <div class="blank"></div>

        <div class="block box">

        <div class="block clearfix">
            <div class="AreaL">
                <h3><span>商品分类</span></h3> 
                <div id="category_tree" class="box_1">
                    <?php if(is_array($header_category_datas)): foreach($header_category_datas as $key=>$d): ?><dl>
                        <dt><a href="<?php echo U('goods/showlist','id='.$d['id']);?>"><?php echo ($d['category_name']); ?></a></dt>
                        <dd>       </dd>
                    </dl><?php endforeach; endif; ?>
                </div>
                <div class="blank"></div><div style="display: block;" class="box" id="history_div">
                    <h3><span>浏览历史</span></h3>
                    <div class="box_1">

                        <div class="boxCenterList clearfix" id="history_list">
                            <ul class="clearfix">
                                <li class="goodsimg">
                                    <a href="#" target="_blank">
                                        <img src="/Public/Home/images/8_thumb_G_1241425513488.jpg" alt="飞利浦9@9v" class="B_blue" />
                                    </a>
                                </li>
                                <li>
                                    <a href="#" target="_blank" title="飞利浦9@9v">飞利浦9@9v</a><br />
                                    本店售价：<font class="f1">￥399元</font><br />
                                </li>
                            </ul>
                            <ul class="clearfix">
                                <li class="goodsimg">
                                    <a href="#" target="_blank">
                                        <img src="/Public/Home/images/9_thumb_G_1241511871555.jpg" alt="诺基亚E66" class="B_blue" />
                                    </a>
                                </li>
                                <li>
                                    <a href="#" target="_blank" title="诺基亚E66">诺基亚E66</a><br />
                                    本店售价：<font class="f1">￥2298元</font><br />
                                </li>
                            </ul>
                            <ul id="clear_history">
                                <a onclick="clear_history()">[清空]</a>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="blank5"></div>
            </div>


            <div class="AreaR">

                <div class="box">
                    <div class="box_1">
                        <h3><span>商品筛选</span></h3>
                        <div class="screeBox">
                            <strong>品牌：</strong>
                            <?php if($brand_id == 0): ?><span><a href="<?php echo U('showlist',array('id'=>$category_id));?>" style="color: white">全部</a></span>
                                <?php else: ?>
                                <a href="<?php echo U('showlist',array('id'=>$category_id));?>">全部</a><?php endif; ?>
                            <input type="hidden" name='id' value="<?php echo ($category_id); ?>">
                            <?php if(is_array($brand_datas)): foreach($brand_datas as $key=>$d): if($d[id] == $brand_id): ?><span><a href="<?php echo U('showlist',array('brand_id'=>$d['id'],'id'=>$category_id));?>" style="color: white"><?php echo ($d["brand_name"]); ?></a></span>
                                    <?php else: ?>
                                    <a href="<?php echo U('showlist',array('brand_id'=>$d['id'],'id'=>$category_id));?>"><?php echo ($d["brand_name"]); ?></a>&nbsp;<?php endif; endforeach; endif; ?>
                        </div>
                        <div class="screeBox">
                            <strong>价格：</strong>
                            <span>全部</span>
                            <a href="#">200&nbsp;-&nbsp;1700</a>&nbsp;
                            <a href="#">1700&nbsp;-&nbsp;3200</a>&nbsp;
                            <a href="#">4700&nbsp;-&nbsp;6200</a>&nbsp;
                        </div>




                    </div>
                </div>
                <div class="blank"></div>



                <div class="blank"></div>
                <div class="box">
                    <div class="box_1">
                        <h3>
                            <span>商品列表</span>
                            <form method="GET" class="sort" name="listform">
                                显示方式：
                                <a href="#"><img src="/Public/Home/images/display_mode_list.gif" alt=""></a>
                                <a href="#"><img src="/Public/Home/images/display_mode_grid_act.gif" alt=""></a>
                                <a href="#"><img src="/Public/Home/images/display_mode_text.gif" alt=""></a>&nbsp;&nbsp;

                                <a href="#"><img src="/Public/Home/images/goods_id_DESC.gif" alt="按上架时间排序"></a>
                                <a href="#"><img src="/Public/Home/images/shop_price_default.gif" alt="按价格排序"></a>
                                <a href="#"><img src="/Public/Home/images/last_update_default.gif" alt="按更新时间排序"></a>
                                <input name="category" value="3" type="hidden" />
                                <input name="display" value="grid" id="display" type="hidden" />
                                <input name="brand" value="0" type="hidden" />
                                <input name="price_min" value="0" type="hidden" />
                                <input name="price_max" value="0" type="hidden" />
                                <input name="filter_attr" value="0" type="hidden" />
                                <input name="page" value="1" type="hidden" />
                                <input name="sort" value="goods_id" type="hidden" />
                                <input name="order" value="DESC" type="hidden" />
                            </form>
                        </h3>
                        <form name="compareForm" action="compare.php" method="post" onsubmit="return compareGoods(this);">
                            <div class="clearfix goodsBox" style="border: medium none; padding: 11px 0pt 10px 5px;">
                                <?php if(is_array($datas)): foreach($datas as $key=>$d): ?><div class="goodsItem">
                                        <a href="<?php echo U('goods/detail','id='.$d[id]);?>"><img src="/Public/Upload/goods/<?php echo ($d["goods_thumb_img"]); ?>" alt="<?php echo ($d["goods_name"]); ?>" class="goodsimg"></a><br />
                                        <p><a href="<?php echo U('goods/detail','id='.$d[id]);?>" title="<?php echo ($d["goods_name"]); ?>"><?php echo ($d["goods_name"]); ?></a></p>
                                        <font class="market_s">￥<?php echo ($d["goods_price"]); ?>元</font><br />
                                        <font class="shop_s">￥<?php echo ($d["goods_price"]); ?>元</font><br />
                                        <a href="#"><img src="/Public/Home/images/goumai.gif"></a> &nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="#"><img src="/Public/Home/images/shoucang.gif"></a>
                                    </div><?php endforeach; endif; ?>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="blank5"></div>
                <form name="selectPageForm" action="/category.php" method="get">
                    <div id="page" class="page">
                        <?php echo ($paging); ?>
                    </div>
                </form>
            </div>  

        </div>

        </div>
		
		
		
		

        <div class="blank"></div>
        
<div class="block">
    <a href="#" target="_blank" title="YONGDA商城"><img alt="YONGDA商城" src="/Public/Home/images/di.jpg"></a>
    <div class="blank"></div>
</div>
<div class="block">
    <div class="box">
        <div class="helpTitBg" style="clear: both;">
            <dl>
                <dt><a href="#" title="新手上路 ">新手上路 </a></dt>
                <dd><a href="#" title="售后流程">售后流程</a></dd>
                <dd><a href="#" title="购物流程">购物流程</a></dd>
                <dd><a href="#" title="订购方式">订购方式</a></dd>
            </dl>
            <dl>
                <dt><a href="#" title="手机常识 ">手机常识 </a></dt>
                <dd><a href="#" title="如何分辨原装电池">如何分辨原装电池</a></dd>
                <dd><a href="#" title="如何分辨水货手机 ">如何分辨水货手机</a></dd>
                <dd><a href="#" title="如何享受全国联保">如何享受全国联保</a></dd>
            </dl>
            <dl>
                <dt><a href="#" title="配送与支付 ">配送与支付 </a></dt>
                <dd><a href="#" title="货到付款区域">货到付款区域</a></dd>
                <dd><a href="#" title="配送支付智能查询 ">配送支付智能查询</a></dd>
                <dd><a href="#" title="支付方式说明">支付方式说明</a></dd>
            </dl>
            <dl>
                <dt><a href="#" title="会员中心">会员中心</a></dt>
                <dd><a href="#" title="资金管理">资金管理</a></dd>
                <dd><a href="#" title="我的收藏">我的收藏</a></dd>
                <dd><a href="#" title="我的订单">我的订单</a></dd>
            </dl>
            <dl>
                <dt><a href="#" title="服务保证 ">服务保证 </a></dt>
                <dd><a href="#" title="退换货原则">退换货原则</a></dd>
                <dd><a href="#" title="售后服务保证 ">售后服务保证</a></dd>
                <dd><a href="#" title="产品质量保证 ">产品质量保证</a></dd>
            </dl>
            <dl>
                <dt><a href="#" title="联系我们 ">联系我们 </a></dt>
                <dd><a href="#" title="网站故障报告">网站故障报告</a></dd>
                <dd><a href="#" title="选机咨询 ">选机咨询</a></dd>
                <dd><a href="#" title="投诉与建议 ">投诉与建议</a></dd>
            </dl>
        </div>
    </div>


</div>
<div class="blank"></div>
<div id="bottomNav" class="box block">
    <div class="box_1">
        <div class="links clearfix">
            <a href="#" target="_blank" title="YONGDA商城"><img src="/Public/Home/images/logo.gif" alt="YONGDA商城" border="0" /></a>


            <a href="#" target="_blank" title="YONGDA 网上商店管理系统">

            </a>


            [<a href="#" target="_blank" title="免费申请网店">免费申请网店</a>]
            [<a href="#" target="_blank" title="免费开独立网店">免费开独立网店</a>]


            [<a href="#" target="_blank" title="免费开独立网店">yongda商城</a>]
        </div>
    </div>
</div>
<div class="blank"></div>
<div id="bottomNav" class="box block">
    <div class="bNavList clearfix">
        <a href="#">免责条款</a>
        |
        <a href="#">隐私保护</a>
        |
        <a href="#">咨询热点</a>
        |
        <a href="#">联系我们</a>
        |
        <a href="#">Powered&nbsp;by&nbsp;<strong><span style="color: rgb(51, 102, 255);">YongDa</span></strong></a>
        |
        <a href="#">批发方案</a>
        |
        <a href="#">配送方式</a>

    </div>
</div>

<div id="footer">
    <div class="text">
        © 2005-2012 YONGDA 版权所有，并保留所有权利。<br />
    </div>
</div>
</body>
</html>