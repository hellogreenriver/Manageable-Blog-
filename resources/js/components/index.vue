<template>
  <div id="Myapp">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="#page-top">Enviroment Blog</a>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto my-2 my-lg-0">
                     <div v-if="authCheck">
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" router-link to="{name: 'create'}">Edit</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" @click="logout">Logout</a></li>
                     </div>
                    </ul>
                </div>
            </div>
    </nav>
    
    <header class="masthead" id="blog">
            <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-10 align-self-end">
                        <h1 class="text-uppercase text-white font-weight-bold">Your Favorite Source of Free Bootstrap Themes</h1>
                        <hr class="divider my-4" />
                    </div>
                    <div class="col-lg-8 align-self-baseline">
                        <p class="text-white-75 font-weight-light mb-5">Start Bootstrap can help you build better websites using the Bootstrap framework! Just download a theme and start customizing, no strings attached!</p>
                        <a class="btn btn-primary btn-xl js-scroll-trigger" href="#about">Find Out More</a>
                    </div>
                </div>
            </div>
        
      </header>
      
      <div class="container container-m">
      <transition name="fade" mode="out-in">
          <router-view></router-view>
      </transition>
      </div>
  </div>
</template>
<script>
export default {
  data() {
    return {

      };
    },
    beforeCreate:function () {

        this.$store.dispatch('ImportElements')
  
    },
    methods:{
      logout(){
            axios
                .post("/api/logout")
                .then(response => {
                    console.log(response);
                    localStorage.removeItem("auth");
                    this.$router.push("/list");
                })
                .catch(error => {
                    console.log(error);
                }); 
      },
     
    },
    computed: {
      authCheck(){
        if(!localStorage.getItem('auth')){
          return false
        } else {
          return true
          
        }
      },
     
    }
}
</script>