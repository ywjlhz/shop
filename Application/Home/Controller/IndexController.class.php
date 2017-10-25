<?php
namespace Home\Controller;

class IndexController extends CommonController {
    public function index()
    {
        $this->display();
    }
    public function sendMail()
    {
        sendMail('liumeng5888@126.com','6666','66666');
    }
}