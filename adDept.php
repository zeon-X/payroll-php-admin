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

    $dept_id = $_GET['id'];
    // echo $dept_id;


    // Delete record
    $sql =   "DELETE FROM `dept` WHERE `dept`.`dept_id` = $dept_id ";
    // echo $sql;
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $success = true;
        $msg = "Department Deleted";
        echo "<p class='p-4 w-full bg-green-300'>$msg</p>";
        header("location:adDept.php");
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

                <div class=" p-8  w-full">

                    <div class="mb-4">
                        <p class="text-xl">Department List</p>
                    </div>


                    <div class="overflow-x-auto">
                        <table class="table">
                            <!-- head -->
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Department Name</th>
                                    <th>Department Location</th>
                                </tr>
                            </thead>
                            <tbody>

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

                                    echo "<tr>
                                            <th>" . $dept['dept_id'] . "</th>
                                            <td>" . $dept['dept_name'] . "</td>
                                            <td>" . $dept['dept_location'] . "</td>
                                            <td> <form action='adDept.php?id=" . $dept['dept_id'] . "' method='post'>
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