<?php

namespace News\Controller;
use Think\Controller;
/**
 * 前台文章控制器
 * @author C0de <47156503@qq.com>
 */
class NewsController extends Controller{
    /**
     * 初始化方法
     * @author c0de <47156503@qq.com>
     */
    protected function _initialize(){
        set_theme();
        if(!C('TOGGLE_WEB_SITE')){
            $this->error('站点已经关闭，请稍后访问~');
        }

        $this->assign('meta_keywords', C('WEB_SITE_KEYWORD'));
        $this->assign('meta_description', C('WEB_SITE_DESCRIPTION'));
        $this->assign('__USER__', session('user_auth')); //用户登录信息
    }
}
