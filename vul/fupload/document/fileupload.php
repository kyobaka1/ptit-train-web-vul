<main class="main" role="main">
    <article class="content article article-archives article-type-list" itemscope="">
        <header class="article-header">
            <h1 itemprop="title">[THƯ MỤC] File Upload Vulnerabilities </h1>
            <p class="text-muted">Note: Đây không phải là bug, mà là một tính năng</p>
        </header>
        <div class="article-entry marked-body" itemprop="articleBody">
            <h3 id="rank"><a href="#rank" class="headerlink" title="rank"></a>Xếp Hạng</h3>
            <p>Lỗ hổng file upload thuộc loại lỗ hổng logic, code sai, code thiếu hơn là vấn đề bug.</p>
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
                            <a href="index.php?page=fileupload_work" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['fileupload_work']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> Upload File Trong PHP
                            </a>
                            <a href="index.php?page=fileupload_vul" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['fileupload_vul']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> Các Lỗ Hổng Tồn Tại Trong File Upload
                            </a>
                            <a href="index.php?page=fileupload_nc" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['fileupload_nc']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> Lợi Dụng Lỗ Hổng Khác Với File Upload
                            </a>
                        </div>
                    </div>
                </div>
                <div class="panel-heading" role="tab">
                    <h3 class="panel-title">
                        <a data-toggle="collapse" href="#phongchong" aria-expanded="true">

                            <b>[ONLINE - ROOTME] PHÒNG CHỐNG LỖ HỔNG FILE UPLOAD</b>
                        </a>
                    </h3>
                </div>
                <div id="phongchong" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="phongchong">
                    <div class="panel-body">
                        <div class="collection">
                            <a href="index.php?page=fileupload_fix" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['fileupload_fix']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> Phòng Chống Lỗ Hổng Trong File Upload
                            </a>
                        </div>
                    </div>
                </div>
                <div class="panel-heading" role="tab">
                    <h3 class="panel-title">
                        <a data-toggle="collapse" href="#thuchanh" aria-expanded="true">

                            <b>[ONLINE - ROOTME] THỰC HÀNH LỖ HỔNG FILE UPLOAD</b>
                        </a>
                    </h3>
                </div>
                <div id="thuchanh" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="thuchanh">
                    <div class="panel-body">
                        <div class="collection">
                            <a href="index.php?page=fileupload_chall1" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['fileupload_chall1']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> File upload - Double extension
                            </a>
                            <a href="index.php?page=fileupload_chall2" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['fileupload_chall2']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> File upload - MIME type
                            </a>
                            <a href="index.php?page=fileupload_chall3" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['fileupload_chall3']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> File upload - null byte
                            </a>
                            <a href="index.php?page=fileupload_chall4" class="collection-item"  itemprop="url">
                                <?php echo print_status($GLOBALS['menuBlocks']['fileupload_chall4']['id_post']); ?>
                                <span>&nbsp;&nbsp;&nbsp;</span> File upload - ZIP
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </article>
</main>