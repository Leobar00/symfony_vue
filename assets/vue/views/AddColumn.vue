<template>
  <div class="add-column" @click="addColumn()">
        <div class="container-new-column"> 
            <p><i class="fas fa-plus "></i> Add another List</p>
        </div>
  </div>
</template>

<script>
import axios from 'axios';
export default {
    name:"AddColumn",
    data:{

    },
    methods:{
        addColumn:function(){
            let url = "/ajax/create-column"
            axios.post(url,{name:'Da fare'}).then((msg) => {
                
            });
        },
    },
}
</script>

<style lang="scss" scoped>
.add-column{
    &:hover{
        opacity: 0.8;
    }
    cursor: pointer;
    border-radius: 0.3rem;
    width: 12rem;
    height: 2.7rem;
    user-select: none;
    .container-new-column{
        width: 100%;
        height: 100%;
        background-color: white;
        opacity: 0.6;
        display: flex;
        justify-content: center;
        align-items:center ;    
        p{
            margin: 0;
        }
        i{
            color: grey;

        }
    }
}
</style>