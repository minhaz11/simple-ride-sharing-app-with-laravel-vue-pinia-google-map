import { createRouter, createWebHistory } from 'vue-router'
import LoginView from '../views/LoginView.vue'
import LandingView from '../views/LandingView.vue'
import LocationView from '../views/LocationView.vue'
import MapView from '../views/MapView.vue'
import  axios  from 'axios'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'login',
      component: LoginView
    },
    {
      path: '/start',
      name: 'start',
      component: LandingView
    },
    {
      path: '/location',
      name: 'FindRide',
      component: LocationView
    },
    {
      path: '/map',
      name: 'map',
      component: MapView
    },
  ]
})

router.beforeEach((to, from, next) => {

  if(to.name === 'login'){
    return next()
  }

  if(!localStorage.getItem('token')){
    router.push({name: 'login'})
  }
  else{
    next()
  }
 
})

// const checkToken = async () => {
//   try {
//     await axios.get('http://localhost:8000/api/user', {
//       headers: {
//         'Authorization': 'Bearer ' + localStorage.getItem('token')
//       }
//     })
    
//   } catch (error) {
//     localStorage.removeItem('token')
//     router.push({name: 'login'})
//   }  
 
// }

export default router
