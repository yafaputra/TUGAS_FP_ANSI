<template>
  <nav class="navbar" :class="{ 'scrolled': isScrolled }">
    <div class="nav-container">
      <!-- Logo Section -->
      <div class="logo">
        <div class="logo-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                  d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
          </svg>
        </div>
        <span class="logo-text">SportVenue</span>
        <div class="logo-subtitle">Book & Play</div>
      </div>

      <!-- Desktop Navigation -->
      <ul class="nav-links" :class="{ 'mobile-active': isMobileMenuOpen }">
        <li class="nav-item">
          <router-link to="/Hompage" class="nav-link">
            <div class="nav-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
              </svg>
            </div>
            <span>Home</span>
            <div class="nav-indicator"></div>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link to="/venue" class="nav-link">
            <div class="nav-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1"/>
              </svg>
            </div>
            <span>Venue</span>
            <div class="nav-indicator"></div>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link to="/event" class="nav-link">
            <div class="nav-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
              </svg>
            </div>
            <span>Event</span>
            <div class="nav-indicator"></div>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link to="/sparring" class="nav-link">
            <div class="nav-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
              </svg>
            </div>
            <span>Sparring</span>
            <div class="nav-indicator"></div>
          </router-link>
        </li>
        
        <!-- Mobile-only Login/Register -->
        <li class="nav-item mobile-only">
          <router-link to="/login" class="nav-link">
            <div class="nav-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
              </svg>
            </div>
            <span>Login</span>
          </router-link>
        </li>
        <li class="nav-item mobile-only">
          <router-link to="/register" class="nav-link">
            <div class="nav-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
              </svg>
            </div>
            <span>Sign Up</span>
          </router-link>
        </li>
      </ul>

      <!-- Auth Buttons (Desktop) -->
      <div class="auth-buttons">
        <router-link to="/register" class="signup-btn">Sign Up</router-link>
        <router-link to="/login" class="login-btn">Login</router-link>
      </div>

      <!-- Mobile Menu Toggle -->
      <div class="mobile-menu-toggle" @click="toggleMobileMenu" :class="{ 'active': isMobileMenuOpen }">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>

    <!-- Mobile Overlay -->
    <div class="mobile-overlay" v-if="isMobileMenuOpen" @click="closeMobileMenu"></div>
  </nav>
</template>

<script>
export default {
  name: 'EnhancedNavbar',
  data() {
    return {
      isMobileMenuOpen: false,
      isScrolled: false
    }
  },
  mounted() {
    window.addEventListener('scroll', this.handleScroll)
    window.addEventListener('resize', this.handleResize)
  },
  beforeUnmount() {
    window.removeEventListener('scroll', this.handleScroll)
    window.removeEventListener('resize', this.handleResize)
  },
  methods: {
    toggleMobileMenu() {
      this.isMobileMenuOpen = !this.isMobileMenuOpen
    },
    closeMobileMenu() {
      this.isMobileMenuOpen = false
    },
    handleScroll() {
      this.isScrolled = window.scrollY > 50
    },
    handleResize() {
      if (window.innerWidth > 768) {
        this.isMobileMenuOpen = false
      }
    }
  }
}
</script>

<style scoped>
.navbar {
  background: linear-gradient(135deg, #10b981 0%, #059669 100%);
  box-shadow: 0 4px 20px rgba(16, 185, 129, 0.15);
  position: sticky;
  top: 0;
  z-index: 1000;
  transition: all 0.3s ease;
  backdrop-filter: blur(10px);
}

.navbar.scrolled {
  background: rgba(16, 185, 129, 0.95);
  box-shadow: 0 8px 30px rgba(16, 185, 129, 0.2);
}

.nav-container {
  max-width: 1200px;
  margin: 0 auto;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0 32px;
  height: 80px;
  transition: height 0.3s ease;
  gap: 60px;
}

.navbar.scrolled .nav-container {
  height: 70px;
}

/* Logo Section */
.logo {
  display: flex;
  align-items: center;
  gap: 12px;
  cursor: pointer;
  transition: transform 0.3s ease;
}

.logo:hover {
  transform: scale(1.05);
}

.logo-icon {
  width: 40px;
  height: 40px;
  background: rgba(255, 255, 255, 0.15);
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  transition: all 0.3s ease;
}

.logo:hover .logo-icon {
  background: rgba(255, 255, 255, 0.25);
  transform: rotate(360deg);
}

.logo-icon svg {
  width: 24px;
  height: 24px;
}

.logo-text {
  font-size: 2rem;
  font-weight: 800;
  color: white;
  letter-spacing: -1px;
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
}

.logo-subtitle {
  font-size: 0.75rem;
  color: rgba(255, 255, 255, 0.8);
  font-weight: 500;
  letter-spacing: 0.5px;
  margin-top: -5px;
}

/* Navigation Links */
.nav-links {
  list-style: none;
  display: flex;
  gap: 24px;
  margin: 0;
  padding: 0;
  align-items: center;
}

.nav-item {
  position: relative;
}

.nav-link {
  color: white;
  text-decoration: none;
  font-weight: 600;
  font-size: 0.95rem;
  padding: 12px 24px;
  border-radius: 16px;
  transition: all 0.3s ease;
  position: relative;
  overflow: hidden;
  display: flex;
  align-items: center;
  gap: 8px;
  backdrop-filter: blur(10px);
}

.nav-icon {
  width: 18px;
  height: 18px;
  opacity: 0.8;
  transition: all 0.3s ease;
}

.nav-icon svg {
  width: 100%;
  height: 100%;
}

.nav-link:hover .nav-icon {
  opacity: 1;
  transform: scale(1.1);
}

.nav-link::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(255, 255, 255, 0.1);
  border-radius: 16px;
  opacity: 0;
  transition: opacity 0.3s ease;
}

.nav-link:hover::before {
  opacity: 1;
}

.nav-indicator {
  position: absolute;
  bottom: -2px;
  left: 50%;
  transform: translateX(-50%);
  width: 0;
  height: 3px;
  background: white;
  border-radius: 2px;
  transition: width 0.3s ease;
}

.nav-link:hover .nav-indicator {
  width: 60%;
}

.nav-link.router-link-active {
  background: rgba(255, 255, 255, 0.2);
  color: white;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
  border: 1px solid rgba(255, 255, 255, 0.3);
}

.nav-link.router-link-active .nav-indicator {
  width: 80%;
}

.nav-link.router-link-active .nav-icon {
  opacity: 1;
}

/* Auth Buttons */
.auth-buttons {
  display: flex;
  align-items: center;
  gap: 16px;
  margin-left: 40px;
}

.signup-btn,
.login-btn {
  padding: 10px 20px;
  border-radius: 12px;
  font-weight: 600;
  font-size: 0.9rem;
  cursor: pointer;
  transition: all 0.3s ease;
  border: 2px solid transparent;
  text-decoration: none;
  display: inline-block;
  text-align: center;
  white-space: nowrap;
  line-height: 1.2;
}

.signup-btn {
  background: rgba(255, 255, 255, 0.15);
  color: white;
  border-color: rgba(255, 255, 255, 0.3);
  backdrop-filter: blur(10px);
}

.signup-btn:hover {
  background: rgba(255, 255, 255, 0.25);
  border-color: rgba(255, 255, 255, 0.5);
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

.login-btn {
  background: white;
  color: #10b981;
  border-color: white;
}

.login-btn:hover {
  background: #f8fafc;
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

/* Mobile Menu */
.mobile-menu-toggle {
  display: none;
  flex-direction: column;
  cursor: pointer;
  gap: 5px;
  width: 30px;
  height: 30px;
  justify-content: center;
  align-items: center;
}

.mobile-menu-toggle span {
  width: 25px;
  height: 3px;
  background: white;
  border-radius: 2px;
  transition: all 0.3s ease;
  transform-origin: center;
}

.mobile-menu-toggle.active span:nth-child(1) {
  transform: rotate(45deg) translate(7px, 7px);
}

.mobile-menu-toggle.active span:nth-child(2) {
  opacity: 0;
}

.mobile-menu-toggle.active span:nth-child(3) {
  transform: rotate(-45deg) translate(7px, -7px);
}

.mobile-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  z-index: 999;
}

.mobile-only {
  display: none;
}

/* Responsive Design */
@media (max-width: 768px) {
  .nav-container {
    padding: 0 15px;
    height: 70px;
  }
  
  .logo-text {
    font-size: 1.6rem;
  }
  
  .logo-subtitle {
    font-size: 0.7rem;
  }
  
  .auth-buttons {
    display: none;
  }
  
  .nav-links {
    display: none;
    position: fixed;
    top: 70px;
    left: 0;
    width: 100%;
    height: calc(100vh - 70px);
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    flex-direction: column;
    gap: 0;
    padding: 30px 0;
    backdrop-filter: blur(10px);
    z-index: 1000;
  }
  
  .nav-links.mobile-active {
    display: flex;
    animation: slideInRight 0.3s ease;
  }
  
  .nav-item {
    width: 100%;
    padding: 0 20px;
  }
  
  .nav-link {
    padding: 18px 20px;
    border-radius: 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    justify-content: flex-start;
    font-size: 1.1rem;
  }
  
  .nav-link .nav-icon {
    width: 20px;
    height: 20px;
  }
  
  .mobile-only {
    display: block;
  }
  
  .mobile-menu-toggle {
    display: flex;
  }
}

@media (max-width: 480px) {
  .nav-container {
    height: 60px;
  }
  
  .logo-text {
    font-size: 1.4rem;
  }
  
  .logo-icon {
    width: 35px;
    height: 35px;
  }
  
  .nav-links {
    top: 60px;
    height: calc(100vh - 60px);
  }
}

/* Animations */
@keyframes slideInRight {
  from {
    transform: translateX(100%);
    opacity: 0;
  }
  to {
    transform: translateX(0);
    opacity: 1;
  }
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>