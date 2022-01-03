<template>
<div>
    <div class="d-none modal-info-card  " :data-id="idInfo">
        <div class="close-button" >
            <i class="far fa-times-circle "></i>
        </div>
        <div class="titles-card"> 
            <textarea name="title-info" id="" cols="30" rows="1" v-model="titleCard"></textarea>
        </div>
        <div class="description-card">
            <textarea name="description-info" id="" cols="30" rows="10" v-model="descriptionCard"></textarea>
        </div>
        <input type="text" name="id" class="d-none">
        <button type="submit">Aggiorna</button>
        
        
        <button type="submit"> Delete</button>
    </div>
</div>
    

</template>

<script>
export default {
    name: 'CardInfo',
    data:{},
    props:{
        idInfo: Number,
        titleCard: String,
        descriptionCard: String
    }
}
</script>

<style>

</style>