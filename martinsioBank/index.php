<?php session_start();

if (!isset($_SESSION["logged"]))
    header("Location: /");  //Nos envía a la página de inicio.
?>
<html lang="en" >

<head>

  <meta charset="UTF-8">

  <link rel="apple-touch-icon" type="image/png" href="./images/bolsa-de-dinero.png" />
  <meta name="apple-mobile-web-app-title" content="CodePen">

  <link rel="shortcut icon" type="image/x-icon" href="./images/bolsa-de-dinero.ico" />

  <link rel="mask-icon" type="image/x-icon" href="./images/bolsa-de-dinero.svg" color="#111" />


  <title>Banco Martinsio - Checkout </title>
  <meta name="viewport" content="width=device-width">




  <style>
    @import url(./style.css);
    body,html {
      height:100%;
      margin:0;
      font-family:lato;
    }

    h2 {
      margin-bottom:0px;
      margin-top:25px;
      text-align:center;
      font-weight:200;
      font-size:19px;
      font-size:1.2rem;

    }
    .container {
      height:100%;
      -webkit-box-pack:center;
      -webkit-justify-content:center;
      -ms-flex-pack:center;
      justify-content:center;
      -webkit-box-align:center;
      -webkit-align-items:center;
      -ms-flex-align:center;
      align-items:center;
      display:-webkit-box;
      display:-webkit-flex;
      display:-ms-flexbox;
      display:flex;
      background:-webkit-linear-gradient(#c5e5e5, #ccddf9);
      background:linear-gradient(#c9e5e9,#ccddf9);
    }
    .dropdown-select.visible {
      display:block;
    }
    .dropdown {
      position:relative;
    }
    ul {
      margin:0;
      padding:0;
    }
    ul li {
      list-style:none;
      padding-left:10px;
      cursor:pointer;
    }
    ul li:hover {
      background:rgba(255,255,255,0.1);
    }
    .dropdown-select {
      position:absolute;
      background:#77aaee;
      text-align:left;
      box-shadow:0px 3px 5px 0px rgba(0,0,0,0.1);
      border-bottom-right-radius:5px;
      border-bottom-left-radius:5px;
      width:90%;
      left:2px;
      line-height:2em;
      margin-top:2px;
      box-sizing:border-box;
    }
    .thin {
      font-weight:400;
    }
    .small {
      font-size:12px;
      font-size:.8rem;
    }
    .half-input-table {
      border-collapse:collapse;
      width:100%;
    }
    .half-input-table td:first-of-type {
      border-right:10px solid #4488dd;
      width:50%;
    }
    .window {
      height:540px;
      width:800px;
      background:#fff;
      display:-webkit-box;
      display:-webkit-flex;
      display:-ms-flexbox;
      display:flex;
      box-shadow: 0px 15px 50px 10px rgba(0, 0, 0, 0.2);
      border-radius:30px;
      z-index:10;
    }
    .order-info {
      height:100%;
      width:50%;
      padding-left:25px;
      padding-right:25px;
      box-sizing:border-box;
      display:-webkit-box;
      display:-webkit-flex;
      display:-ms-flexbox;
      display:flex;
      -webkit-box-pack:center;
      -webkit-justify-content:center;
      -ms-flex-pack:center;
      justify-content:center;
      position:relative;
    }
    .price {
      bottom:0px;
      position:absolute;
      right:0px;
      color:#4488dd;
    }
    .order-table td:first-of-type {
      width:25%;
    }
    .order-table {
      position:relative;
    }
    .line {
      height:1px;
      width:100%;
      margin-top:10px;
      margin-bottom:10px;
      background:#ddd;
    }
    .order-table td:last-of-type {
      vertical-align:top;
      padding-left:25px;
    }
    .order-info-content {
      table-layout:fixed;

    }

    .full-width {
      width:100%;
    }
    .pay-btn {
      border:none;
      background:#22b877;
      line-height:2em;
      border-radius:10px;
      font-size:19px;
      font-size:1.2rem;
      color:#fff;
      cursor:pointer;
      position:absolute;
      bottom:25px;
      width:calc(100% - 50px);
      -webkit-transition:all .2s ease;
      transition:all .2s ease;
    }
    .pay-btn:hover {
      background:#22a877;
      color:#eee;
      -webkit-transition:all .2s ease;
      transition:all .2s ease;
    }

    .total {
      margin-top:25px;
      font-size:20px;
      font-size:1.3rem;
      position:absolute;
      bottom:30px;
      right:27px;
      left:35px;
    }
    .dense {
      line-height:1.2em;
      font-size:16px;
      font-size:1rem;
    }
    .input-field {
      background:rgba(255,255,255,0.1);
      margin-bottom:10px;
      margin-top:3px;
      line-height:1.5em;
      font-size:20px;
      font-size:1.3rem;
      border:none;
      padding:5px 10px 5px 10px;
      color:#fff;
      box-sizing:border-box;
      width:100%;
      margin-left:auto;
      margin-right:auto;
    }
    .credit-info {
      background:#4488dd;
      height:100%;
      width:50%;
      color:#eee;
      -webkit-box-pack:center;
      -webkit-justify-content:center;
      -ms-flex-pack:center;
      justify-content:center;
      font-size:14px;
      font-size:.9rem;
      display:-webkit-box;
      display:-webkit-flex;
      display:-ms-flexbox;
      display:flex;
      box-sizing:border-box;
      padding-left:25px;
      padding-right:25px;
      border-top-right-radius:30px;
      border-bottom-right-radius:30px;
      position:relative;
    }
    .dropdown-btn {
      background:rgba(255,255,255,0.1);
      width:100%;
      border-radius:5px;
      text-align:center;
      line-height:1.5em;
      cursor:pointer;
      position:relative;
      -webkit-transition:background .2s ease;
      transition:background .2s ease;
    }
    .dropdown-btn:after {
      content: '\25BE';
      right:8px;
      position:absolute;
    }
    .dropdown-btn:hover {
      background:rgba(255,255,255,0.2);
      -webkit-transition:background .2s ease;
      transition:background .2s ease;
    }
    .dropdown-select {
      display:none;
    }
    .credit-card-image {
      display:block;
      max-height:80px;
      margin-left:auto;
      margin-right:auto;
      margin-top:35px;
      margin-bottom:15px;
    }
    .credit-info-content {
      margin-top:25px;
      -webkit-flex-flow:column;
      -ms-flex-flow:column;
      flex-flow:column;
      display:-webkit-box;
      display:-webkit-flex;
      display:-ms-flexbox;
      display:flex;
      width:100%;
    }
    @media (max-width: 600px) {
      .window {
        width: 100%;
        height: 100%;
        display:block;
        border-radius:0px;
      }
      .order-info {
        width:100%;
        height:auto;
        padding-bottom:100px;
        border-radius:0px;
      }
      .credit-info {
        width:100%;
        height:auto;
        padding-bottom:100px;
        border-radius:0px;
      }
      .pay-btn {
        border-radius:0px;
      }
    }
  </style>




  <script>
    if (document.location.search.match(/type=embed/gi)) {
      window.parent.postMessage("resize", "*");
    }
  </script>


</head>

<body translate="no" >
<div class='container'>
  <div class='window'>
    <div class='order-info'>
      <div class='order-info-content'>
        <h2>Datos de la compra</h2>
        <div class='line'></div>
        <table class='order-table'>
          <tbody>
          <tr>
            <td id="text">
              <br><b>Información importante</b><br> <span class='thin small'> Esta no es una pasarela de pago real. Cualquier dato introducido no será almacenado. Los valores por defecto que pueden aparecer son sugerencias, no considerandose real en ningún momento. </span>
              <br><br><b>Se puede procesar el pago sin insertar ningún dato.</b>
            </td>

          </tr>
          </tbody>
        </table>
        <div class='line'></div>
        <div class='total'>
          <span style='float:left;'>
            <div class='thin dense'>Impuestos 0%</div>
            <div class='thin dense'>Envío</div>
            TOTAL
          </span>
          <span style='float:right; text-align:right;'>
            <div class='thin dense'>0.00€</div>
            <div class='thin dense'>0.00€</div>
            <?php echo "<a>{$_SESSION['carro']}€</a>" ?>
          </span>
        </div>
      </div>
    </div>
    <div class='credit-info'>
      <div class='credit-info-content'>
        <table class='half-input-table'>
          <tr><td>Selecciona un operador: </td><td><div class='dropdown' id='card-dropdown'><div class='dropdown-btn' id='current-card'>Visa</div>
            <div class='dropdown-select'>
              <ul>
                <li>Master Card</li>
                <li>American Express</li>
              </ul></div>
          </div>
          </td></tr>
        </table>
        <img src='./images/visa_logo.png' height='80' class='credit-card-image' id='credit-card-image'></img>
        Número de tarjeta
        <input class='input-field'></input>
        Nombre del titular
        <input class='input-field'></input>
        <table class='class='half-input-table'>
          <tr>
            <td> Caducidad
              <input class='input-field'></input>
            </td>
            <td>CVC
              <input class='input-field'></input>
            </td>
          </tr>
        </table>
        <a href="../orderConfirm.php"><button class='pay-btn'>Procesar pago</button></a>

      </div>

    </div>
  </div>
</div>
<script src="./stopExecutionOnTimeout.js"></script>


<script id="rendered-js" >
  var cardDrop = document.getElementById('card-dropdown');
  var activeDropdown;
  cardDrop.addEventListener('click', function () {
    var node;
    for (var i = 0; i < this.childNodes.length - 1; i++) {if (window.CP.shouldStopExecution(0)) break;
      node = this.childNodes[i];}window.CP.exitedLoop(0);
    if (node.className === 'dropdown-select') {
      node.classList.add('visible');
      activeDropdown = node;
    };
  });

  window.onclick = function (e) {
    console.log(e.target.tagName);
    console.log('dropdown');
    console.log(activeDropdown);
    if (e.target.tagName === 'LI' && activeDropdown) {
      if (e.target.innerHTML === 'Master Card') {
        document.getElementById('credit-card-image').src = 'https://dl.dropboxusercontent.com/s/2vbqk5lcpi7hjoc/MasterCard_Logo.svg.png';
        activeDropdown.classList.remove('visible');
        activeDropdown = null;
        e.target.innerHTML = document.getElementById('current-card').innerHTML;
        document.getElementById('current-card').innerHTML = 'Master Card';
      } else
      if (e.target.innerHTML === 'American Express') {
        document.getElementById('credit-card-image').src = 'https://dl.dropboxusercontent.com/s/f5hyn6u05ktql8d/amex-icon-6902.png';
        activeDropdown.classList.remove('visible');
        activeDropdown = null;
        e.target.innerHTML = document.getElementById('current-card').innerHTML;
        document.getElementById('current-card').innerHTML = 'American Express';
      } else
      if (e.target.innerHTML === 'Visa') {
        document.getElementById('credit-card-image').src = 'https://dl.dropboxusercontent.com/s/ubamyu6mzov5c80/visa_logo%20%281%29.png';
        activeDropdown.classList.remove('visible');
        activeDropdown = null;
        e.target.innerHTML = document.getElementById('current-card').innerHTML;
        document.getElementById('current-card').innerHTML = 'Visa';
      }
    } else
    if (e.target.className !== 'dropdown-btn' && activeDropdown) {
      activeDropdown.classList.remove('visible');
      activeDropdown = null;
    }
  };
  //# sourceURL=pen.js
</script>



<script src="./iframeRefresh.js"></script>
</body>

</html>
 