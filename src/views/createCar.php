<body style="background: aliceblue">
<div class="container">
    <div class="container-fluid" style="width: 50%; height: 600px; background: gainsboro; border-radius: 5%; border: solid 1px black">
        <form class="form-signin" action="storeCar" method="post" enctype="multipart/form-data">
            <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72"
                 height="72">
            <h1 class="h3 mb-3 font-weight-normal">Create a car</h1>
            <?php
            if ($data != null && array_key_exists('errors', $data)) {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    ' . $data["errors"] . '
                  </div>';
            }
            ?>
            <div class="container-fluid content" style="width: 70%; height: 500px; border-top: 20px">
                <label for="username" class="sr-only">Name: </label>
                <input type="text" id="name" name="name"
                       class="form-control "
                       placeholder="Name" value="<?= $data['name'] ?? '' ?>">
                <p><?= $data['error']['name'] ?? '' ?></p>
                <label for="price" class="sr-only">Price: </label>
                <input type="number" id="price" name="price"
                       class="form-control "
                       placeholder="13000000000" value="<?= $data['price'] ?? '' ?>">
                <p><?= $data['error']['price'] ?? '' ?></p>
                <label for="brand" class="sr-only">Brand: </label>
                <input type="text" id="brand" name="brand"
                       class="form-control "
                       placeholder="brand" value="<?= $data['brand'] ?? '' ?>">
                <p><?= $data['error']['brand'] ?? '' ?></p>
                <label for="picture" class="sr-only">Picture: </label>
                <input type="file" id="picture" name="picture"
                       class="form-control "
                       placeholder="picture" value="<?= $data['picture'] ?? '' ?>">
                <button class="btn btn-lg btn-primary btn-block" type="submit">Create</button>
            </div>
        </form>
    </div>
</div>
</body>