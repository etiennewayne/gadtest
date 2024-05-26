<template>
    <div>
        <div class="section">

            <div class="columns is-centered">

                <div class="column is-10 is-12-mobile">

                    <div class="box">
                        <div class="has-text-weight-bold is-size-5 has-text-centered">CURRENT USERS</div>
                        <div class="has-text-weight-bold is-size-6 has-text-centered">Users currently registered this academic year.</div>
                        <div class="panel-body">
                            <div class="level">
                                <div class="level-left">
                                    <div class="level-item">
                                        <b-field label="PAGE" label-position="on-border">
                                            <b-select v-model="perPage" @input="setPerPage">
                                                <option value="5">5 per page</option>
                                                <option value="10">10 per page</option>
                                                <option value="15">15 per page</option>
                                                <option value="20">20 per page</option>
                                            </b-select>
                                        </b-field>
                                    </div>
                                </div>
                                <div class="level-right">
                                    <div class="level-item">
                                        <b-field label="SEARCH" label-position="on-border">
                                            <b-input type="input" v-model="search.lname" placeholder="Search Lastname..." @keyup.native.enter="loadAsyncData" />
                                            <b-input type="input" v-model="search.fname" placeholder="Search Firstname..." @keyup.native.enter="loadAsyncData" />
                                        </b-field>

                                    </div>
                                </div>
                            </div>

                            <div class="level">
                                <div class="level-left">
                                    <div class="level-right">
                                        <div class="level-item">
                                            <b-field label="SEARCH" label-position="on-border">
                                                <b-input type="input" v-model="search.user_id" placeholder="Search User ID..." @keyup.native.enter="loadAsyncData" />
                                            </b-field>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div style="display:flex; justify-content: flex-end;">
                                <p style="font-weight: bold; margin-bottom: 10px;">TOTAL ROWS: {{ total }} </p>
                            </div>

                            <div class="buttons mt-3">
                                <!-- <b-button tag="a" href="/cpanel-academicyear/create" class="is-primary">Create Account</b-button> -->
                                <b-button icon-pack="fa" icon-left="plus" tag="a" 
                                    href="/panel/current-users/create" class="is-primary">New User</b-button>
                            </div>

                            <b-table
                                :data="data"
                                :loading="loading"
                                paginated
                                backend-pagination
                                :total="total"
                                detailed
                                :per-page="perPage"
                                @page-change="onPageChange"
                                aria-next-label="Next page"
                                aria-previous-label="Previous page"
                                aria-page-label="Page"
                                aria-current-label="Current page"
                                backend-sorting
                                :range-after="5"
                                :page-input="hasInput"
                                :page-input-position="inputPosition"
                                :default-sort-direction="defaultSortDirection"
                                @sort="onSort">

                                <b-table-column field="user_id" label="ID" v-slot="props">
                                    {{ props.row.user_id }}
                                </b-table-column>

                                <b-table-column field="admission_code" label="Code" v-slot="props">
                                    {{ props.row.admission_code }}
                                </b-table-column>

                                <b-table-column field="lname" label="Fullname" v-slot="props">
                                    {{ props.row.lname }}, {{ props.row.fname }} {{ props.row.mname }}
                                </b-table-column>

                                <b-table-column field="sex" label="Sex" v-slot="props">
                                    {{ props.row.sex }}
                                </b-table-column>

                                <b-table-column field="role" label="Role" v-slot="props">
                                    {{ props.row.role }}
                                </b-table-column>

                                <b-table-column label="Action" v-slot="props">
                                    <b-dropdown aria-role="list">
                                        <template #trigger="{ active }">
                                            <b-button
                                                label="OPTIONS"
                                                type="is-primary"
                                                class="is-small"
                                                :icon-right="active ? 'menu-up' : 'menu-down'" />
                                        </template>

                                        <b-dropdown-item aria-role="listitem" icon-right="envelope-o" icon-pack="fa" @click="verifyEmail(props.row)">Verfiy Email</b-dropdown-item>
                                        <b-dropdown-item aria-role="listitem" icon-right="pencil" icon-pack="fa" :href="'/panel/current-users/'+ props.row.user_id + '/edit'" tag="a">Edit</b-dropdown-item>
                                        <b-dropdown-item aria-role="listitem" @click="openModalResetPassword(props.row.user_id)">Reset Password</b-dropdown-item>

                                        <!-- <b-dropdown-item aria-role="listitem" icon-pack="fa" icon-right="trash" @click="confirmDelete(props.row.user_id)">Delete</b-dropdown-item> -->
                                        <b-dropdown-item aria-role="listitem" icon-pack="fa" icon-right="trash" :href="`/panel/user-test-info/${props.row.user_id}`">Info</b-dropdown-item>

                                    </b-dropdown>
                                </b-table-column>

                                <template #detail="props">
                                    <div>
                                        <strong>EMAIL:</strong> {{ props.row.email }}
                                    </div>
                                    <div>
                                        <strong>USERNAME:</strong> {{ props.row.username }}
                                    </div>

                                    <div>
                                        <strong>VERIFIED AT:</strong> <span v-if="props.row.email_verified_at">{{ new Date(props.row.email_verified_at).toLocaleString() }}</span>
                                    </div>
                                </template>
                            </b-table>

                            <div class="buttons mt-3">
                                <!-- <b-button tag="a" href="/cpanel-academicyear/create" class="is-primary">Create Account</b-button> -->
                                <b-button icon-pack="fa" icon-left="plus" tag="a" href="/panel/current-users/create" class="is-primary">New User</b-button>
                            </div>
                        </div>
                    </div>
                </div> <!--col-->
            </div> <!--cols -->
        </div><!--section-->



        <!--modal reset password-->
        <b-modal v-model="isModalResetPassword" has-modal-card
                 trap-focus
                 :width="640"
                 aria-role="dialog"
                 aria-label="Modal"
                 aria-modal>

            <form @submit.prevent="submitResetPassword">
                <div class="modal-card">
                    <header class="modal-card-head">
                        <p class="modal-card-title">RESET PASSWORD</p>
                        <button
                            type="button"
                            class="delete"
                            @click="isModalResetPassword = false"/>
                    </header>

                    <section class="modal-card-body">
                        <div class="">

                            <b-field label="Password" label-position="on-border"
                                     :type="this.errors.password ? 'is-danger':''"
                                     :message="this.errors.password ? this.errors.password[0] : ''">
                                <b-input type="password" password-reveal v-model="fields.password" placeholder="Password">
                                </b-input>
                            </b-field>
                            <b-field label="Re-type Password" label-position="on-border"
                                     :type="this.errors.password_confirmation ? 'is-danger':''"
                                     :message="this.errors.password_confirmation ? this.errors.password_confirmation[0] : ''">
                                <b-input type="password" password-reveal v-model="fields.password_confirmation"
                                         placeholder="Re-type Password">
                                </b-input>
                            </b-field>
                        </div>
                    </section>
                    <footer class="modal-card-foot">
                        <b-button
                            label="Close"
                            @click="isModalResetPassword=false"/>
                        <button
                            :class="btnClass"
                            label="Save"
                            type="is-success">RESET PASSWORD</button>
                    </footer>
                </div>
            </form><!--close form-->
        </b-modal>
        <!--close modal reset password-->


    </div>
</template>

<script>
export default {

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
            hasInput: true,
            inputPosition: '',


            isModalCreate: false,
            isModalResetPassword: false,

            dataId: 0,

            fields: {},
            errors : {},

            btnClass: {
                'is-success': true,
                'button': true,
                'is-loading':false,
            },

            search: {
                lname: '',
                fname: '',
                user_id: '',
            }

        }
    },
    methods: {

        loadAsyncData() {
            const params = [
                `sort_by=${this.sortField}.${this.sortOrder}`,
                `perpage=${this.perPage}`,
                `page=${this.page}`,
                `lname=${this.search.lname}`,
                `fname=${this.search.fname}`,
                `user_id=${this.search.user_id}`
            ].join('&')

            this.loading = true
            axios.get(`/panel/get-current-users?${params}`)
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
            axios.delete('/panel/current-users/'+ delete_id).then(res=>{
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

        verifyEmail: function(dataRow){
            axios.post('/panel/current-verify-email-students/' + dataRow.user_id).then(res=>{
                console.log(res.data);
                if(res.data.status === 'verified'){
                    this.$buefy.dialog.alert({
                        title: 'EMAIL VERIFIED',
                        message: 'Email successfully verified.',
                        type: 'is-success',
                        onConfirm: ()=> this.loadAsyncData()
                    })
                }
            })
        },

        openModalResetPassword(dataId){
            this.fields = {};
            this.isModalResetPassword = true;
            this.dataId = dataId;
        },

        submitResetPassword: function(){
            axios.post('/panel/current-user-reset-password/' +this.dataId, this.fields).then(res=>{
                if(res.data.status === 'reset'){
                    this.$buefy.dialog.alert({
                        title: 'RESET SUCCESSFULLY!',
                        message: 'Password reset successfully',
                        type: 'is-success',
                        onConfirm: ()=>{
                            this.fields = {};
                            this.global_id = 0;
                            this.loadAsyncData();
                            this.isModalResetPassword = false;
                        }
                    });
                }
            }).catch(err=>{
                if(err.response.status === 422){
                    this.errors = err.response.data.errors;
                }
            })
        },


    },

    mounted(){
        this.loadAsyncData();
    }

}
</script>

<style scoped>
    .panel-body{
        padding: 25px;
    }
</style>
