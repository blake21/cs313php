<?php
  //Open DB
try
{
   $db = OpenDB("SledWraps");

} catch (Exception $ex)
{
   echo "Connection failed: " . $ex->getMessage();
   die();
}

echo "SCRIPTURE RESOURCES<br>";

// ***** Using PDO format

$dbcolumn =  $_POST['type'];
echo $dbcolumn;
echo "<br>";
echo $db->quote($_POST['type']);
echo "<br>";

//"SELECT id, book, chapter, verse, context FROM scriptures where book = 'John'"


if($dbcolumn == "All" || $dbcolumn == NULL)
   $statement = $db->query("SELECT * FROM Wrap");
else
   $statement = $db->query("SELECT * FROM Wrap where type = " . $db->quote($_POST['type']) );

$results = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach ($results as $row)
{
   echo "<b>" . $row["type"]. " " . $row["make"]. ":" . $row["model"]. "</b> - ". $row["year"]."<br>";
}

$db = null;

function openDB($dbname)
{

   $openShiftVar = getenv('OPENSHIFT_MYSQL_DB_HOST');

   if ($openShiftVar === null || $openShiftVar == "")
   {
      // Not in the openshift environment
      //echo "Using local credentials: ";
      //require("setLocalDatabaseCredentials.php");
    $servername = "localhost";
    $username = "php";
    $password = "php-pass";

   }
   else
   {
      else
   {
          // In the openshift environment
          //echo "Using openshift credentials: ";
          $servername = getenv('OPENSHIFT_MYSQL_DB_HOST');
          $dbPort = getenv('OPENSHIFT_MYSQL_DB_PORT');
          $username = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
          $password = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');

   }

   // Create connection
   //$db = new mysqli($servername, $username, $password, $dbname);
          echo "host: $servername <br> dbPort: $dbPort <br> dbName:$dbname <br> user:$username <br> password:$password<br><b>\n";

          $db = new PDO('mysql:host=127.0.0.1;dbname=dbname', $username, $password);

   return $db;

}

?>

