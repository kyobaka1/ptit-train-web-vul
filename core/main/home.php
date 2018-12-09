<main class="main" role="main">
    <div class="content">
        <article id="post-home" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    WELCOME TO WEB APPLICATION TRAINNING - PTITHCM
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a>
                    <?php if($src_youtube != ''){echo '<button id="introduce-btn"><img src="public/images/play-circle.png" class="img-circle img-rotate" style="height: 24px; width: 24px; margin-right: 5px" " />Hướng Dẫn</button>';} ?>
                </div>
            </div>
            <?php echo get_iframe_youtube($src_youtube); ?>
            <div class="article-entry marked-body" itemprop="articleBody">
                <p><strong>WEB APPLICATION TRAINNING - PTITHCM</strong> là ứng dụng web phục vụ công việc học tập, thực hành các lỗ hổng website trên ngôn ngữ <strong>PHP/MySQL</strong>.<br>Ứng dụng cung cấp:</p>
                <ul>
                    <li>Kiến thức về các lỗ hổng tồn tại trên website.</li>
                    <li>Hướng dẫn các cách tấn công,xâm nhập dựa vào các lỗ hổng này.</li>
                    <li>Hướng dẫn các cách phòng thủ,vá các lỗ hổng này trên website.</li>
                </ul>
                <p>Mục tiêu là giúp cho các <strong>sinh viên/học sinh</strong> trong ngành Công Nghệ Thông Tin nói chung và ngành An Toàn Thông Tin nói riêng có thể tiếp cận nhanh chóng và hệ thống với các lỗ hổng tồn tại trên website. Đồng thời kiểm tra/rèn luyện kĩ năng bản thân trong việc khai thác và khắc phục các lỗ hổng trên ứng dụng web.</p>
                <h1 id="Gioi-Thieu-Chung"><a href="#Gioi-Thieu-Chung" class="headerlink" title="Giới Thiệu Chung"></a>Giới Thiệu Chung</h1>
                <p>Do nhận thấy trong quá trình nghiên cứu về An Toàn Thông Tin (Lỗ hổng bảo mật),các kiến thức chủ yếu được góp nhặt trên nguồn Internet. Nên chưa được hệ thống hoá một cách quá rõ ràng, gây tổn hao về thời gian và công sức cho các bạn sinh viên trong quá trình nghiên cứu nhưng kiến thức đạt được chưa hẳn như mong muốn.<br>Nên <a href="https://www.facebook.com/dnvuongis95" target="_blank" rel="noopener">mình</a> đã xây dựng ứng dụng này, mong có thể giúp đỡ ít nhiều cho công việc học tập và giảng dạy dễ dàng hơn.</p>
                <h1 id="Yeu-Cau-Co-Ban"><a href="#Yeu-Cau-Co-Ban" class="headerlink" title="Yêu Cầu Cơ Bản"></a>Yêu Cầu Cơ Bản</h1>
                <p><strong>PTITHCM-IS V2 Trainning</strong> là ứng dụng web xây dựng trên ngôn ngữ <strong>PHP/MySQL</strong>. Do đó, người học cần có kiến thức cơ bản về sử dụng ngôn ngữ lập trình PHP và SQL.<br>Để học lập trình ngôn ngữ PHP, các bạn có thể học tại:</p>
                <ul>
                    <li><strong>[W3SCHOOL PHP]</strong>(<a href="https://www.w3schools.com/php/" target="_blank" rel="noopener">https://www.w3schools.com/php/</a>)</li>
                    <li><strong>[PHP.NET]</strong>(<a href="http://php.net/" target="_blank" rel="noopener">http://php.net/</a>)</li>
                    <li><strong>[TUTORIALS POINT PHP]</strong>(<a href="https://www.tutorialspoint.com/php/" target="_blank" rel="noopener">https://www.tutorialspoint.com/php/</a>)</li>
                </ul>
                <p>Để học SQL, các bạn có thể cố gắng học môn CƠ SỞ DỮ LIỆU, và học online tại:</p>
                <ul>
                    <li><strong>[W3SCHOOL SQL]</strong>(<a href="https://www.w3schools.com/sql/" target="_blank" rel="noopener">https://www.w3schools.com/sql/</a>)</li>
                    <li><strong>[GeekForGeeks SQL]</strong>(<a href="https://www.geeksforgeeks.org/sql-tutorial/" target="_blank" rel="noopener">https://www.geeksforgeeks.org/sql-tutorial/</a>)</li>
                </ul>
                <h1 id="Canh-Bao"><a href="#Canh-Bao" class="headerlink" title="Cảnh Báo"></a>Cảnh Báo</h1>
                <p>Ứng dụng website <strong>WEB APPLICATION TRAINNING - PTITHCM</strong> có rất nhiều lỗ hổng. Vui lòng không nên cung cấp dưới dạng public lên hosting của bạn.<br>Hãy cài đặt nó trên các công cụ giả lập như VirtualBox hay VMware.</p>
            </div>
        </article>
        <section id="comments">
            <div id="vcomments"></div>
        </section>
    </div>
</main>