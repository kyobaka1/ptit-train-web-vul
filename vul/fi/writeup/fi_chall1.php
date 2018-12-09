<main class="main has-sticky" role="main">
    <div class="content">
        <article id="post-fi/fi_chall1" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    Local File Inclusion
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a>
               </div>
            </div>
            <div class="article-entry marked-body" itemprop="articleBody">
                <h1 id="Thu-Thach"><a href="#Thu-Thach" class="headerlink" title="Thử Thách"></a>Thử Thách</h1>
                <p>URL: <a href="https://www.root-me.org/en/Challenges/Web-Server/Local-File-Inclusion" target="_blank" rel="noopener">https://www.root-me.org/en/Challenges/Web-Server/Local-File-Inclusion</a></p>
                <h2 id="Tieu-de"><a href="#Tieu-de" class="headerlink" title="Tiêu đề"></a>Tiêu đề</h2>
                <p>Abbreviated LFI</p>
                <h2 id="Mo-ta"><a href="#Mo-ta" class="headerlink" title="Mô tả"></a>Mô tả</h2>
                <p>Get in the admin section.</p>
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
                <p>Chạy thử các chức năng của web thì ta thấy mẫu URL có dạng:</p>
                <blockquote>
                    <p><a href="http://challenge01.root-me.org/web-serveur/ch16/?files=crypto&amp;f=codebreakers" target="_blank" rel="noopener">http://challenge01.root-me.org/web-serveur/ch16/?files=crypto&amp;f=codebreakers</a></p>
                </blockquote>
                <p>Dễ dàng đoán được files ở đây là thư mục còn f là tên file.<br>Nhưng ta không biết được file có chứa thông tin của admin ở đâu.<br>Do đó, ta dùng Directory Traversal bằng cách:</p>
                <blockquote>
                    <p><a href="http://challenge01.root-me.org/web-serveur/ch16/?files=../" target="_blank" rel="noopener">http://challenge01.root-me.org/web-serveur/ch16/?files=../</a></p>
                </blockquote>
                <p>Ta thấy được:<br></p>
                <figure class="highlight bash">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line">text.gif admin files index.php</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <p>Thử đọc file index.php nào. Thấy được cơ chế lỗi LFI của nó.<br>Nhưng flag thì chưa thấy đâu.</p>
                <p>Đề bài bảo lấy admin section, do đó chắc nó nằm ở đâu đó trong admin.<br>Ta test thử.</p>
                <blockquote>
                    <p><a href="http://challenge01.root-me.org/web-serveur/ch16/?files=../admin" target="_blank" rel="noopener">http://challenge01.root-me.org/web-serveur/ch16/?files=../admin</a></p>
                </blockquote>
                <p>Thấy file index, đọc nó,ta sẽ có được flag nhé.</p>
                <h2 id="Thanh-cong"><a href="#Thanh-cong" class="headerlink" title="Thành công!"></a>Thành công!</h2>
                </div></div>
        </article>
        <section id="comments">
            <div id="vcomments"></div>
        </section>
    </div>

</main>