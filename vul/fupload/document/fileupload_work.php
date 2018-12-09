<main class="main" role="main">
    <div class="content">
        <article id="post-fileupload/fileupload" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    Cách Upload File Hoạt Động Trong PHP
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a>
               <?php if($src_youtube != ''){echo '<button id="introduce-btn"><img src="public/images/play-circle.png" class="img-circle img-rotate" style="height: 24px; width: 24px; margin-right: 5px" " />Hướng Dẫn</button>';} ?>
                </div>
            </div>
            <?php echo get_iframe_youtube($src_youtube); ?>
            <div class="article-entry marked-body" itemprop="articleBody">
                <p>Upload File là thường chức năng tất yếu đối với một website và hoạt động rất đa dạng, như là:</p>
                <ul>
                    <li>Upload file hình ảnh để làm avarta, tin nhắn..</li>
                    <li>Upload file đính kèm trong tin nhắn..</li>
                    <li>Upload file tài liệu như pdf,docx,txt..</li>
                </ul>
                <p>Do các ngôn ngữ khác nhau,có cách upload file khác nhau, do đó trong bài này, mình sẽ nói dạng upload file trong ngôn ngữ PHP.</p>
                <h1 id="Nhung-kien-thuc-can-ban"><a href="#Nhung-kien-thuc-can-ban" class="headerlink" title="Những kiến thức căn bản."></a>Những kiến thức căn bản.</h1>
                <h2 id="Cau-hinh-cua-PHP"><a href="#Cau-hinh-cua-PHP" class="headerlink" title="Cấu hình của PHP"></a>Cấu hình của PHP</h2>
                <p>Để upload được file trong php, ta cần config trong <strong>php.ini</strong> (thường mặc định là cho phép):<br></p>
                <figure class="highlight plain">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line">file_uploads = On    =&gt; Quy định có được upload file hay không?</span><br><span class="line">upload_tmp_dir="C:\xampp\tmp"  =&gt; Quy định file tạm được lưu ở đâu?</span><br><span class="line">upload_max_filesize=50M        =&gt; Quy định về dung lượng file được upload.</span><br><span class="line">max_file_uploads=20			   =&gt; Số file được upload trong 1 lần.</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <h2 id="Thong-tin-cua-file"><a href="#Thong-tin-cua-file" class="headerlink" title="Thông tin của file"></a>Thông tin của file</h2>
                <p>Một file được upload lên server,bao gồm các thông số như sau:</p>
                <ul>
                    <li>Tên file: Bao gồm phần tên và phần đuôi extension của file.</li>
                    <li>Loại file (MIME type): Đặc trưng cho từng loại file.</li>
                    <li>Size: Dung lượng</li>
                    <li>Tên file tmp: Tên file tạm lưu trên server lúc chưa được xử lý, chưa có đuôi extension.</li>
                </ul>
                <h2 id="Bien-luu-tru-va-form-upload"><a href="#Bien-luu-tru-va-form-upload" class="headerlink" title="Biến lưu trữ và form upload."></a>Biến lưu trữ và form upload.</h2>
                <p>Để upload một file, trong form html ta cần khai báo:<br></p>
                <figure class="highlight html">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="tag">&lt;<span class="name">form</span> <span class="attr">action</span>=<span class="string">"upload.php"</span> <span class="attr">method</span>=<span class="string">"post"</span> <span class="attr">enctype</span>=<span class="string">"multipart/form-data"</span>&gt;</span></span><br><span class="line">    Select image to upload:</span><br><span class="line">    <span class="tag">&lt;<span class="name">input</span> <span class="attr">type</span>=<span class="string">"file"</span> <span class="attr">name</span>=<span class="string">"fileToUpload"</span> <span class="attr">id</span>=<span class="string">"fileToUpload"</span>&gt;</span></span><br><span class="line">    <span class="tag">&lt;<span class="name">input</span> <span class="attr">type</span>=<span class="string">"submit"</span> <span class="attr">value</span>=<span class="string">"Upload Image"</span> <span class="attr">name</span>=<span class="string">"submit"</span>&gt;</span></span><br><span class="line"><span class="tag">&lt;/<span class="name">form</span>&gt;</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <h3 id="Luu-y-enctype-”multipart-form-data”-rat-quan-trong-khong-co-la-khong-upload-duoc-dau-nha"><a href="#Luu-y-enctype-”multipart-form-data”-rat-quan-trong-khong-co-la-khong-upload-duoc-dau-nha" class="headerlink" title="Lưu ý: enctype=”multipart/form-data” rất quan trọng, không có là không upload được đâu nha."></a>Lưu ý: <strong>enctype=”multipart/form-data”</strong> rất quan trọng, không có là không upload được đâu nha.</h3>
                <p>Khi upload lên phía ngôn ngữ server php, các thông tin này sẽ được lưu trong mảng: <strong>$_FILES</strong><br>Ví dụ, name của file upload lên trong ví dụ là <strong>fileToUpload</strong> thì thông tin file đó sẽ được lưu tại: <strong>$_FILES[‘fileToUpload’]</strong><br></p>
                <figure class="highlight php">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line">$_FILES[<span class="string">'fileToUpload'</span>][<span class="string">'name'</span>] =&gt; Tên file</span><br><span class="line">$_FILES[<span class="string">'fileToUpload'</span>][<span class="string">'tmp_name'</span>] =&gt; Tên file tmp.</span><br><span class="line">$_FILES[<span class="string">'fileToUpload'</span>][<span class="string">'type'</span>] =&gt; MIME type của file.</span><br><span class="line">$_FILES[<span class="string">'fileToUpload'</span>][<span class="string">'error] =&gt; Lỗi</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <h1 id="Cach-upload-files"><a href="#Cach-upload-files" class="headerlink" title="Cách upload files"></a>Cách upload files</h1>
                <p><strong>Được hướng dẫn trong w3schools</strong>: <a href="https://www.w3schools.com/php/php_file_upload.asp" target="_blank" rel="noopener">https://www.w3schools.com/php/php_file_upload.asp</a></p>
                <h2 id="move-uploaded-file"><a href="#move-uploaded-file" class="headerlink" title="move_uploaded_file()"></a>move_uploaded_file()</h2>
                <p>Hàm dùng để lưu file thường dùng trong PHP là <strong>move_uploaded_file()</strong><br>Chi tiết: <a href="http://php.net/manual/en/function.move-uploaded-file.php" target="_blank" rel="noopener">http://php.net/manual/en/function.move-uploaded-file.php</a><br>Gồm 2 tham số đầu vào:</p>
                <ul>
                    <li>string $filename: Là địa chỉ hiện tại của file cũ, nếu mới upload thì là file tmp.</li>
                    <li>string $destination: Là địa chỉ mới muốn lưu mới tại đó.</li>
                </ul>
                <h2 id="Vi-du-doan-code-don-gian-nhat-de-upload-file"><a href="#Vi-du-doan-code-don-gian-nhat-de-upload-file" class="headerlink" title="Ví dụ đoạn code đơn giản nhất để upload file:"></a>Ví dụ đoạn code đơn giản nhất để upload file:</h2>
                <figure class="highlight php">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br><span class="line">8</span><br><span class="line">9</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line">$target_dir = <span class="string">"uploads/"</span>; <span class="comment">// Thư mục upload lên</span></span><br><span class="line">$target_file = $target_dir . basename($_FILES[<span class="string">"fileToUpload"</span>][<span class="string">"name"</span>]);</span><br><span class="line"><span class="comment">// Là vị trí địa chỉ mới ta muốn upload file tại đó.</span></span><br><span class="line"></span><br><span class="line"><span class="keyword">if</span>(move_uploaded_file($_FILES[<span class="string">"fileToUpload"</span>][<span class="string">"name"</span>],$target_file)){</span><br><span class="line">	<span class="keyword">echo</span> <span class="string">'Upload success!'</span>;</span><br><span class="line">}<span class="keyword">else</span>{</span><br><span class="line">	<span class="keyword">echo</span> <span class="string">'Upload Fail!'</span>;</span><br><span class="line">}</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <h2 id="file-put-contents"><a href="#file-put-contents" class="headerlink" title="file_put_contents()"></a>file_put_contents()</h2>
                <p>Ngoài ra còn có thể dùng hàm <strong>file_put_contents()</strong> để upload file.<br>Chi tiết: <a href="http://php.net/manual/en/function.file-put-contents.php" target="_blank" rel="noopener">http://php.net/manual/en/function.file-put-contents.php</a></p>
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