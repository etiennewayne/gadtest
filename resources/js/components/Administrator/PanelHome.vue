<template>
    <div>

        <div class="columns mt-4 is-centered">
            <div class="column is-8-widescreen is-10-tablet">

                <div class="section">
                    <div class="columns">
                        <div class="column">
                            <div class="box">
                                <div class="subtitle">
                                    NEW STUDENTS ACCOUNT
                                </div>
                                <div class="is-size-1 mt-3 has-text-weight-bold has-text-centered">
                                    {{ this.reportData.new_students }} &nbsp; 
                                </div>
                            </div>
                        </div>
                        <div class="column">
                            <div class="box">
                                <div class="subtitle">
                                    ACCEPTED STUDENTS
                                </div>
                                <div class="is-size-1 mt-3 has-text-weight-bold has-text-centered">
                                    {{ this.reportData.accepted }}
                                </div>
                            </div>
                        </div>
                        <div class="column">
                            <div class="box">
                                <div class="subtitle">
                                    REJECTED STUDENTS 
                                </div>
                                <div class="is-size-1 mt-3 has-text-weight-bold has-text-centered">
                                    {{ this.reportData.rejected }}
                                </div>
                            </div>
                        </div>
                    
                    </div>
                </div> <!--section -->

                <!--another section -->
                <div class="section">
                    <div class="columns">
                        <div class="column">
                            <div class="box">
                                <div class="subtitle">
                                    TRANSFEREES 
                                </div>
                                <div class="is-size-1 mt-3 has-text-weight-bold has-text-centered">
                                    {{ this.reportData.no_transferees }}
                                </div>
                            </div>
                        </div>
                        <div class="column">
                            <div class="box">
                                <div class="subtitle">
                                    RETURNEES
                                </div>
                                <div class="is-size-1 mt-3 has-text-weight-bold has-text-centered">
                                    {{ this.reportData.no_returnees }}
                                </div>
                            </div>
                        </div>
                        <div class="column">
                            <div class="box">
                                <div class="subtitle">
                                    TAKERS
                                </div>
                                <div class="is-size-1 mt-3 has-text-weight-bold has-text-centered">
                                    {{ this.reportData.no_takers }}
                                </div>
                            </div>
                        </div>
                    
                    </div>
                </div> <!--section -->
            </div>
        </div> <!--container -->
        
    </div>
</template>

<script>
export default {

    data() {
        return {
            reportData: {
                accepted: 0,
                rejected: 0,
                no_takers: 0,
                no_transferees: 0,
                no_returnees: 0,
                new_students: 0,
            },
        }
    },

    methods: {
        getDashboardReport: function(){
            axios.get('/dashboard-report').then(res=>{
                this.reportData = res.data;
            });
        }
    },


    mounted() {
        this.getDashboardReport();
    }

}
</script>

<style scoped>

    .h-box{
        border: 1px solid gray;
        border-radius: 4px;
        
    }

    .h-box .h-box-header{
        height: 50px;
        background: rgb(238, 238, 238);
        font-weight: bold;
        padding: 10px;
    }

    .h-box .h-box-body{
        padding: 10px;
    }


    .h-box .h-box-body .h-entity{
        display: flex;
        margin: 10px 0;
    }

    .h-title{
        font-weight: bold;
        padding-right: 10px;
    }

    .h-count{
        font-weight: bold;
    }
</style>
