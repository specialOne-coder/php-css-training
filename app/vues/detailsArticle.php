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
    <h1> <p class = "textCat">Details de l'article</p> </h1> <br>

 <!----------------------------Selection des informations de l'article envoyé---------------->   
    <?php
        $idArticle = $_GET['id'];
        $select = $bd->prepare("SELECT * FROM Article a1 , categories c1 
                                WHERE a1.categorie = c1.idCateg 
                                AND a1.idarticle = $idArticle");
        $select->execute();
        while($donnes = $select->fetch()){ 
    ?>
    <center>
         <div class="cardDetails">
                <img src="../images/ProduitImg/<?php echo$donnes["nomarticle"];?>" alt="Avatar" style="width:100%">
                <div class="container">
                <h1> <p class = "textDet">Nom de l'article :</p> </h1> 
                    <h4><b><?php echo$donnes["nomarticle"];?></b></h4>
                    <h1> <p class = "textDet">Quantité disponible :</p> </h1> 
                    <h4><b><?php echo$donnes["qtearticle"];?></b></h4>
                    <h1> <p class = "textDet">Prix </p> </h1> 
                    <h4><b><?php echo$donnes["prixarticle"];?> FCFA</b></h4>
                    <h1> <p class = "textDet">Date d'enregistrement:</p> </h1> 
                    <h4><b><?php echo$donnes["dateenreg"];?></b></h4>
                    <h1> <p class = "textDet">Catégorie </p> </h1> 
                    <h4><b><?php echo$donnes["nomcateg"];?></b></h4>
                </div>
       </div> 
    </center> <br><br><br><br><br><br>

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