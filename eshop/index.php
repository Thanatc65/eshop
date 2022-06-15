<?php
require_once("server.php");

$product = mysqli_query($conn, "SELECT * FROM products");

// Regist Form
if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $uid = $_POST["uid"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password1 = $_POST["password1"];
    $password2 = $_POST["password2"];

    if ($password1 != $password2) {
        echo '<script>alert("Password not match");</script>';
    } else {
        echo '<script>alert("Regist Success");</script>';
        $query = mysqli_query($conn, "INSERT into users(uid,name,lastname,email,username,password) 
        value('$uid','$name','$lastname','$email','$username','$password1')");
    }
}

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $find = mysqli_query($conn, "SELECT * FROM users Where username = '$username' AND password = '$password'");

    if (mysqli_num_rows($find) == 1) {
        $all = mysqli_fetch_array($find);
        $_SESSION["uid"] = $all['uid'];
        $_SESSION["a_name"] = $all['name'];

        echo '<script>alert("Login success");</script>';
        header("Location: store.php");
    } else {
        echo '<script>alert("Wrong Username or Password");</script>';
    }
}
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
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand ml-4" href="#">E-SHOP</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav p-2 ml-auto">
                <li class="nav-item active">
                    <a class="nav-link ml-4" href="index.php">Store</a>
                </li>
                <li class="nav-item ml-4 mr-5">
                    <a class="nav-link" data-toggle="modal" data-target="#exampleModal" href="#">Login</a>
                </li>
            </ul>
        </div>
    </nav>

    <!--Login Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">Login</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="index.php" method="POST">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Enter username">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Enter Password">
                            <small>Don't have account ?
                                <a href="#" data-toggle="modal" data-target="#ModalCenter"> Sing up </a>
                                now</small>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="login" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container" align="center">
        <!--Regist Modal -->
        <div class="modal fade" id="ModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLongTitle">Sing Up</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" align="left">
                        <form action="index.php" method="POST">
                            <input type="text" name="uid" id="uid" style="display: none;">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter name">
                            </div>
                            <div class="form-group">
                                <label>Lastname</label>
                                <input type="text" name="lastname" class="form-control" placeholder="Enter lastname">
                            </div>
                            <div class="form-group">
                                <label>email</label>
                                <input :key="aa" type="email" name="email" class="form-control" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Enter username">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password1" class="form-control" placeholder="Enter password">
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" name="password2" class="form-control" placeholder="Enter password">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-primary">Regist</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- product item -->
    <div class="container">
        <h1 class="mt-5">Product</h1>
        <hr>
    </div>
    <div class="container">
        <div class="row">
            <?php while ($row = mysqli_fetch_array($product)) { ?>
                <div class="col-sm-3 mt-3">
                    <div class="card">
                        <img class="card-img-top img-fluid" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['img']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row["p_name"]; ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?php echo $row["a_name"]; ?></h6>
                            <h5 class="text-right mt-4">Price : <span class="text-primary"><?php echo $row["p_price"]; ?></span> Baht</h5>
                            <button class="btn btn-primary mt-4 text-center w-100" data-toggle="modal" data-target="#alertM">Add Cart</button>
                            <a href="#" id="<?php echo $row["id"]; ?>" class="d-flex justify-content-center text-secondary show_detail">Details</a>
                        </div>
                    </div>+
                </div>
            <?php } ?>
        </div>
    </div>

    <!--Alert Modal -->
    <div class="modal fade" id="alertM" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Alert</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h3 class="text-center">Can't add cart please Login first</h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#exampleModal">Go to Login</button>
                </div>
            </div>
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

    <script>
        window.onload = doStuff();

        function doStuff() {
            var e = document.getElementById("uid");
            e.value = Math.floor((Math.random() * 1000000000) + 2);
            e.style.display = "none";
        }
    </script>
</body>
<script>
    $(document).ready(function() {
        $(".show_detail").click(function() {
            var uid = $(this).attr("id");
            $.ajax({
                url: "show.php",
                method: "post",
                data: {
                    id: uid
                },
                success: function(data) {
                    $('#detail').html(data);
                    $('#dModal').modal('show');
                }
            })
        })
    })
</script>

</html>