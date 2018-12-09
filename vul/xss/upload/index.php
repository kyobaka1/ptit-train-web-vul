<?php
if(isset($_GET['name'])){
    echo 'Hello '.htmlspecialchars($_GET['name']);
}
/*
 * Ví dụ khi nhập: Vương => Hello Vương
 * Nếu ko thì ko đúng yêu cầu.
 */
