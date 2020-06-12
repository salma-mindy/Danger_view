<?php
// Initialisation de la section
session_start();
 
// Vérifions si l'utilisateur est déjà connecté, si oui, redirigeons-le vers sa page d'accueil
if(isset($_SESSION["connecter"]) && $_SESSION["connecter"] === true){
    if($_SESSION["role"] === "ROLE_ADMIN"){
        header("location: ./admin/admin_home.php");
    }elseif ($_SESSION["role"] === "ROLE_OPERATEUR"){
        header("location: ./operateurs/operateur_home.php");
    }else{
        header("location: index.php");
    }
    exit;
}
 
// Inclus notre composant d'accès à la base de donnée
require_once "./php/db.php";
 
// Définissez les variables et initialisez avec des valeurs vides pour gerer nos messages d'erreur
$email = $motDePasse = "";
$email_err = $motDePasse_err = "";
 
// Traitement des données du formulaire lors de la soumission du formulaire
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // verifier email
    if(empty(trim($_POST["email"]))){
        $email_err = "Veillez renseigner votre adresse email.";
    }else{
        $email = trim($_POST["email"]);
    }
    // verifer mot de passe 
    if(empty(trim($_POST["motDePasse"]))){
        $motDePasse_err = "Veillez renseigner votre mot de passe.";
    } else{
        $motDePasse = trim($_POST["motDePasse"]);
    }
    
    // Valider les informations d'identification
    if(empty($email_err) && empty($motDePasse_err)){
        $sql = "SELECT utilisateurs.id, utilisateurs.prenom, utilisateurs.email, utilisateurs.motDePasse, roles.intituleRole FROM utilisateurs LEFT JOIN roles ON roles.id=utilisateurs.idRole WHERE utilisateurs.email = :email";
        
        if($stmt = $db->prepare($sql)){
            // Liaison des variables à l'instruction préparée en tant que paramètres
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $param_email = trim($_POST["email"]);
            // Tentative d'exécution de l'instruction préparée
            if($stmt->execute()){
                // Vérifiez si l'email existe, si oui, vérifiez le mot de passe
                if($stmt->rowCount() == 1){
                    if($result = $stmt->fetch()){
                        $id = $result["id"];
                        $email = $result["email"];
                        $prenom = $result["prenom"];
                        $password = $result["motDePasse"];
                        $role = $result["intituleRole"];
                        //var_dump($role);exit();
                        if(password_verify(trim($_POST['motDePasse']), $password)){
                            
                            session_start();
                            
                            // Stockage des données dans des variables de session
                            $_SESSION["connecter"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $email;
                            $_SESSION["prenom"] = $prenom;
                            $_SESSION["role"] = $role;

                            if($_SESSION["role"] === "ROLE_ADMIN"){
                                header("location: ./admin/admin_home.php");
                            }elseif ($_SESSION["role"] === "ROLE_OPERATEUR"){
                                header("location: ./operateurs/operateur_home.php");
                            }else{
                                header("location: index.php");
                            }

                        } else{
                            $motDePasse_err = "Le mot de passe que vous avez entré n'est pas valide.";
                        }
                    }
                } else{
                    $email_err = "Aucun compte n'a été trouvé avec cet e-mail.";
                }
            } else{
                echo "Oops! Quelque chose a mal tourné. Veuillez réessayer.";
            }
            unset($stmt);
        }
    }
    // Fermer la connexion à la base de donnée
    unset($db);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once './include/head.php' ?>
    <link rel="icon" type="image/png" href="./img/logo1.png" />
</head>

<body class="mon-formulaire">
<!-- le $_SERVER["PHP_SELF"] envoie les données de formulaire soumises à la page elle-même, au lieu de sauter à une page différente. De cette façon, l’utilisateur recevra des messages d’erreur sur la même page que le formulaire. -->
    <form method="post" class="form-admin rounded shadow shadow-sm py-5 p-4 justify-content-center" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="text-center mb-4">
            <h1 class="h3 mb-3 font-weight-normal" style="color: #fff">
                Identifiez-Vous
            </h1>
            <div class="align-items-center" style="color: #fff">
               <p>Veuillez saisir vos identifiants pour vous connecter</p>
            </div>
        </div>
        <div class="form-label-group">
            <input type="email" id="email" name="email" class="form-control">
            <label for="email">Adresse Email</label>
            <small style="color: #ff1300 !important">
                <span class="align-items-center text-center"><i><?php echo $email_err; ?></i></span>
            </small>
        </div>
        <div class="form-label-group">
            <input type="password" id="motDePasse" name="motDePasse" class="form-control">
            <label for="motDePasse">Mot de passe</label>
            <small style="color: #ff1300 !important">
                <span class="align-items-center text-center"><i><?php echo $motDePasse_err; ?></i></span>
            </small>
        </div>
        <input class="btn btn-lg btn-block" type="submit" name="btn_login" value="S'IDENTIFIER">
            <div class="text-center mb-4 mt-2">
              <small>Vous avez oublier votre mot de passe ? Cliquez <a href="#"> ici</a></small>
            </div> 
    </form>

    <?php require_once './include/bootstrap-script.php' ?>
</body>

</html>