<style>
@import '@/assets/css/Register.css';
</style>

<!-- Register.vue -->
<template>
  <div class="auth-container">
    <!-- Background Animation -->
    <div class="background-animation">
      <div class="floating-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
        <div class="shape shape-4"></div>
        <div class="shape shape-5"></div>
      </div>
    </div>

    <div class="auth-card">
      <!-- Header -->
      <div class="auth-header">
        <div class="logo-section">
          <div class="logo-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                    d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
            </svg>
          </div>
          <h1>SportVenue</h1>
          <p class="subtitle">Book & Play</p>
        </div>
        <h2 class="auth-title">Create Account</h2>
        <p class="auth-description">Join us to book your favorite sports venues</p>
      </div>

      <!-- Register Form -->
      <form @submit.prevent="handleRegister" class="auth-form">
        <div class="form-row">
          <div class="form-group">
            <label for="firstName" class="form-label">First Name</label>
            <div class="input-container">
              <div class="input-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
              </div>
              <input
                type="text"
                id="firstName"
                v-model="registerForm.firstName"
                class="form-input"
                placeholder="First name"
                required
              />
            </div>
            <span v-if="errors.firstName" class="error-message">{{ errors.firstName }}</span>
          </div>

          <div class="form-group">
            <label for="lastName" class="form-label">Last Name</label>
            <div class="input-container">
              <div class="input-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
              </div>
              <input
                type="text"
                id="lastName"
                v-model="registerForm.lastName"
                class="form-input"
                placeholder="Last name"
                required
              />
            </div>
            <span v-if="errors.lastName" class="error-message">{{ errors.lastName }}</span>
          </div>
        </div>

        <div class="form-group">
          <label for="email" class="form-label">Email Address</label>
          <div class="input-container">
            <div class="input-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
              </svg>
            </div>
            <input
              type="email"
              id="email"
              v-model="registerForm.email"
              class="form-input"
              placeholder="Enter your email"
              required
            />
          </div>
          <span v-if="errors.email" class="error-message">{{ errors.email }}</span>
        </div>

        <div class="form-group">
          <label for="phone" class="form-label">Phone Number</label>
          <div class="input-container">
            <div class="input-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
              </svg>
            </div>
            <input
              type="tel"
              id="phone"
              v-model="registerForm.phone"
              class="form-input"
              placeholder="Enter your phone number"
              required
            />
          </div>
          <span v-if="errors.phone" class="error-message">{{ errors.phone }}</span>
        </div>

        <div class="form-group">
          <label for="password" class="form-label">Password</label>
          <div class="input-container">
            <div class="input-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                <circle cx="12" cy="16" r="1"/>
                <path d="m7 11V7a5 5 0 0 1 10 0v4"/>
              </svg>
            </div>
            <input
              :type="showPassword ? 'text' : 'password'"
              id="password"
              v-model="registerForm.password"
              class="form-input"
              placeholder="Create a password"
              required
            />
            <button
              type="button"
              @click="togglePassword"
              class="password-toggle"
            >
              <svg v-if="showPassword" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"/>
              </svg>
              <svg v-else viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                <circle cx="12" cy="12" r="3"/>
              </svg>
            </button>
          </div>
          <span v-if="errors.password" class="error-message">{{ errors.password }}</span>
        </div>

        <div class="form-group">
          <label for="confirmPassword" class="form-label">Confirm Password</label>
          <div class="input-container">
            <div class="input-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                <circle cx="12" cy="16" r="1"/>
                <path d="m7 11V7a5 5 0 0 1 10 0v4"/>
              </svg>
            </div>
            <input
              :type="showConfirmPassword ? 'text' : 'password'"
              id="confirmPassword"
              v-model="registerForm.confirmPassword"
              class="form-input"
              placeholder="Confirm your password"
              required
            />
            <button
              type="button"
              @click="toggleConfirmPassword"
              class="password-toggle"
            >
              <svg v-if="showConfirmPassword" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"/>
              </svg>
              <svg v-else viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                <circle cx="12" cy="12" r="3"/>
              </svg>
            </button>
          </div>
          <span v-if="errors.confirmPassword" class="error-message">{{ errors.confirmPassword }}</span>
        </div>

        <div class="form-options">
          <label class="checkbox-container">
            <input type="checkbox" v-model="registerForm.agreeTerms" required>
            <span class="checkmark"></span>
            I agree to the <a href="#" class="terms-link">Terms of Service</a> and <a href="#" class="terms-link">Privacy Policy</a>
          </label>
        </div>

        <button type="submit" class="auth-button" :disabled="isLoading">
          <span v-if="isLoading" class="loading-spinner"></span>
          {{ isLoading ? 'Creating Account...' : 'Create Account' }}
        </button>
      </form>

      <!-- Footer -->
      <div class="auth-footer">
        <p>Already have an account? 
          <router-link to="/login" class="auth-link">Sign in here</router-link>
        </p>
      </div>

      <!-- Social Login -->
      <div class="social-login">
        <div class="divider">
          <span>Or continue with</span>
        </div>
        <div class="social-buttons">
          <button class="social-btn google" @click="registerWithGoogle">
            <svg viewBox="0 0 24 24">
              <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
              <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
              <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
              <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
            </svg>
            Google
          </button>
          <button class="social-btn facebook" @click="registerWithFacebook">
            <svg viewBox="0 0 24 24">
              <path fill="#1877F2" d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
            </svg>
            Facebook
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Register',
  data() {
    return {
      registerForm: {
        firstName: '',
        lastName: '',
        email: '',
        phone: '',
        password: '',
        confirmPassword: '',
        agreeTerms: false
      },
      errors: {},
      isLoading: false,
      showPassword: false,
      showConfirmPassword: false
    }
  },
  methods: {
    async handleRegister() {
      this.errors = {}
      this.isLoading = true

      // Validation
      if (!this.registerForm.firstName.trim()) {
        this.errors.firstName = 'First name is required'
      }

      if (!this.registerForm.lastName.trim()) {
        this.errors.lastName = 'Last name is required'
      }

      if (!this.registerForm.email) {
        this.errors.email = 'Email is required'
      } else if (!this.isValidEmail(this.registerForm.email)) {
        this.errors.email = 'Please enter a valid email'
      }

      if (!this.registerForm.phone) {
        this.errors.phone = 'Phone number is required'
      } else if (!this.isValidPhone(this.registerForm.phone)) {
        this.errors.phone = 'Please enter a valid phone number'
      }

      if (!this.registerForm.password) {
        this.errors.password = 'Password is required'
      } else if (this.registerForm.password.length < 8) {
        this.errors.password = 'Password must be at least 8 characters'
      } else if (!this.isStrongPassword(this.registerForm.password)) {
        this.errors.password = 'Password must contain at least one uppercase letter, one lowercase letter, and one number'
      }

      if (!this.registerForm.confirmPassword) {
        this.errors.confirmPassword = 'Please confirm your password'
      } else if (this.registerForm.password !== this.registerForm.confirmPassword) {
        this.errors.confirmPassword = 'Passwords do not match'
      }

      if (!this.registerForm.agreeTerms) {
        this.errors.terms = 'You must agree to the Terms of Service'
      }

      if (Object.keys(this.errors).length > 0) {
        this.isLoading = false
        return
      }

      try {
        // Simulate API call
        await new Promise(resolve => setTimeout(resolve, 2000))
        
        // Here you would typically make an API call to your backend
        console.log('Register attempt:', this.registerForm)
        
        // On success, redirect to login or dashboard
        this.$router.push('/login')
        
      } catch (error) {
        console.error('Registration error:', error)
        this.errors.general = 'Registration failed. Please try again.'
      } finally {
        this.isLoading = false
      }
    },

    togglePassword() {
      this.showPassword = !this.showPassword
    },

    toggleConfirmPassword() {
      this.showConfirmPassword = !this.showConfirmPassword
    },

    isValidEmail(email) {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
      return emailRegex.test(email)
    },

    isValidPhone(phone) {
      const phoneRegex = /^[\+]?[1-9][\d]{0,15}$/
      return phoneRegex.test(phone.replace(/\s/g, ''))
    },

    isStrongPassword(password) {
      const strongRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])/
      return strongRegex.test(password)
    },

    registerWithGoogle() {
      console.log('Google registration')
      // Implement Google OAuth registration
    },

    registerWithFacebook() {
      console.log('Facebook registration')
      // Implement Facebook OAuth registration
    }
  }
}
</script>
