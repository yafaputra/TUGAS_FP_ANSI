



<template>
  <div class="container-fluid px-0">
    <!-- Improved Hero Section -->
    <section class="hero-section position-relative overflow-hidden">
      <div class="hero-container mx-auto">
        <div class="hero-image-container rounded-4 overflow-hidden">
          <img src="https://images.unsplash.com/photo-1544717297-fa95b6ee9643?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2069&q=80" 
               alt="Badminton Court" class="hero-image w-100 h-100 object-fit-cover">
          <div class="hero-overlay"></div>
          <div class="hero-badge">
            <span class="text-white small">Lihat semua foto</span>
          </div>
        </div>
      </div>
    </section>

    <div class="container mt-4">
      <div class="row g-4">
        <!-- Left Content -->
        <div class="col-lg-8">
          <!-- Venue Header -->
          <div class="venue-header mb-4">
            <h1 class="display-5 fw-bold text-dark mb-2">Metro Atom Futsal Badminton</h1>
            <div class="d-flex align-items-center mb-3">
              <span class="rating-badge me-3">
                <i class="bi bi-star-fill text-warning me-1"></i>
                <span class="fw-bold">4.8</span>
                <span class="text-muted ms-1">(128 reviews)</span>
              </span>
              <span class="text-muted">
                <i class="bi bi-geo-alt-fill me-1"></i>
                Kota Jakarta Pusat, DKI Jakarta
              </span>
            </div>
            <div class="d-flex flex-wrap gap-2">
              <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 py-2 px-3 rounded-pill">
                <i class="bi bi-lightning-charge me-1"></i>Futsal
              </span>
              <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 py-2 px-3 rounded-pill">
                <i class="bi bi-trophy me-1"></i>Badminton
              </span>
              <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 py-2 px-3 rounded-pill">
                <i class="bi bi-people-fill me-1"></i>Lapangan Indoor
              </span>
            </div>
          </div>

          <!-- Description Section -->
          <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
              <h3 class="h4 text-success mb-3">
                <i class="bi bi-info-circle me-2"></i>Deskripsi
              </h3>
              <p class="text-muted mb-3">
                Metro Atom Futsal Badminton menyediakan fasilitas olahraga berkualitas tinggi dengan lapangan standar internasional. 
                Dilengkapi dengan sistem pencahayaan optimal dan lantai berkualitas premium untuk pengalaman bermain terbaik.
              </p>
              <p class="text-muted">
                Lokasi strategis di pusat kota dengan akses mudah dan fasilitas lengkap termasuk area parkir luas, kantin, dan ruang ganti yang nyaman.
              </p>
              
              <div class="mt-4">
                <h5 class="text-success mb-3">Fasilitas Utama</h5>
                <div class="row">
                  <div class="col-md-6" v-for="(facility, index) in facilities" :key="index">
                    <div class="d-flex align-items-center mb-3">
                      <i class="bi bi-check-circle-fill text-success me-2"></i>
                      <span class="text-muted">{{ facility }}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Venue Rules -->
          <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
              <h3 class="h4 text-success mb-3">
                <i class="bi bi-clipboard-check me-2"></i>Aturan Venue
              </h3>
              <div class="row g-3">
                <div class="col-12" v-for="(rule, index) in venueRules" :key="index">
                  <div class="d-flex align-items-start bg-light p-3 rounded-3">
                    <div class="rule-number me-3">{{ index + 1 }}.</div>
                    <span class="text-muted">{{ rule }}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Location Info -->
          <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
              <h3 class="h4 text-success mb-3">
                <i class="bi bi-geo-alt-fill me-2"></i>Lokasi & Akses
              </h3>
              <div class="bg-success bg-opacity-10 p-4 rounded-3 border border-success border-opacity-25">
                <h5 class="text-success mb-3">Alamat Lengkap</h5>
                <p class="text-muted mb-2">
                  <i class="bi bi-building me-2"></i>
                  Pd Pasar Jaya Pasar Baru Metro Atom Plaza Lt. B (Gedung Parkir) Jakarta Pusat
                </p>
                <p class="text-muted mb-4">
                  <i class="bi bi-clock me-2"></i>
                  <span class="fw-semibold">24 Jam</span> - Buka setiap hari
                </p>
                
                <div class="map-container rounded-3 overflow-hidden mb-3">
                  <img src="https://maps.googleapis.com/maps/api/staticmap?center=-6.1754,106.8272&zoom=15&size=800x300&maptype=roadmap&markers=color:red%7C-6.1754,106.8272&key=YOUR_API_KEY" 
                       alt="Location Map" class="img-fluid w-100">
                </div>
                
                <div class="d-flex flex-wrap gap-2">
                  <button class="btn btn-success rounded-pill px-3">
                    <i class="bi bi-map me-1"></i>Buka di Google Maps
                  </button>
                  <button class="btn btn-outline-success rounded-pill px-3">
                    <i class="bi bi-compass me-1"></i>Petunjuk Arah
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Right Sidebar -->
        <div class="col-lg-4">
          <!-- Pricing Card -->
          <div class="card border-0 shadow-sm pricing-card mb-4 sticky-top">
            <div class="card-body p-4">
              <h4 class="text-dark mb-4">Pesan Lapangan</h4>
              
              <div class="price-section mb-4">
                <p class="text-muted small mb-1">Mulai dari</p>
                <div class="d-flex align-items-baseline">
                  <span class="h3 fw-bold text-success mb-0">Rp 70.000</span>
                  <span class="text-muted ms-2 small">/sesi</span>
                </div>
                <p class="text-muted small mt-1">*Harga dapat berubah di hari tertentu</p>
              </div>
              <button class="btn btn-success btn-lg w-100 fw-bold mb-3 py-3">
                <i class="bi bi-calendar-check me-2"></i>Pesan Sekarang
              </button>
            </div>
          </div>          

          
        </div>
      </div>

      <!-- Photo Gallery Section -->
      <div class="row mt-5">
        <div class="col-12">
          <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
              <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="h4 text-success mb-0">
                  <i class="bi bi-images me-2"></i>Galeri Foto
                </h3>
                <a href="#" class="small text-success">Lihat Semua</a>
              </div>
              <div class="row g-3">
                <div class="col-6 col-md-4 col-lg-3" v-for="(photo, index) in photoGallery" :key="index">
                  <div class="gallery-item position-relative rounded-3 overflow-hidden" 
                       @click="openPhotoModal(photo)">
                    <img :src="photo.url" :alt="photo.title" class="img-fluid gallery-image">
                    <div class="gallery-overlay">
                      <div class="gallery-content">
                        <i class="bi bi-zoom-in text-white"></i>
                        <p class="text-white small mt-2 mb-0">{{ photo.title }}</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'MetroAtomVenueBooking',
  data() {
    return {
      bookingDate: null,
      selectedSession: null,
      venueRules: [
        'Pelanggan harus datang tepat waktu sesuai jadwal booking',
        'Dilarang membawa air mineral dalam kemasan gelas',
        'Dilarang bersandar atau memegang jaring lapangan',
        'Dilarang membawa senjata tajam dan minuman beralkohol',
        'Wajib menggunakan sepatu olahraga yang sesuai (dilarang sepatu berdempul)',
        'Bertanggung jawab atas kerusakan alat/barang yang disewa',
        'Dilarang merokok di area dalam ruangan'
      ],
      facilities: [
        '3 Lapangan Futsal Standar Internasional',
        '6 Lapangan Badminton',
        'Pencahayaan LED High Quality',
        'Lantai Vinyl Professional',
        'Parkir Luas (100+ mobil)',
        'Ruang Ganti & Kamar Mandi',
        'Kantin & Area Istirahat',
        'Free WiFi'
      ],
      availableSessions: [
        { time: '08:00 - 10:00', price: 'Rp 70.000' },
        { time: '10:00 - 12:00', price: 'Rp 80.000' },
        { time: '12:00 - 14:00', price: 'Rp 90.000' },
        { time: '14:00 - 16:00', price: 'Rp 100.000' },
        { time: '16:00 - 18:00', price: 'Rp 120.000' },
        { time: '18:00 - 20:00', price: 'Rp 150.000' },
        { time: '20:00 - 22:00', price: 'Rp 120.000' }
      ],
      photoGallery: [
        {
          title: 'Lapangan Futsal Utama',
          url: 'https://images.unsplash.com/photo-1544717297-fa95b6ee9643?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'
        },
        {
          title: 'Lapangan Badminton',
          url: 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'
        },
        {
          title: 'Area Kantin',
          url: 'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'
        },
        {
          title: 'Area Parkir',
          url: 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'
        },
        {
          title: 'Ruang Ganti',
          url: 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'
        },
        {
          title: 'Area Reception',
          url: 'https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'
        }
      ],
      testimonials: [
        {
          name: 'Budi Santoso',
          rating: 5,
          comment: 'Lapangan sangat nyaman dengan lantai yang empuk. Pencahayaan juga sangat bagus untuk bermain malam hari.'
        },
        {
          name: 'Anita Wijaya',
          rating: 4,
          comment: 'Pelayanan staff sangat ramah. Area parkir luas dan aman. Hanya saja harga weekend agak mahal.'
        },
        {
          name: 'Rudi Hartono',
          rating: 5,
          comment: 'Tempat favorit saya buat futsal tiap minggu. Lapangan selalu dalam kondisi terawat.'
        }
      ]
    }
  },
  methods: {
    openPhotoModal(photo) {
      // In a real app, this would open a modal with the photo
      console.log('Opening photo:', photo.title);
    },
    bookNow() {
      // Booking logic would go here
      console.log('Booking requested for:', this.bookingDate, this.selectedSession);
    }
  },
  mounted() {
    // Set default booking date to tomorrow
    const tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    this.bookingDate = tomorrow.toISOString().split('T')[0];
    this.selectedSession = this.availableSessions[0];
  }
}
</script>

<style scoped>
/* Improved Hero Section */
.hero-section {
  padding: 2rem 0;
  background: #f8f9fa;
}

.hero-container {
  max-width: 1200px;
  padding: 0 1rem;
}

.hero-image-container {
  position: relative;
  height: 400px;
  width: 100%;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

.hero-image {
  transition: transform 0.3s ease;
}

.hero-image-container:hover .hero-image {
  transform: scale(1.02);
}

.hero-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(to bottom, 
              rgba(0, 0, 0, 0.1) 0%, 
              rgba(0, 0, 0, 0.05) 50%,
              rgba(0, 0, 0, 0.1) 100%);
}

.hero-badge {
  position: absolute;
  bottom: 20px;
  right: 20px;
  background: rgba(0, 0, 0, 0.7);
  padding: 6px 12px;
  border-radius: 20px;
  cursor: pointer;
  transition: all 0.3s ease;
  backdrop-filter: blur(2px);
}

.hero-badge:hover {
  background: rgba(0, 0, 0, 0.9);
  transform: translateY(-2px);
}

/* Rating Badge */
.rating-badge {
  background: rgba(34, 197, 94, 0.1);
  padding: 5px 12px;
  border-radius: 20px;
  border: 1px solid rgba(34, 197, 94, 0.2);
}

/* Rule Items */
.rule-number {
  background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
  color: white;
  width: 25px;
  height: 25px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 0.8rem;
  font-weight: bold;
  flex-shrink: 0;
}

/* Gallery Styles */
.gallery-item {
  height: 180px;
  cursor: pointer;
  transition: all 0.3s ease;
  border: 1px solid #e5e7eb;
}

.gallery-item:hover {
  transform: scale(1.02);
  border-color: rgba(34, 197, 94, 0.3);
}

.gallery-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: all 0.3s ease;
}

.gallery-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(to bottom, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.6));
  opacity: 0;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  justify-content: center;
}

.gallery-item:hover .gallery-overlay {
  opacity: 1;
}

.gallery-content {
  text-align: center;
  transform: translateY(10px);
  transition: all 0.3s ease;
}

.gallery-item:hover .gallery-content {
  transform: translateY(0);
}

/* Contact Icons */
.contact-icon {
  width: 40px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
}

/* Testimonials */
.user-avatar {
  width: 36px;
  height: 36px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: bold;
}
/* Tambahkan di bagian style */
.pricing-card {
  position: -webkit-sticky; /* Untuk browser Safari */
  position: sticky;
  top: 20px;
  z-index: 100;
}

/* Pastikan parent column memiliki tinggi yang cukup */
.col-lg-4 {
  height: fit-content;
}

/* Untuk memastikan tidak ada overflow yang menghalangi */
.container-fluid, .container, .row {
  overflow: visible !important;
}


.btn-success {
  background-color: #22c55e;
  border-color: #22c55e;
}

.btn-success:hover {
  background-color: #16a34a;
  border-color: #16a34a;
}

/* Map Container */
.map-container {
  height: 180px;
  background: #f8f9fa;
}

/* Responsive adjustments */
@media (max-width: 992px) {
  .hero-image-container {
    height: 350px;
  }
  
  .gallery-item {
    height: 160px;
  }
}

@media (max-width: 768px) {
  .hero-image-container {
    height: 300px;
    border-radius: 12px;
  }
  
  .hero-section {
    padding: 1rem 0;
  }
  
  .gallery-item {
    height: 140px;
  }
}

@media (max-width: 576px) {
  .hero-image-container {
    height: 250px;
  }
  
  .gallery-item {
    height: 120px;
  }
  
  .venue-header h1 {
    font-size: 1.8rem;
  }
}

/* Animations */
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.card {
  animation: fadeInUp 0.6s ease-out;
}

.card:nth-child(2) {
  animation-delay: 0.1s;
}

.card:nth-child(3) {
  animation-delay: 0.2s;
}
</style>

