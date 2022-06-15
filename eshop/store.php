<?php
include("server.php");

$product = mysqli_query($conn, "SELECT * FROM products");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body style="background-color: #eee;">
    <?php
    include("nav.php");
    ?>
    <div class="container">
        <h1 class="mt-5">Product</h1>
        <hr>
    </div>
    <div class="container">
        <div class="row">
            <?php while ($row = mysqli_fetch_array($product)) { ?>
                <div class="col-sm-3 mt-3">
                    <div class="card">
                        <img class="card-img-top img-fluid h-25 w-auto" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['img']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row["p_name"]; ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?php echo $row["a_name"]; ?></h6>
                            <h5 class="text-right mt-4">Price : <span class="text-primary"><?php echo $row["p_price"]; ?></span> Baht</h5>
                            <a href="cart.php?id=<?php echo $row["id"]; ?>" name="cart" class="btn btn-primary mt-4 text-center w-100">Add Cart</a>
                            <a href="#" id="<?php echo $row["id"]; ?>" class="d-flex justify-content-center text-secondary show_detail">Details</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="modal fade" id="dModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Product Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="detail">

                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function(){
        $(".show_detail").click(function(){
            var uid=$(this).attr("id");
            $.ajax({
                url: "show.php",
                method: "post",
                data:{id:uid},
                success: function(data){
                    $('#detail').html(data);
                    $('#dModal').modal('show');
                }
            })
        })
    })
</script>

</html>