<?php


// ----------- BÁSICAS PARA TODAS LAS PÄGINAS ----------------------------------------------------------------------//
function head($title)
{
    //Iniciamos la sesión
    session_start();

    echo "<!DOCTYPE html>
            <html lang=\"es\">

              <head>
            
                <meta charset=\"utf-8\">
                <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">
                <meta name=\"description\" content=\"\">
                <meta name=\"author\" content=\"\">
                <link href=\"https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap\" rel=\"stylesheet\">
            
                <title>$title</title>
            
                <!-- Bootstrap core CSS -->
                <link href=\"vendor/bootstrap/css/bootstrap.min.css\" rel=\"stylesheet\">
            <!--
            
                TemplateMo 546 Sixteen Clothing
            
            https://templatemo.com/tm-546-sixteen-clothing
            
            -->
            
                <!-- Additional CSS Files -->
                <link rel=\"stylesheet\" href=\"assets/css/fontawesome.css\">
                <link rel=\"stylesheet\" href=\"assets/css/templatemo-sixteen.css\">
                <link rel=\"stylesheet\" href=\"assets/css/owl.css\">
                <link rel=\"stylesheet\" href=\"assets/css/extended.css\">
            
                <!-- Favicon -->
                <link rel=\shortcut icon\" href=\"assets/images/logos/favicon.png\">
              </head>";
}

function navbar($index, $miCuenta, $productos)
{
    $conn = bdconnect();

    if (isset($_SESSION["logged"])) {
        $result = mysqli_query($conn, "SELECT nombre from clientes WHERE email='{$_SESSION["logged"]}'");
        $log = mysqli_fetch_row($result);
        $nombre = $log[0];
    } else
        $nombre = "Mi cuenta";


    echo " 
    <div id=\"preloader\">
        <div class=\"jumper\">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- Header -->
    <header class=\"\">
      <nav class=\"navbar navbar-expand-lg\">
        <div class=\"container\">
          <a class=\"navbar-brand\" href=\"/\"><img src=\"assets/images/logos/logo.png\"></a>
          <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarResponsive\" aria-controls=\"navbarResponsive\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
<span class=\"navbar-toggler-icon\"></span>
          </button>
          <div class=\"collapse navbar-collapse\" id=\"navbarResponsive\">
            <ul class=\"navbar-nav ml-auto\">
              <li class=\"nav-item $index\">
                <a class=\"nav-link\" href=\"/\">Inicio
                  <span class=\"sr-only\">(current)</span>
                </a>
              </li>
              <li class=\"nav-item $productos\">
                <a class=\"nav-link\" href=\"/products.php\">Nuestros productos</a>
              </li>
              <li class=\"nav-item $miCuenta\">
                <a class=\"nav-link\" href=\"profile.php\">{$nombre}</a>
              </li>";

    if(isset($_SESSION["logged"])){
        //Verificamos que el usuario es administrador
        $sql = "SELECT * FROM `administradores` WHERE id_cliente=(SELECT id FROM clientes WHERE email='{$_SESSION["logged"]}')";
        $result = mysqli_query($conn, $sql);
        $log = mysqli_fetch_row($result);

        if (isset($log[0]))
            echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"admin.php\">Panel</a></li>";
    }



        echo "
            </ul>
          </div>
        </div>
      </nav>
    </header>
    <body>
    ";

    }


    function foother()
    {
        echo '<footer>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="inner-content">
              <p>Un proyecto de Martín Justo Fernández</p>
            </div>
          </div>
        </div>
      </div>
    </footer>


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


    <!-- Additional Scripts -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/owl.js"></script>
    <script src="assets/js/slick.js"></script>
    <script src="assets/js/isotope.js"></script>
    <script src="assets/js/accordions.js"></script>

';

        echo "
            <script language = \"text/Javascript\">
              cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
              function clearField(t){                   //declaring the array outside of the
              if(! cleared[t.id]){                      // function makes it static and global
                  cleared[t.id] = 1;  // you could use true and false, but that's more typing
                  t.value='';         // with more chance of typos
                  t.style.color='#fff';
                  }
        }
        </script>


  </body>";
    }


//Portada página artículos
    function headArticle()
    {
        echo "
<div class=\"page-heading about-heading header-text\" >
    <div class=\"container\">
        <div class=\"row\">
            <div class=\"col-md-12\">
                <div class=\"text-content\">
                    <!--Aquí se puede añadir un texto -->
                </div>
            </div>
        </div>
    </div>
</div>";
    }


//Portada con imágen variable
//Portada página artículos
    function headMulti($param, $text)
    {
        echo "
    <div class=\"page-heading $param header-text\" >
        <div class=\"container\">
            <div class=\"row\">
                <div class=\"col-md-12\">
                    <div class=\"text-content\">
                        <h2>$text</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>";
    }

    function productPage($id, $brand, $article, $description, $price)
    {
        $conn = bdconnect();

        echo "
    <div class=\"best-features about-features\">
        <div class=\"container\">
            <div class=\"row\">
                <div class=\"col-md-6\">
                    <div class=\"right-image\">
                        
                        <!-- Aquí la galería de imágenes-->
                        <div class=\"slider-container\">";

        for ($i = 0; $i < 4; $i++) {
            echo "
            <img
                class=\"slider-item\"
                src=\"/assets/images/products/{$id}_$i.jpg\"
            />
    ";
        }

        $numopiniones = numComments($id, $conn);

        echo "                        
                        </div>  
      
                    </div>
                </div>
                <div class=\"col-md-6\">
                    <div>
                        <h4><br>$article <br><span class='spanArticle'>$brand</span></h4>
    
                        
                        
                        
                        <div><h6>{$price}€</h6></div>
                        
                        <p id='articleDescription'>$description</p>";

        if (!isset($_SESSION["logged"])) {  //No se permite comprar a usuarios no registrados
            echo "<a href='/profile.php'><button id='logButtons'>Debes iniciar sesión para comprar</button></a>";
        } else {
            echo "
            <form method=\"POST\" action=\"additem.php\" class=\"login-form\">
                <input type=\"number\" name='amount' value=\"1\" min='1' class='amountImput' id='amount'>
                <input type=\"number\" name='idBox' value=\"$id\" class='amountImput' id='idBox'>
                <input type=\"submit\" value=\"Añadir a la cesta\" id='logButtons'>
            </form>";
        }


        echo "
                            <br><br>
                        <a href='#comentarios'><span>Opiniones ($numopiniones)</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    ";
        mysqli_close($conn);
    }


// Muestra los comentarios de los clientes
    function commentsOpener()
    {
        echo "
    <div id=\"comentarios\" class=\"happy-clients\">
      <div class=\"container\">
        <div class=\"row\">
          <div class=\"col-md-12\">
            <div class=\"section-heading\">
            </div>
          </div>

    <ul id=\"comments-list\" class=\"comments-list\">";
    }


    function commentsShow($userdata, $text, $datetime)
    {
        $profile = rand(1, 10);

        echo "
        <li>
            <div class=\"comment-main-level\">
                <!-- Avatar -->
                <div class=\"comment-avatar\"><img src=\"/assets/images/profiles/{$profile}.png\" alt=\"\"></div>
                <!-- Contenedor del Comentario -->
                <div class=\"comment-box\">
                    <div class=\"comment-head\">
                        <h6 class=\"comment-name\"><a>$userdata</a></h6>
                        <span>$datetime</span>
                        <i class=\"fa fa-reply\"></i>
                        <i class=\"fa fa-heart\"></i>
                    </div>
                    <div class=\"comment-content\">
                        $text
                    </div>
                </div>
            </div>";
    }

    function commentsCloser()
    {
        echo "         
    </ul>
</div>

        </div>
      </div>
    </div>
";
    }

    function categoriesPageOpener()
    {
        echo "
    <div class=\"products\">
        <div class=\"container\">
            <div class=\"row\">
                <div class=\"col-md-12\">
                    
                    <div class=\"filters\">
                        <ul>";
    }

    function categoriesPageList()
    {
        //Por cada categoría se crea un li con su nombre. Podemos hacer que si recibe por get el id de esa categoría
        //se muestra como active. En caso contrario (no se recibe id) el active es el "all products".


        echo "
                            <li class=\"active\" data-filter=\"*\">All Products</li>
                            <li data-filter=\".des\">Featured</li>
                            <li data-filter=\".dev\">Flash Deals</li>
                            <li data-filter=\".gra\">Last Minute</li>
                        </ul>
                    </div>
                </div>
    ";
    }


    function categoriesPageProducts()
    {
        //Mostramos los productos de la categoría en la que nos encontramos.
        //Deberíamos recibir también la página que se debe mostrar (si no se recibe nada, será la primera)
        echo "
                <div class=\"col-md-12\">
                    <div class=\"filters-content\">
                        <div class=\"row grid\">
                            <div class=\"col-lg-4 col-md-4 all des\">
                                <div class=\"product-item\">
                                    <a href=\"#\"><img src=\"assets/images/product_01.jpg\" alt=\"\"></a>
                                    <div class=\"down-content\">
                                        <a href=\"#\"><h4>Tittle goes here</h4></a>
                                        <h6>$18.25</h6>
                                        <p>Lorem ipsume dolor sit amet, adipisicing elite. Itaque, corporis nulla aspernatur.</p>
                                        <ul class=\"stars\">
                                            <li><i class=\"fa fa-star\"></i></li>
                                            <li><i class=\"fa fa-star\"></i></li>
                                            <li><i class=\"fa fa-star\"></i></li>
                                            <li><i class=\"fa fa-star\"></i></li>
                                            <li><i class=\"fa fa-star\"></i></li>
                                        </ul>
                                        <span>Reviews (12)</span>
                                    </div>
                                </div>
                            </div>
                            <div class=\"col-lg-4 col-md-4 all dev\">
                                <div class=\"product-item\">
                                    <a href=\"#\"><img src=\"assets/images/product_02.jpg\" alt=\"\"></a>
                                    <div class=\"down-content\">
                                        <a href=\"#\"><h4>Tittle goes here</h4></a>
                                        <h6>$16.75</h6>
                                        <p>Lorem ipsume dolor sit amet, adipisicing elite. Itaque, corporis nulla aspernatur.</p>
                                        <ul class=\"stars\">
                                            <li><i class=\"fa fa-star\"></i></li>
                                            <li><i class=\"fa fa-star\"></i></li>
                                            <li><i class=\"fa fa-star\"></i></li>
                                            <li><i class=\"fa fa-star\"></i></li>
                                            <li><i class=\"fa fa-star\"></i></li>
                                        </ul>
                                        <span>Reviews (24)</span>
                                    </div>
                                </div>
                            </div>
                            <div class=\"col-lg-4 col-md-4 all gra\">
                                <div class=\"product-item\">
                                    <a href=\"#\"><img src=\"assets/images/product_03.jpg\" alt=\"\"></a>
                                    <div class=\"down-content\">
                                        <a href=\"#\"><h4>Tittle goes here</h4></a>
                                        <h6>$32.50</h6>
                                        <p>Lorem ipsume dolor sit amet, adipisicing elite. Itaque, corporis nulla aspernatur.</p>
                                        <ul class=\"stars\">
                                            <li><i class=\"fa fa-star\"></i></li>
                                            <li><i class=\"fa fa-star\"></i></li>
                                            <li><i class=\"fa fa-star\"></i></li>
                                            <li><i class=\"fa fa-star\"></i></li>
                                            <li><i class=\"fa fa-star\"></i></li>
                                        </ul>
                                        <span>Reviews (36)</span>
                                    </div>
                                </div>
                            </div>
                            <div class=\"col-lg-4 col-md-4 all gra\">
                                <div class=\"product-item\">
                                    <a href=\"#\"><img src=\"assets/images/product_04.jpg\" alt=\"\"></a>
                                    <div class=\"down-content\">
                                        <a href=\"#\"><h4>Tittle goes here</h4></a>
                                        <h6>$24.60</h6>
                                        <p>Lorem ipsume dolor sit amet, adipisicing elite. Itaque, corporis nulla aspernatur.</p>
                                        <ul class=\"stars\">
                                            <li><i class=\"fa fa-star\"></i></li>
                                            <li><i class=\"fa fa-star\"></i></li>
                                            <li><i class=\"fa fa-star\"></i></li>
                                            <li><i class=\"fa fa-star\"></i></li>
                                            <li><i class=\"fa fa-star\"></i></li>
                                        </ul>
                                        <span>Reviews (48)</span>
                                    </div>
                                </div>
                            </div>
                            <div class=\"col-lg-4 col-md-4 all dev\">
                                <div class=\"product-item\">
                                    <a href=\"#\"><img src=\"assets/images/product_05.jpg\" alt=\"\"></a>
                                    <div class=\"down-content\">
                                        <a href=\"#\"><h4>Tittle goes here</h4></a>
                                        <h6>$18.75</h6>
                                        <p>Lorem ipsume dolor sit amet, adipisicing elite. Itaque, corporis nulla aspernatur.</p>
                                        <ul class=\"stars\">
                                            <li><i class=\"fa fa-star\"></i></li>
                                            <li><i class=\"fa fa-star\"></i></li>
                                            <li><i class=\"fa fa-star\"></i></li>
                                            <li><i class=\"fa fa-star\"></i></li>
                                            <li><i class=\"fa fa-star\"></i></li>
                                        </ul>
                                        <span>Reviews (60)</span>
                                    </div>
                                </div>
                            </div>
                            <div class=\"col-lg-4 col-md-4 all des\">
                                <div class=\"product-item\">
                                    <a href=\"#\"><img src=\"assets/images/product_06.jpg\" alt=\"\"></a>
                                    <div class=\"down-content\">
                                        <a href=\"#\"><h4>Tittle goes here</h4></a>
                                        <h6>$12.50</h6>
                                        <p>Lorem ipsume dolor sit amet, adipisicing elite. Itaque, corporis nulla aspernatur.</p>
                                        <ul class=\"stars\">
                                            <li><i class=\"fa fa-star\"></i></li>
                                            <li><i class=\"fa fa-star\"></i></li>
                                            <li><i class=\"fa fa-star\"></i></li>
                                            <li><i class=\"fa fa-star\"></i></li>
                                            <li><i class=\"fa fa-star\"></i></li>
                                        </ul>
                                        <span>Reviews (72)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=\"col-md-12\">
                    <ul class=\"pages\">
                        <li><a href=\"#\">1</a></li>
                        <li class=\"active\"><a href=\"#\">2</a></li>
                        <li><a href=\"#\">3</a></li>
                        <li><a href=\"#\">4</a></li>
                        <li><a href=\"#\"><i class=\"fa fa-angle-double-right\"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>";
    }

    function productListItem($conn, $button, $title, $sql, $option)
    {
        $aux = false;

        echo
        "<div class=\"best-features\">
      <div class=\"container\">
         <h2 id='titleCart'>$title</h2>
      ";


        if ($result = mysqli_query($conn, $sql)) {
            /* obtener array asociativo */
            while ($row = mysqli_fetch_assoc($result)) {

                //Obtener datos del producto
                $sql2 = "SELECT nombre, marca, precio FROM productos WHERE id={$row["id_producto"]}";

                $result2 = mysqli_query($conn, $sql2);
                $log = mysqli_fetch_row($result2);


                //Mostrar producto:
                echo "        
            <div class=\"row\" id='productRow'>
              <div class=\"col-md-12\">
    
              </div>
              <div class=\"col-md-6\" id='userDataBox'>
                <div class=\"left-content\">
                <h4><a href='/article.php?id={$row["id_producto"]}'>{$log[0]} <br><span class='spanArticle'>{$log[1]}</span></a></h4>
                  <ul class=\"featured-list\" >
                    <li> Cantidad: {$row["cantidad"]}";


                if ($option)
                    echo "<br> Precio ud: {$log[2]}€</li></ul>";
                else {
                    echo "<br> Fecha pedido: <i>{$row["fecha"]}</i>";

                    if (isset($row["estado"]))
                        echo "<br>Estado: <i>{$row["estado"]}</i>";  //Solo muestra el estado si lo tiene

                    echo "</li>";
                };

                //Muestra el botón de eliminar producto solo si es true
                if ($button)
                    echo "<a href=\"/dropItem.php?id={$row["id_producto"]}\" class=\"filled-button\">Eliminar</a>";

                echo "
                </div>
              </div>
              <div class=\"col-md-6\">";


                //La imágen se muestra más pequeña cuando el botón está desactivado
                if ($button) echo "<div class=\"right-image\" id='cartImage'>";
                else echo "<div class=\"right-image\" id='productImage'>";

                echo "
                  <a href='/article.php?id={$row["id_producto"]}'><img src=\"/assets/images/products/{$row["id_producto"]}portada.jpg\" alt=\"\"></a>
                </div>
              </div>
            </div>";

                $aux = true;  //Si hay productos se marca

            }
            if (!$aux) echo "<p id='notFound'> No se han encontrado resultados.</p>";
            /* liberar el conjunto de resultados */
            mysqli_free_result($result);


        }
        echo "
      </div>
    </div>";
    }


    function showUserData($title, $conn, $enableContact, $drop)
    {

        $sql = "SELECT nombre, apellido1, apellido2, direccion, poblacion, cp, pais, email FROM clientes WHERE email='{$_SESSION["logged"]}'";
        $result = mysqli_query($conn, $sql);
        $log = mysqli_fetch_row($result);

        echo
        "<div class=\"best-features\">
      <div class=\"container\">
      <h2 id='titleProduct'>$title</h2>
        <div class=\"row\">
          <div class=\"col-md-12\">

          </div>

            <div class=\"left-content\" id='userDataBox'>
              <ul>
                <li><b>{$log[0]} {$log[1]} {$log[2]}</b></li>
                <li>{$log[3]}</li>
                <li>{$log[4]} - {$log[5]} ({$log[6]})</li>";

        if ($enableContact) echo "<br><li><i>Dirección de correo: <br></i>{$log[7]}</li>";   //Solo muestra el correo si se pide

        echo "
              </ul>
              <a href=\"/modData.php\" class=\"filled-button\">Modificar datos</a>";

        if ($drop) echo "<a> </a><a href=\"/drop.php\" class=\"filled-button\" id='redButton'>Eliminar cuenta</a><br><a href=\"/logout.php\" class=\"filled-button\">Cerrar sesión</a>";

        echo "
          </div>
          <div class=\"col-md-6\">

          </div>
        </div>
      </div>
    </div>";

    }

    function productTotal($title, $message, $link, $btnMessage, $param, $btnActive)
    {
        echo "
<div class=\"call-to-action\">
      <div class=\"container\">
        <div class=\"row\">
          <div class=\"col-md-12\" id='totalPrice'>
            <div class=\"inner-content\">
              <div class=\"row\">
                <div class=\"col-md-8\">
                  <h4>$title</h4>
                  <p>$message</p>
                </div>";

        if ($btnActive)
            echo "      <div class=\"col-md-4\">
                  <a href=\"$link\" $param class=\"filled-button\">$btnMessage</a>
                </div>";

        echo "
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>";
    }

//Botón flotante para ir al carrito
    function cartButton()
    {
        if (isset($_SESSION["logged"]))
            echo "<a class=\"float-nav-2\" href=\"/cart.php\"><img class='cartImg' src=\"/assets/images/cart-icon.png\"></a>";
    }