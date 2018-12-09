<main class="main has-sticky" role="main">
    <div class="content">
        <article id="post-sql1" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    [SQLi] Phòng Chống SQL Injection Trong Ngôn Ngữ PHP
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a>
                    <?php if($src_youtube != ''){echo '<button id="introduce-btn"><img src="public/images/play-circle.png" class="img-circle img-rotate" style="height: 24px; width: 24px; margin-right: 5px" " />Hướng Dẫn</button>';} ?>
                </div>
            </div>
            <?php echo get_iframe_youtube($src_youtube); ?>
            <div class="article-entry marked-body" itemprop="articleBody">
                <p><strong>PDO (PHP Data Object)</strong> được PHP phát triển từ phiên bản 5.1.  Quan trọng nhất là hai cơ chế:</p>
                <ul>
                    <li><strong>Prepared Statements</strong></li>
                    <li><strong>Stored Procedures</strong></li>
                </ul>
                <p>Giúp công việc thao tác với database trở nên đơn giản và an toàn hơn so với MySQLi.</p>
                <h1 id="Gioi-Thieu-PDO"><a href="#Gioi-Thieu-PDO" class="headerlink" title="Giới Thiệu PDO"></a>Giới Thiệu PDO</h1>
                <p><strong>PHP Data Objects (PDO)</strong> là một lớp truy xuất cơ sở dữ liệu cung cấp một phương pháp thống nhất để làm việc với nhiều loại cơ sở dữ liệu khác nhau.<br>Khi làm việc với PDO bạn sẽ không cần phải viết các câu lệnh SQL cụ thể mà chỉ sử dụng các phương thức mà PDO cung cấp, giúp tiết kiệm thời gian và làm cho việc chuyển đổi Hệ quản trị cơ sở dữ liệu trở nên dễ dàng hơn, chỉ đơn giản là thay đổi Connection String (chuỗi kết nối CSDL).</p>
                <h1 id="Ket-noi-CSDL-MySQL"><a href="#Ket-noi-CSDL-MySQL" class="headerlink" title="Kết nối CSDL MySQL"></a>Kết nối CSDL MySQL</h1>
                <figure class="highlight php">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line">$conn = <span class="keyword">new</span> PDO(<span class="string">'mysql:host=localhost;dbname=izlearn'</span>, $username, $password);</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p>Với mysql là tên của DBMS, localhost có ý nghĩa database được đặt trên cùng server, izlearn là tên của database. username và password là 2 biến chứa thông tin xác thực.</p>
                <h1 id="Co-che-Prepared-Statements"><a href="#Co-che-Prepared-Statements" class="headerlink" title="Cơ chế Prepared Statements"></a>Cơ chế Prepared Statements</h1>
                <p>Prepare statement: Chuẩn bị một câu lệnh SQL làm khung/mẫu được gọi là Prepared Statement với các Placeholder (có thể hiểu placeholder đóng vai trò như tham số của các phương thức khi bạn khai báo hàm)</p>
                <ul>
                    <li><strong>Bind params:</strong> Gắn giá trị thực vào các placeholder (tương tự như khi bạn truyền giá trị vào các tham số của phương thức)</li>
                    <li><strong>Execute:</strong> Thực thi câu lệnh</li>
                </ul>
                <h2 id="Cac-buoc-de-thuc-thi-1-cau-query"><a href="#Cac-buoc-de-thuc-thi-1-cau-query" class="headerlink" title="Các bước để thực thi 1 câu query:"></a>Các bước để thực thi 1 câu query:</h2>
                <p>Bao gồm 5 bước sau:</p>
                <ol>
                    <li>
                        <p>Parsing and Normalization Phase: In this phase, Query is checked for syntax and semantics. It checks whether references table and columns used in query exist or not. It also has many other tasks to do, but let’s not go in detail.</p>
                    </li>
                    <li>
                        <p>Compilation Phase: In this phase, keywords used in query like select, from, where etc are converted into format understandable by machine. This is the phase where query is interpreted and corresponding action to be taken is decided. It also has many other tasks to do, but let’s not go in detail.</p>
                    </li>
                    <li>
                        <p>Query Optimization Plan: In this phase, Decision Tree is created for finding the ways in which query can be executed. It finds out the number of ways in which query can be executed and the cost associated with each way of executing Query. It chooses the best plan for executing a query.</p>
                    </li>
                    <li>
                        <p>Cache: Best plan selected in Query optimization plan is stored in cache, so that whenever next time same query comes in, it doesn’t have to pass through Phase 1, Phase 2 and Phase 3 again. When next time query come in, it will be checked directly in Cache and picked up from there to execute.</p>
                    </li>
                    <li>
                        <p>Execution Phase: In this phase, supplied query gets executed and data is returned to user as ResultSet object</p>
                    </li>
                </ol>
                <h2 id="Tai-sao-Prepared-Statements-Giup-Phong-Chong-SQLi"><a href="#Tai-sao-Prepared-Statements-Giup-Phong-Chong-SQLi" class="headerlink" title="Tại sao Prepared Statements Giúp Phòng Chống SQLi?"></a>Tại sao Prepared Statements Giúp Phòng Chống SQLi?</h2>
                <p>Với cách sử dụng MySQLi thông thường,ta thường phải cộng chuỗi để tạo thành câu truy vấn sau đó mới thực hiện gửi dữ liệu đến CSDL để thực thi.<br>Tức là nếu bị inject, thì câu truy vấn đó sẽ bị thay đổi trước khi gửi đến CSDL để thực thi. (Thực thi ngay từ Bước 1.)</p>
                <p>Còn với Prepared statements sẽ có cơ chế chuẩn bị một câu lệnh SQL làm khung, khi đó chưa đưa những dữ liệu người dùng vào. Mà coi đó là những <strong>placeholders</strong>.<br>Câu lệnh query chúng ta sẽ được thực thi đến bước 4.<br>Sau đó, ta sẽ truyền dữ liệu người dùng vào những placeholders ta đã khai báo. Rồi mới thực thi tại Bước 5.<br>Khi đó, đã qua bước 1,2,3 rồi. Nên dù hacker có truyền vào câu lệnh SQL, thì nó cũng đâu được <strong>complie</strong> lại đâu. Nên những câu lệnh SQL đó, không có chạy được.<br>Máy tính chỉ hiểu đó là những biến truyền vào rồi thực thi chúng trên <strong>Cache</strong> đã được chuẩn bị sẵn mà thôi.</p>
                <h1 id="Vi-du-code-su-dung-Prepared-Statements"><a href="#Vi-du-code-su-dung-Prepared-Statements" class="headerlink" title="Ví dụ code sử dụng Prepared Statements"></a>Ví dụ code sử dụng Prepared Statements</h1>
                <figure class="highlight php">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br><span class="line">8</span><br><span class="line">9</span><br><span class="line">10</span><br><span class="line">11</span><br><span class="line">12</span><br><span class="line">13</span><br><span class="line">14</span><br><span class="line">15</span><br><span class="line">16</span><br><span class="line">17</span><br><span class="line">18</span><br><span class="line">19</span><br><span class="line">20</span><br><span class="line">21</span><br><span class="line">22</span><br><span class="line">23</span><br><span class="line">24</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line">$servername = <span class="string">"localhost"</span>;</span><br><span class="line">$usernamedb = <span class="string">"root"</span>;</span><br><span class="line">$passworddb = <span class="string">""</span>;</span><br><span class="line">$db = <span class="string">"web003"</span>;</span><br><span class="line"><span class="comment">// Create connection</span></span><br><span class="line">$conn = <span class="keyword">new</span> mysqli($servername, $usernamedb, $passworddb, $db);</span><br><span class="line">mysqli_set_charset($conn, <span class="string">'utf8'</span>);</span><br><span class="line"><span class="comment">// Check connection</span></span><br><span class="line"><span class="keyword">if</span> ($conn-&gt;connect_error) {</span><br><span class="line">	<span class="keyword">die</span>(<span class="string">"Connection failed: "</span> . $conn-&gt;connect_error);</span><br><span class="line">}</span><br><span class="line"><span class="keyword">if</span>(<span class="keyword">isset</span>($_POST[<span class="string">'submit'</span>])){</span><br><span class="line">    $login =    $_POST[<span class="string">'username'</span>];</span><br><span class="line">    $pass =     $_POST[<span class="string">'password'</span>];</span><br><span class="line">    $sql = <span class="string">"SELECT * FROM users WHERE login=? and pass=? LIMIT 1"</span>; <span class="comment">// Khai báo những placeholders dưới dấu ?</span></span><br><span class="line">    $stmt = $conn-&gt;prepare($sql);		  <span class="comment">// Complie SQL đến bước Cache,chờ dữ liệu </span></span><br><span class="line">    $stmt-&gt;bind_param(<span class="string">'ss'</span>,$login,$pass); <span class="comment">// Truyền dữ liệu vào những placeholders đó.</span></span><br><span class="line">    $stmt-&gt;execute();					  <span class="comment">// Bước 5, thực thi.</span></span><br><span class="line">    $result = $stmt-&gt;get_result();</span><br><span class="line">    <span class="keyword">if</span>($result-&gt;num_rows == <span class="number">1</span> ){</span><br><span class="line">        $_SESSION[<span class="string">'login_user'</span>] = $login;</span><br><span class="line">        header(<span class="string">"Location: index.php"</span>);</span><br><span class="line">    }</span><br><span class="line">}</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <h1 id="Tham-khao"><a href="#Tham-khao" class="headerlink" title="Tham khảo"></a>Tham khảo</h1>
                <ul>
                    <li><a href="https://viblo.asia/p/pdo-trong-php-khai-niem-va-nhung-thao-tac-co-ban-57rVRq59R4bP" target="_blank" rel="noopener">Cách sử dụng PDO trong PHP</a></li>
                    <li><a href="https://stackoverflow.com/questions/1582161/how-does-a-preparedstatement-avoid-or-prevent-sql-injection" target="_blank" rel="noopener">Giải thích vì sao Prepare Statements lại phòng chống SQLi</a></li>
                </ul>
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
        <section id="comments">
            <div id="vcomments"></div>
        </section>
    </div>
</main>