<?php include("connectToInfinityDB.inc");?>
<!DOCTYPE html>

<!--admin.php-->
<!--Admin page of Creighton COVID survey-->
<!--Made by Ryan King and Dr.Samer-->
<!--November 19, 2020-->
<html>
  <head>
     <meta charset="utf-8">
     <title>COVID Admin Page</title>
     <link href="https://fonts.googleapis.com/css?family=Chilanka&display=swap" rel="stylesheet">
     <link href="css/master.css" rel="stylesheet" type="text/CSS">
  </head>

  <body>
    <!--header-->
    <section id="pinksquare">
      <header>
        <h1>Creighton COVID-19 Survey</h1>
        <h2>- Admin Page -</h2>
      </header>

      <!--Display Bar Chart-->
      <p>Survey Responses Visualized</p>
      <div id="barchart" class="visual" style="width: 600px; height: 350px;"></div>

      <!--Display table-->
      <p>Table of indivudal survey responses.<br> Each row is a single survey response.<br> Each cell is a score out of 20.</p>
      <table class="visual">
        <tr>
          <th>participantID</th>
          <th>cat1 (D & Q)</th>
          <th>cat2 (Fall 2020)</th>
          <th>cat3 (Academics)</th>
          <th>cat4 (Life 2020)</th>
          <th>cat5 (Mental)</th>
       </tr>
       <?php echo showAllData()['surveyresults']?>
     </table>
   </body>


   <?php

   //Refresh the table if an UPDATE TABLE or DELETE FROM TABLE form is submitted
   if(isset($_POST['attributeName1']) && isset($_POST['attributeValue1']))
   	{
   		deleteRecords();
   		header("Refresh:0");
   	}
   else if(isset($_POST['attributeName2']) && isset($_POST['attributeValue2']) && isset($_POST['attributeName3']) && isset($_POST['attributeValue3']))
   	{
   		updateRecords();
   		header("Refresh:0");
   	}


    //Creates HTML table that displays MYSQL table.
     function showAllData() {
       $dataBase = connectDB();
       $query1 = 'SELECT * FROM surveyresults ORDER BY participantID';
       $result1 = mysqli_query($dataBase, $query1) or die('Query failed: ' . mysqli_error($dataBase));
       $surveyCode = "";
       while ($row = $result1->fetch_assoc()) {
         $col0 = $row["participantID"];
         $col1 = $row["cat1"];
         $col2 = $row["cat2"];
         $col3 = $row["cat3"];
         $col4 = $row["cat4"];
         $col5 = $row["cat5"];
         $surveyCode .= "<tr><td>${col0}</td><td>${col1}</td><td>${col2}</td><td>${col3}</td><td>${col4}</td><td>${col5}</td></tr>";
       };
       return array(
         'surveyresults' => $surveyCode,
       );
     }


     //Debug function: Print column of MYSQL table.
     function printCat() {
       $database = connectDB();
       $query = "SELECT cat2 FROM surveyresults";
       $result = mysqli_query($database, $query);
       while ($row = mysqli_fetch_array($result)) {
         if ($row[0] != null) {
           print_r($row[0]);
           echo " | ";
         }
       }
       mysqli_close($database);
     }


     //Calculates average from a column of MYSQL table.
     function avgCatScore($column) {
       $totScore = 0;
       $count = 0;
       $database = connectDB();
       $query = "SELECT $column FROM surveyresults";
       $result = mysqli_query($database, $query);
       while ($row = mysqli_fetch_array($result)) {
         if ($row[0] != null) {
           $totScore += $row[0] * 5;
           $count ++;
         }
       }
       mysqli_close($database);
       return $totScore/$count;
     }


     ///////////Enabling the Admin to DELETE records///////////
     function deleteRecords(){
     	$dataBase = connectDB();

     	$q1 = 'DELETE FROM ';
      $q2 = "surveyresults";
     	$q3 = " WHERE ";
     	$q4 = mysqli_real_escape_string($dataBase, $_POST['attributeName1']). "=";
     	$q5 = "'" . mysqli_real_escape_string($dataBase, $_POST['attributeValue1']). "'";
     	$query3 = $q1.$q2.$q3.$q4.$q5;
     	echo "You ran this query: ".$query3."<br>";
     	$result3 = mysqli_query($dataBase, $query3) or die('Query failed: ' . mysqli_error($dataBase));
     	echo "the selected row has been deleted . . . <br>";
     	mysqli_close($dataBase);
     }


     ///////////Enabling the Admin to UPDATE records///////////
     function updateRecords(){
     	$dataBase = connectDB();

     	$q1 = ' UPDATE ';
      $q2 = "surveyresults";
     	$q3 = " SET ";
     	$q4 = mysqli_real_escape_string($dataBase, $_POST['attributeName2']). "=";
     	$q5 = "'" . mysqli_real_escape_string($dataBase, $_POST['attributeValue2']). "'";
     	$q6 = ' WHERE ';
     	$q7 = mysqli_real_escape_string($dataBase, $_POST['attributeName3']). "=";
     	$q8 = "'" . mysqli_real_escape_string($dataBase, $_POST['attributeValue3']). "'";
     	$query4 = $q1.$q2.$q3.$q4.$q5.$q6.$q7.$q8;
     	echo "You ran this query: ".$query4."<br>";
     	$result4 = mysqli_query($dataBase, $query4) or die('Query failed: ' . mysqli_error($dataBase));
     	echo "The selected row has been updated.<br>If results are not visible, try refreshing the page.<br>";
     	mysqli_close($dataBase);
     }



     /////Print the Two forms////////
     echo <<<END
     	<h3>Below you can DELETE records from the tables above</h3>
     	<form action="$_SERVER[PHP_SELF]" method="post">
     		<p>WHERE <input type="text" name="attributeName1" value="">  = <input type="text" name="attributeValue1" value=""> </p>
     		<input type='submit'>
     	</form>
     END;


     echo <<<END
     	<h3>Below you can UPDATE records in the tables above</h3>
     	<form action="$_SERVER[PHP_SELF]" method="post">
     		<p>SET <input type="text" name="attributeName2" value=""> = <input type="text" name="attributeValue2" value=""> </p>
     		<p>WHERE <input type="text" name="attributeName3" value=""> = <input type="text" name="attributeValue3" value=""> </p>
     		<input type='submit'>
     	</form>
     END;

   ?>


<!--Create Google Chart bar graph-->
 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
 <script type="text/javascript">
 google.charts.load('current', {'packages':['corechart']});
 google.charts.setOnLoadCallback(drawChart);
 function drawChart() {
   var data = google.visualization.arrayToDataTable([
     ['hello', 'Survey\nAns', { role: 'style' }],
     ['Disease and Quarantine', <?php print(avgCatScore("cat1"));?>, '#005CA9' ],
     ['Creighton Fall 2020', <?php print(avgCatScore("cat2"));?>, '#005CA9'],
     ['Academics', <?php print(avgCatScore("cat3"));?>, '#005CA9'],
     ['College Life 2020', <?php print(avgCatScore("cat4"));?>, '#005CA9'],
     ['Mental Health', <?php print(avgCatScore("cat5"));?>, '#005CA9' ]
   ]);
   var options = {
     title: 'How Comfortable Creighton Students Are with COVID Policies',
     'width':600,
     'height':300,
     hAxis: {
       title: '% Comfort',
       minValue: 0,
       maxValue: 100
     },
     vAxis: {
       title: 'Creighton COVID Policy'
     }
   };
   var chart = new google.visualization.BarChart(document.getElementById('barchart'));
   chart.draw(data, options);
 }</script>


    </section>



</html>
