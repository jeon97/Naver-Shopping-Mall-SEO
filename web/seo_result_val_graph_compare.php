<!DOCTYPE html>
<html lang="en">

    <head>
        <title>DySEO</title>
        <link rel="stylesheet" href="seo_css.css">
    </head>

    </style>
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
                // console.log(result_list);
                for(var a in _meta_keyword){
                    array_for_graph = [];
                    for(var i in result_list){
                        var n = 0;
                        for(var j in result_list[i]){
                            if (result_list[i][j][0] == _meta_keyword[a]){
                                array_for_graph.push(Math.round(Number(result_list[i][j][(result_list[i][j].length)-1]/result_list[i][0][(result_list[i][0].length)-1])*100));
                                n = n + 1;
                                break;
                            }
                        }
                        if(n!=1){
                            array_for_graph.push(0);
                        }
                    }
                    temp_array = temp_array = [_meta_keyword[a],_date_array, array_for_graph];
                    graph_data.push(temp_array);
                }

                // return [_date_array, array_for_graph];
            }
            return graph_data;
        }

        function change_at_random() { 
            var R = Math.round(Math.random() * 255); 
            var G = Math.round(Math.random() * 255); 
            var B = Math.round(Math.random() * 255); 
            var rgbColor = "rgb(" + R + "," + G + "," + B + ")"; 
            return rgbColor;
        } 

        function graph_temp(all_data){
            array_for_graph = split_data(all_data);
            // console.log(array_for_graph);
            const labels = array_for_graph[0][1];

            $color = Array();
            for(var i in array_for_graph){
                $temp_color = change_at_random();
                $color.push($temp_color);
            }
            var dict_data = [];

            for(var i in array_for_graph){
                temp_array_for_graph = {
                    label: array_for_graph[i][0],
                    backgroundColor: $color[i],
                    borderColor: $color[i],
                    data: array_for_graph[i][2],
                }
                dict_data.push(temp_array_for_graph);
            }

            const data = {
                labels: labels,
                datasets:dict_data
            };

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
        $meta_keyword_compare = $_GET['meta_keyword'];
        $iif = $_GET['iif_select'];
        $start_date = $_GET["trip-start"];
        $end_date = $_GET["trip-end"];
        ?>
        <div>
            <div>
                <th>
                    <?php
                    echo '<h3>';
                     for ($i = 0; $i < count($meta_keyword_compare); $i = $i + 1){
                        echo $meta_keyword_compare[$i].' ';
                     }
                    echo '- '.$iif.'</h3><h3>'.$start_date.' ~ '.$end_date.'</h3>';
                    ?>
                 </th>
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
                    $count_keyword = count($meta_keyword_compare);
                    if($iif == 'Elu_based'){

                        $sql = "SELECT * FROM seo_iif_new WHERE keyword = '$keyword' AND search_date BETWEEN date('$start_date') and date('$end_date')+1";
                    
                        $result = mysqli_query($conn,$sql);
                        
                        $row_array = array();
    
                        while($row = mysqli_fetch_array($result)){
                            array_push($row_array, $row['iif']);
                        }

                        $keyword_array = [$keyword, $meta_keyword_compare];
                        $temp_array = array();
                        array_push($temp_array, $row_array);
                        array_push($temp_array, $date_array);
                        array_push($temp_array, $keyword_array);
                        array_push($all_data, $temp_array);

                    }
                    else{
                        $sql = "SELECT * FROM seo_iif_new_tf WHERE keyword = '$keyword' AND search_date BETWEEN date('$start_date') and date('$end_date')+1";

                        $result = mysqli_query($conn,$sql);

                        $row_array = array();

                        while($row = mysqli_fetch_array($result)){
                            array_push($row_array, $row['iif']);

                        }

                        $keyword_array = [$keyword, $meta_keyword_compare];
                        $temp_array = array();
                        array_push($temp_array, $row_array);
                        array_push($temp_array, $date_array);
                        array_push($temp_array, $keyword_array);

                        array_push($all_data, $temp_array);
                    }
                    
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