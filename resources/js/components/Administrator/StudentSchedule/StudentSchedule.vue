<template>
    <div>
        
        <div class="columns is-centered">
                <div class="column is-8">

                    <div class="panel m-5">

                        <div class="panel-heading">
                            <div style="font-size: 20px; text-align: center; font-weight: bold;">LIST OF STUDENT'S SCHEDULES</div>
                        </div>

                        <div class="panel-body">

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Page" label-position="on-border">
                                        <b-select v-model="perPage" @input="setPerPage">
                                            <option value="5">5 per page</option>
                                            <option value="10">10 per page</option>
                                            <option value="15">15 per page</option>
                                            <option value="20">20 per page</option>
                                        </b-select>
                                    </b-field>
                                </div>

                                <div class="column">
                                    <b-field label="Search" label-position="on-border">
                                        <b-input type="text" v-model="search.lname" placeholder="Search Lastname..." @keyup.native.enter="loadAsyncData" />
                                        <b-input type="text" v-model="search.id" placeholder="Search Student ID..." @keyup.native.enter="loadAsyncData" />
                                    </b-field>
                                </div>
                            </div>
                            
                            <div class="columns">
                                <div class="column">
                                    <b-field label="Schedule" label-position="on-border">
                                        <b-datepicker v-model="search.date_sched" editable></b-datepicker>
                                        <b-timepicker v-model="search.time_sched_from" editable></b-timepicker>
                                        <b-timepicker v-model="search.time_sched_to" editable></b-timepicker>
                                        <p class="control">
                                            <b-button type="is-success" label="..." @click="loadAsyncData"></b-button>
                                        </p>
                                    </b-field>
                                </div>
                            </div>
                            


                            <div class="columns is-centered">
                                <div class="column">
                                    
                                    <div style="display:flex; justify-content: flex-end;">
                                        <p style="font-weight: bold; margin-bottom: 10px;">TOTAL ROWS: {{ total }} </p>
                                    </div>

                                    <div class="buttons mt-3">
                                        <b-button icon-pack="fa" icon-left="plus" tag="a"
                                                href="/panel/student-schedule/create" class="is-primary">New Student Schedule</b-button>
                                    </div>

                                    <b-table
                                        :data="data"
                                        :loading="loading"
                                        paginated
                                        detailed
                                        backend-pagination
                                        :total="total"
                                        :per-page="perPage"
                                        @page-change="onPageChange"
                                        aria-next-label="Next page"
                                        aria-previous-label="Previous page"
                                        aria-page-label="Page"
                                        aria-current-label="Current page"
                                        backend-sorting
                                        :default-sort-direction="defaultSortDirection"
                                        @sort="onSort">

                                        <b-table-column field="student_schedule_id" label="ID" v-slot="props">
                                            {{ props.row.student_schedule_id }}
                                        </b-table-column>

                                        <b-table-column field="fullname" label="Name" v-slot="props">
                                            {{ props.row.lname }}, {{ props.row.fname }} {{ props.row.mname }}
                                        </b-table-column>

                                        <b-table-column field="description" label="Description" v-slot="props">
                                            {{ props.row.description }}
                                        </b-table-column>

                                        <b-table-column field="from" label="From" v-slot="props">
                                            {{ new Date(props.row.from).toLocaleString() }}
                                        </b-table-column>

                                        <b-table-column field="to" label="To" v-slot="props">
                                            {{ new Date(props.row.to).toLocaleString() }}
                                        </b-table-column>

                                        <b-table-column field="max_user" label="Max Examinee" v-slot="props">
                                            {{ props.row.max_user }}
                                        </b-table-column>

                                        <b-table-column field="ay_id" label="Action" v-slot="props">
                                            <div class="is-flex">
                                                <b-button class="button is-small is-warning mr-1" tag="a" icon-right="pencil" icon-pack="fa" :href="'/panel/student-schedule/'+ props.row.student_schedule_id + '/edit'"></b-button>
                                                <b-button class="button is-small is-danger mr-1" icon-pack="fa" icon-right="trash" @click="confirmDelete(props.row.student_schedule_id)"></b-button>
                                            </div>
                                        </b-table-column>

                                        <template #detail="props">
                                            <div>
                                                <strong>USER ID:</strong> {{ props.row.user_id }}
                                            </div>
                                            <div>
                                                <strong>EMAIL:</strong> {{ props.row.email }}
                                            </div>
                                            <div>
                                                <strong>USERNAME:</strong> {{ props.row.username }}
                                            </div>

                                        </template>

                                    </b-table>

                                    <div class="buttons mt-3">
                                        <b-button icon-pack="fa" icon-left="plus" tag="a"
                                            href="/panel/student-schedule/create" class="is-primary">New Student Schedule</b-button>
                                    </div>
                                </div><!--close column-->
                            </div>
                        </div> <!-- panel body -->
                    </div> <!-- panel -->
                    
                </div> <!-- col -->
            </div> <!-- cols --> 

    </div> <!-- root div -->
</template>

<script>
export default {

    data(){
        return{
            data: [],
            total: 0,
            loading: false,
            sortField: 'student_schedule_id',
            sortOrder: 'desc',
            page: 1,
            perPage: 20,
            defaultSortDirection: 'asc',

            isModalActive: false,

            dataId: 0,


            fields: {},
            errors : {},
            globalId: 0,


            btnClass: {
                'is-success': true,
                'button': true,
                'is-loading':false,
            },

            search: {
                id: '',
                lname: '',
                date_sched: new Date(),
                time_sched_from: null,
                time_sched_to: null
            }

        }
    },
    methods: {
        loadAsyncData() {

            let ndate = new Date(this.search.date_sched);
            ndate = ndate.getFullYear() + '-' + (ndate.getMonth() + 1) + '-' + ndate.getDate();

            let ntimefrom = new Date(this.search.time_sched_from);
            ntimefrom = ntimefrom.getHours() + ":" + ntimefrom.getMinutes() + ":00";

            let ntimeto = new Date(this.search.time_sched_to);
            ntimeto = ntimeto.getHours() + ":" + ntimeto.getMinutes() + ":00";

            const params = [
                `sort_by=${this.sortField}.${this.sortOrder}`,
                `perpage=${this.perPage}`,
                `page=${this.page}`,
                `lname=${this.search.lname}`,
                `id=${this.search.id}`,
                `ndate=${ndate}`,
                `timefrom=${ntimefrom}`,
                `timeto=${ntimeto}`,
            ].join('&')

            this.loading = true
            axios.get(`/fetch-student-schedules?${params}`)
                .then(({ data }) => {
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


        //actions here below

        deleteSubmit(delete_id){
            axios.delete('/panel/student-schedule/'+ delete_id).then(res=>{
                this.loadAsyncData();
            }).catch(err=>{
                console.log(err);
            });
        },


        //alert
        confirmDelete(delete_id) {
            this.$buefy.dialog.confirm({
                title: 'DELETE!',
                type: 'is-danger',
                message: 'Are you sure you want to delete this data?',
                cancelText: 'Cancel',
                confirmText: 'Delete',
                onConfirm: () => this.deleteSubmit(delete_id)
            });
        },

        openModal(id){
            this.fields = {};
            this.errors = {};
            this.globalId = 0;

            if(id > 0){
                this.globalId = id;
                this.getData();
            }
            this.isModalActive = true;

        },

        getData(){

        },


    },

    mounted(){
        this.loadAsyncData();
    }

}
</script>

<style scoped>

</style>
