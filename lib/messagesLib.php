<?php
function samplePop($result, $route, $text)
{
    echo "
      <div class=\"services\" id=\"logServices\">
      <div class=\"container\">
        <div class=\"row\">
          <div class=\"col-md-4\" id=\"logReg\">
            <div class=\"service-item\">
              <div class=\"down-content\">
                <h4>$result</h4>
                <a href=$route class=\"filled-button\">$text</a>    
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>";
}



// -----------  ELEMENTOS USADOS EN LA PORTADA -------------------------------------------------------------------------
//Abre la sección con el número de productos y categoría dados.
function productListOpener($sectionTitle)
{
    echo "
    <div class=\"latest-products\">
      <div class=\"container\">
        <div class=\"row\">
          <div class=\"col-md-12\">
            <div class=\"section-heading\">
              <h2>$sectionTitle</h2>
              <a href=\"products.php\">Ver todos <i class=\"fa fa-angle-right\"></i></a>
            </div>
          </div>";
}


//Cierra la sección (ver método anterior)
Function productListCloser(){
    echo" 
        </div>
    </div>";
}



//Muestra el producto con los datos dados
function productItem($productName, $productPrice, $productDescription, $numOpinions, $id)
{
    echo "<div class=\"col-md-4\">
            <div class=\"product-item\">
              <a href=\"article.php?id={$id}\"><img src=\"assets/images/products/{$id}portada.jpg\" alt=\"\"></a>
                <div class=\"down-content\">
                <a href=\"article.php?id={$id}\"><h4>$productName</h4></a>
                <h6>{$productPrice}€</h6>
                <p>$productDescription</p>
                <ul class=\"stars\">
                  <li><i class=\"fa fa-star\"></i></li>
                  <li><i class=\"fa fa-star\"></i></li>
                  <li><i class=\"fa fa-star\"></i></li>
                  <li><i class=\"fa fa-star\"></i></li>
                  <li><i class=\"fa fa-star\"></i></li>
                </ul>
                <span>Opiniones ($numOpinions)</span>
              </div>
            </div>
          </div>";
}

//Slider que se utiliza en portada
function initialBanner(){
    echo "
    <div class=\"banner header-text\">
      <div class=\"owl-banner owl-carousel\">

        <div class=\"banner-item-01\">
          <div class=\"text-content\">
            <h2>¿Estás preparado para la aventura?</h2>
          </div>
        </div>
        <div class=\"banner-item-02\">
          <div class=\"text-content\">
            <h2>Descubre nuestra sección de nieve</h2>
          </div>
        </div>
        <div class=\"banner-item-03\">
          <div class=\"text-content\">
            <h2>Deslizate como nadie</h2>
          </div>
        </div>
        
      </div>
    </div>";
}

//Módulo que muestra la oferta del día
function specialOffer(){
    echo
    "<div class=\"best-features\">
      <div class=\"container\">
        <div class=\"row\">
          <div class=\"col-md-12\">

          </div>
          <div class=\"col-md-6\">
            <div class=\"left-content\">
              <h4>Oferta del día</h4>
              <p>El cinturón de masaje perfecto para descontracturar tu espalda, cervicales y/o extremidades. Puedes usarlo como cojín o darte un automasaje relajante. </br>Tiene modo calor, tres velocidades y puedes variar la rotación de los 8 cabezales. ¡Disfruta del mejor masaje en casa! ¡Tú solo tienes que disfrutar!</p>
              <ul class=\"featured-list\">
                <li> - Polivalencia</li>
                <li> - Facilidad de uso</li>
                <li> - Aporte de calor</li>
              </ul>
              <a href=\"article.php?id=3\" class=\"filled-button\">Ver producto</a>
            </div>
          </div>
          <div class=\"col-md-6\">
            <div class=\"right-image\">
              <img src=\"assets/images/offer-day.jpg\" alt=\"\">
            </div>
          </div>
        </div>
      </div>
    </div>";
}

//Muestra una ventana con acción. El parametro $param sirve para configurar si el botón debe abrir una nueva pestaña o no
function callToAction($title, $message, $link, $btnMessage, $param){
    echo"
<div class=\"call-to-action\">
      <div class=\"container\">
        <div class=\"row\">
          <div class=\"col-md-12\">
            <div class=\"inner-content\">
              <div class=\"row\">
                <div class=\"col-md-8\">
                  <h4>$title</h4>
                  <p>$message</p>
                </div>
                <div class=\"col-md-4\">
                  <a href=\"$link\" $param class=\"filled-button\">$btnMessage</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>";
}
function sendOption(){
    echo
    "<div class=\"best-features\">
      <div class=\"container\">
      <h2 id='titleProduct'>Método de envío</h2>
        <div class=\"row\">


            <div class=\"left-content\" id='userDataBox'>
              <fieldset> 
                <div>
                  <input type=\"radio\" name=\"drone\" value=\"noSend\" checked>
                  <label>No enviar <span id='sendTextRecomended'>(recomendado)</span></label>
                </div>
            
                <div>
                  <input type=\"radio\" name=\"drone\" value=\"never\">
                  <label>Imaginario -<span id='sendText'> Recíbelo nunca</span></label>
                </div>
            
                <div>
                  <input type=\"radio\" name=\"drone\" value=\"whoKnows\">
                  <label>Aventurero -<span id='sendText'> ¿Lo recibirás?</span></label>
                </div>
            </fieldset>
          </div>

        </div>
      </div>
    </div>";

}