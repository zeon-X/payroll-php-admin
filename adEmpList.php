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

                <div class=" p-8  w-full">
                    <div class="mb-4">
                        <p class="text-xl">Employee List</p>
                    </div>


                    <form action='adEmpList.php' method='post' class="grid grid-cols-4 gap-4 mb-6">
                        <div class="form-control w-full max-w-xs">
                            <label class="label">
                                <span class="lt text-xs">Select Department</span>
                            </label>
                            <select name="dept_name" value="" class="select select-bordered">
                                <option value="" disabled selected>Pick one</option>

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

                                    echo "<option value=\"" . $dept['dept_name'] . "\">" . $dept['dept_name'] . "</option>";
                                }
                                mysqli_close($conn);

                                ?>

                            </select>
                        </div>

                        <div class="form-control w-full max-w-xs">
                            <label class="label">
                                <span class="lt text-xs">Dept Location</span>
                            </label>
                            <select name="dept_location" value="" class="select select-bordered">
                                <option value="" disabled selected>Pick one</option>

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

                                    echo "<option value=\"" . $dept['dept_location'] . "\">" . $dept['dept_location'] . "</option>";
                                }
                                mysqli_close($conn);

                                ?>

                            </select>
                        </div>

                        <div class="form-control w-full max-w-xs">
                            <label class="label">
                                <span class="lt text-xs">Type of Work</span>
                            </label>
                            <select name="type_of_work" value="" class="select select-bordered">
                                <option value="" disabled selected>Pick one</option>
                                <option value="ft">Full Time</option>
                                <option value="pt">Part Time</option>
                            </select>
                        </div>

                        <div class="form-control w-full max-w-xs">
                            <label class="label">
                                <span class="lt text-xs">Fliter</span>
                            </label>
                            <input type="submit" name="" class="btn" value="Search" />
                        </div>
                    </form>


                    <?php
                    $success = false;
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        include 'partials/_dbConnect.php';

                        // echo is_null($_POST["dept_name"]) == true ? "yes" : "no";
                        // echo $_POST["dept_location"];
                        // echo $_POST["type_of_work"];

                        $dept_name = $_POST["dept_name"] ? $_POST["dept_name"] : "";
                        $dept_location = $_POST["dept_location"] ? $_POST["dept_location"] : "";
                        $type_of_work = $_POST["type_of_work"] ? $_POST["type_of_work"] : "";

                        $sql =   "SELECT * FROM `employee`,`dept` 
                        WHERE  `employee`.`dept_id` = `dept`.`dept_id` 
                        AND `employee`.`type_of_work` = '$type_of_work'  
                        AND `dept`.`dept_name` = '$dept_name'   
                        AND `dept`.`dept_location` = '$dept_location'";

                        if ($dept_name == "") {
                            $sql =   "SELECT * FROM `employee`,`dept` 
                            WHERE  `employee`.`dept_id` = `dept`.`dept_id` 
                            AND `employee`.`type_of_work` = '$type_of_work'  
                            AND `dept`.`dept_location` = '$dept_location'";
                        }

                        if ($dept_location == "") {
                            $sql =    "SELECT * FROM `employee`,`dept` 
                            WHERE  `employee`.`dept_id` = `dept`.`dept_id` 
                            AND `employee`.`type_of_work` = '$type_of_work'  
                            AND `dept`.`dept_name` = '$dept_name'   ";
                        }

                        if ($type_of_work == "") {
                            $sql =   "SELECT * FROM `employee`,`dept` 
                            WHERE  `employee`.`dept_id` = `dept`.`dept_id`  
                            AND `dept`.`dept_name` = '$dept_name'   
                            AND `dept`.`dept_location` = '$dept_location'";
                        }

                        if ($dept_location == "" && $dept_name == "") {
                            $sql =   "SELECT * FROM `employee`,`dept` 
                            WHERE  `employee`.`dept_id` = `dept`.`dept_id` 
                            AND `employee`.`type_of_work` = '$type_of_work'";
                        }

                        if ($dept_location == "" && $type_of_work == "") {
                            $sql =   "SELECT * FROM `employee`,`dept` 
                            WHERE  `employee`.`dept_id` = `dept`.`dept_id`  
                            AND `dept`.`dept_name` = '$dept_name'   ";
                        }
                        if ($type_of_work == "" && $dept_name == "") {
                            $sql =   "SELECT * FROM `employee`,`dept` 
                            WHERE  `employee`.`dept_id` = `dept`.`dept_id`    
                            AND `dept`.`dept_location` = '$dept_location'";
                        }

                        if ($type_of_work == "" && $dept_name == "" && $type_of_work == "") {
                            $sql =   "SELECT * FROM `employee`,`dept` 
                            WHERE  `employee`.`dept_id` = `dept`.`dept_id`";
                        }

                        // echo $sql;
                        $result = mysqli_query($conn, $sql);
                        $filterValues = array();
                        while ($row = mysqli_fetch_assoc($result)) {
                            $filterValues[] = $row;
                        }

                        echo "
                        <p class='text-xs ml-2 mb-2'>Filtered Data</p>
                            <table class='table bg-gray-100 mb-10'>
                                <thead>
                                    <tr>
                                        <!-- <th>UserName</th> -->
                                        <th>Employee Name</th>
                                        <th>Department</th>
                                        <th>Department Location</th>
                                        <th>Type of Work</th>
                                        <th>Hourly Rate</th>
                                        <th>Role</th>
                                        <th>Registration Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                            ";



                        foreach ($filterValues as $employee) {
                            echo "<tr>
                                    <td>" . $employee['emp_name'] . "</td>
                                    <td>" . $employee['dept_name'] . "</td>
                                    <td>" . $employee['dept_location'] . "</td>
                                    <td>" . ($employee['type_of_work'] == "ft" ? "Full Time" : "Part Time") . "</td>
                                    <td> $" . $employee['hourly_rate'] . "</td>
                                    <td>" . ($employee['user_role'] == 0 ? "User" : "Admin") . "</td>
                                    <td>" . $employee['dt'] . "</td>
                                    
                                </tr>";
                        }

                        echo "
                                </tbody>
                            </table>";

                        mysqli_close($conn);

                        // <td> <form action='deleteAdminEmp.php?id=" . $employee['emp_id'] . "' method='post'>
                        // <input type='submit' name='delete' class='cursor-pointer' value='Delete'>
                        // </form>
                        // </td>
                    }
                    ?>

                    <div class="overflow-x-auto">
                        <table class="table">
                            <!-- head -->
                            <thead>
                                <tr>
                                    <!-- <th>UserName</th> -->
                                    <th>Employee Name</th>
                                    <th>Department</th>
                                    <th>Department Location</th>
                                    <th>Type of Work</th>
                                    <th>Hourly Rate</th>
                                    <th>Role</th>
                                    <th>Registration Date</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                include 'partials/_dbConnect.php';
                                // Prepare the SQL statement
                                $sql = "SELECT * FROM `employee` JOIN `dept`  ON `dept`.`dept_id`=`employee`.`dept_id`";

                                $result = mysqli_query($conn, $sql);
                                $employees = array();
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $employees[] = $row;
                                }


                                foreach ($employees as $employee) {

                                    // <th>" . $employee['emp_id'] . "</th>

                                    echo "<tr>
                                            
                                            <td>" . $employee['emp_name'] . "</td>
                                            <td>" . $employee['dept_name'] . "</td>
                                            <td>" . $employee['dept_location'] . "</td>
                                            <td>" . ($employee['type_of_work'] == "ft" ? "Full Time" : "Part Time") . "</td>
                                            <td> $" . $employee['hourly_rate'] . "</td>
                                            <td>" . ($employee['user_role'] == 0 ? "User" : "Admin") . "</td>
                                            <td>" . $employee['dt'] . "</td>
                                            <td> <form action='deleteAdminEmp.php?id=" . $employee['emp_id'] . "' method='post'>
                                                    <input type='submit' name='delete' class='cursor-pointer' value='Delete'>
                                                </form>
                                            </td>
                                        </tr>";
                                }
                                mysqli_close($conn);

                                ?>

                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
            <?php require 'components/_adSideBar.php' ?>
        </div>




    </section>


    <?php require 'components/_footer.php' ?>

</body>

</html>