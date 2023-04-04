<?php
// MySQL 데이터베이스 연결
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mysql";
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
  die("연결 실패: " . $conn->connect_error);
}

// MySQL 쿼리
$sql = "SELECT name, count FROM A";
$result = $conn->query($sql);

// 데이터를 배열로 변환
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = array($row["name"], (int)$row["count"]);
}


// Google Charts 라이브러리를 이용한 그래프 출력

echo "<html>
<head>
    <title>Google Charts Example</title>
    <script type=\"text/javascript\" src=\"https://www.gstatic.com/charts/loader.js\"></script>
    <script type=\"text/javascript\">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
 
        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Name');
            data.addColumn('number', 'Count');
            data.addRows(".json_encode($data).");
 
            var options = {
                title: '피자이름',
                is3D: true
            };
 
            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>
</head>
<body>
    <div id=\"chart_div\" style=\"width: 900px; height: 500px;\"></div>
</body>
</html>";

// MySQL 연결 종료
$conn->close();
?>

