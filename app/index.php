<?php
  require_once('connexion.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apk</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>

<!-----------------------------NavBar--------------------------->

    <div id="navbar">
       <a href="">Logo</a>
       <div class="element">
        <a href="index.php">Accueil</a>
        <a href="vues/categorie.php">Categories</a>
        <a href="vues/produit.php">Produits</a>
       </div>
    </div>
    <hr>

<!-------------------------------------Banniere--------------------------------->

    <div class="banniere"></div> 

<!--------------------------Selection des catégories --------------------------->

    <div class="categories">
       <h1> <p class = "textCat">Categories favoris</p> </h1> <br>
       <?php
          $selectCat = $bd->prepare("SELECT * FROM categories WHERE favoris = 1 ORDER BY idCateg DESC limit 4");
          $selectCat->execute();
          while($donne = $selectCat->fetch()){
         ?>
            <div class="card">
                <img src="images/CategorieImg/<?php echo$donne["nomcateg"];?>" alt="Avatar" style="width:100%">
                <div class="container">
                    <h4><b><?php echo$donne["nomcateg"];?></b></h4> 
                </div>
            </div>
        <?php      
          }
        ?>  
    </div> <br><br><br><br>


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

    
</body>
</html>