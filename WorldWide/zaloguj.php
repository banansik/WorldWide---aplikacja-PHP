 <?php

session_start();


require_once "connect.php";

$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

if($polaczenie->connect_errno!=0)
{
    echo"Error:";
}
else
{   
    $login = $_POST['login'];
    $haslo = $_POST['haslo'];
    
    $sql = "SELECT * FROM uzytkownicy WHERE login='$login' AND haslo='$haslo'";
    
   if ($rezultat =@$polaczenie->query($sql))
   {
       $ilu_userow = $rezultat->num_rows;
       if($ilu_userow>0)
       {
           $_SESSION['zalogowany'] = true;
           
           $wiersz = $rezultat->fetch_assoc();
           $_SESSION['id']=$wiersz['id'];
           $_SESSION['user'] = $wiersz['login'];
           $_SESSION['podroze'] = $wiersz['podroze'];
           $_SESSION['czas'] = $wiersz['czas'];
           
           
           unset($_SESSION['blad']);           $rezultat->close();
           
            header('Location: glowna.php');
           
       }else{
          $_SESSION['blad'] = '<span style="color:red;font-size:13px;float:initial">Nieprawidłowy login lub hasło!</span>';
				header('Location: index.php');
           
       }
   
   }
    
    $polaczenie->close();
}

 
?>
