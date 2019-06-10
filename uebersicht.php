<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Rezeptobot - Übersicht</title>


    <!---Font Icon-->
    <link href="css/font-awesome.min.css" rel="stylesheet">

    <!-- CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.min.css" rel="stylesheet">
    <link href="css/select2.min.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="icon" href="favicon.ico" />
    <style>
    img {
    vertical-align: middle;
    border-style: none;
    height: 190px;



    }

    .recipes {
      height:384px;
    }
}
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <script type = "text/javascript" language = "javascript">

  $(document).ready(function(){

    $.ajax({
             type:'GET',
             url:'db/getRecipeOverview.php',
             dataType: "json",
       data: {
             'rezeptId': 1
         },
             success:function(data){

                 var rezeptliste = document.getElementById('rezeptliste');

                 for (var i = 0; i < data.length; i++) {
                   console.log(i);

                   var g = document.createElement('div');
                   g.classList.add("col-lg-4", "col-sm-6");

                   var box = document.createElement('div');
                   box.classList.add("box", "grid", "recipes");

                   var by = document.createElement('div');
                   by.classList.add("by");

                   var i2 = document.createElement("i");
                   i2.classList.add("fa", "fa-user");
                   by.appendChild(i2);

                   var a = document.createElement('a');
                   a.href = "rezeptdetails.php?q=" + data[i].id;
                   var img = document.createElement('img');


                   if (data[i].bildpfad.length > 0) {
                     img.src = data[i].bildpfad;
                     //img.src='images/recipe2.jpg';
                   } else {
                     img.src = 'images/kein-bild-vorhanden.jpg';

                   }




                   a.appendChild(img);
                   box.appendChild(by);
                   box.appendChild(a);

                   var a2 = document.createElement('a');
                   var linkText = document.createTextNode(data[i].titel);
                   a2.appendChild(linkText);
                   a2.href = "rezeptdetails.php?q=" + data[i].id;
                   var h = document.createElement("H2");

                   h.appendChild(a2);
                   box.appendChild(h);

                   /*
                   var tag = document.createElement('div');
                   tag.classList.add("tag");

                   var a3 = document.createElement('a');
                   var linkText2 = document.createTextNode("Milk");
                   a3.appendChild(linkText2);
                   a3.href = "#";
                   tag.appendChild(a3);

                   box.appendChild(tag);
                   */

                   g.appendChild(box);
                   rezeptliste.appendChild(g);

         }
             },
       error: function (request, error) {
         console.log(arguments);
         alert(" Can't do because: " + error);
     },
         });















  });
  </script>
  <body>


    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container-fluid justify-content-center">
            <a class="navbar-brand" href="index.php"><i class="fa fa-cutlery" aria-hidden="true"></i>  Rezeptobot</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="eventkalender.php">Kalender</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="uebersicht.php">Von A - Z</a>
                    </li>
                    <!--
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Demo
              </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="homepage-1.html">Homepage-1</a>
                            <a class="dropdown-item" href="homepage-2.html">Homepage-2</a>
                            <a class="dropdown-item" href="homepage-3.html">Homepage-3</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Recipes
              </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="browse-recipes.html">Browse Recipes</a>
                            <a class="dropdown-item" href="recipe-detail.html">Recipe Detail</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="uebersicht.php" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                von A - Z
              </a>
                    </li>
                  -->
                    <li class="nav-item btn-submit-recipe">
                        <a class="nav-link" href="neuesrezept.php"><i class="fa fa-upload" aria-hidden="true"></i> neues Rezept</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- List Recipes -->
    <div class="list">
      <div class="container">
        <div id="rezeptliste" class="row">
          <div class="col-lg-12">
            <h5><i class="fa fa-cutlery" aria-hidden="true"></i>  von A bis Z</h5>
          </div>
        </div>
      </div>
    </div>



    <!-- Footer -->
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-sm-6">
            <h5>About</h5>
            <p>Nunc at augue gravida est fermentum vulputate.  gravida est fermentum vulputate Pellentesque et ipsum in dui malesuada tempus.</p>
          </div>
          <div class="col-lg-3 col-sm-6">
            <h5>Archive</h5>
            <ul>
              <li><a href="#">June 2018</a></li>
              <li><a href="#">July 2018</a></li>
              <li><a href="#">August 2018</a></li>
              <li><a href="#">September 2018</a></li>
            </ul>
          </div>
          <div class="col-lg-3 col-sm-6">
            <h5>Recipes</h5>
            <ul>
              <li><a href="browse-recipes.html">Browse Recipes</a></li>
              <li><a href="recipe-detail.html">Recipe Detail</a></li>
              <li><a href="submit-recipes.html">Submit Recipe</a></li>
            </ul>
          </div>
          <div class="col-lg-3 col-sm-6">
            <h5>Newsletter</h5>
            <form>
              <div class="form-group">
                <input type="text" class="form-control">
              </div>
              <button type="submit" class="btn">Subscribe</button>
            </form>
          </div>
        </div>
      </div>
    </footer>

    <!-- Copyright -->
    <div class="copyright">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">Made with <i class="fa fa-heart" aria-hidden="true"></i> &#8212; Copyright &copy; 2018 <a href="index.php">Grill -  Recipes & Food Blog Template</a>. All Rights Reserved.  </div>
        </div>
      </div>
    </div>

    <!-- Javascript -->
    <script src="js/plugins/jquery.min.js"></script>
    <script src="js/plugins/popper.min.js"></script>
    <script src="js/plugins/bootstrap.min.js"></script>
    <script src="js/plugins/select2.min.js"></script>
    <script src="js/plugins/jquery-ui.js"></script>

    <script src="js/scripts.js"></script>

  </body>
</html>
