<?php // $this->renderFeedbackMsg(); ?>

<div class="container">

      <form class="form-signin" role="form" action="<?php echo URL; ?>login/login" method="post">
        <h2 class="form-signin-heading">Please sign in</h2>
        <input type="login" name="user_name" class="form-control" placeholder="Login" required autofocus>
        <input type="password" name="user_password" class="form-control" placeholder="Password" required>
<!--        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label>
        -->
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>

    </div> <!-- /container -->
