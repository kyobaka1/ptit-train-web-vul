<main class="main" role="main">
    <div class="content">
        <article id="post-xss/xss_dom" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    DOM-Based XSS
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a>
               <?php if($src_youtube != ''){echo '<button id="introduce-btn"><img src="public/images/play-circle.png" class="img-circle img-rotate" style="height: 24px; width: 24px; margin-right: 5px" " />Hướng Dẫn</button>';} ?>
                </div>
            </div>
            <?php echo get_iframe_youtube($src_youtube); ?>
            <div class="article-entry marked-body" itemprop="articleBody">
                <p><strong>DOM Based XSS</strong> là biến thể của hai loại Stored XSS và Reflected XSS. Tầm ảnh hưởng và nguy hiểm của nó nằm ở Reflected XSS.</p>
                <h1 id="DOM-Based-XSS-la-gi"><a href="#DOM-Based-XSS-la-gi" class="headerlink" title="DOM Based XSS là gì?"></a>DOM Based XSS là gì?</h1>
                <p><strong>DOM Based XSS</strong> (còn được gọi tên khác là “type-0 XSS”) là một loại XSS diễn ra khi mà mã độc tấn công được thực thi là kết quả của việc chỉnh sửa lại DOM “environment” tại trình duyệt của người dùng khi thực thi client side script. Do đó dẫn đến client side code chạy không chính xác (thực thi những thứ không mong muốn).</p>
                <h2 id="De-hieu-hon"><a href="#De-hieu-hon" class="headerlink" title="Dễ hiểu hơn:"></a>Dễ hiểu hơn:</h2>
                <p>Ở Reflected XSS và Stored XSS thì mã độc được gửi lên server, hoặc lưu ở server. Sau đó mã độc được gửi kèm theo trong phản hồi (response) của máy chủ tới client. Sau đó client sẽ chạy đoạn mã độc đó và bị dính XSS.<br>Còn DOM Based XSS, sẽ có những đoạn code client side như javascript sẽ nhận nhiệm vụ xử lý các thông tin dựa vào các DOM “enviroment” sau đó, những đoạn script này sẽ sửa lại cấu trúc HTML hoặc Javascript dựa trên những thông tin đó. (Không có sự can thiệp của server).</p>
                <h2 id="Vi-du"><a href="#Vi-du" class="headerlink" title="Ví dụ"></a>Ví dụ</h2>
                <p>Bạn có thể nhập vào các biến như <strong>tên người dùng</strong> ở URL. Sau đó, đoạn Javascript lấy thông tin từ URL lấy ra tên người dùng. Sau đó, nó dùng biến tên người dùng để thay đổi cho một phần tử HTML như thẻ h1 nào đó là Xin chào + tên người dùng.<br>Bạn có thể thấy được, không có quá trình thực thi gì ở server ngoài việc gửi trang ban đầu cho người dùng.<br>Hacker lợi dụng cung cấp <strong>nhập tên người dùng</strong> là đoạn script:</p>
                <blockquote>
                    <p>&lt;script&gt;alert(1)&lt;/script&gt;</p>
                </blockquote>
                <p>Sau đó,gửi một URL như là: trusted.com?ten=madoc<br>Người dùng click vào URL, và dính XSS.</p>
                <p><img src="http://localhost/dom-based-xss.png" alt="Mô hình XSS diễn ra"></p>
                <h1 id="Cac-buoc-tan-cong-DOM-Based-XSS"><a href="#Cac-buoc-tan-cong-DOM-Based-XSS" class="headerlink" title="Các bước tấn công DOM Based XSS."></a>Các bước tấn công DOM Based XSS.</h1>
                <h2 id="Buoc-1-Tim-loi"><a href="#Buoc-1-Tim-loi" class="headerlink" title="Bước 1: Tìm lỗi"></a>Bước 1: Tìm lỗi</h2>
                <p>Như mọi lỗi XSS, ta cũng focus tìm lỗi ở những input của người dùng dưới dạng GET, tức là được truyền trên URL.<br>Như trong ví dụ,ta thấy biến <strong>lang</strong> được truyền ở URL.</p>
                <h3 id="Crt-U-Xem-source-client-side-code"><a href="#Crt-U-Xem-source-client-side-code" class="headerlink" title="Crt + U: Xem source client side code."></a>Crt + U: Xem source client side code.</h3>
                <p>Ta thấy, có đoạn code javascript như sau:<br></p>
                <figure class="highlight html">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br><span class="line">8</span><br><span class="line">9</span><br><span class="line">10</span><br><span class="line">11</span><br><span class="line">12</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="tag">&lt;<span class="name">select</span> <span class="attr">name</span>=<span class="string">"lang"</span>&gt;</span></span><br><span class="line">    <span class="tag">&lt;<span class="name">script</span> <span class="attr">type</span>=<span class="string">"text/javascript"</span>&gt;</span><span class="undefined"></span></span><br><span class="line"><span class="undefined">        if (document.location.href.indexOf("lang=") &gt;= 0) {</span></span><br><span class="line"><span class="undefined">        	var lang = document.location.href.substring(document.location.href.indexOf("lang=")+5);</span></span><br><span class="line"><span class="xml">        	document.write("<span class="tag">&lt;<span class="name">option</span> <span class="attr">value</span>=<span class="string">'" + lang + "'</span>&gt;</span>" + decodeURIComponent(lang) + "<span class="tag">&lt;/<span class="name">option</span>&gt;</span>");</span></span><br><span class="line"><span class="xml">        	document.write("<span class="tag">&lt;<span class="name">option</span> <span class="attr">value</span>=<span class="string">''</span> <span class="attr">disabled</span>=<span class="string">'disabled'</span>&gt;</span>----<span class="tag">&lt;/<span class="name">option</span>&gt;</span>");</span></span><br><span class="line"><span class="undefined">        }</span></span><br><span class="line"><span class="xml">    	document.write("<span class="tag">&lt;<span class="name">option</span> <span class="attr">value</span>=<span class="string">'Vietnamese'</span>&gt;</span>Vietnamese<span class="tag">&lt;/<span class="name">option</span>&gt;</span>");</span></span><br><span class="line"><span class="xml">    	document.write("<span class="tag">&lt;<span class="name">option</span> <span class="attr">value</span>=<span class="string">'English'</span>&gt;</span>English<span class="tag">&lt;/<span class="name">option</span>&gt;</span>")   </span></span><br><span class="line"><span class="xml">    	document.write("<span class="tag">&lt;<span class="name">option</span> <span class="attr">value</span>=<span class="string">'Japanese'</span>&gt;</span>Japanese<span class="tag">&lt;/<span class="name">option</span>&gt;</span>");</span></span><br><span class="line"><span class="undefined">    </span><span class="tag">&lt;/<span class="name">script</span>&gt;</span></span><br><span class="line"><span class="tag">&lt;/<span class="name">select</span>&gt;</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <p>Đoạn code sẽ lấy URL của chính nó,xem có xuất hiện <strong>lang=</strong> hay không, nếu có sẽ tạo ra biến <strong>var lang</strong> là giá trị sau dấu = rồi gán nó cho 1 option value.<br>Nếu không xuất hiện thì xuất hiện 3 option khác.</p>
                <h2 id="Buoc-2-Khai-thac-loi"><a href="#Buoc-2-Khai-thac-loi" class="headerlink" title="Bước 2: Khai thác lỗi."></a>Bước 2: Khai thác lỗi.</h2>
                <p>Ta thấy biến <strong>lang</strong> được DOM dùng để tạo cấu trúc thẻ select ở đoạn code:</p>
                <blockquote>
                    <p>document.write(“<option value="" +lang+""="">“+decodeURIComponent(lang)+”</option>“);</p>
                </blockquote>
                <p>Giờ nếu ta truyền vào ABC thi giá trị của thẻ html được ghi ra là:</p>
                <blockquote>
                    <option value="ABC">ABC</option>
                </blockquote>
                <p>Lợi dụng điều này,ta chèn thẻ script vào:<br></p>
                <figure class="highlight html">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line">URL có dạng: lang=<span class="tag">&lt;<span class="name">script</span>&gt;</span><span class="undefined">alert(1)</span><span class="tag">&lt;/<span class="name">script</span>&gt;</span></span><br><span class="line">Thì thẻ option tạo ra có dạng, như sau:</span><br><span class="line"><span class="tag">&lt;<span class="name">option</span> <span class="attr">value</span>=<span class="string">'&lt;script&gt;alert(1)&lt;/script&gt;'</span>&gt;</span><span class="tag">&lt;<span class="name">script</span>&gt;</span><span class="undefined">alert(1)</span><span class="tag">&lt;/<span class="name">script</span>&gt;</span><span class="tag">&lt;/<span class="name">option</span>&gt;</span></span><br><span class="line">Đoạn code trong dấu '' thì không chạy được, nhưng ngoài thì chạy như là 1 đoạn script.</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <h2 id="Buoc-3-Loi-dung-DOM-XSS"><a href="#Buoc-3-Loi-dung-DOM-XSS" class="headerlink" title="Bước 3: Lợi dụng DOM XSS"></a>Bước 3: Lợi dụng DOM XSS</h2>
                <p>Có thể dùng DOM XSS vào các mục đích như:</p>
                <ul>
                    <li>Đánh cắp cookie như các dạng Reflected XSS và Stored XSS</li>
                    <li>Dùng DOM để thay đổi cấu trúc HTML, thêm vào các trường như password để đánh lừa người dùng (phishing).</li>
                </ul>
                <h1 id="Tham-khao"><a href="#Tham-khao" class="headerlink" title="Tham khảo"></a>Tham khảo</h1>
                <ul>
                    <li><strong>OWASP DOM BASED XSS</strong>: <a href="https://www.owasp.org/index.php/DOM_Based_XSS" target="_blank" rel="noopener">https://www.owasp.org/index.php/DOM_Based_XSS</a></li>
                    <li><strong>Netsparker</strong>: <a href="https://www.netsparker.com/blog/web-security/dom-based-cross-site-scripting-vulnerability/" target="_blank" rel="noopener">https://www.netsparker.com/blog/web-security/dom-based-cross-site-scripting-vulnerability/</a> </li>
                </ul>
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