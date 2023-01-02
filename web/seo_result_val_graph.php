<!DOCTYPE html>
<html lang="en">

    <head>
        <title>DySEO</title>
        <link rel="stylesheet" href="seo_css.css">
    </head>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function split_data(all_data){
            var graph_data = [];

            for(var a in all_data) {
                var _raw_array = all_data[a][0];
                _date_array = all_data[a][1];
                var _keyword = all_data[a][2][0];
                var _meta_keyword = all_data[a][2][1];

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
                
                array_for_graph = [];
                // console.log(result_list);

                for(var i in result_list){
                    var n = 0;
                    for(var j in result_list[i]){
                        if (result_list[i][j][0] == _meta_keyword){
                            // console.log(result_list[i][0][(result_list[i][0].length)-1]);
                            // console.log(result_list[i][0].length)
                            array_for_graph.push(Math.round(Number(result_list[i][j][(result_list[i][j].length)-1]/result_list[i][0][(result_list[i][0].length)-1])*100));
                            n = n + 1;
                        }
                    }
                    if(n!=1){
                        array_for_graph.push(0);
                    }
                }
                temp_array = [_date_array, array_for_graph];
                graph_data.push(temp_array);
            }
            return graph_data;
        }

        function graph(_date_array,array_for_graph){
            const labels = _date_array; 

            const data = {
                labels: labels,
                datasets: [{
                    label: 'value',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: array_for_graph,
            }]
            };
            // === include 'setup' then 'config' above ===
            const config = {
                type: 'line',
                data,
                options: {}
            };
            var myChart = new Chart(
                document.getElementById('myChart'),
                config
            );
            document.write('<canvas id="myChart" height="400"></canvas>');
        }
        
        function graph_temp(all_data){
            array_for_graph = split_data(all_data);
            // console.log(array_for_graph[0]);
            // console.log(array_for_graph[1]);
            const labels = array_for_graph[0][0];

            const data = {
                labels: labels,
                datasets: [{
                    label: 'Elu_based',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: array_for_graph[0][1],
                },
                {
                    label: 'Frequency_based',
                    backgroundColor: 'rgb(119, 77, 248)',
                    borderColor: 'rgb(119, 77, 248)',
                    data: array_for_graph[1][1],
                },
                // {
                //     label: 'value1',
                //     backgroundColor: 'rgb(255, 99, 132)',
                //     borderColor: 'rgb(255, 99, 132)',
                //     data: array_for_graph[0][1],
                // }
            ]
            };
            // === include 'setup' then 'config' above ===
            const config = {
                type: 'line',
                data,
                options: {
                    scales:{
                        y:{
                            max:100,
                            min:0
                        }
                    }
                }
            };
            var myChart_keyword = new Chart(
                document.getElementById('myChart'),
                config
            );
        }
    </script>

    <style>
        a {
            color: #000;
            /* text-decoration: none; */
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
        $meta_keyword = $_GET["meta-keyword"];
        $start_date = $_GET["trip-start"];
        $end_date = $_GET["trip-end"];
        if($_GET["iif_select"] == 'none'){
            $iif = $_GET["iif_select_temp"];
        }
        else{
            $iif = $_GET["iif_select"];
        }
        $clustering_type = $_GET['Clustering']
        ?>
        <div>
            <div>
                <th><?php echo '<h3>'.$meta_keyword.' <br> '.$start_date.' ~ '.$end_date.'</h3>' ?></th>
                <br>
                <form id='myform3' method='GET', action='seo_result_val_graph_clustering.php' target='_blank'>

                    <input style='display:none' type="date" id="start" name="trip-start" value="<?php echo $start_date ?>">
                    <input style='display:none' type="date" id="end" name="trip-end" value="<?php echo $end_date ?>">
                    <input style='display:none' type="text" name="meta-keyword" value="<?php echo $meta_keyword ?>">
                    <input style='display:none' type='text' name='keyword' value='<?php echo $keyword ?>'>
                    

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
                <hr>
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
                    $date_array = array();
                    foreach($array_date as $var) {
                        $date_array[$key] = $var;
                        $key++;
                    }

                    $array_date_set = array_values($array_date);
                    $all_data = array();
// ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                    $sql = "SELECT * FROM seo_iif_new WHERE keyword = '$keyword' AND search_date BETWEEN date('$start_date') and date('$end_date')+1";
                    
                    $result = mysqli_query($conn,$sql);
                    
                    $row_array = array();


                    while($row = mysqli_fetch_array($result)){
                        array_push($row_array, $row['iif']);
                    }

                    $keyword_array = [$keyword, $meta_keyword];
                    $temp_array = array();
                    array_push($temp_array, $row_array);
                    array_push($temp_array, $date_array);
                    array_push($temp_array, $keyword_array);
                    array_push($all_data, $temp_array);
// ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                    $sql = "SELECT * FROM seo_iif_new_tf WHERE keyword = '$keyword' AND search_date BETWEEN date('$start_date') and date('$end_date')+1";
                    
                    $result = mysqli_query($conn,$sql);
                    
                    $row_array = array();

                    while($row = mysqli_fetch_array($result)){
                        array_push($row_array, $row['iif']);
                    }
                    
                    $keyword_array = [$keyword, $meta_keyword];
                    $temp_array = array();
                    array_push($temp_array, $row_array);
                    array_push($temp_array, $date_array);
                    array_push($temp_array, $keyword_array);
                    array_push($all_data, $temp_array);
// -------------------------------------------------------------------------------------------------------------------------------------------------
                    echo "<br>";
                    echo "<canvas id='myChart' height='100'></canvas>";
                    echo ("<script language='javascript'>graph_temp(".json_encode($all_data).");</script>");
                ?>
            </div>
        </div>


            <hr>
            <footer>
                <p></p>
                <p><time pubdate datetime="2018-11-21"></time></p>
            </footer>
        </div>
    </body>
</html>