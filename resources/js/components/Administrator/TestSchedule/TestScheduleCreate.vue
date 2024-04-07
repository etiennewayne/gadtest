<template>

    <div>
        <div class="section">

            <div class="columns">
                <div class="column is-8 is-offset-2">
                    <div class="box">
                        <form @submit.prevent="submit">

                            <h1 class="title is-5">CREATE SCHEDULE</h1>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Academic Year"
                                        :type="this.errors.acad_year_id ? 'is-danger' : ''"
                                        :message="this.errors.acad_year_id ? this.errors.acad_year_id[0] : ''">
                                        <b-select v-model="fields.acad_year_id" placeholder="Academic Year">
                                            <option :value="item.acad_year_id" v-for="(item, index) in this.academicyears" :key="index">{{ item.code }} - {{ item.description }}</option>
                                        </b-select>
                                    </b-field>
                                </div>

                                <div class="column">
                                    <b-field label="Max per schedule"
                                        :type="this.errors.max_user ? 'is-danger' : ''"
                                        :message="this.errors.max_user ? this.errors.max_user[0] : ''">
                                        <b-input type="number" v-model="fields.max_user"
                                             oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="4"></b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Description"
                                        :type="this.errors.description ? 'is-danger' : ''"
                                        :message="this.errors.description ? this.errors.description[0] : ''">
                                        <b-input type="text" v-model="fields.description" placeholder="Description" required>
                                        </b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Schedule From"
                                        :type="errors.from ? 'is-danger' : ''"
                                        :message="errors.from ? errors.from[0] : ''">
                                        <b-datetimepicker
                                            placeholder="Click to select..."
                                            icon="calendar-today"
                                            editable
                                            v-model="sched_from"
                                            :locale="locale"
                                            @input="formattedFromDate"
                                            :timepicker="{ hourFormat }"></b-datetimepicker>
                                    </b-field>

                                    <b-field label="Schedule To"
                                        :type="errors.to ? 'is-danger' : ''"
                                        :message="errors.to ? errors.to[0] : ''">
                                        <b-datetimepicker
                                            placeholder="Click to select..."
                                            icon="calendar-today"
                                            v-model="sched_to"
                                            editable
                                            :locale="locale"
                                            @input="formattedToDate"
                                            :timepicker="{ hourFormat }"></b-datetimepicker>
                                    </b-field>
                                </div>
                            </div>

                            <div class="buttons is-right">
                                <button class="button is-primary">
                                    <b-icon icon="calendar" icon-pack="fa" class="mr-2"></b-icon>
                                    <b>SAVE SCHEDULE</b>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div><!--root-->
</template>

<script>
export default {

    props:{
        dataAcademics:{
            type: String,
            default: '',
        }
    },

    data(){
        return{
            fields: {
                acad_year_id: 0,
                max_user: 50,

                
            },
            errors: {},

            sched_from: new Date(),
            sched_to: new Date(),
            hourFormat: '12',

            academicyears: [],

            locale: undefined // Browser locale

        }
    },
    methods: {
        submit(){

            
            axios.post('/panel/test-schedule', this.fields).then(res=>{
                if(res.data.status === 'saved'){
                    this.$buefy.dialog.alert({
                        title: 'SAVED!',
                        message: 'Successfully saved.',
                        type: 'is-success',
                        //onConfirm: ()=> window.location = '/panel/test-schedule'
                    });
                }
            }).catch(err=>{
                if(err.response.status === 422){
                    this.errors = err.response.data.errors;
                }
            })
        },

        formattedFromDate(){
            let ndate = new Date(Date.parse(this.sched_from));

            let realDateTime = ndate.getFullYear() + "-" + ("0" + (ndate.getMonth() + 1)).slice(-2) + "-"+ ("0" + (ndate.getDate())).slice(-2)
                +' ' +("0" + ndate.getHours()).slice(-2) + ':'+ ("0" + ndate.getMinutes()).slice(-2) + ':00';
            console.log(realDateTime);

            this.fields.from = realDateTime;
        },
        formattedToDate(){
            let ndate = new Date(Date.parse(this.sched_to));
            let realDateTime = ndate.getFullYear() + "-" + ("0" + (ndate.getMonth() + 1)).slice(-2) + "-"+ ("0" + (ndate.getDate())).slice(-2)
                +' ' +("0" + ndate.getHours()).slice(-2) + ':'+ ("0" + ndate.getMinutes()).slice(-2) + ':00';
            console.log(realDateTime);
            this.fields.to = realDateTime;
        },




        initData(){
            this.academicyears = JSON.parse(this.dataAcademics);
            this.fields.acad_year_id = this.academicyears.filter(item=> item.active === 1)[0].acad_year_id;
        }

    },

    mounted(){
        this.initData();
    }
}
</script>

<style scoped>

</style>
