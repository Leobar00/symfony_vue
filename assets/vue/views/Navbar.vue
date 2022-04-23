<template>
  <div>
      <nav>
        <ul class="navbar-flex">
            <li>
                <div class="glass-effect flex-center square">
                    <a href="#" class="flex-center "><i class="fas fa-th white-color fa-lg"></i></a>
                </div>
            </li>
            <li>
                <div class="glass-effect flex-center square">
                    <a href="#" class="flex-center "><i class="fas fa-home white-color fa-lg"></i></a>
                    
                </div>
            </li>
            <li>
                <div class="glass-effect flex-center height-icon">
                    <input type="text" v-model="search" @input="searchCard()">
                    <i class="fas fa-search white-color fa-lg"></i>
                </div>
            </li>
        </ul>
        <ul class="navbar-flex" style="justify-content:center">
            <li>
                <h1 class="white-color title">TrelLeo</h1>
            </li>
        </ul>
        <ul class="navbar-flex" style="justify-content:flex-end">
            <li>
                <div class="glass-effect flex-center square">
                    <a href="#" class="flex-center "><i class="fas fa-plus white-color fa-lg"></i></a>
                </div>
            </li>
            <li>
                <div class="glass-effect flex-center square">
                    <a href="#" class="flex-center "><i class="fas fa-info white-color fa-lg"></i></a>
                </div>
            </li>
            <li>
                <div class="glass-effect flex-center square">
                    <a href="#" class="flex-center "><i class="fas fa-bell white-color fa-lg"></i></a>
                    
                </div>
            </li>
            <li>
                <div class="glass-effect flex-center square circle">
                    <a href="#" class="flex-center "></a>
                </div>
            </li>
        </ul>
    </nav>
  </div>
</template>

<script>
export default {
    name:'Navbar',
    data:{
        search:'' 
    },
    components:{
        
    },
    methods:{
        
    }
}
</script>

<style>

</style>