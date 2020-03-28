<?php
    
    session_start(); 

//rejstracja

if(isset($_POST['login']))
{
   // udana rejstracja
    $rej_ok=true;
    
    //nick
    $nick=$_POST['login'];
    
    //dlugosc nicku
    if((strlen($nick)<3) || (strlen($nick)>15))
    {
        $rej_ok=false;
        $_SESSION['e_nick']="login musi posiadać od 3 do 15 znakow";
    }
    
    //haslo
    $haslo1 = $_POST['haslo1'];
    $haslo2 = $_POST['haslo2'];
    
    //dlugosc hasla
    if((strlen($haslo1)<3) || (strlen($haslo1)>15))
    {
        $rej_ok = false;
        $_SESSION['e_haslo']="hasło musi posiadać od 3 do 15 znakow!";
    }
    //czy hasla sa takie same
    if($haslo1!=$haslo2)
    {
        $rej_ok=false;
         $_SESSION['e_haslo']="podane hasła nie są takie same!";
    }
    
    require_once "connect.php";
        
    //łączenie z bazą
    try
    {
        $polaczenie = new mysqli($host, $db_user, $db_password , $db_name);
        
        //w przypadku błędu wyrzuć błąd
        if($polaczenie->connect_errno!=0)
        {
            throw new Exception(mysqli_connect_errno()); 
        }
        //jeśli połączymy to spradź dane
        else
        {
            //sprawdź czy login nie jest już zajęty
            $rezultat = $polaczenie->query("SELECT id from uzytkownicy WHERE login='$nick'");
            
            if(!$rezultat){ throw new Exception($polaczenie->error);
                          }
            //jeśli w bazie wystepuje taki login wyświetl błąd
            $ile_takich_login = $rezultat->num_rows;
            if($ile_takich_login>0)
            {
                $rej_ok=false;
                $_SESSION['e_nick']="Istnieje już konto o takich danych";
            }
                
            
            //formlarz ok
                if($rej_ok==true)
                {
                    
                    
                    if($polaczenie->query("INSERT INTO uzytkownicy VALUES (NULL, '$nick','$haslo1',0,0)"))
                    {
                        $_SESSION['e_rej']="Konto zostało utworzone. Zaloguj się!";
                    }
                    else
                    {
                       throw new Exception($polaczenie->error);
                                           }
                        
                    
                }
             
            $polaczenie->close();
        }
         
    }
    
    
    //wypisz błąd
    catch(Exception $e)
    {
        echo'Błąd servera!';
    }
        
    
}

//sprawdzam czy zalogowany

if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true)){
    header('Location: glowna.php');
exit();}
    ?>

<!DOCTYPE html>
<html>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <head>
     <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <title> WorldWide - twoje podróże </title>
    </head>
    
    <body>
        <div id="logo">
        
<form action="zaloguj.php"method="post">
             <span style="text-shadow: 3px 3px #fc9330">WorldWide</span>
            <div id="login">


<?php
    if(isset($_SESSION['blad']))    echo $_SESSION['blad'];
    ?>
            <input type="text" name="login" placeholder="Login" required>
        <input type="password" name="haslo" placeholder="Hasło" required>
        <input type="submit" value="Zaloguj">
                
            </div>
 </form>

            </div>
        
        
        <div id="container">
            
            
            
            
            <div id="leftbar">
                <b>WorldWide</b> to portal dla wszystkich kochających podróże! Zgromadź wszytkie swoje wspomnienia w jednym miejscu oraz zaplanuj swoje przyszłe wyprawy.
                
                <img  src="travel.png" alt="Smiley face" height="300mm" width="600mm";>
            </div>
            
            <div id="rightbar">
                <b>Zarejstruj się i zacznij przygodę!</b>
                
                
  <div id="rejstracja">
      <form method="post">
    <p>Wypełnij poniższe pola aby utworzyć konto</p>
    <hr>

    <label for="Login"><b>Login</b></label>
    <input class="rej" type="text" placeholder="podaj login" name="login" required>
      

    <label for="psw"><b>Hasło</b></label>
    <input class="rej" type="password" placeholder="wprowadź hasło" name="haslo1" >

    <label for="psw-repeat"><b>Powtórz hasło</b></label>
    <input class="rej" type="password" placeholder="Powtórz hasło" name="haslo2" >
    <hr>

    
    <button type="submit" class="registerbtn">Zarejstruj!</button>
          
          <?php
			if (isset($_SESSION['e_nick']))
			{
				echo '<div class="error">'.$_SESSION['e_nick'].'</div>';
				unset($_SESSION['e_nick']);
			}
		?>
          
          <?php
			if (isset($_SESSION['e_haslo']))
			{
				echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
				unset($_SESSION['e_haslo']);
			}
		?>
          
          <?php
			if (isset($_SESSION['e_rej']))
			{
				echo '<div class="error">'.$_SESSION['e_rej'].'</div>';
				unset($_SESSION['e_rej']);
			}
		?>
          
          </form>
  </div>


            </div>
                
            
          
    
    
        </div>
    </body>
</html>
