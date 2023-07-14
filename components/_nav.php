<header class="shadow">
    <div class="navbar  max-w-[1440px] mx-auto">
        <div class="flex-1">
            <!-- <label for="my-drawer-2" class="btn btn-primary drawer-button lg:hidden">Open drawer</label> -->
            <a href="index.php" class="btn btn-ghost normal-case text-xl">Employee Salary</a>
        </div>
        <div class="flex-none">
            <ul class="menu menu-horizontal px-1 gap-2">
                <?php

                // session_start();

                // echo isset($_SESSION['loggedIn']) ? "true" : "false";

                if (!isset($_SESSION['loggedIn'])) {

                    echo "<div class='btn'><a href='login.php'>Login</a></div>
                    <div class='btn'> <a href='reg.php'>Register</a></div>";
                } else {
                    if (isset($_SESSION['user_role']) && $_SESSION["user_role"] == 1) {
                        echo "<div class='btn btn-wide'> <a class='btn btn-wide' href='adminDashboard.php' >Dashboard</a></div>";
                    } else {
                        echo "<div class='btn btn-wide'> <a href='empDashboard.php' >Dashboard</a></div>";
                    }
                    echo "<div class='btn'> <a href='logout.php' >logout</a></div>";
                }



                ?>
            </ul>




        </div>
    </div>
</header>