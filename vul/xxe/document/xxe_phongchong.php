<main class="main has-sticky" role="main">
    <div class="content">
        <article id="post-xxe/xxe_phongchong" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    Phòng Chống XXE Trong PHP
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a>
                    <?php if($src_youtube != ''){echo '<button id="introduce-btn"><img src="public/images/play-circle.png" class="img-circle img-rotate" style="height: 24px; width: 24px; margin-right: 5px" " />Hướng Dẫn</button>';} ?>
                </div>
            </div>
            <?php echo get_iframe_youtube($src_youtube); ?>
            <div class="article-entry marked-body" itemprop="articleBody">
                <h1 id="Khong-cho-su-dung-External-Entity"><a href="#Khong-cho-su-dung-External-Entity" class="headerlink" title="Không cho sử dụng External Entity"></a>Không cho sử dụng External Entity</h1>
                <p>Cách tốt nhất là không cho sử dụng luôn.<br>Bạn có thể dễ dàng disable nó bằng code:</p>
                <blockquote>
                    <p>libxml_disable_entity_loader(true);</p>
                </blockquote>
                <h1 id="Khong-thong-bao-loi"><a href="#Khong-thong-bao-loi" class="headerlink" title="Không thông báo lỗi"></a>Không thông báo lỗi</h1>
                <p>Báo lỗi khi xây dựng thì rất hay, nhưng nếu là ứng dụng hoàn thị và cung cấp cho người dùng rồi thì nên tắt đi.<br>Nó để lại nhiều cơ chế để hacker khai thác đó. Code PHP:</p>
                <blockquote>
                    <p>libxml_use_internal_errors(true);</p>
                </blockquote>
                <h1 id="Can-than-khi-su-dung-cac-chuoi-CONSTANTS"><a href="#Can-than-khi-su-dung-cac-chuoi-CONSTANTS" class="headerlink" title="Cẩn thận khi sử dụng các chuỗi CONSTANTS"></a>Cẩn thận khi sử dụng các chuỗi CONSTANTS</h1>
                <p>Có khá nhiều các chuỗi constants nguy hiểm khi sử dụng hàm simplexml_load_string() như trong ví dụ là <strong>LIBXML_NOENT</strong>. Nó cho phép thay thế entities.<br>Đọc rõ trước khi sử dụng nhé: <a href="http://php.net/manual/en/libxml.constants.php" target="_blank" rel="noopener">http://php.net/manual/en/libxml.constants.php</a></p>
                <h1 id="Mot-so-cach-parse-xml-khac"><a href="#Mot-so-cach-parse-xml-khac" class="headerlink" title="Một số cách parse xml khác."></a>Một số cách parse xml khác.</h1>
                <figure class="highlight php">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="meta">&lt;?php</span></span><br><span class="line">libxml_disable_entity_loader(<span class="keyword">TRUE</span>);</span><br><span class="line">$dom = <span class="keyword">new</span> DOMDocument();</span><br><span class="line">$dom-&gt;loadXML($xml, LIBXML_NOENT);</span><br><span class="line"><span class="keyword">echo</span> $dom-&gt;textContent;</span><br><span class="line"><span class="meta">?&gt;</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p>Nhưng nó vẫn dùng được những cấu hình phía trên để ngăn chặn nhé.</p>
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