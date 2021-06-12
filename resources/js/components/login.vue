<?php @can 
<template>
    <div class="container">
        <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <form  class="box" @submit.prevent="login">
                    <h1>Login</h1>
                    <p class="text-muted"> Please enter your Email and Password!</p>
                     <input v-model="email"  placeholder="Email"> <input  v-model="password" type="password" placeholder="Password"> <input type="submit" value="Login" >
                </form>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            email: "",
            password: "",
            errors: {},
        };
    },
    methods: {
        login() {
            axios.get("/sanctum/csrf-cookie").then(response => {
                axios
                    .post("/api/login", {
                        email: this.email,
                        password: this.password
                    })
                    .then(response => {

                        var date = new Date();
                        const now = JSON.stringify({timestamp: date.getTime()});
                        console.log(now);
                        localStorage.setItem("auth", now);
                        this.$router.push({ name: 'create'});
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors;
                        console.log(this.errors)
                    })
            });
        },

    }
};

</script>