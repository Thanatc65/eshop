<?php
include("server.php");

$uid = $_SESSION['uid'];
$cart = mysqli_query($conn, "SELECT * from carts WHERE uid = '$uid'");

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $query = mysqli_query($conn, "SELECT * from products WHERE id = '$id'");

    if (mysqli_num_rows($query) > 0) {
        $sel = mysqli_fetch_array($query);

        $name = $sel["p_name"];
        $price = $sel["p_price"];
        $aname = $sel["a_name"];

        $add = mysqli_query($conn, "INSERT INTO carts(uid , p_name , p_price , a_name ,pid) 
    value('$uid', '$name', '$price', '$aname','$id')");

        header("Location:cart.php");
    }
}

if (isset($_GET["del"])) {
    $delid = $_GET["del"];

    mysqli_query($conn, "DELETE FROM carts WHERE id = $delid");

    header("Location:cart.php");
}

if (isset($_POST["pay"])) {

    mysqli_query($conn, "DELETE FROM carts WHERE uid = $uid");
    header("Location:cart.php");

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="path/to/fontawesome.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .fa-check-circle{
        color: 	#00FF7F;
    }
</style>

<body style="background-color: #eee;">
    <?php
    include("nav.php");
    ?>
    <section>
        <div class="container h-100 py-5">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-10">

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="fw-normal mb-0 text-black">Shopping Cart</h3>
                        <div>
                            <p class="mb-0"><span class="text-muted">Sort by:</span> <a href="#!" class="text-body">price <i class="fas fa-angle-down mt-1"></i></a></p>
                        </div>
                    </div>

                    <?php while ($row = mysqli_fetch_array($cart)) { ?>

                        <div class="card rounded-3 mb-4">
                            <div class="card-body p-4">
                                <div class="row d-flex justify-content-between align-items-center">
                                    <?php
                                    $id = $row["pid"];
                                    $img = mysqli_query($conn, "SELECT * from products where id = '$id'");
                                    $i = mysqli_fetch_assoc($img);

                                    if ($id != 0) { ?>
                                        <div class="col-md-2 col-lg-2 col-xl-2">
                                            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($i['img']); ?>" class="img-fluid rounded-3" alt="Cotton T-shirt">
                                        </div>
                                    <?php } ?>
                                    <div class="col-md-3 col-lg-3 col-xl-3">
                                        <p class="lead fw-normal mb-2"><?php echo $row["p_name"] ?></p>
                                        <p><span class="text-muted">By: <?php echo $row["a_name"] ?></span></p>
                                    </div>
                                    <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                        <input class="form-control form-control-sm text-center" value="1" readonly />
                                    </div>
                                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                        <h5 class="mb-0"><?php echo $row["p_price"] ?> baht</h5>
                                    </div>
                                    <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                        <a href="cart.php?del=<?php echo $row["id"] ?>" class="text-danger"><i class="fas fa-trash fa-lg"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="card">
                        <div class="card-body">
                            <button type="button" class="btn btn-primary btn-block btn-lg" data-toggle="modal" data-target="#exampleModal">Proceed to Pay</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Address</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="cart.php" method="post">
                        <label>Address</label>
                        <input type="text" class="form-control">
                        <label>Province</label>
                        <select class="form-control" aria-label="Default select example" id="p">
                            <option selected>Select province</option>
                            <option value="กรุงเทพมหานคร">Bangkok</option>
                            <option value="กระบี่">Krabi</option>
                            <option value="กาญจนบุรี">Kanchanaburi</option>
                            <option value="กาฬสินธุ์">Kalasin </option>
                            <option value="กำแพงเพชร">Kamphaeng Phet</option>
                            <option value="ขอนแก่น">Khon Kaen</option>
                            <option value="จันทบุรี">Chanthaburi</option>
                            <option value="etc">etc</option>
                        </select>
                        <div style="display: none;" id="etc">
                            <label>Province</label>
                            <input type="text">
                        </div>
                        <label>Post Code</label>
                        <input type="text" class="form-control">
                        <label>Phone Number</label>
                        <input type="text" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary pay" name="pay">Pay</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                <i class="fas fa-check-circle fa-10x d-flex justify-content-center mt-5"></i>
                <h2>Success</h2>
                <button type="button" class="btn btn-primary mt-5 w-100" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function(){
        $(".pay").click(function(){
            $("#successModal").modal('show');
        })
    })
</script>
</html>