<body style="background: aliceblue">
    <div class="container">
        <div class="container-fluid" style="width: 50%; height: 70%; background: gainsboro; border-radius: 5%; border: solid 1px black">
            <form class="form-signin" action="loginCheck" method="post">
                <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72"
                     height="72">
                <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
                <?php
                if ($data != null && array_key_exists('errors', $data)) {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    ' . $data["errors"] . '
                  </div>';
                }
                ?>
                <div class="container-fluid content" style="width: 70%; height: 80%; border-top: 20px">
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
                    <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
                </div>
            </form>
        </div>
    </div>
</body>
