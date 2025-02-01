<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body align="center">
    <h1 id="titre"  >BIENVENUE  !</h1>
    <form method="POST" action=""> 
        
       

            <table cellspacing="15" cellpadding="5" border="1" align="center" >
                <tr>
                    <td><input type="text" name="prenom" placeholder="Votre prénom" required/></td>
                    <td><input type="text" name="nom" placeholder="Votre nom" required/></td>
                </tr>
                <tr>
                    <td><input type="text" name="adresse" placeholder="Votre adresse" required/></td>
                    <td><input type="tel" name="telephone" placeholder="Votre telephone" maxlength="9" required/></td>
                </tr>
                <tr>
                    <td><input type="email" name="email" placeholder="Votre email" required/></td>
                    <td><input type="text" name="login" placeholder="Votre login" required/></td>
                </tr>
                <tr>
                    <td><input type="password" name="motPasse" placeholder="Votre mot de passe" required/></td>
                    <td><input type="password" name="confPasse" placeholder="Confirmer mot de passe" required/></td>
                </tr>
                <tr>
                    <td colspan="2"">
                        <input id="inscrire"  type="submit" name="inscrire" value="Inscription"/>
                    </td> 
                </tr>
            </table> 

      

    </form>
</body>
</html>


<!-- CODES PHP -->

<?php

    if (isset($_POST["inscrire"])) {
        extract($_POST);
        $nbCaractere= strlen($motPasse);
        if ($nbCaractere < 8 || $nbCaractere>12)
        {
            echo "le mot de passe doit être compris entre 8 et 12 caractères !" ; 
            //tester si les deux mots de passe correspondent
        }
        else
            if ($motPasse != $confPasse)
            {
                echo "les deux mots de passe ne sont pas identiques !";
            }
            // si c'est bon on doit re
        else{
            require "connection.php";
            //insertion dans la table personne
            $pers =" insert into personne(prenom, nom, adresse, telephone, email, profil) 
            values('".$prenom."','"
            .$nom."','"
            .$adresse."','".$telephone."',
            '".$email."','Secretaire')";

            $result = mysqli_query($con,$pers);
            if ($result == true)
            {
                $last_id = mysqli_insert_id($con);
                echo "enregistrement effectué !";

                $motCrypte=sha1($motPasse);
                //insertion au niveau de la table compte
                $cmp = "insert into compte(login,motPasse,idPersonne) 
                values('".$login."','".$motCrypte."','".$last_id."')";
                $res = mysqli_query($con,$cmp);
                if ($res == true)
                {
                    header("location:authentification.php?msg=compte bien crée");
                }
                
            }
            
    }
    }
 ?>