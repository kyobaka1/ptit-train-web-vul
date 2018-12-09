<main class="main" role="main">
    <article class="content article article-archives article-type-list" itemscope="">
        <header class="article-header">
            <h1 itemprop="title">[THƯ MỤC] SQL INJECTION</h1>
            <p class="text-muted">Note: Nhớ học về và nắm vững ngôn ngữ SQL đã nhé!</p>
        </header>
        <p>Một cuộc tấn công <b>SQL Injection</b> là việc <b>'thêm'</b> hoặc <b>'tiêm'</b> vào 1 câu lệnh SQL Query thông qua dữ liệu được nhập vào bởi người dùng để thực thi các hành động bất hợp pháp.</p>
        <div class="article-entry marked-body" itemprop="articleBody">
            <h3 id="rank"><a href="#rank" class="headerlink" title="rank"></a>Xếp Hạng</h3>
            <p>SQLi luôn được xếp hạng nguy hiểm <b>nhất</b> bởi OWASP.</p>
        </div>
        <div class="article-body">
            <section class="panel panel-default b-no">
                <div class="panel-heading" role="tab">
                    <h3 class="panel-title">
                        <a data-toggle="collapse" href="#kienthuctongquan" aria-expanded="true">

                            <b>[DOCUMENT] KIẾN THỨC TỔNG QUAN</b>
                        </a>
                    </h3>
                </div>
                <div id="kienthuctongquan" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="kienthuctongquan">
                    <div class="panel-body">
                        <div class="collection">
                            <a href="index.php?page=sqli_tongquan" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['sqli_tongquan']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> Tổng Quan
                            </a>
                            <a href="index.php?page=sqli_phanloai" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['sqli_phanloai']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> Phân loại SQL Injection
                            </a>
                        </div>
                    </div>
                </div>
                <div class="panel-heading" role="tab">
                    <h3 class="panel-title">
                        <a data-toggle="collapse" href="#kithuattancong" aria-expanded="true">

                            <b>[DOCUMENT] KĨ THUẬT TẤN CÔNG</b>
                        </a>
                    </h3>
                </div>
                <div id="kithuattancong" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="kithuattancong">
                    <div class="panel-body">
                        <div class="collection">
                            <a href="index.php?page=sqli_tancong_coban" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['sqli_tancong_coban']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> SQL Injection Cơ Bản (Union Based SQLi)
                            </a>
                            <a href="index.php?page=sqli_tancong_blind" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['sqli_tancong_blind']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> Blind SQL Injection
                            </a>
                            <a href="index.php?page=sqli_tancong_other" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['sqli_tancong_other']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> Một số dạng SQL Injection khác.
                            </a>
                        </div>
                    </div>
                </div>
                <div class="panel-heading" role="tab">
                    <h3 class="panel-title">
                        <a data-toggle="collapse" href="#kithuattancong" aria-expanded="true">

                            <b>[DOCUMENT] PHÒNG CHỐNG SQL INJECTION</b>
                        </a>
                    </h3>
                </div>
                <div id="phongchong" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="kithuattancong">
                    <div class="panel-body">
                        <div class="collection">
                            <a href="index.php?page=sqli_phongchong_coban" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['sqli_phongchong_coban']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> Nguyên lý phòng chống SQL Injection
                            </a>
                            <a href="index.php?page=sqli_phongchong_php" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['sqli_phongchong_php']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> Phòng Chống SQL Injection Trong PHP
                            </a>
                        </div>
                    </div>
                </div>
                <div class="panel-heading" role="tab">
                    <h3 class="panel-title">
                        <a data-toggle="collapse" href="#thuchanh" aria-expanded="true">

                            <b>[ONLINE - ROOTME] THỰC HÀNH SQL INJECTION</b>
                        </a>
                    </h3>
                </div>
                <div id="thuchanh" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="thuchanh">
                    <div class="panel-body">
                        <div class="collection">
                            <a href="index.php?page=sqli_thuchanh1" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['sqli_thuchanh1']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> SQLi - Authentication
                            </a>
                            <a href="index.php?page=sqli_thuchanh3" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['sqli_thuchanh3']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> SQLi - String
                            </a>
                            <a href="index.php?page=sqli_thuchanh4" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['sqli_thuchanh4']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> SQLi - Numberic
                            </a>
                            <a href="index.php?page=sqli_thuchanh5" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['sqli_thuchanh5']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> SQLi - Routed
                            </a>
                            <a href="index.php?page=sqli_thuchanh6" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['sqli_thuchanh6']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> SQLi - Error
                            </a>
                            <a href="index.php?page=sqli_thuchanh7" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['sqli_thuchanh7']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> SQLi - Insert
                            </a>
                            <a href="index.php?page=sqli_thuchanh8" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['sqli_thuchanh8']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> SQLi - File Reading
                            </a>
                            <a href="index.php?page=sqli_thuchanh9" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['sqli_thuchanh9']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> SQLi - Time Based
                            </a>
                            <a href="index.php?page=sqli_thuchanh10" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['sqli_thuchanh10']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> SQLi - Blind
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </article>
</main>