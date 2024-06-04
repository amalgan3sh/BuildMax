
    
    <main class="main" id="top">
        <section class="py-8" id="user-types">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xxl-5 text-center mb-3">
                        <h6 class="fw-bold fs-4 display-3 lh-sm mb-3">Register as B2B Customer</h6>
                        <p class="mb-4">Fill out the form below to create your B2B customer account.</p>
                    </div>
                </div>
                <div class="row flex-center">
                    <div class="col-lg-6">
                    <div class="card-body mx-auto">
    <form action="<?php echo base_url('b2b_register_process'); ?>" method="POST">
        <div class="mb-3">
            <label for="companyName" class="form-label">Company Name</label>
            <input type="text" class="form-control" id="companyName" name="companyName" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-lg btn-primary rounded-pill">Register</button>
    </form>
</div>
                    </div>

                </div>
            </div>
        </section>
    </main>

