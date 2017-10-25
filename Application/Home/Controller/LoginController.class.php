<?php
/**
 * Created by PhpStorm.
 * User: Yang
 * Date: 2017/9/23
 * Time: 14:41
 */

namespace Home\Controller;

class LoginController extends CommonController
{
    /**
     * @function 用户登录
     * @param void
     * @return void
     */
    public function login()
    {
        //判断是否提交数据
        if(IS_POST) {
            $model = M('User');
            $datas = $model->create();
            $datas['password'] = md5($datas['password']);
            $res = $model->where($datas)->find();
            if($res) {
                session('uid',$res['id']);
                session('username',$res['username']);
                $this->success('登录成功',U('index/index'));die;
            }else {
                $this->error('用户名或密码错误！');
            }
        }
        $this->display();
    }

    /**
     * @function 用户注册
     * @param void
     * @return void
     */
    public function reg()
    {
        //判断用户是否提交数据
        if(IS_POST) {
            $model = D('User');
            //实例化验证码类
            $verify = new \Think\Verify();
            //检测验证码是否正确
            if(!$verify->check(I('captcha'))) {
                $this->error('验证码错误');
            }
            //用create创建数据对象开启自动验证
            $datas = $model->create();
            if(!$datas) {
                //如果返回fales
                $this->error($model->geterror());
            }else {
                //写入数据
                $res = $model->add($datas);
                if($res) {
                    $this->success('注册成功',U('login'));die;
                }else {
                    $this->error('服务器繁忙，请稍后再试...');die;
                }
            }
        }
        $this->display();
    }
    public function captcha()
    {
        $config=array(
            // 中文验证码字符串
            'useImgBg'  =>  false,           // 使用背景图片
            'fontSize'  =>  14,              // 验证码字体大小(px)
            'useCurve'  =>  true,            // 是否画混淆曲线
            'useNoise'  =>  true,            // 是否添加杂点
            'imageH'    =>  30,               // 验证码图片高度
            'imageW'    =>  100,               // 验证码图片宽度
            'length'    =>  4,               // 验证码位数
            'fontttf'   =>  '4.ttf',              // 验证码字体，不设置随机获取
            'bg'        =>  array(243, 251, 254),  // 背景颜色
            'reset'     =>  true,           // 验证成功后是否重置
        );
        $verify = new \Think\Verify($config);
        $verify->entry();
    }
    public function logout()
    {
        session(null);
        if(!session('?uid')) {
            $this->success('退出成功',U('index/index'));
        }else {
            $this->error('服务器繁忙,请稍后再试...');
        }
    }
}