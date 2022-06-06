<section class="py-5" style="background: #888a85">
    <div class="container" style="background: white; width: 40%; height: 700px;">
        <div class="container-fluid">
            <form class="form-signin" action="login" method="post">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRWds5526ohygFImcAhzDK-pqExf3ets--fYg&usqp=CAU" alt="" width="170"
                      height="150">
                <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>

                <div class="container-fluid content" style="width: 80%; height: 600px; border-top: 20px">
                    <?php
                    if ($data != null && array_key_exists('errors', $data)) {
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    ' . $data["errors"] . '
                  </div>';
                    }
                    ?>
                    <label for="username" class="sr-only">Username</label>
                    <input type="text" id="username" name="username"
                           class="form-control "
                           placeholder="Username" value="<?= $data['username'] ?? '' ?>">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" id="password" name="password"
                           class="form-control "
                           placeholder="Password">
                    <div class="checkbox mb-3">
                        <label>
                            <input type="checkbox" value="remember-me"> Remember me
                        </label>
                    </div>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                </div>
            </form>
        </div>
    </div>
</section>
<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">Carforent &copy; Diggory.me</p></div>
</footer>
