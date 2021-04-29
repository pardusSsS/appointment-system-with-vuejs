<template>

<div>
<div v-if="completeFrom">
    <div class="container">
        <div class="row">
            <li class="error" v-for="error in errors">{{error}}</li>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <input type="text" class="form-control" v-model="name" placeholder="Ad Soyad">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" required class="form-control" v-model="email" placeholder="Email">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" class="form-control" v-mask="'##-###-###-####'" v-model="phone" placeholder="Telefon">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <input @change="selectDate" :min="minDate" type="date" class="form-control" v-model="date">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
            <div class="col-md-6">
                    <ul class="select-time-ul">
                    <li v-for="item in workingHours" class="select-time"><input v-if="item.isActive"  type="radio" v-model="workingHour"  v-bind:value="item.id" > <span >{{item.hours}}</span></li>
                    </ul>

            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <textarea v-model="text" id="" cols="143" class="form-control" rows="10"></textarea>
                </div>
            </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">

                <div class="col-md-6">
                    <div class="form-group">
                    <label >Sms</label>
                    <input type="radio"  v-model="notification_type" value="0">
                    </div>
                </div>


                    <div class="col-md-6">
                        <div class="form-group">
                        <label>Email</label>
                        <input type="radio" v-model="notification_type" value="1">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button v-on:click="store" class="btn btn-success">Randevu Oluştur</button>
            </div>
        </div>
    </div>
</div>
    <div v-if="!completeFrom">
    <div class="complete-from">
        <i class="fas fa-check-circle"></i>
        <span>Randevunuz başarı ile gerçekleştirildi.</span>
    </div>
    </div>
</div>

</template>

<script>
    import io from 'socket.io-client';
    var socket = io('http://localhost:3000');
    export default {

        data(){
            return {
                completeFrom:true,
                errors:[],
                notification_type:null,
                workingHour:0,
                name:null,
                email:null,
                phone:null,
                text:null,
                minDate:new Date().toISOString().slice(0,10),
                date:new Date().toISOString().slice(0,10),
                workingHours:[],
                reelHour:[],
            }
        },
         created() {
          socket.emit('HELLO');
         },
        mounted(){
            axios.get('api/working-hours')
            .then((res)=>{
                console.log(res);
                this.workingHours = res.data;
            })
        },

        methods:{
            store:function(){
               if(this.notification_type && this.name && this.email && this.validEmail(this.email) && this.phone && this.workingHours){
                        axios.post(`api/appointment-store`,{
                            fullName:this.name,
                            phone:this.phone,
                            email:this.email,
                            date:this.date,
                            workingHour:this.workingHour,
                            text:this.text,
                            notification_type:this.notification_type
                        }).then((res)=>{
                                if(res.status){

                                    socket.emit('new_appointment_create');
                                  this.completeFrom=false;
                                }
                        })
               }
                    this.errors = [];
               if(!this.notification_type){
                   this.errors.push('Bildirim Tipi seçilmelidir');
               }

               if(!this.name){
                    this.errors.push('İsim ve Soyisim alanı boş bırakılamaz');
               }

                if(!this.email || !this.validEmail(this.email)){
                    this.errors.push('Email alanı boş bırakılamaz ve Email formatı düzgün olamlıdır');
                }

                if(!this.phone){
                    this.errors.push('Telefon numarası boş bırakılamaz');
                }

                if(!this.workingHours){
                    this.errors.push('Çalışma saati seçilmelidir');
                }


            },
            selectDate:function(){
                axios.get(`api/working-hours/${this.date}`)
                .then((res)=>{
                    console.log(res.data);
                    this.workingHours = res.data;
                })
            },
            validEmail: function (email) {
                var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(email);
            },


        }
    }
</script>
<style scoped>

</style>


