<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <title>Employee Salary </title>
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

    <main class="min-h-[400px] max-w-[1080px] mx-auto">
        <section class="my-20 py-16 flex justify-center items-center gap-0">

            <div class="w-1/2 p-8">
                <p class="text-4xl font-semibold mb-6">Salary Tracking System</p>
                <p class="text-lg">Employee salary tracking system automates calculations, manages attendance, ensures
                    tax
                    compliance, and streamlines salary disbursement for efficiency.</p>
            </div>

            <div class="w-1/2 ">
                <img src="https://i.ibb.co/1vzw55m/pngwing-com.png" class=" mx-auto w-[330px]" alt="" />

            </div>
        </section>

        <section class="my-20 py-4">
            <p class="text-center mx-auto text-3xl">Project Team</p>
            <div class=" mt-10 mx-auto grid grid-cols-3 justify-center items-center gap-8">

                <div class="flex flex-col justify-center items-center hover:mt-[-30px] transition-all ease-in-out">
                    <img src="https://i.ibb.co/NNPM7jC/140874310-1633845690150580-9052359744013760753-n.jpg" alt="" class="w-[230px] h-[230px] rounded-full shadow-lg mb-4" />
                    <p>ID: 1903143</p>
                </div>
                <div class=" flex flex-col justify-center items-center hover:mt-[-30px] transition-all ease-in-out">
                    <img src="https://i.ibb.co/7pSn4mm/316246385-434968045506288-2865891230623973497-n.jpg" alt="" class="w-[230px] h-[230px] rounded-full shadow-lg mb-4" />
                    <p>ID: 1903144</p>
                </div>
                <div class="flex flex-col justify-center items-center hover:mt-[-30px] transition-all ease-in-out">
                    <img src="https://i.ibb.co/SxCWKDH/imgonline-com-ua-resize-B8x-PNPFMy-T8-CMumt.jpg" alt="" class="w-[230px] h-[230px] rounded-full shadow-lg mb-4" />
                    <p>ID: 1903147</p>
                </div>
                <div class="flex flex-col justify-center items-center hover:mt-[-30px] transition-all ease-in-out">
                    <img src="   https://cdn-icons-png.flaticon.com/512/149/149071.png " alt="" class="w-[230px] h-[230px] rounded-full shadow-lg mb-4" />
                    <p>ID: 1903148</p>
                </div>
                <div class=" flex flex-col justify-center items-center hover:mt-[-30px] transition-all ease-in-out">
                    <img src="https://i.ibb.co/6PS8NVz/322703713-1366806297478294-4637059878375866967-n.jpg" alt="" class="w-[230px] h-[230px] rounded-full shadow-lg mb-4" />
                    <p>ID: 1903149</p>
                </div>
                <div class="flex flex-col justify-center items-center hover:mt-[-30px] transition-all ease-in-out">
                    <img src="   https://cdn-icons-png.flaticon.com/512/149/149071.png " alt="" class="w-[230px] h-[230px] rounded-full shadow-lg mb-4" />
                    <p>ID: 1903150</p>
                </div>






            </div>
        </section>
    </main>






    <?php require 'components/_footer.php' ?>

</body>

</html>