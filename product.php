<?php
require_once('./config/database.php');

$id = $_GET['id'];
if (!$id) {
    alert('ไม่พบข้อมูลสินค้า', './index.php');
}

$queryStr = "SELECT * FROM product WHERE ProductID = '$id'";
$data_product = $db->query($queryStr);
$data_product = $data_product->fetch_assoc();

$queryStr = "SELECT * FROM productpictures WHERE ProductID = '$id'";
$data_picture = $db->query($queryStr);
$mainImg = $db->query($queryStr);
$mainImg = $mainImg->fetch_assoc();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BIKESHOP | PRODUCT</title>
    <?php include_once('./components/header.php'); ?>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

    <?php include_once('./components/navbar.php') ?>


    <div class="container">

        <div class="w-full mt-10">

            <div class="container mt-5 mb-5">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-6 border-end">
                            <div class="d-flex flex-column justify-content-center">
                                <div class="main_image">
                                    <img src="<?php echo ($mainImg ? $mainImg['source'] : './assets/img/no_img.jpg'); ?>" id="main_product_image" width="350">
                                </div>
                                <div class="thumbnail_images">
                                    <ul id="thumbnail">
                                        <?php
                                        while ($pic = $data_picture->fetch_assoc()) :
                                        ?>
                                            <li>
                                                <img onclick="changeImage(this)" src="<?php echo $pic['source'] ?>" width="70">
                                            </li>
                                        <?php
                                        endwhile;
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 relative">
                            <?php if (isset($_SESSION['cusID'])) : ?>
                                <form method="POST" action="./order.php?id=<?php echo $data_product['ProductID']; ?>">
                                <?php endif; ?>
                                <div class="p-8 right-side">
                                    <div class="mt-8 d-flex justify-content-between align-items-center">
                                        <p class="text-4xl"><?php echo $data_product['name']; ?></p></span>
                                    </div>

                                    <div class="flex flex-col gap-y-4">
                                        <p class="text-xl mt-4">
                                            ฿ <?php echo number_format($data_product['price']); ?>
                                        </p>
                                        <p class="text-sm -mt-4 text-blue-600">
                                            คงเหลือ : <?php echo number_format($data_product['qty']); ?>
                                        </p>
                                        <input name="price" value="<?php echo $data_product['price'] ?>" type="hidden" />
                                        <input name="qty" value="1" type="number" class="form-control w-40" min="0" placeholder="จำนวน" />
                                        <input type="submit" id="confirmOrder" class="hidden">
                                        <?php if (isset($_SESSION['cusID'])) : ?>
                                            <div onclick="alertConfirmOrder()" class="text-center py-2 shadow-lg hover:bg-indigo-900 duration-200 text-white rounded-lg w-40 bg-indigo-700">
                                                สั่งซื้อสินค้า
                                                </d>
                                            <?php else : ?>
                                                <a href="./login.php" class="text-center py-2 shadow-lg hover:bg-indigo-900 duration-200 text-white rounded-lg w-40 bg-indigo-700">
                                                    สั่งซื้อสินค้า
                                                </a>
                                            <?php endif; ?>

                                            </div>

                                    </div>
                                    <?php if (isset($_SESSION['cusID'])) : ?>
                                </form>
                            <?php endif; ?>
                            <p class="absolute left-10 -bottom-44 text-red-700">** สินค้าทุกชินเก็บเงินปลายทาง</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>


</body>

</html>







<script>
    function alertConfirmOrder() {
        if (confirm('คุณต้องการสั่งสินค้าใช่หรือไม่')) {
            document.querySelector('#confirmOrder').click();
        }
    }

    function changeImage(element) {
        var main_prodcut_image = document.getElementById('main_product_image');
        main_prodcut_image.src = element.src;
    }
</script>






<style>
    body {
        background-color: #ecedee
    }

    .card {
        border: none;
        overflow: hidden
    }

    .thumbnail_images ul {
        list-style: none;
        justify-content: center;
        display: flex;
        align-items: center;
        margin-top: 10px
    }

    .thumbnail_images ul li {
        margin: 5px;
        padding: 10px;
        border: 2px solid #eee;
        cursor: pointer;
        transition: all 0.5s
    }

    .thumbnail_images ul li:hover {
        border: 2px solid #000
    }

    .main_image {
        display: flex;
        justify-content: center;
        align-items: center;
        border-bottom: 1px solid #eee;
        height: 400px;
        width: 100%;
        overflow: hidden
    }

    .heart {
        height: 29px;
        width: 29px;
        background-color: #eaeaea;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center
    }

    .content p {
        font-size: 12px
    }

    .ratings span {
        font-size: 14px;
        margin-left: 12px
    }

    .colors {
        margin-top: 5px
    }

    .colors ul {
        list-style: none;
        display: flex;
        padding-left: 0px
    }

    .colors ul li {
        height: 20px;
        width: 20px;
        display: flex;
        border-radius: 50%;
        margin-right: 10px;
        cursor: pointer
    }

    .colors ul li:nth-child(1) {
        background-color: #6c704d
    }

    .colors ul li:nth-child(2) {
        background-color: #96918b
    }

    .colors ul li:nth-child(3) {
        background-color: #68778e
    }

    .colors ul li:nth-child(4) {
        background-color: #263f55
    }

    .colors ul li:nth-child(5) {
        background-color: black
    }

    .right-side {
        position: relative
    }

    .search-option {
        position: absolute;
        background-color: #000;
        overflow: hidden;
        align-items: center;
        color: #fff;
        width: 200px;
        height: 200px;
        border-radius: 49% 51% 50% 50% / 68% 69% 31% 32%;
        left: 30%;
        bottom: -250px;
        transition: all 0.5s;
        cursor: pointer
    }

    .search-option .first-search {
        position: absolute;
        top: 20px;
        left: 90px;
        font-size: 20px;
        opacity: 1000
    }

    .search-option .inputs {
        opacity: 0;
        transition: all 0.5s ease;
        transition-delay: 0.5s;
        position: relative
    }

    .search-option .inputs input {
        position: absolute;
        top: 200px;
        left: 30px;
        padding-left: 20px;
        background-color: transparent;
        width: 300px;
        border: none;
        color: #fff;
        border-bottom: 1px solid #eee;
        transition: all 0.5s;
        z-index: 10
    }

    .search-option .inputs input:focus {
        box-shadow: none;
        outline: none;
        z-index: 10
    }

    .search-option:hover {
        border-radius: 0px;
        width: 100%;
        left: 0px
    }

    .search-option:hover .inputs {
        opacity: 1
    }

    .search-option:hover .first-search {
        left: 27px;
        top: 25px;
        font-size: 15px
    }

    .search-option:hover .inputs input {
        top: 20px
    }

    .search-option .share {
        position: absolute;
        right: 20px;
        top: 22px
    }

    .buttons .btn {
        height: 50px;
        width: 150px;
        border-radius: 0px !important
    }
</style>