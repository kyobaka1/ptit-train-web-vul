<?php
    $conn = connect_database();

    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql_query = "SELECT * FROM sqli_users WHERE uname='$username' AND pass='$password'";
        $result = $conn->query($sql_query);
        if($result->num_rows > 0){
            $thongbao = 'Đăng nhập thành công!';
        }
        else{
            $thongbao = 'Đăng nhập thất bại!';
        }
    }
    $conn->close();
?>
<aside class="sidebar">
    <div class="r-form">
        <h5>Đăng Nhập</h5>
        <form class="login" action="" method="post">
            <input type="text" name="username" class="login-input" placeholder="Username">
            <input type="password" name="password" class="login-input" placeholder="Password">
            <input type="submit" value="Đăng Nhập" name="submit" class="submit-btn">
        </form>
    </div>
    <div class="r-form">
        <h5>Tài Khoản Mặc Định</h5>
        <div class="r-content">
            <p>Username: Bob</p>
            <p>Password: bob123</p>
        </div>
    </div>
    <div class="r-form">
        <h5>Code:</h5>
        <figure class="highlight php">
            <table>
                <tbody>
                <tr>
                    <td class="gutter">
                        <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br></pre>
                    </td>
                    <td class="code">
                        <pre><span class="line">$username = $_POST[<span class="string">'username'</span>];</span><br><span class="line">$password= $_POST[<span class="string">'password'</span>];</span><br><span class="line">$sql_query = <span class="string">"SELECT * FROM sqli_users WHERE username='$username' AND password='$password'"</span>;</span><br></pre>
                    </td>
                </tr>
                </tbody>
            </table>
        </figure>
    </div>
    <?php if(isset($sql_query)){ ?>
        <div class="r-form">
            <h5>Query được thực thi:</h5>
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
                </table>
            </figure>
        </div>
    <?php } ?>
    <div class="r-form">
        <h5>Kết quả:</h5>
        <p style="margin-left: 10px"><?php if(isset($thongbao)) echo $thongbao; ?></p>
    </div>
</aside>