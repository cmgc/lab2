 	    <div class="container">
<div class="well">
      <form id="signup" class="form-horizontal" method="post" action="<?php echo URL . 'login/register_action'; ?>">
		<legend>Sign Up</legend>
		<div class="control-group">
	        <label class="control-label">Login</label>
			<div class="controls">
			    <div class="input-prepend">
				<span class="add-on"><i class="icon-user"></i></span>
					<input type="text" class="input-xlarge" id="fname" name="user_name" placeholder="Login, max length 45">
				</div>
			</div>
	
		</div>
		<div class="control-group">
	        <label class="control-label">Password</label>
			<div class="controls">
			    <div class="input-prepend">
				<span class="add-on"><i class="icon-lock"></i></span>
					<input type="Password" id="passwd" class="input-xlarge" name="user_password_new" placeholder="Password. Min 6 simbols">
				</div>
			</div>
		</div>
		<div class="control-group">
	        <label class="control-label">Confirm Password</label>
			<div class="controls">
			    <div class="input-prepend">
				<span class="add-on"><i class="icon-lock"></i></span>
					<input type="Password" id="conpasswd" class="input-xlarge" name="user_password_repeat" placeholder="Re-enter Password">
				</div>
			</div>
		</div>

		<div class="control-group">
		<label class="control-label"></label>
	      <div class="controls">
	       <button type="submit" class="btn btn-success" >Create My Account</button>

	      </div>

	</div>

	  </form>

   </div>
</div>
