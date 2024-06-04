
    
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
        <div class="g-signin2" data-onsuccess="onSignIn"></div>
<script>
    function onSignIn(googleUser) {
  var profile = googleUser.getBasicProfile();
  console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
  console.log('Name: ' + profile.getName());
  console.log('Image URL: ' + profile.getImageUrl());
  console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
}
</script>


    </form>
</div>
                    </div>

                </div>
            </div>
        </section>
    </main>

