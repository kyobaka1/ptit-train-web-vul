<?php
function get( $url )
{
    $user_agent='Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';
    $options = array(

        CURLOPT_CUSTOMREQUEST  =>"GET",        //set request type post or get
        CURLOPT_POST           =>false,        //set to GET
        CURLOPT_USERAGENT      => $user_agent, //set user agent
        CURLOPT_COOKIEFILE     =>"core/cookie/cookie.txt", //set cookie file
        CURLOPT_COOKIEJAR      =>"core/cookie/cookie.txt", //set cookie jar
        CURLOPT_RETURNTRANSFER => true,     // return web page
        CURLOPT_HEADER         => false,    // don't return headers
        CURLOPT_FOLLOWLOCATION => true,     // follow redirects
        CURLOPT_ENCODING       => "",       // handle all encodings
        CURLOPT_AUTOREFERER    => true,     // set referer on redirect
        CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
        CURLOPT_TIMEOUT        => 120,      // timeout on response
        CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
    );
    $ch      = curl_init( $url );
    curl_setopt_array( $ch, $options );
    $content = curl_exec( $ch );
    $err     = curl_errno( $ch );
    $errmsg  = curl_error( $ch );
    $header  = curl_getinfo( $ch );
    curl_close( $ch );
    $header['errno']   = $err;
    $header['errmsg']  = $errmsg;
    $header['content'] = $content;
    return $header;
}

function get_score_from_content($content,$username){
    $DOM = new DOMDocument;
    $DOM->loadHTML($content);
    $need = '';
    $items = $DOM->getElementsByTagName('span');
    for ($i = 0; $i < $items->length; $i++){
        $flag = $items->item($i)->nodeValue;
        if(preg_match('/'.$username.'/i',$flag)){
            $i++;
            $need = $items->item($i)->nodeValue;
            break;
        }
        if($need != '') break;
    }
    $need = preg_replace('/[^A-Za-z0-9?!\b]/','', $need);
    preg_match('/(.*)Points/',$need,$result);
    if(is_numeric($result[1])){
        return $result[1];
    }else{
        return 0;
    }
}

function get_chall_success($content){
    # Get all chall.
    if($content != ''){
        $DOM = new DOMDocument;
        $DOM->loadHTML($content);
        $items = $DOM->getElementsByTagName('li');
        $all_flag = array();
        for ($i = 0; $i < $items->length; $i++) {
            $flag = $items->item($i)->nodeValue;
            $flag = trim(preg_replace('/[^A-Za-z0-9?! -]/','', $flag));
            array_push($all_flag,$flag);
        }
        # Select chall from db
        $conn = connect_database();
        $result = $conn->query("SELECT * FROM challenge_info");
        while ($row = $result->fetch_assoc()){
            $status = 0;
            foreach ($all_flag as $item){
                if(preg_match('/'.$row['name_chall'].'/i',$item)){
                    if($item[0] == 'x'){
                        $status = 1;
                    }else if($item[0] == 'o'){
                        $status = 0;
                    }
                }
            }
            $id_now = $row['post_id'];
            $query = "UPDATE challenge_status SET status=$status WHERE id_post=$id_now";
            $conn2 = connect_database();
            $conn2->query($query);
        }
        $conn -> close();
        $conn2 -> close();
        return True;
    }else{
        die("Check connection or username of root me!<a href='index.php?page=settings'>Here!</a>");
    }
}
