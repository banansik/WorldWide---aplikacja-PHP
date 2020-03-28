<?php

session_start();

    require_once "connect.php";
    
    $conn = mysqli_connect($host, $db_user, $db_password, $db_name)
    or die('Bład połączenia z serwerem: ' . mysqli_connect_error());
    //echo "Polaczenie udane <br>";


$budzet=$_GET['budzet'];

$result=mysqli_query($conn,"SELECT *
                            FROM podroze  
                            WHERE budzet = $budzet");
       

$row = mysqli_fetch_array($result);

?>

<html>

<head>

<meta charset="utf-8">
    
    
    <link rel="stylesheet" href="style.css">  
    

<title> Mateusz Banasik </title>

</head>

<body>
<div id="edit">
<form action="update.php" method="POST">


Miejsce:<br><input class="zmiana" name="miejsce" value="<?php echo $row[1];?>"> <br>

Czas pobytu:<br><input class="zmiana" name="czas" value="<?php echo $row[2];?>" ><br>

Data wyjazdu:<br><input class="zmiana" name="data" value="<?php echo $row[3];?>"> <br>

Koszt wyjazdu:<br><input class="zmiana" name="budzet" value="<?php echo $row[4];?>"><br>


<input type="submit" class="registerbtn" value="Zmień dane">



</form>
    </div>

</body>

</html>