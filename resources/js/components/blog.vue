<template>
<div>
   <h1>{{this.elements.title}}</h1>
   <div class="text-center">
       <img src="/images/todd-trapani-a-AqoJXVYVY-unsplash.jpg" class="img-fluid" alt="image">
   </div>
   <p>{{this.elements.text}}</p>
   <p>{{this.elements.mainText}}</p>

</div>
</template>
<script>
export default {
     data() {
        return {
            elements:[],
            id:"",
            result:[],
            title:"",
            text:"",
            mainText:'',
        };
    },
    created:function () {
      axios.get('/api/find',  {params: {id:this.$route.params.id}} )
             .then(response => {
                 console.log(response.data)
                this.elements = response.data
            })
    },
    methods:{

    },
    

}
</script>