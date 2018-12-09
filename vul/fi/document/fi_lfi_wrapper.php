<main class="main has-sticky" role="main">
    <div class="content">
        <article id="post-fi/lfi_wrapper" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    LFI Thông Qua Wrapper
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a>
               <?php if($src_youtube != ''){echo '<button id="introduce-btn"><img src="public/images/play-circle.png" class="img-circle img-rotate" style="height: 24px; width: 24px; margin-right: 5px" " />Hướng Dẫn</button>';} ?>
                </div>
            </div>
            <?php echo get_iframe_youtube($src_youtube); ?>
            <div class="article-entry marked-body" itemprop="articleBody">
                <h1 id="PHP-Wrapper"><a href="#PHP-Wrapper" class="headerlink" title="PHP Wrapper"></a>PHP Wrapper</h1>
                <p>Một PHP Wrapper là một thuật ngữ được định nghĩa cho việc “code bao quanh mã code khác”.<br>Nó có thể hiểu như một class, một function… Nó không phải là một cái gì đó cụ thể.<br>Nó bao quanh code khác, và thực thi một số các chức năng cơ bản trước khi code được bao quanh của nó thực thi.</p>
                <h2 id="Vi-du"><a href="#Vi-du" class="headerlink" title="Ví dụ"></a>Ví dụ</h2>
                <p>Vì PHP Wrapper là một định nghĩa trừu tượng, nên khó hiểu trong lý thuyết. Nên mình sẽ lấy một ví dụ cơ bản,giống như php wrapper.<br></p>
                <figure class="highlight php">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="function"><span class="keyword">function</span> <span class="title">getName</span><span class="params">()</span></span></span><br><span class="line"><span class="function"></span>{</span><br><span class="line">	getAnimal(<span class="string">'whales'</span>);</span><br><span class="line">}</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <p>Thì các bạn có thể nói getName là một wrapper của function getAnimal.</p>
                <h1 id="php-filter"><a href="#php-filter" class="headerlink" title="php://filter/"></a>php://filter/</h1>
                <h2 id="php-filter-read"><a href="#php-filter-read" class="headerlink" title="php://filter/read"></a>php://filter/read</h2>
                <ul>
                    <li>Controllable functon: include</li>
                    <li>Allow_url_include: Off</li>
                    <li>Vulnerabitity type: File Disclosure</li>
                    <li>Example: php://filter/read=covert.base64-encode/resource=index.php</li>
                </ul>
                <p>Chức năng của nó là để encode sang định dạng khác.</p>
                <h3 id="Lo-LFI-file-PHP-lam-sao-doc-duoc"><a href="#Lo-LFI-file-PHP-lam-sao-doc-duoc" class="headerlink" title="Lỡ LFI file PHP làm sao đọc được?"></a>Lỡ LFI file PHP làm sao đọc được?</h3>
                <p>File PHP chắc sẽ contain trong thẻ &lt;?php ?&gt; luôn rồi. Nên việc bạn LFI vào và đọc code là việc không thể, bởi vì nó sẽ chạy luôn mà. Chứ ko phải là text để hiển thị ra đâu.<br>Nên ta áp dụng php://filter/read để encode sang base64 chẳng hạn để nó không phải là code PHP nữa, nó sẽ là dạng text base64. </p>
                <h2 id="php-filter-write"><a href="#php-filter-write" class="headerlink" title="php://filter/write"></a>php://filter/write</h2>
                <ul>
                    <li>Controllable functon: file_put_contents</li>
                    <li>Allow_url_include: Off</li>
                    <li>Vulnerabitity type: Encoding</li>
                    <li>Example: file_put_content(“php://filter/write=string.rot13/resource=x.txt”, “content”);</li>
                </ul>
                <p>Chức năng của nó là encode chữ “content” sang dạng rot13, sau đó ghi vào file x.txt</p>
                <h1 id="file"><a href="#file" class="headerlink" title="file://"></a>file://</h1>
                <ul>
                    <li>Controllable functon: - (Không cần)</li>
                    <li>Allow_url_include: Off</li>
                    <li>Vulnerabitity type: LFI/ File Manipulation</li>
                </ul>
                <h1 id="glob"><a href="#glob" class="headerlink" title="glob://"></a>glob://</h1>
                <ul>
                    <li>Controllable functon: - (Không cần)</li>
                    <li>Allow_url_include: Off</li>
                    <li>Vulnerabitity type: Diretory Traversal</li>
                </ul>
                <h1 id="php-input"><a href="#php-input" class="headerlink" title="php://input"></a>php://input</h1>
                <ul>
                    <li>Controllable functon: include</li>
                    <li>Allow_url_include: On</li>
                    <li>Vulnerabitity type: RCE</li>
                </ul>
                <p>Tức là ta có thể thực thi code mà không cần tạo file nằm trong cục bộ, mà truyền thẳng nó thông qua POST data.</p>
                <h2 id="Vi-du-1"><a href="#Vi-du-1" class="headerlink" title="Ví dụ:"></a>Ví dụ:</h2>
                <p>URL: localhost/index.php?file=php://input (LFI sử dụng php://input)<br>POST data: &lt;?php phpinfo(); ?&gt;</p>
                <h2 id="Chu-y-la-can-thuoc-tinh-allow-url-include-On"><a href="#Chu-y-la-can-thuoc-tinh-allow-url-include-On" class="headerlink" title="Chú ý là cần thuộc tính: allow_url_include = On"></a>Chú ý là cần thuộc tính: allow_url_include = On</h2>
                <h1 id="data"><a href="#data" class="headerlink" title="data://"></a>data://</h1>
                <ul>
                    <li>Controllable functon: include</li>
                    <li>Allow_url_include: On</li>
                    <li>Vulnerabitity type: RCE</li>
                    <li>Example: data://text/plain;base64,PD9waHAgcGhwaW5mbygpOyA/Pg==</li>
                </ul>
                <p>Tức là ta có thể thực thi code mà không cần tạo file nằm trong cục bộ, mà truyền thẳng nó thông qua wrapper data:// luôn.</p>
                <p>PD9waHAgcGhwaW5mbygpOyA/Pg== là &lt;?php phpinfo(); ?&gt;</p>
                <h2 id="Chu-y-la-can-thuoc-tinh-allow-url-include-On-1"><a href="#Chu-y-la-can-thuoc-tinh-allow-url-include-On-1" class="headerlink" title="Chú ý là cần thuộc tính: allow_url_include = On"></a>Chú ý là cần thuộc tính: allow_url_include = On</h2>
                <h1 id="zip"><a href="#zip" class="headerlink" title="zip://"></a>zip://</h1>
                <ul>
                    <li>Controllable functon: include + uploaded file</li>
                    <li>Allow_url_include: Off</li>
                    <li>Vulnerabitity type: RCE</li>
                </ul>
                <p>LFI thông qua wrapper zip:// cho phép kẻ tấn công tải lên file zip và thông qua LFI để thực thi nó.<br>Tức là máy chủ cho phép upload 1 file zip, nhưng lại ko giải nén nó, mà chỉ giữ nguyên file zip, thông qua wrapper này, ta sẽ gọi được đến file shell nằm trong file zip đó thông qua LFI</p>
                <h2 id="Cac-buoc-tan-cong"><a href="#Cac-buoc-tan-cong" class="headerlink" title="Các bước tấn công"></a>Các bước tấn công</h2>
                <ul>
                    <li>Tạo PHP shell</li>
                    <li>Nén lại thành file.zip</li>
                    <li>Upload file này lên server. Thông qua chức năng upload nhé.</li>
                    <li>
                        Sử dụng zip wrapper để thực thi như sau:
                        <blockquote>
                            <p>zip://file.zip%23shell.php</p>
                        </blockquote>
                    </li>
                </ul>
                <p>%23 tức là kí tự #</p>
                <h1 id="phar"><a href="#phar" class="headerlink" title="phar://"></a>phar://</h1>
                <ul>
                    <li>Controllable functon: include + uploaded file</li>
                    <li>Allow_url_include: Off</li>
                    <li>Vulnerabitity type: RCE</li>
                    <li>PHP: Version &gt;= 5.3</li>
                </ul>
                <p>Là lỗ hổng dùng chung với PHP Object Injection (Deserialize).<br>Mình chỉ nói sơ qua, các bạn nghiên cứu rõ hơn trong bài PHP Object Injection.</p>
                <h2 id="Tao-mot-phar-file-voi-serialized-object-trong-meta-data"><a href="#Tao-mot-phar-file-voi-serialized-object-trong-meta-data" class="headerlink" title="Tạo một phar file với serialized object trong meta-data"></a>Tạo một phar file với serialized object trong meta-data</h2>
                <figure class="highlight php">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br><span class="line">8</span><br><span class="line">9</span><br><span class="line">10</span><br><span class="line">11</span><br><span class="line">12</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="comment">// create new Phar</span></span><br><span class="line">$phar = <span class="keyword">new</span> Phar(<span class="string">'test.phar'</span>);</span><br><span class="line">$phar-&gt;startBuffering();</span><br><span class="line">$phar-&gt;addFromString(<span class="string">'test.txt'</span>, <span class="string">'text'</span>);</span><br><span class="line">$phar-&gt;setStub(<span class="string">'&lt;?php __HALT_COMPILER(); ? &gt;'</span>);</span><br><span class="line"></span><br><span class="line"><span class="comment">// add object of any class as meta data</span></span><br><span class="line"><span class="class"><span class="keyword">class</span> <span class="title">AnyClass</span> </span>{}</span><br><span class="line">$object = <span class="keyword">new</span> AnyClass;</span><br><span class="line">$object-&gt;data = <span class="string">'rips'</span>;</span><br><span class="line">$phar-&gt;setMetadata($object);</span><br><span class="line">$phar-&gt;stopBuffering();</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <h2 id="Sau-do-su-dung-lo-hong-PHP-Object-Injection"><a href="#Sau-do-su-dung-lo-hong-PHP-Object-Injection" class="headerlink" title="Sau đó sử dụng lỗ hổng PHP Object Injection"></a>Sau đó sử dụng lỗ hổng PHP Object Injection</h2>
                <figure class="highlight php">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="class"><span class="keyword">class</span> <span class="title">AnyClass</span> </span>{</span><br><span class="line">    <span class="function"><span class="keyword">function</span> <span class="title">__destruct</span><span class="params">()</span> </span>{</span><br><span class="line">        <span class="keyword">echo</span> <span class="keyword">$this</span>-&gt;data;</span><br><span class="line">    }</span><br><span class="line">}</span><br><span class="line"><span class="comment">// Ouput sẽ là rips</span></span><br><span class="line"><span class="keyword">include</span>(<span class="string">'phar://test.phar'</span>);</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <h1 id="Tim-hieu-them-expect"><a href="#Tim-hieu-them-expect" class="headerlink" title="Tìm hiểu thêm: expect://"></a>Tìm hiểu thêm: expect://</h1>
                <p>Cho phép thực thi system commands luôn. Như là ls, whoami, ifconfig…</p>
                <h2 id="Chu-y-No-khong-phai-extension-mac-dinh-cua-PHP"><a href="#Chu-y-No-khong-phai-extension-mac-dinh-cua-PHP" class="headerlink" title="Chú ý: Nó không phải extension mặc định của PHP"></a>Chú ý: Nó không phải extension mặc định của PHP</h2>
                <h1 id="Tham-khao"><a href="#Tham-khao" class="headerlink" title="Tham khảo:"></a>Tham khảo:</h1>
                <ul>
                    <li><strong>Payload All The Things</strong>: <a href="https://github.com/swisskyrepo/PayloadsAllTheThings/tree/master/File%20Inclusion%20-%20Path%20Traversal" target="_blank" rel="noopener">https://github.com/swisskyrepo/PayloadsAllTheThings/tree/master/File%20Inclusion%20-%20Path%20Traversal</a></li>
                </ul>
            </div>
        </article>
        <section id="comments">
            <div id="vcomments"></div>
        </section>
    </div>

</main>