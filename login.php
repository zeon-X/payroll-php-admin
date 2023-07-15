<?php
$success = false;
$msg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'partials/_dbConnect.php';

    $emp_id = $_POST["emp_id"];
    $emp_password = $_POST["emp_password"];

    $sql = "SELECT * FROM `employee` WHERE `employee`.`emp_password` =\"" . $emp_password . "\" AND `employee`.`emp_id` =\"" . $emp_id . "\"";



    $searchResult = mysqli_query($conn, $sql);

    $nums = mysqli_num_rows($searchResult);
    $emp_row = mysqli_fetch_assoc($searchResult);



    if ($nums > 0) {
        $success = true;
        $msg = "Login Successfull";
        echo "<p class='p-4 w-full bg-green-300'>$msg</p>";

        // echo $emp_row["user_role"];

        session_start();

        $_SESSION['loggedIn'] = true;
        $_SESSION['username'] = $emp_id;
        $_SESSION['user_role'] = $emp_row["user_role"];

        if ($emp_row["user_role"] == 1)
            header("location:adminDashboard.php");
        else
            header("location:empDashboard.php");
    } else {
        $msg = "Invalid Credentials";
        echo "<p class='p-4 w-full bg-red-300'>$msg</p>";
    }
}

?>



<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.2.1/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body class="">

    <?php require 'components/_nav.php' ?>



    <section class="min-h-[600px] p-8 max-w-[1440px] w-full mx-auto flex justify-center items-center">

        <div class="shadow max-w-[800px] mx-auto rounded-xl p-10 flex justify-center items-center gap-10">
            <div>
                <img src="   https://cdn-icons-png.flaticon.com/512/1165/1165674.png " height="156" width="156" alt="" />
                <!-- <p class="text-center ">Login Your Account</p> -->
            </div>

            <form action="/epay/login.php" method="POST">
                <div class="form-control w-full max-w-xs mx-auto mb-2">
                    <label class="label">
                        <span class="label-text text-xs">Username</span>
                    </label>
                    <input type="text" name="emp_id" class="input input-bordered w-full max-w-xs" />

                </div>
                <div class="form-control w-full max-w-xs mx-auto mb-4">
                    <label class="label">
                        <span class="label-text text-xs">Password</span>
                    </label>
                    <input type="password" name="emp_password" class="input input-bordered w-full max-w-xs" />

                </div>
                <p class="text-xs w-full max-w-xs mx-auto">Don't have an Account? <a class="text-warning" href="reg.php">Register Now</a>
                </p>
                <div class="form-control w-full max-w-xs mx-auto mt-4">
                    <input type="submit" value="Login" class="btn w-full max-w-xs">
                </div>

            </form>
        </div>


    </section>


    <?php require 'components/_footer.php' ?>

</body>

</html>