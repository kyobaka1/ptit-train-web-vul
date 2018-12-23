<?php

$menuBlocks['home'] = array( 'id_post'=>'0','url' => 'core/main/home.php', 'url_example' => '', 'src_youtube' => 'https://www.youtube.com/embed/L486ETZbu28');
$menuBlocks['settings'] = array( 'id_post'=>'0' , 'url' => 'core/main/settings.php', 'url_example' => '', 'src_youtube' => '');
$menuBlocks['friends'] = array( 'id_post'=>'0' , 'url' => 'core/main/friends.php', 'url_example' => '', 'src_youtube' => '', 'parent'=>'home');
$menuBlocks['about-me'] = array( 'id_post'=>'0' , 'url' => 'core/main/about-me.php', 'url_example' => '', 'src_youtube' => '');
$menuBlocks['owasp'] = array('id_post'=>'0','url' => 'core/main/owasp.php', 'url_example' => '', 'src_youtube' => 'https://www.youtube.com/embed/RGA5kLO9vjs');
# SQLI
$menuBlocks['sqli'] = array('id_post'=>'3','url' => 'vul/sqli/document/sqli.php', 'url_example' => '', 'src_youtube' => 'https://www.youtube.com/embed/WFFQw01EYHM');
$menuBlocks['sqli_tongquan'] = array('id_post'=>'4','url' => 'vul/sqli/document/sqli_tongquan.php', 'url_example' => 'vul/sqli/example/sqli_tongquan.php', 'src_youtube' => 'https://www.youtube.com/embed/WFFQw01EYHM', 'parent'=>'sqli');
$menuBlocks['sqli_phanloai'] = array('id_post'=>'5','url' => 'vul/sqli/document/sqli_phanloai.php', 'url_example' => '', 'src_youtube' => 'https://www.youtube.com/embed/WFFQw01EYHM', 'parent'=>'sqli');
$menuBlocks['sqli_tancong_coban'] = array('id_post'=>'6','url' => 'vul/sqli/document/sqli_tancong1.php', 'url_example' => 'vul/sqli/example/sqli_tancong1.php', 'src_youtube' => 'https://www.youtube.com/embed/WFFQw01EYHM', 'parent'=>'sqli');
$menuBlocks['sqli_tancong_blind'] = array('id_post'=>'7','url' => 'vul/sqli/document/sqli_tancong2.php', 'url_example' => 'vul/sqli/example/sqli_tancong2.php', 'src_youtube' => 'https://www.youtube.com/embed/1Qs195_8hNw', 'parent'=>'sqli');
$menuBlocks['sqli_tancong_other'] = array('id_post'=>'8','url' => 'vul/sqli/document/sqli_tancong3.php', 'url_example' => 'vul/sqli/example/sqli_tancong3.php', 'src_youtube' => 'https://www.youtube.com/embed/Z4E8PWZEwL0', 'parent'=>'sqli');
$menuBlocks['sqli_phongchong_coban'] = array('id_post'=>'9','url' => 'vul/sqli/document/sqli_phongchong1.php', 'url_example' => '', 'src_youtube' => 'https://www.youtube.com/embed/mo8RsfhtUG8', 'parent'=>'sqli');
$menuBlocks['sqli_phongchong_php'] = array('id_post'=>'10','url' => 'vul/sqli/document/sqli_phongchong2.php', 'url_example' => 'vul/sqli/example/sqli_phongchong2.php', 'src_youtube' => 'https://www.youtube.com/embed/TA7uiV3sMf4', 'parent'=>'sqli', 'file_at'=>'vul/sqli/prevent/source.php');
$menuBlocks['sqli_thuchanh1'] = array('id_post'=>'11','url' => 'vul/sqli/writeup/sqli_authentication.php', 'url_example' => '', 'src_youtube' => '', 'parent'=>'sqli');
$menuBlocks['sqli_thuchanh3'] = array('id_post'=>'12','url' => 'vul/sqli/writeup/sqli_string.php', 'url_example' => '', 'src_youtube' => '', 'parent'=>'sqli');
$menuBlocks['sqli_thuchanh4'] = array('id_post'=>'13','url' => 'vul/sqli/writeup/sqli_numberic.php', 'url_example' => '', 'src_youtube' => '', 'parent'=>'sqli');
$menuBlocks['sqli_thuchanh5'] = array('id_post'=>'14','url' => 'vul/sqli/writeup/sqli_routed.php', 'url_example' => '', 'src_youtube' => '', 'parent'=>'sqli');
$menuBlocks['sqli_thuchanh6'] = array('id_post'=>'15','url' => 'vul/sqli/writeup/sqli_error.php', 'url_example' => '', 'src_youtube' => '', 'parent'=>'sqli');
$menuBlocks['sqli_thuchanh7'] = array('id_post'=>'16','url' => 'vul/sqli/writeup/sqli_insert.php', 'url_example' => '', 'src_youtube' => '', 'parent'=>'sqli');
$menuBlocks['sqli_thuchanh8'] = array('id_post'=>'17','url' => 'vul/sqli/writeup/sqli_file_reading.php', 'url_example' => '', 'src_youtube' => '', 'parent'=>'sqli');
$menuBlocks['sqli_thuchanh9'] = array('id_post'=>'18','url' => 'vul/sqli/writeup/sqli_timebased.php', 'url_example' => '', 'src_youtube' => '', 'parent'=>'sqli');
$menuBlocks['sqli_thuchanh10'] = array('id_post'=>'19','url' => 'vul/sqli/writeup/sqli_blind.php', 'url_example' => '', 'src_youtube' => '', 'parent'=>'sqli');
# XSS
$menuBlocks['xss'] = array('id_post'=>'20','url' => 'vul/xss/document/xss.php', 'url_example' => '', 'src_youtube' => '');
$menuBlocks['xss_tongquan'] = array('id_post'=>'21','url' => 'vul/xss/document/xss_tongquan.php', 'url_example' => 'vul/xss/example/xss_tongquan.php', 'src_youtube' => 'https://www.youtube.com/embed/M_nIIcKTxGk', 'parent'=>'xss');
$menuBlocks['xss_phanloai'] = array('id_post'=>'22','url' => 'vul/xss/document/xss_phanloai.php', 'url_example' => '', 'src_youtube' => 'https://www.youtube.com/embed/M_nIIcKTxGk', 'parent'=>'xss');
$menuBlocks['xss_reflected'] = array('id_post'=>'23','url' => 'vul/xss/document/xss_reflected.php', 'url_example' => 'vul/xss/example/xss_reflected.php', 'src_youtube' => 'https://www.youtube.com/embed/9xyRKZbv5kQ', 'parent'=>'xss');
$menuBlocks['xss_stored'] = array('id_post'=>'24','url' => 'vul/xss/document/xss_stored.php', 'url_example' => 'vul/xss/example/xss_stored.php', 'src_youtube' => 'https://www.youtube.com/embed/7M-R6U2i5iI', 'parent'=>'xss');
$menuBlocks['xss_dom'] = array('id_post'=>'25','url' => 'vul/xss/document/xss_dom.php', 'url_example' => 'vul/xss/example/xss_dom.php', 'src_youtube' => 'https://www.youtube.com/embed/UFlF3F-XOG4', 'parent'=>'xss');
$menuBlocks['xss_kythuat'] = array('id_post'=>'26','url' => 'vul/xss/document/xss_kythuat.php', 'url_example' => '', 'src_youtube' => '', 'parent'=>'xss');
$menuBlocks['xss_stealsession'] = array('id_post'=>'27','url' => 'vul/xss/document/xss_stealsession.php', 'url_example' => '', 'src_youtube' => '', 'parent'=>'xss');
$menuBlocks['xss_phongchong_coban'] = array('id_post'=>'28','url' => 'vul/xss/document/xss_phongchong_coban.php', 'url_example' => '', 'src_youtube' => '', 'parent'=>'xss');
$menuBlocks['xss_phongchong_php'] = array('id_post'=>'29','url' => 'vul/xss/document/xss_phongchong_php.php', 'url_example' => 'vul/xss/example/xss_phongchong_php.php', 'src_youtube' => '', 'parent'=>'xss','file_at'=>'vul/xss/prevent/source.php');
$menuBlocks['xss_chall1'] = array('id_post'=>'30','url' => 'vul/xss/writeup/xss_chall1.php', 'url_example' => '', 'src_youtube' => '', 'parent'=>'xss');
$menuBlocks['xss_chall2'] = array('id_post'=>'31','url' => 'vul/xss/writeup/xss_chall2.php', 'url_example' => '', 'src_youtube' => '', 'parent'=>'xss');
$menuBlocks['xss_chall3'] = array('id_post'=>'32','url' => 'vul/xss/writeup/xss_chall3.php', 'url_example' => '', 'src_youtube' => '', 'parent'=>'xss');
# FILE UPLOAD
$menuBlocks['fileupload'] = array('id_post'=>'33','url' => 'vul/fupload/document/fileupload.php', 'url_example' => '', 'src_youtube' => '', 'parent'=>'xss');
$menuBlocks['fileupload_work'] = array('id_post'=>'34','url' => 'vul/fupload/document/fileupload_work.php', 'url_example' => 'vul/fupload/example/fileupload_work.php', 'src_youtube' => 'https://www.youtube.com/embed/lZoSGUzH8jQ', 'parent'=>'xss');
$menuBlocks['fileupload_vul'] = array('id_post'=>'35','url' => 'vul/fupload/document/fileupload_vul.php', 'url_example' => '', 'src_youtube' => 'https://www.youtube.com/embed/lZoSGUzH8jQ', 'parent'=>'xss');
$menuBlocks['fileupload_nc'] = array('id_post'=>'36','url' => 'vul/fupload/document/fileupload_nc.php', 'url_example' => '', 'src_youtube' => 'https://www.youtube.com/embed/lZoSGUzH8jQ', 'parent'=>'xss');
$menuBlocks['fileupload_fix'] = array('id_post'=>'37','url' => 'vul/fupload/document/fileupload_fix.php', 'url_example' => '', 'src_youtube' => 'https://www.youtube.com/embed/ybh11xEx1Tk', 'parent'=>'xss');
$menuBlocks['fileupload_chall1'] = array('id_post'=>'38','url' => 'vul/fupload/writeup/fileupload_chall1.php', 'url_example' => '', 'src_youtube' => '', 'parent'=>'xss');
$menuBlocks['fileupload_chall2'] = array('id_post'=>'39','url' => 'vul/fupload/writeup/fileupload_chall2.php', 'url_example' => '', 'src_youtube' => '', 'parent'=>'xss');
$menuBlocks['fileupload_chall3'] = array('id_post'=>'40','url' => 'vul/fupload/writeup/fileupload_chall3.php', 'url_example' => '', 'src_youtube' => '', 'parent'=>'xss');
$menuBlocks['fileupload_chall4'] = array('id_post'=>'41','url' => 'vul/fupload/writeup/fileupload_chall4.php', 'url_example' => '', 'src_youtube' => '', 'parent'=>'xss');
# FILE INCLUSION
$menuBlocks['file_inclusion'] = array('id_post'=>'42','url' => 'vul/fi/document/file_inclusion.php', 'url_example' => '', 'src_youtube' => '', 'parent'=>'file_inclusion');
$menuBlocks['fi_tongquan'] = array('id_post'=>'43','url' => 'vul/fi/document/fi_tongquan.php', 'url_example' => '', 'src_youtube' => 'https://www.youtube.com/embed/kcojXEwolIs', 'parent'=>'file_inclusion');
$menuBlocks['fi_phanloai'] = array('id_post'=>'44','url' => 'vul/fi/document/fi_phanloai.php', 'url_example' => '', 'src_youtube' => 'https://www.youtube.com/embed/kcojXEwolIs', 'parent'=>'file_inclusion');
$menuBlocks['fi_rfi'] = array('id_post'=>'45','url' => 'vul/fi/document/fi_rfi.php', 'url_example' => 'vul/fi/example/fi_rfi.php', 'src_youtube' => 'https://www.youtube.com/embed/kcojXEwolIs', 'parent'=>'file_inclusion');
$menuBlocks['fi_lfi_basic'] = array('id_post'=>'46','url' => 'vul/fi/document/fi_lfi_basic.php', 'url_example' => 'vul/fi/example/fi_lfi_basic.php', 'src_youtube' => 'https://www.youtube.com/embed/kcojXEwolIs', 'parent'=>'file_inclusion');
$menuBlocks['fi_lfi_file'] = array('id_post'=>'47','url' => 'vul/fi/document/fi_lfi_file.php', 'url_example' => 'vul/fi/example/fi_lfi_file.php', 'src_youtube' => 'https://www.youtube.com/embed/kcojXEwolIs', 'parent'=>'file_inclusion');
$menuBlocks['fi_lfi_wrapper'] = array('id_post'=>'48','url' => 'vul/fi/document/fi_lfi_wrapper.php', 'url_example' => 'vul/fi/example/fi_lfi_wrapper.php', 'src_youtube' => 'https://www.youtube.com/embed/kcojXEwolIs', 'parent'=>'file_inclusion');
$menuBlocks['fi_chall1'] = array('id_post'=>'49','url' => 'vul/fi/writeup/fi_chall1.php', 'url_example' => '', 'src_youtube' => '', 'parent'=>'file_inclusion');
$menuBlocks['fi_chall2'] = array('id_post'=>'50','url' => 'vul/fi/writeup/fi_chall2.php', 'url_example' => '', 'src_youtube' => '', 'parent'=>'file_inclusion');
$menuBlocks['fi_chall3'] = array('id_post'=>'51','url' => 'vul/fi/writeup/fi_chall3.php', 'url_example' => '', 'src_youtube' => '', 'parent'=>'file_inclusion');
$menuBlocks['fi_chall4'] = array('id_post'=>'52','url' => 'vul/fi/writeup/fi_chall4.php', 'url_example' => '', 'src_youtube' => '', 'parent'=>'file_inclusion');
# DESERIALIZATION
$menuBlocks['deserialization'] = array('id_post'=>'53','url' => 'vul/deserialize/document/deserialization.php', 'url_example' => '', 'src_youtube' => 'https://www.youtube.com/embed/gTXMFrctYLE', 'parent'=>'deserialization');
$menuBlocks['deserialize_basic'] = array('id_post'=>'54','url' => 'vul/deserialize/document/deserialize_basic.php', 'url_example' => '', 'src_youtube' => 'https://www.youtube.com/embed/gTXMFrctYLE', 'parent'=>'deserialization');
$menuBlocks['deserialize_php1'] = array('id_post'=>'55','url' => 'vul/deserialize/document/deserialize_php1.php', 'url_example' => '', 'src_youtube' => 'https://www.youtube.com/embed/gTXMFrctYLE', 'parent'=>'deserialization');
$menuBlocks['deserialize_php2'] = array('id_post'=>'56','url' => 'vul/deserialize/document/deserialize_php2.php', 'url_example' => 'vul/deserialize/example/deserialize_php.php', 'src_youtube' => 'https://www.youtube.com/embed/gTXMFrctYLE', 'parent'=>'deserialization');
$menuBlocks['deserialize_phongchong'] = array('id_post'=>'57','url' => 'vul/deserialize/document/deserialize_phongchong.php', 'url_example' => '', 'src_youtube' => 'https://www.youtube.com/embed/gTXMFrctYLE', 'parent'=>'deserialization');
$menuBlocks['deserialize_chall1'] = array('id_post'=>'58','url' => 'vul/deserialize/writeup/deserialize_chall1.php', 'url_example' => '', 'src_youtube' => '', 'parent'=>'deserialization');

# XXE
$menuBlocks['xxe'] = array('id_post'=>'59','url' => 'vul/xxe/document/xxe.php', 'url_example' => '', 'src_youtube' => '', 'parent'=>'xxe');
$menuBlocks['xml_tongquan'] = array('id_post'=>'60','url' => 'vul/xxe/document/xml_tongquan.php', 'url_example' => '', 'src_youtube' => '', 'parent'=>'xxe');
$menuBlocks['xml_attack'] = array('id_post'=>'61','url' => 'vul/xxe/document/xml_attack.php', 'url_example' => '', 'src_youtube' => '', 'parent'=>'xxe');
$menuBlocks['xxe_basic'] = array('id_post'=>'62','url' => 'vul/xxe/document/xxe_basic.php', 'url_example' => 'vul/xxe/example/xxe_basic.php', 'src_youtube' => '', 'parent'=>'xxe');
$menuBlocks['xxe_blind'] = array('id_post'=>'63','url' => 'vul/xxe/document/xxe_blind.php', 'url_example' => 'vul/xxe/example/xxe_blind.php', 'src_youtube' => '', 'parent'=>'xxe');
$menuBlocks['xxe_phongchong'] = array('id_post'=>'64','url' => 'vul/xxe/document/xxe_phongchong.php', 'url_example' => '', 'src_youtube' => '', 'parent'=>'xxe');
$menuBlocks['xxe_chall1'] = array('id_post'=>'65','url' => 'vul/xxe/writeup/xxe_chall1.php', 'url_example' => '', 'src_youtube' => '', 'parent'=>'xxe');

# PHP VUL
$menuBlocks['php_vul'] = array('id_post'=>'66','url' => 'vul/php_vul/document/php_vul.php', 'url_example' => '', 'src_youtube' => '', 'parent'=>'php_vul');
$menuBlocks['csrf'] = array('id_post'=>'67','url' => 'vul/php_vul/document/csrf.php', 'url_example' => '', 'src_youtube' => 'https://www.youtube.com/embed/m0EHlfTgGUU', 'parent'=>'php_vul');
$menuBlocks['csrf_attack'] = array('id_post'=>'68','url' => 'vul/php_vul/document/csrf_attack.php', 'url_example' => 'vul/php_vul/example/csrf_attack.php', 'src_youtube' => 'https://www.youtube.com/embed/m0EHlfTgGUU', 'parent'=>'php_vul');





















