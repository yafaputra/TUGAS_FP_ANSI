<template>
  <div class="container">
    <div class="header">
      <h1>🏟️ Dashboard Venue</h1>
      <p>Kelola dan pantau booking lapangan Anda dengan mudah</p>
    </div>

    <div class="nav-tabs">
      <div 
        class="nav-tab" 
        :class="{ active: currentTab === 'booking' }" 
        @click="switchTab('booking')"
      >
        📅 Booking
      </div>
      <div 
        class="nav-tab" 
        :class="{ active: currentTab === 'history' }" 
        @click="switchTab('history')"
      >
        📋 Riwayat Booking
      </div>
    </div>

    <div class="content">
      <div class="search-section">
        <div class="search-box">
          <input 
            type="text" 
            class="search-input" 
            placeholder="Cari booking atau venue..." 
            v-model="searchInput"
          >
          <span class="search-icon">🔍</span>
        </div>

        <div class="filter-buttons">
          <button 
            v-for="filter in currentFilters" 
            :key="filter.value"
            class="filter-btn" 
            :class="{ active: currentFilter === filter.value }"
            @click="filterBookings(filter.value)"
          >
            {{ filter.label }}
          </button>
        </div>
      </div>

      <!-- Booking Content -->
      <div v-if="currentTab === 'booking'">
        <div v-if="!showBookingGrid" class="empty-state">
          <div class="empty-icon">📋</div>
          <h3>Belum Ada Booking</h3>
          <p>Lapangan yang Anda booking akan muncul di sini. Mulai booking lapangan favorit Anda sekarang!</p>
          <button class="cta-button" @click="showSampleBookings">
            ➕ Lihat Contoh Booking
          </button>
        </div>

        <div v-else-if="filteredActiveBookings.length === 0" class="venue-grid">
          <div class="empty-filter-state">
            <div style="font-size: 3rem; margin-bottom: 20px;">🔍</div>
            <h3>Tidak ada booking aktif</h3>
            <p>Booking yang sedang berlangsung akan muncul di sini</p>
          </div>
        </div>

        <div v-else class="venue-grid">
          <div 
            v-for="booking in filteredActiveBookings" 
            :key="booking.id" 
            class="venue-card"
          >
            <div class="venue-image">
              {{ getVenueIcon(booking.type) }}
            </div>
            <div class="venue-info">
              <div class="venue-name">{{ booking.name }}</div>
              <div class="venue-details">
                📅 {{ booking.date }}<br>
                ⏰ {{ booking.time }}<br>
                💰 {{ booking.price }}
              </div>
              <span class="venue-status" :class="getStatusClass(booking.status)">
                {{ getStatusText(booking.status) }}
              </span>
              <div class="venue-actions">
                <button class="btn btn-primary" @click="viewDetail(booking)">Detail</button>
                <button class="btn btn-outline" @click="handleSecondaryAction(booking)">
                  {{ booking.status === 'confirmed' ? 'Batalkan' : 'Bayar Sekarang' }}
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- History Content -->
      <div v-if="currentTab === 'history'">
        <div v-if="filteredHistoryBookings.length === 0" class="venue-grid">
          <div class="empty-filter-state">
            <div style="font-size: 3rem; margin-bottom: 20px;">📚</div>
            <h3>Tidak ada riwayat ditemukan</h3>
            <p>Riwayat booking Anda akan tersimpan di sini</p>
          </div>
        </div>

        <div v-else class="venue-grid">
          <div 
            v-for="booking in filteredHistoryBookings" 
            :key="booking.id" 
            class="venue-card"
          >
            <div class="venue-image">
              {{ getVenueIcon(booking.type) }}
            </div>
            <div class="venue-info">
              <div class="venue-name">{{ booking.name }}</div>
              <div class="venue-details">
                📅 {{ booking.date }}<br>
                ⏰ {{ booking.time }}<br>
                💰 {{ booking.price }}
              </div>
              <span class="venue-status" :class="getStatusClass(booking.status)">
                {{ getStatusText(booking.status) }}
              </span>
              <div class="venue-actions">
                <button class="btn btn-primary" @click="viewDetail(booking)">Detail</button>
                <button class="btn btn-outline" @click="handleHistoryAction(booking)">
                  {{ booking.status === 'completed' ? 'Booking Lagi' : 'Lihat Alasan' }}
                </button>
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
  name: 'VenueDashboard',
  data() {
    return {
      currentFilter: 'all',
      currentTab: 'booking',
      searchInput: '',
      showBookingGrid: false,
      
      activeBookings: [
        {
          id: 1,
          name: "Lapangan Futsal Center",
          type: "Futsal",
          date: "15 Juni 2025",
          time: "19:00 - 21:00",
          status: "confirmed",
          price: "Rp 150.000"
        },
        {
          id: 2,
          name: "Court Badminton Elite",
          type: "Badminton",
          date: "16 Juni 2025", 
          time: "08:00 - 10:00",
          status: "pending",
          price: "Rp 80.000"
        },
        {
          id: 3,
          name: "Lapangan Tenis Indoor",
          type: "Tenis",
          date: "17 Juni 2025",
          time: "16:00 - 18:00", 
          status: "confirmed",
          price: "Rp 120.000"
        }
      ],

      historyBookings: [
        {
          id: 4,
          name: "Lapangan Basket Outdoor",
          type: "Basket",
          date: "10 Juni 2025",
          time: "16:00 - 18:00", 
          status: "completed",
          price: "Rp 100.000"
        },
        {
          id: 5,
          name: "Court Badminton Pro",
          type: "Badminton",
          date: "8 Juni 2025",
          time: "20:00 - 22:00",
          status: "cancelled",
          price: "Rp 90.000"
        },
        {
          id: 6,
          name: "Lapangan Futsal Premium",
          type: "Futsal",
          date: "5 Juni 2025",
          time: "18:00 - 20:00",
          status: "completed",
          price: "Rp 180.000"
        }
      ],

      bookingFilters: [
        { value: 'all', label: 'Semua Status' },
        { value: 'pending', label: 'Menunggu Pembayaran' },
        { value: 'confirmed', label: 'Dikonfirmasi' }
      ],

      historyFilters: [
        { value: 'all', label: 'Semua Status' },
        { value: 'completed', label: 'Berhasil' },
        { value: 'cancelled', label: 'Dibatalkan' }
      ]
    }
  },

  computed: {
    currentFilters() {
      return this.currentTab === 'booking' ? this.bookingFilters : this.historyFilters;
    },

    filteredActiveBookings() {
      let bookings = this.currentFilter === 'all' ? 
        this.activeBookings : 
        this.activeBookings.filter(booking => booking.status === this.currentFilter);
      
      if (this.searchInput.trim()) {
        const search = this.searchInput.toLowerCase();
        bookings = bookings.filter(booking => 
          booking.name.toLowerCase().includes(search) ||
          booking.type.toLowerCase().includes(search) ||
          booking.date.toLowerCase().includes(search) ||
          booking.time.toLowerCase().includes(search)
        );
      }
      
      return bookings;
    },

    filteredHistoryBookings() {
      let bookings = this.currentFilter === 'all' ? 
        this.historyBookings : 
        this.historyBookings.filter(booking => booking.status === this.currentFilter);
      
      if (this.searchInput.trim()) {
        const search = this.searchInput.toLowerCase();
        bookings = bookings.filter(booking => 
          booking.name.toLowerCase().includes(search) ||
          booking.type.toLowerCase().includes(search) ||
          booking.date.toLowerCase().includes(search) ||
          booking.time.toLowerCase().includes(search)
        );
      }
      
      return bookings;
    }
  },

  methods: {
    switchTab(tab) {
      this.currentTab = tab;
      this.currentFilter = 'all';
      this.searchInput = '';
      
      if (tab === 'history') {
        // Auto show history bookings when switching to history tab
        this.showBookingGrid = true;
      }
    },

    filterBookings(filter) {
      this.currentFilter = filter;
    },

    showSampleBookings() {
      this.showBookingGrid = true;
    },

    getVenueIcon(type) {
      const icons = {
        'Futsal': '⚽',
        'Badminton': '🏸', 
        'Basket': '🏀',
        'Tenis': '🎾'
      };
      return icons[type] || '🏟️';
    },

    getStatusClass(status) {
      const classes = {
        'confirmed': 'status-booked',
        'pending': 'status-pending', 
        'completed': 'status-booked',
        'cancelled': 'status-cancelled'
      };
      return classes[status] || 'status-booked';
    },

    getStatusText(status) {
      const texts = {
        'confirmed': '✅ Dikonfirmasi',
        'pending': '⏳ Menunggu Pembayaran',
        'completed': '✅ Berhasil',
        'cancelled': '❌ Dibatalkan'
      };
      return texts[status] || 'Dikonfirmasi';
    },

    viewDetail(booking) {
      // Handle view detail action
      console.log('View detail for booking:', booking.id);
      // You can emit an event or navigate to detail page
      this.$emit('view-detail', booking);
    },

    handleSecondaryAction(booking) {
      if (booking.status === 'confirmed') {
        // Handle cancel booking
        console.log('Cancel booking:', booking.id);
        this.$emit('cancel-booking', booking);
      } else {
        // Handle payment
        console.log('Pay for booking:', booking.id);
        this.$emit('pay-booking', booking);
      }
    },

    handleHistoryAction(booking) {
      if (booking.status === 'completed') {
        // Handle book again
        console.log('Book again:', booking.id);
        this.$emit('book-again', booking);
      } else {
        // Handle view cancellation reason
        console.log('View reason for booking:', booking.id);
        this.$emit('view-reason', booking);
      }
    }
  }
}
</script>

<style scoped>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  background: white;
  border-radius: 20px;
  box-shadow: 0 20px 40px rgba(0,0,0,0.1);
  overflow: hidden;
}

.header {
  background: linear-gradient(45deg, #2c3e50 0%, #34495e 100%);
  color: white;
  padding: 30px;
  text-align: center;
}

.header h1 {
  font-size: 2.5rem;
  margin-bottom: 10px;
  font-weight: 700;
}

.header p {
  font-size: 1.1rem;
  opacity: 0.9;
}

.nav-tabs {
  display: flex;
  background: #f8f9fa;
  border-bottom: 3px solid #e9ecef;
}

.nav-tab {
  flex: 1;
  padding: 20px;
  text-align: center;
  cursor: pointer;
  font-weight: 600;
  font-size: 1.1rem;
  transition: all 0.3s ease;
  border-bottom: 3px solid transparent;
}

.nav-tab.active {
  background: white;
  border-bottom-color: #28a745;
  color: #28a745;
}

.nav-tab:hover {
  background: #e9ecef;
}

.content {
  padding: 40px;
}

.search-section {
  margin-bottom: 30px;
}

.search-box {
  position: relative;
  max-width: 500px;
  margin: 0 auto 30px;
}

.search-input {
  width: 100%;
  padding: 15px 50px 15px 20px;
  border: 2px solid #e9ecef;
  border-radius: 50px;
  font-size: 1rem;
  outline: none;
  transition: all 0.3s ease;
}

.search-input:focus {
  border-color: #28a745;
  box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.1);
}

.search-icon {
  position: absolute;
  right: 20px;
  top: 50%;
  transform: translateY(-50%);
  color: #6c757d;
}

.filter-buttons {
  display: flex;
  justify-content: center;
  gap: 15px;
  flex-wrap: wrap;
  margin-bottom: 40px;
}

.filter-btn {
  padding: 12px 25px;
  border: 2px solid #e9ecef;
  background: white;
  border-radius: 25px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  font-size: 0.95rem;
}

.filter-btn:hover {
  border-color: #28a745;
  transform: translateY(-2px);
}

.filter-btn.active {
  background: #28a745;
  color: white;
  border-color: #28a745;
}

.empty-state {
  text-align: center;
  padding: 80px 20px;
  color: #6c757d;
}

.empty-icon {
  font-size: 5rem;
  margin-bottom: 30px;
  opacity: 0.3;
}

.empty-state h3 {
  font-size: 1.8rem;
  margin-bottom: 15px;
  color: #495057;
}

.empty-state p {
  font-size: 1.1rem;
  line-height: 1.6;
  max-width: 400px;
  margin: 0 auto 30px;
}

.empty-filter-state {
  grid-column: 1/-1;
  text-align: center;
  padding: 40px;
  color: #6c757d;
}

.empty-filter-state h3 {
  margin-bottom: 10px;
}

.cta-button {
  background: linear-gradient(45deg, #28a745, #20c997);
  color: white;
  padding: 15px 35px;
  border: none;
  border-radius: 50px;
  font-size: 1.1rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  text-decoration: none;
  display: inline-block;
}

.cta-button:hover {
  transform: translateY(-3px);
  box-shadow: 0 10px 25px rgba(40, 167, 69, 0.3);
}

.venue-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
  gap: 25px;
  margin-top: 30px;
}

.venue-card {
  background: white;
  border-radius: 15px;
  overflow: hidden;
  box-shadow: 0 10px 30px rgba(0,0,0,0.1);
  transition: all 0.3s ease;
  border: 2px solid #f8f9fa;
}

.venue-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.venue-image {
  height: 200px;
  background: linear-gradient(45deg, #28a745, #20c997);
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-size: 3rem;
}

.venue-info {
  padding: 25px;
}

.venue-name {
  font-size: 1.3rem;
  font-weight: 700;
  margin-bottom: 10px;
  color: #2c3e50;
}

.venue-details {
  color: #6c757d;
  margin-bottom: 15px;
  line-height: 1.5;
}

.venue-status {
  display: inline-block;
  padding: 6px 15px;
  border-radius: 20px;
  font-size: 0.85rem;
  font-weight: 600;
  margin-bottom: 20px;
}

.status-booked {
  background: #d4edda;
  color: #155724;
}

.status-cancelled {
  background: #f8d7da;
  color: #721c24;
}

.status-pending {
  background: #fff3cd;
  color: #856404;
}

.venue-actions {
  display: flex;
  gap: 10px;
}

.btn {
  padding: 10px 20px;
  border: none;
  border-radius: 25px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  text-decoration: none;
  display: inline-block;
  text-align: center;
  font-size: 0.9rem;
}

.btn-primary {
  background: #28a745;
  color: white;
}

.btn-primary:hover {
  background: #218838;
  transform: translateY(-2px);
}

.btn-outline {
  background: transparent;
  color: #28a745;
  border: 2px solid #28a745;
}

.btn-outline:hover {
  background: #28a745;
  color: white;
}

@media (max-width: 768px) {
  .header h1 {
    font-size: 2rem;
  }
  
  .nav-tab {
    padding: 15px 10px;
    font-size: 1rem;
  }
  
  .content {
    padding: 20px;
  }
  
  .filter-buttons {
    gap: 10px;
  }
  
  .filter-btn {
    padding: 10px 20px;
    font-size: 0.9rem;
  }
  
  .venue-grid {
    grid-template-columns: 1fr;
  }
}
</style>