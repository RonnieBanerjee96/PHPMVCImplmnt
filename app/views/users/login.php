<?php require_once APP_ROOT_FOLDER . "/views/includes/header.inc.php";?>

<div class="login-container">
    <div class="login-bg">
        
        <div class="page-box-container" id="login-box">
            
            <div class="login-block">
                <h2 class="login-heading">Welcome to BlogPods</h2>
                <p class="login-message">please login to continue</p>
            </div>
            <form action="" method="post" class="login-form">
                <!-- <label for="email" class="labels">email/username:</label><br> -->
                <input type="email" name="email" class="input" placeholder="enter email" required>
                <!-- <label for="pass" class="labels">password</label><br> -->
                <input type="password" name="password" class="input" placeholder="enter password" minlength="8" required>
                
                <span class="remember-me">
                <input type="checkbox" name="remember-me">
                <label for="remember-me">remember me</label>
                </span>

                <div class="errormsg-container" id="errormsg-container">
                <p class="errormsg"><?php echo $data["error"];?></p>
                </div>
                
                <input type="submit" name="login-btn" class="btn" value="Login" id="login-btn">
            </form>
            

            <div class="register-block">
                <p id="register-message">Not Registered?</p>
                <a href="register">
                <input type="button" class="btn" id="register-btn" value="Register!">
                </a>
            </div>
            
        </div>

        <div class="login-side-quote">
            <h1 class="login-quote">"Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, eum!" -Ronnie Banerjee</h1>
        </div>
    </div>
</div>






<?php require_once APP_ROOT_FOLDER . "/views/includes/footer.inc.php";?>
