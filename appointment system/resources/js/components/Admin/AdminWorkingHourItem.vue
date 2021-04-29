<template>
    <div class="container-day">

     <h5 class="day">{{title}}</h5>
    <button @click="isShowing"  class="btn btn-secondary day-add-btn">+</button>

        <div v-if="isShow" style="padding:12px;">
        <input type="text" class="form-control" v-model="time" placeholder="Çalışma saati: 10.00-11.00">
        <button @click="addTime" style="margin-top: 10px;" class="btn btn-primary">Ekle</button>
        </div>
        <div class="day-body">
            <div v-for="item in data" >{{item}} </div>
        </div>

    </div>
</template>

<script>
    export default {
       props:['title','data','day'],

        data(){
           return{

               time:'',
               isShow:false,
           }
        },
        methods:{
                isShowing:function () {
                    this.isShow=!this.isShow;
                },

                addTime:function () {
                    this.$emit('add',{text:this.time,day:this.day});
                    this.time=null;
                    this.isShow=false;
                }
        }
    }
</script>

<style scoped>

</style>
