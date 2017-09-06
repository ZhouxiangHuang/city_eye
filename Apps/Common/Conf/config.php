<?php
return array(
    //'配置项'=>'配置值'
    'LANG_SWITCH_ON' => true,    // 开启语言包功能
    'LANG_AUTO_DETECT' => true,    // 自动侦测语言 开启多语言功能后有效
    'LANG_LIST' => 'zh-CN, hu-hu', // 允许切换的语言列表 用逗号分隔
    'VAR_LANGUAGE' => 'l',     // 默认语言切换变量
    /*公共函数文件*/
    'LOAD_EXT_FILE' => '',
    /* 系统数据加密设置 */
    'DATA_AUTH_KEY' => 'E;8q&Cb}yji$_K:mS>W"*XLt3g~[!lO4v<6RF+,w', //默认数据加密KEY
    /* URL配置 */
    'URL_CASE_INSENSITIVE' => true, //默认false 表示URL区分大小写 true则表示不区分大小写
    'URL_MODEL' => 2, //URL模式
    'VAR_URL_PARAMS' => '', // PATHINFO URL参数变量
    'URL_PATHINFO_DEPR' => '/', //PATHINFO URL分割符
/*    'SHOW_ERROR_MSG' => true,
    'SHOW_PAGE_TRACE' =>true,*/


    /* 数据库配置 */
    'DB_TYPE' => 'mysql', // 数据库类型
    'DB_HOST' => 'localhost', // 服务器地址
    'DB_NAME' => 'city_eye', // 数据库名
    'DB_USER' => 'root', // 用户名
    'DB_PWD' => '',  // 密码 ymkj2016   bjkj123!@#
    'DB_PORT' => '3306', // 端口
    'DB_PREFIX' => 'city_', // 数据库表前缀

    /* 数据缓存设置 */
    'DATA_CACHE_PREFIX' => 'dn', // 缓存前缀
    'DATA_CACHE_TYPE' => 'File', // 数据缓存类型
    /* APP分享用户ID加密KEY */
    "APP_SHARE_KEY" => "",
    /* 模板相关配置 */
    'TMPL_PARSE_STRING' => [
        '__PUBLIC__' => __ROOT__ . '/Public',
        '__STATIC__' => __ROOT__ . '/Public/static',
        '__IMG__' => __ROOT__ . '/Public/img',
        '__CSS__' => __ROOT__ . '/Public/css',
        '__JS__' => __ROOT__ . '/Public/js',
        '__H3__' => __ROOT__ . '/Public/h3',
        '__UPLOADS__' => __ROOT__ . '/Uploads',
        '__HOME__' => __ROOT__ . '/Public/home'
    ],
    'SHOW_ERROR_MSG' => false,
    'ERROR_MESSAGE'  =>    '发生错误！',
    'ERROR_PAGE' =>'/home/index/errors.html',
);