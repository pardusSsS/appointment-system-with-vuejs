<template>
    <div>
    <div class="col-md-12">
        <div class="row">
            <li class="error" style="margin-left: 16px;" v-for="error in errors">{{error}}</li>
        </div>
        <input type="text" v-model="code" class="form-group col-md-12" placeholder="Kodu Giriniz">
        <button @click="store" class="btn btn-primary">Doğrula</button>
    </div>
    <div v-if="detailStatu" class="card-body" style="background-color: white;">
       <span>Tarih: {{info.date}}</span><br>
        <span>Saat: {{info.working}}</span><br>
        <span>Bildirim Tipi: {{info.notification}}</span><br>
        <span>Onay Durumu: {{info.status}}</span>
        <div v-for="item in note">
            <span>NOT: {{item.text}}</span><br>
        </div>
    </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                detailStatu:false,
                code:null,
                errors:[],
                info:[],
                note:[],


            }
        },
        methods:{

            store:function () {
                if (this.code != null) {
                    console.log('girdi');
                    axios.post(`api/appointment-detail`, {
                        code: this.code
                    })
                        .then((res) => {
                            if(res.data.status){
                                this.code='';
                                this.info = res.data.info;
                                this.note = res.data.note ;
                                this.detailStatu = !this.detailStatu;
                            }else{
                                this.errors = [];
                                this.errors.push(res.data.message);
                            }
                        })
                        .catch((e) => {
                            console.log(e);
                        })
                }

                this.errors=[];
                if(this.code == null){
                    this.errors.push('Randevu kodu boş bırakılamaz');
                }
            }

        }
    }
</script>

<style scoped>

</style>
