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
        $clustering_type = $_GET['Clustering']
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
            <th><?php echo '<h3>'.$keyword.' '.$iif.' [Preprocessed] <br> '.$start_date.' ~ '.$end_date.' <br> '.$clustering_type.'</h3>' ?></th>
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
                function getConstantVowel(kor) {
                    const f = ['ㄱ', 'ㄲ', 'ㄴ', 'ㄷ', 'ㄸ', 'ㄹ', 'ㅁ',
                            'ㅂ', 'ㅃ', 'ㅅ', 'ㅆ', 'ㅇ', 'ㅈ', 'ㅉ',
                            'ㅊ', 'ㅋ', 'ㅌ', 'ㅍ', 'ㅎ'];
                    const s = ['ㅏ', 'ㅐ', 'ㅑ', 'ㅒ', 'ㅓ', 'ㅔ', 'ㅕ',
                            'ㅖ', 'ㅗ', 'ㅘ', 'ㅙ', 'ㅚ', 'ㅛ', 'ㅜ',
                            'ㅝ', 'ㅞ', 'ㅟ', 'ㅠ', 'ㅡ', 'ㅢ', 'ㅣ'];
                    const t = ['', 'ㄱ', 'ㄲ', 'ㄳ', 'ㄴ', 'ㄵ', 'ㄶ',
                            'ㄷ', 'ㄹ', 'ㄺ', 'ㄻ', 'ㄼ', 'ㄽ', 'ㄾ',
                            'ㄿ', 'ㅀ', 'ㅁ', 'ㅂ', 'ㅄ', 'ㅅ', 'ㅆ',
                            'ㅇ', 'ㅈ', 'ㅊ', 'ㅋ', 'ㅌ', 'ㅍ', 'ㅎ'];

                    const ga = 44032;
                    let uni = kor.charCodeAt(0);

                    uni = uni - ga;

                    let fn = parseInt(uni / 588);
                    let sn = parseInt((uni - (fn * 588)) / 28);
                    let tn = parseInt(uni % 28);
                    
                    fe = f[fn];
                    se = s[sn];
                    te = t[tn];
                    var result_list = new Array();
                    result_list.push(fe)
                    result_list.push(se)
                    result_list.push(te)

                    return result_list;
                }
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

                    

                    // for(var i in meta_keyword_list){
                    //     meta_keyword_list.indexOf('/');
                    // }


                    let filtered = meta_keyword_list.filter((element) => element);
                    // console.log(filtered);
                    
                    // filter_keyword = ['(',')','/','','511']

                    // for(var i in filter_keyword){
                    //     filtered = filtered.filter((element) => element != filter_keyword[i])
                    // }

                    const korean = /[ㄱ-ㅎ|ㅏ-ㅣ|가-힣]/;
                    filtered_temp = meta_keyword_list.filter((element) => element);

                    for(var i in filtered){
                        if(korean.test(filtered[i]) == false){
                            filtered_temp = filtered_temp.filter((element) => element != filtered[i])
                        }
                    }

                    // console.log(filtered_temp);

                    filtered_temp_temp = filtered_temp;

                    date_length = _date_array.length;

                    for(var i in filtered_temp){
                        check_val = 0;
                        for(var j in _date_array){
                            for(var n in result_list[j]){
                                if(result_list[j][n][0] == filtered_temp[i]){
                                    check_val = check_val + 1;
                                    break;
                                }
                            } 
                        }
                        if(check_val <= date_length * 0.3){
                            filtered_temp_temp = filtered_temp_temp.filter((element) => element != filtered_temp[i])
                        }
                    }

                    // console.log(filtered_temp_temp);
                    meta_keyword_list = filtered_temp_temp;

                    // var rowCnt = set_meta_keyword_list.size;
                    var rowCnt = meta_keyword_list.length;
                    var columnCnt = _raw_array.length;

                    function LCS(x, y) {
                    var i = x.length;
                    var j = y.length;
                    var result = [];
                    for (var k = 0; k <= i; k++) {
                            if (!result[k]) {
                                result[k] = []; // 이전 계산 값 저장 공간
                            }
                        }
                        for (k = 0; k <= i; k++) {
                            for (var l = 0; l <= j; l++) {
                                console.log(k, l);
                            if (k === 0 || l === 0) { // 베이스 값 설정
                                    result[k][l] = 0;
                                } 
                            else if (x[k - 1] === y[l - 1]) { // 마지막 두 문자 비교, 같으면
                                    result[k][l] = result[k - 1][l - 1] + 1;
                                } 
                            else { // 마지막 두 문자가 다르면
                                    result[k][l] = Math.max(result[k - 1][l], result[k][l - 1]);
                                }
                            }
                        }
                        return result[i][j];
                    }

                    const levenshteinDistance = (s, t) => {
                        if (!s.length) return t.length;
                        if (!t.length) return s.length;
                        const arr = [];
                        for (let i = 0; i <= t.length; i++) {
                            arr[i] = [i];
                            for (let j = 1; j <= s.length; j++) {
                            arr[i][j] =
                                i === 0
                                ? j
                                : Math.min(
                                    arr[i - 1][j] + 1,
                                    arr[i][j - 1] + 1,
                                    arr[i - 1][j - 1] + (s[j - 1] === t[i - 1] ? 0 : 1)
                                    );
                            }
                        }
                        return arr[t.length][s.length];
                    };
                    
                    const hamming_distance = (a, b) => {
                        let d = 0;
                        let h = a ^ b;
                        while (h > 0) {
                            d ++;
                            h &= h - 1;
                        }
                        return d;
                    }

                    const SepKor = (s) =>{
                        temp_sep_list = []
                        for(var i in s){
                            const a = getConstantVowel(s[i])
                            for(var j in a){
                                if(a[j] != ""){
                                    temp_sep_list.push(a[j])
                                }
                            }
                        }
                        return temp_sep_list;
                    };

                    var DameraulevenshteinDistance= function(seq1,seq2){
                        var len1=seq1.length;
                        var len2=seq2.length;
                        var i, j;
                        var dist;
                        var ic, dc, rc;
                        var last, old, column;

                        var weighter={
                            insert:function(c) { return 1.; },
                            delete:function(c) { return 0.5; },
                            replace:function(c, d) { return 0.3; }
                        };

                        /* don't swap the sequences, or this is gonna be painful */
                        if (len1 == 0 || len2 == 0) {
                            dist = 0;
                            while (len1)
                                dist += weighter.delete(seq1[--len1]);
                            while (len2)
                                dist += weighter.insert(seq2[--len2]);
                            return dist;
                        }

                        column = []; // malloc((len2 + 1) * sizeof(double));
                        //if (!column) return -1;

                        column[0] = 0;
                        for (j = 1; j <= len2; ++j)
                            column[j] = column[j - 1] + weighter.insert(seq2[j - 1]);

                        for (i = 1; i <= len1; ++i) {
                            last = column[0]; /* m[i-1][0] */
                            column[0] += weighter.delete(seq1[i - 1]); /* m[i][0] */
                            for (j = 1; j <= len2; ++j) {
                                old = column[j];
                                if (seq1[i - 1] == seq2[j - 1]) {
                                    column[j] = last; /* m[i-1][j-1] */
                                } else {
                                    ic = column[j - 1] + weighter.insert(seq2[j - 1]);      /* m[i][j-1] */
                                    dc = column[j] + weighter.delete(seq1[i - 1]);          /* m[i-1][j] */
                                    rc = last + weighter.replace(seq1[i - 1], seq2[j - 1]); /* m[i-1][j-1] */
                                    column[j] = ic < dc ? ic : (dc < rc ? dc : rc);
                                }
                                last = old;
                            }
                        }

                        dist = column[len2];
                        return dist;
                    }
                    function DameraulevenshteinDistance_temp( a, b ){
                        var i;
                        var j;
                        var cost;
                        var d = new Array();
                    
                        if ( a.length == 0 ){
                            return b.length;
                        }
                    
                        if ( b.length == 0 ){
                            return a.length;
                        }
                    
                        for ( i = 0; i <= a.length; i++ ){
                            d[ i ] = new Array();
                            d[ i ][ 0 ] = i;
                        }
                    
                        for ( j = 0; j <= b.length; j++ ){
                            d[ 0 ][ j ] = j;
                        }
                    
                        for ( i = 1; i <= a.length; i++ ){
                            for ( j = 1; j <= b.length; j++ ){
                                if ( a.charAt( i - 1 ) == b.charAt( j - 1 ) ){
                                    cost = 0;
                                }
                                else{
                                    cost = 1;
                                }
                    
                                d[ i ][ j ] = Math.min( d[ i - 1 ][ j ] + 1, d[ i ][ j - 1 ] + 1, d[ i - 1 ][ j - 1 ] + cost );
                                
                                if(
                                i > 1 && 
                                j > 1 &&  
                                a.charAt(i - 1) == b.charAt(j-2) && 
                                a.charAt(i-2) == b.charAt(j-1)
                                ){
                                d[i][j] = Math.min(
                                    d[i][j],
                                    d[i - 2][j - 2] + cost
                                )
                            
                                }
                            }
                        }
                    
                        return d[ a.length ][ b.length ];
                    }

                    var jarodistance = function(str1, str2){
                        var lenStr1 = str1.length,
                            lenStr2 = str2.length,
                            matchWindow = Math.max(lenStr1, lenStr2)/2-1,
                            transpositions=0,
                            matches=0,
                            letter='';
                        
                        // Test if swapping strX & lenStrX if stra is longer then str2 for proformance ??
                        // another option is to bail out of the stepping once we are outside of the context of the other string
                        // the issue is that with string lengths of 11 & 2 you wouldn't want to go through the loop 11 times
                        
                        /* find matches & transpositions */
                        for (var i in str2) {
                                letter = str2[i];
                                if(str1.slice(i,i+matchWindow).indexOf(letter) > -1) { /* match */
                                matches++;
                                } 
                                else if(str1.slice(i-matchWindow,i).indexOf(letter) > -1) { /* transposition */
                                matches++; transpositions++;
                                }
                        };
                        return (1/3*(matches/lenStr1+matches/lenStr2+(matches-transpositions)/matches));
                    };

                    var jaroWinklerdistance = function(str1, str2, p){
                        p = p || 0.1;
                        var dj = jarodistance(str1,str2), l=0; 
                        
                        for(var i=0; i<4; i++) { /* find length of prefix match (max 4) */
                            if(str1[i]==str2[i]){
                                l++; 
                            } 
                            else {
                                break; 
                            } 
                        }
                        return dj+(l*p*(1-dj));
                    };

                    // String.prototype.score = function(abbreviation) {
                    // return jaroWinkler(this.toLowerCase(),abbreviation.toLowerCase());
                    // };

                    filtered_keyword = filtered_temp_temp

                    // document.write("여기부터는 최장 공통 부분 부분수열")
                    // document.write('<br>')
                    // document.write('<br>')

                    // for(var i in filtered_keyword){
                    //     document.write(filtered_keyword[i].bold())
                    //     document.write(" : ")
                    //     for(var j in filtered_temp_temp){
                    //         // if(LCS(SepKor(filtered_keyword[i]),SepKor(filtered_temp_temp[j])) >= filtered_keyword[i].length){
                    //         //     document.write(filtered_temp_temp[j])
                    //         //     document.write(', ')
                    //         // }
                    //         if(LCS((filtered_keyword[i]),(filtered_temp_temp[j])) >= filtered_keyword[i].length){
                    //             document.write(filtered_temp_temp[j])
                    //             document.write(', ')
                    //         }
                    //     }
                    //     document.write('<br>')
                    // }
                    // document.write('<br>')
                    // document.write('<br>')

                    // document.write("여기부터는 편집거리")
                    // document.write('<br>')
                    // document.write('<br>')

                    var clustering_type = '<?php echo $clustering_type ?>'

                    if(clustering_type == 'Levenshtein_Distance'){
                        console.log('this is Levenshtein')
                        for(var i in filtered_keyword){
                            document.write(filtered_keyword[i].bold())
                            document.write(" : ")
                            drop_list = []

                            for(var j in filtered_temp_temp){
                                if(levenshteinDistance(SepKor(filtered_keyword[i]),SepKor(filtered_temp_temp[j])) <= 2){
                                    document.write(filtered_temp_temp[j])
                                    document.write(', ')
                                    drop_list.push(j)
                                }
                            }
                            for(var k in drop_list){
                                filtered_temp_temp[drop_list[k]] == null
                            }
                            document.write('<br>')
                        }
                    }
                    else if(clustering_type == 'Damerau_Levenshtein_Distance'){
                        console.log('this is Damerau Levenshtein')
                        for(var i in filtered_keyword){
                            document.write(filtered_keyword[i].bold())
                            document.write(" : ")
                            drop_list = []

                            for(var j in filtered_temp_temp){
                                if(DameraulevenshteinDistance(SepKor(filtered_keyword[i]),SepKor(filtered_temp_temp[j])) <= 2){
                                    document.write(filtered_temp_temp[j])
                                    document.write(', ')
                                    drop_list.push(j)
                                }
                            }
                            for(var k in drop_list){
                                filtered_temp_temp[drop_list[k]] == null
                            }
                            document.write('<br>')
                        }
                    }
                    else if(clustering_type == 'Jaro_Distance'){
                        console.log('this is Jaro')
                        for(var i in filtered_keyword){
                            document.write(filtered_keyword[i].bold())
                            document.write(" : ")
                            drop_list = []

                            for(var j in filtered_temp_temp){
                                if(jarodistance(SepKor(filtered_keyword[i]),SepKor(filtered_temp_temp[j])) >= 0.9){
                                    document.write(filtered_temp_temp[j])
                                    document.write(', ')
                                    drop_list.push(j)
                                }
                            }
                            for(var k in drop_list){
                                filtered_temp_temp[drop_list[k]] == null
                            }
                            document.write('<br>')
                        }
                    }
                    else if(clustering_type == 'Jaro_Winkler_Distance'){
                        console.log('this is Jaro Winkler')
                        for(var i in filtered_keyword){
                            document.write(filtered_keyword[i].bold())
                            document.write(" : ")
                            drop_list = []

                            for(var j in filtered_temp_temp){
                                if(jaroWinklerdistance(SepKor(filtered_keyword[i]),SepKor(filtered_temp_temp[j]),0.15) >=0.9){
                                    document.write(filtered_temp_temp[j])
                                    document.write(', ')
                                    drop_list.push(j)
                                }
                            }
                            for(var k in drop_list){
                                filtered_temp_temp[drop_list[k]] == null
                            }
                            document.write('<br>')
                        }
                    }
                    else if(clustering_type == 'Longest_Common_Subsequence'){
                        console.log('this is longest common subsequence')
                        for(var i in filtered_keyword){
                            document.write(filtered_keyword[i].bold())
                            document.write(" : ")
                            drop_list = []

                            for(var j in filtered_temp_temp){
                                if(LCS((filtered_keyword[i]),(filtered_temp_temp[j])) >= filtered_keyword[i].length){
                                    document.write(filtered_temp_temp[j])
                                    document.write(', ')
                                    drop_list.push(j)
                                }
                            }
                            for(var k in drop_list){
                                filtered_temp_temp[drop_list[k]] == null
                            }
                            document.write('<br>')
                        }
                    }
                    else{
                        document.write('편집거리 기준을 선택해주세요')
                    }
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