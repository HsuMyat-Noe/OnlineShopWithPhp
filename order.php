<?php include "widget/header.php" ?>

    <!-- Order Form Section -->
    <div class="container">
        <div class="row p-3">
            <div class="col-md-8 mx-auto p-3">
                <br>
                <h2 class="text-center text-white">
                    Fill this form for to confirm your order
                </h2>
                <br>
                <form action="" class="row g-3">
                    <fieldset class="border p-3 rounded-3 border-2">
                        <legend class="float-none w-auto p-2 text-white">Select Product</legend>

                        <div class="d-flex">
                            <img src="images/lipstick.svg" alt="Lip stick" class="w-25 h-25 rounded-3">
                            <div class="px-3">
                                <h3>Lipstick</h3>
                                <p>$ 2.5</p>

                                <label for="inputNumber" class="form-label">Items</label>
                                <input type="number" class="form-control w-25" min="1" value="1" id="inputNumber">
                            </div>
                        </div>

                    </fieldset>

                    <fieldset class="border p-3 rounded-3 border-2">

                        <legend class="float-none w-auto p-2 text-white">
                            Delivery Details
                        </legend>

                        <div class="col-md-12 ">
                            <label for="inputName" class="form-label text-white">Name</label>
                            <input type="text" class="form-control" id="inputName" placeholder="James">
                        </div>

                        <div class="col-md-12 ">
                            <label for="inputPhone" class="form-label text-white">Phone</label>
                            <input type="tel" class="form-control" id="inputPhone" placeholder="097979xxxxxx">
                        </div>

                        <div class="col-md-12 ">
                            <label for="inputEmail" class="form-label text-white">Email</label>
                            <input type="email" class="form-control" id="inputEmail" placeholder="someone@gmail.com">
                        </div>

                        <div class="col-md-12 ">
                            <label for="textarea" class="form-label text-white">Your Address </label>
                            <textarea class="form-control mt-3" placeholder="Your Address Details" id="textarea"
                                style="height: 150px;"></textarea>
                        </div>

                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <!-- Order Form Section -->

<?php include "widget/footer.php" ?>