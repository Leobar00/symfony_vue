<template>
<div>
    <div class="d-none modal-info-card  " :data-id="idInfo" :data-column="idColumn">
        <div class="close-button" @click="dNone()" >
            <i class="far fa-times-circle "></i>
        </div>
        <div class="titles-card"> 
            <textarea name="title-info" id="" cols="30" rows="1" v-model="titleCard"></textarea>
        </div>
        <div class="description-card">
            <textarea name="description-info" id="" cols="30" rows="10" v-model="descriptionCard"></textarea>
        </div>
        <input type="text" name="id" class="d-none">
        <slot name="update"></slot>
        
        <slot name="delete"></slot>
    </div>
</div>
    

</template>

<script>
import axios from 'axios';
export default {
    name: 'CardInfo',
    
    data:{
        uri : 'http://localhost:8000',
    },

    props:['descriptionCard','titleCard','idInfo','idColumn'],

    methods:{

        dNone:function(){
            let list = document.querySelectorAll('.modal-info-card');
            for (var i = 0; i < list.length; ++i) {
                list[i].classList.add('d-none');
            }
        },

    }
}
</script>
<style lang="less" scoped>

</style>