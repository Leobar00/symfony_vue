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
<style lang="scss">

.modal-info-card{
    width: 300px;
    height: 500px;
    position: absolute;
    padding: 0.8rem;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    display: flex;
    flex-direction: column;
    background-color: rgb(241, 241, 241);
    border-radius: 0.5rem;
    .titles-card{
        textarea{
            width: 93%;
            margin: 1rem 0;
            border-radius: 5px;
            border: none;
        }
    }
    .description-card{
        textarea{
            width: 96%;
            margin: 1rem 0;
            border-radius: 3%;
            border: none;
        }
    }
    .button{
        border-radius: 0.5rem;
        margin: 1rem 0.3rem;
        color: white;
    }
    .close-button{
        position: absolute;
        right: 0.3rem;
        top: 0.3rem;
        color: black;
        cursor: pointer;
    }
    .delete{
        background-color: rgba(255, 0, 0, 0.616);
    }
    .update{
        background-color: yellowgreen;
    }
    .create{
        background-color: rgb(2, 170, 2);
    }
}
</style>