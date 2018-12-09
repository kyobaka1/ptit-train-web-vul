<aside class="sidebar">
    <div class="r-form">
        <h5>Nhập Thư Mục Của File Config.php</h5>
        <form method="get" class="login">
            <input type="hidden" name="page" value="fi_rfi" />
            <input type="text" name="path" placeholder="Nhập Thư Mục Của File Cấu Hình" />
            <input type="submit" name="submit" value="Xác Nhận" class="submit-btn" />
        </form>
    </div>
    <div class="r-form">
        <h5>Code:</h5>
        <figure class="highlight php">    <table><tbody><tr>    <td class="gutter"><pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br></pre>    </td>    <td class="code"><pre><span class="line"><span class="meta">&lt;?php</span></span><br><span class="line"><span class="keyword">if</span>(<span class="keyword">isset</span>($_GET[<span class="string">'path'</span>])){</span><br><span class="line">   <span class="keyword">include</span>($_GET[<span class="string">'path'</span>].<span class="string">'/config.php'</span>);</span><br><span class="line">}</span><br></pre>    </td></tr></tbody>    </table></figure>
    </div>
    <?php
        if(isset($_GET['path'])){
            include($_GET['path'].'/config.php');
        }
     ?>
</aside>