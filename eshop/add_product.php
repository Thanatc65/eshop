<?php
include("server.php");

if (isset($_POST["add"])) {
    $uid = $_POST["uid"];
    $p_name = $_POST["name"];
    $p_details = $_POST["details"];
    $p_price = $_POST["price"];
    $a_name = $_POST["a_name"];

    $image = $_FILES['image']['tmp_name'];
    $img = file_get_contents($image);

    $sql = "INSERT into products(img , uid , p_name , p_detail , p_price ,a_name) 
            values(? ,'$uid','$p_name','$p_details','$p_price','$a_name')";
    $stmt = mysqli_prepare($conn, $sql);

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $img);
    mysqli_stmt_execute($stmt);

    echo '<script>alert("Add Product Success");</script>';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    include("nav.php");
    ?>
    <h1 align="center" class="mt-4">Add Product</h1>
    <div class="container mt-2">
        <hr>
        <form class="mt-5" enctype="multipart/form-data" method="POST">
            <div class="form-group row">
                <input type="hidden" name="uid" value="<?php echo $_SESSION['uid']; ?>">
                <input type="hidden" name="a_name" value="<?php echo $_SESSION['a_name']; ?>">
                <label class="col-sm-2 col-form-label">Product Name</label>
                <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" placeholder="Product Name">
                </div>
            </div>
            <div class="form-group row">
                <input type="hidden">
                <label class="col-sm-2 col-form-label">Product Details</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="details" rows="5" placeholder="Product Details" style="resize: none;"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Price</label>
                <div class="col-sm-10">
                    <input type="number" name="price" class="form-control" placeholder="Price">
                </div>
            </div>
            <div class="input-group">
                <label class="mr-4 pr-3">Product Image</label>
                <div class="custom-file ml-5">
                    <input type="file" class="custom-file-input" id="customFile" name="image">
                    <label class="custom-file-label"></label>
                </div>
            </div>
            <div class="mt-5">
                <button type="submit" name="add" class="btn btn-primary btn-lg w-100 mt-5"><strong>Add Product</strong></button>
            </div>

        </form>
    </div>
    <script>
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
</body>

</html>