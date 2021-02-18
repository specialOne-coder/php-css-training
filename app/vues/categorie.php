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

    <!--------------------------------------------------NavBar------------------------------------------------------->

        <div id="navbar">
        <a href="">Logo</a>
        <div class="element">
            <a href="../index.php">Accueil</a>
            <a href="categorie.php">Categories</a>
            <a href="produit.php">Produits</a>
        </div>
        </div> <br><br><br><br><br><br>


    <!----------------------------------------Modification de la categorie------------------------------->
        <?php
            if(isset($_GET['action'])){
            if($_GET['action'] == "modifierCategorie"){
                $idcategorie = $_GET['id'];
                $cate = $bd->prepare("SELECT * FROM categories WHERE idcateg = $idcategorie ");
                        $cate->execute();
                        while($donnecat = $cate->fetch()){  
                            if($donnecat['favoris'] == 1){
                                $ynfavoris = 'checked="checked"';
                            }else{
                                $ynfavoris = "";
                            }
        ?>
        <form method ="post" enctype= "multipart/form-data" style="border:1px solid #ccc">
                <div class="containForm">
                    <p class="textCat">Modification de la catégorie</p>
                    <hr>
                    <label for="catName"><b> Name</b></label>
                    <input type="text" placeholder="Enter name" name="catmodify" value ="<?php echo $donnecat['nomcateg']; ?>" required> <br>
                    <label for="catfichier"><b>Image</b></label>
                    <input type="file" placeholder="Choose File" name="photo" required> <br>
                    <label>
                    <input type="checkbox" <?php echo $ynfavoris;?> name="favormodify" style="margin-bottom:15px"> Favoris ?
                    </label>
                    <p></p>
                    <button type="submit" name ="modifier" class="modification">Modifier</button>
                </div> <br><br>
        </form>

    <?php
        }
        if(isset($_POST['modifier'])){
            $nommodify = $_POST['catmodify'];
            $favorismodify = isset($_POST["favormodify"]) ? 1 : 0;
            if (isset($_FILES['photo']) AND $_FILES['photo']['error'] == 0){
                if ($_FILES['photo']['size'] <= 10000000){
                    $infosfichier = pathinfo($_FILES['photo']['name']);
                    $chemin = '../images/CategorieImg/';
                    $extension_upload = $infosfichier['extension'];
                    $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                    if (in_array($extension_upload, $extensions_autorisees)) {
                            move_uploaded_file($_FILES['photo']['tmp_name'], $chemin . basename($nommodify));
                            $image = $chemin.$nommodify;
                            $modifcategorie = $bd->prepare("UPDATE categories set nomCateg = ?,favoris = ?,image = ? WHERE idCateg = $idcategorie");
                            $modifcategorie->execute(array(
                            $nommodify,$favorismodify,$image
                            ));
                            header('location:categorie.php');
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
        
    /**********************************************************Suppression**************************************************************/


        }elseif($_GET['action'] == "supprimerCategorie"){
            $idcategorie = $_GET['id'];
            $deletecat = $bd->prepare("DELETE FROM categories WHERE idCateg = $idcategorie");
            $deletecat->execute();
            header('location:categorie.php');
        }

        }

    ?>


    <!-------------------------------------------------------Formulaire d'enregistrement-------------------------------------------------->

        <div class="categories">
        <h1> <p class = "textCat">Créer votre propre catégorie</p> </h1> <br>
        <form method ="post" enctype= "multipart/form-data" style="border:1px solid #ccc">
                <div class="containForm">
                    <p>S'il vous plaît entrer les informations conçernant la catégorie.</p>
                    <hr>
                    <label for="catName"><b> Name</b></label>
                    <input type="text" placeholder="Enter name" name="catname" required> <br>
                    <label for="catfichier"><b>Image</b></label>
                    <input type="file" placeholder="Choose File" name="photo" required> <br>
                    <label>
                    <input type="checkbox"  name="favor" style="margin-bottom:15px"> Favoris ?
                    </label>
                    <p></p>
                    <button type="submit" name ="enregbtn" class="enregbtn">Enregistrer</button>
                </div>
        </form>
    </div> <br><br><br><br>

    <!------------------------------------Php Enregistrement d'une catégorie-------------------------------->

    <?php
    
        if(isset($_POST['enregbtn'])){
        $nomCat = htmlspecialchars($_POST["catname"]);
            $favoris = isset($_POST["favor"]) ? 1 : 0;
            if (isset($_FILES['photo']) AND $_FILES['photo']['error'] == 0){
                if ($_FILES['photo']['size'] <= 10000000){
                    $infosfichier = pathinfo($_FILES['photo']['name']);
                    $chemin = '../images/CategorieImg/';
                    $extension_upload = $infosfichier['extension'];
                    $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                    if (in_array($extension_upload, $extensions_autorisees)) {
                            move_uploaded_file($_FILES['photo']['tmp_name'], $chemin . basename($nomCat));
                            $image = $chemin.$nomCat;
                            $insertionCategorie = $bd->prepare("INSERT INTO categories(nomCateg,favoris,image) 
                            VALUES(?,?,?)");
                            $insertionCategorie->execute(array(
                            $nomCat,$favoris,$image)
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

    <!--------------------------------------------PHP Liste des catégories---------------------------------------------------->

    <hr>
    <h1> <p class = "textCat">Liste des différentes catégories</p> </h1> <br>

        <table>
        <tr>
            <th>Nom</th>
            <th>Favoris</th>
            <th>Date</th>
            <th>Image</th>
        </tr>

    <?php
        $selectCategorie = $bd->prepare("SELECT * FROM categories");
        $selectCategorie->execute();
        while($categories = $selectCategorie->fetch()){
            if($categories['favoris'] == 1){
                $ynfavoris = "Oui";
            }else{
                $ynfavoris = "Non";
            }
    ?>
        <tr>
            <td><?php echo $categories['nomcateg']; ?></td>
            <td><?php echo $ynfavoris; ?></td>
            <td><?php echo $categories['dateenreg']; ?></td>
            <td><a href="<?php echo $categories['image'];?>">image</a></td>
            <td><a href="?action=modifierCategorie&amp;id=<?php echo $categories['idcateg']; ?>"><button class="mod">modifier</button></a>
            <a href="?action=supprimerCategorie&amp;id=<?php echo $categories['idcateg']; ?>"><button class="sup">supprimer</button></a>
            <a href="detailsCategorie.php?&amp;id=<?php echo $categories['idcateg'];?>"><button class="det">details</button></a>
        </td>
        </tr>
        
    <?php
        }
    ?>
    </table> <br><br><br><br>



</body>

 <!--------------------------------------Footer---------------------------------->

 <footer class="myfoot" id="redirect">
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
           <h2>Copyright &copy;<script>document.write(new Date().getFullYear());</script> Tout droits réservés | ce site est créé  par <a href="https://www.linkedin.com/in/ferdinand-attivi-669b471a9/" target="_blank">Ferdinand Attivi</a></h2>
        </p>
     </div>
    </footer>
</html>