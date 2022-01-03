<template>
    <div>
        <div class="all-cards" >
            <div class="cards-new " v-for="(card,index) in res" :key="card.id" draggable="true" :data-id="card.id" v-click="infoCard(index)">
                <div class="image-card"></div>
                <div class="titles-card"> 
                    <p>{{card.title}}</p>
                </div>
                <div class="footer-card">
                    <div class="circle-people-card"></div>
                </div>
            </div>
        </div>
        <card-info :descriptionCard="" :idInfo="" :titleCard=""></card-info>
    </div>
</template>

<script>
import axios from 'axios';
import CardInfo from './CardInfo.vue'
export default {
  name: 'Card',  
  components:{
      CardInfo
  },
  data(){
      return{
        uri : 'http://localhost:8000',
        res: [],   
        infoCard:'' 
    }
  },
  methods:{
      infoCard(clickedId){
          
      }
  },
  mounted(){
      let url = this.uri + "/ajax/field-info"
      axios.get(url).then((msg) => {
           this.res = msg.data
      });
  }
}
</script>

<style>

</style>