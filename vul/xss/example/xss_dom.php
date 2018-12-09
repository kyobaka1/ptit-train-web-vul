<aside class="sidebar">
    <div class="r-form">
        <h5>Select your language:</h5>
        <form class="login" method="get">
            <input type="hidden" name="page" value="xss_dom" />
            <select name="lang" style="width: 200px; margin-left: 10px">
                <script type="text/javascript">
                    if (document.location.href.indexOf("lang=") >= 0) {
                        var lang = document.location.href.substring(document.location.href.indexOf("lang=")+5);
                        document.write("<option value='" + lang + "'>" + decodeURIComponent(lang) + "</option>");
                        document.write("<option value='' disabled='disabled'>----</option>");
                    }
                    document.write("<option value='Vietnamese'>Vietnamese</option>");
                    document.write("<option value='English'>English</option>");
                    document.write("<option value='Japanese'>Japanese</option>");
                </script>
            </select>
            <input type="submit" value="Chọn" class="submit-btn" />
        </form>
    </div>
    <div class="r-form">
        <h5>Kết quả:</h5>
        <div class="r-content">
            <?php
            if(isset($_GET['lang'])){
                $language = $_GET['lang'];
                if($language === 'Vietnamese'){
                    echo '<p>Xin chào!</p>';
                }
                if($language === 'English'){
                    echo '<p>Hello!</p>';
                }
                if($language === 'Japanese'){
                    echo '<p>Konnichiwa</p>';
                }
            }
            ?>
        </div>
    </div>
</aside>