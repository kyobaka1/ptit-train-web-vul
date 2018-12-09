<?php
$conn = connect_database();
if(isset($_GET['submit'])){
    $orderby_input = $_GET['orderby'];
    $sql_query = "SELECT * FROM sqli_products ORDER BY $orderby_input ASC";
    $result = $conn->query($sql_query);
}
$conn->close();
?>
<aside class="sidebar">
    <div class="r-form">
        <form class="login" action="" method="get">
            <h5>Xem Danh Sách Sản Phẩm</h5>
            <input type="hidden" name="page" value="sqli_tancong_other" />
            <input type="text" name="orderby" class="login-input" placeholder="Nhập số thứ tự cột cần sắp xếp">
            <input type="submit" value="Xem" name="submit" class="submit-btn">
        </form>
    </div>
    <div class="r-form">
        <h5>Code:</h5>
        <figure class="highlight php"><table><tbody><tr><td class="gutter"><pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br></pre></td><td class="code"><pre><span class="line"><span class="keyword">if</span>(<span class="keyword">isset</span>($_GET[<span class="string">'submit'</span>])){</span><br><span class="line">    $orderby_input = $_GET[<span class="string">'orderby'</span>];</span><br><span class="line">    $sql_query = <span class="string">"SELECT * FROM sqli_products ORDER BY $orderby_input ASC"</span>;</span><br><span class="line">    $result = $conn-&gt;query($sql_query);</span><br><span class="line">}</span><br></pre></td></tr></tbody></table></figure>
    </div>
    <div class="r-form">
        <h5>Query (Được thực thi):</h5>
        <?php if(isset($sql_query)){ ?>
            <figure class="highlight sql"><table><tbody><tr><td class="gutter"><pre><span class="line">1</span></pre></td><td class="code"><pre><span class="line"><?php echo $sql_query; ?></span></pre></td></tr></tbody></table></figure>
        <?php } ?>
    </div>
    <?php if(isset($result)){ ?>
    <div class="r-form">
        <h5>Kết quả: </h5>
        <table>
            <tr>
                <th>ID</th>
                <th>Tên SP</th>
                <th>Giá</th>
                <th>Người Bán</th>
            </tr>
            <?php while($row = $result->fetch_assoc()){ ?>
                <tr>
                    <td><?php echo $row['id'] ?></td>
                    <td><?php echo $row['tensanpham'] ?></td>
                    <td><?php echo $row['gia'] ?></td>
                    <td><?php echo $row['nguoiban'] ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <?php } ?>
</aside>