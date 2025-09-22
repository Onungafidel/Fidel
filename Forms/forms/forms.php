<?php
class forms{

    private function submit_button($name, $text){
        print "<button type='submit' class='btn btn-primary' name='$name' >$text</button>";
    }

    public function signup($conf, $ObjFncs){
      $err = $ObjFncs->getMsg('errors'); print $ObjFncs->getMsg('msg');
        ?>
        <h2>Sign Up Form</h2>
<form action="" method="post" autocomplete="off">
  <div class="mb-3">
    <label for="fullname" class="form-label">Fullname</label>
    <input type="text" class="form-control" id="fullname" aria-describedby="fullnameHelp" name="fullname" maxlength="50" placeholder="Enter your fullname" value="<?php echo isset($_SESSION['fullname']) ? $_SESSION['fullname'] : ''; ?>" required>
    <?php if(isset($err['nameFormat_error'])): ?><div class="form-text text-danger"><?php echo $err['nameFormat_error']; ?></div><?php endif; ?>
    <?php if(isset($err['empty_fields'])): ?><div class="form-text text-danger"><?php echo $err['empty_fields']; ?></div><?php endif; ?>
    <div id="fullnameHelp" class="form-text"></div>
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" placeholder="Enter your email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>" required>
    <?php if(isset($err['emailFormat_error'])): ?><div class="form-text text-danger"><?php echo $err['emailFormat_error']; ?></div><?php endif; ?>
    <?php if(isset($err['emailDomain_error'])): ?><div class="form-text text-danger"><?php echo $err['emailDomain_error']; ?></div><?php endif; ?>
    <div id="emailHelp" class="form-text"></div>
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" value="<?php echo isset($_SESSION['password']) ? $_SESSION['password'] : ''; ?>" required>
    <?php if(isset($err['passwordLength_error'])): ?><div class="form-text text-danger"><?php echo $err['passwordLength_error']; ?></div><?php endif; ?>
    <div id="passwordHelp" class="form-text"></div>
  </div>
    <?php $this->submit_button('signup', 'Sign Up'); ?> <a>Already a member? <a href='signin.php'>Sign In here</a></a>
</form>
        <?php
    }

    public function signin($conf, $ObjFncs){
        ?>
        <h2>Sign In Form</h2>
<form>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text"></div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1">
  </div>
    <?php $this->submit_button('signin', 'Sign In'); ?> Don't have an account? <a href='signup.php'>Sign Up here</a>
</form>
        <?php
    }
}