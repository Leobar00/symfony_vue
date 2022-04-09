<template>
<div >
    <span>
        <div class="column-trello" >
            <div class="top-column">

                <div class="title">
                    <span class="text-column">
                        <strong>{{ columnName }}</strong>
                    </span>
                    <span class="icon-column">
                        <a href="#" class="flex-center "><i class="fas fa-ellipsis-h"></i></a>
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
import Card from './Card.vue'
import AddCard from './AddCard.vue'
export default {
  name: "Home",
  components:{
      Card,
      AddCard
  },
  props:['columnName','idColumn'],

  
};
</script>
<style >

</style>