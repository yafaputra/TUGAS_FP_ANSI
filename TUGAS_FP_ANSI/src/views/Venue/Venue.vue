<template>
  <div>
    <div class="hero-section bg-success bg-gradient py-5">
      <div class="container text-center text-white py-4">
        <h1 class="hero-title display-4 fw-bold mb-4">BOOKING LAPANGAN ONLINE TERBAIK</h1>
      </div>
    </div>

    <div class="container mt-4">
      <div class="search-section bg-white p-4 rounded-3 shadow mb-4">
        <div class="row g-3 align-items-center">
          <div class="col-md-3">
            <input type="text" class="form-control form-control-lg" placeholder="Cari nama venue" v-model="searchParams.venueName">
          </div>
          <div class="col-md-3">
            <input type="text" class="form-control form-control-lg" placeholder="Pilih Kota" v-model="searchParams.city">
          </div>
          <div class="col-md-3">
            <input type="text" class="form-control form-control-lg" placeholder="Pilih Cabang Olahraga" v-model="searchParams.sport">
          </div>
          <div class="col-md-2">
            <button class="btn btn-success btn-lg w-100" @click="fetchVenues">Cari venue</button>
          </div>
        </div>
      </div>

      <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="results-info text-muted">
          Menampilkan <strong>{{ totalVenues }} venue tersedia</strong>
        </div>
        <div class="sort-info text-muted">
          Urutkan berdasarkan: <strong>Popularitas</strong>
        </div>
      </div>

      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4" id="venues">
        <div class="col" v-for="venue in venues" :key="venue.id">
          <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
            <img :src="venue.image" class="card-img-top venue-image" :alt="venue.title">
            <div class="card-body">
              <span class="text-muted small">Venue</span>
              <h5 class="card-title mt-1">{{ venue.title }}</h5>
              <div class="d-flex align-items-center text-muted small mb-2">
                <span class="text-warning me-1">★</span>
                <span class="me-2">{{ venue.rating }}</span>
                <span>• {{ venue.location }}</span>
              </div>
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <div class="h5 text-success mb-0">Rp{{ venue.price ? venue.price.toLocaleString('id-ID') : 'N/A' }}</div>
                  <small class="text-muted">/sesi</small>
                </div>
                <button class="btn btn-success" @click="bookVenue(venue.title)">Pesan</button>
              </div>
            </div>
          </div>
        </div>
        <div v-if="venues.length === 0 && !isLoading" class="col-12 text-center text-muted py-5">
            Tidak ada venue ditemukan.
        </div>
        <div v-if="isLoading" class="col-12 text-center py-5">
            <div class="spinner-border text-success" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2 text-muted">Memuat venue...</p>
        </div>
      </div>

      <div v-if="pagination.last_page > 1" class="d-flex justify-content-center mt-5">
        <nav aria-label="Page navigation">
          <ul class="pagination">
            <li class="page-item" :class="{ disabled: pagination.current_page === 1 }">
              <a class="page-link" href="#" @click.prevent="goToPage(pagination.current_page - 1)">Previous</a>
            </li>
            <li class="page-item" v-for="page in pagination.last_page" :key="page" :class="{ active: page === pagination.current_page }">
              <a class="page-link" href="#" @click.prevent="goToPage(page)">{{ page }}</a>
            </li>
            <li class="page-item" :class="{ disabled: pagination.current_page === pagination.last_page }">
              <a class="page-link" href="#" @click.prevent="goToPage(pagination.current_page + 1)">Next</a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'; // Pastikan Anda sudah menginstal Axios: npm install axios

export default {
  name: 'VenueBooking',
  data() {
    return {
      venues: [],
      isLoading: false,
      totalVenues: 0,
      searchParams: {
        venueName: '',
        city: '',
        sport: '' // Jika Anda menambahkan kolom 'sports' di Laravel
      },
      pagination: {
        current_page: 1,
        last_page: 1,
        total: 0
      }
    };
  },
  mounted() {
    // Panggil API saat komponen pertama kali dimuat
    this.fetchVenues();
  },
  methods: {
    async fetchVenues(page = 1) {
      this.isLoading = true;
      try {
        const params = {
          page: page,
          venue_name: this.searchParams.venueName,
          city: this.searchParams.city,
          sport: this.searchParams.sport // Kirim parameter sport jika ada
        };

        // Buat URL API Anda. Sesuaikan jika aplikasi Laravel dan Vue.js Anda berjalan di domain/port yang berbeda.
        // Contoh: 'http://localhost:8000/api/venues' jika Laravel di port 8000
        const response = await axios.get('http://localhost:8000/api/venues', { params });
        this.venues = response.data.data; // Data venues ada di dalam 'data' properti dari response pagination Laravel
        this.totalVenues = response.data.total; // Total venue dari pagination
        this.pagination = {
          current_page: response.data.current_page,
          last_page: response.data.last_page,
          total: response.data.total
        };

      } catch (error) {
        console.error("Gagal mengambil data venue:", error);
        alert("Terjadi kesalahan saat mengambil data venue. Silakan coba lagi.");
      } finally {
        this.isLoading = false;
      }
    },
    bookVenue(venueName) {
      alert(`Booking ${venueName}! Fitur ini akan mengarahkan ke halaman pemesanan.`);
      // Di sini Anda bisa mengarahkan pengguna ke rute Vue.js lain
      // Misalnya: this.$router.push({ name: 'BookingDetail', params: { venueName: venueName } });
    },
    searchVenue() {
      // Ketika tombol cari ditekan, kita panggil fetchVenues untuk mengambil data baru
      this.fetchVenues(1); // Mulai dari halaman 1 lagi setelah pencarian baru
    },
    goToPage(page) {
      if (page >= 1 && page <= this.pagination.last_page) {
        this.fetchVenues(page);
      }
    }
  }
}
</script>

<style scoped>
/* Gaya CSS tetap sama */
.hero-section {
  position: relative;
  overflow: hidden;
}

.hero-section::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><path d="M0,300 Q250,200 500,300 T1000,300 L1000,0 L0,0 Z" fill="rgba(255,255,255,0.1)"/></svg>');
  background-size: cover;
}

.hover-shadow:hover {
  box-shadow: 0 .5rem 1.5rem rgba(0,0,0,.15) !important;
}

.transition-all {
  transition: all 0.3s ease;
}

.venue-image {
  height: 220px;
  object-fit: cover;
  transition: transform 0.3s ease;
}

.card:hover .venue-image {
  transform: scale(1.05);
}
</style>