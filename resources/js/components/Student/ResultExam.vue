<template>
    <div>
        <div class="hero is-fullheight-with-navbar">
            <div class="hero-body">
                <div class="container">
                    <div class="columns">
                        <div v-if="this.results.is_submitted === 0" class="column is-6 is-offset-3">
                            <div class="panel is-primary">
                                <div class="panel-heading">
                                    TEST RESULT
                                </div>
                                <div class="panel-body">
                                    <p class="title">TOTAL SCORE</p>
                                   <!-- <p class="score">{{ this.results.score }}</p> -->
                                   <p class="">Result is not available this time.</p>

                                </div>
                            </div>
                        </div><!--col-->

                        <!--LETTER-->
                        <div v-if="this.results.is_submitted === 1" class="column is-8 is-offset-2">

                            <!-- ACCEPTANCE LETTER -->
                            <div v-if="this.results.remark === 'ACCEPT'" class="panel mypanel">
                                <div>Guidance and Admission Office</div>
                                <div>Tangub City Global College</div>
                                <div>Maloro, Tangub City, Misamis Occidental</div>
                                <br>
                                
                                <div>Dear Mr./Ms. {{this.results.lname}}, {{this.results.fname}} {{this.results.mname}},</div>
                                <br>
                                <h2 style="font-weight: bold;">CONGRATULATIONS</h2>
                                <br>
                                <p>
                                    Thank you for your active participation in the TCGCAT 2024-2025. 
                                    We would like to inform you that after carefully examining your scores, 
                                    your application has complied all necessary requirements of your chosen program.
                                </p>
                                <br>
                                <p>We are pleased to offer you admission as a Freshman to the following program(s):</p>
                                <ul>
                                    <li style="margin-left: 15px;" v-for="(item, index) in this.programs" :key="index"> - {{item.CCode}}</li>
                                </ul>
                                <br>
                                <p>
                                    To be part of the dynamic community of TCGC,  enroll via our student portal and use <b>{{ this.results.email }}</b> as 
                                    your username and <b>{{this.results.admission_code}}</b> (admission code) as your temporary password. 
                                    
                                </p><br>
                                <p>Please click the BUTTON below to accept this offer.</p>
                                <div class="buttons is-centered" style="margin: 15px 0;">
                                    <a class="button is-link" href="http://admission.gadtc.edu.ph/login">CLICK HERE TO APPLY</a>
                                </div>
                                <br>
                                <p>
                                    We look forward to welcoming you to TCGC this coming school year.
                                </p><br><br><br>

                                <p>Thanks,</p>
                                <p>TCGC Guidance and Admission Office</p>
                            </div>
                            <!-- ACCEPTANCE LETTER -->

                            <!-- REJECTON LETTER -->
                            <div v-if="this.results.remark === 'REJECT'" class="panel mypanel">
                               
                                <div>Guidance and Admission Office</div>
                                <div>Tangub City Global College</div>
                                <div>Maloro, Tangub City, Misamis Occidental</div>
                                <br>
                                
                                <div>Dear Mr./Ms. {{this.results.lname}}, {{this.results.fname}} {{this.results.mname}},</div>
                                <br>

                                <p>
                                    The Tangub City Global College appreciates your interest in applying for admission through the TCGCAT.
                                </p>
                                <br>
                                <p>
                                    Due to limited slots available, we regret to inform you that the results of 
                                    your test (SCORE: {{this.results.score}}) did not meet the required passing rate to make your eligible for admission.
                                </p>
                                <br>
                                <p>
                                    Thank you for your time and effort. We wish you success in your future academic endeavor.
                                </p>
                                <br><br>
                                <p>
                                    Best Regards,<br>
                                    TCGC Guidance and Admission Office
                                </p>


                            </div>
                        </div><!--col--><!--LETTER-->

                    </div><!--columns-->
                </div><!--container-->
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            results: 0,
            programs: {},
        }
    },
    methods: {
        loadResult(){
            axios('/fetch-result-exam').then(res=>{
                this.results = res.data[0];
                this.programs = JSON.parse(this.results.accepted_program);
                //console.log(this.programs);
                
            });
        }
    },
    mounted(){
        this.loadResult();
    },
    computed: {
        totalSum(){
            let total = 0;
            this.results.forEach( element => {
                total += parseInt(element.total_score);
            });
            return total;
        }
    }
}
</script>

<style scoped>
    .panel-body{
        padding: 15px;
        text-align: center;
    }

    .score{
        font-weight: bold;
        font-size: 3em;
    }

    .mypanel{
        padding: 25px;
    }

    
</style>
