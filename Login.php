<?php
require_once 'Dbconfig.php';

if ($user->is_loggedin() != "") {
    $user->redirect('Panel.php');
}

if (isset($_POST['btn-login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($user->login($username, $password)) {
        $user->redirect('Panel.php');
    } else {
        $error = "Wrong Details !";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Style.css">
    <title>Login</title>
</head>

<body>
    <a href="Home.php" class="homebtn">
        < Back </a>
            <div>
                <div>

                    <form method="post">
                        <div class="container">
                            <h1>LOGIN ACCOUNT.</h1>
                            <p>Please enter your Username or Email and Password.</p>
                            <hr />

                            <div>

                                <label for="username"><b>Username</b></label>
                                <input type="text" placeholder="Enter Username or Email" name="username" id="username"
                                    required>

                                <label for="pass"><b>Password</b></label>
                                <input type="password" placeholder="Enter Password" name="password" id="pass" required>

                            </div>
                            <hr />

                            <?php if (isset($error)) {?>
                            <div>
                                <p> <?php echo $error; ?> ! </p>
                            </div>
                            <?php }?>

                            <button type="submit" name="btn-login" class="registerbtn">
                                Login
                            </button>

                            <p class="new">Don't have an account? <a href="SignUp.php">Create account</a>.</p>

                        </div>

                    </form>
                </div>
            </div>

</body>

</html>