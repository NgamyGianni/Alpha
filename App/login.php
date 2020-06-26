<?php
define('LOGIN','toto');
define('PASSWORD','tata');
$errorMessage = '';
$servername="";
$username="";
$password="";
$dbname="";

try {
    $strConnection = 'mysql:host='.$servername.";dbname=".$dbname; //Ligne 1
    $arrExtraParam= array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"); //Ligne 2
    $pdo = new PDO($strConnection,$username, $password, $arrExtraParam); //Ligne 3; Instancie la connexion
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//Ligne 4
}
catch(PDOException $e) {
    $msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
    die($msg);
}

$query="SELECT username,password FROM table_user WHERE username=:username AND password=:=password";
$prep=$pdo->prepare($query);
$prep->bindValue(':username',$_GET["username"],PDO::PARAM_STR);
$prep->bindValue(':password',$_GET["password"],PDO::PARAM_STR);
$prep->execute();
$result=$prep->setFetchMode(PDO::FETCH_ASSOC);


// Test de l'envoi du formulaire
if(!empty($_GET))
{
    // Les identifiants sont transmis ?
    if(!empty($_GET['username']) && !empty($_GET['password']))
    {
        // Sont-ils les mêmes que les constantes ?
        if(($_GET['username'] !== USERNAME) || ($_GET['username'] !== $result["username"]))
        {
            $errorMessage = 'Mauvais username !';
        }
        elseif(($_GET['password'] !== PASSWORD) || ($_GET['password'] !== $result["password"]))
        {
            $errorMessage = 'Mauvais password !';
        }
        elseif($_GET['username'] !== USERNAME && $_GET['password'] !== PASSWORD)
        {
            // On ouvre la session
            session_start();
            // On enregistre le login en session
            $_SESSION['username'] = USERNAME;
            // On redirige vers la page admin
            header('Location: admin.php');
            exit();
        }
        elseif(!empty($result)){
            session_start();
            // On enregistre le login en session
            $_SESSION['username'] = $result["username"];
            // On redirige vers la page user
            header('Location: user.php');
            exit();
        }
    }
    else
    {
        $errorMessage = 'Veuillez inscrire vos identifiants svp !';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login V6</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
  <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="css/util.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
  
  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100 p-t-85 p-b-20">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="get" class="login100-form validate-form">
          <span class="login100-form-title p-b-70">
            Welcome
          </span>
          <div class="wrap-input100 validate-input m-t-85 m-b-35" data-validate = "Enter username">
            <input class="input100" type="text" name="username">
            <span class="focus-input100" data-placeholder="Username"></span>
          </div>

          <div class="wrap-input100 validate-input m-b-50" data-validate="Enter password">
            <input class="input100" type="password" name="password">
            <span class="focus-input100" data-placeholder="Password"></span>
          </div>

          <div class="container-login100-form-btn">
            <button class="login100-form-btn">
              <a href="home.html">
                Login
              </a>
            </button>
          </div>

          <ul class="login-more p-t-190">
            <li class="m-b-8">
              <span class="txt1">
                Forgot
              </span>

              <a href="#" class="txt2">
                Username / Password?
              </a>
            </li>

            <li>
              <span class="txt1">
                Don’t have an account?
              </span>

              <a href="signup.html" class="txt2"> <!-- href : lien vers page "Sign up" -->
                Sign up
              </a>
            </li>
          </ul>
        </form>
      </div>
    </div>
  </div>
  

  <div id="dropDownSelect1"></div>
  
<!--===============================================================================================-->
  <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
  <script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
  <script src="vendor/bootstrap/js/popper.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
  <script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
  <script src="vendor/daterangepicker/moment.min.js"></script>
  <script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
  <script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
  <script src="js/main.js"></script>

</body>
</html>