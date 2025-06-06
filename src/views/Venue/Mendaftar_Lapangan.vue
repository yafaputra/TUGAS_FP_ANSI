<template>
  <div class="container">
    <header class="header">
      <div class="header-content">
        <div class="logo-section">
          <h1>ZSC Badminton</h1>
          <p>Gor Sport Hall Garuda Sinta Bantula</p>
          <div class="feature-badges">
            <span class="badge">Premium Court</span>
            <span class="badge">AC Available</span>
            <span class="badge">Parking Area</span>
          </div>
        </div>
        <div class="price-section">
          <div class="price">Rp 100.000</div>
          <p>per jam</p>
          <button class="btn-primary" @click="scrollToBooking">Booking Sekarang</button>
        </div>
      </div>
    </header>

    <div class="main-content">
      <div class="left-section">
        <div class="image-upload-section">
          <h3>📸 Gambar Lapangan</h3>
          <div class="image-upload-container">
            <div class="image-upload-item" @click="triggerFileUpload('main-court')">
              <div class="image-upload-content" :class="{ empty: !mainCourtImage }">
                <div class="upload-icon">📷</div>
                <div>Upload Gambar<br>Lapangan Utama</div>
              </div>
              <input type="file" ref="mainCourt" class="file-input" accept="image/*" @change="handleImageUpload($event, 'mainCourtImage')">
            </div>
            <div class="image-upload-item" @click="triggerFileUpload('facility')">
              <div class="image-upload-content" :class="{ empty: !facilityImage }">
                <div class="upload-icon">🏢</div>
                <div>Upload Gambar<br>Fasilitas</div>
              </div>
              <input type="file" ref="facility" class="file-input" accept="image/*" @change="handleImageUpload($event, 'facilityImage')">
            </div>
            <div class="image-upload-item" @click="triggerFileUpload('parking')">
              <div class="image-upload-content" :class="{ empty: !parkingImage }">
                <div class="upload-icon">🚗</div>
                <div>Upload Gambar<br>Area Parkir</div>
              </div>
              <input type="file" ref="parking" class="file-input" accept="image/*" @change="handleImageUpload($event, 'parkingImage')">
            </div>
          </div>
        </div>

        <div class="description">
          <h2>Tentang Lapangan</h2>
          <p>Lapangan badminton premium dengan standar internasional, dilengkapi dengan sistem pencahayaan yang optimal dan kualitas lantai terbaik untuk pengalaman bermain yang maksimal.</p>
          <p>Lokasi strategis dengan akses mudah dan fasilitas lengkap untuk mendukung aktivitas olahraga Anda.</p>
        </div>

        <div class="facilities">
          <h3>Fasilitas Tersedia</h3>
          <div class="facility-list">
            <div class="facility-item">Air Conditioning</div>
            <div class="facility-item">Toilet Bersih</div>
            <div class="facility-item">Ruang Ganti</div>
            <div class="facility-item">Area Parkir</div>
            <div class="facility-item">Kantin</div>
            <div class="facility-item">WiFi Gratis</div>
            <div class="facility-item">Penyewaan Raket</div>
            <div class="facility-item">Mushola</div>
          </div>
        </div>
      </div>

      <div class="right-section">
        <div class="booking-card" id="booking-section">
          <h3>🏸 Booking Lapangan</h3>
          <form @submit.prevent="handleBookingSubmit">
            <div class="form-group">
              <label for="name">Nama Lengkap</label>
              <input type="text" v-model="name" required placeholder="Masukkan nama lengkap">
            </div>
            <div class="form-group">
              <label for="phone">Nomor Telepon</label>
              <input type="tel" v-model="phone" required placeholder="08xx-xxxx-xxxx">
            </div>
            <div class="form-group">
              <label for="date">Tanggal</label>
              <input type="date" v-model="date" required :min="today">
            </div>
            <div class="form-group">
              <label for="time">Waktu</label>
              <select v-model="time" required>
                <option value="">Pilih Waktu</option>
                <option v-for="slot in timeSlots" :key="slot" :value="slot">{{ slot }} - {{ getNextHour(slot) }}</option>
              </select>
            </div>
            <div class="form-group">
              <label for="duration">Durasi (Jam)</label>
              <select v-model="duration" required>
                <option value="">Pilih Durasi</option>
                <option v-for="dur in [1, 2, 3, 4]" :key="dur" :value="dur">{{ dur }} Jam</option>
              </select>
            </div>
            <button type="submit" class="btn-primary" style="width: 100%; margin-top: 1rem;">
              Konfirmasi Booking
            </button>
          </form>
        </div>

        <div class="schedule-section">
          <h3>📅 Jadwal Hari Ini</h3>
          <div class="schedule-grid">
            <div v-for="slot in timeSlots" :key="slot" 
                 :class="['time-slot', { available: isAvailable(slot), booked: isBooked(slot) }]" 
                 @click="selectTimeSlot(slot)">
              {{ slot }}
            </div>
          </div>
          <div class="schedule-legend">
            <span style="color: #22c55e;">● Tersedia</span>
            <span style="color: #ef4444;">● Terbooked</span>
          </div>
        </div>
      </div>
    </div>

    <div class="bottom-gallery">
      <h3>🏟️ Galeri Lapangan</h3>
      <div class="gallery-grid">
        <div class="gallery-item" v-for="(item, index) in galleryItems" :key="index">
          <div class="overlay">{{ item }}</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      name: '',
      phone: '',
      date: '',
      time: '',
      duration: '',
      today: new Date().toISOString().split('T')[0],
      timeSlots: ['06:00', '07:00', '08:00', '09:00', '10:00', '11:00', '13:00', '14:00', '15:00', '16:00', '18:00'],
      bookedSlots: ['08:00', '10:00', '14:00', '17:00'], // Example booked slots
      mainCourtImage: null,
      facilityImage: null,
      parkingImage: null,
      galleryItems: ['Lapangan Utama', 'Area Tunggu', 'Fasilitas Lengkap', 'Parkir Luas']
    };
  },
  methods: {
    scrollToBooking() {
      const element = document.getElementById('booking-section');
      if (element) {
        element.scrollIntoView({ behavior: 'smooth' });
      }
    },
    triggerFileUpload(ref) {
      this.$refs[ref].click();
    },
    handleImageUpload(event, imageType) {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
          this[imageType] = e.target.result; // Store the image data
        };
        reader.readAsDataURL(file);
      }
    },
    selectTimeSlot(time) {
      this.time = time;
      this.scrollToBooking();
    },
    isAvailable(slot) {
      return !this.bookedSlots.includes(slot);
    },
    isBooked(slot) {
      return this.bookedSlots.includes(slot);
    },
    getNextHour(slot) {
      const hour = parseInt(slot.split(':')[0]);
      const nextHour = hour + 1 < 24 ? hour + 1 : 0;
      return nextHour < 10 ? `0${nextHour}:00` : `${nextHour}:00`;
    },
    handleBookingSubmit() {
      const totalPrice = parseInt(this.duration) * 100000;
      alert(`Booking berhasil!\n\nDetail:\n- Nama: ${this.name}\n- Telepon: ${this.phone}\n- Tanggal: ${this.date}\n- Waktu: ${this.time}\n- Durasi: ${this.duration} Jam\n- Total: Rp ${totalPrice}`);
    }
  }
};
</script>

<style scoped>
 * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 50%, #e2e8f0 100%);
            min-height: 100vh;
            color: #1e293b;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(248, 250, 252, 0.95) 100%);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(0, 0, 0, 0.1);
            color: #1e293b;
            padding: 3rem 2rem;
            margin-bottom: 3rem;
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 30% 20%, rgba(34, 197, 94, 0.1) 0%, transparent 50%);
            pointer-events: none;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 2rem;
            position: relative;
            z-index: 1;
        }

        .logo-section h1 {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 0 30px rgba(34, 197, 94, 0.3);
        }

        .logo-section p {
            font-size: 1.2rem;
            opacity: 0.8;
            margin-bottom: 1rem;
        }

        .feature-badges {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .badge {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.2) 0%, rgba(22, 163, 74, 0.2) 100%);
            border: 1px solid rgba(34, 197, 94, 0.3);
            color: #22c55e;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .badge:hover {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.3) 0%, rgba(22, 163, 74, 0.3) 100%);
            transform: translateY(-2px);
        }

        .price-section {
            text-align: center;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 2rem;
            border-radius: 20px;
            backdrop-filter: blur(20px);
        }

        .price {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .btn-primary {
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
            color: white;
            border: none;
            padding: 16px 32px;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(34, 197, 94, 0.3);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(34, 197, 94, 0.4);
            background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
        }

        .main-content {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 3rem;
            margin-bottom: 3rem;
        }

        .left-section {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(248, 250, 252, 0.95) 100%);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(0, 0, 0, 0.1);
            padding: 2.5rem;
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
        }

        .image-upload-section {
            margin-bottom: 2rem;
        }

        .image-upload-section h3 {
            color: #22c55e;
            margin-bottom: 1rem;
            font-size: 1.3rem;
            font-weight: 700;
        }

        .image-upload-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .image-upload-item {
            position: relative;
            aspect-ratio: 16/10;
            border: 2px dashed rgba(34, 197, 94, 0.3);
            border-radius: 12px;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.3s ease;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.5) 0%, rgba(248, 250, 252, 0.5) 100%);
        }

        .image-upload-item:hover {
            border-color: rgba(34, 197, 94, 0.6);
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.7) 0%, rgba(30, 41, 59, 0.7) 100%);
        }

        .image-upload-item.has-image {
            border: 2px solid rgba(34, 197, 94, 0.5);
        }

        .image-upload-content {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 1rem;
        }

        .image-upload-content.empty {
            color: rgba(30, 41, 59, 0.6);
        }

        .image-upload-content .upload-icon {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            color: #22c55e;
        }

        .image-preview {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            inset: 0;
        }

        .image-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
            padding: 1rem;
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .file-input {
            display: none;
        }

        .description h2 {
            color: #22c55e;
            margin-bottom: 1.5rem;
            font-size: 2rem;
            font-weight: 800;
        }

        .description p {
            color: rgba(30, 41, 59, 0.8);
            margin-bottom: 1.5rem;
            line-height: 1.8;
            font-size: 1.1rem;
        }

        .facilities {
            margin-top: 2.5rem;
        }

        .facilities h3 {
            color: #22c55e;
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
            font-weight: 700;
        }

        .facility-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
        }

        .facility-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.1) 0%, rgba(22, 163, 74, 0.1) 100%);
            border: 1px solid rgba(34, 197, 94, 0.2);
            border-radius: 12px;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .facility-item:hover {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.2) 0%, rgba(22, 163, 74, 0.2) 100%);
            transform: translateY(-2px);
        }

        .facility-item::before {
            content: '✓';
            color: #22c55e;
            font-weight: bold;
            font-size: 1.2rem;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(34, 197, 94, 0.2);
            border-radius: 50%;
        }

        .right-section {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .booking-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(248, 250, 252, 0.95) 100%);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(0, 0, 0, 0.1);
            padding: 2.5rem;
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
            border-top: 4px solid #22c55e;
        }

        .booking-card h3 {
            color: #22c55e;
            margin-bottom: 2rem;
            font-size: 1.5rem;
            font-weight: 700;
            text-align: center;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.75rem;
            font-weight: 600;
            color: #1e293b;
            font-size: 1rem;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 16px;
            border: 1px solid rgba(0, 0, 0, 0.2);
            border-radius: 12px;
            font-size: 1rem;
            background: rgba(255, 255, 255, 0.5);
            color: #1e293b;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #22c55e;
            box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.1);
            background: rgba(255, 255, 255, 0.8);
        }

        .form-group input::placeholder {
            color: rgba(30, 41, 59, 0.5);
        }

        .schedule-section {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(248, 250, 252, 0.95) 100%);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(0, 0, 0, 0.1);
            padding: 2.5rem;
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
        }

        .schedule-section h3 {
            color: #22c55e;
            margin-bottom: 2rem;
            font-size: 1.5rem;
            font-weight: 700;
            text-align: center;
        }

        .schedule-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(80px, 1fr));
            gap: 0.75rem;
        }

        .time-slot {
            background: rgba(255, 255, 255, 0.5);
            border: 1px solid rgba(0, 0, 0, 0.2);
            padding: 1rem 0.5rem;
            border-radius: 12px;
            text-align: center;
            font-weight: 600;
            transition: all 0.3s ease;
            cursor: pointer;
            backdrop-filter: blur(10px);
            color: #1e293b;
        }

        .time-slot:hover {
            background: rgba(34, 197, 94, 0.1);
            border-color: #22c55e;
            transform: translateY(-2px);
        }

        .time-slot.available {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.2) 0%, rgba(22, 163, 74, 0.2) 100%);
            border-color: #22c55e;
            color: #22c55e;
        }

        .time-slot.booked {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.2) 0%, rgba(220, 38, 38, 0.2) 100%);
            border-color: #ef4444;
            color: #ef4444;
            cursor: not-allowed;
        }

        .schedule-legend {
            margin-top: 1.5rem;
            font-size: 0.9rem;
            text-align: center;
            color: rgba(30, 41, 59, 0.6);
        }

        .schedule-legend span {
            margin: 0 1rem;
        }

        .bottom-gallery {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(248, 250, 252, 0.95) 100%);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(0, 0, 0, 0.1);
            padding: 2.5rem;
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
            margin-top: 3rem;
        }

        .bottom-gallery h3 {
            color: #22c55e;
            margin-bottom: 2rem;
            font-size: 1.5rem;
            font-weight: 700;
            text-align: center;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .gallery-item {
            height: 250px;
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.1) 0%, rgba(22, 163, 74, 0.1) 100%);
            border: 1px solid rgba(34, 197, 94, 0.2);
            border-radius: 16px;
            position: relative;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .gallery-item:hover {
            transform: scale(1.02) translateY(-5px);
            box-shadow: 0 20px 40px rgba(34, 197, 94, 0.2);
        }

        .gallery-item .overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
            padding: 1.5rem;
            color: white;
            font-weight: 600;
            font-size: 1.1rem;
        }

        @media (max-width: 1024px) {
            .main-content {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                text-align: center;
            }
            
            .container {
                padding: 15px;
            }

            .logo-section h1 {
                font-size: 2.5rem;
            }

            .image-upload-container {
                grid-template-columns: 1fr;
            }

            .facility-list {
                grid-template-columns: 1fr;
            }

            .gallery-grid {
                grid-template-columns: 1fr;
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

        .container > * {
            animation: fadeInUp 0.8s ease-out;
        }

        .container > *:nth-child(2) {
            animation-delay: 0.1s;
        }

        .container > *:nth-child(3) {
            animation-delay: 0.2s;
        }

        .container > *:nth-child(4) {
            animation-delay: 0.3s;
        }
</style>
