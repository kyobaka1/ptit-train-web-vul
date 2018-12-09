<main class="main" role="main">
    <div class="content">
        <article id="post-xss/xss_phanloai" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    Phân Loại XSS
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a>
               <?php if($src_youtube != ''){echo '<button id="introduce-btn"><img src="public/images/play-circle.png" class="img-circle img-rotate" style="height: 24px; width: 24px; margin-right: 5px" " />Hướng Dẫn</button>';} ?>
                </div>
            </div>
            <?php echo get_iframe_youtube($src_youtube); ?>
            <div class="article-entry marked-body" itemprop="articleBody">
                <p>Trước đây, XSS chỉ được chia làm 2 dạng gồm <strong>Persistent</strong> và <strong>Non-persistent</strong>.<br>Vào năm 2005, người ta đã thêm vào một dạng tấn công khác, đó là DOM-based XSS.<br>Vậy XSS gồm có 3 dạng:</p>
                <ul>
                    <li>Persistent XSS (Stored XSS)</li>
                    <li>Non-persistent XSS (Reflected XSS)</li>
                    <li>DOM-Based XSS</li>
                </ul>
                <p>Ta cùng nghiên cứu lý thuyết của mỗi dạng ở đây, ta sẽ tìm hiểu sâu hơn trong từng bài. Ở đây,chỉ nói sơ qua về lý thuyết.</p>
                <h1 id="Non-Persistent-XSS"><a href="#Non-Persistent-XSS" class="headerlink" title="Non-Persistent XSS"></a>Non-Persistent XSS</h1>
                <p>Tên Non-Persistant có nghĩa là cuộc tấn công XSS này không dai dẳng,liên tục. Mà nó chỉ có ảnh hưởng thấp, và cần có sự tương tác của người dùng.<br>Còn có tên gọi khác là <strong>Reflected XSS</strong> (Reflected = Phản xạ) hay <strong>First-Order XSS</strong> (Không phổ biến)</p>
                <h2 id="Dac-diem"><a href="#Dac-diem" class="headerlink" title="Đặc điểm"></a>Đặc điểm</h2>
                <ul>
                    <li>Là loại tấn công thường thấy nhất của XSS (Chiếm khoảng 75% của XSS).</li>
                    <li>Thường tấn công dưới dạng input nằm ở URL (Biến GET).</li>
                    <li>Cần sự tương tác của victim. (Cần victim nhấn để truy cập URL đó)</li>
                </ul>
                <h2 id="Qua-trinh-tan-cong"><a href="#Qua-trinh-tan-cong" class="headerlink" title="Quá trình tấn công"></a>Quá trình tấn công</h2>
                <ol>
                    <li>
                        Hacker sẽ gửi URL có chứa mã độc cho victim. Tức là mã độc sẽ truyền vào dưới một input nào đó của website.
                        <blockquote>
                            <p>trusted.com?search=&lt;script&gt;alert(document.cookie)&lt;/script&gt;</p>
                        </blockquote>
                    </li>
                </ol>
                <p>Thông thường, URL sẽ được mã hoá sang các dạng khó đọc để nạn nhân khỏi nghi ngờ.</p>
                <ol start="2">
                    <li>Nạn nhân click vào URL có chứa mã độc =&gt; Gửi request đến Server với input là &lt;script&gt;alert(document.cookie)&lt;/script&gt;</li>
                    <li>Server gửi lại response có chứa mã độc của Hacker.</li>
                    <li>Máy của nạn nhân (trình duyệt) sẽ load và chạy các đoạn script mã độc. Gửi cookie hay làm bất cứ gì mà mã độc qui định.</li>
                </ol>
                <h1 id="Persistent-XSS"><a href="#Persistent-XSS" class="headerlink" title="Persistent XSS"></a>Persistent XSS</h1>
                <p><strong>Persistent</strong> có nghĩa là cuộc tấn công này xảy ra liên tục, có mức độ ảnh hưởng cao, đến nhiều người dùng.<br>Còn có tên gọi khác là <strong>Stored XSS</strong>.</p>
                <h2 id="Dac-diem-1"><a href="#Dac-diem-1" class="headerlink" title="Đặc điểm"></a>Đặc điểm</h2>
                <ul>
                    <li>Là dạng tấn công mà hacker chèn trực tiếp mã độc vào cơ sở dữ liệu của website thông qua các input của người dùng.</li>
                    <li>Dạng tấn công này xảy ra khi dữ liệu gửi lên không được kiểm tra kỹ lưỡng mà trực tiếp lưu vào CSDL.</li>
                    <li>Khi có người truy cập đúng website có những nơi truy xuất dữ liệu này ra, mã độc sẽ được gửi về trình duyệt người dùng để thực thi.</li>
                </ul>
                <h2 id="Qua-trinh-tan-cong-1"><a href="#Qua-trinh-tan-cong-1" class="headerlink" title="Quá trình tấn công"></a>Quá trình tấn công</h2>
                <ol>
                    <li>Hacker chèn các đoạn mã độc vào CSDL của Server.</li>
                    <li>Người dùng truy cập có sử dụng dữ liệu đó (Có chứa mã độc).</li>
                    <li>Server sẽ truy xuất,lấy nó trả về cho người dùng.</li>
                    <li>Máy tính của client sẽ thực hiện các nội dung của các đoạn mã độc đó, như gửi cookie, thông tin nhạy cảm về cho hacker..</li>
                </ol>
                <h1 id="DOM-Based-XSS"><a href="#DOM-Based-XSS" class="headerlink" title="DOM-Based XSS"></a>DOM-Based XSS</h1>
                <p>DOM-Based XSS là một dạng tấn công làm thay đổi cấu trúc trang web bằng cách thay đổi cấu trúc HTML.</p>
                <h2 id="DOM"><a href="#DOM" class="headerlink" title="DOM"></a>DOM</h2>
                <p>DOM là viết tắt của chữ <strong>Document Object Model</strong>, dịch tạm ra là mô hình các đối tượng trong tài liệu HTML. </p>
                <p>Như các bạn biết trong mỗi thẻ HTML sẽ có những thuộc tính (Properties) và có phân cấp cha - con với các thẻ HTML khác. Sự phân cấp và các thuộc tính của thẻ HTML này ta gọi là selector và trong DOM sẽ có nhiệm vụ xử lý các vấn đề như đổi thuộc tính của thẻ, đổi cấu trúc HTML của thẻ..</p>
                <h2 id="Dac-diem-2"><a href="#Dac-diem-2" class="headerlink" title="Đặc điểm"></a>Đặc điểm</h2>
                <ul>
                    <li>Đối với dạng tấn công này, hacker sẽ chèn các đoạn script nhằm làm thay đổi giao diện mặc định của trang web thành một giao diện giả bằng DOM, ví dụ thêm form đăng nhập để đánh cắp thông tin như mật khẩu của người dùng. (Phishing)</li>
                    <li>Nó là biến thể của Persitent XSS và Non-Persitent XSS.</li>
                </ul>
                <h2 id="Qua-trinh-tan-cong-2"><a href="#Qua-trinh-tan-cong-2" class="headerlink" title="Quá trình tấn công"></a>Quá trình tấn công</h2>
                <p>Ví dụ,ta có một trang web như sau:<br></p>
                <figure class="highlight php">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line">&lt;html&gt;</span><br><span class="line">&lt;p id=<span class="string">"hello"</span>&gt;</span><br><span class="line"><span class="meta">&lt;?php</span> <span class="keyword">if</span>(<span class="keyword">isset</span>($_GET[<span class="string">'name'</span>])) <span class="keyword">echo</span> <span class="string">"Hello "</span>.$_GET[<span class="string">'name'</span>]; <span class="meta">?&gt;</span></span><br><span class="line">&lt;/p&gt;</span><br><span class="line">&lt;/html&gt;</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <p>Tức là nếu có input tên người dùng,thì sẽ in ra: <strong>Hello người dùng</strong><br>Được truyền thông qua URL:</p>
                <blockquote>
                    <p>trusted.com?name=Vuong</p>
                </blockquote>
                <p>Attacker sẽ gửi URL sau cho nạn nhân:<br></p>
                <figure class="highlight html">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line">trusted.com?name=<span class="tag">&lt;<span class="name">script</span>&gt;</span><span class="xml">document.getElementById('hello').innerHTML="<span class="tag">&lt;<span class="name">p</span>&gt;</span>Vui lòng nhập mật khẩu: <span class="tag">&lt;/<span class="name">p</span>&gt;</span><span class="tag">&lt;<span class="name">input</span> <span class="attr">type</span>=<span class="string">'password'</span>/&gt;</span><span class="tag">&lt;<span class="name">;button</span> <span class="attr">onclick</span>=<span class="string">'sendToAttacker()'</span>&gt;</span>Submit<span class="tag">&lt;/<span class="name">button</span>&gt;</span>";</span><span class="tag">&lt;/<span class="name">script</span>&gt;</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <p>Nội dung trang web sẽ bị thay đổi, bạn sẽ có cơ hội thực hành rõ hơn khi vào từng bài.</p>
                <h1 id="Tham-khao"><a href="#Tham-khao" class="headerlink" title="Tham khảo"></a>Tham khảo</h1>
                <ul>
                    <li><strong>ACUNETIX</strong>: <a href="https://www.acunetix.com/blog/articles/persistent-xss/" target="_blank" rel="noopener">https://www.acunetix.com/blog/articles/persistent-xss/</a></li>
                    <li><strong>BLOG CỦA PASSIONERY:</strong> <a href="https://passionery.blogspot.com/2014/05/cross-site-scripting-xss-la-gi.html" target="_blank" rel="noopener">https://passionery.blogspot.com/2014/05/cross-site-scripting-xss-la-gi.html</a></li>
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
    </div>

</main>