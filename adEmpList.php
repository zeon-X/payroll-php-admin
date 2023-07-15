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

    $emp_id = $_GET['id'];
    // echo $dept_id;


    // Delete record
    $sql =   "DELETE FROM `employee` WHERE `employee`.`emp_id` = '$emp_id' ";
    // echo $sql;
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $success = true;
        $msg = "Employee Deleted";
        echo "<p class='p-4 w-full bg-green-300'>$msg</p>";
        header("location:adEmpList.php");
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

                <div class=" p-10  w-full">
                    <div class="mb-4">
                        <p class="text-xl">Employee List</p>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="table">
                            <!-- head -->
                            <thead>
                                <tr>
                                    <th>UserName</th>
                                    <th>Employee Name</th>
                                    <th>Department</th>
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

                                    echo "<tr>
                                            <th>" . $employee['emp_id'] . "</th>
                                            <td>" . $employee['emp_name'] . "</td>
                                            <td>" . $employee['dept_name'] . "</td>
                                            <td>" . ($employee['type_of_work'] == "ft" ? "Full Time" : "Part Time") . "</td>
                                            <td> $" . $employee['hourly_rate'] . "</td>
                                            <td>" . ($employee['user_role'] == 0 ? "User" : "Admin") . "</td>
                                            <td>" . $employee['dt'] . "</td>
                                            <td> <form action='adEmpList.php?id=" . $employee['emp_id'] . "' method='post'>
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