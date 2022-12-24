<?php
// $i = 0;
// while(true) {
    // Pyhonの感情分析データを取得
    $command="python main.py ";
    exec($command,$pythonData); //ターミナルからpythonファイル実行
    // var_dump($pythonData[0]); //(確認用)Pyhonファイルのprint値の1つ目
    // var_dump($pythonData[1]); //(確認用)2つ目

    // csvファイルにデータを書き込む
    $csvdata = [
        ["{$pythonData[0]}"]
    ];
    $fp = fopen('analysis_data.csv', 'a'); //csvファイルを開く
    flock($fp, LOCK_EX); // ファイルをロック
    foreach ($csvdata as $line) {  //foreachでlineという配列に1件ずつ入れて処理
        fputcsv($fp, $line); //第2引数：配列1件分を書き込む
    }
    flock($fp, LOCK_UN); // ファイルのロックを解除 
    fclose($fp); // ファイルを閉じる



    // 保存したcsvデータから値を読み取る
    $str = ''; // データまとめ用の空文字変数
    $file = fopen('analysis_data.csv', 'r'); // ファイルを開く（読み取り専用）
    flock($file, LOCK_EX); // ファイルをロック
    if ($file) { // fgets()で1行ずつ取得→$lineに格納
    while ($line = fgets($file)) {
        $str .= $line; // 取得したデータを`$str`に追加する
    }
    }
    flock($file, LOCK_UN); // ロックを解除
    fclose($file);// ファイルを閉じる
    $json_str = json_encode($str); //jsへ渡すためにjsonへ変換

    //定期的に実行
//     sleep(86400); //24時間に1度実行
//     $i = $i + 1;
//     if ($i == 10) { //10回で処理ストップ
//       break;
//     }
// }

?>


<!--------------------------------------------------- html --------------------------------------------------->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>sentiment analysis</title>
</head>
<body>
<h1>感情分析ツール</h1>
<div class="score_box">
    <h2>〇〇さんの直近の感情スコア</h2>
    <div class="score_wrapper">
        <h2><?=$pythonData[0]?></h2>
    </div>
    <p>※感情スコア：+1 ～ -1</p>
</div>

<canvas id="chart1"></canvas>


<!--------------------------------------------------- js --------------------------------------------------->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            // PHPからjsへデータを渡す
            const result = []; //カンマ区切りで配列に格納
            const jsData = <?php echo $json_str; ?>;
            // console.log(jsData);
             const jsData_arr = jsData.split("\n"); //改行位置で区切る
             for (let i = 0; i < jsData_arr.length; ++i) {
                result[i] = jsData_arr[i].split(','); //カンマで区切る
            }
            console.log(result);

            // -----グラフ-----
            const ctx_analysis_data = document.getElementById('chart1');
            new Chart(ctx_analysis_data, {
                type: 'line',
                data: {
                    labels: ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31'],
                    datasets: [{
                        label: '推移',
                        data: [Number(result[0]),Number(result[1]),Number(result[2]),Number(result[3]),Number(result[4]),Number(result[5]),Number(result[6]),Number(result[7]),Number(result[8]),Number(result[9]),Number(result[10]),Number(result[11]),Number(result[12]),Number(result[13]),Number(result[14]),Number(result[15]),Number(result[16]),Number(result[17]),Number(result[18]),Number(result[19]),Number(result[20]),Number(result[21]),Number(result[22]),Number(result[23]),Number(result[24]),Number(result[25]),Number(result[26]),Number(result[27]),Number(result[28]),Number(result[29]),Number(result[30])],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            max: 1,
                            min: -1,
                        }
                    }
                }
            });

        </script>

</body>
</html>