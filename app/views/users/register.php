<?php require_once APP_ROOT_FOLDER . "/views/includes/header.inc.php";?>

<div class="login-container">
    <div class="login-bg">
        
        <div class="page-box-container" id="register-box">
            <div class="login-block">
                <h2 class="login-heading">Welcome to BlogPods</h2>
                <p class="login-message">please register here:</p>
            </div>
            <form method="post" class="login-form">
                <!-- <label for="email" class="labels">email/username:</label><br> -->

                <input type="text" name="fname" class="input" placeholder="enter first name" value="<?php echo (!empty($data["first_name"]))  ? $data["first_name"] : ""?>" required>

                <input type="text" name="lname" class="input" placeholder="enter last name" value="<?php echo (!empty($data["last_name"]))  ? $data["last_name"] : "" ?>" required>

                <input type="email" name="email" class="input" placeholder="enter email" value="<?php echo (!empty($data["email"]))  ? $data["email"] : "" ?>" required>
                <!-- <label for="pass" class="labels">password</label><br> -->
                <input type="password" name="password" class="input" placeholder="enter password" minlength="8" required>

                <input type="password" name="rpt" class="input" placeholder="repeat password"  minlength="8" required>
                
                <div class="errormsg-container" id="errormsg-container">
                <p class="errormsg"><?php echo $data["error"];?></p>
                </div>

                <input type="submit" name="register-btn" class="btn" value="Register" id="login-btn">
            </form>
            <div class="register-block">
                <p id="login-message">already have an account?</p>
                <a href="login"><input type="button" class="btn" id="register-btn" value="Login!"></a> 
                
            </div>
            
        </div>

        <!-- <div class="login-side-quote">
            <h1 class="login-quote">"Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, eum!" -Ronnie Banerjee</h1>
        </div> -->
    </div>
</div>






<?php require_once APP_ROOT_FOLDER . "/views/includes/footer.inc.php";?>
