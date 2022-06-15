<?php
$id = $_POST['id'];
$conn = mysqli_connect("localhost", "root", "", "eshop");

$product = mysqli_query($conn, "SELECT * FROM products where id ='$id'");
$st = mysqli_fetch_array($product);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="my_product.php" enctype="multipart/form-data" method="POST">
        <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $id ; ?>">
            <label>Product Name</label>
            <div>
                <input value="<?php echo $st["p_name"] ?>" type="text" name="name" class="form-control" placeholder="Product Name">
            </div>
        </div>
        <div>
            <label>Product Details</label>
            <div>
                <textarea value="<?php echo $st["p_detail"] ?>" class="form-control" name="details" rows="5" placeholder="Product Details" style="resize: none;"></textarea>
            </div>
        </div>
        <div class="mt-3">
            <label>Price</label>
            <div>
                <input value="<?php echo $st["p_price"] ?>" type="number" name="price" class="form-control" placeholder="Price">
            </div>
        </div>
        <div class="mt-5">
            <button type="submit" name="add" class="btn btn-primary btn-lg w-100 mt-5"><strong>Add Product</strong></button>
        </div>

    </form>
</body>

</html>