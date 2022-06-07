<!-- Header-->
<header class="bg-dark py-4">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Carforent - Diggory</h1>
            <p class="lead fw-normal text-white-50 mb-0">Here's the car you need</p>
        </div>
    </div>
</header>
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php foreach ($data['cars'] as $car) { ?>
                <div class="col mb-5">
                <div class="card h-100">
                    <!-- Product image-->
                    <img class="card-img-top" src="<?= $car['picture'] ?>" alt="..." />
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name-->
                            <div><h4 class="fw-bolder"><?= $car['name'] ?></h4></div>
                            <div>__________________________</div>
                            <br>
                            <!-- Product price-->
                            <div style="color: #bd2130"><h6>$<?= number_format($car['price']) ?>/day</h6></div>
                            <div><h6>Brand: <?= $car['brand'] ?></h6></div>
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="">RentCar</a></div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>

<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">Carforent &copy; Diggory.me</p></div>
</footer>

