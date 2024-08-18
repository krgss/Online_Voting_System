
<html>
   <head>
    <title>Online Voting Results</title>
    <link  rel="stylesheet" type="text/css" href="css/style.css" />

    <!-- You need to include the following JS file to render the chart.
    When you make your own charts, make sure that the path to this JS file is correct.
    Else, you will get JavaScript errors. -->

    <script src="fusioncharts/fusioncharts.js"></script>
  </head>
<body>  
<?php
session_start(); 
include("fusioncharts.php");

$hostdb = "localhost";  // MySQl host
 $userdb = "root";  // MySQL username
 $passdb = "";  // MySQL password
 $namedb = "onlinevoting";  // MySQL database name

 // Establish a connection to the database
 $dbhandle = new mysqli($hostdb, $userdb, $passdb, $namedb);

 // Render an error message, to avoid abrupt failure, if the database connection parameters are incorrect
 if ($dbhandle->connect_error) {
  exit("There was an error with your connection: ".$dbhandle->connect_error);
 }
$con = $_SESSION['son'];
  // Form the SQL query that returns the top 10 most populous countries
$strQuery = "SELECT a.name,c.count from aadhaar a inner JOIN candidate c where a.uid=c.uid and c.constituency= '$con'";

  // Execute the query, or else return the error message.
  $result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

  // If the query returns a valid response, prepare the JSON string
  if ($result) {
    // The `$arrData` array holds the chart attributes and data
    $arrData = array(
      "chart" => array(
          "caption" => "Online Voting System",
        "subcaption"=> "Results",
        "startingangle" => "120",
        "showlabels" => "0",
        "showlegend" => "1",
        "enablemultislicing" => "0",
        "slicingdistance" => "15",
        "showpercentvalues" => "1",
        "showpercentintooltip" => "0",
   //     "plottooltext" => "Age group : $label Total visit : $datavalue",
        "theme" => "ocean"
        )
    );
    $arrData["data"] = array();

    // Push the data into the array
    while($row = mysqli_fetch_array($result)) {
      array_push($arrData["data"], array(
          "label" => $row["name"],
                "value" => $row["count"]
          )
      );
    }
$jsonEncodedData = json_encode($arrData);

$pie3dChart = new FusionCharts("pie3d", "ex2", "100%", "100%", "chart-1", "json",$jsonEncodedData);

// Render the chart
$pie3dChart->render();
 $dbhandle->close();
}
?>
 <div id="chart-1"><!-- Fusion Charts will render here--></div>
</body>
</html>