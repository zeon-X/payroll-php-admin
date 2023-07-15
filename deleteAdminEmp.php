
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
