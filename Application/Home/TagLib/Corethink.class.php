<?php
// +----------------------------------------------------------------------
// | CoreThink [ Simple Efficient Excellent ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://www.corethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: jry <598821125@qq.com> <http://www.corethink.cn>
// +----------------------------------------------------------------------
namespace Home\TagLib;
use Think\Template\TagLib;
/**
 * 标签库
 * @author jry <598821125@qq.com>
 */
class CoreThink extends TagLib{
    /**
     * 定义标签列表
     * @author jry <598821125@qq.com>
     */
    protected $tags = array(
        'breadcrumb'  => array('attr' => 'name,cid', 'close' => 1), //面包屑导航列表
        'category_list' => array('attr' => 'name,pid,group,post_auth,num', 'close' => 1), //栏目分类列表
        'comment_list'  => array('attr' => 'name,doc_id', 'close' => 1), //评论列表
        'document_list'  => array('attr' => 'name,cid,limit,order', 'close' => 1), //文档列表
    );

    /**
     * 面包屑导航列表
     * @author jry <598821125@qq.com>
     */
    public function _breadcrumb($tag, $content){
        $name   = $tag['name'];
        $cid    = $tag['cid'];
        $group  = $tag['group'] ? : 1;
        $parse  = '<?php ';
        $parse .= '$__PARENT_CATEGORY__ = D(\'Category\')->getParentCategory('.$cid.', '.$group.');';
        $parse .= ' ?>';
        $parse .= '<volist name="__PARENT_CATEGORY__" id="'. $name .'">';
        $parse .= $content;
        $parse .= '</volist>';
        return $parse;
    }

    /**
     * 栏目分类列表
     * @author jry <598821125@qq.com>
     */
    public function _category_list($tag, $content){
		
        $name   = $tag['name'];
        $pid    = $tag['pid'] ? : 0;
        $group  = $tag['group'] ? : 1;
		$post_auth  = $tag['post_auth'] ? : 0;
		$num= $tag['num'] ? : 100;
        $parse  = '<?php ';
        $parse .= '$__CATEGORYLIST__ = D(\'Category\')->getCategoryTree('.$pid.', '.$group.',false,'.$post_auth.' ,'.$num.' );';
        $parse .= ' ?>';
        $parse .= '<volist name="__CATEGORYLIST__" id="'. $name .'">';
        $parse .= $content;
        $parse .= '</volist>';
        return $parse;
    }

    /**
     * 评论列表
     * @author jry <598821125@qq.com>
     */
    public function _comment_list($tag, $content){
        $name   = $tag['name'];
        $doc_id = $tag['doc_id'];
        $parse  = '<?php ';
        $parse .= '$__COMMENT_LIST__ = D(\'UserComment\')->getAllCommentByDocument('.$doc_id.');';
        $parse .= ' ?>';
        $parse .= '<volist name="__COMMENT_LIST__" id="'. $name .'">';
        $parse .= $content;
        $parse .= '</volist>';
        return $parse;
    }

    /**
     * 文档列表
     * @author jry <598821125@qq.com>
     */
    public function _document_list($tag, $content){
        $name   = $tag['name'];
        $cid    = $tag['cid'];
        $limit  = $tag['limit'] ? : 10;
        $order  = $tag['sort'] ? : 'sort desc,id desc';
        $parse  = '<?php ';
        $parse .= '$map["cid"] = array("eq", '.$cid.');';
        $parse .= '$map["status"] = array("eq", "1");';
        $parse .= '$__DOCUMENT_LIST__ = D(\'Document\')->page(!empty($_GET["p"])?$_GET["p"]:1, '.$limit.')->order('.$order.')->where($map)->select();';
        $parse .= ' ?>';
        $parse .= '<volist name="__DOCUMENT_LIST__" id="'. $name .'">';
        $parse .= $content;
        $parse .= '</volist>';
        return $parse;
    }
}
