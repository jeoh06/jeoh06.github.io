<form action="index.php" method="post" id='signInForm'>
    <h2>Sign In:</h2>
    <br>
    <!-- calling rememberMe feature function -->
    <input type="email" name="email" class="field" value="<?=!empty($_COOKIE['email']) ? $_COOKIE['email'] : ''?>" id="emailIn" placeholder="Email"> <br><br>
    <input type="password" name="password" id="passwordIn" class="field" placeholder="Password"> <br><br>
    <!-- <a href="#">Forgot your password?</a> <br><br> -->
    
    <div>
        <label for="rememberMe" class="switch">
            <div id="remember">Remember Me</div>
            <input type="checkbox" name="rememberMe" id="rememberMe">
            <span class="slider"></span>
        </label>
    </div>
    
    <button class="button primaryBtn primaryColor" type="submit">Sign In</button>
    <input type="hidden" name="action" value="signIn">
    <span class="errorText">Please try again</span>    
</form>
<?php include("view/googleLoginButton.php")?>
<button id="registerNow" class="primaryBtn primaryFill offsetColor">Register</button>

<script src="public/js/signInCheck.js"></script>


