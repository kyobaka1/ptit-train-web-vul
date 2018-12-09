<aside class="sidebar">
    <div class="r-form">
        <h5>Chọn File Config Thích Hợp</h5>
        <form method="get" class="login">
            <input type="hidden" name="page" value="fi_lfi_basic" />
            <input type="text" name="file" placeholder="Nhập Tên File Config" />
            <input type="submit" name="submit" class="submit-btn" value="Xác Nhận" />
        </form>
    </div>
    <div class="r-form">
        <h5>Upload File Hình .JPG</h5>
        <form method="get" class="login">
            <form class="login" method="post" enctype="multipart/form-data">
                <input type="file" name="file" id="file">
                <input type="submit" value="Upload Image" name="submit_file" class="submit-btn" />
            </form>
        </form>
    </div>
    <div class="r-form">
    <h5>Code xử lý: </h5>
    <figure class="highlight php"><table><tbody><tr><td class="gutter"><pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br></pre></td><td class="code"><pre><span class="line"><span class="meta">&lt;?php</span></span><br><span class="line"><span class="keyword">if</span>(<span class="keyword">isset</span>($_GET[<span class="string">'file'</span>])){</span><br><span class="line">    <span class="keyword">include</span>(<span class="string">'config/'</span>.$_GET[<span class="string">'file'</span>]);</span><br><span class="line">} <span class="meta">?&gt;</span></span><br></pre></td></tr></tbody></table></figure>
    </div>
    <?php
    if(isset($_GET['file'])){
        include('config/'.$_GET['file']);
    }
    if(isset($_POST['submit_file'])){
        $target_path  = PAGE_TO_ROOT . "vul/fi/example/upload/";
        $uploaded_name = $_FILES[ 'file' ][ 'name' ];
        $uploaded_ext  = substr( $uploaded_name, strrpos( $uploaded_name, '.' ) + 1);
        if( strtolower( $uploaded_ext ) == "jpg" && strtolower($_FILES['file']['type']) == 'image/jpeg' ){
            if( move_uploaded_file( $_FILES['file']['tmp_name'] ,$target_path.$uploaded_name )){
                echo '<h4>Upload success! File in upload/'.$uploaded_name.'</h4>';
            }
            else{
                echo '<h4>Upload fail!</h4>';
            }
        }
        else{
            echo '<h4>Just allow file .jpg!</h4>';
        }
    }
    ?>
</aside>