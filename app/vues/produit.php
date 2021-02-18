<?php
  require_once("../connexion.php");
  ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apk</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>

<!-------------------------------------------NavBar---------------------------------------------------------->

    <div id="navbar">
       <a href="">Logo</a>
       <div class="element">
        <a href="../index.php">Accueil</a>
        <a href="categorie.php">Categories</a>
        <a href="produit.php">Produits</a>
       </div>
       
    </div> <br><br><br><br><br><br>

 <!----------------------------------------Modification du produit------------------------------->

    <?php
        if(isset($_GET['action'])){
        if($_GET['action'] == "modifierArticle"){
            $idArticle = $_GET['id'];
            $art = $bd->prepare("SELECT * FROM Article a1 , categories c1 
                                 WHERE a1.categorie = c1.idCateg 
                                 AND a1.idarticle = $idArticle ");
                $art->execute();
                while($donneart = $art->fetch()){  

    ?>
     <form method ="post" enctype= "multipart/form-data" style="border:1px solid #ccc">
            <div class="containForm">
                <p class="textCat">Modification du produit</p>
                <hr>
                <label for="catName"><b> Name</b></label>
                <input type="text" placeholder="Enter name" name="newNom" value ="<?php echo $donneart['nomarticle']; ?>" required> <br>
                <label for="prodquantite"><b>Quant</b></label>
                <input type="number" placeholder="Enter quantity" name="newQte" value ="<?php echo $donneart['qtearticle']; ?>" required> <br>
                <label for="prodprix"><b>Price</b></label>
                <input type="number" placeholder="Enter price" name="newPrix" value ="<?php echo $donneart['prixarticle']; ?>" required> <br>
                <label for="prodprix"><b>Categ</b></label>
                <select name="newCat" id="selectid">
                    <option value="<?php echo $donneart['categorie']; ?>"><?php echo $donneart['nomcateg']; ?></option>
                    <?php
                        $reqselcat = $bd->prepare("SELECT * FROM categories");
                        $reqselcat->execute();
                        while($values = $reqselcat->fetch()){
                    ?>
                        <option value="<?php echo $values['idcateg']; ?>"><?php echo $values['nomcateg']; ?></option>
                    <?php
                        }
                    ?>
                 </select> <br>
                <label for="catfichier"><b>Image</b></label>
                <input type="file" placeholder="Choose File" name="photo" required> <br>
                <p></p>
                <button type="submit" name ="modifier" class="modification">Modifier</button>
            </div> <br><br>
    </form>

    <?php
        }
        if(isset($_POST['modifier'])){
            $nommodify = $_POST['newNom'];
            $qtemodify = $_POST['newQte'];
            $prixmodify = $_POST['newPrix'];
            $catmodify = $_POST['newCat'];
            if (isset($_FILES['photo']) AND $_FILES['photo']['error'] == 0){
                if ($_FILES['photo']['size'] <= 10000000){
                    $infosfichier = pathinfo($_FILES['photo']['name']);
                    $chemin = '../images/ProduitImg/';
                    $extension_upload = $infosfichier['extension'];
                    $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                    if (in_array($extension_upload, $extensions_autorisees)) {
                            move_uploaded_file($_FILES['photo']['tmp_name'], $chemin . basename($nommodify));
                            $image = $chemin.$nommodify;
                            $modifProd = $bd->prepare("UPDATE Article set nomArticle = ?,qteArticle = ?,prixArticle = ?,categorie = ?,imageArticle = ? WHERE idArticle = $idArticle");
                            $modifProd->execute(array(
                            $nommodify,$qtemodify,$prixmodify,$catmodify,$image
                            ));
                            header('location:produit.php');
                            echo '<center><div class="success"><strong>Modification réussie</strong></div></center>'; 
                    }else{
                        echo '<div class="alert alert-warning"><strong>Extention non-autorisee ';
                    }
                }else {
                echo 'image trop grosse';
                }
            }elseif (isset($_FILES['photo']) AND $_FILES['photo']['error'] == UPLOAD_ERR_NO_FILE){
                echo '<strong>fichier inexistant</strong>';
            }            
        }

/***************************************************Suppression****************************************************/

        }elseif($_GET['action'] == "supprimerArticle"){
            $idArticle = $_GET['id'];
            $deleteArt = $bd->prepare("DELETE FROM Article WHERE idArticle = $idArticle");
            $deleteArt->execute();
            header('location:produit.php');
        }

     }

    ?>
    <!-----------------------------------Formulaire d'enrégistrement------------------------------------>
    <div class="categories">
       <h1> <p class = "textCat">Enrégistrer votre produit</p> </h1> <br>
       <form method ="post" enctype= "multipart/form-data" style="border:1px solid #ccc">
            <div class="containForm">
                <p>S'il vous plaît entrer les informations conçernant le produit.</p>
                <hr>
                <label for="catName"><b> Name</b></label>
                <input type="text" placeholder="Enter name" name="prodname" required> <br>
                <label for="prodquantite"><b>Quant</b></label>
                <input type="number" placeholder="Enter quantity" name="prodquantite" required> <br>
                <label for="prodprix"><b>Price</b></label>
                <input type="number" placeholder="Enter price" name="prodprix" required> <br>
                <label for="prodprix"><b>Categ</b></label>
                <select name="categorieOption" id="selectid">
                        <?php
                            $reqselcat = $bd->prepare("SELECT * FROM categories");
                            $reqselcat->execute();
                            while($values = $reqselcat->fetch()){
                        ?>
                            <option value="<?php echo $values['idcateg']; ?>"><?php echo $values['nomcateg']; ?></option>
                        <?php
                            }
                        ?>
                 </select> <br>
                <label for="catfichier"><b>Image</b></label>
                <input type="file" placeholder="Choose File" name="photo" required> <br>

                <p></p>
                <button type="submit" name ="enregbtn" class="enregbtn">Enregistrer</button>
            </div>
    </form>
  </div> <br><br><br><br>
<!-----------------------------------------PHP Enregistrement d'un produit-------------------------------->
    <?php
    
        if(isset($_POST['enregbtn'])){
        $nomProd = htmlspecialchars($_POST["prodname"]);
        $quantProd = htmlspecialchars($_POST["prodquantite"]);
        $prixProd = htmlspecialchars($_POST["prodprix"]);
        $categorieProd = htmlspecialchars($_POST["categorieOption"]);
            if (isset($_FILES['photo']) AND $_FILES['photo']['error'] == 0){
                if ($_FILES['photo']['size'] <= 10000000){
                    $infosfichier = pathinfo($_FILES['photo']['name']);
                    $chemin = '../images/ProduitImg/';
                    $extension_upload = $infosfichier['extension'];
                    $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                    if (in_array($extension_upload, $extensions_autorisees)) {
                            move_uploaded_file($_FILES['photo']['tmp_name'], $chemin . basename($nomProd));
                            $image = $chemin.$nomProd;
                            $insertionProduit = $bd->prepare("INSERT INTO Article(nomArticle,qteArticle,prixArticle,categorie,imageArticle) 
                            VALUES(?,?,?,?,?)");
                            $insertionProduit->execute(array(
                            $nomProd,$quantProd,$prixProd,$categorieProd,$image)
                            ); 
                            echo '<center><div class="success"><strong>Enregistrement réussi</strong></div></center>'; 
                    }else{
                        echo '<div class="alert alert-warning"><strong>Extention non-autorisee 
                        n\'entrez qu\' une image de type jpg</strong></div>';
                    }
                }else {
                echo 'image trop grosse';
                }
            }elseif (isset($_FILES['photo']) AND $_FILES['photo']['error'] == UPLOAD_ERR_NO_FILE){
                echo '<strong>fichier inexistant</strong>';
            }   
        }
    ?>

    <!-------------------------------------------PHP Liste des produits------------------------------------------>
    <hr>
    <h1> <p class = "textCat">Liste des différentes catégories</p> </h1> <br>

        <table>
        <tr>
            <th>Nom</th>
            <th>Quantité</th>
            <th>Prix</th>
            <th>Date</th>
            <th>Catégorie</th>
            <th>Image</th>
        </tr>

    <?php
        $selectArticle = $bd->prepare("SELECT * FROM Article a1 ,categories c1 WHERE a1.categorie = c1.idCateg ");
        $selectArticle->execute();
        while($articles = $selectArticle->fetch()){
    ?>
        <tr>
            <td><?php echo $articles['nomarticle']; ?></td>
            <td><?php echo $articles['qtearticle']; ?></td>
            <td><?php echo $articles['prixarticle']; ?></td>
            <td><?php echo $articles['dateenreg']; ?></td>
            <td><?php echo $articles['nomcateg']; ?></td>
            <td><a href="<?php echo $articles['imagearticle'];?>">image</a></td>
            <td><a href="?action=modifierArticle&amp;id=<?php echo $articles['idarticle']; ?>"><button class="mod">modifier</button></a>
            <a href="?action=supprimerArticle&amp;id=<?php echo $articles['idarticle']; ?>"><button class="sup">supprimer</button></a>
            <a href="detailsArticle.php?&amp;id=<?php echo $articles['idarticle'];?>"><button class="det">details</button></a>
        </td>
        </tr>
    <?php
        }
    ?>
    </table> <br><br><br><br>

</body>
 <!--------------------------------------Footer---------------------------------->
 <footer class="myfoot">
      <div class="footcont">
        <div class="FootElement">
            <a href="#home">Accueil</a>
            <a href="#news">Categories</a>
            <a href="#contact">Produits</a>
            <a href="#contact">Autres</a>
        </div>
        <div class="FootElement">
            <a href="#home">Accueil</a>
            <a href="#news">Categories</a>
            <a href="#contact">Produits</a>
            <a href="#contact">Autres</a>
        </div>
        <div class="FootElement">
            <a href="#home">Accueil</a>
            <a href="#news">Categories</a>
            <a href="#contact">Produits</a>
            <a href="#contact">Autres</a>
        </div>
        <div class="FootElement">
            <a href="#home">Accueil</a>
            <a href="#news">Categories</a>
            <a href="#contact">Produits</a>
            <a href="#contact">Autres</a>
        </div>

        <p class="textCop">
           <h2>Copyright &copy;<script>document.write(new Date().getFullYear());</script> Tout droits réservés | ce site est créé avec <i class="fa fa-heart-o" aria-hidden="true"></i> par <a href="https://colorlib.com" target="_blank">Ferdinand Attivi</a></h2>
        </p>
     </div>
    </footer>
</html>