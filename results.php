<html>
  <head>
    <title>results.php</title>
  </head>
  <body>
    <h1>Here are your results from your survey</h1>
    <?php
      $email = $_POST["email"];
      echo "<b>Your favorite color is:  </b>";
      echo $_POST["name"];
      echo "<b><br><br>Your favorite movie is: </b>";
      echo "$email";
      echo "<br><br><b>Your major is: </b>";
      echo $_POST["major"];
      echo "<br><br><b>You know these programming languages: </b>";

      if(!empty($_POST['check_list'])) {
         foreach($_POST['check_list'] as $check) {
            echo $check;
            echo ", ";
         }
      }
      echo "<br><br><a href='results.php'>Back</a>";
    ?>
  </body>
</html>
