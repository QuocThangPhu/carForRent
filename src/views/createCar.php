<section class="py-5" style="background: #888a85">
    <div class="container" style="background: white; width: 40%; height: 700px;">
    <div class="container-fluid">
        <form class="form-signin" action="storeCar" method="post" enctype="multipart/form-data">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRWds5526ohygFImcAhzDK-pqExf3ets--fYg&usqp=CAU" alt="" width="170"
                 height="150">

            <div class="container-fluid content" style="width: 80%; height: 700px; border-top: 20px">
                <h1 class="h3 mb-3 font-weight-normal">Create a car</h1>
                <?php

                if (isset($data['errors'])&& !is_array($data['errors'])) {
                    echo '<p class="alert alert-danger alert-dismissible fade show" style="color: red; font-style: italic">';
                    echo $data['errors'];
                    echo '</p>';
                }
                ?>
                <label for="username" class="sr-only">Name: </label>
                <input type="text" id="name" name="name"
                       class="form-control "
                       placeholder="Name" value="<?= $data['name'] ?? '' ?>">
                <?php
                if (isset($data['errors']['name'])) {
                    echo '<p class="errorMessage" style="color: red; font-style: italic">';
                    echo $data['errors']['name'];
                    echo '</p>';
                }
                ?>
                <label for="price" class="sr-only">Price: </label>
                <input type="number" id="price" name="price"
                       class="form-control "
                       placeholder="13000000000" value="<?= $data['price'] ?? '' ?>">
                <?php
                if (isset($data['errors']['price'])) {
                    echo '<p class="errorMessage" style="color: red; font-style: italic">';
                    echo $data['errors']['price'];
                    echo '</p>';
                }
                ?>
                <label for="brand" class="sr-only">Brand: </label>
                <input type="text" id="brand" name="brand"
                       class="form-control "
                       placeholder="brand" value="<?= $data['brand'] ?? '' ?>">
                <?php
                if (isset($data['errors']['brand'])) {
                    echo '<p class="errorMessage" style="color: red; font-style: italic">';
                    echo $data['errors']['brand'];
                    echo '</p>';
                }
                ?>
                <label for="picture" class="sr-only">Picture: </label>
                <input type="file" id="picture" name="picture"
                       class="form-control "
                       placeholder="picture" value="<?= $data['picture'] ?? '' ?>">
                <br>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Create</button>
            </div>
        </form>
    </div>
</div>
</section>

<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">Carforent &copy; Diggory.me</p></div>
</footer>
