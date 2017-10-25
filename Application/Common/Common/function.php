<?php
/**
 * Created by PhpStorm.
 * User: Yang
 * Date: 2017/9/15
 * Time: 15:10
 */

function t1() {
    echo 111;
}

function htmlXss($str)
{
    vendor('Xss.HTMLPurifier#auto');
    $config = HTMLPurifier_Config::createDefault();
    $purifier = new HTMLPurifier($config);
    $clean_html = $purifier->purify($str);
    return $clean_html;
}

function uploadFile($upload_conf)
{
    $config = C($upload_conf);
    $upload = new \Think\Upload($config);
    $info =$upload->upload();
    return array('info'=>$info,'msg'=>$upload->getError());
}

#递归方法实现无限极分类
function getTree($list,$pid=0,$level=0) {
    static $tree = array();
    foreach($list as $row) {
        if($row['pid']==$pid) {
            $row['level'] = $level;
            $tree[] = $row;
            getTree($list, $row['id'], $level + 1);
        }
    }
    return $tree;
}

/**
 * @param $list
 * @param int $pid
 * @param int $level
 * @return array 包含父级的分类树数据
 */
function getParentTree($list,$pid=0,$level=0) {
    static $tree = array();
    if(empty($tree)) {
        foreach ($list as $val) {
            if($val['id']==$pid) {
                $tree[] = $val;
            }
        }
    }
    foreach($list as $row) {
        if($row['pid']==$pid) {
            $row['level'] = $level;
            $tree[] = $row;
            getParentTree($list, $row['id'], $level + 1);
        }
    }
    return $tree;
}
/**
 *字符串截取函数
 *开启mbstring扩展
 */
function msubstr($str, $start = 0, $length, $charset = "utf-8", $suffix = true)
{
    if (mb_strlen($str, $charset) > $length) {
        if (function_exists("mb_substr")) {
            if ($suffix) {
                return mb_substr($str, $start, $length, $charset) . "...";
            } else {
                return mb_substr($str, $start, $length, $charset);
            }

        } elseif (function_exists('iconv_substr')) {
            if ($suffix) {
                return iconv_substr($str, $start, $length, $charset) . "...";
            } else {
                return iconv_substr($str, $start, $length, $charset);
            }

        }
        $re['utf-8']  = "/[x01-x7f]|[xc2-xdf][x80-xbf]|[xe0-xef][x80-xbf]{2}|[xf0-xff][x80-xbf]{3}/";
        $re['gb2312'] = "/[x01-x7f]|[xb0-xf7][xa0-xfe]/";
        $re['gbk']    = "/[x01-x7f]|[x81-xfe][x40-xfe]/";
        $re['big5']   = "/[x01-x7f]|[x81-xfe]([x40-x7e]|xa1-xfe])/";
        preg_match_all($re[$charset], $str, $match);
        $slice = join("", array_slice($match[0], $start, $length));
        if ($suffix) {
            return $slice . "…";
        }

        return $slice;
    } else {
        return $str;
    }
}

/**
 * 把返回的数据集转换成Tree
 * @access public
 * @param array $list 要转换的数据集
 * @param string $pid parent标记字段
 * @param string $level level标记字段
 * @return array
 */
function list_to_tree($list, $pk = 'id', $pid = 'pid', $child = '_child', $root = 0)
{
    // 创建Tree
    $tree = array();
    if (is_array($list)) {
        // 创建基于主键的数组引用
        $refer = array();
        foreach ($list as $key => $data) {
            $refer[$data[$pk]] = &$list[$key];
        }
        foreach ($list as $key => $data) {
            // 判断是否存在parent
            $parentId = $data[$pid];
            if ($root == $parentId) {
                $tree[] = &$list[$key];
            } else {
                if (isset($refer[$parentId])) {
                    $parent           = &$refer[$parentId];
                    $parent[$child][] = &$list[$key];
                }
            }
        }
    }
    return $tree;
}

function sendMail($to, $title, $content)
{

    //引入PHPMailer的核心文件 使用require_once包含避免出现PHPMailer类重复定义的警告
    vendor('PHPMailer.PHPMailerAutoload');
    //实例化PHPMailer核心类
    $mail = new PHPMailer();

    //是否启用smtp的debug进行调试 开发环境建议开启 生产环境注释掉即可 默认关闭debug调试模式
    $mail->SMTPDebug = 1;

    //使用smtp鉴权方式发送邮件
    $mail->isSMTP();

    //smtp需要鉴权 这个必须是true
    $mail->SMTPAuth = true;

    //链接qq域名邮箱的服务器地址
    $mail->Host = 'smtp.qq.com';

    //设置使用ssl加密方式登录鉴权
    $mail->SMTPSecure = 'ssl';

    //设置ssl连接smtp服务器的远程服务器端口号，以前的默认是25，但是现在新的好像已经不可用了 可选465或587
    $mail->Port = 465;

    //设置发送的邮件的编码 可选GB2312 我喜欢utf-8 据说utf8在某些客户端收信下会乱码
    $mail->CharSet = 'UTF-8';

    //设置发件人姓名（昵称） 任意内容，显示在收件人邮件的发件人邮箱地址前的发件人姓名
    $mail->FromName = '杨文杰发送邮件';

    //smtp登录的账号 这里填入字符串格式的qq号即可
    $mail->Username = '136644909';

    //smtp登录的密码 使用生成的授权码（就刚才叫你保存的最新的授权码）
    $mail->Password = 'pmyqtnhsaqvqcagh';

    //设置发件人邮箱地址 这里填入上述提到的“发件人邮箱”
    $mail->From = '136644909@qq.com';

    //邮件正文是否为html编码 注意此处是一个方法 不再是属性 true或false
    $mail->isHTML(true);

    //设置收件人邮箱地址 该方法有两个参数 第一个参数为收件人邮箱地址 第二参数为给该地址设置的昵称 不同的邮箱系统会自动进行处理变动 这里第二个参数的意义不大
    $mail->addAddress($to, '猛哥');

    //添加多个收件人 则多次调用方法即可
    // $mail->addAddress('xxx@163.com','lsgo在线通知');

    //添加该邮件的主题
    $mail->Subject = $title;

    //添加邮件正文 上方将isHTML设置成了true，则可以是完整的html字符串 如：使用file_get_contents函数读取本地的html文件
    $mail->Body = $content;

    //为该邮件添加附件 该方法也有两个参数 第一个参数为附件存放的目录（相对目录、或绝对目录均可） 第二参数为在邮件附件中该附件的名称
    // $mail->addAttachment('./d.jpg','mm.jpg');
    //同样该方法可以多次调用 上传多个附件
    // $mail->addAttachment('./Jlib-1.1.0.js','Jlib.js');

    $status = $mail->send();

    //简单的判断与提示信息
    if ($status) {
        return true;
    } else {
        return false;
    }
}