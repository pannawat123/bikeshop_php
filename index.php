<?php 
    require_once ('./config/database.php');

    $queryStr = "SELECT * FROM product";
    $data_products = $db->query($queryStr);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BIKESHOP | HOME</title>
    <?php include_once ('./components/header.php'); ?>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

    <?php include_once ('./components/navbar.php') ?>
    

    <div class="container">

        <div class="w-full mt-10 mb-20">

            <div class="
                h-[200px] w-[100%] my-0 bg-black mx-auto
                bg-[url('https://static.homepro.co.th/category/fullimage/l2_bikes_th.jpg')]
                bg-no-repeat bg-cover bg-center rounded-xl tranform shadow-xl
            "></div>
            <!-- <div class="w-full flex justify-end">
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="ค้นหาสินค้า" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">ค้นหา</button>
                </form>
            </div> -->

            <div class="w-full mt-8 grid grid-cols-4 gap-4">

                <?php
                    while($row = $data_products->fetch_assoc()): 
                        
                        $rowID = $row['ProductID'];

                        $queryStr = "SELECT * FROM productpictures WHERE ProductID = '$rowID' LIMIT 1";
                        // echo $queryStr;
                        $img_product = $db->query($queryStr);
                        $img_product = $img_product->fetch_assoc();

                ?>

                    <div class="p-3 flex flex-col justify-center shadow-md border-[1px] rounded-xl overflow-hidden">
                        <div class="w-full h-[200px] overflow-hidden rounded-xl">
                            <div class="
                                bg-[url('<?php echo ($img_product ? $img_product['source'] : './assets/img/no_img.jpg'); ?>')]
                                w-full h-full bg-no-repeat bg-cover bg-center rounded-xl tranform hover:scale-125  duration-200
                            "></div>
                        </div>

                        <div class="mt-3 grid grid-cols-2 px-2">
                            <p class="text-xl">
                                <?php echo $row['name']; ?>
                            </p>
                            <p class="text-right text-red-700 text-2xl">
                                ฿ <?php echo number_format($row['price']); ?>
                            </p>
                        </div>
                        
                        <a href="./product.php?id=<?php echo $row['ProductID']; ?>" 
                            class="px-3 py-1.5 mt-3 rounded-lg text-center border-2 border-indigo-700 text-indigo-700 
                                hover:bg-indigo-700 hover:text-white duration-300"
                        >
                            สั่งซื้อสินค้า
                        </a>

                        <!-- <div class="grid grid-cols-2 px-2">
                            <p></p>
                            <p></p>
                        </div> -->

                    </div>

                <?php 
                    endwhile;
                ?>

            </div>

                
            
            
        </div>
        
    </div>
    
    <div class="flex flex-col justify-center h-[100px] mt-3 w-full bg-[#222] text-white  text-center  ">
        Copyright 2001-2020 Home Product Center Public Company Limited. All rights reserved.
        

    </div>

</body>
</html>