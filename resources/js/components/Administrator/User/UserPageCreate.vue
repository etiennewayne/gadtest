<template>
    <div>
        <div class="section">
            <div class="container">
                <div class="columns">
                    <div class="column is-8 is-offset-2">
                        <div class="box">
                            <h1 class="title is-5">ADD/MODIFY USER</h1>
                            <form @submit.prevent="submit">
                                <div class="columns">
                                    <div class="column">
                                        <b-field label="Username"
                                                 :type="this.errors.username ? 'is-danger' : ''"
                                                 :message="this.errors.username ? this.errors.username[0] : ''"
                                                 label-position="on-border">
                                            <b-input type="text" maxlength="20" v-model="fields.username" placeholder="Username" required/>
                                        </b-field>
                                    </div>
                                </div>

                                <div class="columns">
                                    <div class="column">
                                        <b-field label="Password"
                                                 :type="this.errors.password ? 'is-danger' : ''"
                                                 :message="this.errors.password ? this.errors.password[0] : ''"
                                                 label-position="on-border">
                                            <b-input type="password" password-reveal v-model="fields.password" placeholder="Password" required/>
                                        </b-field>
                                    </div>

                                    <div class="column">
                                        <b-field label="Confirm Password" label-position="on-border">
                                            <b-input type="password" password-reveal v-model="fields.password_confirmation" placeholder="Confirm Password" required/>
                                        </b-field>
                                    </div>
                                </div>


                                <div class="columns">
                                    <div class="column">
                                        <b-field label="Lastname"
                                                 :type="this.errors.lname ? 'is-danger' : ''"
                                                 :message="this.errors.lname ? this.errors.lname[0] : ''"
                                                 label-position="on-border">
                                            <b-input type="text" maxlength="30" v-model="fields.lname" placeholder="Lastname" required/>
                                        </b-field>
                                    </div>

                                    <div class="column">
                                        <b-field label="Firstname"
                                                 :type="this.errors.fname ? 'is-danger' : ''"
                                                 :message="this.errors.fname ? this.errors.fname[0] : ''"
                                                 label-position="on-border">
                                            <b-input type="text" maxlength="30" v-model="fields.fname" placeholder="Firstname" required/>
                                        </b-field>
                                    </div>

                                    <div class="column">
                                        <b-field label="Middlename" label-position="on-border">
                                            <b-input type="text" maxlength="30" v-model="fields.mname" placeholder="Middlename" />
                                        </b-field>
                                    </div>
                                </div>

                                <div class="columns">

                                    <div class="column">
                                        <b-field label-position="on-border" label="Sex" expanded>
                                            <b-select v-model="fields.sex" expanded>
                                                <option value="MALE">MALE</option>
                                                <option value="FEMALE">FEMALE</option>
                                            </b-select>
                                        </b-field>
                                    </div>

                                    <div class="column">
                                        <b-field label-position="on-border" label="Role" expanded>
                                            <b-select v-model="fields.role" expanded>
                                                <option value="ADMINISTRATOR">ADMINISTRATOR</option>
                                                <option value="STAFF">STAFF</option>
                                                <option value="STUDENT">STUDENT</option>
                                            </b-select>
                                        </b-field>
                                    </div>

                                </div><!--cols-->

                                <div class="columns">
                                    <div class="column">
                                        <b-field label-position="on-border" label="Birthdate">
                                            <b-datepicker editable v-model="bdate" placeholder="Birthdate">
                                            </b-datepicker>
                                        </b-field>
                                    </div>
                                    <div class="column">
                                        <b-field label-position="on-border" label="Birthplace">
                                            <b-input type="text" v-model="fields.birthplace"></b-input>
                                        </b-field>
                                    </div>


                                </div>

                                <div class="columns">
                                    <div class="column">
                                        <b-field label-position="on-border" label="Contact No.">
                                            <b-input type="text" v-model="fields.contact_no" placeholder="Contact No."></b-input>
                                        </b-field>
                                    </div>

                                    <div class="column">
                                        <b-field label-position="on-border" label="Email">
                                            <b-input type="email" v-model="fields.email" required placeholder="Email"></b-input>
                                        </b-field>
                                    </div>
                                </div>

                                <div class="columns">
                                    <div class="column">
                                        <b-field label-position="on-border" label="Last School Attended">
                                            <b-input type="text" v-model="fields.last_school_attended" placeholder="Last School Attended"></b-input>
                                        </b-field>
                                    </div>
                                </div>


                                <div class="columns">
                                    <div class="column">
                                        <b-field label="Province" label-position="on-border" expanded
                                                :type="this.errors.province ? 'is-danger':''"
                                                :message="this.errors.province ? this.errors.province[0] : ''">
                                            <b-select v-model="fields.province" @input="loadCity" expanded>
                                                <option v-for="(item, index) in provinces" :key="index" :value="item.Prov_Name">{{ item.Prov_Name }}</option>
                                            </b-select>
                                        </b-field>
                                    </div>

                                    <div class="column">
                                        <b-field label="City" label-position="on-border" expanded
                                                :type="this.errors.city ? 'is-danger':''"
                                                :message="this.errors.city ? this.errors.city[0] : ''">
                                            <b-select v-model="fields.city" @input="loadBarangay" expanded>
                                                <option v-for="(item, index) in cities" :key="index" :value="item.City_Name">{{ item.City_Name }}</option>
                                            </b-select>
                                        </b-field>
                                    </div>
                                </div>

                                <div class="columns">
                                    <div class="column">
                                        <b-field label="Barangay" label-position="on-border" expanded
                                                :type="this.errors.barangay ? 'is-danger':''"
                                                :message="this.errors.barangay ? this.errors.barangay[0] : ''">
                                            <b-select v-model="fields.barangay" expanded>
                                                <option v-for="(item, index) in barangays" :key="index" :value="{ barangay_id: item.Brgy_ID, barangay: item.Bgry_Name}">{{ item.Bgry_Name }}</option>
                                            </b-select>
                                        </b-field>
                                    </div>
                                    <div class="column">
                                        <b-field label="Street" label-position="on-border">
                                            <b-input v-model="fields.street"
                                                    placeholder="Street" required>
                                            </b-input>
                                        </b-field>
                                    </div>
                                </div>

                                <div class="buttons">
                                    <button class="button is-primary">SAVE</button>
                                </div>
                           </form><!--form-->
                        </div> <!--box-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['propUserId'],

    data(){
        return {
            fields: {},
            bdate: null,
            errors: {},

            userId: 0,


            fields: {
                username: null,
                password: null, password_confirmation : null,
                lname: null, fname: null, mname: null, sex : null,
                role: null, bdate: null, birthplace: null,
                contact_no : null, email : null,
                last_school_attended: null,
                province: null, city: null, barangay: null, street: null
            },

            provinces: [],
            cities: [],
            barangays: [],


        }
    },
    methods: {

        submit(){
            axios.post('/panel/user', this.fields).then(res=>{
                if(res.data.status === 'saved'){
                    this.$buefy.dialog.alert({
                        title: 'SAVED!',
                        message: 'User added successfully.',
                        type: 'is-success',
                        onConfirm: ()=> window.location = '/panel/user'
                    });
                }
            }).catch(err=>{
                if(err.response.status === 422){
                    this.errors = err.response.data.errors;
                    console.log(err.response.data.errors);
                }
            })
        },


        loadProvince: function(){
            axios.get('/provinces').then(res=>{
                this.provinces = res.data;
            })
        },
        loadCity: function(){
            axios.get('/cities?province=' + this.fields.province).then(res=>{
                this.cities = res.data;
            })
        },
        loadBarangay: function(){
            axios.get('/barangays?province=' + this.fields.province + '&city='+this.fields.city).then(res=>{
                this.barangays = res.data;
            })
        },

        //update code here
        getData: function(){
            this.clearFields();
        
            //nested axios for getting the address 1 by 1 or request by request
            axios.get('/panel/user/'+this.userId).then(res=>{
                this.fields = res.data;
               
                let tempData = res.data;
                //load city first
                axios.get('/cities?province=' + this.fields.province).then(res=>{
                    //load barangay
                    this.cities = res.data;
                    axios.get('/barangays?province=' + this.fields.province + '&city='+this.fields.city).then(res=>{
                        this.barangays.barangay_id = res.data.Brgy_ID;
                        console.log(res.data);
                        this.fields = tempData;
                    });
                });
            });
        },

        clearFields: function(){
            this.fields ={
                username: null,
                password: null, password_confirmation : null,
                lname: null, fname: null, mname: null, sex : null,
                role: null, bdate: null, birthplace: null,
                contact_no : null, email : null,
                last_school_attended: null,
                province: null, city: null, barangay: null, street: null
            };
        },

        formatDate(){
            let mydate = new Date(Date.parse(this.bdate));
            let realDate = mydate.getFullYear() + "-" + ("0" + (mydate.getMonth() + 1)).slice(-2) + "-"+ ("0" + (mydate.getDate())).slice(-2);
            this.fields.bdate = realDate;
        },

        initData(){
            this.userId = parseInt(this.propUserId);

            if(this.userId > 0){
                this.getData();
            }
        }
    },


    mounted(){
        this.initData();
        this.loadProvince();
    }
}
</script>
