<!DOCTYPE html>
<html lang="en">

    <head>
        <title>DySEO</title>
        <link rel="stylesheet" href="seo_css.css">
    </head>

<!--    <script src="script.js"></script>-->
    <!-- <style>
    * {
        font-style: impact;
    }
    .menu {
        height: auto;
        background-color: dodgerblue;
        color: ivory;
    }
    .margin_style {
        margin: 10px;
        padding: 10px;
    }

    div {
        margin: 10px;
        padding: 0%;
    }

    div > a {
        color: Black;
        margin: 50px;
        padding: 10px;
        font-size: 130%;

    }

    h1 {
        margin: 10px;
    }
    li {
        margin: 10px;
    }

    .left {
        width: 70%;
        float: left;
    }
    .right {
        width: 30%;
        float: right;
    }

    </style> -->
    <body>
        <h1>NAVER SEARCH ENGINE OPTIMIZER</h1>
        <div class="menu">
            <div class="margin_style">
                <a href="seo_index.php">HISTORY</a>
            </div>
        </div>
        <?php
        // $keyword = $_POST["keyword"];
        $keyword = $_GET["keyword"];
        // $date = $_POST["date"];
        $iif = $_POST["iif_select"];
        $start_date = $_POST["trip-start"];
        $end_date = $_POST["trip-end"];
        ?>
        <div>
            <div>
            <th><?php echo '<h3>'.$keyword.' '.$iif.'</h3>' ?></th>
            <!-- <th><?php echo '<h3>'.$keyword.' '.$iif.'<br> '.$start_date.' ~ '.$end_date.'</h3>' ?></th> -->
            <div>
            <?php
            echo "
                <form id='myform' method='POST', action='seo_result_val.php'>
                    <select name='iif_select'>
                        <option value='Elu_based' selected='selected'>Elu</option>
                        <option value='Frequency_based'>Frequency</option>
                    </select>
                    <input style='display:none' type='date' id='start' name='trip-start' value = '$start_date'>
                    <input style='display:none' type='date' id='start' name='trip-end' value = '$end_date'>
                    <input style='display:none' type='text' name='keyword' value='$keyword'>
                    <input type='submit' value='IIF 값 보기'>
                </form>";
                ?>


            <!-- <form id='myform' method='POST', action='seo_result_val.php'>
                <label for="start">Start date:</label>
                <input type="date" id="start" name="trip-start">

                <label for="end">End date:</label>
                <input type="date" id="end" name="trip-end">

                <?php
            echo "<input style='display:none' type='text' name='keyword' value='$keyword'>
                <input style='display:none' type='text' name='iif_select' value='$iif'>
                ";
                ?>

                <p>
                    <input type='submit' value='Submit'>
                </p> -->
            </form>

            <!-- <p>* 화면에서 보여지는 최대 선택 가능한 기간은 30일 입니다</p> -->

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