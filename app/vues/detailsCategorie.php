<?php
  require_once("../connexion.php");
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

<!-----------------------------NavBar--------------------------->
    <div id="navbar">
       <a href="">Logo</a>
       <div class="element">
        <a href="../index.php">Accueil</a>
        <a href="categorie.php">Categories</a>
        <a href="produit.php">Produits</a>
       </div>
    </div> <br><br><br><br><br><br>
    <h1> <p class = "textCat">Details de la catégorie</p> </h1> <br>
    
 <!----------------------------Selection des informations de la categorie envoyée----------------> 
    <?php
        $idCateg = $_GET['id'];
        $select = $bd->prepare("SELECT * FROM categories WHERE idCateg = $idCateg");
        $select->execute();
        while($donnes = $select->fetch()){
            if($donnes['favoris'] == 1){
                $ynfavoris = "OUI";
            }else{
                $ynfavoris = "NON";
            }
    ?>
     <center> <div class="cardDetails">
                <img src="../images/CategorieImg/<?php echo$donnes["nomcateg"];?>" alt="Avatar" style="width:100%">
                <div class="container">
                <h1> <p class = "textDet">Nom de la categorie :</p> </h1> 
                    <h4><b><?php echo$donnes["nomcateg"];?></b></h4>
                    <h1> <p class = "textDet">Date d'enregistrement:</p> </h1> 
                    <h4><b><?php echo$donnes["dateenreg"];?></b></h4>
                    <h1> <p class = "textDet">Favoris :</p> </h1> 
                    <h4><b><?php echo $ynfavoris?></b></h4>
                </div>
     </div> </center>  <br><br><br><br><br><br>

    <?php
        }

    ?>

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
</body>
</html>