<html>
<head>
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
  theme: "dark2", // "light1", "light2", "dark1"
  animationEnabled: true,
  title: {
    text: "PAPER COUNT IN EACH DOMAIN"
  },
  axisX: {
    margin: 100,
    interval: 1,
    labelPlacement: "outside",
    labelFontSize: 12,
    tickPlacement: "inside"
  },
  axisY2: {
    title: "no.of papers",
    titleFontSize: 14,
    includeZero: true,
  },
  data: [{
    type: "bar",
    axisYType: "secondary",

    dataPoints: [
        <?php
		  for ($i = 1; $i < 38 ; $i++){
          $stmt = $conn->query("SELECT dname ,SUM(SUBSTRING(rdomain_label,$i,1)) AS paper_count FROM research.research_paper_domain_label R ,research.domain_data P , research.research_data RD WHERE P.did = $i AND R.rid=RD.rid AND RD.ryear = $year");
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if($row['paper_count'] != '0'){
            echo "{y:".$row['paper_count']." , label:'".$row['dname']."'},";   }
          
        }}

        ?>	
    ]

  }]
});
chart.render();
  
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 500px; width: 80%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>