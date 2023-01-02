<!DOCTYPE html>
<html lang="en">

    <head>
        <title>DySEO</title>
        <link rel="stylesheet" href="seo_css.css">
    </head>

    <style>
        a {
            color: #000;
            text-decoration: none;
        }
    </style>
    <body>
        <h1>NAVER SEARCH ENGINE OPTIMIZER</h1>
        <div class="menu">
            <div class="margin_style">
                <a href="seo_index.php">HISTORY</a>
            </div>
        </div>
        <div>
            <?php
use function PHPSTORM_META\type;
            $conn = mysqli_connect("localhost", "j2jung", "*", "j2jung");
            $sql = "SELECT * FROM seo_keyword";
            $result = mysqli_query($conn,$sql);
            $array_keyword = array();
            $see = '보기';

            while($row = mysqli_fetch_array($result)) {
                $temp_keyword = $row['keyword'];
                array_push($array_keyword, $temp_keyword);
            }

            $array_keyword_unique = array_unique($array_keyword);
            $array_keyword_unique_val = array();

            foreach($array_keyword_unique as $value){
                array_push($array_keyword_unique_val, $value);
            }
    
            $length_array = count($array_keyword_unique);
            $temp_length = 0;

            while($temp_length < $length_array) {

                echo "<div>
                     <h2><a href='seo_result_val.php?keyword=".$array_keyword_unique_val[$temp_length]."' target='_self'>$array_keyword_unique_val[$temp_length]</a></h2>";
                        
                $sql = "SELECT * FROM seo_keyword WHERE keyword = '$array_keyword_unique_val[$temp_length]'";
                $result = mysqli_query($conn,$sql);
                $array_date = array();


                echo"<form id='myform2' method='POST', action='seo_result_raw.php'>
                        <select name='date'>";
                        while($row = mysqli_fetch_array($result)) {
                            $temp_date = $row['search_date'];
                            $temp_date_cut = substr($temp_date,0,19);
                            echo"<option value='$temp_date'>$temp_date_cut</option>";
                        }

                echo    "</select>
                            <input type='submit' value='원본 데이터 보기'>
                            <input style='display:none' type='text' name='keyword' value='$array_keyword_unique_val[$temp_length]'>
                        </form>
                        </div>";
                    $temp_length = $temp_length + 1;
                }
        
            mysqli_close($conn);
            ?>
        </div>

        <div>
            <hr>
            <footer>
                <p></p>
                <p><time pubdate datetime="2018-11-21"></time></p>
            </footer>
        </div>
    </body>
</html>