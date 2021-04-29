<template>

    <div class="card-body">
        <div class="table-responsive">

            <div>
                <list-component ></list-component>
            </div>
            </div>
        </div>

</template>

<script>
    export default {




        // data(){
        //     return{
        //         items:{
        //             data:[]
        //         },
        //
        //     }
        // },
    created(){
       // this.getData();
    },
    mounted() {
            console.log('hi');
    },
    methods:{

            // getData() {
            //     axios.get(`http://localhost:8000/api/admin/future-list`)
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
