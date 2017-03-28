<?php require_once("logica-usuario.php"); ?>

<html>
<head>
  <meta charset="UTF-8">
  <title>Login | Call Analyzer</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Open+Sans'>
  <link rel="stylesheet" href="build/css/login.css">
</head>

<body>
  <?php if(usuarioEstaLogado()) {?>
  <?php echo "<script>location.href='dashboard.php';</script>"; ?>
  <?php } else {?>
  <div class="cont">
    <div class="demo">
      <div class="login">
        <div class="login__check"></div>
        <div class="login__form">
          <form action="login.php" method="post">
          <div class="login__row">
            <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
              <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
            </svg>
            <input type="text" class="login__input name" name="email" placeholder="E-mail"/>
          </div>
          <div class="login__row">
            <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
              <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
            </svg>
            <input type="password" class="login__input pass" name="senha" placeholder="Senha"/>
          </div>
          <button class="login__submit">Entrar</button>
          <p class="login__signup">Não tem uma conta? &nbsp;<a>Solicite a sua</a></p>
        </form>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>

  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src="build/js/login.js"></script>

</body>
</html>
