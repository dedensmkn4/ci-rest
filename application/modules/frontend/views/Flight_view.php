   <!-- About Section -->
  <section class="page-section bg-primary text-white mb-0">
    <div class="container">

      <!-- About Section Heading -->
      <h2 class="page-section-heading text-center text-uppercase text-white">Flight</h2>

      <!-- Icon Divider -->
      <div class="divider-custom divider-light">
        <div class="divider-custom-line"></div>
        <div class="divider-custom-icon">
          <i class="fas fa-star"></i>
        </div>
        <div class="divider-custom-line"></div>
      </div>

      <!-- About Section Content -->
      <div class="row">
      <?php 	
      			if($rest['status']){
	      			if($rest['status_code']==200){
						foreach ($rest['data'] as $k => $v) {
							echo '<div class="col-lg-6 ml-auto">';
							echo '<p>Tujuan '.$v['origin_airport_name'].' - '.$v['destination_airport_name'].'</p>';
							echo '<br>';
							echo '<p>Menggunakan Maskapai '.$v['airline_name'].' Tersedia '.$v['stock'].' Tiket</p>';
							echo '<a class="btn btn-xl btn-outline-light" href="'.base_url('frontend/booking/'.$v['code']).'">';
							echo '<i class="fas fa-download mr-2"></i> Booking</a>';
							echo '</div>';
						}
					}
				}
				else{
					echo '<div class="alert alert-error"> <strong>Error! </strong>'.$rest['message'].'</div>';					
				}
	   ?>
      </div>

    </div>
  </section>
