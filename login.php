<?php
session_start();

$member_username = $member_password = $crypt_pass = $error = '';

require_once "config.php";

if( isset($_POST['username']) ) {

  $member_username = $_POST['username'];
  $member_password = $_POST['password'];
  // bisogna ricordarsi di criptare la password anche quando viene salvata la password
  $crypt_pass = crypt($member_password,"123stella");

  $sth = $conn->prepare("SELECT * FROM utenti WHERE username = :user AND password = :pass");
  $sth->bindParam(':user', $member_username);
  $sth->bindParam(':pass', $crypt_pass);
  $sth->execute();
  $total = $sth->rowCount();
  $row = $sth->fetch();

  if($total > 0){

    session_name('login');
    $_SESSION["user_username"] = $member_username;
    $_SESSION["livello"] = $row['livello'];
    $_SESSION["user_logedIn"] = true;
    $_SESSION["user_id"] = $row['id'];
    $_SESSION["timeout"] = time();
    header("location: index.php");

    die();

  } else {

    $error = "Username o password errati.";
    // Desetta tutte le variabili di sessione.
    session_unset();
    // Infine , distrugge la sessione.
    session_destroy();

  }
}

require("header.php");
?>


<div class="wrapper">

<?php 
  if (isset($_SESSION["user_logedIn"]) && $_SESSION["user_logedIn"] === true) {
?> <p>LOGGATO</p>
<?php
  // var_dump($row);
 } ?>
 <div class="error"><?php echo $error ?></div>
  <form name='input' action='' method='post'>
    <label for='username'>Username</label><br>
    <input type='text' placeholder='username' id='username' name='username' />
    <br>
    <label for='password'>Password</label><br>
    <input type='password' placeholder='password' id='password' name='password' />
    <input class="button" type='submit' value='Login' name='sub' />
  </form>
</div>
<?php require('footer.php'); ?>