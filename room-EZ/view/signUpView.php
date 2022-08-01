<div class="create">
<h1>Create Account:</h1>
<br>
<form id="signUpForm" action="index.php" method="post">
    <div class="firstName">
        <input type="text" name="firstName" id="firstName" class="field" placeholder="First Name" required>
        <div class="nameError"><em>Please enter 2 or more characters (only letters)</em></div>
    </div>
    <div class="lastName">
        <input type="text" name="lastName" id="lastName" class="field" placeholder="Last Name" required> 
        <div class="lastNameError"><em>Please enter 2 or more characters (only letters)</em></div>
    </div>
    <div class="email">
        <input type="text" name="email" id="email" class="field" placeholder="Email" required> 
        <div class="emailError"><em>Please enter a valid email address</em></div>
    </div>
    <div class="password">
        <input type="password" name="password" id="password" class="field" placeholder="Password" required> 
        <div class="passwordError"><em>Must be a minimum of 8 characters: at least 1 uppercase, at least 1 lowercase, at least 1 digit, at least 1 special character: !@#$%^&*-</em></div>
    </div>
    <div class="passwordConfirm">
        <input type="password" name="passwordConfirm" id="passwordConfirm" class="field" placeholder="Password Confirm" required> 
        <div class="passwordConfirmError"><em>Password must match</em></div>
    </div>
    <button id="submit"type="submit" name="signUp" class="button primaryBtn primaryColor">Create Account</button>
    <input type="hidden" name="action" value="signUp">
    <button id="reset" type="reset" class="primaryBtn primaryColor">Reset the form</button>
</form>
<?php include ('view/googleLoginButton.php'); ?>
<button id="signInNow" class="primaryBtn primaryFill offsetColor">Sign In</button>
</div>

<script src="public/js/signUp.js"></script>


