<main class="main has-sticky" role="main">
    <div class="content">
        <article id="post-xss/xss_phongchong_php" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    Phòng chống XSS trên PHP
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a>
            <?php if($src_youtube != ''){echo '<button id="introduce-btn"><img src="public/images/play-circle.png" class="img-circle img-rotate" style="height: 24px; width: 24px; margin-right: 5px" " />Hướng Dẫn</button>';} ?>
                </div>
            </div>
            <?php echo get_iframe_youtube($src_youtube); ?>
            <div class="article-entry marked-body" itemprop="articleBody">
                <h1 id="Ham-htmlspecialchars"><a href="#Ham-htmlspecialchars" class="headerlink" title="Hàm htmlspecialchars()"></a>Hàm htmlspecialchars()</h1>
                <p>Link: <a href="http://php.net/manual/en/function.htmlspecialchars.php" target="_blank" rel="noopener">http://php.net/manual/en/function.htmlspecialchars.php</a><br></p>
                <figure class="highlight html">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line">Character	Replacement</span><br><span class="line">&amp; (ampersand)	&amp;amp;</span><br><span class="line">" (double quote)	&amp;quot;, unless ENT_NOQUOTES is set</span><br><span class="line">' (single quote)	&amp;#039; (for ENT_HTML401) or &amp;apos; (for ENT_XML1, ENT_XHTML or ENT_HTML5), but only when ENT_QUOTES is set</span><br><span class="line"><span class="tag">&lt; (<span class="attr">less</span> <span class="attr">than</span>)		&amp;<span class="attr">lt</span>;</span></span><br><span class="line"><span class="tag">&gt;</span> (greater than)	&amp;gt;</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <p>Có chức năng chuyển kí tự đặc biệt sang dạng HTML entities.<br>Chỉ cần dùng nó lúc output dữ liệu ra cho người dùng, như đoạn code sau:<br></p>
                <figure class="highlight php">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="meta">&lt;?php</span></span><br><span class="line"><span class="keyword">if</span>(<span class="keyword">isset</span>($_GET[<span class="string">'name'</span>])){</span><br><span class="line">    <span class="keyword">echo</span> <span class="string">"Xin chào "</span>.htmlspecialchars($_GET[<span class="string">'name'</span>]); <span class="comment"># Chỉ cần thế thôi.</span></span><br><span class="line">}</span><br><span class="line"><span class="meta">?&gt;</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <p>Khá đơn giản,đúng không nào.</p>
                <h1 id="Ham-htmlentities"><a href="#Ham-htmlentities" class="headerlink" title="Hàm htmlentities()"></a>Hàm htmlentities()</h1>
                <p>Link: <a href="http://php.net/manual/en/function.htmlentities.php" target="_blank" rel="noopener">http://php.net/manual/en/function.htmlentities.php</a><br>Khá giống hàm htmlspecialchars() nhưng nó là chuyển toàn bộ các kí tự có thể chuyển được sang html entities luôn chứ không phải chỉ là những kí tự đặc biệt.<br>Cách dùng giống htmlspecialchars()</p>
                <h1 id="Ham-strip-tags"><a href="#Ham-strip-tags" class="headerlink" title="Hàm strip_tags()"></a>Hàm strip_tags()</h1>
                <p>Link: <a href="http://php.net/manual/en/function.strip-tags.php" target="_blank" rel="noopener">http://php.net/manual/en/function.strip-tags.php</a></p>
                <h2 id="Luu-y-Khong-dung-rieng-strip-tags-de-chong-XSS"><a href="#Luu-y-Khong-dung-rieng-strip-tags-de-chong-XSS" class="headerlink" title="Lưu ý: Không dùng riêng strip_tags() để chống XSS"></a>Lưu ý: Không dùng riêng strip_tags() để chống XSS</h2>
                <p>Chức năng của strip_tags() là cắt các tag trong thẻ html hoặc php. Để làm sạch chúng.<br></p>
                <figure class="highlight php">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br><span class="line">8</span><br><span class="line">9</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="meta">&lt;?php</span></span><br><span class="line">$text = <span class="string">'&lt;p&gt;Test paragraph.&lt;/p&gt;&lt;!-- Comment --&gt; &lt;a href="#fragment"&gt;Other text&lt;/a&gt;'</span>;</span><br><span class="line"><span class="keyword">echo</span> strip_tags($text); </span><br><span class="line"><span class="comment"># Kết quả: Test paragraph. Other text =&gt; Cắt tắt cả các tag.</span></span><br><span class="line"></span><br><span class="line"><span class="comment">// Allow &lt;p&gt; and &lt;a&gt;</span></span><br><span class="line"><span class="keyword">echo</span> strip_tags($text, <span class="string">'&lt;p&gt;&lt;a&gt;'</span>);</span><br><span class="line"><span class="comment"># Kết quả: &lt;p&gt;Test paragraph.&lt;/p&gt; &lt;a href="#fragment"&gt;Other text&lt;/a&gt;    =&gt; Chỉ cho phép thẻ &lt;a&gt; và &lt;p&gt;</span></span><br><span class="line"><span class="meta">?&gt;</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <h1 id="Ham-addslashes"><a href="#Ham-addslashes" class="headerlink" title="Hàm addslashes()"></a>Hàm addslashes()</h1>
                <p>Link: <a href="http://php.net/manual/en/function.addslashes.php" target="_blank" rel="noopener">http://php.net/manual/en/function.addslashes.php</a><br>Chức năng của addslashes() là thêm các dấu \ phía trước các kí tự đặc biệt để nó biến thành định dạng string.<br></p>
                <figure class="highlight php">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="meta">&lt;?php</span></span><br><span class="line">$str = <span class="string">"Is your name O'Reilly?"</span>;</span><br><span class="line"><span class="keyword">echo</span> addslashes($str);</span><br><span class="line"><span class="comment"># Outputs: Is your name O\'Reilly?  =&gt; Có thêm dấu \ trước kí tự '</span></span><br><span class="line"><span class="meta">?&gt;</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
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