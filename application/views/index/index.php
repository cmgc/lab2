    <div class="container">

      <div class="starter-template">
        <?php if (Session::get('user_logged_in') ) { ?>
        <h1>Добро пожаловать, <?php echo Session::get('user_name'); ?></h1>
        <p class="lead">Вы в системе..</p>
        <?php } else { ?>
        <h1>Добро пожаловать</h1>
        <p class="lead">Пожалуйста войдите</p>
        <?php } ?>
      </div>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="<?php echo URL; ?>public/js/bootstrap.min.js"></script>
