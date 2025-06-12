<template>
  <footer class="bg-success text-white py-5">
    <div class="container">
      <div class="row g-4">
        <!-- Venue Info -->
        <div class="col-lg-4 col-md-6">
          <h5 class="fw-bold mb-3">
            <i class="fas fa-dumbbell me-2"></i>SportVenue
          </h5>
          <p class="mb-3">
            Modern sports facility with premium courts and equipment for all your athletic needs.
          </p>
          <div class="d-flex flex-wrap gap-2">
            <span class="badge bg-light text-dark">5 Courts</span>
            <span class="badge bg-light text-dark">Open 24/7</span>
            <span class="badge bg-light text-dark">Pro Equipment</span>
          </div>
        </div>

        <!-- Facilities -->
        <div class="col-lg-2 col-md-6">
          <h6 class="fw-semibold mb-3">Facilities</h6>
          <ul class="list-unstyled">
            <li v-for="facility in facilities" :key="facility" class="mb-2">
              <a href="#" class="text-white-50 text-decoration-none">{{ facility }}</a>
            </li>
          </ul>
        </div>

        <!-- Services -->
        <div class="col-lg-2 col-md-6">
          <h6 class="fw-semibold mb-3">Services</h6>
          <ul class="list-unstyled">
            <li v-for="service in services" :key="service" class="mb-2">
              <a href="#" class="text-white-50 text-decoration-none">{{ service }}</a>
            </li>
          </ul>
        </div>

        <!-- Contact & Booking -->
        <div class="col-lg-4 col-md-6">
          <h6 class="fw-semibold mb-3">Contact & Book</h6>
          <div class="mb-3">
            <p class="mb-2">
              <i class="fas fa-map-marker-alt me-2"></i>
              123 Sports Street, City Center
            </p>
            <p class="mb-2">
              <i class="fas fa-phone me-2"></i>
              <a href="tel:+1234567890" class="text-white text-decoration-none">(123) 456-7890</a>
            </p>
            <p class="mb-2">
              <i class="fas fa-envelope me-2"></i>
              <a href="mailto:info@sportzone.com" class="text-white text-decoration-none">info@sportzone.com</a>
            </p>
          </div>
          <button class="btn btn-light w-100 mb-2" @click="openBooking">
            <i class="fas fa-calendar-check me-2"></i>Book Court Now
          </button>
          <p class="text-center small text-white-50">Quick & easy online booking</p>
        </div>
      </div>

      <!-- Operating Hours -->
      <div class="bg-dark bg-opacity-25 rounded p-4 mt-4">
        <h6 class="text-center mb-3">Operating Hours</h6>
        <div class="row text-center">
          <div class="col-md-4 mb-2">
            <strong>Mon - Thu</strong><br>
            <span class="text-warning">6AM - 11PM</span>
          </div>
          <div class="col-md-4 mb-2">
            <strong>Fri - Sat</strong><br>
            <span class="text-warning">24 Hours</span>
          </div>
          <div class="col-md-4 mb-2">
            <strong>Sunday</strong><br>
            <span class="text-warning">7AM - 10PM</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Social & Newsletter -->
    <div class="border-top border-white border-opacity-25 mt-4 pt-4">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6 mb-3 mb-md-0">
            <div class="d-flex align-items-center justify-content-center justify-content-md-start">
              <span class="me-3">Follow us:</span>
              <div class="d-flex gap-2">
                <a href="#" class="btn btn-outline-light btn-sm">
                  <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="btn btn-outline-light btn-sm">
                  <i class="fab fa-instagram"></i>
                </a>
                <a href="#" class="btn btn-outline-light btn-sm">
                  <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="btn btn-outline-light btn-sm">
                  <i class="fab fa-youtube"></i>
                </a>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="input-group">
              <input
                type="email"
                class="form-control"
                placeholder="Get updates & offers"
                v-model="email"
              >
              <button class="btn btn-light" @click="subscribe">
                <i class="fas fa-paper-plane"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Bottom -->
    <div class="border-top border-white border-opacity-25 mt-4 pt-3">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6 text-center text-md-start">
            <p class="mb-0 text-white-50">© 2024 SportZone Arena. All rights reserved.</p>
          </div>
          <div class="col-md-6 text-center text-md-end">
            <a href="#" class="text-white-50 text-decoration-none me-3">Privacy</a>
            <a href="#" class="text-white-50 text-decoration-none me-3">Terms</a>
            <a href="#" class="text-white-50 text-decoration-none">Support</a>
          </div>
        </div>
      </div>
    </div>
  </footer>
</template>

<script>
export default {
  name: 'SportsVenueFooter',
  data() {
    return {
      email: '',
      facilities: ['Basketball', 'Tennis', 'Badminton', 'Volleyball', 'Fitness Center'],
      services: ['Court Booking', 'Equipment Rental', 'Personal Training', 'Group Classes', 'Events']
    }
  },
  methods: {
    openBooking() {
      this.$emit('open-booking');
    },
    subscribe() {
      if (this.email) {
        this.$emit('newsletter-subscribe', this.email);
        this.email = '';
      }
    }
  }
}
</script>

<style scoped>
a:hover {
  opacity: 0.8;
}

.btn-outline-light:hover {
  transform: translateY(-1px);
}
</style>
