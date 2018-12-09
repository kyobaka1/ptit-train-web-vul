<main class="main has-sticky" role="main">
    <div class="content">
        <article id="post-fi/lfi" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    Local File Inclusion (LFI)
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a>
               <?php if($src_youtube != ''){echo '<button id="introduce-btn"><img src="public/images/play-circle.png" class="img-circle img-rotate" style="height: 24px; width: 24px; margin-right: 5px" " />Hướng Dẫn</button>';} ?>
                </div>
            </div>
            <?php echo get_iframe_youtube($src_youtube); ?>
            <div class="article-entry marked-body" itemprop="articleBody">
                <h1 id="Khai-niem"><a href="#Khai-niem" class="headerlink" title="Khái niệm"></a>Khái niệm</h1>
                <p><strong>Local File Inclusion</strong> khác với RFI là file include nằm ở cục bộ có sẵn trên máy chủ server.<br>Lỗ hổng xảy ra khi người dùng có thể điều khiển được đường dẫn được truyền vào hàm <strong>include()</strong>.</p>
                <p>LFI phổ biến hơn là RFI, và mức độ nguy hiểm có nó cao hơn so với RFI. Bởi vì, những file nằm trên cục bộ server có thể đọc được thông qua lỗ hổng này. Từ đó, kẻ tấn công sẽ có thêm rất nhiều thông tin hữu ích phục vụ quá trình tấn công được mở rộng.</p>
                <p>Nhưng đồng thời LFI cũng khó khai thác hơn so với RFI, bởi vì nếu muốn thực thi mã độc bằng LFI, ta cần có một file <strong>cục bộ</strong> có chứa mã độc đã. Rồi sau đó mới thực hiện LFI file đó để chạy mã độc được.</p>
                <h1 id="Vi-du-ve-tan-cong-LFI"><a href="#Vi-du-ve-tan-cong-LFI" class="headerlink" title="Ví dụ về tấn công LFI"></a>Ví dụ về tấn công LFI</h1>
                <p>Ví dụ bên cạnh,đọc đoạn code cho ta thấy, ý muốn của nhà phát triển là chỉ cho ta include được file nằm trong thư mục config/, ngoài ra không thể cho ta include file nằm ở các thư mục khác được.</p>
                <p>Có thể trong thư mục config, chỉ có những file php hợp lệ phục vụ cho quá trình config, mà không cho phép người dùng upload lên hay sửa đổi thông tin trong đó.</p>
                <h2 id="Cach-doc-file-tuy-y"><a href="#Cach-doc-file-tuy-y" class="headerlink" title="Cách đọc file tuỳ ý"></a>Cách đọc file tuỳ ý</h2>
                <p>Ta dùng cơ chế <strong>Directory Traversal</strong> để có thể tấn công LFI trong trường hợp này,tức là dùng:</p>
                <blockquote>
                    <p>../</p>
                </blockquote>
                <p>Nó có thể cho ta đến thư mục cha của thư mục hiện tại, ví dụ:</p>
                <blockquote>
                    <p>home -&gt; upload -&gt; file config<br>       -&gt; flag   -&gt; flag.txt</p>
                </blockquote>
                <p>Nếu ta muốn đọc file flag.txt, ta cung cấp ../ để chuyển thư mục sang home rồi flag/ và flag.txt</p>
                <blockquote>
                    <p>../flag/flag.txt</p>
                </blockquote>
                <h2 id="Cach-thuc-thi-code-tuy-y"><a href="#Cach-thuc-thi-code-tuy-y" class="headerlink" title="Cách thực thi code tuỳ ý"></a>Cách thực thi code tuỳ ý</h2>
                <p>Nếu chỉ mình LFI ta không thể thực thi code tuỳ ý được, yêu cầu của nó chính là có một file nằm ở local, và có chứa đoạn script mã độc đó.<br>File chứa mã độc ko quan tâm đó là file hình ảnh, file text hay bất cứ loại file gì.<br>Trong ví dụ, mình cho các bạn chỉ có thể upload file hình ảnh, nó nằm tại thư mục upload. Hãy tạo ra 1 file hình ảnh mà nội dung có đoạn script:</p>
                <blockquote>
                    <p>&lt;?php phpinfo(); ?&gt;</p>
                </blockquote>
                <p>Có thể thực hiện bằng <strong>HxD</strong> hoặc <strong>HexEditor</strong>, hoặc tạo file text rồi đuổi đuôi sang file hình nha.</p>
                <h2 id="Thanh-cong"><a href="#Thanh-cong" class="headerlink" title="Thành công!"></a>Thành công!</h2>
                <p>Thử LFI với file hình vừa upload lên xem nào.</p>
                <blockquote>
                    <p>../upload/shell.jpg</p>
                </blockquote>
                <h1 id="Cach-phong-chong-LFI"><a href="#Cach-phong-chong-LFI" class="headerlink" title="Cách phòng chống LFI"></a>Cách phòng chống LFI</h1>
                <h2 id="Trong-code"><a href="#Trong-code" class="headerlink" title="Trong code"></a>Trong code</h2>
                <ul>
                    <li>Lời khuyên tốt nhất cho nhà phát triển là không nên cho phép include file động bằng user input. </li>
                    <li>Nếu không thể không dùng, hãy khai báo một <strong>whitelist</strong> những file có thể include vào để cho kẻ tấn công không thể nào bypass và điều khiển nó.</li>
                    <li>Chỉ cho input từ 0-9 A-Z thôi, hoặc cắt bỏ những kí tự như ./ hay ../</li>
                </ul>
                <h2 id="Config-php-ini"><a href="#Config-php-ini" class="headerlink" title="Config php.ini"></a>Config php.ini</h2>
                <p>Cấu hình trong php.ini:</p>
                <ul>
                    <li>allow_url_include = off </li>
                    <li>allow_urf_fopen = off</li>
                    <li>Register_globals = off</li>
                </ul>
                <h1 id="Tham-Khao-Them"><a href="#Tham-Khao-Them" class="headerlink" title="Tham Khảo Thêm"></a>Tham Khảo Thêm</h1>
                <ul>
                    <li><strong>ROOT ME DOCUMENT</strong>: <a href="http://repository.root-me.org/Exploitation%20-%20Web/EN%20-%20Local%20File%20Inclusion.pdf" target="_blank" rel="noopener">http://repository.root-me.org/Exploitation%20-%20Web/EN%20-%20Local%20File%20Inclusion.pdf</a></li>
                    <li><strong>ACUNETIX</strong>: <a href="https://www.acunetix.com/blog/articles/local-file-inclusion-lfi/" target="_blank" rel="noopener">https://www.acunetix.com/blog/articles/local-file-inclusion-lfi/</a></li>
                </ul>
            </div>
        </article>
        <?php if(isset($_GET['change_status'])){
            if($_GET['change_status'] == 1){change_status($id_post);}}
        echo print_footer_status($id_post,$title);
        ?>
        <section id="comments">
            <div id="vcomments"></div>
        </section>
    </div>

</main>