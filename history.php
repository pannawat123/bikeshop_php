<?php 
    require_once ('./config/database.php');

    $customerID = $_SESSION['cusID'];

    $queryStr = "SELECT * FROM salesdata WHERE CustomerID = '$customerID'";
    $data_sale = $db->query($queryStr);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BIKESHOP | HISTORY</title>
    <?php include_once ('./components/header.php'); ?>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

    <?php include_once ('./components/navbar.php') ?>
    

    <div class="container">

        <div class="w-full mt-14">

            <p class="text-xl my-3 ml-2 text-blue-700">ประวัติการสั่งซื้อ</p>

            <div class="overflow-x-auto relative">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="py-3 px-6 rounded-l-lg">
                                #
                            </th>
                            <th scope="col" class="py-3 px-6 rounded-l-lg">
                                ชื่อสินค้า
                            </th>
                            <th scope="col" class="py-3 px-6 text-center">
                                จำนวน
                            </th>
                            <th scope="col" class="py-3 px-6 rounded-r-lg text-center">
                                ราคาต่อชิ้น
                            </th>
                            <th scope="col" class="py-3 px-6 rounded-r-lg text-center">
                                ราคารวม
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $i = 1;
                            $total_price = 0;
                            while ($sale = $data_sale->fetch_assoc()):
                                // echo json_encode($sale);
                                $detail_id = $sale['DetailID'];
                                $detail = "SELECT * FROM detailsale WHERE DetailID = $detail_id";
                                $detail = $db->query($detail);
                                $detail = $detail->fetch_assoc();
                                
                                $product_id = $detail['ProductID'];
                                $product = "SELECT * FROM product WHERE ProductID = $product_id";
                                $product = $db->query($product);
                                $product = $product->fetch_assoc();
                                $total_price += floatval($detail['pricebaht']);
                        ?>
                            <tr class="bg-white dark:bg-gray-800">
                                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <?php echo $i++; ?>
                                </th>
                                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <?php echo $product['name']; ?>
                                </th>
                                <td class="py-4 px-6 text-center">
                                    <?php echo $detail['quantity']; ?>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <?php echo number_format($product['price']); ?>
                                </td>
                                <th class="py-4 px-6 text-center">
                                    <?php echo number_format($detail['pricebaht']); ?>
                                </th>
                            </tr>
                        <?php 
                            endwhile;
                        ?>
                    </tbody>
                    <tfoot class="border-y-2">
                        <tr class="font-semibold text-gray-900 dark:text-white">
                            <td colspan="3"></td>    
                            <th scope="row" class="py-3 px-6 text-base text-right">ยอมรวม</th>
                            <td class="underline text-red-800 py-3 px-6 text-center text-lg">
                                <?php echo number_format($total_price) ?>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>


            <div class="w-full mt-4 flex justify-center">
                <a href="./index.php" class="btn btn-secondary">กลับหน้าหลัก</a>
            </div>


        </div>
    
    </div>
    

</body>
</html>