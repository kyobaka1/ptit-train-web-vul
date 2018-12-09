<main class="main has-sticky" role="main">
    <div class="content">
        <article id="post-sql1" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    SQLi File Reading
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a></div>
            </div>
            <div class="article-entry marked-body" itemprop="articleBody">
                <h1 id="Thu-Thach"><a href="#Thu-Thach" class="headerlink" title="Thử Thách"></a>Thử Thách</h1>
                <p>URL: <a href="https://www.root-me.org/en/Challenges/Web-Server/SQL-injection-file-reading" target="_blank" rel="noopener">https://www.root-me.org/en/Challenges/Web-Server/SQL-injection-file-reading</a></p>
                <h2 id="Tieu-de"><a href="#Tieu-de" class="headerlink" title="Tiêu đề"></a>Tiêu đề</h2>
                <p>Reading file with SQL!</p>
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
                <h2 id="Read-file"><a href="#Read-file" class="headerlink" title="Read file"></a>Read file</h2>
                <p>Hàm <strong>load_file()</strong> trên MySQL cho phép đọc file. Nhưng phải đáp ứng được các yêu cầu sau:</p>
                <ul>
                    <li>File bạn muốn load phải nằm trên cùng host nơi mà MySQL Server đang chạy.</li>
                    <li>Địa chỉ truyền phải là địa chỉ tuyệt đối.</li>
                    <li>Người thực thi lệnh load_file() phải có quyền trên FILE đó. </li>
                    <li>MySQL có biến <strong>max_allowed_packet</strong>. File load có size không được vượt quá giá trị này. Kiểm tra bằng cách: <strong>show variables like ‘%max_allowed_packet%</strong></li>
                    <li>MySQL có biến <strong>secure_file_priv</strong>. Nếu như set biến này thành một thư mục,thì chỉ được đọc những file nằm trong thư mục đó.</li>
                </ul>
                <h2 id="Khai-thac"><a href="#Khai-thac" class="headerlink" title="Khai thác"></a>Khai thác</h2>
                <p>Tìm hiểu chức năng thì đã thấy đối tượng bị inject là: <a href="http://challenge01.root-me.org/web-serveur/ch31/?action=members&amp;id=1" target="_blank" rel="noopener">http://challenge01.root-me.org/web-serveur/ch31/?action=members&amp;id=1</a></p>
                <h3 id="Tim-so-cot"><a href="#Tim-so-cot" class="headerlink" title="Tìm số cột"></a>Tìm số cột</h3>
                <blockquote>
                    <p>1 ORDER BY 4 -+</p>
                </blockquote>
                <p>Thử với 5 xuất hiện lỗi, vậy câu SELECT phía trước có 4 cột.</p>
                <h3 id="Union"><a href="#Union" class="headerlink" title="Union"></a>Union</h3>
                <p>Để đọc được file,ta cần tìm địa chỉ tuyệt đối của thư mục hiện tại, có rất nhiều cách, mình sử dụng cách để PHP hiển thị lỗi và tìm đường dẫn:<br><a href="http://challenge01.root-me.org/web-serveur/ch31/?action=members&amp;id[]=abc" target="_blank" rel="noopener">http://challenge01.root-me.org/web-serveur/ch31/?action=members&amp;id[]=abc</a><br>Ta truyền vào id là 1 array,dẫn đến biến $id của họ đọc vào không được và hiển ra lỗi.</p>
                <p>Thư mục hiện hành là: <strong>/challenge/web-serveur/ch31/index.php</strong><br>Nhưng khi thử bỏ vào thì không được vì nó ko hiểu kí tự /, nên ta chuyển qua hex để bypass như sau:</p>
                <blockquote>
                    <p>-1 UNION SELECT 1,2,3,load_file(0x2f6368616c6c656e67652f7765622d736572766575722f636833312f696e6465782e706870) - +</p>
                </blockquote>
                </div></div>
        </article>
        <section id="comments">
            <div id="vcomments"></div>
        </section>
    </div>
</main>