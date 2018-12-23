<?php

function re_config($keyword, $value){
    $save_config = $GLOBALS['config'];
    $save_config[$keyword] = $value;
    $content = "<?php \n";
    foreach ($save_config as $k => $v){
        $content .= '$config[\''.$k.'\'] = \''.$v.'\';';
        $content .= "\n";
    }
    $content .="?>";
    file_put_contents(CONFIG_PATH.'/config.php',$content);
    $GLOBALS['config'] = $save_config;
}
function update_score($config){
    $URL = "https://www.root-me.org/".$config['user_root_me']."?inc=score&lang=en";
    $content = get($URL)['content'];
    $score_now = get_score_from_content($content, $config['user_root_me']); // Get score.
    if($score_now){
        get_chall_success($content); # Update challenge status.
        re_config('user_score',$score_now);
    }
    else{
        die("Check connection or username of root me!<a href='index.php?page=settings'>Here!</a>");
    }
}
function make_folder(){
    $all_folder = array();
    $all_folder['upload'] = PAGE_TO_ROOT.'uploads';
    $all_folder['deserialize_log'] = PAGE_TO_ROOT.'vul/deserialize/example/log';
    $all_folder['sqli_upload'] = PAGE_TO_ROOT.'vul/sqli/upload';
    $all_folder['sqli_upload'] = PAGE_TO_ROOT.'vul/xss/upload';
    $all_folder['fi_upload'] = PAGE_TO_ROOT.'vul/fi/example/upload';
    foreach ($all_folder as $key => $value) {
        if(!file_exists($value)){
            mkdir($value);
        }
    }
}
function get_score_by_name($name){
    $URL = "https://www.root-me.org/".$name."?inc=score&lang=en";
    $content = get($URL)['content'];
    $score_now = get_score_from_content($content, $name);   // Get score.
    if(!$score_now){
        return 0;
    }
    return $score_now;
}