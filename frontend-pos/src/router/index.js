import Dashboard from '../Dashboard.vue'
import Invoice from '../pages/Invoice.vue'
import Login from '../pages/Login.vue'
import Register from '../pages/Register.vue'

const routes = [
  { 
    path: '/', 
    component: Dashboard , 
    name : 'dashboard' ,
    meta: {
      auth : true ,
    },
  },
  { 
    path: '/invoices', 
    component: Invoice , 
    name : 'invoices' ,
    meta: {
      auth : true ,
    },
  },
  { path: '/login', component: Login },
  { path: '/register', component: Register },
]

export default routes