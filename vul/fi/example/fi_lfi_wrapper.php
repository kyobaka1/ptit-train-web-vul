<aside class="sidebar">
    <div class="r-form">
        <h5>Test Với LFI Wrapper Với include()</h5>
        <p style="margin-left: 10px; color: red">Lưu ý config allow_url_include: On trong php.ini</p>
        <form method="get" class="login">
            <input type="hidden" name="page" value="fi_lfi_wrapper" />
            <input type="text" name="file" placeholder="Test Với LFI" />
            <input type="submit" name="submit" value="Xác Nhận" class="submit-btn" />
        </form>
    </div>
    <div class="r-form">
        <h5>Code xử lý: </h5>
        <figure class="highlight php"><table><tbody><tr><td class="gutter"><pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br></pre></td><td class="code"><pre><span class="line"><span class="meta">&lt;?php</span></span><br><span class="line"><span class="keyword">if</span>(<span class="keyword">isset</span>($_GET[<span class="string">'file'</span>])){</span><br><span class="line">    <span class="keyword">include</span>(<span class="string">'config/'</span>.$_GET[<span class="string">'file'</span>]);</span><br><span class="line">} <span class="meta">?&gt;</span></span><br></pre></td></tr></tbody></table></figure>
    </div>
    <?php
    if(isset($_GET['file'])){
        include($_GET['file']);
    } ?>
</aside>