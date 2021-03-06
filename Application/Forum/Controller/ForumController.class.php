<?php

namespace Forum\Controller;
use Think\Controller;

class ForumController extends Controller{

    protected function _initialize(){
        set_theme();
        if(!C('TOGGLE_WEB_SITE')){
            $this->error('站点已经关闭，请稍后访问~');
        }
		$userinfo=session('user_auth');
		if(!empty($userinfo)){
			$__USER__=D('User')->find($userinfo['id']);
			$this->assign('__USER__', $__USER__); //用户登录信息
		}
        $this->assign('meta_keywords', C('WEB_SITE_KEYWORD'));
        $this->assign('meta_description', C('WEB_SITE_DESCRIPTION'));
    }

}
