<main class="main" role="main">
    <div class="content">
        <article id="post-fi/fi" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    Lỗ Hổng File Inclusion
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a>
               <?php if($src_youtube != ''){echo '<button id="introduce-btn"><img src="public/images/play-circle.png" class="img-circle img-rotate" style="height: 24px; width: 24px; margin-right: 5px" " />Hướng Dẫn</button>';} ?>
                </div>
            </div>
            <?php echo get_iframe_youtube($src_youtube); ?>
            <div class="article-entry marked-body" itemprop="articleBody">
                <p>Lỗ hổng <strong>file inclusion</strong> là loại lổ hổng bảo mật được tìm thấy chủ yếu ở các ứng dụng web chạy trên một scripting run time.<br>Điển hình là ngôn ngữ PHP và Java.</p>
                <h1 id="Tai-sao-lai-ton-tai-lo-hong-File-Inclusion"><a href="#Tai-sao-lai-ton-tai-lo-hong-File-Inclusion" class="headerlink" title="Tại sao lại tồn tại lỗ hổng File Inclusion"></a>Tại sao lại tồn tại lỗ hổng File Inclusion</h1>
                <h2 id="Nguyen-nhan"><a href="#Nguyen-nhan" class="headerlink" title="Nguyên nhân"></a>Nguyên nhân</h2>
                <p>PHP là ngôn ngữ script run time, nó cung cấp một số các hàm để có thể thêm một đoạn script (cung cấp từ file khác) vào file hiện tại, bằng:</p>
                <ul>
                    <li>include(), include_once()</li>
                    <li>require(), require_once()</li>
                </ul>
                <p>Chức năng này rất tiện ích và trong tất cả các nhà phát triển PHP cần biết, bởi vì như đã nói PHP là ngôn ngữ script run time, do đó tất cả code cần để chạy nó,cần phải được chứa trong file php đang chạy đó.<br>Chức năng này thường dùng để thêm các thành phần header, footer,config file, lấy hàm từ file khác…<br>Nhưng đôi khi, website của chúng ta cần lấy những input của người dùng làm tham số đầu vào cho những hàm này. Vì vậy, nếu code không filter rõ ràng, hay tồn tại lỗ hổng, kẻ tấn công có thể lợi dụng nó.</p>
                <h2 id="Vi-du"><a href="#Vi-du" class="headerlink" title="Ví dụ"></a>Ví dụ</h2>
                <p>Ví dụ một trang web hoạt động theo hướng sau, mọi lưu lượng và xử lý đều nằm ở đường dẫn (tới file index): <strong>localhost/index.php</strong>.<br>Sau đó, nếu cần chức năng gì thì nó sẽ gọi đến bằng cách include đoạn code đấy vào index.php bằng <strong>$_GET[‘page’]</strong><br></p>
                <figure class="highlight php">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="meta">&lt;?php</span></span><br><span class="line"><span class="keyword">if</span>(<span class="keyword">isset</span>($_GET[<span class="string">'page'</span>])){</span><br><span class="line">	<span class="keyword">include</span> ($_GET[<span class="string">'page'</span>]);</span><br><span class="line">}</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <p>Ví dụ muốn login thì vào: <strong>localhost/index.php?page=login.php</strong><br>Kẻ tấn công truyền vào giá trị:</p>
                <blockquote>
                    <p>page=/etc/passwd</p>
                </blockquote>
                <p>Thì nội dung file /etc/passwd sẽ được thêm vào index.php, từ đó kẻ tấn công có thể quan sát được.</p>
                <h1 id="Ke-tan-cong-co-the-lam-gi-voi-File-Inclusion"><a href="#Ke-tan-cong-co-the-lam-gi-voi-File-Inclusion" class="headerlink" title="Kẻ tấn công có thể làm gì với File Inclusion"></a>Kẻ tấn công có thể làm gì với File Inclusion</h1>
                <p><strong>File Inclusion</strong> là một lỗ hổng nghiêm trọng và nguy hiểm bởi vì mức độ ảnh hưởng có nó có thể dẫn tới RCE (Remote Code Excute).<br>Các hành động kẻ tấn công có thể làm với <strong>File Inclusion</strong> như sau:</p>
                <ul>
                    <li>Đọc file trên server.</li>
                    <li>Thêm các đoạn script mã độc vào server =&gt; thực thi. Bởi vì nó được thêm vào file đã include nó.</li>
                    <li>Từ đó, attacker sẽ chiếm được quyền điều khiển server.</li>
                </ul>
                <h1 id="Cach-hoat-dong-cua-File-Inclusion"><a href="#Cach-hoat-dong-cua-File-Inclusion" class="headerlink" title="Cách hoạt động của File Inclusion"></a>Cách hoạt động của File Inclusion</h1>
                <p>Ví dụ, ta có 1 file index.php như sau:<br></p>
                <figure class="highlight php">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="meta">&lt;?php</span></span><br><span class="line"><span class="keyword">echo</span> <span class="string">'Hello '</span>;</span><br><span class="line"><span class="keyword">include</span>(<span class="string">'myfile.txt'</span>);</span><br><span class="line"><span class="keyword">echo</span> <span class="string">' World'</span>;</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <p>Nếu myfile.txt có nội dung là:<br></p>
                <figure class="highlight plain">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line">echo 'Here!';</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <p>Thì kết quả trả về sẽ là:</p>
                <blockquote>
                    <p>Hello echo ‘Here!’; World</p>
                </blockquote>
                <p>Tức là nội dung file index.php,được coi là như thế này:<br></p>
                <figure class="highlight php">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="meta">&lt;?php</span> <span class="keyword">echo</span> <span class="string">'Hello '</span>; <span class="meta">?&gt;</span> <span class="comment"># Đóng thẻ script.</span></span><br><span class="line"><span class="keyword">echo</span> <span class="string">'Here!'</span>;     <span class="comment"># Không chạy như script,nó chỉ là text,vì ko có thẻ &lt;?php</span></span><br><span class="line"><span class="meta">&lt;?php</span> <span class="keyword">echo</span> <span class="string">' World'</span>; <span class="meta">?&gt;</span> <span class="comment"># Tự mở và đóng thẻ script.</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <p>Do đó, nếu muốn chạy dòng code như là script PHP, ta cần thêm thẻ <strong>&lt;?php</strong><br>File myfile.txt như sau:<br></p>
                <figure class="highlight plain">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line">&lt;?php echo 'Here!'; ?&gt;</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <p>Vậy kết quả trả về sẽ là:</p>
                <blockquote>
                    <p>Hello Here! World</p>
                </blockquote>
                <p>Cho dù file đó có là đuôi .txt, hay đuôi .html hay là không có đuôi file.<br>Hàm <strong>include()</strong> chỉ coi nó dưới dạng văn bản, và thêm vào file index.php. Nếu có <strong>&lt;?php</strong> thì nó cũng hiểu và chạy đấy là code PHP luôn.</p>
                <p>File index.php cuối cùng là:</p>
                <pre><code class="php"><span class="meta">&lt;?php</span> <span class="keyword">echo</span> <span class="string">'Hello '</span>; <span class="meta">?&gt;</span>
<span class="meta">&lt;?php</span> <span class="keyword">echo</span> <span class="string">'Here!'</span>; <span class="meta">?&gt;</span>  <span class="comment">// Lấy nội dung từ file myfile.txt</span>
<span class="meta">&lt;?php</span> <span class="keyword">echo</span> <span class="string">' World'</span>; <span class="meta">?&gt;</span>
</code></pre>
                <p>Đoạn script mã độc mà kẻ tấn công muốn chèn vào code của server:</p>
                <blockquote>
                    <p>&lt;?php system($_GET[‘cmd’]); ?&gt;</p>
                </blockquote>
                <h1 id="Tham-khao"><a href="#Tham-khao" class="headerlink" title="Tham khảo"></a>Tham khảo</h1>
                <ul>
                    <li><strong>OWASP</strong>: <a href="https://www.offensive-security.com/metasploit-unleashed/file-inclusion-vulnerabilities/" target="_blank" rel="noopener">https://www.offensive-security.com/metasploit-unleashed/file-inclusion-vulnerabilities/</a></li>
                    <li><strong>Offensive Security</strong>: <a href="https://en.wikipedia.org/wiki/File_inclusion_vulnerability" target="_blank" rel="noopener">https://en.wikipedia.org/wiki/File_inclusion_vulnerability</a></li>
                </ul>
            </div>
        </article>
        <?php if(isset($_GET['change_status'])){
            if($_GET['change_status'] == 1){change_status($id_post);}}
        echo print_footer_status($id_post,$title);
        ?>
        <section id="comments">
            <div id="vcomments"></div>
        </section>
    </div>

</main>