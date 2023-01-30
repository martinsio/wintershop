<?php
function adminListItem($conn)
{
    $aux = false;

    echo
    "<div class=\"best-features\">
      <div class=\"container\">
         <h2 id='titleCart'>Pedidos realizados</h2>
      ";


    $sql = "SELECT * FROM pedidos ORDER BY fecha DESC";

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
                    <li> Cantidad: {$row["cantidad"]}
                    <br> Fecha pedido: <i>{$row["fecha"]}</i>
                    <br>Estado: <i>{$row["estado"]}</i> 
                    </li>
                    <br><a href='/admin.php?userData={$row["id_cliente"]}'><button id='logButtons'>Mostrar usuario</button></a><a>  </a>";

            if($row["estado"]=="Enviado")
                echo"<a href='/admin.php?sent={$row["id"]}'><button id='logButtons'>Marcar como no enviado</button></a>";
            else
                echo"<a href='/admin.php?sent={$row["id"]}'><button id='logButtons'>Marcar como enviado</button></a>";

            echo "
                </div>
              </div>
              <div class=\"col-md-6\">";


            //Ajusta el tamaño de la imagen
            echo "<div class=\"right-image\" id='cartImage'>";


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



function adminShowUserData($conn, $id_cliente)
{

    $sql = "SELECT nombre, apellido1, apellido2, direccion, poblacion, cp, pais, email FROM clientes WHERE id=$id_cliente";
    $result = mysqli_query($conn, $sql);
    $log = mysqli_fetch_row($result);

    echo
    "<div class=\"best-features\">
      <div class=\"container\">
      <h2 id='titleProduct'>Datos del usuario</h2>
        <div class=\"row\">
          <div class=\"col-md-12\">
          </div>
            <div class=\"left-content\" id='userDataBox'>
              <ul>
                <li><b>{$log[0]} {$log[1]} {$log[2]}</b></li>
                <li>{$log[3]}</li>
                <li>{$log[4]} - {$log[5]} ({$log[6]})</li>
                <br><li><i>Dirección de correo: <br></i>{$log[7]}</li>
              </ul>
              <br><a href='/admin.php'><button id='logButtons'>Volver</button></a>
              </div>
          <div class=\"col-md-6\">
          </div>
        </div>
      </div>
    </div>";

}


function adminNavbar($pedidos, $miCuenta, $productos)
{

    if (isset($_SESSION["logged"])) {
        $conn = bdconnect();
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
              <li class=\"nav-item $pedidos\">
                <a class=\"nav-link\" href=\"/admin.php\">Pedidos
                  <span class=\"sr-only\">(current)</span>
                </a>
              </li>
              <li class=\"nav-item $productos\">
                <a class=\"nav-link\" href=\"/productManager.php\">Gestión</a>
              </li>
              <li class=\"nav-item $miCuenta\">
                <a class=\"nav-link\" href=\"profile.php\">{$nombre}</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
    <body>
    ";

}

function adminListProducts($conn)
{
    $aux = false;

    echo
    "<div class=\"best-features\">
      <div class=\"container\">
         <h2 id='titleCart'>Productos</h2>
      ";

    $sql = "SELECT * FROM productos";



    if ($result = mysqli_query($conn, $sql)) {
        /* obtener array asociativo */
        while ($row = mysqli_fetch_assoc($result)) {


            //Mostrar producto:
            echo "        
            <div class=\"row\" id='productRow'>
              <div class=\"col-md-12\">
    
              </div>
              <div class=\"col-md-6\" id='userDataBox'>
                <div class=\"left-content\">
                <h4><a href='/article.php?id={$row["id"]}'>{$row["nombre"]} <br><span class='spanArticle'>{$row["marca"]}</span></a></h4>
                  <ul class=\"featured-list\" >";

            //Miramos si el producto está disponible
            if($row["disabled"]==0)  //Está disponible
                echo "<li>Estado: <i>Disponible</i></li></ul><br><a href='/productManager.php?drop={$row["id"]}'><button id='logButtons'>Marcar no disponible</button>";
            else
                echo "<li>Estado: <i>No disponible</i></li></ul><br><a href='/productManager.php?undrop={$row["id"]}'><button id='logButtons'>Marcar disponible</button>";


            echo "
                </div>
              </div>
              <div class=\"col-md-6\">";


            //Ajusta el tamaño de la imagen
            echo "<div class=\"right-image\" id='cartImage'>";


            echo "
                  <a href='/article.php?id={$row["id"]}'><img src=\"/assets/images/products/{$row["id"]}portada.jpg\" alt=\"\"></a>
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

function adminListCategories($conn)
{
$aux = false;

    echo
    "<div class=\"best-features\">
      <div class=\"container\">
         <h2 id='titleCart'>Categorías</h2>
      ";

    $sql = "SELECT * FROM categorias";



    if ($result = mysqli_query($conn, $sql)) {
        /* obtener array asociativo */
        while ($row = mysqli_fetch_assoc($result)) {


            //Mostrar producto:
            echo "        
            <div class=\"row\" id='productRow'>
              <div class=\"col-md-12\">
    
              </div>
              <div class=\"col-md-6\" id='userDataBox'>
                <div class=\"left-content\">
                <h4><a>{$row["nombre"]}</a></h4>
                  <ul class=\"featured-list\" >";

            //Miramos si la categoría está disponible
            if($row["disabled"]==0)  //Está disponible
                echo "<li>Estado: <i>Disponible</i></li></ul><br><a href='/productManager.php?dropCat={$row["id"]}'><button id='logButtons'>Marcar no disponible</button>";
            else
                echo "<li>Estado: <i>No disponible</i></li></ul><br><a href='/productManager.php?undropCat={$row["id"]}'><button id='logButtons'>Marcar disponible</button>";


            echo "
                </div>
              </div>
              <div class=\"col-md-6\">";


            //Ajusta el tamaño de la imagen
            echo "<div class=\"right-image\" id='cartImage'>";


            echo "
                  <a></a>
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