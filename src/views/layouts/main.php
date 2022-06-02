<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>CarForRent - Sayno</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="/public/bootstrap/assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="/public/bootstrap/css/styles.css" rel="stylesheet" />
</head>

<body class="text-center">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="/"><?php if (isset($_SESSION['username'])) {
                    echo $_SESSION['username'];
                ?>

                                             <?php } else {
                                                 echo 'Welcome';
                                             } ?></a></h1></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="/">Home</a></li>
                </ul>
                <?php if (!isset($_SESSION['user_id'])) {
                    echo '<a class="nav-link active" aria-current="page" href="/login">Login</a>
                            <a class="nav-link active" aria-current="page" href="/createUser">Register</a>';
                    ?>
                <?php } else {
                    echo '
                    <a class="nav-link active" aria-current="page" href="/createCar">Create Car</a>
                    <form action="/logout" method="post">
                        <button class="btn btn-outline-primary" type="submit">logout</button>
                    </form>';
                } ?>
            </div>
        </div>
    </nav>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="/public/bootstrap/js/scripts.js"></script>
</body>
</html>
