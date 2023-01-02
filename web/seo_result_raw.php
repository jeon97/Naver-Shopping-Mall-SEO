<!DOCTYPE html>
<html lang="en">

    <head>
        <title>DySEO</title>
        <link rel="stylesheet" href="seo_css.css">
    </head>

    <body>
        <h1>NAVER SEARCH ENGINE OPTIMIZER</h1>
        <div class="menu">
            <div class="margin_style">
                <a href="seo_index.php">HISTORY</a>
            </div>
        </div>
        <?php
            $keyword = $_POST["keyword"];
            $date = $_POST["date"];
            $temp_date_cut = substr($date,0,19);
        ?>
        <div>
            <div>
                <th><?php echo '<h3>'.$keyword.' '.$temp_date_cut.'</h3>' ?></th>
                <hr>
                <table border="1">
                        <tr>
<!--                            <th>ID</th>-->
<!--                            <th>CREATED DATE</th>-->
                            <th>RANK</th>
                            <th>MAIN KEYWORD</th>
                            <th>META KEYWORD</th>
                            <th>META DESCRIPTION</th>
                            <th>REVIEW COUNT</th>
                            <th>BUY COUNT</th>
                            <th>REGISTRATION DATE</th>
                            <th>DIB COUNT</th>
                            <th>LINK</th>
                        </tr>

                        <?php

                        $conn = mysqli_connect("localhost", "j2jung", "*", "j2jung");
                        $sql = "SELECT * FROM seo_keyword_table WHERE main_keyword = '$keyword' AND created_date = '$date'";
                        $result = mysqli_query($conn,$sql);

                        while($row = mysqli_fetch_array($result)) {
                echo    '<tr>
                            <td>' . $row[ 'rank' ] . '</td>
                            <td>'. $row[ 'main_keyword' ] . '</td>
                            <td>' . $row[ 'meta_keyword' ] . '</td>
                            <td>' . $row[ 'meta_description' ] . '</td>
                            <td>' . $row[ 'review_count' ] . '</td>
                            <td>' . $row[ 'buy_count' ] . '</td>
                            <td>' . $row[ 'registration_date' ] . '</td>
                            <td>' . $row[ 'dib_count' ] . '</td>
                            <td><a href=' . $row[ 'link' ] . ' target="_blank">보기</a></td>
                        </tr>';
                        }
                        ?>
                        

                    </table>
            </div>
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