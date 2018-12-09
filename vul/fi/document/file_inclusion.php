<main class="main" role="main">
    <article class="content article article-archives article-type-list" itemscope="">
        <header class="article-header">
            <h1 itemprop="title">[THƯ MỤC] File Inclusion </h1>
            <p class="text-muted">Note: Là một lỗ hổng rất nghiêm trọng dựa trên tính năng của ngôn ngữ script run time.</p>
        </header>
        <div class="article-entry marked-body" itemprop="articleBody">
            <h3 id="rank"><a href="#rank" class="headerlink" title="rank"></a>Xếp Hạng</h3>
            <p>Có thể xếp vào loại <b>Injection</b> hoặc <b>lỗi logic</b></p>
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
                            <a href="index.php?page=fi_tongquan" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['fi_tongquan']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> Tổng Quan Về File Inclusion
                            </a>
                            <a href="index.php?page=fi_phanloai" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['fi_phanloai']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> Phân loại File Inclusion
                            </a>
                        </div>
                    </div>
                </div>
                <div class="panel-heading" role="tab">
                    <h3 class="panel-title">
                        <a data-toggle="collapse" href="#phongchong" aria-expanded="true">

                            <b>[DOCUMENT] KIẾN THỨC CHUYÊN SÂU  </b>
                        </a>
                    </h3>
                </div>
                <div id="thuchanh" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="thuchanh">
                    <div class="panel-body">
                        <div class="collection">
                            <a href="index.php?page=fi_rfi" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['fi_rfi']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> Remote File Inclusion (RFI)
                            </a>
                            <a href="index.php?page=fi_lfi_basic" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['fi_lfi_basic']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> Local File Inclusion (LFI)
                            </a>
                            <a href="index.php?page=fi_lfi_file" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['fi_lfi_file']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> Các File Có Thể Inject Code + LFI
                            </a>
                            <a href="index.php?page=fi_lfi_wrapper" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['fi_lfi_wrapper']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> LFI thông qua Wrapper
                            </a>
                        </div>
                    </div>
                </div>
                <div class="panel-heading" role="tab">
                    <h3 class="panel-title">
                        <a data-toggle="collapse" href="#phongchong" aria-expanded="true">

                            <b>[ROOTME - ONLINE] THỰC HÀNH TẤN CÔNG </b>
                        </a>
                    </h3>
                </div>
                <div id="tancong" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="tancong">
                    <div class="panel-body">
                        <div class="collection">
                            <a href="index.php?page=fi_chall1" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['fi_chall1']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> Local File Inclusion
                            </a>
                            <a href="index.php?page=fi_chall2" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['fi_chall2']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> Local File Inclusion - Double encoding
                            </a>
                            <a href="index.php?page=fi_chall3" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['fi_chall3']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> Remote File Inclusion
                            </a>
                            <a href="index.php?page=fi_chall4" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['fi_chall4']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> Local File Inclusion - Wrappers
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </article>
</main>