<main class="main has-sticky" role="main">
    <div class="content">
        <article id="post-sqli_phanloai" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    [SQLI] Phân loại SQL Injection
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a>
                    <?php if($src_youtube != ''){echo '<button id="introduce-btn"><img src="public/images/play-circle.png" class="img-circle img-rotate" style="height: 24px; width: 24px; margin-right: 5px" " />Hướng Dẫn</button>';} ?>
                </div>
            </div>
            <?php echo get_iframe_youtube($src_youtube); ?>
            <div class="article-entry marked-body" itemprop="articleBody">
                <p>Dựa vào các quan điểm/tiêu chí khác nhau thì cách phân loại SQL Injection khác nhau.<br>Để hiểu rõ hơn về các loại SQL Injection, mình đã phân loại theo nhiều loại tiêu chí và nêu ra các ví dụ tương ứng.</p>
                <h1 id="1-Dua-tren-kenh-truy-xuat-du-lieu"><a href="#1-Dua-tren-kenh-truy-xuat-du-lieu" class="headerlink" title="1. Dựa trên kênh truy xuất dữ liệu"></a>1. Dựa trên kênh truy xuất dữ liệu</h1>
                <h2 id="Inband-or-inline-Classic-SQLi"><a href="#Inband-or-inline-Classic-SQLi" class="headerlink" title="Inband or inline (Classic SQLi)"></a>Inband or inline (Classic SQLi)</h2>
                <p>Là loại tấn công SQLi phổ biến nhất hiện nay và cũng rất dễ dàng để thực hiện một cuộc tấn công.<br>Inband SQLi diễn ra khi kể tấn công có thể sử dụng một kênh truyền thông để khởi động tấn công và thu thập kết quả.<br>Hai loại tấn công phổ biến nhất của Inband SQLi là Error-based SQLi và Union-based SQLi. (Giới thiệu ở phần sau)<br></p>
                <figure class="highlight sql">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br><span class="line">8</span><br><span class="line">9</span><br><span class="line">10</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"># Ứng dụng web có chức năng hiển thị thông tin của một sản phẩm với ID do người dùng cung cấp.</span><br><span class="line"># URL: https://sanpham.com?id=1  &lt;&lt; Kênh truyền thông để khởi động tấn công.</span><br><span class="line"># Câu SQL Query của truy vấn này thông thường sẽ là:</span><br><span class="line"><span class="keyword">SELECT</span> ten,gia <span class="keyword">FROM</span> sanpham <span class="keyword">WHERE</span> <span class="keyword">id</span>=<span class="number">1</span></span><br><span class="line"># Hacker cung cấp <span class="keyword">id</span>= <span class="number">-1</span> <span class="keyword">UNION</span> <span class="keyword">SELECT</span> <span class="number">1</span>,@@<span class="keyword">version</span></span><br><span class="line"># Câu truy vấn sẽ trở thành:</span><br><span class="line"><span class="keyword">SELECT</span> ten,gia <span class="keyword">FROM</span> sanpham <span class="keyword">WHERE</span> <span class="keyword">id</span> = <span class="number">-1</span> <span class="keyword">UNION</span> <span class="keyword">SELECT</span> <span class="number">1</span>,@@<span class="keyword">version</span></span><br><span class="line"># Kết quả của câu <span class="keyword">SELECT</span> đầu tiên là <span class="literal">null</span>, kết quả của câu truy vấn sau là (<span class="number">1</span>, phiên bản của hệ quản trị CSDL).</span><br><span class="line"># Sau đó số <span class="number">1</span> sẽ hiển thị ra nơi mà bình thường hiển thị ten   &lt;&lt;Kênh thu thập kết quả.</span><br><span class="line"># Phiên bản sẽ hiển thị ra nơi mà bình thường hiển thị gia     &lt;&lt;Kênh thu thập kết quả.</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <h2 id="Out-of-band-SQli"><a href="#Out-of-band-SQli" class="headerlink" title="Out-of-band SQli"></a>Out-of-band SQli</h2>
                <p>Là loại tấn công không phải rất phổ biến,chủ yếu bởi vì nó phụ thuộc vào các tính năng được bật và sử dụng trên hệ quản trị CSDL của máy chủ website.<br>Out-of-band SQLi diễn ra khi kẻ tấn công không thể sử dụng cùng một kênh để khởi động tấn công và thu thập kết quả.<br>Kỹ thuật out-of-band cung cấp cho kẻ tấn công một giải pháp thay thế cho kĩ thuật time-based SQLi, đặc biệt nếu thời gian trả về của máy chủ không ổn định (Làm cho cuộc tấn công time-based trở nên không đáng tin).<br>Kỹ thuật này sẽ dựa vào khả năng của máy chủ CSDL để tạo DNS hoặc HTTP requests để gửi dữ liệu đến cho kẻ tấn công.<br></p>
                <figure class="highlight plain">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line">SQL Server</span><br><span class="line">Như trong trường hợp của Microsoft SQL Server là xp_dirtree command, nơi mà có thể tạo DNS requests tới server của kẻ tấn công.</span><br><span class="line"></span><br><span class="line">Oracle Database's</span><br><span class="line">Sử dụng UTL_HTTP package, để có thể gửi HTTP request từ SQL và PL/SQL tới server của kẻ tấn công.</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <h1 id="2-Dua-tren-su-phan-hoi-nhan-duoc-tu-may-chu"><a href="#2-Dua-tren-su-phan-hoi-nhan-duoc-tu-may-chu" class="headerlink" title="2.Dựa trên sự phản hồi nhận được từ máy chủ"></a>2.Dựa trên sự phản hồi nhận được từ máy chủ</h1>
                <h2 id="Error-based-SQLi"><a href="#Error-based-SQLi" class="headerlink" title="Error-based SQLi"></a>Error-based SQLi</h2>
                <p>Là loại SQLi diễn ra khi ứng dụng website hiển thị lỗi SQL cho người dùng (người tấn công).<br>Trên các hệ quản trị CSDL hầu như đều cung cấp chức năng hiển thị lỗi để các nhà phát triển (Dev) có thể dễ dàng xây dựng ứng dụng của họ. Hacker có thể dựa vào những lỗi này để liệt kê ra hết CSDL của ứng dụng.<br></p>
                <figure class="highlight plain">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line">SQL SERVER</span><br><span class="line">Thực hiện câu query:</span><br><span class="line">SELECT CAST(database() AS INT)</span><br><span class="line">SQL SERVER sẽ hiện thông báo về không thể chuyển 'abcxyzDatabase' tới kiểu INT. =&gt; Lấy được tên database.</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <h2 id="Union-based-SQLi"><a href="#Union-based-SQLi" class="headerlink" title="Union-based SQLi"></a>Union-based SQLi</h2>
                <p>Là loại SQLi sử dụng cơ chế của hàm UNION trong cơ sở dữ liệu để kết hợp kết quả hai hoặc nhiều câu truy vấn,sau đó nhận kết quả trả về từ sự của máy chủ (HTTP). Là loại tấn công rất thông dụng của SQLi.<br></p>
                <figure class="highlight plain">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br><span class="line">8</span><br><span class="line">9</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"># Hiểu thêm về UNION</span><br><span class="line">SELECT ten,tuoi FROM user WHERE id=1 -- KẾT QUẢ: vuong,18</span><br><span class="line">SELECT 1,version() -- KẾT QUẢ: 1,13.05</span><br><span class="line">SELECT ten,tuoi FROM user WHERE id=1 UNION SELECT 1,version() -- KẾT QUẢ: { (vuong,18), (1,version()) }</span><br><span class="line"># Cách sử dụng.</span><br><span class="line"># Câu truy vấn đầu tiên chỉ cần cung cấp id=null -- KẾT QUẢ: null,null</span><br><span class="line"># Câu truy vấn thứ hai giữ nguyên</span><br><span class="line"># =&gt; 1 sẽ hiển thị tại vị trí ten</span><br><span class="line"># =&gt; version() sẽ hiển thị tại vị trí tuoi</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <h2 id="Blind-SQLi"><a href="#Blind-SQLi" class="headerlink" title="Blind SQLi"></a>Blind SQLi</h2>
                <p>Khi mà dữ liệu truy xuất ra không được hiển thị cho người dùng, nhưng câu truy vấn vẫn được thực thi trong CSDL thì kĩ thuật Blind SQLi được sử dụng.<br>Blind SQLi là kiểu tấn công mù (không nhìn thấy gì) dựa vào thay đổi cấu trúc câu truy vấn để đặt nghi vấn rồi từ phân tích hành vi của ứng dụng web, hành vi trả về kết quả của CSDL mà xác thực nghi vấn chính xác hay không.<br>Có hai loại Blind SQLi phổ biến là: Boolean Blind (Dựa vào tính đúng sai) và Timebased Blind (Dựa vào thời gian trả về).<br></p>
                <figure class="highlight php">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"># Ví dụ sẽ nói về kiểu Boolean Blind.</span><br><span class="line">SELECT * FROM users WHERE id=1 and 1=1 -- Kết quả trả về sẽ là admin,123</span><br><span class="line">SELECT * FROM users WHERE id=1 and 1=0 -- Kết quả trả về sẽ là 0(NULL), bởi vì 1=0 là False. True and False = False.</span><br><span class="line"># Dựa vào nguyên lí này, ta sẽ đặt điều kiện thử ở vế sau, nếu trả về admin,123 =&gt; điều kiện đúng. Ngược lại là sai.</span><br><span class="line">SELECT * FROM users WHERE id=1 and LENGTH((version()))=10 (Thử từ 1-&gt;100)</span><br><span class="line"># Kết quả trả về nếu là admin,123 =&gt; Đúng. Ta biết được ngay độ dài của version() là 10.</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <p>Công việc khai thác Blind SQLi thường phải xây dựng công cụ.</p>
                <h1 id="3-Dua-tren-du-lieu-dau-vao-duoc-xu-ly-kieu-du-lieu"><a href="#3-Dua-tren-du-lieu-dau-vao-duoc-xu-ly-kieu-du-lieu" class="headerlink" title="3. Dựa trên dữ liệu đầu vào được xử lý (kiểu dữ liệu)"></a>3. Dựa trên dữ liệu đầu vào được xử lý (kiểu dữ liệu)</h1>
                <h2 id="String"><a href="#String" class="headerlink" title="String"></a>String</h2>
                <p>Nếu ở câu query chấp nhận chuỗi String. Thì nó luộc loại này.</p>
                <h2 id="Numberic"><a href="#Numberic" class="headerlink" title="Numberic"></a>Numberic</h2>
                <p>Trong một số trường hợp, câu query chỉ chấp nhận đối số đầu vào là số. Ví dụ như ID Number, Salary thì kẻ tấn công sẽ sử dụng kiểu tấn công này.</p>
                <h1 id="4-Dua-tren-muc-thu-tu-bi-inject"><a href="#4-Dua-tren-muc-thu-tu-bi-inject" class="headerlink" title="4. Dựa trên mức/thứ tự bị inject"></a>4. Dựa trên mức/thứ tự bị inject</h1>
                <h2 id="First-order-injections"><a href="#First-order-injections" class="headerlink" title="First-order injections"></a>First-order injections</h2>
                <p>Kẻ tấn công đơn giản chỉ là tiêm vào câu query để thực hiện luôn. Hầu như các trường hợp phía trên là First-order SQLi.</p>
                <h2 id="Second-order-injections"><a href="#Second-order-injections" class="headerlink" title="Second-order injections"></a>Second-order injections</h2>
                <p>Kể tấn công phải tiệm mã độc vào đối tượng lưu trữ của server, như là Table. Sau đó cuộc tấn công sẽ được thực thi với một hoạt động khác.<br></p>
                <figure class="highlight sql">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"># Ví dụ như có chức năng đăng kí, với câu truy vấn:</span><br><span class="line"><span class="keyword">INSERT</span> <span class="keyword">INTO</span> <span class="keyword">users</span>(ten,tuoi) <span class="keyword">VALUES</span>(username,<span class="keyword">password</span>)</span><br><span class="line"># Hacker cung cấp username=abc,(<span class="keyword">select</span> <span class="keyword">version</span>()) ) <span class="comment">-- - và password=whatever. Câu truy vấn trở thành:</span></span><br><span class="line"><span class="keyword">INSERT</span> <span class="keyword">INTO</span> <span class="keyword">users</span>(ten,tuoi) <span class="keyword">VALUES</span>(abc,(<span class="keyword">select</span> <span class="keyword">version</span>()) ) <span class="comment">-- - whatever)</span></span><br><span class="line"># Câu truy vấn trên chỉ inject được <span class="keyword">select</span> <span class="keyword">version</span>() vào database.</span><br><span class="line"># Nhưng sau đó, có chức năng xem thông tin: <span class="keyword">SELECT</span> * <span class="keyword">FROM</span> <span class="keyword">users</span> <span class="keyword">WHERE</span> ten=abc</span><br><span class="line"># Khi đó câu truy vấn <span class="keyword">select</span> <span class="keyword">version</span>() sẽ được thực hiện =&gt; tuoi. Đó là <span class="keyword">second</span>-<span class="keyword">order</span> SQLi</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <h1 id="5-Dua-tren-diem-bi-inject"><a href="#5-Dua-tren-diem-bi-inject" class="headerlink" title="5. Dựa trên điểm bị inject"></a>5. Dựa trên điểm bị inject</h1>
                <h2 id="Injection-through-user-input-form-fields"><a href="#Injection-through-user-input-form-fields" class="headerlink" title="Injection through user input form fields."></a>Injection through user input form fields.</h2>
                <p>Người như tên.</p>
                <h2 id="Injection-through-cookies"><a href="#Injection-through-cookies" class="headerlink" title="Injection through cookies."></a>Injection through cookies.</h2>
                <p>Một số ứng dụng, nhà phát triển lấy thông tin từ cookies và xử lý với CSDL. Khi đó,hacker sẽ lợi dụng điều này.</p>
                <h2 id="Injection-through-server-variables-Headers-based-injections"><a href="#Injection-through-server-variables-Headers-based-injections" class="headerlink" title="Injection through server variables. (Headers-based injections)"></a>Injection through server variables. (Headers-based injections)</h2>
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