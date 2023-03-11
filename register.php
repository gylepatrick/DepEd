<?php

    session_start();
    if (isset($_SESSION['SESSION_EMAIL'])) {
        header("Location: welcome.php");
        die();
    }

    include 'config.php';
    $msg = "";

    if (isset($_POST['submit'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm-password']);
    
        // check if there is already an administrator
        $result = mysqli_query($conn, "SELECT * FROM users WHERE status='administrator'");
        if (mysqli_num_rows($result) > 0 && $status === 'administrator') {
            $msg = "<div class='alert alert-danger'>An administrator user already exists.</div>";
        } else {
            // if no admin account it will save
            if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE email='{$email}'")) > 0) {
                $msg = "<div class='alert alert-danger'>The email address already exists.</div>";
            } else {
                if ($password === $confirm_password) {
                    $sql = "INSERT INTO users (name, email, status, password) VALUES ('{$name}', '{$email}', '{$status}', '{$password}')";
                    $result = mysqli_query($conn, $sql);
    
                    if ($result) {
                        $msg = "<div class='alert alert-success'>Register successful.</div>";
                    } else {
                        $msg = "<div class='alert alert-danger'>Failed to register. Please try again.</div>";
                    }
                } else {
                    $msg = "<div class='alert alert-danger'>Password and Confirm Password do not match.</div>";
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Login Form</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords" content="Login Form" />
    <!-- //Meta tag Keywords -->

    <link href="//fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <!--/Style-CSS -->
    <link rel="stylesheet" href="assets/css/style.css" type="text/css" media="all" />
    <!--//Style-CSS -->

    <script src="https://kit.fontawesome.com/af562a2a63.js" crossorigin="anonymous"></script>

</head>

<body>

    <!-- form section start -->
    <section class="w3l-mockup-form">
        <div class="container">
            <!-- /form -->
            <div class="workinghny-form-grid">
                <div class="main-mockup">
                    <div class="w3l_form align-self">
                        <div class="left_grid_info">
                            <img src="assets/img/img.png" alt="">
                        </div>
                    </div>
                    <div class="content-wthree">
                        <h2>Register Now</h2>
                        <?php echo $msg; ?>
                        <form action="" method="post">
                            <input type="text" class="name" name="name" placeholder="Enter Your Name"
                                value="<?php if (isset($_POST['submit'])) { echo $name; } ?>" required>
                            <input type="email" class="email" name="email" placeholder="Enter Your Email"
                                value="<?php if (isset($_POST['submit'])) { echo $email; } ?>" required>
                            <div class="form-group mb-3">
                                <label for="">User Type</label>
                                <select class="form-select form-control" name="status">
                                    <option value="administrator">Administrator</option>
                                    <option value="coordinator">Coordinator</option>
                                </select>
                            </div>
                            <input type="password" class="password" name="password" placeholder="Enter Your Password"
                                required>
                            <input type="password" class="confirm-password" name="confirm-password"
                                placeholder="Confirm your Password" required>
                            <button name="submit" class="btn" type="submit">Register</button>
                        </form>
                        <div class="social-icons">
                            <p>Have an account! <a href="index.php">Login</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //form -->
        </div>
    </section>
    <!-- //form section start -->

</body>

</html>