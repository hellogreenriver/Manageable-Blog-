<template>
 <div>
     <div class="row" v-for="elements in groupedElements" >
        <div class="col-sm-4 pb-4" v-for="element in elements" :key="element.id">
          
                <div class="card" style="width: 25vw;" >
                    <img class="card-img-top"  src="/images/todd-trapani-a-AqoJXVYVY-unsplash.jpg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{ element.title}}</h5>
                    <p class="card-text">{{ element.text}}</p>
                    <router-link :to="{path:`/list/${element.id}`}">Read more</router-link>
                  

                </div>
                
                </div>
            
        </div>
    </div>

  
      <ul class="pagination">       
          <li class="inactive" :class="(current_page == 1) ? 'disabled' : ''"@click="changePage(current_page-1)">«</li>
          <li v-for="page in frontPageRange"  @click="changePage(page)" :class="(isCurrent(page)) ? 'active' : 'inactive'">{{ page }}</li>
          <li v-show="front_dot" class="inactive disabled">...</li>
          <li v-for="page in middlePageRange"  @click="changePage(page)" :class="(isCurrent(page)) ? 'active' : 'inactive'">{{ page }}</li>
          <li v-show="end_dot" class="inactive disabled">...</li>
          <li v-for="page in endPageRange"  @click="changePage(page)" :class="(isCurrent(page)) ? 'active' : 'inactive'">{{ page }}</li>
          <li class="inactive" :class="(current_page >= last_page) ? 'disabled' : ''" @click="changePage(current_page+1)">»</li>
      </ul>
  
 </div>
</template>

<script>
export default {
    
    data() {
        return {
           elements:[],
           current_page: 1,
           last_page: "",
           range: 5,
           front_dot: false,
           end_dot: false,
        };
    },
    created:function () {
        this.getElements()
    },
    methods: {
        async getElements() {
            const result = await axios.get(`/api/elements?page=${this.current_page}`);
            this.current_page = result.data.current_page;
            this.last_page = result.data.last_page;
            this.elements = result.data.data;

        },
        calRange(start, end) {
            const range = [];
            for (let i = start; i <= end; i++) {
                range.push(i);
            }
            return range;
        },
        changePage(page) {
            if (page > 0 && page <= this.last_page) {
            this.current_page = page;
            this.getElements();
            }
        },
        isCurrent(page) {
            return page === this.current_page;
        },
        moveBlogPage(element){
            this.$router.push({path:`list/${element.id}`,params:{id: element.id, title: element.title, mainText: element.mainText} })
            
            console.log(this.$router)
        }
    },
    computed: {
        groupedElements() {
           return _.chunk(this.elements, 3)
        },
        frontPageRange() {
            if (!this.sizeCheck){ return [];}
            else{ return this.calRange(1, 2);}
        },
        middlePageRange() {
            let start = "";
            let end = "";
            if (!this.sizeCheck){ return this.calRange(1, this.last_page)}
            else if (this.current_page <= this.range) {
                start = 3;
                end = this.range + 2;
                this.front_dot = false;
                this.end_dot = true;
            } else if (this.current_page > this.last_page - this.range) {
                start = this.last_page - this.range - 1;
                end = this.last_page - 2;
                this.front_dot = true;
                this.end_dot = false;
            } else {
                start = this.current_page - Math.floor(this.range / 2);
                end = this.current_page + Math.floor(this.range / 2);
                this.front_dot = true;
                this.end_dot = true;
            }
            return this.calRange(start, end);
        },
        endPageRange() {
            if (!this.sizeCheck){ return [];
            }else{
                return this.calRange(this.last_page - 1, this.last_page);
            }
        },
        sizeCheck() {
            if (this.last_page < this.range) {
                return false;
            }
            return true;
        },
        
    },
}
</script>
<style>
.pagination {
  display: flex;
  list-style-type: none;
}
.pagination li {
  border: 1px solid #ddd;
  padding: 6px 12px;
  text-align: center;
  
}
.pagination li + li {
  border-left: none;
}
.active {
  color: #f4623a;
}
.disabled {
  cursor: not-allowed;
}
</style>
