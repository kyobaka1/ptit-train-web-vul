<main class="main has-sticky" role="main">
    <div class="content">
        <article id="post-php_object_injection/der" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    Tổng Quan Về PHP Object Injection
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a><?php if($src_youtube != ''){echo '<button id="introduce-btn"><img src="public/images/play-circle.png" class="img-circle img-rotate" style="height: 24px; width: 24px; margin-right: 5px" " />Hướng Dẫn</button>';} ?>

                </div>
            </div>
            <?php echo get_iframe_youtube($src_youtube); ?>
            <div class="article-entry marked-body" itemprop="articleBody">
                <h1 id="Lo-hong-tren-deserialization"><a href="#Lo-hong-tren-deserialization" class="headerlink" title="Lỗ hổng trên deserialization"></a>Lỗ hổng trên deserialization</h1>
                <p>Như ta đã tìm hiểu ở bài trước, Deserialization là quá trình ngược lại của serialization, tức là chuyển hoá từ dữ liệu có thể lưu được sang các định dạng ban đầu của nó.</p>
                <p>Lỗ hổng Insecure Deserialization diễn ra khi mà những thông tin không đáng tin cậy được sử dụng, nó lạm dụng các logic của ứng dụng (logic của serialize và unserialize) và gây ra các loại tấn công khác nhau.</p>
                <p>Cuộc tấn công Insecure Deserialization thành công, có thể:</p>
                <ul>
                    <li>Tấn công từ chối dịch vụ (Denial-of-serivce)</li>
                    <li>Access control</li>
                    <li>Thậm chí là RCE (Remote Code Execution)</li>
                </ul>
                <p>Insecure Deserialization được tìm thấy trong hầu hết các ngôn ngữ lập trình web hiện tại. Java là ngôn ngữ ảnh hưởng nhiều nhất, vì nó là ngôn ngữ thuần OOP, dùng cơ chế serialize quá nhiều.</p>
                <p>Còn trong ngôn ngữ PHP, loại tấn công này được gọi là <strong>PHP Object Injection</strong></p>
                <h1 id="PHP-Object-Injection"><a href="#PHP-Object-Injection" class="headerlink" title="PHP Object Injection"></a>PHP Object Injection</h1>
                <h2 id="Khai-niem"><a href="#Khai-niem" class="headerlink" title="Khái niệm"></a>Khái niệm</h2>
                <p><strong>PHP Object Injection</strong> là lỗ hổng bảo mật ở lớp ứng dụng cho phép kẻ tấn công có thể thực hiện rất nhiều hành động, mã độc nguy hiểm như SQL Injection, Code Injection, Path Traversal, DOS.. Tuỳ thuộc vào bối cảnh logic của ứng dụng hiện tại.</p>
                <h2 id="Nguyen-nhan"><a href="#Nguyen-nhan" class="headerlink" title="Nguyên nhân"></a>Nguyên nhân</h2>
                <p>Nó diễn ra khi mà thông tin do người dùng cung cấp không được kiểm tra kĩ càng trước khi đưa vào hàm <strong>unserialize()</strong>.<br></p>
                <figure class="highlight php">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="meta">&lt;?php</span></span><br><span class="line">$user_data = $_GET[<span class="string">'data'</span>];</span><br><span class="line">unserialize($user_data);  <span class="comment"># =&gt; Lỗ hổng nằm tại đây!</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <h2 id="Dieu-kien-xay-ra"><a href="#Dieu-kien-xay-ra" class="headerlink" title="Điều kiện xảy ra"></a>Điều kiện xảy ra</h2>
                <p>Để một cuộc tấn công PHP Object Injection thành công, cần có 2 điều kiện phải có như sau:</p>
                <ul>
                    <li>Ứng dụng đó phải có một class implement PHP magic method <strong>(như là _toString, _wakeup, _construct..)</strong> có thể sử dụng để thực thi các hành động nguy hại.</li>
                    <li>Toàn bộ các class được sử dụng để tấn công phải được <strong>declared</strong> khi lỗ hổng unserialize() được gọi. Mặt khác <strong>object autoloading</strong> phải hỗ trợ cho class đó.</li>
                </ul>
                <h1 id="PHP-Classes-and-Objects"><a href="#PHP-Classes-and-Objects" class="headerlink" title="PHP Classes and Objects"></a>PHP Classes and Objects</h1>
                <p>Class và object trong PHP rất dễ hiểu. Nếu không hiểu,hãy trau dồi thêm về lập trình hướng đối tượng OOP nhé.</p>
                <h2 id="Vi-du"><a href="#Vi-du" class="headerlink" title="Ví dụ"></a>Ví dụ</h2>
                <figure class="highlight php">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br><span class="line">8</span><br><span class="line">9</span><br><span class="line">10</span><br><span class="line">11</span><br><span class="line">12</span><br><span class="line">13</span><br><span class="line">14</span><br><span class="line">15</span><br><span class="line">16</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="meta">&lt;?php</span></span><br><span class="line"><span class="class"><span class="keyword">class</span> <span class="title">TestClass</span></span></span><br><span class="line"><span class="class"></span>{</span><br><span class="line">    <span class="comment">// A variable</span></span><br><span class="line">    <span class="keyword">public</span> $variable = <span class="string">'This is a string'</span>;</span><br><span class="line">    <span class="comment">// A simple method</span></span><br><span class="line">    <span class="keyword">public</span> <span class="function"><span class="keyword">function</span> <span class="title">PrintVariable</span><span class="params">()</span></span></span><br><span class="line"><span class="function">    </span>{</span><br><span class="line">        <span class="keyword">echo</span> <span class="keyword">$this</span>-&gt;variable;</span><br><span class="line">    }</span><br><span class="line">}</span><br><span class="line"><span class="comment">// Create an object</span></span><br><span class="line">$object = <span class="keyword">new</span> TestClass();</span><br><span class="line"><span class="comment">// Call a method</span></span><br><span class="line">$object-&gt;PrintVariable(); <span class="comment"># Kết quả: This is a string.</span></span><br><span class="line"><span class="meta">?&gt;</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p>Có thể học thêm tại: <a href="http://php.net/manual/en/language.oop5.php" target="_blank" rel="noopener">http://php.net/manual/en/language.oop5.php</a></p>
                <h1 id="PHP-magic-methods"><a href="#PHP-magic-methods" class="headerlink" title="PHP magic methods"></a>PHP magic methods</h1>
                <p>PHP classes có thể chứa một số các hàm đặc biệt, được gọi là magic functions.<br>Tên của magic functions được bắt đầu bởi 2 dấu _, ví dụ: <strong>_construct, _destruct, _toString, _sleep, _wakeup và một số hàm khác</strong>.<br>Mỗi hàm trên sẽ được tự động gọi đến trong các các trường hợp khác nhau. Hãy nhớ rõ “tự động” gọi đến nhé, nó chính là nơi mà kẻ tấn công lợi dụng đó.<br>Ví dụ:</p>
                <ul>
                    <li>_construct sẽ được gọi đến khi object được khởi tạo (constructor)</li>
                    <li>_destruct sẽ được gọi khi đối tượng bị huỷ (destructor)</li>
                    <li>_toString được gọi khi đối tượng được dùng như 1 string, như là in ra.</li>
                    <li>_sleep là hàm được gọi đến khi đối tượng bị serialized.</li>
                    <li>_wakeup là hàm được gọi đến khi đối tượng bị deserialized</li>
                </ul>
                <figure class="highlight php">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br><span class="line">8</span><br><span class="line">9</span><br><span class="line">10</span><br><span class="line">11</span><br><span class="line">12</span><br><span class="line">13</span><br><span class="line">14</span><br><span class="line">15</span><br><span class="line">16</span><br><span class="line">17</span><br><span class="line">18</span><br><span class="line">19</span><br><span class="line">20</span><br><span class="line">21</span><br><span class="line">22</span><br><span class="line">23</span><br><span class="line">24</span><br><span class="line">25</span><br><span class="line">26</span><br><span class="line">27</span><br><span class="line">28</span><br><span class="line">29</span><br><span class="line">30</span><br><span class="line">31</span><br><span class="line">32</span><br><span class="line">33</span><br><span class="line">34</span><br><span class="line">35</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="meta">&lt;?php</span></span><br><span class="line"><span class="class"><span class="keyword">class</span> <span class="title">TestClass</span></span></span><br><span class="line"><span class="class"></span>{</span><br><span class="line">    <span class="comment">// A variable</span></span><br><span class="line">    <span class="keyword">public</span> $variable = <span class="string">'This is a string'</span>;</span><br><span class="line">    <span class="comment">// A simple method</span></span><br><span class="line">    <span class="keyword">public</span> <span class="function"><span class="keyword">function</span> <span class="title">PrintVariable</span><span class="params">()</span></span></span><br><span class="line"><span class="function">    </span>{</span><br><span class="line">        <span class="keyword">echo</span> <span class="keyword">$this</span>-&gt;variable . <span class="string">'&lt;br /&gt;'</span>;</span><br><span class="line">    }   </span><br><span class="line">    <span class="comment">// Constructor </span></span><br><span class="line">    <span class="keyword">public</span> <span class="function"><span class="keyword">function</span> <span class="title">__construct</span><span class="params">()</span></span></span><br><span class="line"><span class="function">    </span>{</span><br><span class="line">        <span class="keyword">echo</span> <span class="string">'__construct &lt;br /&gt;'</span>;</span><br><span class="line">    }</span><br><span class="line">    <span class="comment">// Destructor     </span></span><br><span class="line">    <span class="keyword">public</span> <span class="function"><span class="keyword">function</span> <span class="title">__destruct</span><span class="params">()</span></span></span><br><span class="line"><span class="function">    </span>{</span><br><span class="line">        <span class="keyword">echo</span> <span class="string">'__destruct &lt;br /&gt;'</span>;</span><br><span class="line">    }   </span><br><span class="line">    <span class="comment">// Call  </span></span><br><span class="line">    <span class="keyword">public</span> <span class="function"><span class="keyword">function</span> <span class="title">__toString</span><span class="params">()</span></span></span><br><span class="line"><span class="function">    </span>{</span><br><span class="line">        <span class="keyword">return</span> <span class="string">'__toString&lt;br /&gt;'</span>;</span><br><span class="line">    }</span><br><span class="line">}</span><br><span class="line">$object = <span class="keyword">new</span> TestClass();</span><br><span class="line">$object-&gt;PrintVariable();</span><br><span class="line"><span class="keyword">echo</span> $object;</span><br><span class="line"><span class="meta">?&gt;</span></span><br><span class="line"><span class="comment"># Kết quả sẽ là:</span></span><br><span class="line">__construct </span><br><span class="line">This is a string</span><br><span class="line">__toString</span><br><span class="line">__destruct</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p>Khi khởi tạo đối tượng, nó sẽ gọi ra hàm _construct, sau đó ta gọi đến PrintVariable() nên nó in ra This is a string.<br>Tiếp theo, echo đối tượng ra,nó được dùng như 1 stỉng nên hàm _toString được gọi đến.<br>Cuối cùng khi đoạn code kết thúc,đối tượng bị huỷ nên hàm _destruct được gọi đến.</p>
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