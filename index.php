<?php
/*
 +-------------------------------------------------------------------------+
 | PTITHCM-IS TRAINNING                                                    |
 | Version 1.0.0                                                           |
 |                                                                         |
 | Code by Đoàn Ngọc Vương - 2018 - Đồ án tốt nghiệp                       |
 |                                                                         |
 +-------------------------------------------------------------------------+
 | Mail: Ngọc Vương <vuongthieuis@gmail.com>                               |
 | GVHD: Huỳnh Trọng Thưa <htthua@ptithcm.edu.vn>                          |
 +-------------------------------------------------------------------------+
*/
# Set and include all enviroment, function.
require_once 'core/config/init.php';
if($config['install'] == 0){
    header("Location: install.php");
}
# Process update score root me
if(isset($_GET['update_score'])){
    update_score($config);
    header("Location: index.php");
}
# Change username root me
if(isset($_GET['root-submit'])){
    if(isset($_GET['name-root']) && $_GET['name-root'] != ''){
        re_config('user_root_me',$_GET['name-root']);
        update_score($config);
    }
}
if(isset($_GET['db-submit'])){
    $us_ip = $_GET['db-user'];
    $ps_ip = $_GET['db-password'];
    $db_ip = $_GET['db-name'];
    re_config('db_user',$us_ip);
    re_config('db_pass',$ps_ip);
    re_config('db_name',$db_ip);
    $conn = connect_database();
    reset_csdl();
}

# Get page user want to read.
if(isset($_GET['page'])){
    $page =  strtolower($_GET['page']);
    if(!array_key_exists($page,$menuBlocks)){ # If page isn't exits.
        $page = 'home';
    }
}else{
    $page = 'home'; # Default is home page.
}
# Get info of page.
$main_page = $menuBlocks[$page]['url'];
$example_page = $menuBlocks[$page]['url_example'];
$src_youtube = $menuBlocks[$page]['src_youtube'];
$title = $page;
$parent =  $menuBlocks[$page]['parent'];
$id_post = $menuBlocks[$page]['id_post'];
if(isset($menuBlocks[$page]['file_at'])) $file_src = $menuBlocks[$page]['file_at'];
# Get html page content.

if(isset($_GET['dowload'])){
    if(file_exists($file_src)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($file_src));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file_src));
        ob_clean();
        flush();
        readfile($file_src);
        exit;
    }
}

draw_all_page($main_page, $example_page, $src_youtube, $title, $id_post, $parent);
make_folder();




