<main class="main" role="main">
    <article class="content article article-archives article-type-list" itemscope="">
        <header class="article-header">
            <h1 itemprop="title">[THƯ MỤC] Cross-Site Scripting (XSS)</h1>
            <p class="text-muted">Note: Nhớ học về và nắm vững về HTML và Javascript!</p>
        </header>
        <div class="article-entry marked-body" itemprop="articleBody">
            <h3 id="rank"><a href="#rank" class="headerlink" title="rank"></a>Xếp Hạng</h3>
            <p>XSS không phải lỗ hổng nghiêm trọng <b>nhất</b>, được xếp hạng 7 ở OWASP. Nhưng là lỗ hổng rất phổ biến với tần suất lớn trong thực tế.</p>
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
                            <a href="index.php?page=xss_tongquan" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['xss_tongquan']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> Tổng Quan về XSS
                            </a>
                            <a href="index.php?page=xss_phanloai" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['xss_phanloai']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> Phân loại XSS
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
                            <a href="index.php?page=xss_reflected" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['xss_reflected']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> Reflected XSS
                            </a>
                            <a href="index.php?page=xss_stored" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['xss_stored']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> Stored XSS
                            </a>
                            <a href="index.php?page=xss_dom" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['xss_dom']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> DOM-based XSS
                            </a>
                            <a href="index.php?page=xss_kythuat" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['xss_kythuat']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> Kỹ thuật tấn công XSS
                            </a>
                            <a href="index.php?page=xss_stealsession" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['xss_stealsession']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> Cách đánh cắp session bằng cookie
                            </a>
                        </div>
                    </div>
                </div>
                <div class="panel-heading" role="tab">
                    <h3 class="panel-title">
                        <a data-toggle="collapse" href="#kithuattancong" aria-expanded="true">

                            <b>[DOCUMENT] PHÒNG CHỐNG XSS</b>
                        </a>
                    </h3>
                </div>
                <div id="phongchong" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="kithuatphongchong">
                    <div class="panel-body">
                        <div class="collection">
                            <a href="index.php?page=xss_phongchong_coban" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['xss_phongchong_coban']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> Nguyên lý phòng chống XSS
                            </a>
                            <a href="index.php?page=xss_phongchong_php" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['xss_phongchong_php']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> Phòng chống XSS trong ngôn ngữ PHP
                            </a>
                        </div>
                    </div>
                </div>
                <div class="panel-heading" role="tab">
                    <h3 class="panel-title">
                        <a data-toggle="collapse" href="#thuchanh" aria-expanded="true">

                            <b>[ONLINE - ROOTME] THỰC HÀNH XSS</b>
                        </a>
                    </h3>
                </div>
                <div id="thuchanh" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="thuchanh">
                    <div class="panel-body">
                        <div class="collection">
                            <a href="index.php?page=xss_chall1" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['xss_chall1']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> XSS - Stored 1
                            </a>
                            <a href="index.php?page=xss_chall2" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['xss_chall2']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> XSS - Stored 2
                            </a>
                            <a href="index.php?page=sqli_thuchanh4" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['sqli_thuchanh4']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> XSS - DOM based
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </article>
</main>