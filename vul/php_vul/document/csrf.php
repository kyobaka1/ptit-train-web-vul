<main class="main" role="main">
    <div class="content">
        <article id="post-csrf/csrf" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    Cross Site Request Forgery (CSRF)
                </h1>
                <div class="article-meta">

                </div>
            </div>
            <div class="article-entry marked-body" itemprop="articleBody">
                <h1 id="Tong-Quan"><a href="#Tong-Quan" class="headerlink" title="Tổng Quan"></a>Tổng Quan</h1>
                <p><strong>CSRF (Cross Site Request Forgecy)</strong> là kỹ thuật tấn công mà kẻ tấn công ép người dùng thực thi hành động không mong muốn trên quyền của chính bản thân user trên một ứng dụng web mà họ đã chứng thực (đăng nhập).<br><strong>CSRF</strong> chỉ thay đổi trạng thái, thông tin của requests, không phải đánh cắp dữ liệu,vì kẻ tấn công không có cách nào để xem phản hồi từ request đó.<br>Với một chút trợ giúp về kĩ thuật tấn công xã hội (social engineering), chẳng hạn như gửi liên kết qua email hoặc trò chuyện, kẻ tấn công có thể lừa người dùng thực hiện một hành động mà kẻ tấn công lựa chọn:</p>
                <ul>
                    <li>Nếu là người dùng thường có thể thực hiện các yêu cầu như gửi tiền,đổi password..</li>
                    <li>Nếu là người quản trị, CSRF có thể thông qua đó điều khiển ứng dụng.</li>
                </ul>
                <h2 id="Ly-do-vi-sao-CSRF-ton-tai"><a href="#Ly-do-vi-sao-CSRF-ton-tai" class="headerlink" title="Lý do vì sao CSRF tồn tại?"></a>Lý do vì sao CSRF tồn tại?</h2>
                <p>Server ghi nhận các hành động của client/user muốn làm thông qua các request và xác thực họ dựa trên cookie đang lưu trên trình duyệt và session lưu trên server.<br>Vậy nếu kẻ tấn công,có thể đánh lừa nạn nhân gửi các requests từ chính máy của mình (cookie của mình), với những tham số đúng như server đã yêu cầu. Vậy đó được server xem như một yêu cầu/ hành động hợp lệ của nạn nhân và thực thi nó.</p>
                <p>Server không có cách nào để nhận ra đâu là hành vi hợp lệ và không hợp lệ. Nhưng đó, không phải là lỗi do người dùng. Lỗi do nhà phát triển web đã không áp dụng những kỹ thuật phòng chống cho loại tấn công này.</p>
                <h2 id="Vi-du"><a href="#Vi-du" class="headerlink" title="Ví dụ"></a>Ví dụ</h2>
                <p><strong>Kịch bản</strong>: Người dùng A muốn chuyển tiền cho người dùng B với số tài khoản 123, thì request có dạng:</p>
                <blockquote>
                    <p><a href="http://victim.com/?action=chuyentien&amp;sotaikhoan=123&amp;sotien=1000" target="_blank" rel="noopener">http://victim.com/?action=chuyentien&amp;sotaikhoan=123&amp;sotien=1000</a></p>
                </blockquote>
                <p>Khi họ đã đăng nhập và gửi request này lên server thì server sẽ xử lý và xác nhận việc chuyển tiền này.</p>
                <p><strong>Kẻ tấn công</strong> bằng cách nào đó, gửi đường dẫn URL:</p>
                <blockquote>
                    <p><a href="http://victim.com/?action=chuyentien&amp;sotaikhoan=456&amp;sotien=10000" target="_blank" rel="noopener">http://victim.com/?action=chuyentien&amp;sotaikhoan=456&amp;sotien=10000</a></p>
                </blockquote>
                <p>Với 456 là số tài khoản của hắn. Nạn nhân vô tình click vào link này,trong khi vẫn giữ cookie của trang web đó.</p>
                <p><strong>Bùm</strong>, nạn nhân đã mất 10000$.</p>
                <h1 id="Cach-phong-chong-CSRF"><a href="#Cach-phong-chong-CSRF" class="headerlink" title="Cách phòng chống CSRF"></a>Cách phòng chống CSRF</h1>
                <p>Có rất nhiều kỹ thuật để phòng chống CSRF, vấn đề là nó không thể hoạt động hiệu quả khi chỉ triển khai 1 mình mà không có sự gắn kết giữa các biện pháp.</p>
                <h2 id="Su-dung-secret-token-captcha"><a href="#Su-dung-secret-token-captcha" class="headerlink" title="Sử dụng secret token /captcha"></a>Sử dụng secret token /captcha</h2>
                <p>Mỗi token sẽ được tạo ra với mỗi request đến server và trả về cho người dùng. Nếu muốn thực hiện một hành động, người dùng phải submit cả token đã nhận được (tự động làm, ko phải người dùng cần can thiệp).<br>Nếu token được submit trùng với token đã được tạo ra và gửi cho người dùng, hành động đó mới được chấp nhận.<br>Captcha là một dạng của token.</p>
                <h3 id="Vi-du-1"><a href="#Vi-du-1" class="headerlink" title="Ví dụ"></a>Ví dụ</h3>
                <p>Server tạo token ngẫu nhiên và gửi về cho client người dùng form như sau:<br></p>
                <figure class="highlight html">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="tag">&lt;<span class="name">form</span>&gt;</span></span><br><span class="line">	<span class="tag">&lt;<span class="name">input</span> <span class="attr">type</span>=<span class="string">"hidden"</span> <span class="attr">name</span>=<span class="string">"token"</span> <span class="attr">value</span>=<span class="string">"abcd"</span> /&gt;</span></span><br><span class="line">	<span class="tag">&lt;<span class="name">input</span> <span class="attr">.....</span> /&gt;</span></span><br><span class="line">	<span class="tag">&lt;<span class="name">input</span> <span class="attr">type</span>=<span class="string">"submit"</span> /&gt;</span></span><br><span class="line"><span class="tag">&lt;/<span class="name">form</span>&gt;</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <p>Vậy khi thực hiện form này, token sẽ được kèm theo trong đó. Server sẽ kiểm tra xem nó có bằng abcd không?</p>
                <p><strong>Kẻ tấn công</strong> chỉ có thể yêu cầu người dùng thực hiện request, chứ họ ko phải trình duyệt client để biết được token này.</p>
                <h3 id="Bypass-XSS-co-the-nhan-duoc-token-nay-va-ket-hop-vs-CSRF"><a href="#Bypass-XSS-co-the-nhan-duoc-token-nay-va-ket-hop-vs-CSRF" class="headerlink" title="Bypass: XSS có thể nhận được token này và kết hợp vs CSRF."></a>Bypass: XSS có thể nhận được token này và kết hợp vs CSRF.</h3>
                <h2 id="Chi-chap-nhan-du-lieu-tu-POST"><a href="#Chi-chap-nhan-du-lieu-tu-POST" class="headerlink" title="Chỉ chấp nhận dữ liệu từ POST."></a>Chỉ chấp nhận dữ liệu từ POST.</h2>
                <p>Nếu các thông tin được nhập từ URL tức là dùng GET, dễ dàng bị kẻ tấn công lợi dụng. Còn form POST,chỉ URL không thể nào thay đổi nội dung của POST được.</p>
                <h3 id="Bypass-Van-la-XSS"><a href="#Bypass-Van-la-XSS" class="headerlink" title="Bypass: Vẫn là XSS."></a>Bypass: Vẫn là XSS.</h3>
                <h2 id="URL-Rewwriting"><a href="#URL-Rewwriting" class="headerlink" title="URL Rewwriting"></a>URL Rewwriting</h2>
                <p>Viết lại URL có thể phòng chống CSRF và một số các kiểu tấn công dựa vào URL để tấn công như SQLi, Reflected XSS.</p>
                <h2 id="HTTPS"><a href="#HTTPS" class="headerlink" title="HTTPS"></a>HTTPS</h2>
                <p>Dùng SSL ở đây là phòng chống cơ chế tấn công <strong>“Man in the middle”</strong>. Khi kẻ tấn công bắt lại gói tin của người dùng, sau đó thay đổi rồi gửi nó lên server.</p>
                <h1 id="Tham-Khao"><a href="#Tham-Khao" class="headerlink" title="Tham Khảo"></a>Tham Khảo</h1>
                <ul>
                    <li><strong>OWASP</strong>: <a href="https://www.owasp.org/index.php/Cross-Site_Request_Forgery_(CSRF)" target="_blank" rel="noopener">https://www.owasp.org/index.php/Cross-Site_Request_Forgery_(CSRF)</a></li>
                    <li><strong>Gracefulsecurity</strong>:<br><a href="https://www.gracefulsecurity.com/what-is-cross-site-request-forgery/" target="_blank" rel="noopener">https://www.gracefulsecurity.com/what-is-cross-site-request-forgery/</a></li>
                </ul>
            </div>
        </article>
        <section id="comments">
            <div id="vcomments"></div>
        </section>
    </div>

</main>