<main class="main has-sticky" role="main">
    <div class="content">
        <article id="post-php_object_injection/khainiem" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    Serialization
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a>
                    <?php if($src_youtube != ''){echo '<button id="introduce-btn"><img src="public/images/play-circle.png" class="img-circle img-rotate" style="height: 24px; width: 24px; margin-right: 5px" " />Hướng Dẫn</button>';} ?>
                </div>
            </div>
            <?php echo get_iframe_youtube($src_youtube); ?>
            <div class="article-entry marked-body" itemprop="articleBody">
                <p>Các ngôn ngữ lập trình website bậc cao như PHP, Java hay ASP thì không thể nào không cung cấp cơ chế lập trình hướng đối tượng (OOP).<br>Khi làm việc với những đối tượng (object) hay data struct thì việc lưu trữ nó thế nào là một công việc cần thiết.</p>
                <h1 id="Khai-niem"><a href="#Khai-niem" class="headerlink" title="Khái niệm"></a>Khái niệm</h1>
                <p><strong>Serialization (or serialisation)</strong> là một tiến trình mỗi ngôn ngữ này đểu cung cấp, công việc của nó là biên dịch từ data structures hay kiểu object thành một định dạng có thể lưu được (như là 1 file, buffer hay string).</p>
                <p>Đồng thời cũng cung cấp cơ chế <strong>deserialization</strong> để đọc từ những dữ liệu này và chuyển nó thành dạng object hay struct ban đầu.</p>
                <p>Ngoài mục đích lưu trữ, nó còn dùng để truyền gửi dữ liệu qua mạng.</p>
                <h1 id="Serialization-trong-PHP"><a href="#Serialization-trong-PHP" class="headerlink" title="Serialization trong PHP"></a>Serialization trong PHP</h1>
                <p>Trong PHP, làm việc với serialization bao gồm:</p>
                <ul>
                    <li><strong>serialize()</strong></li>
                    <li><strong>unserialize()</strong></li>
                </ul>
                <h2 id="Serialize"><a href="#Serialize" class="headerlink" title="Serialize"></a>Serialize</h2>
                <ul>
                    <li><strong>Nguồn</strong>: <a href="http://php.net/manual/en/function.serialize.php" target="_blank" rel="noopener">http://php.net/manual/en/function.serialize.php</a></li>
                </ul>
                <p>Là hàm dùng để tạo một tượng trưng có thể lưu trữ được của 1 giá trị.<br>Cấu trúc:</p>
                <blockquote>
                    <p>string serialize ( mixed $value )</p>
                </blockquote>
                <h3 id="Vi-du"><a href="#Vi-du" class="headerlink" title="Ví dụ"></a>Ví dụ</h3>
                <figure class="highlight php">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br><span class="line">8</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="meta">&lt;?php</span></span><br><span class="line"><span class="class"><span class="keyword">class</span> <span class="title">PTITHCM</span></span>{</span><br><span class="line">	<span class="keyword">private</span> $address = <span class="string">'97 Man Thiện, Q9'</span>;</span><br><span class="line">	<span class="keyword">private</span> $nganh = <span class="string">'ATTT'</span>;</span><br><span class="line">	<span class="keyword">private</span> <span class="function"><span class="keyword">function</span> <span class="title">DoAn</span><span class="params">()</span></span>{</span><br><span class="line">		<span class="keyword">return</span> <span class="string">"10 điểm!"</span>;</span><br><span class="line">	}</span><br><span class="line">}</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p>Ta có class với các thuộc tính như trên.<br>Sau đó,ta dùng serialize để chuyển sang định dạng có thể lưu được như sau:<br></p>
                <figure class="highlight php">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="meta">&lt;?php</span></span><br><span class="line">$my_uni = <span class="keyword">new</span> PTITHCM();</span><br><span class="line"><span class="keyword">echo</span> serialize($my_uni);</span><br><span class="line"><span class="comment">// Kết quả: O:7:"PTITHCM":2:{s:16:"PTITHCMaddress";s:18:"97 Man Thiện, Q9";s:14:"PTITHCMnganh";s:4:"ATTT";}</span></span><br><span class="line"><span class="meta">?&gt;</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <h2 id="Unserialize"><a href="#Unserialize" class="headerlink" title="Unserialize"></a>Unserialize</h2>
                <ul>
                    <li><strong>Nguồn</strong>: <a href="http://php.net/manual/en/function.unserialize.php" target="_blank" rel="noopener">http://php.net/manual/en/function.unserialize.php</a></li>
                </ul>
                <p>Là hàm ngược lại với serialize(), nó chuyển từ định dạng lưu trữ được sang một PHP value.<br>Cấu trúc:</p>
                <blockquote>
                    <p>mixed unserialize ( string $str [, array $options ] )</p>
                </blockquote>
                <figure class="highlight php"><table><tbody><tr><td class="gutter"><pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br></pre></td><td class="code"><pre><span class="line"><span class="meta">&lt;?php</span></span><br><span class="line">$stored = <span class="string">'Tzo3OiJQVElUSENNIjoyOntzOjE2OiIAUFRJVEhDTQBhZGRyZXNzIjtzOjE4OiI5NyBNYW4gVGhp4buHbiwgUTkiO3M6MTQ6IgBQVElUSENNAG5nYW5oIjtzOjQ6IkFUVFQiO30='</span>;</span><br><span class="line">print_r(unserialize(base64_decode($stored)));</span><br><span class="line"><span class="comment"># Kết quả: PTITHCM Object ( [address:PTITHCM:private] =&gt; 97 Man Thiện, Q9 [nganh:PTITHCM:private] =&gt; ATTT )</span></span><br></pre></td></tr></tbody></table></figure>
                <p>Ta dùng dạng base64 bởi vì có thể một số kí tự hiển thị ra không được (nullbyte chẳng hạn), nếu ta copy và past bằng String thì có thể sai.</p>
                <h1 id="Lo-hong-Deserialization"><a href="#Lo-hong-Deserialization" class="headerlink" title="Lỗ hổng Deserialization"></a>Lỗ hổng Deserialization</h1>
                <p>Khi có cơ chế,có chức năng thì sẽ có lỗ hổng. Bởi vì phá hoại luôn dễ dàng hơn xây dựng mà.</p>
                <p>Lỗ hổng của serialisation được gọi là <strong>Deserialization</strong></p>
                <p>Được xếp hạng 8 trong top 10 OWASP. Không phải vì nó không nguy hiểm, mà nó cần thêm nhiều điều kiện khác để có thể khai thác thành công.</p>
                <p>Còn Deserialization trong PHP được gọi là <strong>PHP Object Injection</strong>.</p>
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