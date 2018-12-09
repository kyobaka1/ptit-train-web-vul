<main class="main has-sticky" role="main">
    <div class="content">
        <article id="post-xss/xss_phongchong_coban" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    Nguyên lý phòng chống XSS
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a>
               <?php if($src_youtube != ''){echo '<button id="introduce-btn"><img src="public/images/play-circle.png" class="img-circle img-rotate" style="height: 24px; width: 24px; margin-right: 5px" " />Hướng Dẫn</button>';} ?>
                </div>
            </div>
            <?php echo get_iframe_youtube($src_youtube); ?>
            <div class="article-entry marked-body" itemprop="articleBody">
                <p>Việc phòng chống XSS <strong>không khó</strong>.<br>Nhưng mọi người lại hay quên và không để ý đến nó dẫn đến việc XSS là một số trong các lỗi phổ biến nhất trên các website.<br>Đừng nghĩ những người nhà phát triển còn non kinh nghiệm mới bị, vì đa phần các framework cũng khá nhiều dính lỗi XSS.</p>
                <h1 id="Nguyen-ly-chong-XSS"><a href="#Nguyen-ly-chong-XSS" class="headerlink" title="Nguyên lý chống XSS"></a>Nguyên lý chống XSS</h1>
                <p>Tóm gọn lại trong 4 từ <strong>filter input, escape output</strong>. Mà thật ra 1 trong 2 của nó thôi cũng đủ để phòng chống XSS.<br>Vậy nguyên lý chống lại XSS là như thế nào?</p>
                <h2 id="Co-che-hien-thi-cua-HTML"><a href="#Co-che-hien-thi-cua-HTML" class="headerlink" title="Cơ chế hiển thị của HTML"></a>Cơ chế hiển thị của HTML</h2>
                <p>Có một cơ chế của ngôn ngữ HTML, đó chính là encode các kí tự đặc biệt,để có thể hiển thị chúng khi không muốn xem chúng là một phần của html.<br>Ví dụ: Ta muốn hiện <strong>&lt;h1&gt;Hello&lt;/h1&gt;</strong> dưới dạng text,tức là không phải là thẻ h1 của HTML. Nhưng khi cho vào thì nó cứ hiện thế này:</p>
                <h1>Hello</h1>
                <p>Thế nên ta encode sang HTML, ví dụ dấu &lt; sẽ được chuyển thành chuỗi <strong>&amp;lt ;</strong><br>Vậy ta có thể hiển thị ra: &lt;h1&gt;Hello&lt;/h1&gt;<br>Tương tự với các thẻ &lt;script&gt; ,vì nó cũng cấu thành bởi các dấu &lt; / &gt; mà.</p>
                <p>Do đó, nó sẽ được hiểu là text,chứ không phải là thẻ javascript nữa.</p>
                <h2 id="Filter-input"><a href="#Filter-input" class="headerlink" title="Filter input"></a>Filter input</h2>
                <p>Ngăn việc họ chèn vào các kí tự để cấu tạo nên các đoạn mã độc:</p>
                <ul>
                    <li>Các kí tự đặc biệt &lt; &gt; / “ ‘..</li>
                    <li>Các keywork: script, document.cookie…</li>
                </ul>
                <h2 id="Escape-output"><a href="#Escape-output" class="headerlink" title="Escape output"></a>Escape output</h2>
                <p>Tức là trước khi dùng dữ liệu đó cho người dùng, hãy encode nó sang dạng html kí tự đặc biệt.<br>Họ thích nhập gì thì nhập, làm gì thì làm, dù gì thì nó cũng không được xem là đoạn mã html,javascript khi trả về cho người dùng nữa.</p>
                <h2 id="Sanitizing"><a href="#Sanitizing" class="headerlink" title="Sanitizing"></a>Sanitizing</h2>
                <p>Khác escape output một chút,là làm vệ sinh khi mà nhận dữ liệu người dùng vào luôn. Rồi sau đó mới đem đi xử lý rồi trả về cho người dùng.</p>
                <h1 id="kt-gy"><a href="#kt-gy" class="headerlink" title="kt.gy"></a>kt.gy</h1>
                <p>Nếu muốn biết encode sang html như thế nào,các bạn hãy xem ở đây. Gõ vào mã ASCII và xem ở cột HTML.</p>
                <h1 id="Tham-khao"><a href="#Tham-khao" class="headerlink" title="Tham khảo"></a>Tham khảo</h1>
                <ul>
                    <li><strong>OWASP Prevent XSS</strong>: <a href="https://www.owasp.org/index.php/XSS_(Cross_Site_Scripting)_Prevention_Cheat_Sheet" target="_blank" rel="noopener">https://www.owasp.org/index.php/XSS_(Cross_Site_Scripting)_Prevention_Cheat_Sheet</a></li>
                    <li><strong>Checkmarx</strong>: <a href="https://www.checkmarx.com/2017/10/09/3-ways-prevent-xss/" target="_blank" rel="noopener">https://www.checkmarx.com/2017/10/09/3-ways-prevent-xss/</a></li>
                </ul>
            </div>
        </article>                    <?php
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