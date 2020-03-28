<?php

session_start();

    require_once "connect.php";
    
    $conn = mysqli_connect($host, $db_user, $db_password, $db_name)
    or die('Bład połączenia z serwerem: ' . mysqli_connect_error());
    //echo "Polaczenie udane <br>";

$data=$_GET['data'];

$budzet =$_GET['budzet'];

$pot=$_GET['pot'];

$zm=$_GET['zm'];

$date = date("Y/m/d");



if (($budzet!="")&&($pot==1))
    {
    
    
    
    $usun= "DELETE FROM podroze WHERE budzet=$budzet;";
    $wynik= mysqli_query($conn, $usun);
    
    }
?> 

<!DOCTYPE HTML>
<html lang="pl">
<head>
<link rel="stylesheet" href="style.css">   
<meta charset="utf-8">
<title>WorldWide - strona glówna</title>
    
</head>
    
<body>
    
<div id="logo">
           
           
                <span style="text-shadow: 3px 3px #fc9330">WorldWide</span>
            
           
            
    <div id="login">
        <a id="logout" style="font-size:15px" href="logout.php">wyloguj się</a>
    </div>
    </div>
    <div id="info">
<?php




   
echo"<p> Witaj w panelu WorldWide, poniżej zgromadzone są twoje przyszłe oraz odbyte już podróże! "; 
//echo"<p><b>Zwiedziłeś już ".$_SESSION['podroze']." miejsca!<br>";
//echo"<b>W podróży spędziłeś już ".$_SESSION['czas']." dni. Jesteś obywatelem świata!";
        
    
    
    ?>
    </div>
    
    
    <div id="left1">
        
        
        
        <p style="font-size:25px">Twoje podróże:</p>
        <form action="glowna.php" method="post">
        Wyszukaj miejsce
        <input type="text" name="miejsce">
        <br>
        <input type="submit" value="szukaj">
        <input type="submit" value="pokaż wszystko">
            </form>
        
        
        <?php
        
        $miejsce = $_POST['miejsce'];
        $reset = $_POST['reset'];
        
        
        
        
        if ($miejsce!="")
    {
            
            
           // echo "INSERT INTO ogloszenia_uzytkownicy (imie, nazwisko, nazwa, haslo) 
                             //VALUES ('$_POST[miejsce]', '$_POST[nazwisko]', '$_POST[nazwa]', '$_POST[haslo]');";
        
        
        $result= mysqli_query($conn, "SELECT * FROM podroze where miejsce LIKE '$_POST[miejsce]' AND id='$_SESSION[id]'");
            
                    //echo '<table border="3">';
            echo '<table id="tab" width="100%", border="2">';  
        
        
        echo "<tr>";
                        echo "<th>"."Miejsce"."</th>";
                        echo "<th>"."Długość pobytu"."</th>";
                        echo "<th>"."Data wyjazdu"."</th>";
                        echo "<th>"."Budżet"."</th>";
				
				while($row=mysqli_fetch_array($result))
                {       
                    
                    
           
                    
                    
					
						echo "<tr>";
                        echo "<td>" .$row['miejsce']."</td>";
                        echo "<td>" .$row['czas']." Dni</td>";
                        echo "<td>" .$row['data']."</td>";
                        echo "<td>" .$row['budzet']." zł</td>";
						echo "</tr>";
                        
				}
				
				echo '</table>';
            
        }
            
        if($miejsce==""){
        $result= mysqli_query($conn, "SELECT * FROM podroze where id='$_SESSION[id]'");
        
        
            //echo '<table border="3">';
            echo '<table id="tab" width="100%", border="2">';  
        
        
        echo "<tr>";
                        echo "<th>"."Miejsce"."</th>";
                        echo "<th>"."Długość pobytu"."</th>";
                        echo "<th>"."Data wyjazdu"."</th>";
                        echo "<th>"."Budżet"."</th>";
                        echo "<th>"."Usuń"."</th>";
                        echo "<th>"."Zmień"."</th>";
                        
                        
				
				while($row=mysqli_fetch_array($result))
                {       
                    
                    
           if($budzet==$row['budzet']){
                    echo "<tr>";
                        echo "<td bgcolor='red'>" .$row['miejsce']."</td>";
                        echo "<td bgcolor='red'>" .$row['czas']." Dni</td>";
                        echo "<td bgcolor='red'>" .$row['data']."</td>";
                        echo "<td bgcolor='red'>" .$row['budzet']." zł</td>";
                        echo '<td ><a href="glowna.php?budzet='.$row['budzet'].'&pot=1">potwierdź</a></td>';
                        echo '<td><a href="glowna.php?data='.$row['data'].'&pot=2">zmień</a></td>';
						echo "</tr>";
           }
                    else{
                    
                    
					
						echo "<tr>";
                        echo "<td>" .$row['miejsce']."</td>";
                        echo "<td>" .$row['czas']." Dni</td>";
                        echo "<td>" .$row['data']."</td>";
                        echo "<td>" .$row['budzet']." zł</td>";
                        echo '<td><a href="glowna.php?budzet='.$row['budzet'].'&pot=0">usun</a></td>';
                        echo '<td><a href="zmien.php?budzet='.$row['budzet'].'&pot=2">zmień</a></td>';
						echo "</tr>";
                    }
                        
				}
				
				echo '</table>';
        }
        
                ?>






<?php
    
    
        
        
        
        
        
        
        
        
        
        
        
        
        
        ?>

<p style="font-size:25px">Twoje plany:</p>
        
        
        <?php
        
        $result= mysqli_query($conn, "SELECT * FROM plany where id='$_SESSION[id]'");
            
                    //echo '<table border="3">';
            echo '<table id="tab" width="100%", border="2">';  
        
        
        echo "<tr>";
                        echo "<th>"."Miejsce"."</th>";
                        echo "<th>"."Długość pobytu"."</th>";
                        echo "<th>"."Data wyjazdu"."</th>";
                        echo "<th>"."Budżet"."</th>";
				
				while($row=mysqli_fetch_array($result))
                {       
                    
                    
           
                    
                    
					
						echo "<tr>";
                        echo "<td>" .$row['miejsce']."</td>";
                        echo "<td>" .$row['czas']." Dni</td>";
                        echo "<td>" .$row['data']."</td>";
                        echo "<td>" .$row['budzet']." zł</td>";
						echo "</tr>";
                        
				}
				
				echo '</table>';
            
        
        ?>
        

        
        
    </div>
    
    <div id="right1">
    <form method="post">
    <p>Wypełnij poniższe pola aby dodać wspomnienie lub zaplanować podróż</p>
    <hr>

    <label for="Login"><b>Cel podróży</b></label>
    <input class="rej" type="text" placeholder="podaj miejsce" name="miejsce">
      

    <label for="psw"><b>Długość pobytu</b></label>
    <input class="rej" type="number" placeholder="wprowadź długość wyjazdu" name="czas" >

    <label for="psw-repeat"><b>Data wyjazdu</b></label>
    <input class="rej" type="date" placeholder="rrrr-mm-dd" name="data" >
        
    <label for="psw-repeat"><b>Koszt wyjazdu</b></label>
    <input class="rej" type="number" placeholder="jaki był koszt wyjazdu?" name="budzet" >
    <hr>

    
    <button type="submit" name="miejsca" class="registerbtn">Dodaj wspomnienie!</button>
  
          
          </form>
        
        <?php
        
    
        
                      
if(isset($_POST['miejsca']) && ($_POST[data] < date("Y/M/D"))){





$result=mysqli_query($conn, "INSERT INTO podroze (id, miejsce, czas, data, budzet) 
                             VALUES ('$_SESSION[id]', '$_POST[miejsce]', '$_POST[czas]', '$_POST[data]', '$_POST[budzet]');");

}
        else
        {
            $result=mysqli_query($conn, "INSERT INTO plany (id, miejsce, czas, data, budzet) 
                             VALUES ('$_SESSION[id]', '$_POST[miejsce]', '$_POST[czas]', '$_POST[data]', '$_POST[budzet]');");
            
        }
                    
?>
        
    </div>
    

    
</body>   
    



</html>
