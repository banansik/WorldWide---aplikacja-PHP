

<?php

session_start();

    require_once "connect.php";
    
    $conn = mysqli_connect($host, $db_user, $db_password, $db_name)
    or die('Bład połączenia z serwerem: ' . mysqli_connect_error());
    //echo "Polaczenie udane <br>";




$update= " UPDATE podroze SET miejsce='".$_POST[miejsce]."', czas='".$_POST[czas]."', data='".$_POST[data]."',
    budzet='".$_POST[budzet]."' WHERE budzet='".$_POST[budzet]."'; ";

$wynik= mysqli_query($conn, $update);

header('Location: index.php');


?>