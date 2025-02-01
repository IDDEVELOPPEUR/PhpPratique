<?php

    $host="localhost";
    $user="root";
    $pass="passer";
    $base="gestionEtudiant";
    $con=mysqli_connect($host,$user,$pass,$base)
    or die("Erreur de connexion".mysqli_connect_errno($con));
    //echo "connexion réussie pour partie connexion !";
 ?>