<main class="main" role="main">
    <article class="content article article-archives article-type-list" itemscope="">
        <header class="article-header">
            <h1 itemprop="title">[THƯ MỤC] XML External Entities Attacks (XXE)</h1>
            <p class="text-muted">Note: Làm quen và sử dụng cấu trúc XML!</p>
        </header>
        <div class="article-entry marked-body" itemprop="articleBody">
            <h3 id="rank"><a href="#rank" class="headerlink" title="rank"></a>Xếp Hạng</h3>
            <p>Xếp hạng thứ <b>4</b> trong TOP 10 OWASP. Rất nguy hiểm, facebook đã từng chi 33.5k$ (cao nhất) cho bug bounty lỗ hổng XXE của họ.</p>
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
                            <a href="index.php?page=xml_tongquan" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['xml_tongquan']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> Tổng Quan Về XML
                            </a>
                            <a href="index.php?page=xml_attack" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['xml_attack']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> XML Attack Vector
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
                            <a href="index.php?page=xxe_basic" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['xxe_basic']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> XML External Entities Attacks (XXE)
                            </a>
                            <a href="index.php?page=xxe_blind" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['xxe_blind']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> Blind XXE
                            </a>
                        </div>
                    </div>
                </div>
                <div class="panel-heading" role="tab">
                    <h3 class="panel-title">
                        <a data-toggle="collapse" href="#kithuattancong" aria-expanded="true">

                            <b>[DOCUMENT] PHÒNG CHỐNG XXE</b>
                        </a>
                    </h3>
                </div>
                <div id="phongchong" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="kithuatphongchong">
                    <div class="panel-body">
                        <div class="collection">
                            <a href="index.php?page=xxe_phongchong" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['xxe_phongchong']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> Phòng Chống XXE Trong PHP
                            </a>
                        </div>
                    </div>
                </div>
                <div class="panel-heading" role="tab">
                    <h3 class="panel-title">
                        <a data-toggle="collapse" href="#thuchanh" aria-expanded="true">

                            <b>[ONLINE - ROOTME] THỰC HÀNH XXE</b>
                        </a>
                    </h3>
                </div>
                <div id="thuchanh" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="thuchanh">
                    <div class="panel-body">
                        <div class="collection">
                            <a href="index.php?page=xxe_chall1" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['xxe_chall1']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> XML External Entity
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </article>
</main>