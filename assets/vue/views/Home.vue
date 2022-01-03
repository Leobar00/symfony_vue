<template>
<div>
    <main>
        <div class="column-trello">
            <div class="top-column">

                    <div class="title">
                        <span class="text-column">
                            <strong>Da fare</strong>
                        </span>
                        <span class="icon-column">
                            <a href="#" class="flex-center "><i class="fas fa-ellipsis-h"></i></a>
                        </span>
                    </div>
                        
                    <Card ></Card>
                    
                </div>
            </div>
            <div class="bottom-column">
                <div class="footer-column">
                    <div class="add-card" >
                        <a href="#">
                            <i class="fas fa-plus white-color "></i>
                            <p>Add a card</p>
                        </a>
                    </div>
                </div>
            </div>    
    </main>  
</div>
</template>

<script>
import Card from './Card.vue'
export default {
  name: "Home",
  components:{
      Card
  }
  
};
</script>
<style >

</style>