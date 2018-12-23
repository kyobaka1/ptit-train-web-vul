<?php

function connect_database(){
    $conn = new mysqli('localhost', $GLOBALS['config']['db_user'], $GLOBALS['config']['db_pass'], $GLOBALS['config']['db_name']);
    mysqli_set_charset($conn, 'utf8');
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error. " .<a href='?page=settings'>Config lại dùm.</a>");
    }
    return $conn;
}

function reset_csdl(){
    $conn = connect_database();
    $conn->query("CREATE TABLE IF NOT EXISTS challenge_status(id INT UNSIGNED NOT NULL AUTO_INCREMENT,id_post INT,type_post INT,status INT,post_title varchar(200),PRIMARY KEY(id));");
    $conn->query("DELETE FROM challenge_status;");
    $conn->query("INSERT INTO challenge_status(id_post, type_post, status, post_title) VALUES (0,0,1,'home'),(0,0,1,'friends'),(0,0,1,'settings'),(0,0,1,'owasp'),(3,0,0,'sqli'),(4,0,0,'sqli_tongquan'),(5,0,0,'sqli_phanloai'),(6,0,0,'sqli_tancong_coban'),(7,0,0,'sqli_tancong_blind'),(8,0,0,'sqli_tancong_other'),(9,0,0,'sqli_phongchong_coban'),(10,0,0,'sqli_phongchong_php'),(11,1,0,'sqli_thuchanh1'),(12,1,0,'sqli_thuchanh3'),(13,1,0,'sqli_thuchanh4'),(14,1,0,'sqli_thuchanh5'),(15,1,0,'sqli_thuchanh6'),(16,1,0,'sqli_thuchanh7'),(17,1,0,'sqli_thuchanh8'),(18,1,0,'sqli_thuchanh9'),(19,1,0,'sqli_thuchanh10'),(20,0,0,'xss'),(21,0,0,'xss_tongquan'),(22,0,0,'xss_phanloai'),(23,0,0,'xss_reflected'),(24,0,0,'xss_stored'),(25,0,0,'xss_dom'),(26,0,0,'xss_kythuat'),(27,0,0,'xss_stealsession'),(28,0,0,'xss_phongchong_coban'),(29,0,0,'xss_phongchong_php'),(30,1,0,'xss_chall1'),(31,1,0,'xss_chall2'),(32,1,0,'xss_chall3'),(33,0,0,'fileupload'),(34,0,0,'fileupload_work'),(35,0,0,'fileupload_vul'),(36,0,0,'fileupload_nc'),(37,0,0,'fileupload_fix'),(38,1,0,'fileupload_chall1'),(39,1,0,'fileupload_chall2'),(40,1,0,'fileupload_chall3'),(41,1,0,'fileupload_chall4'),(42,0,0,'file_inclusion'),(43,0,0,'fi_tongquan'),(44,0,0,'fi_phanloai'),(45,0,0,'fi_rfi'),(46,0,0,'fi_lfi_basic'),(47,0,0,'fi_lfi_file'),(48,0,0,'fi_lfi_wrapper'),(49,1,0,'fi_chall1'),(50,1,0,'fi_chall2'),(51,1,0,'fi_chall3'),(52,1,0,'fi_chall4'),(53,0,0,'deserialization'),(54,0,0,'deserialize_basic'),(55,0,0,'deserialize_php1'),(56,0,0,'deserialize_php2'),(57,0,0,'deserialize_phongchong'),(58,1,0,'deserialize_chall1'),(59,0,0,'xxe'),(60,0,0,'xml_tongquan'),(61,0,0,'xml_attack'),(62,0,0,'xxe_basic'),(63,0,0,'xxe_blind'),(64,0,0,'xxe_phongchong'),(65,1,0,'xxe_chall1'),(66,0,0,'php_vul'),(67,0,0,'csrf'),(68,0,0,'csrf_attack');");
    $conn->query("CREATE TABLE IF NOT EXISTS challenge_info (id INT UNSIGNED NOT NULL AUTO_INCREMENT,name_chall varchar(200),post_id INT,PRIMARY KEY(id));");
    $conn->query("DELETE FROM challenge_info;");
    $conn->query("INSERT INTO challenge_info(name_chall, post_id)VALUES ('SQL injection - authentication',11),('SQL injection - string',12),('SQL injection - numeric',13),('SQL Injection - Routed',14),('SQL injection - Error',15),('SQL injection - Insert',16),('SQL injection - file reading',17),('SQL injection - Time based',18),('SQL injection - blind',19),('XSS - Stored 1',30),('XSS - Stored 2',31),('XSS - DOM Based',32),('File upload - double extensions',38),('File upload - MIME type',39),('File upload - null byte',40),('File upload - ZIP',41),('Local File Inclusion',49),('Local File Inclusion - Double encoding',50),('Remote File Inclusion',51),('Local File Inclusion - Wrappers',52),('PHP Serialization',58),('XML External Entity',65);");
    $conn->query("CREATE TABLE IF NOT EXISTS csrf_account(id INT UNSIGNED NOT NULL AUTO_INCREMENT,username varchar(200),password varchar(200), taikhoan int,post_id INT,PRIMARY KEY(id));");
    $conn->query("CREATE TABLE IF NOT EXISTS csrf_message(id INT UNSIGNED NOT NULL AUTO_INCREMENT,message varchar(500),PRIMARY KEY(id));");
    $conn->query("CREATE TABLE IF NOT EXISTS sqli_users(id INT UNSIGNED NOT NULL AUTO_INCREMENT,uname varchar(200),pass varchar(200),privilege int,PRIMARY KEY(id));");
    $conn->query("CREATE TABLE IF NOT EXISTS sqli_products(id INT UNSIGNED NOT NULL AUTO_INCREMENT,tensanpham varchar(200),gia int,nguoiban varchar(200),PRIMARY KEY(id));");
    $conn->query("CREATE TABLE IF NOT EXISTS xss_stored(id INT UNSIGNED NOT NULL AUTO_INCREMENT,title varchar(300),author varchar(300),PRIMARY KEY(id));");
    $conn->query("DELETE FROM csrf_account;");
    $conn->query("DELETE FROM sqli_users;");
    $conn->query("DELETE FROM sqli_products;");
    $conn->query("INSERT INTO csrf_account(username,password,taikhoan) VALUES('bob','bob123',10000);");
    $conn->query("INSERT INTO sqli_users(uname,pass,privilege) VALUES('Bob','bob123',1);");
    $conn->query("INSERT INTO sqli_products(id,tensanpham,gia,nguoiban) VALUES(1,'Iphone-X',1000000,'Apple'),(2,'Samsung Galaxy J7+',200000,'Samsung'),(3,'PS Kem Đánh Răng',20000,'PS'),(4,'Quạt Senko',10000,'Senko');");
    $conn->query("CREATE TABLE IF NOT EXISTS friends_root(id INT UNSIGNED NOT NULL AUTO_INCREMENT,root_name VARCHAR(200), real_name VARCHAR (300), score int, PRIMARY KEY(id));");
}