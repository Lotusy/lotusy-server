<?php
$scripts = array('account.js');
$stylesheets = array('account.css');

include 'view/include/header.php';
?>
<script type="text/javascript">var RecaptchaOptions = { theme : 'white' };</script>
<div id="login" class="sector">
<div id="sign_title"><label>Sign in to Confone</label></div>
<?php if(!empty($message)) { ?>
<div id="info" class="round4"><?=$message ?></div>
<?php } ?>
<form action="/login" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
<label class="field_label">Email:</label>
<div class="field_div"><input class="text_field round4" type="text" name="username" value="<?=(isset($email) ? $email : '') ?>" /></div>
<label class="field_label">Password:</label>
<div class="field_div"><input class="text_field round4" type="password" name="password" value="" /></div>
<?php if ($recaptcha) {
    global $recaptcha_public_key;
    echo recaptcha_get_html($recaptcha_public_key, 'Invalid ReCAPTCHA', true);
} ?>
<input type="hidden" name="redirect_uri" value="<?=$redirect_uri ?>" />
<?php if(!empty($error)) { ?>
<div id="error" class="round4"><?=$error ?></div>
<?php } ?>
<input type="checkbox" name="keep_login" id="keep_login" checked/><label for="keep_login" class="keep_login">Keep me logged in</label>
<div class="top20px">
<input class="button round4" type="submit" value="Sign In" />
<label id="or">or</label><a href="/register">Sign up for Confone</a><br>
</div>
<div class="top20px">
<a href="/forget">Forgot Password?</a>
</div>
</form>
</div>
<?php 
include 'view/include/footer.php'
?>