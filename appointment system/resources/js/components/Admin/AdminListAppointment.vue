<template>
        <div>
    <table class="table table-bordered adminTable" id="" width="100%" cellspacing="0">
        <thead>
                <tr>
                    <th>Sıra</th>
                    <th>Ad-Soyad</th>
                    <th>Randevu Tarihi</th>
                    <th>Randevu Saati</th>
                </tr>
                </thead>

                <tbody v-for="item in data" :key="item.id" >
                <tr >
                    <td>{{item.id}}</td>
                    <td>{{item.fullName}}</td>
                    <td>{{item.date}}</td>
                    <td>{{item.working}}</td>
                </tr>
                </tbody>
</table>

<!--    <admin-modal :modalId="showModalId"  v-if="showModal" @close="showModal = false">-->
<!--        &lt;!&ndash;-->
<!--      you can use custom content here to overwrite-->
<!--      default content-->
<!--    &ndash;&gt;-->
<!--&lt;!&ndash;        <h3 slot="header">custom header</h3>&ndash;&gt;-->
<!--    </admin-modal>-->
        </div>
</template>

<script>
    export default {
            props:['data'],
        //     data(){
        //         return{
        //             // showModalId:"",
        //             // showModal:true
        //         }
        //     },
        // // methods:{
        // //     openModal:function(id){
        // //         this.showModalId = id;
        // //
        // //         this.showModal=true;
        // //     },
        // // },
        // //
        // // created() {
        // //         this.openModal();
        // // }

    }
</script>

<style scoped>

</style>
