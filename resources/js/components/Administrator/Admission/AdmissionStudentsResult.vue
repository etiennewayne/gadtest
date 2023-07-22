<template>
    <div>
        <div class="section">
            <div class="table-title">LIST OF STUDENT AND RESULT</div>

            <div class="level">
                <div class="level-left">
                    <div class="level-item">
                        <b-field label="SEARCH" label-position="on-border">
                            <b-input type="text" placeholder="Search Lastname"
                                     v-model="search.lname" @keyup.native.enter="loadAsyncData"/>
                            <b-input type="text" placeholder="Search Firstname"
                                     v-model="search.fname" @keyup.native.enter="loadAsyncData"/>
                        </b-field>
                    </div>
                </div>
                <div class="level-right">
                    <div class="level-item">
                        <b-field label="1st Program" label-position="on-border">
                            <b-select v-model="search.first_program" placeholder="SELECT 1ST PROGRAM" @input="loadAsyncData">
                                <option value="">ALL</option>
                                <option v-for="(item, index) in this.programs" :key="index" :value="item.CCode">{{ item.CCode }}</option>
                            </b-select>
                        </b-field>
                    </div>
                </div>
            </div>

        </div>

        <div class="section">
            <div style="display:flex; justify-content: flex-end; margin-bottom: 10px;">
               
                <b-button class="is-small is-success is-outlined" style="margin-right:auto;" icon-pack="fa" icon-right="refresh" @click="loadAsyncData">REFRESH</b-button>
               
                <p style="font-weight: bold; margin-bottom: 10px;">TOTAL ROWS: {{ total }} </p>
            </div>

            <div class="table-container" style="font-size: 16px;">
                <b-table
                    :data="data"
                    :loading="loading"
                    paginated
                    backend-pagination
                    :total="total"
                    narrowed
                    hoverable
                    checkable
                    :checked-rows.sync="checkedRows"
                    :per-page="perPage"
                    @page-change="onPageChange"
                    detail-transition = ""
                    aria-next-label="Next page"
                    aria-previous-label="Previous page"
                    aria-page-label="Page"
                    range-before="2"
                    range-after="4"
                    :show-detail-icon=true
                    aria-current-label="Current page"
                    backend-sorting
                    :default-sort-direction="defaultSortDirection"
                    @sort="onSort" class="is-fullwidth">


                    <b-table-column field="user_id" label="User ID" v-slot="props">
                        {{ props.row.user_id }}
                    </b-table-column>

                    <b-table-column field="fullname" label="Fullname" v-slot="props">
                        {{ props.row.lname }}, {{ props.row.fname }} {{ props.row.mname }}
                    </b-table-column>

                    <b-table-column field="contact_no" label="Contact" v-slot="props">
                        {{ props.row.contact_no }}
                    </b-table-column>

                    <b-table-column field="sex" label="Sex" centered v-slot="props">
                        <span v-if="props.row.sex">
                            {{ props.row.sex[0] }}
                        </span>
                    </b-table-column>

                    <b-table-column field="city" label="City" v-slot="props">
                        {{ props.row.city }}
                    </b-table-column>

                    <b-table-column field="program" label="1st Program" v-slot="props">
                        {{ props.row.first_program_choice }}
                    </b-table-column>

                    <b-table-column field="program" label="2nd Program" v-slot="props">
                        {{ props.row.second_program_choice }}
                    </b-table-column>

                    <b-table-column field="abstraction" label="ABS" centered numeric v-slot="props">
                        <div v-if="props.row.abstraction < 1">
                            <span style="color:red; font-weight: bold;">{{ props.row.abstraction }}</span>
                        </div>
                        <div v-else style="color: green; font-weight: bold;">
                            {{ props.row.abstraction}}
                        </div>
                    </b-table-column>

                    <b-table-column field="logical" label="LOG" centered numeric v-slot="props">

                        <div v-if="props.row.logical < 1">
                            <span style="color:red; font-weight: bold;">{{ props.row.logical }}</span>
                        </div>
                        <div v-else style="color: green; font-weight: bold;">
                            {{ props.row.logical}}
                        </div>
                    </b-table-column>

                    <b-table-column field="english" label="ENGL" centered numeric v-slot="props">

                        <div v-if="props.row.english < 1">
                            <span style="color:red; font-weight: bold;">{{ props.row.english }}</span>
                        </div>
                        <div v-else style="color: green; font-weight: bold;">
                            {{ props.row.english}}
                        </div>

                    </b-table-column>

                    <b-table-column field="numerical" label="NUM" centered numeric v-slot="props">

                        <div v-if="props.row.numerical < 1">
                            <span style="color:red; font-weight: bold;">{{ props.row.numerical }}</span>
                        </div>
                        <div v-else style="color: green; font-weight: bold;">
                            {{ props.row.numerical}}
                        </div>

                    </b-table-column>

                    <b-table-column field="general" label="GEN" centered numeric v-slot="props">

                        <div v-if="props.row.general < 1">
                            <span style="color:red; font-weight: bold;">{{ props.row.general }}</span>
                        </div>
                        <div v-else style="color: green; font-weight: bold;">
                            {{ props.row.general}}
                        </div>

                    </b-table-column>

                    <b-table-column field="total" label="TOTAL" centered numeric v-slot="props">
                        <!-- {{ Number(props.row.general) + Number(props.row.numerical) + Number(props.row.english)
                        + Number(props.row.logical) + Number(props.row.abstraction) }} -->
                        <div v-if="Number(props.row.total) <= 0">
                            <span style="color:white; background-color: red; padding: 3px 10px; border-radius: 5px; font-weight: bold;">{{ props.row.total }}</span>
                        </div>

                        <div v-if="Number(props.row.total) >= 1 && Number(props.row.total) < 45">
                            <span style="color:white; background-color: orange; padding: 3px 10px; border-radius: 5px; font-weight: bold;">{{ props.row.total }}</span>
                        </div>

                        <div v-if="Number(props.row.total) >= 45">
                            <span style="color:white; background-color: green; padding: 3px 10px; border-radius: 5px; font-weight: bold;">{{ props.row.total }}</span>
                        </div>

                    </b-table-column>

                    <b-table-column field="code" label="Code" v-slot="props">
                        <div v-if="props.row.test_code">
                            <span style="color:#727272; font-weight: bold;">{{ props.row.test_code }}</span>
                        </div>
                    </b-table-column>

                    <b-table-column field="approved_program" label="AP" v-slot="props">
                        <div v-if="props.row.StudCourse">
                            <span style="color:#727272; font-weight: bold;">{{ props.row.StudCourse }}</span>
                        </div>
                    </b-table-column>

                    <b-table-column field="" label="Action" v-slot="props">
                        <div class="buttons">
                            <b-button v-if="props.row.is_submitted == 1" outlined class="button is-small is-link mr-1" 
                                icon-pack="fa" 
                                icon-right="arrow-circle-right" 
                                @click="openModal(props.row)">
                                    <span style="color:red; font-weight: bold;" v-if="props.row.remark === 'REJECT'">REJECTED</span>
                                    <span v-if="props.row.remark === 'ACCEPT'">ACCEPTED</span>
                                    <span v-if="props.row.remark === ''">SEND</span>
                            </b-button>

                            <b-button v-else outlined class="button is-small is-success mr-1" 
                                icon-pack="fa" 
                                icon-right="arrow-circle-right" 
                                @click="openModal(props.row)">
                                    SEND
                            </b-button>
                        </div>
                    </b-table-column>
                    <!-- <b-table-column field="numerical" label="Remarks" centered v-slot="props">
                        <span style="color:red; font-weight: bold; font-size: 12px;" v-if="props.row.remark === 'REJECT'">REJECTED</span>
                        <span v-if="props.row.remark === 'ACCEPT'" style="color:green; font-weight: bold; font-size: 12px;">ACCEPTED</span>
                    </b-table-column> -->
                </b-table>
            </div> <!--table container-->

            <div class="columns">
                <div class="column">
                    <div class="buttons is-left">
                        <downloadexcel
                            :fetch="loadDataForReport"
                            :fields="json_fields"
                            worksheet="REPORT"
                            :class="btnClass"
                            :before-generate="startDownload"
                            :before-finish="finishDownload"
                            name="student_result.xls">
                            Export to Excel
                        </downloadexcel>
                    </div>
                    <b-field grouped position="is-left">
                        
                    </b-field>
                </div>
                <div class="columns">
                    <div class="buttons is-right">
                        <b-button :disabled="disabledButtons" @click="confirmSubmitResult('accept')" type="is-success is-right" label="Accept"></b-button>
                        <b-button :disabled="disabledButtons" @click="confirmSubmitResult('reject')" type="is-danger" label="Reject"></b-button>
                        <!-- <b-button :disabled="disabledButtons" @click="submiResult('nothing')" type="is-info" label="Set Nothing"></b-button> -->
                    </div>
                    
                </div>
            </div><!--cols-->

        </div><!--section-->



        <b-modal v-model="isModalActive" has-modal-card
                 trap-focus aria-role="dialog" aria-modal>
            <div class="modal-card" style="height: 350px;">
                <header class="modal-card-head">
                    <p class="modal-card-title">PROGRAMS</p>
                    <button type="button" class="delete"
                            @click="isModalActive = false"/>

                </header>

                <section class="modal-card-body">
                    <div>
                        <b-field label="Select Program & Status">
                            <!-- <b-taginput
                                v-model="programTags"
                                :data="filteredPrograms"
                                autocomplete
                                field="CCode"
                                icon="label"
                                icon-pack="fa"
                                placeholder="Type a program (eg. BSCS)"
                                @typing="getFilteredTags">
                                <template v-slot="props">
                                    <strong>{{props.option.CCode}}</strong>: {{props.option.CDesc}}
                                </template>
                                <template #empty>
                                    There are no items
                                </template>
                            </b-taginput> -->

                            <b-select v-model="enrolProgram" placeholder="Select Program">
                                <option v-for="(item, index) in this.programs" 
                                    :key="index" 
                                    :value="item.CCode">{{ item.CCode }}</option>
                            </b-select>

                            <b-select v-model="studentStatus" placeholder="Select Status">
                                <option value="NEW">NEW</option>
                                <option value="TRANSFEREE">TRANSFEREE</option>
                            </b-select>

                        </b-field>

                        <b-field label="Accept/Reject">
                            <b-select v-model="statusOption" expanded>
                                <option value="ACCEPT">ACCEPT</option>
                                <option value="REJECT">REJECT</option>
                            </b-select>
                        </b-field>
                    </div>
                </section>

                <footer class="modal-card-foot">
                    <b-button
                        label="Close"
                        @click="isModalActive=false"></b-button>
                    <b-button
                        label="SEND" class="is-success"
                        icon-pack="fa" icon-right="arrow-circle-right"
                        :disabled="validateAcceptReject"
                        @click="sendEmail"></b-button>
                </footer>
            </div>
        </b-modal>

        <b-loading :is-full-page="isFullPage" v-model="isLoading">
            
        </b-loading>


    </div><!--root div-->
</template>

<script>

import downloadexcel  from "vue-json-excel";

export default {

    props: {
        propPrograms: {
            type: String,
            default: '',
        }
    },

    components: {
        downloadexcel,
    },

    data(){
        return{
            data: [],
            total: 0,
            loading: false,
            sortField: 'user_id',
            sortOrder: 'desc',
            page: 1,
            perPage: 20,
            defaultSortDirection: 'asc',

            isFullPage: true,
            isLoading: false,

            errors: {},

            statusOption: null,
            studentStatus: '',

            json_fields: {
                'USER ID' : 'user_id',
                'LASTNAME': 'lname',
                'FIRSTNAME': 'fname',
                'MIDDLENAME': 'mname',
                'SEX': 'sex',
                'CONTACT NO': 'contact_no',
                'STATUS': 'status',
                'EMAIL': 'email',
                '1ST PROGRAM': 'first_program_choice',
                '2ND PROGRAM': 'second_program_choice',
                'PROVINCE': 'province',
                'CITY': 'city',
                'BARANGAY': 'barangay',
                'ABSTRACTION': 'abstraction',
                'LOGICAL REASONING': 'logical',
                'ENGLISH PROFICIENCY': 'english',
                'NUMERICAL REASONING': 'numerical',
                'GENERAL KNWOLEDGE': 'general',
                'TOTAL SCORE': 'total',
                'CREATED AT': 'created_at',
            },

            report_data: [],

            btnClass: {
                'is-info': true,
                'button': true,
                'is-loading':false,
            },

            search: {
                lname: '',
                fname: '',
                first_program: '',
            },

            programs: [],

            enrolProgram: '',
            checkedRows: [],
          

            filteredPrograms: {},
            isSelectOnly: false,
            programTags: [],
            isModalActive: false,

            selectedData: {},


        }
    },

    methods: {

        loadAsyncData() {
            const params = [
                `sort_by=${this.sortField}.${this.sortOrder}`,
                `perpage=${this.perPage}`,
                `lname=${this.search.lname}`,
                `fname=${this.search.fname}`,
                `first_program=${this.search.first_program}`,
                `page=${this.page}`
            ].join('&')

            this.loading = true
            axios.get(`/panel/ajax-studentlist-result?${params}`).then(({ data }) => {
                    this.data = []
                    let currentTotal = data.total
                    if (data.total / this.perPage > 1000) {
                        currentTotal = this.perPage * 1000
                    }

                    this.total = currentTotal
                    data.data.forEach((item) => {
                        //item.release_date = item.release_date ? item.release_date.replace(/-/g, '/') : null
                        this.data.push(item)
                    })
                    this.loading = false
                })
                .catch((error) => {
                    this.data = []
                    this.total = 0
                    this.loading = false
                    throw error
                })
        },

        /*
        * Handle page-change event
        */
        onPageChange(page) {
            this.page = page
            this.loadAsyncData()
        },

        onSort(field, order) {
            this.sortField = field
            this.sortOrder = order
            this.loadAsyncData()
        },

        setPerPage(){
            this.loadAsyncData()
        },

        loadDataForReport: async function(){
            const params = [
                `first_program=${this.search.first_program}`
            ].join('&')

            const response = await axios.get(`/panel/report-excel-studentlist-result?${params}`);
            return response.data;
        },
        startDownload(){
            this.btnClass['is-loading'] = true;
        },
        finishDownload(){
            this.btnClass['is-loading'] = false;
        },


        openModal: function(dataRow){
            this.programTags = []; //init
            this.errors = {};
            this.isModalActive = true;
            this.selectedData = dataRow;
            this.enrolProgram = dataRow.first_program_choice;
            this.studentStatus = dataRow.status;

            // this.programTags.push({
            //     CCode: dataRow.first_program_choice,
            // });

            //if 1st program is same with 2nd program, then ignore the 2nd program
            // if(dataRow.first_program_choice !== dataRow.second_program_choice){
            //     this.programTags.push({
            //         CCode: dataRow.first_program_choice,
            //     });
            //     this.programTags.push({
            //         CCode: dataRow.second_program_choice,
            //     });
            // }else{
                
            // }
            
           // console.log(dataRow.first_program_choice);
        },
        getFilteredTags: function(text) {
            this.filteredPrograms = this.programs.filter((option) => {
                return option.CCode.toString().toLowerCase().indexOf(text.toLowerCase()) >= 0
            })
        },

        sendEmail: function(){
            if(this.enrolProgram === null || this.enrolProgram === ''){
                //this.errors.programTag = 'No program selected. Please select atleast 1 program.';
                alert('No program selected. Please select atleast 1 program.');
                return;
            }

            this.isModalActive = false;
            this.isLoading = true;

            if(this.statusOption === 'ACCEPT'){
                //ACCEPT EMAIL
                axios.post('/send-accept-email', {
                    fields: this.selectedData,
                    programs: this.enrolProgram,
                    studentStatus: this.studentStatus
                }).then(res=>{
                 
                    this.isModalActive = false;
                    this.isLoading = false;
                    if(res.data.status === 'success'){
                        this.$buefy.dialog.alert({
                            title: 'Saved.',
                            message: 'Student was successfully set their admission code.',
                            type: 'is-success',
                            onConfirm: ()=> this.loadAsyncData()
                        })
                    }
                    this.enrolProgram = '';
                    this.studentStatus = ''
                }).catch(err=>{
                    this.isModalActive = false;
                    this.isLoading = false;

                    if(err.response.status === 422){
                        
                        if(err.response.data.remark === 'duplicate'){
                            this.$buefy.dialog.alert({
                                title: 'DUPLICATE.',
                                message: 'Another with same student name already admitted to the admission.',
                                type: 'is-danger',
                            })
                        }
                    }
                    this.enrolProgram = '';
                    this.studentStatus = ''
                })
                

            }


            if(this.statusOption === 'REJECT'){
                axios.post('/send-reject-email', {
                    fields: this.selectedData,
                    programs: this.enrolProgram,
                    studentStatus: this.studentStatus
                }).then(res=>{
                    //console.log(res.data);
                    
                    this.isModalActive = false;
                    this.isLoading = false;
                    if(res.data.status === 'success'){
                        this.$buefy.dialog.alert({
                            title: 'Set rejected.',
                            message: 'Student was successfully set to rejected.',
                            type: 'is-warning',
                            onConfirm: ()=> this.loadAsyncData()
                        })
                    }
                })
                this.enrolProgram = '';
            }

        },

        //initialize data
        initData: function(){
            this.programs = JSON.parse(this.propPrograms);
            //this.filteredPrograms = this.programs;

            this.loadAsyncData();
        },


        confirmSubmitResult(remarks){

            let msgReject = 'Are you sure you want to <b>reject</b> these/this row(s)? Rejecting will result the deletion of the information from admission application but still exist in the gadtest application.';
            let msgAccept = 'Are you sure you want to <b>accept</b> these/this row(s)?';
            this.$buefy.dialog.confirm({
                title: 'Are you sure?',
                message: remarks === 'reject' ? msgReject : msgAccept,
                type: remarks === 'accept' ? 'is-info' : 'is-danger',
                onConfirm: ()=> {
                    this.submiResult(remarks);
                }
            })
        },

        //new module updated july 07, 2023 for faster accept/reject
        submiResult(remarks){
            this.isLoading = true;
            
            axios.post('/submit-result/' + remarks, {
                fields: this.checkedRows,
                programs: this.enrolProgram
            }).then(res=>{
                this.isLoading = false;
                if(res.data.status === 'saved'){
                    this.$buefy.dialog.alert({
                        title: 'Saved.',
                        message: 'Student succesfully saved.',
                        type: 'is-success',
                        onConfirm: ()=> {
                            this.loadAsyncData();
                            this.checkedRows = []
                        }
                    })
                }

                if(res.data.status === 'success_reject'){
                    this.$buefy.dialog.alert({
                        title: 'Saved.',
                        message: 'Student mark as reject.',
                        type: 'is-success',
                        onConfirm: ()=> {
                            this.loadAsyncData()
                            this.checkedRows = []
                        }
                    })
                }

                if(res.data.status === 'success_nothing'){
                    this.$buefy.dialog.alert({
                        title: 'Saved.',
                        message: 'Student remarks reset.',
                        type: 'is-success',
                        onConfirm: ()=> this.loadAsyncData()
                    })
                }
            }).catch(err=>{
                
                this.isLoading = false;

                if(err.response.status === 422){
                    
                    if(err.response.data.remark === 'duplicate'){
                        this.$buefy.dialog.alert({
                            title: 'DUPLICATE.',
                            message: 'Another with same student name already admitted to the admission.',
                            type: 'is-danger',
                        })
                    }
                }

                if(err.response.status === 500){
                    if(err.response.data.errors === 'unknown'){
                        this.$buefy.dialog.alert({
                            title: 'Error!',
                            message: err.response.data.errors.message + '. ' + err.response.data.errors.unknwon[0],
                            type: 'is-danger',
                        })
                    }
                }
            })
        },
    },

    mounted(){
        this.initData();
    },

    computed: {
        
        validateAcceptReject(){
            if(this.statusOption){
                return false;
                //return false to enable button
            }else{
                return true;
                //return true to disable button
            }
        },

        //if no data selected on rows, accept/reject buttons is disabled
        disabledButtons(){
            return this.checkedRows.length > 0 ? false : true;
        }
    }


}
</script>


<style scoped>


</style>

