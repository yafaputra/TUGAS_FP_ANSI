<template>
  <div class="container">
    <div class="header">
      <h1>⚽ Dashboard Sparring</h1>
      <p>Kelola dan pantau sparring tim Anda dengan mudah</p>
    </div>

    <div class="nav-tabs">
      <div 
        class="nav-tab" 
        :class="{ active: currentTab === 'sparring' }" 
        @click="switchTab('sparring')"
      >
        ⚽ Sparring Aktif
      </div>
      <div 
        class="nav-tab" 
        :class="{ active: currentTab === 'history' }" 
        @click="switchTab('history')"
      >
        📋 Riwayat Sparring
      </div>
    </div>

    <div class="content">
      <div class="search-section">
        <div class="search-box">
          <input 
            type="text" 
            class="search-input" 
            placeholder="Cari tim atau lokasi..." 
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
            @click="filterSparring(filter.value)"
          >
            {{ filter.label }}
          </button>
        </div>
      </div>

      <!-- Sparring Content -->
      <div v-if="currentTab === 'sparring'">
        <div v-if="!showSparringGrid" class="empty-state">
          <div class="empty-icon">⚽</div>
          <h3>Belum Ada Sparring</h3>
          <p>Sparring yang Anda ikuti akan muncul di sini. Mulai gabung sparring sekarang!</p>
          <button class="cta-button" @click="showSampleSparring">
            ➕ Lihat Sparring Tersedia
          </button>
        </div>

        <div v-else-if="filteredActiveSparring.length === 0" class="sparring-grid">
          <div class="empty-filter-state">
            <div style="font-size: 3rem; margin-bottom: 20px;">🔍</div>
            <h3>Tidak ada sparring aktif</h3>
            <p>Sparring yang tersedia akan muncul di sini</p>
          </div>
        </div>

        <div v-else class="sparring-grid">
          <div 
            v-for="sparring in filteredActiveSparring" 
            :key="sparring.id" 
            class="sparring-card"
          >
            <div class="sparring-header">
              <div class="team-badge" :style="{ backgroundColor: sparring.color }">
                {{ sparring.initials }}
              </div>
              <div class="team-info">
                <div class="team-name">{{ sparring.name }}</div>
                <div class="team-category">{{ sparring.category }}</div>
                <div class="team-level">
                  <span class="level-badge" :class="getLevelClass(sparring.level)">
                    {{ sparring.level }}
                  </span>
                  <span class="rating">⭐ {{ sparring.rating }}</span>
                </div>
              </div>
            </div>
            
            <div class="sparring-details">
              <div class="detail-item">
                <span class="detail-icon">📅</span>
                <span>{{ sparring.date }}</span>
              </div>
              <div class="detail-item">
                <span class="detail-icon">⏰</span>
                <span>{{ sparring.time }}</span>
              </div>
              <div class="detail-item">
                <span class="detail-icon">📍</span>
                <span>{{ sparring.location }}</span>
              </div>
            </div>

            <div class="sparring-cost">
              <div class="cost-item">
                <span class="cost-label">Biaya:</span>
                <span class="cost-amount">{{ sparring.cost }}</span>
              </div>
              <div class="cost-item">
                <span class="cost-label">DP:</span>
                <span class="cost-amount">{{ sparring.dp }}</span>
              </div>
            </div>

            <div class="sparring-actions">
              <button class="btn btn-primary" @click="viewDetail(sparring)">Detail</button>
              <button 
                class="btn btn-success" 
                @click="joinSparring(sparring)"
                :disabled="sparring.status === 'joined'"
              >
                {{ sparring.status === 'joined' ? 'Sudah Gabung' : 'Gabung' }}
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- History Content -->
      <div v-if="currentTab === 'history'">
        <div v-if="filteredHistorySparring.length === 0" class="sparring-grid">
          <div class="empty-filter-state">
            <div style="font-size: 3rem; margin-bottom: 20px;">📚</div>
            <h3>Tidak ada riwayat ditemukan</h3>
            <p>Riwayat sparring Anda akan tersimpan di sini</p>
          </div>
        </div>

        <div v-else class="sparring-grid">
          <div 
            v-for="sparring in filteredHistorySparring" 
            :key="sparring.id" 
            class="sparring-card"
          >
            <div class="sparring-header">
              <div class="team-badge" :style="{ backgroundColor: sparring.color }">
                {{ sparring.initials }}
              </div>
              <div class="team-info">
                <div class="team-name">{{ sparring.name }}</div>
                <div class="team-category">{{ sparring.category }}</div>
                <div class="team-level">
                  <span class="level-badge" :class="getLevelClass(sparring.level)">
                    {{ sparring.level }}
                  </span>
                  <span class="rating">⭐ {{ sparring.rating }}</span>
                </div>
              </div>
            </div>
            
            <div class="sparring-details">
              <div class="detail-item">
                <span class="detail-icon">📅</span>
                <span>{{ sparring.date }}</span>
              </div>
              <div class="detail-item">
                <span class="detail-icon">⏰</span>
                <span>{{ sparring.time }}</span>
              </div>
              <div class="detail-item">
                <span class="detail-icon">📍</span>
                <span>{{ sparring.location }}</span>
              </div>
            </div>

            <div class="sparring-status">
              <span class="status-badge" :class="getStatusClass(sparring.status)">
                {{ getStatusText(sparring.status) }}
              </span>
            </div>

            <div class="sparring-actions">
              <button class="btn btn-primary" @click="viewDetail(sparring)">Detail</button>
              <button class="btn btn-outline" @click="handleHistoryAction(sparring)">
                {{ sparring.status === 'completed' ? 'Sparring Lagi' : 'Lihat Hasil' }}
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'SparringDashboard',
  data() {
    return {
      currentFilter: 'all',
      currentTab: 'sparring',
      searchInput: '',
      showSparringGrid: false,
      
      activeSparring: [
        {
          id: 1,
          name: "Jakarta Timur Football Community",
          initials: "JT",
          category: "Sepak Bola",
          level: "Level Putih I",
          rating: "4.88",
          date: "05 Jun 2025",
          time: "20:00",
          location: "Utama, Stadion Inguk Klender",
          cost: "Rp 400.000",
          dp: "Rp 200.000",
          color: "#3498db",
          status: "available"
        },
        {
          id: 2,
          name: "Petakilan FC",
          initials: "PF",
          category: "Futsal",
          level: "Level Perak II",
          rating: "4.79",
          date: "05 Jun 2025",
          time: "20:00",
          location: "Lap B atau G. Halim Futsal & Badminton",
          cost: "Rp 170.000",
          dp: "Rp 0",
          color: "#e74c3c",
          status: "available"
        },
        {
          id: 3,
          name: "Sucks Ballers",
          initials: "SB",
          category: "Futsal",
          level: "Level Putih I",
          rating: "4.75",
          date: "06 Jun 2025",
          time: "18:50",
          location: "Lapangan Biru, Magnet Arena New",
          cost: "Rp 125.000",
          dp: "Rp 0",
          color: "#34495e",
          status: "joined"
        },
        {
          id: 4,
          name: "Matador FC",
          initials: "MF",
          category: "Mini Soccer",
          level: "Level Putih I",
          rating: "4.60",
          date: "07 Jun 2025",
          time: "08:00",
          location: "Mini soccer, de King&D30 Arena (Futsal and Mini Soccer)",
          cost: "TBD",
          dp: "TBD",
          color: "#1abc9c",
          status: "available"
        },
        {
          id: 5,
          name: "SPONTAN CHUY FC",
          initials: "SC",
          category: "Mini Soccer",
          level: "Level Putih I",
          rating: "5.00",
          date: "07 Jun 2025",
          time: "15:30",
          location: "lap. Fuerza Arena",
          cost: "TBD",
          dp: "TBD",
          color: "#2c3e50",
          status: "available"
        },
        {
          id: 6,
          name: "Southawla KSB",
          initials: "SK",
          category: "Mini Soccer",
          level: "Level Putih I",
          rating: "4.50",
          date: "07 Jun 2025",
          time: "16:00",
          location: "Lapangan A, Jonas Mini Soccer",
          cost: "TBD",
          dp: "TBD",
          color: "#27ae60",
          status: "available"
        }
      ],

      historySparring: [
        {
          id: 7,
          name: "Champions United",
          initials: "CU",
          category: "Futsal",
          level: "Level Perak I",
          rating: "4.85",
          date: "01 Jun 2025",
          time: "19:00",
          location: "Arena Futsal Premium",
          cost: "Rp 180.000",
          dp: "Rp 50.000",
          color: "#9b59b6",
          status: "completed"
        },
        {
          id: 8,
          name: "Street Fighters FC",
          initials: "SF",
          category: "Sepak Bola",
          level: "Level Putih II",
          rating: "4.20",
          date: "28 Mei 2025",
          time: "16:00",
          location: "Lapangan Rumput Sintetis",
          cost: "Rp 300.000",
          dp: "Rp 150.000",
          color: "#e67e22",
          status: "cancelled"
        }
      ],

      sparringFilters: [
        { value: 'all', label: 'Semua Kategori' },
        { value: 'Futsal', label: 'Futsal' },
        { value: 'Sepak Bola', label: 'Sepak Bola' },
        { value: 'Mini Soccer', label: 'Mini Soccer' }
      ],

      historyFilters: [
        { value: 'all', label: 'Semua Status' },
        { value: 'completed', label: 'Selesai' },
        { value: 'cancelled', label: 'Dibatalkan' }
      ]
    }
  },

  computed: {
    currentFilters() {
      return this.currentTab === 'sparring' ? this.sparringFilters : this.historyFilters;
    },

    filteredActiveSparring() {
      let sparring = this.currentFilter === 'all' ? 
        this.activeSparring : 
        this.activeSparring.filter(s => s.category === this.currentFilter);
      
      if (this.searchInput.trim()) {
        const search = this.searchInput.toLowerCase();
        sparring = sparring.filter(s => 
          s.name.toLowerCase().includes(search) ||
          s.category.toLowerCase().includes(search) ||
          s.location.toLowerCase().includes(search) ||
          s.level.toLowerCase().includes(search)
        );
      }
      
      return sparring;
    },

    filteredHistorySparring() {
      let sparring = this.currentFilter === 'all' ? 
        this.historySparring : 
        this.historySparring.filter(s => s.status === this.currentFilter);
      
      if (this.searchInput.trim()) {
        const search = this.searchInput.toLowerCase();
        sparring = sparring.filter(s => 
          s.name.toLowerCase().includes(search) ||
          s.category.toLowerCase().includes(search) ||
          s.location.toLowerCase().includes(search) ||
          s.level.toLowerCase().includes(search)
        );
      }
      
      return sparring;
    }
  },

  methods: {
    switchTab(tab) {
      this.currentTab = tab;
      this.currentFilter = 'all';
      this.searchInput = '';
      
      if (tab === 'history') {
        this.showSparringGrid = true;
      }
    },

    filterSparring(filter) {
      this.currentFilter = filter;
    },

    showSampleSparring() {
      this.showSparringGrid = true;
    },

    getLevelClass(level) {
      if (level.includes('Putih')) return 'level-putih';
      if (level.includes('Perak')) return 'level-perak';
      if (level.includes('Emas')) return 'level-emas';
      return 'level-putih';
    },

    getStatusClass(status) {
      const classes = {
        'completed': 'status-completed',
        'cancelled': 'status-cancelled',
        'joined': 'status-joined'
      };
      return classes[status] || 'status-available';
    },

    getStatusText(status) {
      const texts = {
        'completed': '✅ Selesai',
        'cancelled': '❌ Dibatalkan',
        'joined': '✅ Bergabung'
      };
      return texts[status] || 'Tersedia';
    },

    viewDetail(sparring) {
      console.log('View detail for sparring:', sparring.id);
      this.$emit('view-detail', sparring);
    },

    joinSparring(sparring) {
      if (sparring.status !== 'joined') {
        console.log('Join sparring:', sparring.id);
        this.$emit('join-sparring', sparring);
        // Update status locally
        sparring.status = 'joined';
      }
    },

    handleHistoryAction(sparring) {
      if (sparring.status === 'completed') {
        console.log('Sparring again:', sparring.id);
        this.$emit('sparring-again', sparring);
      } else {
        console.log('View result for sparring:', sparring.id);
        this.$emit('view-result', sparring);
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
  background: linear-gradient(45deg, #27ae60 0%, #2ecc71 100%);
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
  border-bottom-color: #27ae60;
  color: #27ae60;
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
  border-color: #27ae60;
  box-shadow: 0 0 0 3px rgba(39, 174, 96, 0.1);
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
  border-color: #27ae60;
  transform: translateY(-2px);
}

.filter-btn.active {
  background: #27ae60;
  color: white;
  border-color: #27ae60;
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
  background: linear-gradient(45deg, #27ae60, #2ecc71);
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
  box-shadow: 0 10px 25px rgba(39, 174, 96, 0.3);
}

.sparring-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
  gap: 25px;
  margin-top: 30px;
}

.sparring-card {
  background: white;
  border-radius: 15px;
  overflow: hidden;
  box-shadow: 0 10px 30px rgba(0,0,0,0.1);
  transition: all 0.3s ease;
  border: 2px solid #f8f9fa;
}

.sparring-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.sparring-header {
  display: flex;
  align-items: center;
  padding: 20px;
  background: #f8f9fa;
}

.team-badge {
  width: 60px;
  height: 60px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-weight: bold;
  font-size: 1.2rem;
  margin-right: 15px;
  flex-shrink: 0;
}

.team-info {
  flex: 1;
}

.team-name {
  font-size: 1.2rem;
  font-weight: 700;
  margin-bottom: 5px;
  color: #2c3e50;
}

.team-category {
  color: #6c757d;
  font-size: 0.9rem;
  margin-bottom: 8px;
}

.team-level {
  display: flex;
  align-items: center;
  gap: 10px;
}

.level-badge {
  padding: 4px 12px;
  border-radius: 15px;
  font-size: 0.8rem;
  font-weight: 600;
}

.level-putih {
  background: #fff3cd;
  color: #856404;
}

.level-perak {
  background: #d1ecf1;
  color: #0c5460;
}

.level-emas {
  background: #fff3cd;
  color: #856404;
}

.rating {
  font-size: 0.9rem;
  color: #f39c12;
  font-weight: 600;
}

.sparring-details {
  padding: 20px;
  padding-bottom: 10px;
}

.detail-item {
  display: flex;
  align-items: center;
  margin-bottom: 8px;
  color: #6c757d;
}

.detail-icon {
  margin-right: 8px;
  width: 20px;
}

.sparring-cost {
  padding: 0 20px 15px;
  display: flex;
  justify-content: space-between;
}

.cost-item {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.cost-label {
  font-size: 0.8rem;
  color: #6c757d;
  margin-bottom: 2px;
}

.cost-amount {
  font-weight: 600;
  color: #27ae60;
}

.sparring-status {
  padding: 0 20px 15px;
  text-align: center;
}

.status-badge {
  padding: 6px 15px;
  border-radius: 20px;
  font-size: 0.85rem;
  font-weight: 600;
}

.status-completed {
  background: #d4edda;
  color: #155724;
}

.status-cancelled {
  background: #f8d7da;
  color: #721c24;
}

.status-joined {
  background: #d1ecf1;
  color: #0c5460;
}

.sparring-actions {
  display: flex;
  gap: 10px;
  padding: 0 20px 20px;
}

.btn {
  flex: 1;
  padding: 12px 20px;
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

.btn:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

.btn-primary {
  background: #3498db;
  color: white;
}

.btn-primary:hover:not(:disabled) {
  background: #2980b9;
  transform: translateY(-2px);
}

.btn-success {
  background: #27ae60;
  color: white;
}

.btn-success:hover:not(:disabled) {
  background: #229954;
  transform: translateY(-2px);
}

.btn-outline {
  background: transparent;
  color: #27ae60;
  border: 2px solid #27ae60;
}

.btn-outline:hover {
  background: #27ae60;
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
  
  .sparring-grid {
    grid-template-columns: 1fr;
  }
  
  .sparring-header {
    padding: 15px;
  }
  
  .team-badge {
    width: 50px;
    height: 50px;
    font-size: 1rem;
  }
  
  .sparring-details {
    padding: 15px;
  }
}
</style>