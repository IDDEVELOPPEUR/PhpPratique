<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body align="center">
    <form method="POST" action=""> 
        <table cellspacing="5" cellpadding="5" border="1" width="300px" height="200px" align="center" >
            <tr>
              
                <td ><input  type="text" name="login" placeholder="Votre login" required/></td>
            </tr>
            <tr>
                <td><input type="password" name="motPasse" placeholder="Votre mot de passe" required/></td>
               
            <tr>
                <td colspan="2">
                    <input  id="inscrire" type="submit" name="connecter" value="connecter"/>
                </td> 
            </tr>
        </table> 
    </form>
</body>
</html>

<?php 

    if (isset($_GET["msg"])) {

        echo $_GET["msg"];
    }
    if (isset($_POST["connecter"])) {
        extract($_POST);
        require "connection.php";
        $motCrypte=sha1($motPasse);
        $req="select prenom, nom, login, profil from personne p join compte c on p.idPersonne = c.idPersonne where login= '".$login."'and motPasse='".$motCrypte."'";
        $res=mysqli_query($con,$req);
        $nb=mysqli_num_rows($res);
        if($nb == 1)
        {
            
            while($ligne= mysqli_fetch_row($res))
            {

                session_start();
                $_SESSION["prenom"]=$ligne[0];
                $_SESSION["nom"]=$ligne[1];
                $_SESSION["login"]=$ligne[2];
                $_SESSION["profil"]=$ligne[3];
                if ($ligne[3]=="Administrateur") {

                        header("location:admin/espace.php");
                }
                else if($ligne[3]=="Secretaire"){
                    header("location:secretaire/espace.php");
                }
                
                
            }
        }
        else {
            echo "ce compte n'existe pas !";
        }   
       

    }






?>