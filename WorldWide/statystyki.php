
<?php

session_start();

    require_once "connect.php";
    
    $conn = mysqli_connect($host, $db_user, $db_password, $db_name)
    or die('Bład połączenia z serwerem: ' . mysqli_connect_error());
    echo "Polaczenie udane <br>";



$result= mysqli_query($conn, "SELECT * FROM podroze");
          
                echo '<table border="3">';
				
                    		while($row=mysqli_fetch_array($result))
                {       
						echo "<tr>";
						echo "<td>" .$row['miejsce']."</td>";
                        echo "<td>" .$row['czas']."</td>";
                        echo "<td>" .$row['data']."</td>";
                        echo "<td>" .$row['budzet']."</td>";
                        
						echo "</tr>";
						
				}





                    
                    ?>