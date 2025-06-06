
<template>
 <div class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">BOOKING LAPANGAN ONLINE TERBAIK</h1>
        </div>
    </div>

    <div class="container">
        <div class="search-section">
            <div class="search-row">
                <input type="text" class="search-input" placeholder="Cari nama venue" id="venueSearch">
                <input type="text" class="search-input" placeholder="Pilih Kota" id="citySearch">
                <input type="text" class="search-input" placeholder="Pilih Cabang Olahraga" id="sportSearch">
                <button class="filter-btn" onclick="openFilters()">⚙️</button>
                <button class="search-btn" onclick="searchVenue()">Cari venue</button>
            </div>
        </div>

        <div class="results-info">
            Menampilkan <strong>628 venue tersedia</strong>
        </div>

        <div class="sort-info">
            Urutkan berdasarkan : <strong>Popularitas</strong>
        </div>

        <div class="venues-grid" id="venues">
            <div class="venue-card">
                <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=400&h=220&fit=crop" alt="Metro Atom Futsal Badminton" class="venue-image">
                <div class="venue-info">
                    <div class="venue-label">Venue</div>
                    <h3 class="venue-title">Metro Atom Futsal Badminton</h3>
                    <div class="venue-details">
                        <div class="venue-rating">
                            <span class="star">★</span>
                            <span>4.89</span>
                        </div>
                        <span>• Kota Jakarta Pusat</span>
                    </div>
                    <div class="venue-tags">
                        <span class="tag">Futsal</span>
                        <span class="tag">Badminton</span>
                    </div>
                    <div class="venue-footer">
                        <div>
                            <div class="price">Rp70.000</div>
                            <div class="price-label">/sesi</div>
                        </div>
                        <button class="book-button" onclick="bookVenue('Metro Atom')">Pesan</button>
                    </div>
                </div>
            </div>

            <div class="venue-card">
                <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=400&h=220&fit=crop" alt="Centro Sawah Besar" class="venue-image">
                <div class="venue-info">
                    <div class="venue-label">Venue</div>
                    <h3 class="venue-title">Centro Sawah Besar</h3>
                    <div class="venue-details">
                        <div class="venue-rating">
                            <span class="star">★</span>
                            <span>4.70</span>
                        </div>
                        <span>• Kota Jakarta Barat</span>
                    </div>
                    <div class="venue-tags">
                        <span class="tag">Futsal</span>
                    </div>
                    <div class="venue-footer">
                        <div>
                            <div class="price">Rp90.000</div>
                            <div class="price-label">/sesi</div>
                        </div>
                        <button class="book-button" onclick="bookVenue('Centro Sawah Besar')">Pesan</button>
                    </div>
                </div>
            </div>

            <div class="venue-card">
                <img src="https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=400&h=220&fit=crop" alt="Gala Sport Asem Reges" class="venue-image">
                <div class="venue-info">
                    <div class="venue-label">Venue</div>
                    <h3 class="venue-title">Gala Sport Asem Reges</h3>
                    <div class="venue-details">
                        <div class="venue-rating">
                            <span class="star">★</span>
                            <span>4.44</span>
                        </div>
                        <span>• Kota Jakarta Barat</span>
                    </div>
                    <div class="venue-tags">
                        <span class="tag">Futsal</span>
                        <span class="tag">Badminton</span>
                    </div>
                    <div class="venue-footer">
                        <div>
                            <div class="price">Rp50.000</div>
                            <div class="price-label">/sesi</div>
                        </div>
                        <button class="book-button" onclick="bookVenue('Gala Sport')">Pesan</button>
                    </div>
                </div>
            </div>

            <div class="venue-card">
                <img src="https://images.unsplash.com/photo-1551698618-1dfe5d97d256?w=400&h=220&fit=crop" alt="Olympic Futsal Arena" class="venue-image">
                <div class="venue-info">
                    <div class="venue-label">Venue</div>
                    <h3 class="venue-title">Olympic Futsal Arena</h3>
                    <div class="venue-details">
                        <div class="venue-rating">
                            <span class="star">★</span>
                            <span>4.92</span>
                        </div>
                        <span>• Kota Jakarta Selatan</span>
                    </div>
                    <div class="venue-tags">
                        <span class="tag">Futsal</span>
                        <span class="tag">Basketball</span>
                    </div>
                    <div class="venue-footer">
                        <div>
                            <div class="price">Rp85.000</div>
                            <div class="price-label">/sesi</div>
                        </div>
                        <button class="book-button" onclick="bookVenue('Olympic Futsal')">Pesan</button>
                    </div>
                </div>
            </div>

            <div class="venue-card">
                <img src="https://images.unsplash.com/photo-1544725176-7c40e5a71c5e?w=400&h=220&fit=crop" alt="Wisma Badminton Center" class="venue-image">
                <div class="venue-info">
                    <div class="venue-label">Venue</div>
                    <h3 class="venue-title">Wisma Badminton Center</h3>
                    <div class="venue-details">
                        <div class="venue-rating">
                            <span class="star">★</span>
                            <span>4.65</span>
                        </div>
                        <span>• Kota Jakarta Timur</span>
                    </div>
                    <div class="venue-tags">
                        <span class="tag">Badminton</span>
                    </div>
                    <div class="venue-footer">
                        <div>
                            <div class="price">Rp45.000</div>
                            <div class="price-label">/sesi</div>
                        </div>
                        <button class="book-button" onclick="bookVenue('Wisma Badminton')">Pesan</button>
                    </div>
                </div>
            </div>

            <div class="venue-card">
                <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=400&h=220&fit=crop" alt="Grand Slam Tennis Club" class="venue-image">
                <div class="venue-info">
                    <div class="venue-label">Venue</div>
                    <h3 class="venue-title">Grand Slam Tennis Club</h3>
                    <div class="venue-details">
                        <div class="venue-rating">
                            <span class="star">★</span>
                            <span>4.78</span>
                        </div>
                        <span>• Kota Jakarta Utara</span>
                    </div>
                    <div class="venue-tags">
                        <span class="tag">Tennis</span>
                        <span class="tag">Squash</span>
                    </div>
                    <div class="venue-footer">
                        <div>
                            <div class="price">Rp120.000</div>
                            <div class="price-label">/sesi</div>
                        </div>
                        <button class="book-button" onclick="bookVenue('Grand Slam Tennis')">Pesan</button>
                    </div>
                </div>
            </div>

            <div class="venue-card">
                <img src="https://images.unsplash.com/photo-1579952363873-27d3bfad9c0d?w=400&h=220&fit=crop" alt="Victory Basketball Court" class="venue-image">
                <div class="venue-info">
                    <div class="venue-label">Venue</div>
                    <h3 class="venue-title">Victory Basketball Court</h3>
                    <div class="venue-details">
                        <div class="venue-rating">
                            <span class="star">★</span>
                            <span>4.56</span>
                        </div>
                        <span>• Kota Tangerang</span>
                    </div>
                    <div class="venue-tags">
                        <span class="tag">Basketball</span>
                        <span class="tag">Volleyball</span>
                    </div>
                    <div class="venue-footer">
                        <div>
                            <div class="price">Rp60.000</div>
                            <div class="price-label">/sesi</div>
                        </div>
                        <button class="book-button" onclick="bookVenue('Victory Basketball')">Pesan</button>
                    </div>
                </div>
            </div>

            <div class="venue-card">
                <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=400&h=220&fit=crop" alt="Mega Futsal Complex" class="venue-image">
                <div class="venue-info">
                    <div class="venue-label">Venue</div>
                    <h3 class="venue-title">Mega Futsal Complex</h3>
                    <div class="venue-details">
                        <div class="venue-rating">
                            <span class="star">★</span>
                            <span>4.81</span>
                        </div>
                        <span>• Kota Bekasi</span>
                    </div>
                    <div class="venue-tags">
                        <span class="tag">Futsal</span>
                        <span class="tag">Mini Soccer</span>
                    </div>
                    <div class="venue-footer">
                        <div>
                            <div class="price">Rp75.000</div>
                            <div class="price-label">/sesi</div>
                        </div>
                        <button class="book-button" onclick="bookVenue('Mega Futsal')">Pesan</button>
                    </div>
                </div>
            </div>

            <div class="venue-card">
                <img src="https://images.unsplash.com/photo-1544725176-7c40e5a71c5e?w=400&h=220&fit=crop" alt="Elite Badminton Hall" class="venue-image">
                <div class="venue-info">
                    <div class="venue-label">Venue</div>
                    <h3 class="venue-title">Elite Badminton Hall</h3>
                    <div class="venue-details">
                        <div class="venue-rating">
                            <span class="star">★</span>
                            <span>4.73</span>
                        </div>
                        <span>• Kota Depok</span>
                    </div>
                    <div class="venue-tags">
                        <span class="tag">Badminton</span>
                        <span class="tag">Table Tennis</span>
                    </div>
                    <div class="venue-footer">
                        <div>
                            <div class="price">Rp55.000</div>
                            <div class="price-label">/sesi</div>
                        </div>
                        <button class="book-button" onclick="bookVenue('Elite Badminton')">Pesan</button>
                    </div>
                </div>
            </div>

            <div class="venue-card">
                <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=400&h=220&fit=crop" alt="Champions Sports Arena" class="venue-image">
                <div class="venue-info">
                    <div class="venue-label">Venue</div>
                    <h3 class="venue-title">Champions Sports Arena</h3>
                    <div class="venue-details">
                        <div class="venue-rating">
                            <span class="star">★</span>
                            <span>4.67</span>
                        </div>
                        <span>• Kota Bogor</span>
                    </div>
                    <div class="venue-tags">
                        <span class="tag">Futsal</span>
                        <span class="tag">Badminton</span>
                        <span class="tag">Basketball</span>
                    </div>
                    <div class="venue-footer">
                        <div>
                            <div class="price">Rp65.000</div>
                            <div class="price-label">/sesi</div>
                        </div>
                        <button class="book-button" onclick="bookVenue('Champions Sports')">Pesan</button>
                    </div>
                </div>
            </div>

            <div class="venue-card">
                <img src="https://images.unsplash.com/photo-1551698618-1dfe5d97d256?w=400&h=220&fit=crop" alt="Premier Volleyball Center" class="venue-image">
                <div class="venue-info">
                    <div class="venue-label">Venue</div>
                    <h3 class="venue-title">Premier Volleyball Center</h3>
                    <div class="venue-details">
                        <div class="venue-rating">
                            <span class="star">★</span>
                            <span>4.59</span>
                        </div>
                        <span>• Kota Bandung</span>
                    </div>
                    <div class="venue-tags">
                        <span class="tag">Volleyball</span>
                        <span class="tag">Basketball</span>
                    </div>
                    <div class="venue-footer">
                        <div>
                            <div class="price">Rp80.000</div>
                            <div class="price-label">/sesi</div>
                        </div>
                        <button class="book-button" onclick="bookVenue('Premier Volleyball')">Pesan</button>
                    </div>
                </div>
            </div>

            <div class="venue-card">
                <img src="https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=400&h=220&fit=crop" alt="Ultimate Sports Complex" class="venue-image">
                <div class="venue-info">
                    <div class="venue-label">Venue</div>
                    <h3 class="venue-title">Ultimate Sports Complex</h3>
                    <div class="venue-details">
                        <div class="venue-rating">
                            <span class="star">★</span>
                            <span>4.85</span>
                        </div>
                        <span>• Kota Surabaya</span>
                    </div>
                    <div class="venue-tags">
                        <span class="tag">Futsal</span>
                        <span class="tag">Badminton</span>
                        <span class="tag">Tennis</span>
                    </div>
                    <div class="venue-footer">
                        <div>
                            <div class="price">Rp95.000</div>
                            <div class="price-label">/sesi</div>
                        </div>
                        <button class="book-button" onclick="bookVenue('Ultimate Sports')">Pesan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
function bookVenue(venueName) {
            alert(`Booking ${venueName}! Fitur ini akan mengarahkan ke halaman pemesanan.`);
        }

        function smoothScroll() {
            document.querySelector('#venues').scrollIntoView({
                behavior: 'smooth'
            });
        }

        function searchVenue() {
            const venueSearch = document.getElementById('venueSearch').value;
            const citySearch = document.getElementById('citySearch').value;
            const sportSearch = document.getElementById('sportSearch').value;
            
            if (venueSearch || citySearch || sportSearch) {
                alert(`Mencari venue dengan kriteria:\nVenue: ${venueSearch}\nKota: ${citySearch}\nOlahraga: ${sportSearch}`);
            } else {
                alert('Silakan masukkan kriteria pencarian!');
            }
        }

        function openFilters() {
            alert('Membuka filter pencarian...');
        }

        // Event listeners
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.cta-button').addEventListener('click', function(e) {
                e.preventDefault();
                smoothScroll();
            });

            // Enter key untuk search
            document.querySelectorAll('.search-input').forEach(input => {
                input.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        searchVenue();
                    }
                });
            });
        });

</script>

<style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        .hero-section {
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
            padding: 60px 20px;
            text-align: center;
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

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-title {
            color: white;
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 30px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .cta-button {
            background: linear-gradient(45deg, #fbbf24, #f59e0b);
            color: white;
            padding: 15px 30px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: bold;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(251, 191, 36, 0.3);
        }

        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(251, 191, 36, 0.4);
        }

        .cta-button::after {
            content: '→';
            margin-left: 10px;
            transition: transform 0.3s ease;
        }

        .cta-button:hover::after {
            transform: translateX(3px);
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
            border-color: #22c55e;
        }

        .search-btn {
            background: linear-gradient(135deg, #22c55e, #16a34a);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(34, 197, 94, 0.3);
        }

        .search-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(34, 197, 94, 0.4);
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

        .venues-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .venue-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .venue-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }

        .venue-image {
            width: 100%;
            height: 220px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .venue-card:hover .venue-image {
            transform: scale(1.05);
        }

        .venue-info {
            padding: 25px;
        }

        .venue-label {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .venue-title {
            font-size: 20px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 10px;
        }

        .venue-details {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
            color: #6b7280;
            font-size: 14px;
        }

        .venue-rating {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .star {
            color: #fbbf24;
        }

        .venue-tags {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .tag {
            background: #f3f4f6;
            color: #6b7280;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
        }

        .venue-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .price {
            font-size: 18px;
            font-weight: bold;
            color: #22c55e;
        }

        .price-label {
            font-size: 12px;
            color: #6b7280;
        }

        .book-button {
            background: linear-gradient(45deg, #22c55e, #16a34a);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 10px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .book-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(34, 197, 94, 0.3);
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }
            
            .search-row {
                flex-direction: column;
            }
            
            .search-input, .search-btn {
                width: 100%;
                min-width: 100%;
            }

            .venues-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>