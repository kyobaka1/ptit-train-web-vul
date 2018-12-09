<?php

/*
 * Trả về mã html hiển thị status của bài viết.
 */
function print_status($id_post){
    $conn = connect_database();
    $dbo = $conn->prepare('SELECT status,type_post FROM challenge_status WHERE id_post=? LIMIT 1');
    $dbo->bind_param('i',$id_post);
    $dbo->execute();
    $result = $dbo->get_result()->fetch_assoc();
    $conn->close();
    if($result['type_post'] == 0){
        $html = '<div class="status">';
        if($result['status'] == 1){
            $html .= '<img src="public/images/check.png" /><b>Đã Xem</b></div>';
        }else $html .= ' <img src="public/images/uncheck.png"/><b style="color: red">Chưa Xem</b></div>';
    }
    else{
        $html = '<div class="status">';
        if($result['status'] == 1){
            $html .= '<img src="public/images/check.png" /><b> Hoàn Thành</b></div>';
        }else $html .= ' <img src="public/images/uncheck.png"/><b style="color: red">Chưa Hoàn Thành</b></div>';
    }
    return $html;
}
/*
 * Trả về trạng thái của 1 bài viết là 0 hoặc 1, 0 là chưa đọc mà 1 là đọc hoặc làm rồi.
 */
function check_status($id_post){
    $conn = connect_database();
    $dbo = $conn->prepare('SELECT status FROM challenge_status WHERE id_post=? LIMIT 1');
    $dbo->bind_param('i',$id_post);
    $dbo->execute();
    $result = $dbo->get_result()->fetch_assoc();
    $conn->close();
    return $result['status'];
}

/*
 * Trả về mã html footer, nếu chưa đọc bao giờ, sẽ hiển thị ra để người dùng đánh dấu.
 */
function print_footer_status($id_post,$title){
    $conn = connect_database();
    $dbo = $conn->prepare('SELECT * FROM challenge_status WHERE id_post=? LIMIT 1');
    $dbo->bind_param('i',$id_post);
    $dbo->execute();
    $result = $dbo->get_result()->fetch_assoc();
    $conn->close();
    $html = '';
    if($result['status'] == 0){
        $html .= '<button id="change-btn"><img src="public/images/unread.png" class="img-circle img-rotate" style="height: 24px; width: 24px; margin-right: 5px" " />Lưu Đã Xem</button>';
        $html .= '<div id="change-status-model"><div class="modal-dialog" id="dialog"><div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close close-dialog">&times;</button>
                    <h4 class="modal-title">Thông Báo</h4>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc chắn rằng mình đã đọc và hiểu hết nội dung của bài?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default close-dialog">Close</button>';
        $html .= '<a href="?page='.$title.'&change_status=1"><button type="button" class="btn btn-primary btn-labeled ladda-button"><span class="ladda-label">Chắc chắn</span></button></a></div></div></div></div>';
        $html .= '    <script>
        $(document).ready(function(){
            $("#change-btn").click(function(){
                $("#change-status-model").show();
            });
            $(".close-dialog").click(function(){
                $("#change-status-model").hide();
            });
        });
    </script>';
    }
    return $html;
}

/*
 * Đổi trạng thái của 1 bài post.
 */
function change_status($id_post){
    $conn = connect_database();
    $dbo = $conn->prepare('SELECT * FROM challenge_status WHERE id_post=? LIMIT 1');
    $dbo->bind_param('i',$id_post);
    $dbo->execute();
    $result = $dbo->get_result()->fetch_assoc();
    if($result['status'] == 0 && $result['type_post'] == 0 ){ # type = 0 => document, type =1 => practice.
        $query = 'UPDATE challenge_status SET status=1 WHERE id='.$result['id'];
        echo $query;
        $conn->query($query);
    }
    $conn->close();
}
/*
 * Trả về mã html của một iframe youtube hướng dẫn.
 */
function get_iframe_youtube($src_youtube)
{
    $html = '';
    if ($src_youtube != '') {
        $html .= '<div id="hidden-video" class="modal">';
        $html .= '<div class="content">';
        $html .= '<iframe id="youtube-iframe" src="' . $src_youtube . '?enablejsapi=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen ></iframe>';
        $html .= '<button id="close-youtube" class="btn-danger center-block" style="width: 150px;">Close</button></div></div>';
        $html .= " <script>
                var modal = document.getElementById(\"hidden-video\");
                var btn = document.getElementById(\"introduce-btn\");
                var span = document.getElementById(\"close-youtube\");
                btn.onclick = function() {
                    modal.style.display = \"block\";
                }
                span.onclick = function() {
                    $('#youtube-iframe')[0].contentWindow.postMessage('{\"event\":\"command\",\"func\":\"' + 'stopVideo' + '\",\"args\":\"\"}', '*');
                    modal.style.display = \"none\";
                }
                window.onclick = function(event) {
                    if (event.target == modal) {
                        modal.style.display = \"none\";
                    }
                }
            </script>";
    }
    return $html;
}

# Trả về main page.
function draw_all_page($main_page, $example_page, $src_youtube, $title, $id_post, $parent){
    echo "<!DOCTYPE html>
<html>
<body class=\"main-center\" itemscope>
<head>
    <meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <title>PTITHCM-IS TRAINNING</title>
    <!-- Load CSS -->
    <link href=\"".PAGE_TO_ROOT."public/css/style.css\"  rel=\"stylesheet\" />
    <script src=\"".PAGE_TO_ROOT."public/jquery/jquery.min.js\" type=\"text/javascript\"></script>

</head>
</body>
<header class=\"header\" itemscope>
    <div class=\"slimContent\">
        <div class=\"navbar-header\">
            <div class=\"profile-block text-center\">
                <a id=\"avatar\" href=\"http://uis.ptithcm.edu.vn\" target=\"_blank\">
                    <img class=\"img-circle img-rotate\" src=\"".PAGE_TO_ROOT."public/images/ptit.jpg\" width=\"200\" height=\"200\">
                </a>
                <h2 id=\"name\" class=\"hidden-xs hidden-sm\">Học Viện Công Nghệ Bưu Chính Viễn Thông</h2>
                <h2 id=\"title\" class=\"hidden-xs hidden-sm\">An Toàn Thông Tin</h2>
                <small id=\"location\" class=\"text-muted hidden-xs hidden-sm\">97  Man Thiện Quận 9</small>
            </div>
            <div class=\"search\" id=\"search-form-wrap\">
                <div class=\"ins-search\">
                    <div class=\"ins-search-mask\"></div>
                    <div class=\"ins-search-container\">
                        <div class=\"ins-input-wrapper\">
                            <input type=\"text\" class=\"ins-search-input\" placeholder=\"Type something...\" x-webkit-speech />
                            <button type=\"button\" class=\"close ins-close ins-selectable\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">×</span></button>
                        </div>
                        <div class=\"ins-section-wrapper\">
                            <div class=\"ins-section-container\"></div>
                        </div>
                    </div>
                </div>
            </div>
            <button class=\"navbar-toggle collapsed\" type=\"button\" data-toggle=\"collapse\" data-target=\"#main-navbar\" aria-controls=\"main-navbar\" aria-expanded=\"false\">
                <span class=\"sr-only\">Toggle navigation</span>
                <span class=\"icon-bar\"></span>
                <span class=\"icon-bar\"></span>
                <span class=\"icon-bar\"></span>
            </button>
        </div>
        <nav id=\"main-navbar\" class=\"collapse navbar-collapse\" itemscope role=\"navigation\">
            <ul class=\"nav navbar-nav main-nav\">
                <li class=\"menu-item menu-item-home\">
                    <a href=\"index.php?page=home\">
                        <img class=\"img-circle img-rotate\" src=\"".PAGE_TO_ROOT."public/images/dashboard.png\" width=\"24\" height=\"24\">
                        <span class=\"menu-title\">Trang Chủ</span>
                    </a>
                </li>
                <li class=\"menu-item menu-item-archives\">
                    <a href=\"index.php?page=owasp\">
                        <img class=\"img-circle img-rotate\" src=\"".PAGE_TO_ROOT."public/images/chart-bar.png\" width=\"24\" height=\"24\">
                        <span class=\"menu-title\">TOP 10 OWASP</span>
                    </a>
                </li>
                <li class=\"menu-item menu-item-categories\">
                    <a href=\"index.php?page=sqli\">
                        <img class=\"img-circle img-rotate\" src=\"".PAGE_TO_ROOT."public/images/database-plus.png\" width=\"24\" height=\"24\">
                        <span class=\"menu-title\">SQL Injection</span>
                    </a>
                </li>
                <li class=\"menu-item menu-item-tags\">
                    <a href=\"index.php?page=xss\">
                        <img class=\"img-circle img-rotate\" src=\"".PAGE_TO_ROOT."public/images/needle.png\" width=\"24\" height=\"24\">
                        <span class=\"menu-title\">Cross-Site Scripting (XSS)</span>
                    </a>
                </li>
                <li class=\"menu-item menu-item-tags\">
                    <a href=\"index.php?page=file_inclusion\">
                        <img class=\"img-circle img-rotate\" src=\"".PAGE_TO_ROOT."public/images/file-import.png\" width=\"24\" height=\"24\">
                        <span class=\"menu-title\">File Inclusion (LFI - RFI)</span>
                    </a>
                </li>
                <li class=\"menu-item menu-item-books\">
                    <a href=\"index.php?page=fileupload\">
                        <img class=\"img-circle img-rotate\" src=\"".PAGE_TO_ROOT."public/images/file-upload.png\" width=\"24\" height=\"24\">
                        <span class=\"menu-title\">File Upload Vulnerabilities</span>
                    </a>
                </li>
                <li class=\"menu-item menu-item-links\">
                    <a href=\"index.php?page=xxe\">
                        <img class=\"img-circle img-rotate\" src=\"".PAGE_TO_ROOT."public/images/file-xml.png\" width=\"24\" height=\"24\">
                        <span class=\"menu-title\">XML External Entities</span>
                    </a>
                </li>
                <li class=\"menu-item menu-item-links\">
                    <a href=\"index.php?page=deserialization\">
                        <img class=\"img-circle img-rotate\" src=\"".PAGE_TO_ROOT."public/images/account-convert.png\" width=\"24\" height=\"24\">
                        <span class=\"menu-title\">Deserialization (PHP Object Injection)</span>
                    </a>
                </li>
                <li class=\"menu-item menu-item-links\">
                    <a href=\"index.php?page=php_vul\">
                        <img class=\"img-circle img-rotate\" src=\"".PAGE_TO_ROOT."public/images/language-php.png\" width=\"24\" height=\"24\">
                        <span class=\"menu-title\">Lỗ Hổng Của Ngôn Ngữ PHP</span>
                    </a>
                </li>
                <li class=\"menu-item menu-item-links\">
                    <a href=\"index.php?page=settings\">
                        <img class=\"img-circle img-rotate\" src=\"".PAGE_TO_ROOT."public/images/settings.png\" width=\"24\" height=\"24\">
                        <span class=\"menu-title\">Cài Đặt</span>
                    </a>
                </li>
                <li class=\"menu-item menu-item-about\">
                    <a href=\"index.php?page=friends\">
                        <img class=\"img-circle img-rotate\" src=\"".PAGE_TO_ROOT."public/images/account-group.png\" width=\"24\" height=\"24\">
                        <span class=\"menu-title\">Học Cùng Bạn</span>
                    </a>
                </li>
                <li class=\"menu-item menu-item-about\">
                    <a href=\"index.php?page=about-me\">
                        <img class=\"img-circle img-rotate\" src=\"".PAGE_TO_ROOT."public/images/information.png\" width=\"24\" height=\"24\">
                        <span class=\"menu-title\">About Me</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</header>";
    if($main_page != ''){
        require_once INSTALL_PATH.$main_page;
    }else die('Page has error in page request!');
    if($example_page != ''){
        require_once INSTALL_PATH.$example_page;
    }
    echo "<footer class=\"footer\" itemscope itemtype=\"http://schema.org/WPFooter\">
    <ul style='list-style: none; padding: 0'>
      <li class=\"menu-item menu-item-about\">
        <p><img class=\"img-circle img-rotate\" src=\"".PAGE_TO_ROOT."public/images/account-heart.png\" width=\"24\" height=\"24\">  Người Chơi: ".$GLOBALS['config']['user_root_me']."</p></li>
      <li class=\"menu-item menu-item-about\">
        <p><img class=\"img-circle img-rotate\" src=\"".PAGE_TO_ROOT."public/images/star-circle.png\" width=\"24\" height=\"24\">  Điểm: ".$GLOBALS['config']['user_score']."</p></li>
      <a href=\"?update_score=1\"><button class=\"btn-success\" style='width: 100px'>Cập Nhật</button></a>
    </ul>
    </footer>
</body>
</html>
    ";
}

