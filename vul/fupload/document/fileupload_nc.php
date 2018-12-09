<main class="main has-sticky" role="main">
    <div class="content">
        <article id="post-fileupload/fileupload_nc" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    Lợi Dụng Lỗ Hổng Khác File Upload
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a>
               <?php if($src_youtube != ''){echo '<button id="introduce-btn"><img src="public/images/play-circle.png" class="img-circle img-rotate" style="height: 24px; width: 24px; margin-right: 5px" " />Hướng Dẫn</button>';} ?>
                </div>
            </div>
            <?php echo get_iframe_youtube($src_youtube); ?>
            <div class="article-entry marked-body" itemprop="articleBody">
                <h1 id="PHP-ban-cu-Nullbyte-Injection"><a href="#PHP-ban-cu-Nullbyte-Injection" class="headerlink" title="PHP bản cũ: Nullbyte Injection"></a>PHP bản cũ: Nullbyte Injection</h1>
                <p>Với các bản <strong>PHP cũ hơn 5.3.4</strong> thì nullbyte injection là một vấn đề nhức nhối.<br>Được mô tả ở: <a href="https://bugs.php.net/bug.php?id=39863" target="_blank" rel="noopener">https://bugs.php.net/bug.php?id=39863</a><br>file_exít() sẽ âm thầm cắt bỏ tất cả những gì phía sau nullbute trong một string.<br>Điều này được hacker lợi dụng và áp dụng vào một số lổ hỗng khác.<br><strong>Lỗ hổng fileupload</strong> là một số các lỗ hổng có thể bị lợi dụng bởi nullbyte.<br>Bởi vì:</p>
                <ul>
                    <li>Tên của file là kiểu string.</li>
                    <li>Khi check đuôi file, ta thường kiểm tra phần sau dấu chấm ở cuối cùng. Ví dụ: file.php.txt thì đuôi file là .txt</li>
                </ul>
                <p>Kẻ tấn công sẽ lợi dụng chèn null byte vào:</p>
                <blockquote>
                    <p>file.php%00.txt</p>
                </blockquote>
                <p>Khi kiểm tra tên file, file vẫn là .txt, nhưng khi lưu file, do đoạn .txt bị bỏ qua, nên tên file sẽ là <strong>file.php</strong></p>
                <h1 id="LFI-File-Upload"><a href="#LFI-File-Upload" class="headerlink" title="LFI + File Upload"></a>LFI + File Upload</h1>
                <p>LFI còn được gọi là <strong>Local File Inclusion</strong>.<br>Các bạn có thể xem rõ hơn ở bài hướng dẫn về lổ hổng LFI.</p>
                <p>Cơ chế hoạt động của <strong>include, require</strong> là xem tất cả những gì của file được gọi tới là dạng PHP. Do đó, dù file đó có tên là .txt hay .docx hay .abc gì đó không quan trọng.<br>Chỉ cần trong file có các đoạn script php như:</p>
                <blockquote>
                    <p>&lt;?php phpinfo(); ?&gt;</p>
                </blockquote>
                <p>Thì đoạn code đấy sẽ được chạy nhờ LFI.</p>
                <h1 id="Upload-file-zip-symlink"><a href="#Upload-file-zip-symlink" class="headerlink" title="Upload file zip + symlink"></a>Upload file zip + symlink</h1>
                <p>Symlinks trong linux, tức là tạo một liên kết từ file đó đến file được chỉ đến. Giống như tạo shorcut trong Windows.<br></p>
                <figure class="highlight bash">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line">— symlinks</span><br><span class="line">For UNIX and VMS (V8.3 and later), store symbolic links as such <span class="keyword">in</span> the zip archive, instead of compressing and storing the file referred to by the link.</span><br><span class="line">This can avoid multiple copies of files being included <span class="keyword">in</span> the archive as zip recurses the directory trees and accesses files directly and by links.</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <p>Hiểu là đối với UNIX và VMS (v8.3 và cũ hơn), khi tạo một liên kết symlink rồi nén nó lại thành file zip, nó vẫn sẽ lưu file đấy là một liên kết động, mà không phải lưu tập tin mà liên kết chỉ đến.</p>
                <p>Điều này được hacker lợi dụng để tạo liên kết với các file mã nguồn của server,các file config, sau đó upload file zip lên.<br>Đọc file được tạo symlink như symlinks.txt =&gt; index.php<br>Từ đó, lấy được mã nguồn của server.</p>
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