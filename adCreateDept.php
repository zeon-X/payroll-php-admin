<?php

session_start();
if ((!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] != true) || (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 1)) {
    header("location:login.php");
    exit;
}

?>

<?php
$success = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'partials/_dbConnect.php';

    $dept_name = $_POST["dept_name"];
    $dept_location = $_POST["dept_location"];

    $sql =   "INSERT INTO dept (dept_name, dept_location) VALUES ('$dept_name', '$dept_location')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        $success = true;
        $msg = "Department Created";
        echo "<p class='p-4 w-full bg-green-300'>$msg</p>";
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <title>Admin | Create Depratment</title>
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

        <?php

        if ($success) {
            echo `<div class="alert alert-success">
        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        <span>Your purchase has been confirmed!</span>
      </div>`;
        }

        ?>

        <div class="drawer lg:drawer-open">
            <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
            <div class="drawer-content flex flex-col  items-start justify-start">
                <!-- Page content here -->


                <div class=" p-8 w-full ">
                    <div class="mb-8">
                        <p class="text-xl">Create Department</p>
                    </div>

                    <form action="/epay/adCreateDept.php" method="POST">
                        <div class="grid lg:grid-cols-3 gap-4">

                            <div class="form-control w-full max-w-xs  mb-4">
                                <label class="label">
                                    <span class="label-text text-xs">Department Name</span>
                                </label>
                                <input type="text" name="dept_name" class="input input-bordered w-full max-w-xs" />

                            </div>
                            <div class="form-control w-full max-w-xs  mb-4">
                                <label class="label">
                                    <span class="label-text text-xs">Department Location</span>
                                </label>
                                <input type="text" name="dept_location" class="input input-bordered w-full max-w-xs" />

                            </div>
                        </div>


                        <div class="form-control w-full max-w-xs  mt-4">
                            <input type="submit" value="Create Department" class="btn w-full max-w-xs">
                        </div>

                    </form>
                </div>

            </div>
            <?php require 'components/_adSideBar.php' ?>
        </div>




    </section>


    <?php require 'components/_footer.php' ?>

</body>

</html>