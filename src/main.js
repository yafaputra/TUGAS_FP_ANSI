import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

// Import CSS Bootstrap
import 'bootstrap/dist/css/bootstrap.min.css'

// Import JS Bootstrap (opsional, untuk modal, dropdown, dll)
import 'bootstrap/dist/js/bootstrap.bundle.min.js'

const app = createApp(App)

app.use(router)
app.mount('#app')

