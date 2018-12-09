<?php
# Example 1
class user{
    private $username = 'guest';
    public function __wakeup()
    {
        if($this->username === 'admin'){
            echo 'Flag is here! Just admin can see!</br>';
            # show flag
            include PAGE_TO_ROOT.'vul/deserialize/flag.php';
        }
        else{ echo 'You are user!';}
    }
}
# Example 2
class user_login{
    private $log_file = 'log/log.txt';
    private $username = 'guest';
    public function __destruct(){
        file_put_contents($this->log_file,'User '.$this->username.' log in!');
        echo '</br>Ghi log thành công! Tại file: '.$this->log_file.' với username:'.$this->username;
    }
}
?>
<aside class="sidebar">
    <div class="r-form">
        <h5>Nhập mã base64 bạn muốn unserialize:</h5>
        <form class="login" method="get" action="" >
            <input type="hidden" name="page" value="deserialize_php2" />
            <input type="text" name="data" id="data">
            <input type="submit" name="submit" class="submit-btn" value="Xác Nhận">
        </form>
    </div>
    <div class="r-form">
        <h5>Code</h5>
        <figure class="highlight php"><table><tbody><tr><td class="gutter"><pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br><span class="line">8</span><br><span class="line">9</span><br><span class="line">10</span><br><span class="line">11</span><br><span class="line">12</span><br><span class="line">13</span><br><span class="line">14</span><br><span class="line">15</span><br><span class="line">16</span><br><span class="line">17</span><br><span class="line">18</span><br><span class="line">19</span><br><span class="line">20</span><br><span class="line">21</span><br><span class="line">22</span><br><span class="line">23</span><br><span class="line">24</span><br><span class="line">25</span><br><span class="line">26</span><br><span class="line">27</span><br><span class="line">28</span><br><span class="line">29</span><br></pre></td><td class="code"><pre><span class="line"><span class="meta">&lt;?php</span></span><br><span class="line"><span class="comment"># Example 1</span></span><br><span class="line"><span class="class"><span class="keyword">class</span> <span class="title">user</span></span>{</span><br><span class="line">    <span class="keyword">private</span> $username = <span class="string">'guest'</span>;</span><br><span class="line">    <span class="keyword">public</span> <span class="function"><span class="keyword">function</span> <span class="title">__wakeup</span><span class="params">()</span></span></span><br><span class="line"><span class="function">    </span>{</span><br><span class="line">        <span class="keyword">if</span>(<span class="keyword">$this</span>-&gt;username === <span class="string">'admin'</span>){</span><br><span class="line">            <span class="keyword">echo</span> <span class="string">'Flag is here! Just admin can see!&lt;/br&gt;'</span>;</span><br><span class="line">            <span class="comment"># show flag</span></span><br><span class="line">            <span class="keyword">include</span> PAGE_TO_ROOT.<span class="string">'vul/deserialize/flag.php'</span>;</span><br><span class="line">        }</span><br><span class="line">        <span class="keyword">else</span>{ <span class="keyword">echo</span> <span class="string">'You are user!'</span>;}</span><br><span class="line">    }</span><br><span class="line">}</span><br><span class="line"><span class="comment"># Example 2</span></span><br><span class="line"><span class="class"><span class="keyword">class</span> <span class="title">user_login</span></span>{</span><br><span class="line">    <span class="keyword">private</span> $log_file = <span class="string">'log/log.txt'</span>;</span><br><span class="line">    <span class="keyword">private</span> $username = <span class="string">'guest'</span>;</span><br><span class="line">    <span class="keyword">public</span> <span class="function"><span class="keyword">function</span> <span class="title">__destruct</span><span class="params">()</span></span>{</span><br><span class="line">        file_put_contents(<span class="keyword">$this</span>-&gt;log_file,<span class="string">'User '</span>.<span class="keyword">$this</span>-&gt;username.<span class="string">' log in!'</span>);</span><br><span class="line">        <span class="keyword">echo</span> <span class="string">'&lt;/br&gt;Ghi log thành công! Tại file: '</span>.<span class="keyword">$this</span>-&gt;log_file.<span class="string">' với username:'</span>.<span class="keyword">$this</span>-&gt;username;</span><br><span class="line">    }</span><br><span class="line">}</span><br><span class="line"><span class="comment"># File PHP nào đó.</span></span><br><span class="line"><span class="keyword">if</span>(<span class="keyword">isset</span>($_GET[<span class="string">'submit'</span>])){</span><br><span class="line">    $user_input = $_GET[<span class="string">'data'</span>];</span><br><span class="line">    $ob = unserialize(base64_decode($user_input));</span><br><span class="line">}</span><br><span class="line"><span class="meta">?&gt;</span></span><br></pre></td></tr></tbody></table></figure>
    </div>
    <?php
    if(isset($_GET['submit'])){
        $user_input = $_GET['data'];
        $ob = unserialize(base64_decode($user_input));
    }
    ?>
</aside>

