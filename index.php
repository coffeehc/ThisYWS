<?php
define('DOMAIN', '.yiwanshu.com');
if(str_replace('.','',$_SERVER['HTTP_HOST']) == str_replace('.','',DOMAIN)){Header("HTTP/1.1 301 Moved Permanently");header("Location: http://www".DOMAIN);die();}
ini_set('session.cookie_path', '/');
ini_set('session.cookie_domain', DOMAIN);
define ( "GZIP_ENABLE", function_exists ( 'ob_gzhandler' ) );
ob_start ( GZIP_ENABLE ? 'ob_gzhandler' : null );
/**
 * PHP版本检查
 */
if(version_compare(PHP_VERSION,'5.3.0','<')) die('require PHP > 5.3.0 !');

/**
 * PHP报错设置
 */
error_reporting(E_ALL^E_NOTICE^E_WARNING);

/**
 * 开发模式环境变量前缀
 */
define('ENV_PRE', 'CT_');

/**
 * 系统调试设置
 * 项目正式部署后请设置为false
 */
define('APP_DEBUG', false);

/**
 * 应用目录设置
 * 安全期间，建议安装调试完成后移动到非WEB目录
 */
define('APP_PATH', './Application/');

/**
 * 缓存目录设置
 * 此目录必须可写，建议移动到非WEB目录
 */
define('RUNTIME_PATH', './Runtime/');

/**
 * 静态缓存目录设置
 * 此目录必须可写，建议移动到非WEB目录
 */
define('HTML_PATH', RUNTIME_PATH.'Html/');

/**
 * 引入核心入口
 * ThinkPHP亦可移动到WEB以外的目录
 */
require './ThinkPHP/ThinkPHP.php';
