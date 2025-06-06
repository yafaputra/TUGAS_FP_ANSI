<template>
  <div class="homepage">
    <!-- Hero Section -->
    <section class="hero">
      <div class="hero-content">
        <div class="hero-image">
          <img src="https://tnova.fr/site/assets/files/10962/wesley-tingey-dkckic0bqtu-unsplash.768x512-u0i0s0q90f1.768x512-u0i0s0q90f1.webp?1gvwp6" 
               alt="Sport Venue" class="main-hero-img">
          <div class="hero-overlay">
            <h1 class="hero-title">Find Your Perfect Sport Venue</h1>
            <p class="hero-subtitle">Book premium sports facilities for your games and events</p>
            <button class="cta-button">
              <span>Explore Venues</span>
              <svg class="cta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
              </svg>
            </button>
          </div>
        </div>
      </div>
    </section>

    <!-- Statistics Section -->
    <section class="stats">
      <div class="container">
        <div class="stats-grid">
          <div class="stat-item">
            <div class="stat-number">500+</div>
            <div class="stat-label">Premium Venues</div>
          </div>
          <div class="stat-item">
            <div class="stat-number">10K+</div>
            <div class="stat-label">Happy Customers</div>
          </div>
          <div class="stat-item">
            <div class="stat-number">50+</div>
            <div class="stat-label">Cities Available</div>
          </div>
          <div class="stat-item">
            <div class="stat-number">24/7</div>
            <div class="stat-label">Customer Support</div>
          </div>
        </div>
      </div>
    </section>

    <!-- Category Section -->
    <section class="categories">
      <div class="container">
        <div class="section-header">
          <h2 class="section-title">Choose Your Sport</h2>
          <p class="section-subtitle">Discover the perfect venue for your favorite sport</p>
        </div>
        <div class="category-grid">
          <div class="category-card" v-for="(category, index) in categories" :key="index">
            <img :src="category.image" :alt="category.name" class="category-img">
            <div class="category-overlay">
              <div class="category-icon">{{ category.icon }}</div>
              <h3>{{ category.name }}</h3>
              <p class="category-count">{{ category.count }} venues</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Recommended Venues Section -->
    <section class="recommended">
      <div class="container">
        <div class="section-header">
          <h2 class="section-title">Recommended Venues</h2>
          <p class="section-subtitle">Hand-picked premium venues just for you</p>
        </div>
        <div class="venues-grid">
          <div class="venue-card" v-for="(venue, index) in venues" :key="index">
            <div class="venue-image">
              <img :src="venue.image" :alt="venue.name">
              <div class="venue-badge" v-if="venue.featured">Featured</div>
              <div class="venue-actions">
                <button class="action-btn favorite">
                  <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                  </svg>
                </button>
                <button class="action-btn share">
                  <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"/>
                  </svg>
                </button>
              </div>
            </div>
            <div class="venue-info">
              <div class="venue-header">
                <h3 class="venue-name">{{ venue.name }}</h3>
                <div class="venue-category">{{ venue.category }}</div>
              </div>
              <div class="venue-rating">
                <div class="stars">
                  <span v-for="star in 5" :key="star" 
                        :class="star <= venue.rating ? 'star-filled' : 'star-empty'">⭐</span>
                </div>
                <span class="rating-score">{{ venue.rating }}</span>
                <span class="rating-count">({{ venue.reviews }} reviews)</span>
              </div>
              <div class="venue-features">
                <span class="feature" v-for="feature in venue.features" :key="feature">
                  {{ feature }}
                </span>
              </div>
              <p class="venue-location">
                <svg class="location-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                {{ venue.location }}
              </p>
              <div class="venue-footer">
                <div class="venue-price">
                  <span class="price">{{ venue.price }}</span>
                  <span class="price-unit">/hour</span>
                </div>
                <button class="book-btn">Book Now</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter">
      <div class="container">
        <div class="newsletter-content">
          <h2>Stay Updated</h2>
          <p>Get the latest venue updates and exclusive offers</p>
          <div class="newsletter-form">
            <input type="email" placeholder="Enter your email address" class="email-input">
            <button class="subscribe-btn">Subscribe</button>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: 'SportVenueHomepage',
  data() {
    return {
      categories: [
        {
          name: 'FOOTBALL',
          icon: '⚽',
          count: 120,
          image: 'https://images.unsplash.com/photo-1553778263-73a83bab9b0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&h=300'
        },
        {
          name: 'BASKETBALL',
          icon: '🏀',
          count: 85,
          image: 'https://images.unsplash.com/photo-1546519638-68e109498ffc?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&h=300'
        },
        {
          name: 'TENNIS',
          icon: '🎾',
          count: 95,
          image: 'https://images.unsplash.com/photo-1622279457486-62dcc4a431d6?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&h=300'
        },
        {
          name: 'BADMINTON',
          icon: '🏸',
          count: 110,
          image: 'https://images.unsplash.com/photo-1594736797933-d0401ba2fe65?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&h=300'
        },
        {
          name: 'VOLLEYBALL',
          icon: '🏐',
          count: 70,
          image: 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&h=250'
        },
        {
          name: 'SWIMMING',
          icon: '🏊‍♂️',
          count: 45,
          image: 'https://images.unsplash.com/photo-1576013551627-0cc20b96c2a7?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&h=300'
        }
      ],
      venues: [
        {
          name: 'Green Court Tennis',
          category: 'Tennis',
          rating: 4.8,
          reviews: 124,
          location: 'Jakarta Selatan',
          price: 'Rp 150.000',
          features: ['AC', 'Parking', 'Shower'],
          featured: true,
          image: 'https://images.unsplash.com/photo-1551698618-1dfe5d97d256?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&h=250'
        },
        {
          name: 'Elite Basketball Court',
          category: 'Basketball',
          rating: 4.9,
          reviews: 89,
          location: 'Jakarta Pusat',
          price: 'Rp 200.000',
          features: ['Indoor', 'Sound System', 'Locker'],
          featured: false,
          image: 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&h=250'
        },
        {
          name: 'Premium Football Field',
          category: 'Football',
          rating: 4.7,
          reviews: 156,
          location: 'Jakarta Barat',
          price: 'Rp 300.000',
          features: ['Natural Grass', 'Floodlight', 'Cafeteria'],
          featured: true,
          image: 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&h=250'
        },
        {
          name: 'Indoor Badminton Hall',
          category: 'Badminton',
          rating: 4.6,
          reviews: 203,
          location: 'Jakarta Timur',
          price: 'Rp 120.000',
          features: ['AC', '6 Courts', 'Equipment Rental'],
          featured: false,
          image: 'https://images.unsplash.com/photo-1594736797933-d0401ba2fe65?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&h=250'
        },
        {
          name: 'Modern Volleyball Court',
          category: 'Volleyball',
          rating: 4.8,
          reviews: 67,
          location: 'Jakarta Utara',
          price: 'Rp 180.000',
          features: ['Beach Volleyball', 'Night Light', 'Shower'],
          featured: false,
          image: 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&h=250'
        },
        {
          name: 'Pro Tennis Academy',
          category: 'Tennis',
          rating: 4.9,
          reviews: 178,
          location: 'Tangerang',
          price: 'Rp 250.000',
          features: ['Coach Available', 'Clay Court', 'Pro Shop'],
          featured: true,
          image: 'https://images.unsplash.com/photo-1622279457486-62dcc4a431d6?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&h=250'
        }
      ]
    }
  }
}
</script>

<style scoped>
* {
  box-sizing: border-box;
}

.homepage {
  min-height: 100vh;
  background: #f8fafc;
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
}

/* Hero Section */
.hero {
  position: relative;
  height: 70vh;
  min-height: 600px;
  overflow: hidden;
}

.hero-content {
  height: 100%;
}

.hero-image {
  position: relative;
  height: 100%;
  width: 100%;
}

.main-hero-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  filter: brightness(0.6);
}

.hero-overlay {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
  color: white;
  z-index: 2;
  max-width: 600px;
  padding: 0 20px;
}

.hero-title {
  font-size: 3.5rem;
  font-weight: 800;
  margin-bottom: 20px;
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
  line-height: 1.1;
}

.hero-subtitle {
  font-size: 1.3rem;
  font-weight: 400;
  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
  margin-bottom: 30px;
  opacity: 0.9;
}

.cta-button {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  background: linear-gradient(135deg, #10b981, #059669);
  color: white;
  border: none;
  padding: 15px 30px;
  border-radius: 50px;
  font-size: 1.1rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
}

.cta-button:hover {
  transform: translateY(-2px);
  box-shadow: 0 12px 35px rgba(16, 185, 129, 0.4);
}

.cta-icon {
  width: 20px;
  height: 20px;
  transition: transform 0.3s ease;
}

.cta-button:hover .cta-icon {
  transform: translateX(3px);
}

/* Stats Section */
.stats {
  padding: 60px 0;
  background: white;
  border-bottom: 1px solid #e5e7eb;
}

.stats-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 40px;
  text-align: center;
}

.stat-item {
  padding: 20px;
}

.stat-number {
  font-size: 2.5rem;
  font-weight: 800;
  color: #10b981;
  margin-bottom: 10px;
}

.stat-label {
  font-size: 1rem;
  color: #6b7280;
  font-weight: 500;
}

/* Container */
.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
}

/* Section Header */
.section-header {
  text-align: center;
  margin-bottom: 60px;
}

.section-title {
  font-size: 2.5rem;
  font-weight: 800;
  color: #1f2937;
  margin-bottom: 15px;
  letter-spacing: -0.5px;
}

.section-subtitle {
  font-size: 1.2rem;
  color: #6b7280;
  font-weight: 400;
}

/* Categories Section */
.categories {
  padding: 80px 0;
  background: white;
}

.category-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 30px;
}

.category-card {
  position: relative;
  height: 280px;
  border-radius: 20px;
  overflow: hidden;
  cursor: pointer;
  transition: all 0.4s ease;
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.category-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.category-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.4s ease;
}

.category-card:hover .category-img {
  transform: scale(1.1);
}

.category-overlay {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  background: linear-gradient(to top, rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0.3));
  color: white;
  padding: 30px;
  text-align: center;
  transform: translateY(0);
  transition: transform 0.3s ease;
}

.category-icon {
  font-size: 2rem;
  margin-bottom: 10px;
}

.category-overlay h3 {
  font-size: 1.3rem;
  font-weight: 700;
  letter-spacing: 1px;
  margin-bottom: 5px;
}

.category-count {
  font-size: 0.9rem;
  opacity: 0.8;
}

/* Recommended Venues Section */
.recommended {
  padding: 80px 0;
  background: #f8fafc;
}

.venues-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 30px;
}

.venue-card {
  background: white;
  border-radius: 20px;
  overflow: hidden;
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
  transition: all 0.4s ease;
  cursor: pointer;
}

.venue-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
}

.venue-image {
  position: relative;
  height: 220px;
  overflow: hidden;
}

.venue-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.4s ease;
}

.venue-card:hover .venue-image img {
  transform: scale(1.05);
}

.venue-badge {
  position: absolute;
  top: 15px;
  left: 15px;
  background: linear-gradient(135deg, #f59e0b, #d97706);
  color: white;
  padding: 6px 12px;
  border-radius: 20px;
  font-size: 0.8rem;
  font-weight: 600;
}

.venue-actions {
  position: absolute;
  top: 15px;
  right: 15px;
  display: flex;
  gap: 8px;
  opacity: 0;
  transition: opacity 0.3s ease;
}

.venue-card:hover .venue-actions {
  opacity: 1;
}

.action-btn {
  width: 36px;
  height: 36px;
  border-radius: 50%;
  border: none;
  background: rgba(255, 255, 255, 0.9);
  color: #6b7280;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.3s ease;
}

.action-btn:hover {
  background: white;
  color: #10b981;
  transform: scale(1.1);
}

.action-btn svg {
  width: 18px;
  height: 18px;
}

.venue-info {
  padding: 25px;
}

.venue-header {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  margin-bottom: 15px;
}

.venue-name {
  font-size: 1.3rem;
  font-weight: 700;
  color: #1f2937;
  margin: 0;
}

.venue-category {
  background: #e5f7f0;
  color: #10b981;
  padding: 4px 12px;
  border-radius: 12px;
  font-size: 0.8rem;
  font-weight: 600;
}

.venue-rating {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-bottom: 15px;
}

.stars {
  display: flex;
  gap: 2px;
}

.star-filled {
  color: #fbbf24;
  font-size: 0.9rem;
}

.star-empty {
  color: #d1d5db;
  font-size: 0.9rem;
}

.rating-score {
  font-weight: 700;
  color: #10b981;
  font-size: 0.95rem;
}

.rating-count {
  color: #6b7280;
  font-size: 0.85rem;
}

.venue-features {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin-bottom: 15px;
}

.feature {
  background: #f3f4f6;
  color: #4b5563;
  padding: 4px 10px;
  border-radius: 12px;
  font-size: 0.8rem;
  font-weight: 500;
}

.venue-location {
  display: flex;
  align-items: center;
  gap: 6px;
  color: #6b7280;
  font-size: 0.95rem;
  margin-bottom: 20px;
}

.location-icon {
  width: 16px;
  height: 16px;
}

.venue-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.venue-price {
  display: flex;
  align-items: baseline;
  gap: 5px;
}

.price {
  font-size: 1.4rem;
  font-weight: 800;
  color: #10b981;
}

.price-unit {
  font-size: 0.9rem;
  color: #6b7280;
}

.book-btn {
  background: linear-gradient(135deg, #10b981, #059669);
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 25px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
}

.book-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
}

/* Newsletter Section */
.newsletter {
  padding: 80px 0;
  background: linear-gradient(135deg, #1f2937, #111827);
  color: white;
}

.newsletter-content {
  text-align: center;
  max-width: 600px;
  margin: 0 auto;
}

.newsletter-content h2 {
  font-size: 2.5rem;
  font-weight: 800;
  margin-bottom: 15px;
}

.newsletter-content p {
  font-size: 1.2rem;
  opacity: 0.8;
  margin-bottom: 40px;
}

.newsletter-form {
  display: flex;
  gap: 15px;
}

.email-input {
  flex: 1;
  padding: 15px 20px;
  border: none;
  border-radius: 50px;
  font-size: 1rem;
  outline: none;
}

.subscribe-btn {
  background: linear-gradient(135deg, #10b981, #059669);
  color: white;
  border: none;
  padding: 15px 30px;
  border-radius: 50px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  white-space: nowrap;
}

.subscribe-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
}

/* Responsive Design */
@media (max-width: 1024px) {
  .venues-grid {
    grid-template-columns: repeat(2, 1fr);
  }
  
  .category-grid {
    grid-template-columns: repeat(2, 1fr);
  }
  
  .stats-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 30px;
  }
}

@media (max-width: 768px) {
  .hero-title {
    font-size: 2.5rem;
  }
  
  .hero-subtitle {
    font-size: 1.1rem;
  }
  
  .section-title {
    font-size: 2rem;
  }
  
  .venues-grid,
  .category-grid {
    grid-template-columns: 1fr;
  }
  
  .stats-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
  }
  
  .newsletter-form {
    flex-direction: column;
  }
  
  .venue-header {
    flex-direction: column;
    align-items: flex-start;
    gap: 10px;
  }
}

@media (max-width: 480px) {
  .hero {
    height: 60vh;
    min-height: 500px;
  }
  
  .hero-title {
    font-size: 2rem;
  }
  
  .section-title {
    font-size: 1.8rem;
  }
  
  .stats-grid {
    grid-template-columns: 1fr;
    gap: 30px;
  }
  
  .container {
    padding: 0 15px;
  }
  
  .venue-info {
    padding: 20px;
  }
}
</style>