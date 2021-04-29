<template>

        <transition name="modal">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-container">

                        <div class="modal-header">
                            <slot name="header">
                                <h3 slot="header">{{ data.fullName }}</h3>
                                <button class="btn btn-danger" @click="$emit('close')">
                                    X
                                </button>
                            </slot>
                        </div>

                        <div class="modal-body">
                            <slot name="body">
                                <span>Telefon</span>: <span>{{data.phone}}</span><br>
                                <span>Email</span>: <span>{{data.email}}</span><br>
                                <span>Tarih</span>: <span>{{data.date}}</span><br>
                                <span>Saat</span>: <span>{{data.working}}</span><br>
                                <span>Bildirim Tipi</span>: <span>{{data.notification}}</span><br>
                                <span>Not</span>: <span>{{data.text}}</span><br>
                                <div v-for="item in comment"><span>{{item.text}}</span></div>
                                <button class="btn btn-secondary " style="margin-bottom: 3px; margin-top: 5px;" @click="textAddClick">Not Ekle</button>



                            </slot>
                        </div>

                        <div class="modal-footer">
                            <slot name="footer">
                                <div v-if="textAdd">
                                    <textarea v-model="text"  name="text" id="" cols="60" rows="10"></textarea><br>
                                    <button @click="store" class="btn btn-primary">Ekle</button>
                                </div>

                            </slot>
                        </div>
                    </div>
                </div>
            </div>
        </transition>

</template>

<script>
    export default {
     props:['modalId'],
            data(){
                return{
                    textAdd:false,
                    data:[],
                    text:'',
                    comment:[],

                }
            },
        created() {
                this.getData();

        },

        methods:{
            textAddClick:function () {
                this.textAdd=!this.textAdd;
            },

            store:function () {
                    axios.post(`api/admin/detailStore`,{
                        id:this.modalId,
                        text:this.text

                    }).then((res)=>{
                        if(res.status){
                            this.text ='';
                            this.getData();
                        }

                    });


            },
            getData:function(){
                axios.get(`api/admin/detail/${this.modalId}`)
                    .then((res)=>{
                        this.data = res.data.data;
                        this.comment = res.data.comment;
                    });
            }

        }

    }
</script>

<style scoped>

</style>
