
<template>
  <div class="header">
        <h1>CARI LAWAN SPARRING</h1>
  </div>

  <div class="container">
    <div class="search-section">
      <div class="search-row">
        <input type="text" class="search-input" placeholder="Find Sparring Opponents">
        <input type="text" class="search-input" placeholder="Pilih kota">
        <input type="text" class="search-input" placeholder="Pilih Cabang Olahraga">
        <button class="filter-btn">⚙️</button>
        <button class="search-btn">Cari Lawan</button>
      </div>
    </div>
    <div class="results-info">
            Menampilkan <strong>30 sparring terbuka</strong>
        </div>

        <div class="sort-info">
            Urutkan berdasarkan : <strong>Waktu dan Tanggal</strong>
        </div>

        <div class="sparring-grid">
            <!-- Sepak Bola Card -->
            <div class="sparring-card">
                <div class="team-header">
                    <div class="team-logo">JT</div>
                    <div class="team-info">
                        <h3>Jakarta Timur Football Community</h3>
                        <span class="team-category">Sepak Bola</span>
                        <div class="team-level">
                            <span class="level-badge">Level Putih I</span>
                            <span class="rating">⭐ 4.88</span>
                        </div>
                    </div>
                </div>
                <div class="sparring-details">
                    <div class="detail-row">
                        <span>📅</span>
                        <span>05 Jun 2025 • 20:00</span>
                    </div>
                    <div class="detail-row">
                        <span>📍</span>
                        <span>Utama, Stadion Inguk Klender</span>
                    </div>
                </div>
                <div class="price-info">
                    <div class="price">Biaya • 400.000 | Dp • 200.000</div>
                    <button class="join-btn">Gabung</button>
                </div>
            </div>

            <!-- Futsal Card -->
            <div class="sparring-card">
                <div class="team-header">
                    <div class="team-logo" style="background: linear-gradient(135deg, #dc3545, #c82333);">PF</div>
                    <div class="team-info">
                        <h3>Petakilan FC</h3>
                        <span class="team-category">Futsal</span>
                        <div class="team-level">
                            <span class="level-badge">Level Perak II</span>
                            <span class="rating">⭐ 4.79</span>
                        </div>
                    </div>
                </div>
                <div class="sparring-details">
                    <div class="detail-row">
                        <span>📅</span>
                        <span>05 Jun 2025 • 20:00</span>
                    </div>
                    <div class="detail-row">
                        <span>📍</span>
                        <span>Lap B atau G, Halim Futsal &amp; Badminton</span>
                    </div>
                </div>
                <div class="price-info">
                    <div class="price">Biaya • 170.000 | Dp • 0</div>
                    <button class="join-btn">Gabung</button>
                </div>
            </div>

            <!-- Futsal Card 2 -->
            <div class="sparring-card">
                <div class="team-header">
                    <div class="team-logo" style="background: linear-gradient(135deg, #6c757d, #495057);">SB</div>
                    <div class="team-info">
                        <h3>Sucks Ballers</h3>
                        <span class="team-category">Futsal</span>
                        <div class="team-level">
                            <span class="level-badge">Level Putih I</span>
                        </div>
                    </div>
                </div>
                <div class="sparring-details">
                    <div class="detail-row">
                        <span>📅</span>
                        <span>06 Jun 2025 • 18:50</span>
                    </div>
                    <div class="detail-row">
                        <span>📍</span>
                        <span>Lapangan Biru, Magnet Arena New</span>
                    </div>
                </div>
                <div class="price-info">
                    <div class="price">Biaya • 125.000 | Dp • 0</div>
                    <button class="join-btn">Gabung</button>
                </div>
            </div>

            <!-- Mini Soccer Card -->
            <div class="sparring-card">
                <div class="team-header">
                    <div class="team-logo" style="background: linear-gradient(135deg, #17a2b8, #138496);">MF</div>
                    <div class="team-info">
                        <h3>Matador FC</h3>
                        <span class="team-category">Mini Soccer</span>
                        <div class="team-level">
                            <span class="level-badge">Level Putih I</span>
                        </div>
                    </div>
                </div>
                <div class="sparring-details">
                    <div class="detail-row">
                        <span>📅</span>
                        <span>07 Jun 2025 • 08:00</span>
                    </div>
                    <div class="detail-row">
                        <span>📍</span>
                        <span>Mini soccer, de King&amp;D30 Arena (Futsal and Mini Soccer)</span>
                    </div>
                </div>
                <div class="price-info">
                    <div class="price">Biaya • TBD</div>
                    <button class="join-btn">Gabung</button>
                </div>
            </div>

            <!-- Mini Soccer Card 2 -->
            <div class="sparring-card">
                <div class="team-header">
                    <div class="team-logo" style="background: linear-gradient(135deg, #343a40, #23272b);">SC</div>
                    <div class="team-info">
                        <h3>SPONTAN CHUY FC</h3>
                        <span class="team-category">Mini Soccer</span>
                        <div class="team-level">
                            <span class="level-badge">Level Putih I</span>
                            <span class="rating">⭐ 5.00</span>
                        </div>
                    </div>
                </div>
                <div class="sparring-details">
                    <div class="detail-row">
                        <span>📅</span>
                        <span>07 Jun 2025 • 15:30</span>
                    </div>
                    <div class="detail-row">
                        <span>📍</span>
                        <span>lap. Fuerza Arena</span>
                    </div>
                </div>
                <div class="price-info">
                    <div class="price">Biaya • TBD</div>
                    <button class="join-btn">Gabung</button>
                </div>
            </div>

            <!-- Mini Soccer Card 3 -->
            <div class="sparring-card">
                <div class="team-header">
                    <div class="team-logo" style="background: linear-gradient(135deg, #28a745, #20c997);">SK</div>
                    <div class="team-info">
                        <h3>Southawla KSB</h3>
                        <span class="team-category">Mini Soccer</span>
                        <div class="team-level">
                            <span class="level-badge">Level Putih I</span>
                        </div>
                    </div>
                </div>
                <div class="sparring-details">
                    <div class="detail-row">
                        <span>📅</span>
                        <span>07 Jun 2025 • 16:00</span>
                    </div>
                    <div class="detail-row">
                        <span>📍</span>
                        <span>Lapangan A, Jonas Mini Soccer</span>
                    </div>
                </div>
                <div class="price-info">
                    <div class="price">Biaya • TBD</div>
                    <button class="join-btn">Gabung</button>
                </div>
            </div>
        </div>
  </div>
</template>



<script>
export default {
  methods: {
    searchOpponents() {
      alert('Mencari lawan sparring...');
    },
    joinSparring() {
      alert('Bergabung dengan sparring ini!');
    },
    openFilters() {
      alert('Membuka filter pencarian...');
    }
  },
  mounted() {
    // Jika tetap perlu menggunakan querySelector
    document.querySelectorAll('.join-btn').forEach(btn => {
      btn.addEventListener('click', this.joinSparring);
    });
  }
}
</script>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f5f5f5;
  }

  .header {
    background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
    color: white;
    padding: 60px 0;
    text-align: center;
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
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><path d="M0,0 Q50,50 100,0 Q50,50 0,100 Q50,50 100,100 Q50,50 0,0" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></svg>');
            opacity: 0.3;
        }

        .header h1 {
            font-size: 2.5rem;
            font-weight: bold;
            position: relative;
            z-index: 1;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .search-section {
            background: white;
            padding: 30px;
            margin: -30px 20px 30px 20px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            position: relative;
            z-index: 2;
        }

        .search-row {
            display: flex;
            gap: 15px;
            align-items: center;
            flex-wrap: wrap;
        }

        .search-input {
            flex: 1;
            min-width: 200px;
            padding: 12px 16px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        .search-input:focus {
            outline: none;
            border-color: #28a745;
        }

        .search-btn {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
        }

        .search-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
        }

        .filter-btn {
            background: #f8f9fa;
            border: 2px solid #e0e0e0;
            padding: 10px 12px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .filter-btn:hover {
            background: #e9ecef;
        }

        .results-info {
            margin: 20px 0;
            color: #666;
            font-size: 14px;
        }

        .sort-info {
            text-align: right;
            color: #666;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .sparring-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .sparring-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            transition: all 0.3s;
            border: 1px solid #f0f0f0;
        }

        .sparring-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .team-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
        }

        .team-logo {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #007bff, #0056b3);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 18px;
        }

        .team-info h3 {
            font-size: 18px;
            color: #333;
            margin-bottom: 5px;
        }

        .team-category {
            background: #e9ecef;
            color: #495057;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            display: inline-block;
        }

        .team-level {
            display: flex;
            align-items: center;
            gap: 5px;
            margin-top: 5px;
            font-size: 13px;
            color: #666;
        }

        .level-badge {
            background: #ffc107;
            color: #333;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 11px;
            font-weight: bold;
        }

        .sparring-details {
            margin: 15px 0;
            line-height: 1.6;
        }

        .detail-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 8px;
            font-size: 13px;
            color: #555;
        }

        .icon {
            width: 16px;
            height: 16px;
            fill: #666;
        }

        .price-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #f0f0f0;
        }

        .price {
            font-weight: bold;
            color: #333;
        }

        .join-btn {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 13px;
        }

        .join-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
        }

        .rating {
            color: #ffc107;
        }

        @media (max-width: 768px) {
            .search-row {
                flex-direction: column;
            }

            .search-input {
                min-width: 100%;
            }

            .sparring-grid {
                grid-template-columns: 1fr;
            }

            .header h1 {
                font-size: 2rem;
            }
        }
</style>
