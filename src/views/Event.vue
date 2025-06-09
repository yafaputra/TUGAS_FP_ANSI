


<template>
  <div class="event-page">
    <h1>Daftar Event Olahraga</h1>
    <input
      type="text"
      v-model="searchQuery"
      placeholder="Cari event..."
      class="search-input"
    />

    <div class="event-list">
      <div
        class="event-card"
        v-for="event in filteredEvents"
        :key="event.id"
        @click="openModal(event)"
      >
        <div class="event-image-container">
          <img :src="event.image" :alt="event.title" class="event-image" />
        </div>
        <div class="event-details">
          <h3>{{ event.title }}</h3>
          <p>{{ formatDate(event.date) }} - {{ event.location }}</p>
        </div>
      </div>
    </div>

    <!-- Event Detail Modal -->
    <div v-if="selectedEvent" class="modal-overlay">
      <div class="modal-content">
        <button class="close-button" @click="closeModal">&times;</button>
        <h2>{{ selectedEvent.title }}</h2>
        <img :src="selectedEvent.image" :alt="selectedEvent.title" class="modal-image" />
        <div class="modal-body">
          <p><strong>Tanggal:</strong> {{ formatDate(selectedEvent.date) }}</p>
          <p><strong>Lokasi:</strong> {{ selectedEvent.location }}</p>
          <p><strong>Deskripsi:</strong> {{ selectedEvent.description }}</p>
          <p><strong>Biaya Pendaftaran:</strong> Rp {{ selectedEvent.fee.toLocaleString('id-ID') }}</p>
        </div>
        <button class="register-button" @click="showRegistrationForm">Daftar Event</button>
      </div>
    </div>

    <!-- Registration Form -->
    <div v-if="showRegistration" class="modal-overlay">
      <div class="modal-content registration-form">
        <button class="close-button" @click="closeRegistration">&times;</button>
        <h2>Formulir Pendaftaran</h2>
        <p class="event-title">{{ selectedEvent.title }}</p>

        <!-- Auto-fill Notice -->
        <div v-if="hasStoredData" class="info-message">
          <p>✓ Data Anda telah terisi otomatis dari pendaftaran sebelumnya</p>
          <button @click="clearStoredData" class="clear-data-btn">Gunakan Data Baru</button>
        </div>

        <!-- Error Messages -->
        <div v-if="registrationError" class="error-message">
          <p>{{ registrationError }}</p>
          <ul v-if="validationErrors.length > 0">
            <li v-for="error in validationErrors" :key="error">{{ error }}</li>
          </ul>
        </div>

        <!-- Duplicate Warning -->
        <div v-if="duplicateWarning" class="warning-message">
          <p>{{ duplicateWarning }}</p>
        </div>

        <!-- Loading Indicator -->
        <div v-if="isSubmitting" class="loading-message">
          <p>Sedang memproses pendaftaran...</p>
        </div>

        <form @submit.prevent="submitRegistration" :class="{ 'form-disabled': isSubmitting }">
          <div class="form-group">
            <label for="fullName">Nama Lengkap *</label>
            <input
              type="text"
              id="fullName"
              v-model="registrationData.fullName"
              required
              :disabled="isSubmitting"
              placeholder="Masukkan nama lengkap"
              @input="clearDuplicateWarning"
            >
          </div>

          <div class="form-group">
            <label for="email">Email *</label>
            <input
              type="email"
              id="email"
              v-model="registrationData.email"
              required
              :disabled="isSubmitting"
              placeholder="contoh@email.com"
              @input="clearDuplicateWarning"
            >
          </div>

          <div class="form-group">
            <label for="phone">Nomor Telepon *</label>
            <input
              type="tel"
              id="phone"
              v-model="registrationData.phone"
              required
              :disabled="isSubmitting"
              placeholder="08123456789 atau +6281234567890"
              @input="clearDuplicateWarning"
            >
          </div>

          <div class="form-group">
            <label for="paymentMethod">Metode Pembayaran *</label>
            <select
              id="paymentMethod"
              v-model="registrationData.paymentMethod"
              required
              :disabled="isSubmitting"
            >
              <option value="">Pilih metode pembayaran</option>
              <option value="transfer_bank">Transfer Bank</option>
              <option value="credit_card">Kartu Kredit</option>
              <option value="e_wallet">E-Wallet</option>
              <option value="qris">QRIS</option>
            </select>
          </div>

          <div class="form-group checkbox-group">
            <input
              type="checkbox"
              id="saveData"
              v-model="saveDataForFuture"
              :disabled="isSubmitting"
            >
            <label for="saveData">Simpan data untuk pendaftaran event selanjutnya</label>
          </div>

          <button
            type="submit"
            class="submit-button"
            :disabled="isSubmitting || !isFormValid"
          >
            {{ isSubmitting ? 'Memproses...' : 'Daftar Event' }}
          </button>
        </form>
      </div>
    </div>

    <!-- Success Message -->
    <div v-if="showSuccess" class="modal-overlay">
      <div class="modal-content success-message">
        <div class="success-icon">✓</div>
        <h2>Pendaftaran Berhasil!</h2>
        <p>Anda telah terdaftar pada event <strong>{{ selectedEvent.title }}</strong></p>
        <p>Kode pendaftaran: <strong class="registration-code">{{ registrationCode }}</strong></p>
        <div class="registration-details">
          <h3>Detail Pendaftaran:</h3>
          <p><strong>Nama:</strong> {{ completedRegistration.fullName }}</p>
          <p><strong>Email:</strong> {{ completedRegistration.email }}</p>
          <p><strong>Telepon:</strong> {{ completedRegistration.phone }}</p>
          <p><strong>Metode Pembayaran:</strong> {{ getPaymentMethodName(completedRegistration.paymentMethod) }}</p>
        </div>
        <div class="success-actions">
          <button @click="copyRegistrationCode" class="copy-button">Salin Kode</button>
          <button @click="closeSuccess" class="close-success-btn">Tutup</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      // SESUAIKAN PATH PROJECT ANDA DI SINI
      API_BASE_URL: 'http://localhost/sportvenue',

      searchQuery: '',
      selectedEvent: null,
      showRegistration: false,
      showSuccess: false, // FIXED: Changed from true to false
      registrationCode: '',
      isSubmitting: false,
      registrationError: '',
      validationErrors: [],
      duplicateWarning: '',
      completedRegistration: {},
      hasStoredData: false,
      saveDataForFuture: true,
      duplicateCheckTimeout: null,
      registrationData: {
        eventId: null,
        fullName: '',
        email: '',
        phone: '',
        paymentMethod: ''
      },
      events: [
        {
          id: 1,
          title: 'Turnamen Futsal Nasional',
          date: '2025-06-15',
          location: 'GOR Summit, Jakarta',
          image: 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=300&h=200&fit=crop', // FIXED: Using proper Unsplash URL
          description: 'Turnamen futsal tahunan terbesar di Jakarta dengan hadiah total Rp 500 juta.',
          fee: 250000
        },
        {
          id: 2,
          title: 'Lomba Lari 10K',
          date: '2025-07-01',
          location: 'Bandung',
          image: 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=300&h=200&fit=crop', // FIXED: Using proper Unsplash URL
          description: 'Lari marathon sejauh 10 km melalui rute indah kota Bandung.',
          fee: 150000
        },
        {
          id: 3,
          title: 'Kejuaraan Bulu Tangkis',
          date: '2025-08-12',
          location: 'Surabaya',
          image: 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=300&h=200&fit=crop', // FIXED: Using proper Unsplash URL
          description: 'Kejuaraan bulu tangkis tingkat nasional untuk semua usia.',
          fee: 200000
        }
      ]
    };
  },

  computed: {
    filteredEvents() {
      return this.events.filter(event =>
        event.title.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
        event.location.toLowerCase().includes(this.searchQuery.toLowerCase())
      );
    },

    isFormValid() {
      return this.registrationData.fullName.trim() &&
             this.registrationData.email.trim() &&
             this.registrationData.phone.trim() &&
             this.registrationData.paymentMethod &&
             !this.duplicateWarning;
    }
  },

  methods: {
    openModal(event) {
      this.selectedEvent = event;
    },

    closeModal() {
      this.selectedEvent = null;
    },

    showRegistrationForm() {
      this.showRegistration = true;
      this.registrationData.eventId = this.selectedEvent.id;
      this.registrationError = '';
      this.validationErrors = [];
      this.duplicateWarning = '';
      this.loadStoredData();
    },

    closeRegistration() {
      this.showRegistration = false;
      this.resetRegistrationForm();
    },

    // IMPROVED BACKEND INTEGRATION METHOD
    async sendToBackend(payload) {
      try {
        console.log('Sending to backend:', payload);

        const response = await fetch(`${this.API_BASE_URL}/register.php`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
          body: JSON.stringify(payload)
        });

        console.log('Response status:', response.status);
        console.log('Response headers:', response.headers);

        // Check if response is ok
        if (!response.ok) {
          const errorText = await response.text();
          console.error('Server response error:', errorText);
          throw new Error(`Server error: ${response.status} - ${response.statusText}`);
        }

        // Parse JSON response
        const data = await response.json();
        console.log('Parsed response:', data);

        if (!data.success) {
          // Handle backend validation errors
          const error = new Error(data.error || 'Registration failed');
          if (data.errors) {
            error.validationErrors = data.errors;
          }
          throw error;
        }

        return data;

      } catch (error) {
        console.error('Backend request failed:', error);

        if (error instanceof TypeError && error.message.includes('fetch')) {
          // Network error
          throw new Error('Tidak dapat terhubung ke server. Pastikan server berjalan dan URL benar.');
        } else if (error.name === 'SyntaxError') {
          // JSON parsing error
          throw new Error('Server memberikan response yang tidak valid.');
        } else {
          // Re-throw other errors
          throw error;
        }
      }
    },

    // IMPROVED SUBMIT REGISTRATION METHOD
    async submitRegistration() {
      console.log('Submit registration called');

      if (this.isSubmitting) {
        console.log('Already submitting, returning');
        return;
      }

      // Clear previous errors
      this.registrationError = '';
      this.validationErrors = [];

      // Validate form
      if (!this.validateForm()) {
        console.log('Form validation failed');
        return;
      }

      // Check for duplicate warning
      if (this.duplicateWarning) {
        this.registrationError = 'Tidak dapat melanjutkan karena ada data yang sudah terdaftar.';
        return;
      }

      this.isSubmitting = true;
      console.log('Starting registration process');

      try {
        const registrationPayload = {
          eventId: this.registrationData.eventId,
          fullName: this.registrationData.fullName.trim(),
          email: this.registrationData.email.trim().toLowerCase(),
          phone: this.registrationData.phone.trim(),
          paymentMethod: this.registrationData.paymentMethod
        };

        console.log('Registration payload:', registrationPayload);

        // SIMULASI RESPONSE (karena backend mungkin belum siap)
        // HAPUS BAGIAN INI DAN UNCOMMENT BAGIAN BAWAH JIKA BACKEND SUDAH SIAP
        //await new Promise(resolve => setTimeout(resolve, 2000)); // Simulasi delay
        //const response = {
          //success: true,
          //code: 'REG' + Date.now().toString().slice(-6),
          //message: 'Pendaftaran berhasil'
        //};

        // UNCOMMENT BARIS INI JIKA BACKEND SUDAH SIAP:
        const response = await this.sendToBackend(registrationPayload);

        if (response.success) {
          // Save user data for future use
          this.saveUserData();

          this.completedRegistration = { ...registrationPayload };
          this.registrationCode = response.code;

          this.showRegistration = false;
          this.showSuccess = true;
        } else {
          throw new Error(response.error || 'Pendaftaran gagal');
        }

      } catch (error) {
        console.error('Registration error:', error);

        // Handle different types of errors
        if (error.name === 'NetworkError' || error.message.includes('fetch')) {
          this.registrationError = 'Tidak dapat terhubung ke server. Periksa koneksi internet Anda.';
        } else if (error.validationErrors) {
          this.registrationError = 'Data tidak valid:';
          this.validationErrors = error.validationErrors;
        } else {
          this.registrationError = 'Terjadi kesalahan: ' + error.message;
        }
      } finally {
        this.isSubmitting = false;
        console.log('Registration process completed');
      }
    },

    // IMPROVED DUPLICATE CHECK METHOD
    async checkDuplicateData() {
      if (!this.registrationData.eventId ||
          (!this.registrationData.email && !this.registrationData.phone && !this.registrationData.fullName)) {
        this.duplicateWarning = '';
        return;
      }

      try {
        // Sementara disable duplicate check
        this.duplicateWarning = '';

      } catch (error) {
        console.warn('Duplicate check failed:', error);
        // Don't show error for duplicate check failure
        this.duplicateWarning = '';
      }
    },

    // Load stored user data for auto-fill
    loadStoredData() {
      try {
        const storedDataJson = localStorage.getItem('userRegistrationData');
        if (storedDataJson) {
          const storedData = JSON.parse(storedDataJson);
          if (storedData.fullName || storedData.email || storedData.phone) {
            this.registrationData.fullName = storedData.fullName || '';
            this.registrationData.email = storedData.email || '';
            this.registrationData.phone = storedData.phone || '';
            this.registrationData.paymentMethod = storedData.paymentMethod || '';
            this.hasStoredData = true;
          }
        }
      } catch (error) {
        console.warn('Failed to load stored data:', error);
        if (typeof localStorage !== 'undefined') { // FIXED: Added check for localStorage
          localStorage.removeItem('userRegistrationData');
        }
      }
    },

    // Save user data for future use
    saveUserData() {
      if (this.saveDataForFuture && typeof localStorage !== 'undefined') { // FIXED: Added check for localStorage
        try {
          const dataToSave = {
            fullName: this.registrationData.fullName,
            email: this.registrationData.email,
            phone: this.registrationData.phone,
            paymentMethod: this.registrationData.paymentMethod,
            savedAt: new Date().toISOString()
          };
          localStorage.setItem('userRegistrationData', JSON.stringify(dataToSave));
        } catch (error) {
          console.warn('Failed to save user data:', error);
        }
      }
    },

    // Clear stored data
    clearStoredData() {
      try {
        if (typeof localStorage !== 'undefined') { // FIXED: Added check for localStorage
          localStorage.removeItem('userRegistrationData');
        }
        this.hasStoredData = false;
        this.resetRegistrationForm();
      } catch (error) {
        console.warn('Failed to clear stored data:', error);
      }
    },

    // Clear duplicate warning when user changes input
    clearDuplicateWarning() {
      this.duplicateWarning = '';

      // Debounce duplicate check
      if (this.duplicateCheckTimeout) {
        clearTimeout(this.duplicateCheckTimeout);
      }

      this.duplicateCheckTimeout = setTimeout(() => {
        this.checkDuplicateData();
      }, 1000); // Check after 1 second of no typing
    },

    validateForm() {
      const errors = [];

      if (!this.registrationData.fullName.trim()) {
        errors.push('Nama lengkap wajib diisi');
      } else if (this.registrationData.fullName.trim().length < 2) {
        errors.push('Nama lengkap minimal 2 karakter');
      }

      if (!this.registrationData.email.trim()) {
        errors.push('Email wajib diisi');
      } else if (!this.isValidEmail(this.registrationData.email.trim())) {
        errors.push('Format email tidak valid');
      }

      if (!this.registrationData.phone.trim()) {
        errors.push('Nomor telepon wajib diisi');
      } else if (!this.isValidPhone(this.registrationData.phone.trim())) {
        errors.push('Nomor telepon tidak valid (8-15 digit)');
      }

      if (!this.registrationData.paymentMethod) {
        errors.push('Metode pembayaran wajib dipilih');
      }

      if (errors.length > 0) {
        this.validationErrors = errors;
        this.registrationError = 'Mohon lengkapi form dengan benar:';
        return false;
      }

      return true;
    },

    isValidEmail(email) {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return emailRegex.test(email);
    },

    isValidPhone(phone) {
      const phoneRegex = /^\+?\d{8,15}$/;
      return phoneRegex.test(phone.replace(/\s/g, ''));
    },

    getPaymentMethodName(method) {
      const methods = {
        'transfer_bank': 'Transfer Bank',
        'credit_card': 'Kartu Kredit',
        'e_wallet': 'E-Wallet',
        'qris': 'QRIS'
      };
      return methods[method] || method;
    },

    copyRegistrationCode() {
      if (navigator.clipboard) {
        navigator.clipboard.writeText(this.registrationCode).then(() => {
          alert('Kode pendaftaran berhasil disalin!');
        }).catch(() => {
          this.fallbackCopyTextToClipboard(this.registrationCode);
        });
      } else {
        this.fallbackCopyTextToClipboard(this.registrationCode);
      }
    },

    fallbackCopyTextToClipboard(text) {
      const textArea = document.createElement("textarea");
      textArea.value = text;
      document.body.appendChild(textArea);
      textArea.focus();
      textArea.select();
      try {
        document.execCommand('copy');
        alert('Kode pendaftaran berhasil disalin!');
      } catch (err) {
        alert('Gagal menyalin kode. Silakan salin manual: ' + text);
      }
      document.body.removeChild(textArea);
    },

    closeSuccess() {
      this.showSuccess = false;
      this.selectedEvent = null;
      this.resetRegistrationForm();
    },

    resetRegistrationForm() {
      this.registrationData = {
        eventId: null,
        fullName: '',
        email: '',
        phone: '',
        paymentMethod: ''
      };
      this.registrationError = '';
      this.validationErrors = [];
      this.duplicateWarning = '';
      this.completedRegistration = {};
      this.hasStoredData = false;

      // Clear timeout
      if (this.duplicateCheckTimeout) {
        clearTimeout(this.duplicateCheckTimeout);
        this.duplicateCheckTimeout = null;
      }
    },

    formatDate(dateString) {
      const options = { year: 'numeric', month: 'long', day: 'numeric' };
      return new Date(dateString).toLocaleDateString('id-ID', options);
    }
  },

  // FIXED: Changed from beforeDestroy to beforeUnmount (Vue 3) or keep beforeDestroy (Vue 2)
  beforeDestroy() {
    if (this.duplicateCheckTimeout) {
      clearTimeout(this.duplicateCheckTimeout);
    }
  }
};
</script>

<style scoped>
.event-page {
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
}

.search-input {
  width: 100%;
  padding: 12px;
  margin-bottom: 20px;
  border: 1px solid #ddd;
  border-radius: 8px;
  font-size: 16px;
}

.event-list {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 20px;
}

.event-card {
  border: 1px solid #ddd;
  border-radius: 12px;
  overflow: hidden;
  cursor: pointer;
  transition: all 0.3s ease;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.event-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.event-image-container {
  height: 200px;
}

.event-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.event-details {
  padding: 15px;
}

.event-details h3 {
  margin: 0 0 10px 0;
  color: #333;
}

.event-details p {
  margin: 0;
  color: #666;
}

.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0,0,0,0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.modal-content {
  background: white;
  border-radius: 12px;
  padding: 20px;
  width: 90%;
  max-width: 500px;
  max-height: 90vh;
  overflow-y: auto;
  position: relative;
  box-shadow: 0 10px 30px rgba(0,0,0,0.3);
}

.close-button {
  position: absolute;
  top: 15px;
  right: 15px;
  background: none;
  border: none;
  font-size: 24px;
  cursor: pointer;
  color: #666;
  width: 30px;
  height: 30px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.close-button:hover {
  background: #f0f0f0;
  color: #333;
}

.modal-image {
  width: 100%;
  height: 200px;
  object-fit: cover;
  border-radius: 8px;
  margin-bottom: 15px;
}

.register-button, .submit-button {
  width: 100%;
  padding: 12px;
  background: #4CAF50;
  color: white;
  border: none;
  border-radius: 8px;
  font-size: 16px;
  font-weight: 600;
  cursor: pointer;
  margin-top: 15px;
  transition: background-color 0.3s ease;
}

.register-button:hover, .submit-button:hover:not(:disabled) {
  background: #45a049;
}

.register-button:disabled, .submit-button:disabled {
  background: #cccccc;
  cursor: not-allowed;
  opacity: 0.7;
}

.form-group {
  margin-bottom: 20px;
}

.form-group label {
  display: block;
  margin-bottom: 8px;
  font-weight: 600;
  color: #333;
}

.form-group input, .form-group select, .form-group textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ddd;
  border-radius: 8px;
  box-sizing: border-box;
  font-size: 16px;
  transition: border-color 0.3s ease;
}

.form-group input:focus, .form-group select:focus, .form-group textarea:focus {
  outline: none;
  border-color: #4CAF50;
  box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.1);
}

.checkbox-group {
  display: flex;
  align-items: center;
  gap: 10px;
}

.checkbox-group input[type="checkbox"] {
  width: auto;
  margin: 0;
}

.checkbox-group label {
  margin: 0;
  font-weight: normal;
  cursor: pointer;
}

.form-disabled {
  opacity: 0.6;
  pointer-events: none;
}

.error-message {
  background: #ffebee;
  border: 1px solid #f44336;
  border-radius: 8px;
  padding: 15px;
  margin-bottom: 20px;
}

.error-message p {
  color: #d32f2f;
  margin: 0 0 10px 0;
  font-weight: 600;
}

.error-message ul {
  margin: 5px 0 0 20px;
  color: #d32f2f;
}

.warning-message {
  background: #fff3e0;
  border: 1px solid #ff9800;
  border-radius: 8px;
  padding: 15px;
  margin-bottom: 20px;
}

.warning-message p {
  color: #ef6c00;
  margin: 0;
  font-weight: 600;
}

.info-message {
  background: #e8f5e8;
  border: 1px solid #4CAF50;
  border-radius: 8px;
  padding: 15px;
  margin-bottom: 20px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.info-message p {
  color: #2e7d32;
  margin: 0;
  font-weight: 600;
}

.clear-data-btn {
  background: #ff9800;
  color: white;
  border: none;
  border-radius: 6px;
  padding: 8px 12px;
  font-size: 14px;
  cursor: pointer;
}

.clear-data-btn:hover {
  background: #f57c00;
}

.loading-message {
  background: #e3f2fd;
  border: 1px solid #2196f3;
  border-radius: 8px;
  padding: 15px;
  margin-bottom: 20px;
  text-align: center;
}

.loading-message p {
  color: #1976d2;
  margin: 0;
  font-weight: 600;
}

.success-message {
  text-align: center;
}

.success-icon {
  font-size: 60px;
  color: #4CAF50;
  margin-bottom: 15px;
  font-weight: bold;
}

.registration-code {
  background: #f0f0f0;
  padding: 8px 12px;
  border-radius: 6px;
  font-family: 'Courier New', monospace;
  font-size: 18px;
  letter-spacing: 2px;
}

.registration-details {
  background: #f5f5f5;
  padding: 20px;
  border-radius: 8px;
  margin: 20px 0;
  text-align: left;
}

.registration-details h3 {
  margin: 0 0 15px 0;
  color: #333;
}

.registration-details p {
  margin: 8px 0;
  color: #555;
}

.success-actions {
  display: flex;
  gap: 10px;
  justify-content: center;
  margin-top: 20px;
}

.copy-button, .close-success-btn {
  padding: 12px 20px;
  border: none;
  border-radius: 8px;
  font-size: 16px;
  font-weight: 600;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.copy-button {
  background: #2196f3;
  color: white;
}

.copy-button:hover {
  background: #1976d2;
}

.close-success-btn {
  background: #4CAF50;
  color: white;
}

.close-success-btn:hover {
  background: #45a049;
}

.event-title {
  background: #e8f5e8;
  padding: 15px;
  border-radius: 8px;
  margin-bottom: 20px;
  font-weight: bold;
  text-align: center;
  color: #2e7d32;
}

/* Responsive design */
@media (max-width: 768px) {
  .modal-content {
    width: 95%;
    padding: 15px;
  }

  .success-actions {
    flex-direction: column;
  }

  .copy-button, .close-success-btn {
    width: 100%;
  }
}
</style>
