<template>
    <div>
        <div class="section">
            <div class="container">
                <div class="columns is-centered">
                    <div class="column is-10">
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


                                <div class="columns" v-if="userId < 1">
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
                                        <b-field label="Suffix" label-position="on-border">
                                            <b-input type="text" maxlength="30" v-model="fields.suffix" placeholder="Suffix" />
                                        </b-field>
                                    </div>

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
                                            <b-datepicker editable v-model="fields.bdate" placeholder="Birthdate">
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
                                        <b-field label="1st Program Choice" label-position="on-border"
                                                 :type="this.errors.first_program_choice ? 'is-danger' : ''"
                                                 :message="this.errors.first_program_choice ? this.errors.first_program_choice : ''" expanded>
                                            <b-select placeholder="1st program choice" v-model="fields.first_program_choice" required expanded>
                                                <option :value="item.CCode" v-for="(item, index) in this.programs" :key="index">{{ item.CDesc }} ({{ item.CCode }})</option>
                                            </b-select>
                                        </b-field>
                                    </div>
                                    <div class="column">
                                        <b-field label="2nd Program Choice" label-position="on-border" expanded
                                                 :type="this.errors.second_program_choice ? 'is-danger' : ''"
                                                 :message="this.errors.second_program_choice ? this.errors.second_program_choice : ''">
                                            <b-select placeholder="2nd program choice" v-model="fields.second_program_choice" required expanded>
                                                <option :value="item.CCode" v-for="(item, index) in this.programs" :key="index">{{ item.CDesc }} ({{ item.CCode }})</option>
                                            </b-select>
                                        </b-field>
                                    </div>
                                </div>

                                <div class="columns">
                                    <div class="column">
                                        <b-field label="Mode of Learning" label-position="on-border" expanded
                                                 :type="this.errors.learning_mode ? 'is-danger' : ''"
                                                 :message="this.errors.learning_mode ? this.errors.learning_mode : ''">
                                            <b-select placeholder="Mode of Learning" v-model="fields.learning_mode" required expanded>
                                                <option :value="item.learning_mode" v-for="(item, index) in this.learningModes" :key="index">{{ item.learning_mode }} - {{ item.learning_desc }}</option>
                                            </b-select>
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
    props: ['propUserId', 'propLearningModes', 'propPrograms'],

    data(){
        return {

            errors: {},

            userId: 0,


            fields: {
                username: null,
                password: null, 
                password_confirmation : null,
                lname: null, fname: null, mname: null, 
                sex : null,
                suffix: null,

                role: null, bdate: null, birthplace: null,
                contact_no : null, email : null,
                last_school_attended: null,
                province: null, city: null, 
                barangay: {
                    barangay_id : null,
                    barangay: null,
                }, street: null
            },
            bdate: null,


            provinces: [],
            cities: [],
            barangays: [],

            programs: [],
            learningModes: [],


        }
    },
    methods: {

        submit(){
            if(this.userId > 0){
                axios.put('/panel/users/'+this.userId, this.fields).then(res=>{
                    if(res.data.status === 'updated'){
                        this.$buefy.dialog.alert({
                            title: 'SAVED!',
                            message: 'User updated successfully.',
                            type: 'is-success',
                            onConfirm: ()=> window.location = '/panel/current-users'
                        });
                    }
                }).catch(err=>{
                    if(err.response.status === 422){
                        this.errors = err.response.data.errors;
                        console.log(err.response.data.errors);
                    }
                });
            }else{
                axios.post('/panel/users', this.fields).then(res=>{
                    if(res.data.status === 'saved'){
                        this.$buefy.dialog.alert({
                            title: 'SAVED!',
                            message: 'User added successfully.',
                            type: 'is-success',
                            onConfirm: ()=> window.location = '/panel/current-users'
                        });
                    }
                }).catch(err=>{
                    if(err.response.status === 422){
                        this.errors = err.response.data.errors;
                        console.log(err.response.data.errors);
                    }
                });
            }
            
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
            axios.get('/panel/current-users/'+this.userId).then(res=>{

                var tempData = res.data;
                //load city first
                this.fields.username = tempData.username;
                this.fields.lname = tempData.lname;
                this.fields.fname = tempData.fname;
                this.fields.mname = tempData.mname;
                this.fields.suffix = tempData.suffix;
                this.fields.sex = tempData.sex;
                this.fields.role = tempData.role;
                this.fields.bdate = new Date(tempData.bdate);
                this.fields.birthplace = tempData.birthplace;
                this.fields.contact_no = tempData.contact_no;
                this.fields.email = tempData.email;
                this.fields.first_program_choice = tempData.first_program_choice;
                this.fields.second_program_choice = tempData.second_program_choice;
                this.fields.learning_mode = tempData.learning_mode;
                this.fields.last_school_attended = tempData.last_school_attended;
                this.fields.province = tempData.province;

                axios.get('/cities?province=' + this.fields.province).then(res=>{
                    //load barangay 
                    this.cities = res.data;
                    this.fields.city = tempData.city;
                    axios.get('/barangays?province=' + this.fields.province + '&city='+this.fields.city).then(res=>{
                        this.barangays = res.data;

                        let objBrgy = {
                            barangay_id: tempData.barangay_id,
                            barangay: tempData.barangay
                        };
                        this.fields.barangay = objBrgy;
                        this.fields.street = tempData.street;
                    });
                });
            });
        },

        clearFields: function(){
            this.fields = {
                username: null,
                password: null, password_confirmation : null,
                lname: null, fname: null, mname: null, sex : null,
                role: null, bdate: null, birthplace: null,
                contact_no : null, email : null,
                last_school_attended: null,
                province: null, city: null, barangay: null, street: null
            };
        },

        initData(){
            this.userId = parseInt(this.propUserId);
            this.programs = JSON.parse(this.propPrograms);
            this.learningModes = JSON.parse(this.propLearningModes);

            if(this.userId > 0){
                this.getData();
            }
        }
    },


    mounted(){
        this.loadProvince();
        this.initData();
       
    }
}
</script>
