<template>
   <div class="container contact">
	<div class="row">
		<div class="col-md-3">
			<div class="contact-info">

				<h2>Edit</h2>
				<h4>All fields required</h4>
			</div>
		</div>
		<div class="col-md-9" v-if="!this.completed">
			<div class="contact-form">
				
				<div class="form-group">
				  <label class="control-label col-sm-2">Name:</label>
				  <div class="col-sm-10">          
					<input type="text" class="form-control"  placeholder="Name" v-model="name" >
					<div class="alert alert-danger" role="alert" v-if="errors.name">{{errors.name[0]}}</div>
				  </div>
				</div>
				<div class="form-group">
				  <label class="control-label col-sm-2" >Title:</label>
				  <div class="col-sm-10">
					<input type="text" class="form-control"  placeholder="Title" v-model="title">
					<div class="alert alert-danger" role="alert" v-if="errors.title">{{errors.title[0]}}</div>
				  </div>
				</div>
                <div class="form-group">
				  <label class="control-label col-sm-2" >Text:</label>
				  <div class="col-sm-10">
					<input type="text" class="form-control"  placeholder="Text" v-model="text"> 
					<div class="alert alert-danger" role="alert" v-if="errors.text">{{errors.text[0]}}</div>
				  </div>
				</div>
				<div class="form-group">
				  <label class="control-label col-sm-2">Main text:</label>
				  <div class="col-sm-10">
					<textarea class="form-control" rows="5" v-model="mainText"></textarea>
					<div class="alert alert-danger" role="alert" v-if="errors.mainText">{{errors.mainText[0]}}</div>
				  </div>
				</div>
				<div class="form-group">        
				  <div class="col-sm-offset-2 col-sm-10 text-center">
					<button type="submit" class="btn btn-default" @click="logout">Logout</button>
					<button type="submit"  class="btn btn-default" data-toggle="modal" data-target="#modal1" >Submit</button>
				  </div> 
				  <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
					  <div class="modal-dialog" role="document">
						  <div class="modal-content">
							  
								<div class="modal-body">
									 Do you want to set the following information?
									 {{name}}
									 {{title}}
									 {{text}}
									 {{mainText}}
								 </div>
                                <div class="modal-footer">
									<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
									<button type="button" class="btn btn-primary"  data-dismiss="modal" @click.prevent="postElements">Submit</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
</div>

</template>
<script>
export default {
    data() {
        return {
			name: '',
			title: '',
			text: '',
			mainText: '',
			errors: [],
        };
	},
	created:function () {
		this.checkExpiration()
		},
    methods: {
		postElements() {
			this.isLoading = true
			axios
				 .post("/api/create",{
					 name: this.name,
					 title: this.title,
					 text: this.text,
					 mainText: this.mainText,
				 })
				 .then(response => {
					 const div = document.getElementById('target');
                     div.classList.add('green','blue');
					 this.errors = ''
					 this.name = ''
					 this.title = ''
					 this.text = ''
					 this.mainText = ''
				 })
				 .catch(error => {
					 console.log(error);
					 this.errors = error.response.data.errors;
					 })
				},
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
		checkExpiration(){
          var localstrageTime = JSON.parse(localStorage.getItem("auth")).timestamp;
          if(localstrageTime && localstrageTime!=undefined){
            var timeLimit = this.$store.getters.getTimeLimit;
            var now = new Date().getTime();
            var periodTime = (now-localstrageTime)/1000;
            if(periodTime > timeLimit){
              localStorage.removeItem('auth');
              console.log("localStrage(auth) was deleted")
              this.$router.push('/list').catch(err => {});

              }
            if(!localStorage.getItem('auth')){
              this.$router.push('/list').catch(err => {});
            }
          }
		 },
	},
};
</script>