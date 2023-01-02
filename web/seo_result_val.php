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
        <?php
        $keyword = $_GET["keyword"];
        $start_date = $_GET["trip-start"];
        $end_date = $_GET["trip-end"];
        if($_GET["iif_select"] == 'none'){
            $iif = $_GET["iif_select_temp"];
        }
        else{
            $iif = $_GET["iif_select"];
        }
        // $iif = $_GET["iif_select"];
        ?>

        <script>
            function sendfunction(){
                document.getElementById('Submit').click();
            }
        </script>
        <script>
            function goSubmit(){
                var gsWin = window.open("about:blank", "winName");
                var frm = document.form;
                frm.action = seo_result_val_graph_compare.php;
                frm.target = "winName";
                frm.submit();
            }
        </script>
        <div>
            <div>
            <th><?php echo '<h3>'.$keyword.' '.$iif.' <br> '.$start_date.' ~ '.$end_date.'</h3>' ?></th>
            <hr>
            <form id='myform' method='GET', action='seo_result_val.php'>
                <label for="start">Start date:</label>
                <input type="date" id="start" name="trip-start" value="<?php echo $start_date ?>">

                <label for="end">End date:</label>
                <input type="date" id="end" name="trip-end" value="<?php echo $end_date ?>">
                <input style='display:none' type='text' name='iif_select_temp' value='<?php echo $iif ?>'>

                <label for="IIF">기준값:</label>
                <select name='iif_select' onchange="this.form.submit();">

                    <option value='none'>선택해주세요</option>
                    <option value='Elu_based'>Elu</option>
                    <option value='Frequency_based'>Frequency</option>
                </select>

                <h4>날짜를 먼저 지정해주시고 기준값을 지정해주시면 결과가 자동으로 출력됩니다</h4>


                <?php
             echo "<input style='display:none' type='text' name='keyword' value='$keyword'>
                ";
                ?>

                <p>
                    
                    <input type='submit' value='Preprocessing' formaction="seo_result_val_preprocessing.php">
                        <!-- <button type="submit" form="myform2" onclick="goSubmit();">Compare</button> -->
                    <button type="submit" form="myform2">Compare</button>
                    
                    
                </p>
                <h4>Preprocessing은 필요없는 단어를 제거하는 과정입니다, Compare은 표에서 여러개의 단어들을 IIF 기준으로 비교할 수 있는 창을 띄웁니다</h4>
                
            <!-- </form> -->
                <!-- <?php
             echo "<input style='display:none' type='text' name='keyword' value='$keyword'>
                <input style='display:none' type='text' name='iif_select' value='$iif'>
                <input style='display:none' type='date' id='start' name='trip-start' value='$start_date'>
                <input style='display:none' type='date' id='end' name='trip-end' value='$end_date'>
                ";
                ?> -->
            </form>
            <form id='myform3' method='GET', action='seo_result_val_preprocessing_clustering.php' target='_blank'>
                    <?php
                echo "<input style='display:none' type='text' name='keyword' value='$keyword'>
                    <input style='display:none' type='text' name='iif_select' value='$iif'>
                    ";
                    ?>
                    <input style='display:none' type="date" id="start" name="trip-start" value="<?php echo $start_date ?>">
                    <input style='display:none' type="date" id="end" name="trip-end" value="<?php echo $end_date ?>">
                    

                    <label for="Clustering">클러스터링 기준값:</label>
                    <select name='Clustering' onchange="myform3.submit()" target='_blank'>
                        <option value='none'>선택해주세요</option>
                        <option value='Levenshtein_Distance'>Levenshtein Distance</option>
                        <option value='Damerau_Levenshtein_Distance'>Damerau Levenshtein Distance</option>
                        <option value='Jaro_Distance'>Jaro Distance</option>
                        <option value='Jaro_Winkler_Distance'>Jaro Winkler Distance</option>
                        <option value='Longest_Common_Subsequence'>Longest Common Subsequence</option>
                    </select>
            </form>
                <h4>클러스터링 기준값은 어떤 방식을 가지고 비슷한 단어들을 묶을지를 보여주는 값입니다</h4>
                <hr>
            <script>
                function split_data(all_data){

                    var _raw_array = all_data[0];
                    var _date_array = all_data[1];
                    var _keyword = all_data[2][0];
                    var _iif = all_data[3];

                    var temp_length = 0;

                    var result_list = new Array();
                    var meta_keyword_list = new Array();

                    for (var i in _raw_array){
                        var temp_list = new Array();

                        split_temp = _raw_array[i].split('^');

                        for(var i in split_temp){
                            split_temp_temp = split_temp[i].split(":");
                            temp_list.push(split_temp_temp);
                        }

                        result_list.push(temp_list);

                        for(var i in temp_list){
                            meta_keyword_list.push(temp_list[i][0]);
                        }
                    }
                   
                    var set_meta_keyword_list = new Set(meta_keyword_list);
                    meta_keyword_list = Array.from(set_meta_keyword_list);

                    var rowCnt = set_meta_keyword_list.size;  
                    var columnCnt = _raw_array.length;

                    document.write('<table border="1">');
                        document.write('<tr>');
                            document.write('<td width="20">');
                                document.write("Meta-Keyword");
                            document.write('</td>');
                            for(var i in _date_array){
                                document.write('<td>');
                                document.write(_date_array[i].substring(5,10).replace(/-/, '/'));
                                document.write('</td>');
                            }
                        document.write('</tr>');
                        document.write('<form id="myform2" method="GET", action="seo_result_val_graph_compare.php" target="_blank">');
                        document.write('<input type="date" style="display:none" id="start" name="trip-start" value=',_date_array[0],'>');
                        document.write('<input type="date" style="display:none" id="end" name="trip-end" value=',_date_array[_date_array.length-1],'>');
                        document.write('<input style="display:none" type="text" name="iif_select" value=',_iif,'>');
                        document.write('<input style="display:none" type="text" name="keyword" value=',_keyword,'>')

                        for (let i = 0; i < rowCnt; i++) {
                            document.write('<tr>');
                            document.write('<td width="20">'); 

                            document.write('<a href="seo_result_val_graph.php?keyword=',_keyword,'&meta-keyword=',meta_keyword_list[i],'&trip-start=',_date_array[0],'&trip-end=',_date_array[_date_array.length-1],'" ');
                            document.write('target="_blank">');
                            document.write(meta_keyword_list[i]);
                            document.write('</a>');
                            document.write('<input type="checkbox" name="meta_keyword[]" value=',meta_keyword_list[i],'>');

                            document.write('</td>');
                            var temp_val = 0;
                            var temp_date_check = 0;

                            for (let j = 0; j < columnCnt; j++)  {
                                document.write('<td>');
                                var set_max_100 = Number(result_list[temp_date_check][0][result_list[temp_date_check][0].length-1]);

                                for(var a in result_list[j]){

                                    if (result_list[j][a][0]===meta_keyword_list[i] && meta_keyword_list[i].length!=0){
                                        // document.write('<td>');
                                        if(result_list[j][a].length >=3){
                                            if(Math.round(Number(result_list[j][a][result_list[j][a].length - 1]) / set_max_100 * 100) > temp_val){
                                                document.write(String(Math.round(Number(result_list[j][a][result_list[j][a].length - 1]) / set_max_100 * 100)).fontcolor("red"));
                                                document.write('</td>');
                                                var temp_val = Math.round(Number(result_list[j][a][result_list[j][a].length - 1]) / set_max_100 * 100);
                                                temp_date_check = temp_date_check + 1;
                                                break;
                                            }
                                            else if(Math.round(Number(result_list[j][a][result_list[j][a].length - 1]) / set_max_100 * 100) == temp_val){
                                                document.write(Math.round(Number(result_list[j][a][result_list[j][a].length - 1]) / set_max_100 * 100));
                                                document.write('</td>');
                                                var temp_val = Math.round(Number(result_list[j][a][result_list[j][a].length - 1]) / set_max_100 * 100);
                                                temp_date_check = temp_date_check + 1;
                                                break;
                                            }
                                            else{
                                                document.write(String(Math.round(Number(result_list[j][a][result_list[j][a].length - 1]) / set_max_100 * 100)).fontcolor("blue"));
                                                document.write('</td>');
                                                var temp_val = Math.round(Number(result_list[j][a][result_list[j][a].length - 1]) / set_max_100 * 100);
                                                temp_date_check = temp_date_check + 1;
                                                break;
                                            }
                                            // document.write(result_list[j][a][result_list[j][a].length - 1]);
                                            document.write('</td>');
                                            var temp_val = Math.round(Number(result_list[j][a][result_list[j][a].length - 1]) / set_max_100 * 100);
                                            temp_date_check = temp_date_check + 1;
                                            break;
                                        }
                                        else{
                                            if(Math.round(Number(result_list[j][a][1]) / set_max_100 * 100) > temp_val){
                                                document.write(String(Math.round(Number(result_list[j][a][1]) / set_max_100 * 100)).fontcolor("red"));
                                                document.write('</td>');
                                                var temp_val = (Math.round(Number(result_list[j][a][1]) / set_max_100 * 100));
                                                temp_date_check = temp_date_check + 1;
                                                break;
                                            }
                                            else if(Math.round(Number(result_list[j][a][1]) / set_max_100 * 100) == temp_val){
                                                document.write(Math.round(Number(result_list[j][a][1]) / set_max_100 * 100));
                                                document.write('</td>');
                                                var temp_val = (Math.round(Number(result_list[j][a][1]) / set_max_100 * 100));
                                                temp_date_check = temp_date_check + 1;
                                                break;
                                            }
                                            else{
                                                document.write(String(Math.round(Number(result_list[j][a][1]) / set_max_100 * 100)).fontcolor("blue"));
                                                document.write('</td>');
                                                var temp_val = (Math.round(Number(result_list[j][a][1]) / set_max_100 * 100));
                                                temp_date_check = temp_date_check + 1;
                                                break;
                                            }
                                            // document.write(result_list[j][a][1]);
                                            document.write('</td>');
                                            var temp_val = (Math.round(Number(result_list[j][a][1]) / set_max_100 * 100));
                                            temp_date_check = temp_date_check + 1;
                                            break;
                                        }
                                    }
                                }
                                document.write('</td>');
                            }
                        document.write('</tr>');
                        }
                        document.write('</form>');
                    
                    document.write('</table>');
                }
            </script>
            
            <?php
                function getDatesFromRange($start, $end, $format = 'Y-m-d') {

                    $array = array();

                    $interval = new DateInterval('P1D');

                    $realEnd = new DateTime($end);

                    $realEnd->add($interval);

                    $period = new DatePeriod(new DateTime($start), $interval, $realEnd);

                    foreach($period as $date) {

                        $array[] = $date->format($format);

                    }



                    return $array;

                }

                function getDatesStartToLast($startDate, $lastDate) {
                    $regex = "/^\d{4}-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[0-1])$/";
                    if(!(preg_match($regex, $startDate) && preg_match($regex, $lastDate))) return "Not Date Format";
                    $period = new DatePeriod( new DateTime($startDate), new DateInterval('P1D'), new DateTime($lastDate." +1 day"));
                    foreach ($period as $date) $dates[] = $date->format("Y-m-d");
                    return $dates;
                }

                function getDaysArray($sdate, $edate){

                    $array_days = array();
                  
                    $dt_sdate = new DateTime($sdate);
                  
                    $dt_edate = new DateTime($edate);
                  
                    $dt_today = new DateTime(date('Y-m-d'));
                  
                   
                  
                    $diff = date_diff($dt_sdate, $dt_edate);
                  
                    $diff_today_edate = date_diff($dt_edate, $dt_today);
                  
                    $date_interval_sdate_edate = ($diff->days);
                  
                    $date_interval_today_edate = $diff_today_edate->days;
                  
                   
                  
                    for($i=$date_interval_sdate_edate; $i>=0; $i--){
                  
                      array_push($array_days, date('Y-m-d', strtotime('-'.($date_interval_today_edate + $i).' days')));
                  
                    }
                  
                   
                  
                    return $array_days;
                  
                  }
                
            
                $array_date = getDatesStartToLast($start_date, $end_date);

                    $conn = mysqli_connect("localhost", "j2jung", "*", "j2jung");  
                    $count_date = count($array_date);
                    $temp_date = array();

                    for($i=0; $i<$count_date; $i=$i+1){

                        $temp_date1 = date($array_date[$i]);

                        $sql = "SELECT * FROM seo_iif_new WHERE keyword = '$keyword' AND search_date LIKE '%{$temp_date1}%'";
                        $result = mysqli_query($conn,$sql);

                        $row = mysqli_fetch_array($result);

                        if (empty($row)){
                            unset($array_date[$i]);
                        }
                    }
                    $key = 0;
                    $new_arr = array();
                    foreach($array_date as $var) {
                        $new_arr[$key] = $var;
                        $key++;
                    }

                    $array_date_set = array_values($array_date);

                    if($iif == "Elu_based"){
                        $sql = "SELECT * FROM seo_iif_new WHERE keyword = '$keyword' AND search_date BETWEEN date('$start_date') and date('$end_date')+1";
                    }
                    else{
                        $sql = "SELECT * FROM seo_iif_new_tf WHERE keyword = '$keyword' AND search_date BETWEEN date('$start_date') and date('$end_date')+1";
                    }

                    $result = mysqli_query($conn,$sql);

                    $row_array = array();

                    while($row = mysqli_fetch_array($result)){
                        array_push($row_array, $row['iif']);
                    }
                    
                    $all_data = array();
                    $keyword_array = [$keyword];
                    array_push($all_data, $row_array);
                    array_push($all_data, $new_arr);
                    array_push($all_data, $keyword_array);
                    array_push($all_data, $iif);

                    echo "<br>";
                    echo ("<script language='javascript'>split_data(".json_encode($all_data).");</script>");
            ?>



                <?php
                $conn = mysqli_connect("localhost", "j2jung", "*", "j2jung");

                $sql = "SELECT * from seo_iif where main_keyword = '$keyword'";
                $result = mysqli_query($conn,$sql);

                while($row = mysqli_fetch_array($result)) {
        echo    '<tr>
                    <td>' . $row[ 'keyword' ] . '</td>
                    <td>'. $row[ 'iif' ] . '</td>
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