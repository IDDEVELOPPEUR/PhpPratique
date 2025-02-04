<?php
// empêcher accès
    session_start();

    if (!isset($_SESSION["login"])){
        header("location:./authentification.php?msg=veillez s'authentifiern!");
    }
    else
    echo "<p align='right' ><em> Bonjour ".ucfirst($_SESSION["prenom"])." ".strtoupper($_SESSION["nom"])."</em></p>";
    // création de liens

    
    echo "<p align='right'>";
    echo "<a href='?action=addCat' style='text-decoration:none'> Ajouter catégorie</a>|";
    echo "<a href='?action=listCat'style='text-decoration:none'> Lister  catégorie</a>|";
    echo "<a href='?action=addProd'style='text-decoration:none'> Ajouter produits </a>|";
    echo "<a href='?action=listProd'style='text-decoration:none'> Ajouter catégorie</a>|";
    echo "<a href='?action=../deconnexion.php'style='text-decoration:none'> Déconnection </a>";
    echo "</p>";


        
    if (isset($_GET["action"])) 
    {
        require "../connection.php";
        $act=$_GET["action"];

        // partie ajout categorie 
        if($act=="addCat")
        {
            ?>
             <form method="POST" action="">
                <table>
                    <tr>
                        <td>
                            <input type="number" name="code" placeholder="Entrer votre code de categorie"  required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <input type="text" name="nom" placeholder="Entrer votre nom de la categorie"  required>
                            
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="ajouterCat" value="Ajouter Catégorie">
                        </td>
                    </tr>
                </table>


             </form>
    <?php

    //récuperation des données du formulaire ajout  catégorie        

    if (isset($_POST["ajouterCat"]))
    {
        extract($_POST);

        $verifiez="select * from categorie where codeCat='".$code."'";
        $rs=mysqli_query($con,$verifiez);
        $nb=mysqli_num_rows($rs);

        if ($nb==1)
        {
            echo "le code catégorie existe déjà !";
        }
        else
        {
            $sql="insert into categorie(codeCat, nomCat) 
            values('".$code."','".$nom."')";

            $res=mysqli_query($con,$sql);
            if ($res===true) {
                echo "le code catégorie '".$code."' et de nom ".$nom." est bien enregistré ";
            }
            else
                echo "Echec d'enregistrement de la catégorie".$code;
        }
    }
    }

        // fin partie ajout categorie
        
        

        // partie lister categorie 
        if($act=="listCat")
        {
        ?>
            <table border="1" align="center" rules="all" width="500px">
                <tr>
                    <!-- ajouter des colonnes entetes -->
                    <th> Code catégorie</th>
                    <th> Nom catégorie</th>
                    <th>Action</th>
                   


                </tr>
                    <!-- Affichage des données au niveau du tableau -->
                <?php 
                    $sql="select * from categorie";
                    $res=mysqli_query($con,$sql);
                    while ($ligne=mysqli_fetch_assoc($res)) {
                        echo "<tr>";
                        // affichage du code et nom de catégorie
                            echo "<td>".$ligne['codeCat']."</td>";
                            echo "<td>".$ligne['nomCat']."</td>";
                            ?>

                            <!-- affichage du  lien modifier -->
                            <td>
                                <a href='?ActionLien=modifier&id=<?php echo $ligne["codeCat"] ;?>'> Modifier</a>
                                <a href='?ActionLien=supprimer&id=<?php echo $ligne["codeCat"] ;?>'> Supprimer</a>
                                </td>

                            <?php

                        echo "</tr>";
                    }
                ?>

            </table>
        <?php
        }
        // fin partie lister categorie
       

        // partie ajout produits 
        if($act=="addProd")
        {
            ?>

<form method="POST" action="">
                <table cellspacing="15" cellpadding="5" border="1" align="center">
                    <tr>
                        <td>
                            <input type="number" name="code" placeholder="Entrer votre numéro de produit"  required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <input type="text" name="nom" placeholder="Entrer le nom de votre produit"  required>
                            
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="ajouterPro" value="Ajouter Produit">
                        </td>
                    </tr>
                </table>


             </form>
             <?php

             
        }
        // fin partie ajout produits

        // partie lister produits 
        if($act=="listProd")
        {
            echo "partie listprod";
        }
        // fin partie lister produits

    }
    if ($act=="../deconnexion.php") {
        header("location:../deconnexion.php");
    }


?>