<nav class="navbar bg-light">
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/"><h5>Home</h5></a></li>
            </ol>
        </nav>
    </div>
</nav>
<div class="container">
    <div class="container-fluid">
        <div class="row">
            <?php foreach ($data['cars'] as $car) { ?>
                <div class="col-sm-4">
                    <div class="card" style="width: 22rem;">
                        <img src="<?= $car['picture'] ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?= $car['name'] ?></h5>
                            <p class="card-text"><?= $car['price'] ?>000</p>
                            <p class="card-text"><?= $car['brand'] ?></p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

