<template>
  <div class="container">
    <div class="main-layout">
      <!-- Left Section -->
      <div class="left-section">
        <div class="team-header">
          <div class="team-info">
            <div class="team-logo">
              SB
            </div>
            <div class="team-details">
              <h1>Sucks Ballers</h1>
              <div class="team-meta">
                <span><i class="fas fa-futbol"></i> Futsal</span>
                <span><i class="fas fa-map-marker-alt"></i> Kota Jakarta Utara</span>
              </div>
            </div>
          </div>
        </div>

        <div class="location-section">
          <h3>Lokasi Venue</h3>
          <div class="address">
            Batas No.32-46, RW.1, Kapuk Muara, Kec. Penjaringan, Jkt Utara, Daerah Khusus Ibukota Jakarta 14460, Indonesia
          </div>

          <div class="map-container">
            <div class="map-controls">
              <button 
                class="map-control-btn" 
                :class="{ active: mapView === 'map' }"
                @click="changeMapView('map')"
              >
                Peta
              </button>
              <button 
                class="map-control-btn" 
                :class="{ active: mapView === 'satellite' }"
                @click="changeMapView('satellite')"
              >
                Satelit
              </button>
            </div>
            
            <div class="map-tools">
              <button class="map-tool">
                <i class="fas fa-expand"></i>
              </button>
              <button class="map-tool">
                <i class="fas fa-compress"></i>
              </button>
              <button class="map-tool">
                <i class="fas fa-street-view"></i>
              </button>
            </div>

            <div class="google-logo">
              <i class="fab fa-google"></i> Google
            </div>

            <div class="map-info">
              <span>Pintasan keyboard</span>
              <span>Data peta ©2025</span>
              <span>Persyaratan</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Right Section -->
      <div class="right-section">
        <div class="price-card">
          <div class="price">Rp. 125.000</div>
          <button class="book-btn" @click="bookSparing">
            Ambil Sparring <i class="fas fa-arrow-right"></i>
          </button>
        </div>

        <div class="details-card">
          <div class="detail-item">
            <div class="detail-icon">
              <i class="fas fa-calendar"></i>
            </div>
            <div class="detail-content">
              <h4>Waktu & Tanggal</h4>
              <p>Friday, 06 Jun 2025 • 18:50 - 20:00</p>
            </div>
          </div>

          <div class="detail-item">
            <div class="detail-icon">
              <i class="fas fa-map-marker-alt"></i>
            </div>
            <div class="detail-content">
              <h4>Lokasi</h4>
              <p>Lapangan Biru, Magnet Arena New<br>
              Kota Jakarta Utara, Daerah Khusus<br>
              Ibukota Jakarta</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Sparing List -->
    <div class="sparing-list">
      <div class="sparing-item" v-for="(match, index) in matches" :key="index">
        <div class="sparing-info">
          <h3>{{ match.name }}</h3>
          <div class="sparing-meta">
            <i class="fas fa-calendar"></i> {{ match.date }}
            <br><i class="fas fa-map-marker-alt"></i> {{ match.location }}
          </div>
        </div>
        <div class="sparing-actions">
          <button class="btn-secondary">Detail</button>
          <button class="btn-primary" @click="joinMatch(match.name)">
            <i class="fas fa-handshake"></i> Gabung
          </button>
        </div>
      </div>
    </div>

    <!-- Floating Button -->
    <button class="floating-add" @click="showModal = true">
      <i class="fas fa-plus"></i>
    </button>

    <!-- Modal -->
    <div v-if="showModal" class="modal">
      <div class="modal-content">
        <span class="close" @click="showModal = false">&times;</span>
        <h2 style="margin-bottom: 25px; color: #333;">
          <i class="fas fa-plus-circle"></i>
          Buat Sparing Baru
        </h2>
        <form @submit.prevent="createNewSparing">
          <div class="form-group">
            <label for="teamName">Nama Tim</label>
            <input 
              type="text" 
              id="teamName" 
              v-model="newSparing.teamName" 
              required 
              placeholder="Masukkan nama tim Anda"
            >
          </div>
          <div class="form-group">
            <label for="sparingDate">Tanggal Sparing</label>
            <input 
              type="date" 
              id="sparingDate" 
              v-model="newSparing.date" 
              :min="minDate"
              required
            >
          </div>
          <div class="form-group">
            <label for="sparingTime">Waktu</label>
            <input 
              type="time" 
              id="sparingTime" 
              v-model="newSparing.time" 
              required
            >
          </div>
          <div class="form-group">
            <label for="location">Lokasi</label>
            <input 
              type="text" 
              id="location" 
              v-model="newSparing.location" 
              required 
              placeholder="Nama lapangan dan alamat"
            >
          </div>
          <div class="form-group">
            <label for="price">Harga (Rp)</label>
            <input 
              type="number" 
              id="price" 
              v-model="newSparing.price" 
              required 
              placeholder="125000"
            >
          </div>
          <div class="form-group">
            <label for="notes">Catatan</label>
            <textarea 
              id="notes" 
              v-model="newSparing.notes" 
              rows="3" 
              placeholder="Informasi tambahan..."
            ></textarea>
          </div>
          <button type="submit" class="book-btn" style="margin-top: 10px;">
            <i class="fas fa-paper-plane"></i>
            Buat Sparing
          </button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'SparingApp',
  data() {
    return {
      mapView: 'map',
      showModal: false,
      minDate: new Date().toISOString().split('T')[0],
      matches: [
        {
          name: 'Garuda FC vs Red Eagles',
          date: 'Sabtu, 8 Juni 2025 • 16:00-18:00',
          location: 'Lapangan Senayan, Jakarta Pusat'
        },
        {
          name: 'Bintang United vs Thunder Bolts',
          date: 'Minggu, 9 Juni 2025 • 08:00-10:00',
          location: 'Lapangan Bintaro, Tangerang'
        }
      ],
      newSparing: {
        teamName: '',
        date: '',
        time: '',
        location: '',
        price: '',
        notes: ''
      }
    }
  },
  methods: {
    changeMapView(view) {
      this.mapView = view
    },
    bookSparing() {
      if (confirm('Apakah Anda yakin ingin mengambil sparing ini?')) {
        alert('Sparing berhasil diambil! Anda akan mendapat konfirmasi lebih lanjut.')
      }
    },
    joinMatch(matchName) {
      if (confirm(`Apakah Anda yakin ingin bergabung dengan ${matchName}?`)) {
        alert(`Permintaan bergabung dengan ${matchName} telah dikirim!`)
      }
    },
    createNewSparing() {
      // Format the date for display
      const formattedDate = new Date(this.newSparing.date).toLocaleDateString('id-ID', {
        weekday: 'long',
        day: 'numeric',
        month: 'long',
        year: 'numeric'
      }) + ' • ' + this.newSparing.time
      
      // Add new match to the list
      this.matches.unshift({
        name: this.newSparing.teamName,
        date: formattedDate,
        location: this.newSparing.location
      })
      
      alert('Sparing baru berhasil dibuat! Tim lain dapat melihat dan bergabung.')
      this.showModal = false
      this.resetForm()
    },
    resetForm() {
      this.newSparing = {
        teamName: '',
        date: '',
        time: '',
        location: '',
        price: '',
        notes: ''
      }
    }
  }
}
</script>

<style scoped>
/* CSS yang sama seperti sebelumnya */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background: #f5f5f5;
  color: #333;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
}

.main-layout {
  display: grid;
  grid-template-columns: 2fr 1fr;
  gap: 20px;
  margin-top: 20px;
}

.left-section {
  background: white;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.team-header {
  padding: 20px;
  border-bottom: 1px solid #eee;
}

.team-info {
  display: flex;
  align-items: center;
  gap: 15px;
  margin-bottom: 15px;
}

.team-logo {
  width: 60px;
  height: 60px;
  border-radius: 50%;
  background: #1a472a;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-weight: bold;
  font-size: 1.2rem;
  position: relative;
}

.team-logo::after {
  content: '!';
  position: absolute;
  bottom: -2px;
  right: -2px;
  width: 20px;
  height: 20px;
  background: #ff6b35;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 0.8rem;
  color: white;
}

.team-details h1 {
  font-size: 1.8rem;
  color: #333;
  margin-bottom: 5px;
}

.team-meta {
  display: flex;
  align-items: center;
  gap: 20px;
  color: #666;
  font-size: 0.9rem;
}

.team-meta span {
  display: flex;
  align-items: center;
  gap: 5px;
}

.location-section {
  padding: 20px;
}

.location-section h3 {
  font-size: 1.1rem;
  color: #333;
  margin-bottom: 10px;
}

.address {
  color: #666;
  font-size: 0.9rem;
  margin-bottom: 20px;
  line-height: 1.4;
}

.map-container {
  height: 300px;
  background: #e6f3ff;
  border-radius: 8px;
  position: relative;
  overflow: hidden;
}

.map-controls {
  position: absolute;
  top: 10px;
  left: 10px;
  display: flex;
  background: white;
  border-radius: 6px;
  overflow: hidden;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.map-control-btn {
  padding: 8px 16px;
  border: none;
  background: white;
  cursor: pointer;
  font-size: 0.9rem;
}

.map-control-btn.active {
  background: #f0f0f0;
  font-weight: 500;
}

.map-tools {
  position: absolute;
  top: 10px;
  right: 10px;
  display: flex;
  flex-direction: column;
  gap: 5px;
}

.map-tool {
  width: 32px;
  height: 32px;
  background: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.google-logo {
  position: absolute;
  bottom: 10px;
  left: 10px;
  font-size: 0.8rem;
  color: #666;
}

.map-info {
  position: absolute;
  bottom: 10px;
  right: 10px;
  font-size: 0.7rem;
  color: #666;
  display: flex;
  gap: 10px;
}

.right-section {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.price-card {
  background: white;
  border-radius: 12px;
  padding: 20px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  text-align: right;
}

.price {
  font-size: 1.5rem;
  font-weight: bold;
  color: #333;
  margin-bottom: 15px;
}

.book-btn {
  width: 100%;
  padding: 12px;
  background: #22c55e;
  color: white;
  border: none;
  border-radius: 8px;
  font-size: 1rem;
  font-weight: 600;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  transition: background-color 0.3s ease;
}

.book-btn:hover {
  background: #16a34a;
}

.details-card {
  background: white;
  border-radius: 12px;
  padding: 20px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.detail-item {
  display: flex;
  align-items: flex-start;
  gap: 15px;
  margin-bottom: 20px;
}

.detail-icon {
  width: 20px;
  height: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #666;
  margin-top: 2px;
}

.detail-content h4 {
  font-size: 0.9rem;
  color: #333;
  margin-bottom: 3px;
}

.detail-content p {
  color: #666;
  font-size: 0.85rem;
  line-height: 1.4;
}

.sparing-list {
  margin-top: 30px;
}

.sparing-item {
  background: white;
  border-radius: 12px;
  padding: 20px;
  margin-bottom: 15px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.sparing-info h3 {
  color: #333;
  margin-bottom: 8px;
}

.sparing-meta {
  color: #666;
  font-size: 0.9rem;
}

.sparing-actions {
  display: flex;
  gap: 10px;
}

.btn-secondary {
  padding: 8px 16px;
  background: #f3f4f6;
  color: #374151;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-size: 0.9rem;
}

.btn-primary {
  padding: 8px 16px;
  background: #22c55e;
  color: white;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-size: 0.9rem;
}

.btn-primary:hover {
  background: #16a34a;
}

.floating-add {
  position: fixed;
  bottom: 30px;
  right: 30px;
  width: 56px;
  height: 56px;
  background: #22c55e;
  border: none;
  border-radius: 50%;
  color: white;
  font-size: 1.2rem;
  cursor: pointer;
  box-shadow: 0 4px 12px rgba(34, 197, 94, 0.3);
  transition: all 0.3s ease;
}

.floating-add:hover {
  background: #16a34a;
  transform: scale(1.05);
}

.modal {
  display: flex;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  z-index: 1000;
  align-items: center;
  justify-content: center;
}

.modal-content {
  background: white;
  padding: 30px;
  border-radius: 12px;
  width: 90%;
  max-width: 500px;
  position: relative;
}

.close {
  position: absolute;
  right: 20px;
  top: 20px;
  font-size: 1.5rem;
  cursor: pointer;
  color: #999;
}

.form-group {
  margin-bottom: 20px;
}

.form-group label {
  display: block;
  margin-bottom: 8px;
  color: #333;
  font-weight: 500;
}

.form-group input,
.form-group select,
.form-group textarea {
  width: 100%;
  padding: 10px;
  border: 1px solid #d1d5db;
  border-radius: 6px;
  font-size: 0.9rem;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
  outline: none;
  border-color: #22c55e;
}

@media (max-width: 768px) {
  .main-layout {
    grid-template-columns: 1fr;
  }
  
  .container {
    padding: 10px;
  }
}
</style>