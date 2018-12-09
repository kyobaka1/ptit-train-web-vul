<main class="main" role="main">
    <div class="content">
        <article id="post-fileupload/fileupload_vul" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    Lổ Hổng Của File Upload
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a>
               <?php if($src_youtube != ''){echo '<button id="introduce-btn"><img src="public/images/play-circle.png" class="img-circle img-rotate" style="height: 24px; width: 24px; margin-right: 5px" " />Hướng Dẫn</button>';} ?>
                </div>
            </div>
            <?php echo get_iframe_youtube($src_youtube); ?>
            <div class="article-entry marked-body" itemprop="articleBody">
                <p><strong>Lỗi file upload</strong> là lỗi logic, tức là do người code không ràng buộc đúng và kĩ càng khi cho upload file lên server. Do đó, hacker lợi dụng chức năng đó để upload lên các mã độc nguy hiểm cho hệ thống web.</p>
                <h1 id="Muc-tieu-cua-ke-tan-cong"><a href="#Muc-tieu-cua-ke-tan-cong" class="headerlink" title="Mục tiêu của kẻ tấn công"></a>Mục tiêu của kẻ tấn công</h1>
                <p>Lổ hổng ở upload file là việc website chạy sai với mong muốn của nhà phát triển. Ví dụ, nhà phát triển muốn cho người dùng upload file hình ảnh lên server để lưu trữ, nhưng việc người dùng có thể upload các loại file khác hình ảnh như docx, php, xml…<br>Mục tiêu của kẻ tấn công khi tấn công lỗ hổng này chủ yếu là:</p>
                <ul>
                    <li>Upload file shell (Có đuôi .php để chạy trên server)</li>
                    <li>Upload các loại file khác. (Như file .exe)</li>
                </ul>
                <p>Để biết lổ hổng của file upload nằm ở đâu,thì bài trước,mình đã có nói về các thông tin của 1 file upload lên. Hacker/người dùng có thể điều khiển những thông tin đó tuỳ ý:</p>
                <ul>
                    <li>Tên file</li>
                    <li>Loại file (MIME type)</li>
                    <li>Nội dung file</li>
                </ul>
                <h1 id="Loi-o-rang-buoc-duoi-file"><a href="#Loi-o-rang-buoc-duoi-file" class="headerlink" title="Lỗi ở ràng buộc đuôi file"></a>Lỗi ở ràng buộc đuôi file</h1>
                <p>Lổ hỗng xảy ra khi nhà phát triển ràng buộc đuôi file một cách không hợp lý dẫn đến hacker có thể bypass và upload file có đuôi mong muốn lên server.<br>Lỗi logic của code thì tuỳ theo từng trường hợp, chứ không thể phân tích ra từng loại được.</p>
                <h2 id="Vi-du"><a href="#Vi-du" class="headerlink" title="Ví dụ"></a>Ví dụ</h2>
                <figure class="highlight php">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line">$uploaded_ext  = substr( $_FILE[<span class="string">'upload'</span>][<span class="string">'name'</span>], strrpos( $_FILE[<span class="string">'upload'</span>][<span class="string">'name'</span>], <span class="string">'.'</span> ) + <span class="number">1</span>); <span class="comment"># Lấy được extension của file. </span></span><br><span class="line"><span class="keyword">if</span>($uploaded_ext === <span class="string">'php'</span>){</span><br><span class="line">	<span class="keyword">echo</span> <span class="string">'No!'</span>;</span><br><span class="line">}<span class="keyword">else</span>{</span><br><span class="line">	<span class="keyword">echo</span> <span class="string">'Yes!'</span>;</span><br><span class="line">}</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p>Bạn nghĩ đoạn code trên có cấm được người dùng upload lên file đuôi <strong>php</strong> không?</p>
                <h3 id="Tat-nhien-la-khong-roi"><a href="#Tat-nhien-la-khong-roi" class="headerlink" title="Tất nhiên là không rồi."></a>Tất nhiên là không rồi.</h3>
                <p>Nếu hacker đổi tên file thành:</p>
                <blockquote>
                    <p>bypass_easy.pHp<br>Thì ‘pHp’ != ‘php’ mà. Đó là ví dụ đơn giản để các bạn dễ hiểu.</p>
                </blockquote>
                <h1 id="Loi-o-rang-buoc-MIME-type"><a href="#Loi-o-rang-buoc-MIME-type" class="headerlink" title="Lỗi ở ràng buộc MIME type"></a>Lỗi ở ràng buộc MIME type</h1>
                <p>Lổ hỗng xảy ra khi nhà phát triển nghĩ rằng việc ràng buộc loại file là đủ để có thể điều khiển được cả đuôi file. Do đó, họ chỉ quan tâm và ràng buộc đến loại file.</p>
                <h3 id="Voi-moi-ten-file-ta-co-mot-loai-file-khac-nhau"><a href="#Voi-moi-ten-file-ta-co-mot-loai-file-khac-nhau" class="headerlink" title="Với mỗi tên file,ta có một loại file khác nhau."></a>Với mỗi tên file,ta có một loại file khác nhau.</h3>
                <p>Ví dụ như file <strong>.jpg</strong> thì loại file của nó sẽ là <strong>image/jpeg</strong></p>
                <h3 id="Nhung-loai-file-co-the-sua-doi-duoc-cho-khac-voi-ten-file"><a href="#Nhung-loai-file-co-the-sua-doi-duoc-cho-khac-voi-ten-file" class="headerlink" title="Nhưng loại file có thể sửa đổi được cho khác với tên file."></a>Nhưng loại file có thể sửa đổi được cho khác với tên file.</h3>
                <p>Là file của người dùng,nên người dùng có thể điều khiển mọi thứ của file đó, kể cả MIME type, do đó nếu tin tưởng và chỉ ràng buộc nó, lỗ hổng xảy ra là điều dĩ nhiên.</p>
                <h2 id="Vi-du-1"><a href="#Vi-du-1" class="headerlink" title="Ví dụ"></a>Ví dụ</h2>
                <figure class="highlight php">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line">$uploaded_type  = $_FILE[<span class="string">'upload'</span>][<span class="string">'type'</span>]; <span class="comment">#Lấy mime type của file upload lên</span></span><br><span class="line"><span class="keyword">if</span>($uploaded_type === <span class="string">'image/jpeg'</span>){</span><br><span class="line">	<span class="keyword">echo</span> <span class="string">'Yes!'</span>; <span class="comment"># Chỉ cho upload file có type là image/jpeg</span></span><br><span class="line">}<span class="keyword">else</span>{</span><br><span class="line">	<span class="keyword">echo</span> <span class="string">'No!'</span>;</span><br><span class="line">}</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p>Bạn nghĩ đoạn code trên có thể ngăn chặn hacker upload file <strong>.php</strong> với loại file là <strong>application/octet-stream</strong>.</p>
                <h2 id="Tat-nhien-la-khong-roi-1"><a href="#Tat-nhien-la-khong-roi-1" class="headerlink" title="Tất nhiên là không rồi."></a>Tất nhiên là không rồi.</h2>
                <p>Với requests lên server,sẽ có các thông tin như sau<br></p>
                <figure class="highlight bash">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br><span class="line">8</span><br><span class="line">9</span><br><span class="line">10</span><br><span class="line">11</span><br><span class="line">12</span><br><span class="line">13</span><br><span class="line">14</span><br><span class="line">15</span><br><span class="line">16</span><br><span class="line">17</span><br><span class="line">18</span><br><span class="line">19</span><br><span class="line">20</span><br><span class="line">21</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line">POST /final/index.php?page=fileupload_work HTTP/1.1</span><br><span class="line">Host: localhost</span><br><span class="line">User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64; rv:56.0) Gecko/20100101 Firefox/56.0</span><br><span class="line">Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8</span><br><span class="line">Accept-Language: en-GB,en;q=0.5</span><br><span class="line">Content-Type: multipart/form-data; boundary=---------------------------25216154199269</span><br><span class="line">Content-Length: 630</span><br><span class="line">Referer: http://localhost/final/index.php?page=fileupload_work</span><br><span class="line">Cookie: Phpstorm-7285ecfc=d19e1d40-742c-404d-a4b5-2b8004c6a851</span><br><span class="line">Connection: close</span><br><span class="line">Upgrade-Insecure-Requests: 1</span><br><span class="line"></span><br><span class="line">-----------------------------25216154199269</span><br><span class="line">Content-Disposition: form-data; name=<span class="string">"fileToUpload"</span>; filename=<span class="string">"test.php"</span></span><br><span class="line">Content-Type: application/octet-stream</span><br><span class="line"></span><br><span class="line">File PHP nha!</span><br><span class="line">-----------------------------25216154199269</span><br><span class="line">Content-Disposition: form-data; name=<span class="string">"submit"</span></span><br><span class="line">Upload Image</span><br><span class="line">-----------------------------25216154199269--</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <p>Thì ta có thể edit lại bất cứ thuộc tính nào mà ta thích, trong đó có <strong>Content-Type: application/octet-stream</strong> ta đổi thành <strong>Content-Type: image/jpeg</strong> rồi gửi request lên thì đã bypass được filter của đoạn code trên rồi.</p>
                <h1 id="Loi-o-cau-hinh-thu-muc-upload"><a href="#Loi-o-cau-hinh-thu-muc-upload" class="headerlink" title="Lỗi ở cấu hình thư mục upload"></a>Lỗi ở cấu hình thư mục upload</h1>
                <p>Lỗi khi cho người dùng/hacker có thể điều khiển được thư mục upload file. Dù cho đã không cho họ upload file mã độc (php chẳng hạn). Thì điều đó, vẫn có thể lợi dụng để làm một số công việc nguy hiểm.</p>
                <h2 id="Dieu-kien"><a href="#Dieu-kien" class="headerlink" title="Điều kiện:"></a>Điều kiện:</h2>
                <p>Server phải config sai những file quan trọng,dẫn đến user www-data (thông thường) cũng có quyền ghi ở những file quan trọng.</p>
                <h2 id="Vi-du-2"><a href="#Vi-du-2" class="headerlink" title="Ví dụ"></a>Ví dụ</h2>
                <figure class="highlight php">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line">$folder = $_POS[<span class="string">'folder'</span>];</span><br><span class="line"><span class="comment"># Đoạn code filter đuôi file,không cho upload file php.</span></span><br><span class="line"><span class="keyword">if</span>(OK HẾT ĐIỀU KIỆN){</span><br><span class="line">	move_upload_file($_FILE[<span class="string">'upload'</span>][<span class="string">'tmp'</span>], $folder.$_FILE[<span class="string">'upload'</span>][<span class="string">'name'</span>] );</span><br><span class="line">}</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p>Ví dụ như server config cho phép người dùng www-data có quyền write đối với file .htaccess ở /var/www/html/ (không phải đuôi php).<br>Thì hacker sẽ lợi dụng upload file có tên .htaccess (đã edit) vào thư mục /var/www/html để ghi đè lên file cũ. <strong>SUCCESS</strong></p>
                <h3 id="Do-la-mot-so-vi-du-ve-lo-hong-nam-trong-file-upload"><a href="#Do-la-mot-so-vi-du-ve-lo-hong-nam-trong-file-upload" class="headerlink" title="Đó là một số ví dụ về lổ hỗng nằm trong file upload."></a>Đó là một số ví dụ về lổ hỗng nằm trong file upload.</h3>
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