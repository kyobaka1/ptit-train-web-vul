<aside class="sidebar">
    <div class="r-form">
        <h5>Input your base64 data xml:</h5>
        <form class="login" method="get" action="" >
            <input type="hidden" name="page" value="xxe_basic" />
            <input type="text" name="xml" id="xml">
            <input type="submit" name="submit" value="Xác Nhận" class="submit-btn" />
        </form>
    </div>
    <?php
    libxml_disable_entity_loader(false);
    libxml_use_internal_errors(true);
    if(isset($_GET['submit'])){
        $inject = base64_decode($_GET['xml']);
        $string = simplexml_load_string($inject, null, LIBXML_NOENT);
        print_r($string);
    }
    ?>
    <div class="r-form">
        <h5>Code</h5>
        <figure class="highlight php">
            <table>
                <tbody>
                <tr>
                    <td class="gutter">
                        <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br><span class="line">8</span><br></pre>
                    </td>
                    <td class="code">
                        <pre><span class="line"><span class="meta">&lt;?php</span></span><br><span class="line">libxml_disable_entity_loader(<span class="keyword">false</span>);</span><br><span class="line">libxml_use_internal_errors(<span class="keyword">true</span>);</span><br><span class="line"><span class="keyword">if</span>(<span class="keyword">isset</span>($_GET[<span class="string">'submit'</span>])){</span><br><span class="line">	$inject = base64_decode($_GET[<span class="string">'xml'</span>]);</span><br><span class="line">	$string = simplexml_load_string($inject, <span class="keyword">null</span>, LIBXML_NOENT);</span><br><span class="line">	print_r($string);</span><br><span class="line">}</span><br></pre>
                    </td>
                </tr>
                </tbody>
            </table>
        </figure>
    </div>
</aside>