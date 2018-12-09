<main class="main" role="main">
    <div class="content">
        <article id="post-xxe/xml" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    Tổng Quan Về XML
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a>
                    <?php if($src_youtube != ''){echo '<button id="introduce-btn"><img src="public/images/play-circle.png" class="img-circle img-rotate" style="height: 24px; width: 24px; margin-right: 5px" " />Hướng Dẫn</button>';} ?>
                </div>
            </div>
            <?php echo get_iframe_youtube($src_youtube); ?>
            <div class="article-entry marked-body" itemprop="articleBody">
                <p>Có lẽ nhiều bạn chưa có cơ hội tiếp xúc và làm việc với xml nhiều. Cho nên trong bài này, mình sẽ nói về kiến thức về XML.</p>
                <h1 id="XML-la-gi"><a href="#XML-la-gi" class="headerlink" title="XML là gì?"></a>XML là gì?</h1>
                <p><strong>XML</strong> (Extensible Markup Language) tức là “ngôn ngữ đánh dấu mở rộng”, nó là ngôn ngữ đánh dấu với mục đích chung do W3C đề nghị,để tạo ra các ngôn ngữ đánh dấu khác.</p>
                <p>HTML cũng là ngôn ngữ đánh dấu, ngôn ngữ này sẽ dùng các thẻ để đánh dấu và định dạng dữ liệu.</p>
                <h2 id="Muc-dich"><a href="#Muc-dich" class="headerlink" title="Mục đích"></a>Mục đích</h2>
                <p>Mục đích của XML là đơn giản hoá việc chia sẻ dữ liệu giữa các hệ thống khác nhau, đặc biệt là trên Internet.<br>Các ngôn ngữ dựa trên XML, ví dụ như:</p>
                <ul>
                    <li>RDF</li>
                    <li>RSS</li>
                    <li>MathML</li>
                    <li>XHTML</li>
                    <li>SVG</li>
                    <li>GML</li>
                    <li>cXML</li>
                </ul>
                <p>Chúng được định nghĩa theo cách thông thường,cho phép các chương trình sửa đổi và kiểm tra hợp lệ bằng các ngôn ngữ mà không cần có sự hiểu biết trước về hình thức của chúng.</p>
                <h2 id="Tom-lai"><a href="#Tom-lai" class="headerlink" title="Tóm lại"></a>Tóm lại</h2>
                <p>XML là ngôn ngữ đánh dấu, kiểu text, có thể định dạng được dữ liệu, mục đích là để trao đổi dễ dàng trên mạng, để các hệ thống khác nhau có thể hiểu nhau</p>
                <h2 id="Vi-du"><a href="#Vi-du" class="headerlink" title="Ví dụ"></a>Ví dụ</h2>
                <figure class="highlight xml">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="php"><span class="meta">&lt;?</span>xml version=<span class="string">"1.0"</span> encoding=<span class="string">"UTF-8"</span><span class="meta">?&gt;</span></span></span><br><span class="line"><span class="tag">&lt;<span class="name">SinhVien</span>&gt;</span></span><br><span class="line">	<span class="tag">&lt;<span class="name">hoten</span>&gt;</span>DoanNgocVuong<span class="tag">&lt;/<span class="name">hoten</span>&gt;</span></span><br><span class="line">	<span class="tag">&lt;<span class="name">nganh</span>&gt;</span>D14-ATTT<span class="tag">&lt;/<span class="name">nganh</span>&gt;</span></span><br><span class="line"><span class="tag">&lt;/<span class="name">SinhVien</span>&gt;</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <h2 id="Tim-hieu-them"><a href="#Tim-hieu-them" class="headerlink" title="Tìm hiểu thêm:"></a>Tìm hiểu thêm:</h2>
                <ul>
                    <li><strong>WIKI</strong>: <a href="https://vi.wikipedia.org/wiki/XML" target="_blank" rel="noopener">https://vi.wikipedia.org/wiki/XML</a></li>
                </ul>
                <h1 id="Dinh-dang-XML"><a href="#Dinh-dang-XML" class="headerlink" title="Định dạng XML"></a>Định dạng XML</h1>
                <p>Định dạng của tài liệu XML được khai báo bởi một trong khai:</p>
                <ul>
                    <li>Document Type Definition (DTD)</li>
                    <li>XML Schema</li>
                </ul>
                <p>Một tài liệu XML là:</p>
                <ul>
                    <li><strong>Hợp lệ</strong> nếu như tài liệu đó tuân thủ theo qui tắc của file XML.</li>
                    <li><strong>Có hiệu lực</strong> (valid) nếu như tài liệu đó tuân thủ theo DTD hay XML Schema.</li>
                </ul>
                <h2 id="DTD"><a href="#DTD" class="headerlink" title="DTD"></a>DTD</h2>
                <p><strong>Document Type Definition</strong> (DTD) là một tập hợp các thẻ khai báo (đánh dấu) để xác định cấu trúc cho gôn ngữ đánh dấu như: SGML, XML, HTML.<br>DTD là một tiền thân của lược đồ XML Schema, có chức năng tương tự.</p>
                <p>DTD sử dụng cú pháp khai báo chính xác những yếu tố và tài liệu tham khảo có thể xuất hiện ở đâu trong tài liệu XML.<br>Ngoài ra DTD cũng khai báo <strong>các thực thể (Entity)</strong> có thể sử dụng trong tài liệu XML.</p>
                <h3 id="Tai-sao-can-DTD"><a href="#Tai-sao-can-DTD" class="headerlink" title="Tại sao cần DTD?"></a>Tại sao cần DTD?</h3>
                <ul>
                    <li>Với một DTD, mỗi tập tin XML có thể thực hiện 1 mô tả theo định dạng riêng của bạn.</li>
                    <li>Trong một nhóm,có thể đồng ý sử dụng 1 DTD tiêu chuẩn cho việc trao đổi dữ liệu. (Xác định mẫu tiêu chuẩn)</li>
                    <li>Có thể dùng 1 tiêu chuẩn DTD để xác minh rằng dữ liệu bạn nhận được từ bên ngoài là hợp lệ</li>
                    <li>Sử dụng DTD để xác minh dữ liệu riêng của bạn.</li>
                </ul>
                <h3 id="Vi-du-1"><a href="#Vi-du-1" class="headerlink" title="Ví dụ"></a>Ví dụ</h3>
                <p><strong>File DTD: example.dtd</strong><br></p>
                <figure class="highlight xml">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="php"><span class="meta">&lt;?</span>xml version=<span class="string">"1.0"</span> encoding=<span class="string">"UTF-8"</span><span class="meta">?&gt;</span></span></span><br><span class="line"><span class="tag">&lt;<span class="name">!ELEMENT</span> <span class="attr">account</span> (#<span class="attr">PCDATA</span>)&gt;</span></span><br><span class="line"><span class="tag">&lt;<span class="name">!ELEMENT</span> <span class="attr">contact</span> (#<span class="attr">PCDATA</span>)&gt;</span></span><br><span class="line"><span class="tag">&lt;<span class="name">!ELEMENT</span> <span class="attr">count</span> (#<span class="attr">PCDATA</span>)&gt;</span></span><br><span class="line"><span class="tag">&lt;<span class="name">!ELEMENT</span> <span class="attr">order</span> (<span class="attr">product</span>, <span class="attr">count</span>, <span class="attr">orderer</span>)&gt;</span></span><br><span class="line"><span class="tag">&lt;<span class="name">!ELEMENT</span> <span class="attr">orderer</span> (<span class="attr">contact</span>, <span class="attr">account</span>)&gt;</span></span><br><span class="line"><span class="tag">&lt;<span class="name">!ELEMENT</span> <span class="attr">product</span> (#<span class="attr">PCDATA</span>)&gt;</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <p><strong>File XML sử dụng DTD này</strong><br></p>
                <figure class="highlight xml">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br><span class="line">8</span><br><span class="line">9</span><br><span class="line">10</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="php"><span class="meta">&lt;?</span>xml version=<span class="string">"1.0"</span> encoding=<span class="string">"UTF-8"</span><span class="meta">?&gt;</span></span></span><br><span class="line"><span class="meta">&lt;!DOCTYPE order SYSTEM "example.dtd"&gt;</span></span><br><span class="line"><span class="tag">&lt;<span class="name">order</span>&gt;</span></span><br><span class="line"><span class="tag">&lt;<span class="name">product</span>&gt;</span>1234<span class="tag">&lt;/<span class="name">product</span>&gt;</span></span><br><span class="line"><span class="tag">&lt;<span class="name">count</span>&gt;</span>1<span class="tag">&lt;/<span class="name">count</span>&gt;</span></span><br><span class="line"><span class="tag">&lt;<span class="name">orderer</span>&gt;</span></span><br><span class="line"><span class="tag">&lt;<span class="name">contact</span>&gt;</span>Jan P. Monsch<span class="tag">&lt;/<span class="name">contact</span>&gt;</span></span><br><span class="line"><span class="tag">&lt;<span class="name">account</span>&gt;</span>789<span class="tag">&lt;/<span class="name">account</span>&gt;</span></span><br><span class="line"><span class="tag">&lt;/<span class="name">orderer</span>&gt;</span></span><br><span class="line"><span class="tag">&lt;/<span class="name">order</span>&gt;</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <h2 id="XML-Schema-I"><a href="#XML-Schema-I" class="headerlink" title="XML Schema I"></a>XML Schema I</h2>
                <p>Tuy đã có DTD, nhưng vì DTD còn nhiều hạn chế như:</p>
                <ul>
                    <li>Không có nhiều dạng kiểu dữ liệu</li>
                    <li>Không có qui định được khoảng giá trị..</li>
                </ul>
                <p>Do đó XML Schema được tạo nên, nó kế thừa các chức năng từ DTD và đồng thời có thêm nhiều tiện ích thêm.<br><strong>XML Schema</strong> được viết theo cấu trúc XML nên dễ học và quen thuộc hơn.</p>
                <h3 id="Hoc-them-ve-XML-Schema"><a href="#Hoc-them-ve-XML-Schema" class="headerlink" title="Học thêm về XML Schema:"></a>Học thêm về XML Schema:</h3>
                <ul>
                    <li><strong>W3SCHOOL</strong>: <a href="https://www.w3schools.com/xml/schema_intro.asp" target="_blank" rel="noopener">https://www.w3schools.com/xml/schema_intro.asp</a></li>
                    <li><strong>WIKI</strong>: <a href="https://en.wikipedia.org/wiki/XML_schema" target="_blank" rel="noopener">https://en.wikipedia.org/wiki/XML_schema</a></li>
                </ul>
                <h3 id="Vi-du-2"><a href="#Vi-du-2" class="headerlink" title="Ví dụ"></a>Ví dụ</h3>
                <p><strong>File XML Schema: example.xsd</strong><br></p>
                <figure class="highlight xml">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br><span class="line">8</span><br><span class="line">9</span><br><span class="line">10</span><br><span class="line">11</span><br><span class="line">12</span><br><span class="line">13</span><br><span class="line">14</span><br><span class="line">15</span><br><span class="line">16</span><br><span class="line">17</span><br><span class="line">18</span><br><span class="line">19</span><br><span class="line">20</span><br><span class="line">21</span><br><span class="line">22</span><br><span class="line">23</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="php"><span class="meta">&lt;?</span>xml version=<span class="string">"1.0"</span> encoding=<span class="string">"UTF-8"</span><span class="meta">?&gt;</span></span></span><br><span class="line"><span class="tag">&lt;<span class="name">xs:schema</span> <span class="attr">elementFormDefault</span>=<span class="string">"qualified"</span></span></span><br><span class="line"><span class="tag"><span class="attr">xmlns:xs</span>=<span class="string">"http://www.w3.org/2001/XMLSchema"</span>&gt;</span></span><br><span class="line"><span class="tag">&lt;<span class="name">xs:element</span> <span class="attr">name</span>=<span class="string">"account"</span> <span class="attr">type</span>=<span class="string">"xs:short"</span>/&gt;</span></span><br><span class="line"><span class="tag">&lt;<span class="name">xs:element</span> <span class="attr">name</span>=<span class="string">"contact"</span> <span class="attr">type</span>=<span class="string">"xs:string"</span>/&gt;</span></span><br><span class="line"><span class="tag">&lt;<span class="name">xs:element</span> <span class="attr">name</span>=<span class="string">"count"</span> <span class="attr">type</span>=<span class="string">"xs:boolean"</span>/&gt;</span></span><br><span class="line"><span class="tag">&lt;<span class="name">xs:element</span> <span class="attr">name</span>=<span class="string">"order"</span>&gt;</span></span><br><span class="line"><span class="tag">&lt;<span class="name">xs:complexType</span>&gt;</span></span><br><span class="line"><span class="tag">&lt;<span class="name">xs:sequence</span>&gt;</span></span><br><span class="line"><span class="tag">&lt;<span class="name">xs:element</span> <span class="attr">ref</span>=<span class="string">"product"</span>/&gt;</span></span><br><span class="line"><span class="tag">&lt;<span class="name">xs:element</span> <span class="attr">ref</span>=<span class="string">"count"</span>/&gt;</span></span><br><span class="line"><span class="tag">&lt;<span class="name">xs:element</span> <span class="attr">name</span>=<span class="string">"orderer"</span> <span class="attr">type</span>=<span class="string">"ordererType"</span>/&gt;</span></span><br><span class="line"><span class="tag">&lt;/<span class="name">xs:sequence</span>&gt;</span></span><br><span class="line"><span class="tag">&lt;/<span class="name">xs:complexType</span>&gt;</span></span><br><span class="line"><span class="tag">&lt;/<span class="name">xs:element</span>&gt;</span></span><br><span class="line"><span class="tag">&lt;<span class="name">xs:complexType</span> <span class="attr">name</span>=<span class="string">"ordererType"</span>&gt;</span></span><br><span class="line"><span class="tag">&lt;<span class="name">xs:sequence</span>&gt;</span></span><br><span class="line"><span class="tag">&lt;<span class="name">xs:element</span> <span class="attr">ref</span>=<span class="string">"contact"</span>/&gt;</span></span><br><span class="line"><span class="tag">&lt;<span class="name">xs:element</span> <span class="attr">ref</span>=<span class="string">"account"</span>/&gt;</span></span><br><span class="line"><span class="tag">&lt;/<span class="name">xs:sequence</span>&gt;</span></span><br><span class="line"><span class="tag">&lt;/<span class="name">xs:complexType</span>&gt;</span></span><br><span class="line"><span class="tag">&lt;<span class="name">xs:element</span> <span class="attr">name</span>=<span class="string">"product"</span> <span class="attr">type</span>=<span class="string">"xs:short"</span>/&gt;</span></span><br><span class="line"><span class="tag">&lt;/<span class="name">xs:schema</span>&gt;</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <p><strong>File XML dùng XML Schema đó</strong><br></p>
                <figure class="highlight xml">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br><span class="line">8</span><br><span class="line">9</span><br><span class="line">10</span><br><span class="line">11</span><br><span class="line">12</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="php"><span class="meta">&lt;?</span>xml version=<span class="string">"1.0"</span> encoding=<span class="string">"UTF-8"</span><span class="meta">?&gt;</span></span></span><br><span class="line"><span class="tag">&lt;<span class="name">order</span></span></span><br><span class="line"><span class="tag"><span class="attr">xmlns:xsi</span>=<span class="string">http://www.w3.org/2001/XMLSchema...</span></span></span><br><span class="line"><span class="tag"><span class="attr">xsi:noNamespaceSchemaLocation</span>=<span class="string">"order.xsd"</span></span></span><br><span class="line"><span class="tag">&gt;</span></span><br><span class="line"><span class="tag">&lt;<span class="name">product</span>&gt;</span>1234<span class="tag">&lt;/<span class="name">product</span>&gt;</span></span><br><span class="line"><span class="tag">&lt;<span class="name">count</span>&gt;</span>1<span class="tag">&lt;/<span class="name">count</span>&gt;</span></span><br><span class="line"><span class="tag">&lt;<span class="name">orderer</span>&gt;</span></span><br><span class="line"><span class="tag">&lt;<span class="name">contact</span>&gt;</span>Jan P. Monsch<span class="tag">&lt;/<span class="name">contact</span>&gt;</span></span><br><span class="line"><span class="tag">&lt;<span class="name">account</span>&gt;</span>789<span class="tag">&lt;/<span class="name">account</span>&gt;</span></span><br><span class="line"><span class="tag">&lt;/<span class="name">orderer</span>&gt;</span></span><br><span class="line"><span class="tag">&lt;/<span class="name">order</span>&gt;</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
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