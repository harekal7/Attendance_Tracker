<html>

<head>
<link rel="stylesheet" type="text/css" href="../css/retrieve.css">
</head>

<body>
<?php
session_start();
if(!isset($_SESSION["myusername"])){
header("location:index.html");
session_destroy();
}

echo "<p align='right'><a href=\"../back.php\"> logout!</a></p>";
$con = mysql_connect("localhost","root","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("at", $con);
$myusername= $_GET['username'];
$subcode= $_GET['subcode'];
$result = mysql_query("SELECT * FROM sub1 where Subject_code=('$subcode')");


echo "<center>";
echo "<table border='1'>";
echo "<tr>";
echo "<th><font size=\"5\" color=\"white\">USN<font></th>";
echo "<th><font size=\"5\" color=\"white\"> Conducted <font></th>";
echo "<th><font size=\"5\" color=\"white\"> Attended <font></th>";
echo "<th><font size=\"5\" color=\"white\"> Percentage <font></th>";
echo "<th><font size=\"5\" color=\"white\">Zone<font></th>";
echo "<th><font size=\"5\" color=\"white\"> Mark Attendance <font></th>";
echo "</tr>";

echo '<form action="update.php" method="post">';
while($row = mysql_fetch_array($result))
  {
  $a = $row['Class_conducted'];
  $b = $row['Class_attended'];
  $c = ($b/$a)*100;
  $c = number_format ($c, 2);
  $d = "";
  echo "<tr>";
  echo "<td align='center'><font size=\"4\" color=\"white\">" . $row['USN'] . "<font></td>";
  echo "<td align='center'><font size=\"4\" color=\"white\">" . $row['Class_conducted'] . "<font></td>";
  echo "<td align='center'><font size=\"4\" color=\"white\">" . $row['Class_attended'] . "<font></td>";
  echo "<td align='center'><font size=\"4\" color=\"white\">" . $c . "<font></td>";
  if ($c>=80) echo "<td align='center' bgcolor=\"green\"><font size=\"4\" color=\"white\">" . $d . "</font></td>";
  elseif ($c>=75 ) echo "<td align='center' bgcolor=\"orange\"><font size=\"4\" color=\"white\">" . $d . "</font></td>";
  else echo "<td align='center' bgcolor=\"red\"><font size=\"4\" color=\"white\">" . $d . "</font></td>";
  echo "<td align='center'><input type='checkbox' name='cb[]' value=". $row['USN'] ." /></td>";
  echo "</tr>";
  }
echo "<tr>";
echo "<td></td>";
echo "<td></td>";
echo "<td></td>";
echo "<td><input type='text' name='username' value='$myusername' hidden readonly/></td>";
echo "<td><input type='text' name='subcode' value='$subcode' readonly hidden/></td>";
echo "<td align='center'><input type='submit' name='update' value='Update'/></td>";
echo "</tr>";
echo "</table>";
echo "</center>";
echo "</form>";

echo '<form action="change.php" method="post" >';
echo "<input type='text' name='username' value='$myusername' hidden readonly/>";
echo "<p align='center' ><input type='submit' name='back' value='Change Subject'></p>";
echo '</form>';

mysql_close($con);
?>
</body>
</html>
