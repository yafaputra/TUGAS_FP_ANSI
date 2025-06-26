<template>
  <div class="container">
    <div class="profile-header">
      <h1 class="profile-title">Profile</h1>
      <p class="profile-subtitle">Lengkapi profil anda</p>
    </div>

    <div class="profile-content">
      <form @submit.prevent="submitForm">
        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Nama Lengkap:</label>
            <input 
              type="text" 
              class="form-control" 
              v-model="formData.fullName" 
              required
            >
          </div>
          <div class="form-group">
            <label class="form-label">Username:</label>
            <input 
              type="text" 
              class="form-control" 
              v-model="formData.username" 
              required
            >
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Bulan Lahir:</label>
            <select class="form-control" v-model="formData.birthMonth" required>
              <option value="">Pilih Bulan</option>
              <option v-for="(month, index) in months" :key="index" :value="index + 1">
                {{ month }}
              </option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Tahun Lahir:</label>
            <input 
              type="number" 
              class="form-control" 
              v-model="formData.birthYear" 
              min="1900" 
              :max="currentYear" 
              required
            >
          </div>
          <div class="form-group">
            <label class="form-label">Tanggal Lahir:</label>
            <input 
              type="number" 
              class="form-control" 
              v-model="formData.birthDay" 
              min="1" 
              max="31" 
              required
            >
          </div>
        </div>

        <div class="form-row single">
          <div class="form-group">
            <label class="form-label">No. Handphone:</label>
            <div class="phone-input">
              <div class="country-code">
                <div class="flag"></div>
                +62
              </div>
              <input 
                type="tel" 
                class="form-control phone-number" 
                v-model="formData.phoneNumber" 
                required
              >
            </div>
          </div>
        </div>

        <div class="form-row single">
          <div class="form-group">
            <label class="form-label">Jenis Kelamin:</label>
            <div class="gender-select">
              <div class="gender-option">
                <input 
                  type="radio" 
                  id="male" 
                  v-model="formData.gender" 
                  value="male"
                >
                <label for="male">Laki-laki</label>
              </div>
              <div class="gender-option">
                <input 
                  type="radio" 
                  id="female" 
                  v-model="formData.gender" 
                  value="female"
                >
                <label for="female">Perempuan</label>
              </div>
            </div>
          </div>
        </div>

        <div class="sports-section">
          <h3 class="sports-title">Olahraga Favorit:</h3>
          <div class="sports-grid">
            <div 
              v-for="sport in sports" 
              :key="sport.id"
              class="sport-item" 
              :class="{ active: formData.favoriteSports.includes(sport.id) }"
              @click="toggleSport(sport.id)"
            >
              <div class="sport-icon">{{ sport.emoji }}</div>
              <div class="sport-name">{{ sport.name }}</div>
            </div>
          </div>
        </div>

        <button type="submit" class="btn-save" :disabled="isSubmitting">
          {{ isSubmitting ? 'MENYIMPAN...' : 'SIMPAN PROFIL' }}
        </button>
        <div class="success-message" v-if="showSuccessMessage">
          ✓ Profil berhasil disimpan!
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ProfileForm',
  data() {
    return {
      formData: {
        fullName: 'Dito Pratama',
        username: 'pratamadito210',
        birthMonth: 6,
        birthYear: 2025,
        birthDay: 6,
        phoneNumber: '000000000',
        gender: 'female',
        favoriteSports: []
      },
      months: [
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
      ],
      sports: [
        { id: 'soccer', name: 'Mini Soccer', emoji: '⚽' },
        { id: 'badminton', name: 'Badminton', emoji: '🏸' },
        { id: 'basketball', name: 'Bola Basket', emoji: '🏀' },
        { id: 'tennis', name: 'Tenis', emoji: '🎾' },
        { id: 'futsal', name: 'Futsal', emoji: '⚽' },
        { id: 'ping-pong', name: 'Ping Pong', emoji: '🏓' },
        { id: 'volleyball', name: 'Bola Voli', emoji: '🏐' },
        { id: 'baseball', name: 'Baseball', emoji: '⚾' },
        { id: 'swimming', name: 'Renang', emoji: '🏊' },
        { id: 'running', name: 'Lari', emoji: '🏃' },
        { id: 'cycling', name: 'Cycling', emoji: '🚴' },
        { id: 'fitness', name: 'Fitness', emoji: '💪' }
      ],
      currentYear: new Date().getFullYear(),
      isSubmitting: false,
      showSuccessMessage: false
    }
  },
  methods: {
    toggleSport(sportId) {
      if (this.formData.favoriteSports.includes(sportId)) {
        this.formData.favoriteSports = this.formData.favoriteSports.filter(id => id !== sportId)
      } else {
        this.formData.favoriteSports.push(sportId)
      }
    },
    submitForm() {
      this.isSubmitting = true
      
      // Simulate API call
      setTimeout(() => {
        this.isSubmitting = false
        this.showSuccessMessage = true
        
        // Hide success message after 3 seconds
        setTimeout(() => {
          this.showSuccessMessage = false
        }, 3000)
        
        // Scroll to top
        window.scrollTo({ top: 0, behavior: 'smooth' })
        
        // You can add actual form submission logic here
        console.log('Form submitted:', this.formData)
      }, 1000)
    }
  }
}
</script>

<style scoped>
/* Copy all the CSS from the original HTML file here */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f8f9fa;
    padding: 20px;
    color: #333;
}

.container {
    max-width: 800px;
    margin: 0 auto;
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.profile-header {
    background: white;
    padding: 30px;
    border-bottom: 1px solid #e9ecef;
}

.profile-title {
    font-size: 28px;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 5px;
}

.profile-subtitle {
    color: #6c757d;
    font-size: 14px;
}

.profile-content {
    padding: 30px;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 20px;
}

.form-row.single {
    grid-template-columns: 1fr;
}

.form-group {
    margin-bottom: 20px;
}

.form-label {
    display: block;
    font-weight: 500;
    color: #495057;
    margin-bottom: 8px;
    font-size: 14px;
}

.form-control {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #ced4da;
    border-radius: 6px;
    font-size: 16px;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    background-color: #fff;
}

.form-control:focus {
    outline: none;
    border-color: #28a745;
    box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
}

.form-control:hover {
    border-color: #adb5bd;
}

.phone-input {
    display: flex;
    align-items: center;
}

.country-code {
    background: #f8f9fa;
    border: 1px solid #ced4da;
    border-right: none;
    padding: 12px 15px;
    border-radius: 6px 0 0 6px;
    font-size: 16px;
    color: #495057;
    display: flex;
    align-items: center;
    gap: 8px;
}

.flag {
    width: 20px;
    height: 15px;
    background: linear-gradient(to bottom, #ff0000 33%, #ffffff 33%, #ffffff 66%, #ff0000 66%);
    border-radius: 2px;
}

.phone-number {
    border-radius: 0 6px 6px 0;
    flex: 1;
}

.gender-select {
    display: flex;
    gap: 15px;
    align-items: center;
}

.gender-option {
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
}

.gender-option input[type="radio"] {
    width: 18px;
    height: 18px;
    accent-color: #28a745;
}

.sports-section {
    margin-top: 30px;
}

.sports-title {
    font-size: 16px;
    font-weight: 500;
    color: #495057;
    margin-bottom: 20px;
}

.sports-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
    gap: 15px;
    margin-bottom: 30px;
}

.sport-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 15px 10px;
    border: 2px solid #e9ecef;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.2s ease;
    background: #fff;
}

.sport-item:hover {
    border-color: #28a745;
    background-color: #f8fff9;
}

.sport-item.active {
    border-color: #28a745;
    background-color: #e8f5e8;
}

.sport-icon {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.sport-name {
    font-size: 12px;
    text-align: center;
    color: #495057;
    font-weight: 500;
}

.btn-save {
    background: #28a745;
    color: white;
    border: none;
    padding: 12px 30px;
    border-radius: 6px;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.btn-save:hover {
    background: #218838;
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(40, 167, 69, 0.3);
}

.btn-save:active {
    transform: translateY(0);
}

.btn-save:disabled {
    background: #6c757d;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

.success-message {
    background: #d4edda;
    color: #155724;
    padding: 12px 20px;
    border-radius: 6px;
    margin-top: 20px;
    border: 1px solid #c3e6cb;
}

@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
        gap: 15px;
    }
    
    .sports-grid {
        grid-template-columns: repeat(auto-fill, minmax(70px, 1fr));
        gap: 10px;
    }
    
    .container {
        margin: 10px;
    }
    
    .profile-content {
        padding: 20px;
    }
}
</style>