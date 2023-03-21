<link rel="stylesheet" href="<?php echo base_url('assets/css/login/login.css');?>">
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon --><br>
    <div class="fadeIn first">
      <img src="<?php echo base_url();?>assets/icons/sbp.png" style="height:50px">
    </div><br>

    <!-- Login Form -->
    <form method="post" action="<?php echo base_url();?>Home/login_validation">
      <input type="text" id="login" class="fadeIn second" name="username" placeholder="login">
      <span class="text-danger"><?php echo form_error('username');?></span>
      <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
      <span class="text-danger"><?php echo form_error('password');?></span>
      <input type="submit" name="submit" class="fadeIn fourth" value="Log In"><br>
      <span class="text-danger"><?php echo $this->session->flashdata("error");?></span>
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="#">Forgot Password?</a>
    </div>

  </div>
</div>