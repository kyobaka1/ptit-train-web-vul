<?php
if(isset($_GET['name'])){
    echo 'Hello '.$_GET['name'];
}
/*
 * Ví dụ khi nhập: Vương => Hello Vương
 * Nếu ko thì ko đúng yêu cầu.
 */
