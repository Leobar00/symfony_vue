<template>
<div >
    <span>
        <div class="column-trello" :data-column="idColumn">
            <div class="top-column">

                <div class="title">
                    <span class="text-column">
                        <strong>{{ columnName }}</strong>
                    </span>
                    <span class="icon-column">
                        <a href="#" id="info-column" class="flex-center " @click="dNoneEl"><i class="fas fa-ellipsis-h"></i></a>
                        <div class="modal-info-column d-none">
                            <ul>
                                <li @click="deleteColumn(idColumn)">Elimina</li>
                                <li></li>
                            </ul>
                        </div>
                    </span>
                    
                </div>
                        
                <Card :idColonna="idColumn" ></Card>
                    
            </div>
        </div>
            <AddCard :colonna="idColumn"></AddCard>   
    </span>  
</div>
</template>

<script>
import axios from 'axios';
import Card from './Card.vue'
import AddCard from './AddCard.vue'
export default {
  name: "Home",
  components:{
      Card,
      AddCard
  },
  props:['columnName','idColumn'],
  methods: {
        dNoneEl: function (event) {
            let element = event.target.parentElement
            let siblings = element.nextElementSibling
            
            siblings.classList.toggle('d-none');
            
        },
        deleteColumn:function (iD) {
            let url = "/ajax/column/delete"

            axios.post(url,{id:iD}).then((msg) => {
                //elimino e "refresh" della lista
                this.allColumn()
                this.dNoneColumn(iD)
            });
        },
        allColumn: function(){
            let url = "/ajax/column-all"
            axios.get(url).then((msg) => {
                this.res = msg.data
            });
        },
        dNoneColumn: function (id) {
            let element = document.querySelector('div[data-column="'+ id +'"]').parentElement
            element.remove()
        }
  }

  
};
</script>
<style lang="scss" scoped>
.icon-column {
    position: relative;
    .modal-info-column {
        width: 6rem;
        height: 4rem;
        background: #bbbabc;
        position:absolute;
        top: 0px;
        right: 35px;
        border-radius: 5px;
        ul {
            li {
                list-style: none;
                text-decoration: none;
                color: white;
                cursor: pointer;
                &:hover {
                    color:black;
                }
            }
        }
    }
}

</style>