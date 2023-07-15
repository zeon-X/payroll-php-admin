<?php
$emp_username = "";
session_start();
if ((!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] != true) || (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 0)) {
    header("location:login.php");
    exit;
}
$emp_username = $_SESSION['username'];

?>


<?php
$success = false;
$msg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'partials/_dbConnect.php';

    // $emp_id = $_POST["emp_id"];
    $street_no = $_POST["street_no"];
    $street_no = $_POST["street_no"];

    $street_name = $_POST["street_name"];
    $city = $_POST["city"];
    $zip_code = $_POST["zip_code"];


    $sql =   "INSERT INTO 
            `address` (`emp_id`, `street_no`, `street_name`, `city`, `zip_code`)
            VALUES
            ('$emp_username', '$street_no', '$street_name', '$city','$zip_code')";



    $result = mysqli_query($conn, $sql);

    if ($result) {

        $success = true;
        $msg = "Update Successfull";
    }

    mysqli_close($conn);
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



    <section class=" max-w-[1440px] w-full mx-auto ">

        <div class="drawer lg:drawer-open">
            <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
            <div class="drawer-content flex flex-col items-start justify-start">
                <!-- Page content here -->
                <label for="my-drawer-2" class="btn btn-primary drawer-button lg:hidden">Open drawer</label>

                <div class=" p-10 w-full ">
                    <div class="mb-8">
                        <p class="text-xl">Profile </p>
                    </div>

                    <?php

                    include 'partials/_dbConnect.php';

                    $emp_id = $emp_username;

                    // $sql = "SELECT * FROM `employee` JOIN `dept` ON `employee`.`dept_id` = `dept`.`dept_id` JOIN `address` ON `employee`.`emp_id` = `address`.`emp_id`  WHERE   `employee`.`emp_id` =\"" . $emp_id . "\"";
                    $sql = "SELECT * FROM `employee` JOIN `dept` ON `employee`.`dept_id` = `dept`.`dept_id`  WHERE   `employee`.`emp_id` =\"" . $emp_id . "\"";
                    $result = mysqli_query($conn, $sql);
                    $emp_row = mysqli_fetch_assoc($result);

                    // echo $emp_row["emp_id"];

                    $sqlAddress = "SELECT * FROM `address` WHERE  `address`.`emp_id` =\"" . $emp_id . "\"";
                    $resultAddress = mysqli_query($conn, $sqlAddress);
                    $nums = mysqli_num_rows($resultAddress);
                    $address_row = mysqli_fetch_assoc($resultAddress);

                    // echo $nums;

                    mysqli_close($conn);

                    ?>

                    <div class="grid lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1 gap-4 ">

                        <div>
                            <p class="text-xs mb-2 ml-1">Name</p>
                            <div class="input input-bordered input-disabled w-full max-w-xs flex items-center">
                                <p><?php echo $emp_row["emp_name"] ?></p>
                            </div>
                        </div>

                        <div>
                            <p class="text-xs mb-2 ml-1">Dept</p>
                            <div class="input input-bordered input-disabled w-full max-w-xs flex items-center">
                                <p><?php echo $emp_row["dept_name"] ?></p>
                            </div>
                        </div>

                        <div>
                            <p class="text-xs mb-2 ml-1">Username</p>
                            <div class="input input-bordered input-disabled w-full max-w-xs flex items-center">
                                <p><?php echo $emp_row["emp_id"] ?></p>
                            </div>
                        </div>
                        <div>
                            <p class="text-xs mb-2 ml-1">Type of Work</p>
                            <div class="input input-bordered input-disabled w-full max-w-xs flex items-center">
                                <p><?php echo ($emp_row["type_of_work"] == "ft" ? "Full Time" : "Part Time") ?></p>
                            </div>
                        </div>
                        <div>
                            <p class="text-xs mb-2 ml-1">Hourly Rate</p>
                            <div class="input input-bordered input-disabled w-full max-w-xs flex items-center">
                                <p>$<?php echo $emp_row["hourly_rate"] ?> </p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4 mt-10">
                        <p class="text-xl">Address </p>
                    </div>
                    <form action="/epay/empDashboard.php" method="POST">
                        <div class="grid lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1 gap-4">
                            <div class="form-control w-full max-w-xs mx-auto mb-2">
                                <label class="label">
                                    <span class="label-text text-xs">Street No</span>
                                </label>
                                <input <?php echo ($nums > 0 ? "disabled" : "") ?> type="text" value="<?php echo ($nums > 0 ? ($address_row["street_no"]) : "") ?>" name="street_no" class="input input-bordered w-full max-w-xs" />
                            </div>
                            <div class="form-control w-full max-w-xs mx-auto mb-2">
                                <label class="label">
                                    <span class="label-text text-xs">Street Name</span>
                                </label>
                                <input <?php echo ($nums > 0 ? "disabled" : "") ?> value="<?php echo ($nums > 0 ? ($address_row["street_name"]) : "") ?>" type="text" name="street_name" class="input input-bordered w-full max-w-xs" />
                            </div>
                            <div class="form-control w-full max-w-xs mx-auto mb-2">
                                <label class="label">
                                    <span class="label-text text-xs">City</span>
                                </label>
                                <input <?php echo ($nums > 0 ? "disabled" : "") ?> value="<?php echo ($nums > 0 ? ($address_row["city"]) : "") ?>" type="text" name="city" class="input input-bordered w-full max-w-xs" />
                            </div>
                            <div class="form-control w-full max-w-xs mx-auto mb-2">
                                <label class="label">
                                    <span class="label-text text-xs">Zip Code</span>
                                </label>
                                <input <?php echo ($nums > 0 ? "disabled" : "") ?> value="<?php echo ($nums > 0 ? ($address_row["zip_code"]) : "") ?>" type="text" name="zip_code" class="input input-bordered w-full max-w-xs" />
                            </div>




                        </div>



                        <div class="form-control w-full max-w-xs mt-4">
                            <input type="submit" value="Update Address" <?php echo ($nums > 0 ? "disabled" : "") ?> class="btn w-full max-w-xs" ?>
                        </div>
                    </form>


                    <!-- <div class="mb-4 mt-10">
                        <p class="text-xl">Salary </p>
                    </div> -->

                </div>

            </div>
            <?php require 'components/_empSideBar.php' ?>
        </div>




    </section>


    <?php require 'components/_footer.php' ?>

</body>

</html>