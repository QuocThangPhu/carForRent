<body style="background: aliceblue">
<nav class="navbar bg-light">
</nav>
<div class="container">
    <div class="container-fluid" style="width: 50%; height: 80%; background: gainsboro; border-radius: 5%; border: solid 1px black">
        <form class="form-signin" action="/userCheck" method="post">
            <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72"
                 height="72">
            <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
            <?php
            if (isset($data['errors'])&& !is_array($data['errors'])) {
                echo '<p class="alert alert-danger alert-dismissible fade show" style="color: red; font-style: italic">';
                echo $data['errors'];
                echo '</p>';
            }
            ?>
            <div class="container-fluid content" style="width: 70%; height: 80%; border-top: 20px">
                <label for="username" class="sr-only">Username</label>
                <input type="text" id="username" name="username"
                       class="form-control "
                       placeholder="Username" value="<?= $data['username'] ?? '' ?>">
                <?php
                if (isset($data['errors']['username'])) {
                    echo '<p class="errorMessage" style="color: red; font-style: italic">';
                    echo $data['errors']['username'];
                    echo '</p>';
                }
                ?>
                <label for="password" class="sr-only">Password</label>
                <input type="password" id="password" name="password"
                       class="form-control "
                       placeholder="Password">
                <?php
                if (isset($data['errors']['password'])) {
                    echo '<p class="errorMessage" style="color: red; font-style: italic">';
                    echo $data['errors']['password'];
                    echo '</p>';
                }
                ?>
                <label for="passwordConfirm" class="sr-only">Password Confirm</label>

                <input type="password" id="passwordConfirm" name="passwordConfirm"
                       class="form-control "
                       placeholder="PasswordConfirm">
                <?php
                if (isset($data['errors']['confirmPassword'])) {
                    echo '<p class="errorMessage" style="color: red; font-style: italic">';
                    echo $data['errors']['confirmPassword'];
                    echo '</p>';
                }
                ?>
                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" value="remember-me"> Remember me
                    </label>
                </div>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Create Account</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
        </form>
    </div>
</div>
</body>
