<template>

    <div class="card-body">
        <div class="table-responsive">

            <table class="table table-bordered adminTable" id="" width="100%" cellspacing="0">
                <thead>
                <tr>

                    <th>Ad-Soyad</th>
                    <th>Randevu Tarihi</th>
                    <th>Randevu Saati</th>
                    <th>Durumu</th>
                </tr>
                </thead>

                <tbody v-for="item in data" :key="item.id">
                <tr>

                    <td>{{item.fullName}}</td>
                    <td>{{item.date}}</td>
                    <td>{{item.working}}</td>
                    <td>
                        <span v-if="item.isActive==0">Yeni</span>
                        <span v-if="item.isActive==1">Onaylı</span>
                        <span v-if="item.isActive==2">İptal</span>
                    </td>
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
        //         },
        //
        //     }
        // },
        created(){
            //this.getData();
        },
        mounted() {
            console.log('hi');
        },
        methods:{

            // getData() {
            //     axios.get(`http://localhost:8000/api/admin/past-list`)
            //         .then((res) => {
            //             this.items = res.data;
            //             console.log(res);
            //
            //         })
            // }
            // getData(page){
            //     if(typeof page ==='undefined' ){
            //         page=1;
            //     }
            //     console.log(page);
            //
            // }
        }
    }
</script>

<style scoped>

</style>
