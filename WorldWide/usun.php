<?php

session_start();

    require_once "connect.php";
    
    $conn = mysqli_connect($host, $db_user, $db_password, $db_name)
    or die('Bład połączenia z serwerem: ' . mysqli_connect_error());
    echo "Polaczenie udane <br>";

$data=$_GET['data'];

echo $data;

$result = mysqli_query($conn,"DELETE *
                            FROM podroze  
                            WHERE data =$_SESSION[id]");



//$usun= "DELETE FROM gracze WHERE gracz_id=$id; ";
  //  $wynik= mysqli_query($conn, $usun);


//header('Location: index.php');

?>