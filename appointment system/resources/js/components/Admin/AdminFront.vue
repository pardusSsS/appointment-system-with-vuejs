<template>
    <div class="container">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-wait-tab" data-toggle="pill" href="#pills-wait" role="tab" aria-controls="pills-wait" aria-selected="true">Onay Bekleyen Randevular</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="pills-today-tab" data-toggle="pill" href="#pills-today" role="tab" aria-controls="pills-today" aria-selected="false">Bugünün Randevuları</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-future-tab" data-toggle="pill" href="#pills-future" role="tab" aria-controls="pills-future" aria-selected="false">İleri Tarihli Randevular</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-past-tab" data-toggle="pill" href="#pills-past" role="tab" aria-controls="pills-past" aria-selected="false">Geçmiş Randevular</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-cancel-tab" data-toggle="pill" href="#pills-cancel" role="tab" aria-controls="pills-cancel" aria-selected="false">İptal Edilen Randevular</a>
            </li>
        </ul>

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-wait" role="tabpanel" aria-labelledby="pills-wait-tab">
                <appointment-wait @updateOkay="updateOkay" @updateCancel="updateCancel" :data="wait"></appointment-wait>
            </div>



            <div class="tab-pane fade " id="pills-today" role="tabpanel" aria-labelledby="pills-today-tab">
              <!--  <today-appointment @updateOkay="updateOkay" @updateCancel="updateCancel" :data="today"></today-appointment>-->
                <list-component  @updateOkay="updateOkay" @updateCancel="updateCancel" :data="today"></list-component>
            </div>


            <div class="tab-pane fade" id="pills-future" role="tabpanel" aria-labelledby="pills-future-tab">
<!--                <admin-component @updateOkay="updateOkay" @updateCancel="updateCancel" :data="future"></admin-component>-->
                <list-component  @updateOkay="updateOkay" @updateCancel="updateCancel" :data="future"></list-component>

            </div>


            <div class="tab-pane fade" id="pills-past" role="tabpanel" aria-labelledby="pills-past-tab">
                <past-component @updateOkay="updateOkay" @updateCancel="updateCancel" :data="past"></past-component>
            </div>


            <div class="tab-pane fade" id="pills-cancel" role="tabpanel" aria-labelledby="pills-cancel-tab">
                <appointment-cancel @updateOkay="updateOkay" @updateCancel="updateCancel" :data="cancel"></appointment-cancel>
            </div>



        </div>




    </div>
</template>

<script>
    import io from 'socket.io-client';
    var socket = io('http://localhost:3000');
    export default {
       data(){

           return{
                wait:{
                    data:[]
                },

               today:{
                   data:[]
               },

               future:{
                   data:[]
               },

               past:{
                   data:[]
               },

               cancel:{
                   data:[]
               },


           }

       },
        created() {
            this.getData();

            socket.on('admin_appointment_list', ()=> {
            console.log("Veri Geldi");
                this.getData();


            });

        },
        methods:{
           updateOkay(id){

               axios.post(`api/admin/wait-check`,{
                   type:1,
                   id:id
               })
                   .then((res)=>{
                       this.getData();
                   })
           },

            updateCancel(id){
                axios.post(`api/admin/wait-check`,{
                    type:2,
                    id:id
                })
                    .then((res)=>{
                        this.getData();
                    })
            },
            getData() {
                axios.get(`api/admin/all`)
                    .then((res) => {
                        console.log(res);

                        this.wait = res.data.wait;
                        this.today = res.data.today;
                        this.future = res.data.future;
                        this.past = res.data.past;
                        this.cancel = res.data.cancel;



                    })
            }
        }
    }
</script>

<style scoped>

</style>
