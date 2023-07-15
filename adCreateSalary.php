<?php

session_start();
if ((!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] != true) || (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 1)) {
    header("location:login.php");
    exit;
}

?>




<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <title>Admin | Create Salary</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.2.1/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<?php
$msg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'partials/_dbConnect.php';

    $emp_id = $_POST["emp_id"];
    $project_id = $_POST["project_id"];
    $num_of_hours = $_POST["num_of_hours"];

    // JOIN `dept` ON  `employee`.`dept_id`=`dept`.`dept_id` 

    $sql = "SELECT * FROM `employee` WHERE `employee`.`emp_id` =\"" . $emp_id . "\"";
    $searchResult = mysqli_query($conn, $sql);
    $emp_row = mysqli_fetch_assoc($searchResult);
    $dept_id = $emp_row["dept_id"];


    $sql =   "INSERT INTO 
            `ft_pt_work` (`emp_id`, `project_id`,`dept_id`, `num_of_hours`)
            VALUES
            ('$emp_id', $project_id,$dept_id, '$num_of_hours')";

    // echo $sql;

    $result = mysqli_query($conn, $sql);

    if ($result) {


        $success = true;
        $msg = "Salary Created";

        echo "<p class='p-4 w-full bg-green-300'>$msg</p>";
    }

    mysqli_close($conn);
}
?>

<body class="">

    <?php require 'components/_nav.php' ?>



    <section class=" max-w-[1440px] w-full mx-auto ">

        <div class="drawer lg:drawer-open">
            <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
            <div class="drawer-content flex flex-col  items-start justify-start">
                <!-- Page content here -->


                <div class=" p-8 w-full ">
                    <div class="mb-8">
                        <p class="text-xl">Create Employee Salary</p>
                    </div>



                    <form action="/epay/adCreateSalary.php" method="POST">
                        <div class="grid lg:grid-cols-3 gap-4">

                            <div class="form-control w-full max-w-xs">
                                <label class="label">
                                    <span class="label-text">Select Employee</span>
                                </label>

                                <select id="empSelect" name="emp_id" class="select select-bordered">
                                    <option disabled selected>Pick one</option>
                                    <?php

                                    include 'partials/_dbConnect.php';
                                    // Prepare the SQL statement
                                    $sql = "SELECT * FROM `employee` ";

                                    $result = mysqli_query($conn, $sql);
                                    $employees = array();
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $employees[] = $row;
                                    }

                                    foreach ($employees as $employee) {

                                        echo "<option  value=\"" . $employee['emp_id'] . "\">" . $employee['emp_name'] . "</option>";
                                    }
                                    mysqli_close($conn);

                                    ?>
                                </select>
                            </div>

                            <div class="form-control w-full max-w-xs">
                                <label class="label">
                                    <span class="label-text">Select Project</span>
                                </label>
                                <select name="project_id" class="select select-bordered">
                                    <option disabled selected>Pick one</option>
                                    <?php

                                    include 'partials/_dbConnect.php';
                                    // Prepare the SQL statement
                                    $sql = "SELECT * FROM `project` ";

                                    $result = mysqli_query($conn, $sql);
                                    $projects = array();
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $projects[] = $row;
                                    }

                                    foreach ($projects as $project) {

                                        echo "<option value=\"" . $project['project_id'] . "\">" . $project['project_name'] . "</option>";
                                    }
                                    mysqli_close($conn);

                                    ?>
                                </select>
                            </div>

                            <div class="form-control w-full max-w-xs  mb-4">
                                <label class="label">
                                    <span class="label-text text-xs">Number of Hours</span>
                                </label>
                                <input type="number" name="num_of_hours" class="input input-bordered w-full max-w-xs" />

                            </div>


                        </div>


                        <div class="form-control w-full max-w-xs  mt-4">
                            <input type="submit" value="Create Salary" class="btn w-full max-w-xs">
                        </div>

                    </form>


                </div>

            </div>
            <?php require 'components/_adSideBar.php' ?>
        </div>




    </section>


    <?php require 'components/_footer.php' ?>

    <!-- <script src="./scripts/cs.js"> </script> -->

</body>

</html>