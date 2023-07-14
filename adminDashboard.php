<?php

session_start();
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 1) {
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
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@100;200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
</head>

<body class="">

    <?php require 'components/_nav.php' ?>



    <section class=" max-w-[1440px] w-full mx-auto ">

        <div class="drawer lg:drawer-open">
            <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
            <div class="drawer-content flex flex-col items-start justify-start">
                <!-- Page content here -->
                <label for="my-drawer-2" class="btn btn-primary drawer-button lg:hidden">Open drawer</label>

                <div class="w-full p-10 ">

                    <?php

                    include 'partials/_dbConnect.php';

                    $sql = "SELECT * FROM `employee` ";
                    $searchResult = mysqli_query($conn, $sql);
                    $EmpNum = mysqli_num_rows($searchResult);


                    $sql = "SELECT * FROM `project` ";
                    $searchResult = mysqli_query($conn, $sql);
                    $ProjectNum = mysqli_num_rows($searchResult);


                    $sql = "SELECT * FROM `dept` ";
                    $searchResult = mysqli_query($conn, $sql);
                    $DeptNum = mysqli_num_rows($searchResult);


                    $sql = "SELECT * FROM `salary` ";
                    $searchResult = mysqli_query($conn, $sql);
                    $SalaryNum = mysqli_num_rows($searchResult);

                    mysqli_close($conn);

                    ?>


                    <div class="grid lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-4 w-full">
                        <a href="adEmpList.php"
                            class="rounded-xl p-10 shadow cursor-pointer hover:scale-95 transition-all ease-in-out w-full">
                            <p class="text-xl flex items-center gap-1"> <svg xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>
                                Employee</p>
                            <p class="text-[40px] font-semibold"><?php echo $EmpNum ?></p>
                        </a>
                        <a href="adDept.php"
                            class="rounded-xl p-10 shadow cursor-pointer hover:scale-95 transition-all ease-in-out w-full">
                            <p class=" text-xl flex items-center gap-1"><svg xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 110-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 01-1.44-4.282m3.102.069a18.03 18.03 0 01-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 018.835 2.535M10.34 6.66a23.847 23.847 0 008.835-2.535m0 0A23.74 23.74 0 0018.795 3m.38 1.125a23.91 23.91 0 011.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 001.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 010 3.46" />
                                </svg>
                                Departments</p>
                            <p class="text-[40px] font-semibold"><?php echo $DeptNum ?></p>
                        </a>
                        <a href="adProject.php"
                            class="rounded-xl p-10 shadow cursor-pointer hover:scale-95 transition-all ease-in-out w-full">
                            <p class=" text-xl flex items-center gap-1"><svg xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 6.75V15m6-6v8.25m.503 3.498l4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 00-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0z" />
                                </svg>
                                Projects</p>
                            <p class="text-[40px] font-semibold"><?php echo $ProjectNum ?></p>
                        </a>
                        <a href="adSalary.php"
                            class="rounded-xl p-10 shadow cursor-pointer hover:scale-95 transition-all ease-in-out w-full">
                            <p class=" text-xl flex items-center gap-1"><svg xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Salary</p>
                            <p class="text-[40px] font-semibold"><?php echo $SalaryNum ?></p>
                        </a>
                    </div>

                </div>

            </div>
            <?php require 'components/_adSideBar.php' ?>
        </div>




    </section>


    <?php require 'components/_footer.php' ?>

</body>

</html>