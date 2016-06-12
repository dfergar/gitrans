
    <body>
        <div class="alert alert-danger errores" <?php if (!$_POST):?>style='display:none;'<?php endif;?>>
            <?php echo validation_errors(); ?>
        </div>
        <div class="container" id="login">

      <form action="" method="POST" class="form-signin">
        <h2 class="form-signin-heading">Login</h2>
        <label for="usuario" class="sr-only">Usuario</label>
        <input type="text" id="usuario" name="Usuario" class="form-control" value="<?=set_value('Usuario')?>" size="50" placeholder="usuario" required autofocus>
        <label for="inputPassword" class="sr-only">Contraseña</label>
        <input type="password" id="inputPassword" name="Password" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Recordarme
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Enviar</button>
      </form>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
        
    </body>
