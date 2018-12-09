<?php
$conn = connect_database();
if(isset($_GET['submit'])){
    $input_id = $_GET['id'];
    $sql_query = "SELECT * FROM sqli_products WHERE ID='$input_id' LIMIT 1";
    $result = $conn->query($sql_query);
    $row = $result ->fetch_assoc();
}
$conn->close();
?>
<aside class="sidebar">
    <div class="r-form">
        <h5>Tìm Thông Tin Sản Phẩm</h5>
        <form class="login" action="" method="get">
            <input type="hidden" name="page" value="sqli_tancong_blind" />
            <input type="text" name="id" class="login-input" placeholder="Nhập ID Sản Phẩm">
            <input type="submit" value="Tìm Kiếm" name="submit" class="submit-btn">
        </form>
    </div>
    <div class="r-form">
        <h5>Code:</h5>
        <figure class="highlight php">
            <table>
                <tbody>
                <tr>
                    <td class="gutter">
                        <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br></pre>
                    </td>
                    <td class="code">
                        <pre><span class="line">$input_id = $_GET[<span class="string">'id'</span>];</span><br><span class="line">$sql_query = <span class="string">"SELECT * FROM sqli_products WHERE ID='$input_id' LIMIT 1"</span>;</span><br><span class="line">$result = $conn-&gt;query($sql_query);</span><br><span class="line">$row = $result -&gt;fetch_assoc();</span><br></pre>
                    </td>
                </tr>
                </tbody>
            </table>
        </figure>
    </div>
    <div class="r-form">
        <h5>Query (Được thực thi):</h5>
        <?php if(isset($sql_query)){ ?>
            <figure class="highlight sql">
                <table>
                    <tbody>
                    <tr>
                        <td class="gutter">
                            <pre><span class="line">1</span></pre>
                        </td>
                        <td class="code">
                            <pre><span class="line"><?php echo $sql_query; ?></span></pre>
                        </td>
                    </tr>
                    </tbody>
                </table></figure>
        <?php } ?>
    </div>
    <?php
        if(isset($row) && $row){
            echo "<div class='r-form'><h5>Kết quả:</h5><p style='margin-left: 10px'>Sản phẩm có trong database!</p></div>";
        }else echo "<div class='r-form'><h5>Kết quả:</h5><p style='margin-left: 10px'>Sản phẩm không tồn tại!</p></div>"; ?>
</aside>