<?php
$success = false;
$msg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'partials/_dbConnect.php';

    $emp_id = $_POST["emp_id"];
    $emp_password = $_POST["emp_password"];
    $cpassword = $_POST["cpassword"];

    $emp_name = $_POST["emp_name"];
    $dept_id = $_POST["dept_id"];
    $type_of_work = $_POST["type_of_work"];
    $hourly_rate = $_POST["hourly_rate"];


    $sql = "SELECT * FROM `employee` WHERE `employee`.`emp_id` =\"" . $emp_id . "\"";

    $searchResult = mysqli_query($conn, $sql);
    $nums = mysqli_num_rows($searchResult);

    if ($nums < 1) {
        if ($emp_password == $cpassword) {
            $sql =   "INSERT INTO 
            `employee` (`emp_id`, `emp_password`, `emp_name`, `dept_id`, `type_of_work`, `hourly_rate`, `user_role`)
            VALUES
            ('$emp_id', '$emp_password', '$emp_name', $dept_id,'$type_of_work', '$hourly_rate',0)";

            // echo $sql;

            $result = mysqli_query($conn, $sql);

            if ($result) {
                $success = true;
                $msg = "Registration Successfull";
            }

            mysqli_close($conn);
        } else {
            $msg = "Passwords dosen't matched";
        }
    } else {
        $msg = "Email Already Registered";
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

    <?php

    if ($success) {
        echo `<div class="alert alert-success">
        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        <span>$msg</span>
      </div>`;
    } else {
        echo `<div class="alert alert-error">
        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        <span>$msg</span>
      </div>`;
    }

    ?>

    <section class="min-h-[700px] p-8 max-w-[1440px] w-full mx-auto flex justify-center items-center">

        <div class="shadow max-w-[700px] w-full mx-auto rounded-xl p-10 flex justify-center items-start gap-10">


            <form action="/epay/reg.php" method="POST" class="w-full flex flex-col justify-center items-center">



                <p class="text-center mb-4">Register Your Account</p>


                <div class="form-control w-full  mb-2 max-w-xs">
                    <label class="label">
                        <span class="label-text text-xs">Name</span>
                    </label>
                    <input type="text" name="emp_name" class="input input-bordered w-full max-w-xs" />
                </div>

                <div class="form-control w-full  mb-2 max-w-xs">
                    <label class="label">
                        <span class="label-text text-xs">Username</span>
                    </label>
                    <input type="text" name="emp_id" class="input input-bordered w-full max-w-xs" />
                </div>

                <div class="form-control w-full max-w-xs">
                    <label class="label">
                        <span class="label-text text-xs">Select Department</span>
                    </label>
                    <select name="dept_id" class="select select-bordered">
                        <option disabled selected>Pick one</option>

                        <?php
                        include 'partials/_dbConnect.php';
                        // Prepare the SQL statement
                        $sql = "SELECT * FROM `dept` ";

                        $result = mysqli_query($conn, $sql);
                        $depts = array();
                        while ($row = mysqli_fetch_assoc($result)) {
                            $depts[] = $row;
                        }


                        foreach ($depts as $dept) {

                            echo "<option value=\"" . $dept['dept_id'] . "\">" . $dept['dept_name'] . "</option>";
                        }
                        mysqli_close($conn);

                        ?>

                    </select>
                </div>


                <div class="form-control w-full max-w-xs">
                    <label class="label">
                        <span class="label-text text-xs">Type of Work</span>
                    </label>
                    <select name="type_of_work" class="select select-bordered">
                        <option disabled selected>Pick one</option>
                        <option value="ft">Full Time</option>
                        <option value="pt">Part Time</option>
                    </select>
                </div>


                <div class="form-control w-full  mb-2 max-w-xs">
                    <label class="label">
                        <span class="label-text text-xs">Hourly Rate</span>
                    </label>
                    <input type="number" name="hourly_rate" class="input input-bordered w-full max-w-xs" />
                </div>

                <div class="form-control w-full  mb-4 max-w-xs">
                    <label class="label">
                        <span class="label-text text-xs">Password</span>
                    </label>
                    <input type="password" name="emp_password" class="input input-bordered w-full max-w-xs" />
                </div>

                <div class="form-control w-full  mb-4 max-w-xs">
                    <label class="label">
                        <span class="label-text text-xs">Confirm Password</span>
                    </label>
                    <input type="password" name="cpassword" class="input input-bordered w-full max-w-xs" />
                </div>

                <p class="text-xs w-full max-w-xs mx-auto">Already have an Account? <a class="text-warning" href="login.php">Login
                        Now</a>

                </p>
                <div class="form-control w-full w-full max-w-xs mx-auto mt-4">
                    <input type="submit" value="Register" class="btn w-full max-w-xs">
                </div>

            </form>
        </div>


    </section>


    <?php require 'components/_footer.php' ?>

</body>

</html>