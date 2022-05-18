<h1>Register Now</h1>
<form action="" method="post">
    <label for="username"> UserName: </label>
    <input type="text" name="username" value="<?php echo $model->username ?>"
           class="<?php echo $model->hasError('username') ? 'is-invalid' : '' ?>">
    <div>
        <?php echo $model->getFirstError('username') ?>
    </div>
    <label for="password"> Password: </label>
    <input type="password" name="password">
    <label for="confirmPassword"> confirmPassword: </label>
    <input type="password" name="confirmPassword">
    <button type="submit">submit</button>
</form>
