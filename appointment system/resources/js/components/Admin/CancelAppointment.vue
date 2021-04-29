<template>

    <div class="card-body">
        <div class="table-responsive">


            <table class="table table-bordered adminTable" id="" width="100%" cellspacing="0">
                <thead>
                <tr>

                    <th>Ad-Soyad</th>
                    <th>Randevu Tarihi</th>
                    <th>Randevu Saati</th>

                </tr>
                </thead>

                <tbody v-for="item in data" :key="item.id">
                <tr>

                    <td>{{item.fullName}}</td>
                    <td>{{item.date}}</td>
                    <td>{{item.working}}</td>



                </tr>
                </tbody>
            </table>
        </div>
    </div>

</template>

<script>
    export default {

        props:['data'],

        // data(){
        //     return{
        //         items:{
        //             data:[]
        //         }
        //     }
        // },
        created() {
           // this.getData();
            console.log('liste çağrıldı')
        },
        methods:{

            // getData() {
            //     axios.get(`http://localhost:8000/api/admin/cancel-list`)
            //         .then((res) => {
            //             console.log(res);
            //             this.items = res.data;
            //             console.log('cancel');
            //
            //
            //         })
            // },

        }

    }
</script>

<style scoped>

</style>
