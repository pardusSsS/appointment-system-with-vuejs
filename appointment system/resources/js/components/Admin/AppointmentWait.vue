<template>
<div>
    <div class="card-body">
        <div class="table-responsive">


            <table class="table table-bordered adminTable"  width="100%" cellspacing="0">
                <thead>
            <tr>

                <th>Ad-Soyad</th>
                <th>Randevu Tarihi</th>
                <th>Randevu Saati</th>
                <th>Onayla</th>
                <th>İptal Et</th>
            </tr>
            </thead>

                <tbody v-for="item in data" :key="item.id"  @click="openModal(item.id)" >
                <tr>

                    <td>{{item.fullName}}</td>
                    <td>{{item.date}}</td>
                    <td>{{item.working}}</td>
                    <td v-if="!item.isActive "><button @click="appointOkay(item.id)" class="btn btn-primary">Onayla</button></td>
                    <td v-if="!item.isActive "><button @click="appointCancel(item.id)"  class="btn btn-danger">İptal Et</button></td>

                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <admin-modal :modalId="showModalId" v-if="showModal" @close="showModal = false">
        <!--
      you can use custom content here to overwrite
      default content
    -->
<!--        <h3 slot="header">custom header</h3>-->
    </admin-modal>
</div>
</template>

<script>
    import io from 'socket.io-client';
    var socket = io('http://localhost:3000');
    export default {

        props:['data'],



        data(){

            return{

                showModalId:0,
                showModal:false,
                items:{
                    data:[]
                },

            }
        },
        created() {

           // this.getData();
            socket.on('admin_appointment_list',function () {
                axios.get(`api/admin/all`)
                    .then((res) => {
                        console.log(res);

                        this.wait = res.data.wait;
                        this.today = res.data.today;
                        this.future = res.data.future;
                        this.past = res.data.past;
                        this.cancel = res.data.cancel;



                    });
            });
            console.log('liste çağrıldı')
        },
        methods:{

            openModal:function(id){
               this.showModalId = id;

               this.showModal=true;
            },

            // getData() {
            //     axios.get(`http://localhost:8000/api/admin/get-wait`)
            //         .then((res) => {
            //             console.log(res);
            //             this.items = res.data;
            //             console.log('hiiiiiiiiiiiii');
            //
            //
            //         })
            // },
          appointOkay(id){

                this.$emit('updateOkay',id)

          },

            appointCancel(id){
                this.$emit('updateCancel',id)

              // axios.post(`http://localhost:8000/api/admin/wait-check`,{
              //     type:2,
              //     id:id
              // })
              //   .then((res)=>{
              //       console.log(res);
              //   })
            },

        }

    }
</script>

<style scoped>

</style>
