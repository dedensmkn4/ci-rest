  <section class="page-section" id="contact">
    <div class="container">

      <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Booking</h2>

      <!-- Icon Divider -->
      <div class="divider-custom">
        <div class="divider-custom-line"></div>
        <div class="divider-custom-icon">
          <i class="fas fa-star"></i>
        </div>
        <div class="divider-custom-line"></div>
      </div>

      <div class="row">
        <div class="col-lg-8 mx-auto">
          <form name="sentBooking" id="bookingForm" novalidate="novalidate">
            <div class="control-group">
              <div class="form-group floating-label-form-group controls mb-0 pb-2">
                <label>Full Name</label>
                <input class="form-control" id="name" type="text" placeholder="Full Name" required="required" data-validation-required-message="Please enter your name.">
                <p class="help-block text-danger"></p>
              </div>
            </div>
            <div class="control-group">
              <div class="form-group floating-label-form-group controls mb-0 pb-2">
                <label>Date of birth</label>
                <input class="form-control datepicker"  data-provide="datepicker" id="dateofbirth" type="tel" placeholder="Date of birth" required="required" data-validation-required-message="Please enter your date of birth.">
                <p class="help-block text-danger"></p>
              </div>
            </div>
            <div class="control-group">
              <div class="form-group floating-label-form-group controls mb-0 pb-2">
                <label>Email Address</label>
                <input class="form-control" id="email" type="email" placeholder="Email Address" required="required" data-validation-required-message="Please enter your email address.">
                <p class="help-block text-danger"></p>
              </div>
            </div>
            <div class="control-group">
              <div class="form-group form-check floating-label-form-group controls mb-0 pb-2">
                <input class="form-check-input" type="checkbox" value="1" id="invalidCheck266" required="required" data-validation-required-message="Please checkbox to continue proccess">
                 <label class="form-check-label" for="invalidCheck266">Agree to terms and conditions</label>
                <p class="help-block text-danger"></p>
              </div>
            </div>
            <br>
            <div id="success"></div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-xl" id="sendBooking">Booking</button>
            </div>
          </form>
        </div>
      </div>

    </div>
  </section>

  <script src="<?php echo base_url('resources/js/bootstrap-datepicker.min.js') ?>"></script>
  <script src="<?php echo base_url('resources/js/jqBootstrapValidation.js') ?>"></script>
 <?php $this->load->view("frontend/assets/js/booking.php"); ?>

