<section class="py-5" style="background: #888a85">
    <div class="container" style="background: white; width: 40%; height: 700px;">
        <div class="container-fluid">
        <form class="form-signin" action="/register" method="post">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRWds5526ohygFImcAhzDK-pqExf3ets--fYg&usqp=CAU" alt="" width="170"
                 height="150">
            <h1 class="h3 mb-3 font-weight-normal">Register</h1>
            <?php
            if (isset($data['errors']) && !is_array($data['errors'])) {
                echo '<p class="alert alert-danger alert-dismissible fade show" style="color: red; font-style: italic">';
                echo $data['errors'];
                echo '</p>';
            }
            ?>
            <div class="container-fluid content" style="width: 80%; height: 500px; border-top: 20px">
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
                <button class="btn btn-lg btn-primary btn-block" type="submit">Create Account</button>
            </div>
        </form>
    </div>
</div>
</section>
<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">Carforent &copy; Diggory.me</p></div>
</footer>
