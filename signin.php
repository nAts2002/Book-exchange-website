<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGN IN</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

</head>
<body>
    <div class="d-flex justify-content-center align-items-center"
         style="min-height:100vh;">
        <form class="p-5 rounded shadow"
              style="max-width:30rem; width:100%"
              method="POST"
              action="php/signin.php">
            <h1 class="text-center display-4 pb-5">SIGNIN</h1>
                <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger" role="alert">
                <?=htmlspecialchars($_GET['error']); ?>
            </div>
            <?php } ?>
            <?php if (isset($_GET['success'])) { ?>
            <div class="alert alert-success" role="alert">
                <?=htmlspecialchars($_GET['success']); ?>
            </div>
            <?php } ?>
            <div class="form-group">
                <label for="exampleInputEmail1">Email*</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password*</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="form-group">
                <label for="exampleInputName">Name*</label>
                <input type="text" name="name" class="form-control" id="exampleInputName">
            </div>
            <div class="form-group">
                <label for="exampleInputAddress">Address*</label>
                <input type="text" name="address" class="form-control" id="exampleInputAddress">
            </div>
            <div class="form-group">
                <label for="exampleInputNum">Phone number*</label>
                <input type="text" name="phone_num" class="form-control" id="exampleInputNum">
            </div>
            <div class="form-group">
                <label for="exampleInputContact">Another Contact</label>
                <input type="text" name="contact" class="form-control" id="exampleInputContact">
            </div>
            <button type="submit" class="btn btn-primary">Sign in</button>
            <a href="index.php">Home</a>
        </form>
    </div>
</body>
</html>