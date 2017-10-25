<?php
return array(
	//'配置项'=>'配置值'
    'TMPL_PARSE_STRING'=>array(
        '__ADMIN__'=>__ROOT__.'/Public/Admin',
        '__HOME__'=>__ROOT__.'/Public/Home',
        '__UPLOAD__'=>__ROOT__.'/Public/Upload',
    ),

//    //上线显示页面调试信息
//    'SHOW_PAGE_TRACE'=>true,
////    连接数据库信息
//    'DB_TYPE'           => 'mysql', // 数据库类型
//    'DB_HOST'           => '118.193.158.198', // 服务器地址
//    'DB_NAME'           => 'a0922102211', // 数据库名
//    'DB_USER'           => 'a0922102211', // 用户名
//    'DB_PWD'            => '8088227a', // 密码
//    'DB_PORT'           => 3306, // 端口
//    'DB_PREFIX'         => 'tp_', // 数据库表前缀
//    'DB_CHARSET'        => 'utf8', // 字符集


    //显示页面调试信息
    'SHOW_PAGE_TRACE'=>true,
    //连接数据库信息
    'DB_TYPE'           => 'mysql', // 数据库类型
    'DB_HOST'           => '127.0.0.1', // 服务器地址
    'DB_NAME'           => 'mytaobao', // 数据库名
    'DB_USER'           => 'root', // 用户名
    'DB_PWD'            => 'root', // 密码
    'DB_PORT'           => 3306, // 端口
    'DB_PREFIX'         => 'tp_', // 数据库表前缀
    'DB_CHARSET'        => 'utf8', // 字符集


    /* Cookie设置 */
    'COOKIE_EXPIRE'         =>  0,       // Cookie有效期
    'COOKIE_DOMAIN'         =>  '',      // Cookie有效域名
    'COOKIE_PATH'           =>  '/',     // Cookie路径
    'COOKIE_PREFIX'         =>  'shop',      // Cookie前缀 避免冲突
    'COOKIE_SECURE'         =>  false,   // Cookie安全传输
    'COOKIE_HTTPONLY'       =>  '',      // Cookie httponly设置
    'LOAD_EXT_GONFIG'       =>'develop',
    'LOAD_EXT_FILE'         =>'tree,dataFunction',

    'GOODS_CONF'=>array(
        'maxSize' =>34145728,
        'exts' =>array('jpg','png','gif'),
        'rootPath' =>UPLOAD_PATH.'goods/',
    ),
);