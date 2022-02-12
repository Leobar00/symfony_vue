<template>
    <div>
        <div class="all-cards" >
            <template v-for="(card,index) in res" >
                <template v-if="card.colonna.id == idColonna">
                    <div class="cards-new"  draggable="true" :data-id="card.id" @click="infoCard(index)" :key="card.id" :data-column="idColonna">
                        <div class="image-card"></div>
                        <div class="titles-card"> 
                            <p>{{card.title}}</p>
                        </div>
                        <div class="footer-card">
                            <div class="circle-people-card"></div>
                        </div>
                    </div>
                </template>
            </template>    
        </div>
        <card-info :description-card="info.description" :id-info="info.id" :title-card="info.title" >
            <button class="update button" slot="update" type="submit" @click="updateCard()"><i class="fas fa-sync"></i> Aggiorna </button>
            <button slot="delete" class="delete button" type="submit" @click="deleteCard()"><i class="fas fa-trash"></i> Delete</button>
        </card-info>
        <div class="new-card">
            <card-info description-card="" :id-info="idColonna" title-card="">
                <button slot="update" class="create button" type="submit" @click="createCard(idColonna)"><i class="fas fa-plus-circle"></i> Crea</button>
            </card-info>
        </div>
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
  props:['idColonna'],
  data(){
      return{
        uri : 'http://localhost:8000',
        res: [],   
        info:'',
        descr: '',
        column: '',
    }
  },
  methods:{
        infoCard: function(clickedId){
            let url = "/ajax/field-info"
            axios.get(url).then((msg) => {
                for(let key in msg.data){
                    if(key == clickedId){
                        this.info = msg.data[key]
                    }
                }
            });  
            document.querySelector('.modal-info-card').classList.remove('d-none')
        },
        allCards: function(){
                let url = "/ajax/field-info"
                axios.get(url).then((msg) => {
                    this.res = msg.data
                });
        },
        deleteCard: function(){
            let url = "/ajax/delete"
            let iD = document.querySelector('.modal-info-card ').getAttribute('data-id');

            axios.post(url,{id:iD}).then((msg) => {
                //elimino e "refresh" della lista
                this.allCards()
                this.dNone()
            });
        },
        updateCard: function(){
            let url = "/ajax/update-card"
            let description = document.querySelector('.description-card textarea').value;
            let title = document.querySelector('.titles-card textarea').value;
            let iD = document.querySelector('.modal-info-card ').getAttribute('data-id');

            axios.post(url,{titleInfo:title,descriptionInfo:description,id:iD}).then((msg) => {
                this.allCards()
                this.dNone()
            });
            },
            dNone:function(){
                document.querySelector('.modal-info-card').classList.add('d-none')
            },
            createCard: function(idColonna){
            let url = "/ajax/create"
            let description = document.querySelector('.new-card div[data-id="'+idColonna+'"] .description-card textarea').value;
            let title = document.querySelector('.new-card div[data-id="'+idColonna+'"] .titles-card textarea').value;

            axios.post(url,{title:title,description:description,idColumn:idColonna}).then((msg) => {
                //creo e "refresh" della lista
                this.column = msg.data['column-id'];
                this.allCards()
                this.dNone()
            });
        },
  },
  mounted(){
      this.allCards()
  }
}
</script>

<style>

</style>