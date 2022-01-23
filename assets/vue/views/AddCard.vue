<template>
    <div class="bottom-column" :data-id="colonna">
        <div class="footer-column">
            <div class="add-card" >
                <a   @click="show($event)"> 
                    <p><i class="fas fa-plus white-color "></i> Add a card</p>
                </a>
            </div>
        </div>
    </div>
     
</template>

<script>
import CardInfo from './CardInfo.vue'
export default {
    name:"AddCard",
    components:{
        CardInfo
    },
    props:['colonna'],
    data:{

    },
    methods:{
        show: function($event){
            let event = $event.target;
            let idColonna = event.closest('.bottom-column').getAttribute('data-id')
            let selector ='.new-card .modal-info-card[data-id="'+ idColonna +'"]'
            document.querySelector(selector).classList.remove('d-none')
        },  
    }
}
</script>

<style>

</style>