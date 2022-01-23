<template>
  <div class="body-app">
        <div>
            <Navbar></Navbar>
        </div>
        <main>
            <template v-for="(column,index) in dataColumn" >
                <Home columnName="Da fare" :key="index"  :idColumn="column.id" ></Home>
            </template>
            <AddColumn @click="addColumn()"></AddColumn>
        </main>
  </div>
</template>

<script>
import AddColumn from './AddColumn.vue'
import Home from './Home.vue'
import Navbar from './Navbar.vue'
import axios from 'axios';
export default {
    name:'Website',
    data(){
        return{
            dataColumn:[]
        }
    },
    components:{
        Home,
        Navbar,
        AddColumn
    },
    methods:{
        
        allColumn: function(){
            let url = "/ajax/column-all"
            axios.get(url).then((msg) => {
                this.dataColumn = msg.data
            });
        }
    },
    mounted(){
        this.allColumn()
        
    }
}
</script>

<style lang="scss" scoped>
main{
    display: flex;
}
</style>>

