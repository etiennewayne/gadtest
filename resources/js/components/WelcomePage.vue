<template>
    <div>
       <div class="welcome-container mt-6">
            <div class="left-box animate__animated animate__fadeInLeft">
                <div class="welcome-title">Hello Future Alfonsos!</div> 

                <div class="w-subtitle">
                    The GADTC Admission Test for 1st Semester AY 2022-2023 will  
                    officially start on June 5, 2023. The exam will be administered at the 2nd Floor, GADTC Computer Laboratory. 
                    You may begin reserving your slots from April 12 - May 31, 2023 by clicking 
                    <b>PRE-REGISTER</b> button.
                </div>


                <div>
                    <button class="continue-application" onclick="window.location = '/register'">
                        <div>
                            <div class="pencil"></div>
                            <div class="folder">
                                <div class="top">
                                    <svg viewBox="0 0 24 27">
                                        <path d="M1,0 L23,0 C23.5522847,-1.01453063e-16 24,0.44771525 24,1 L24,8.17157288 C24,8.70200585 23.7892863,9.21071368 23.4142136,9.58578644 L20.5857864,12.4142136 C20.2107137,12.7892863 20,13.2979941 20,13.8284271 L20,26 C20,26.5522847 19.5522847,27 19,27 L1,27 C0.44771525,27 6.76353751e-17,26.5522847 0,26 L0,1 C-6.76353751e-17,0.44771525 0.44771525,1.01453063e-16 1,0 Z"></path>
                                    </svg>
                                </div>
                                <div class="paper"></div>
                            </div>
                        </div>
                        Pre-register Now
                    </button>
                </div>
            </div>

            <div class="right-box">
                <div class="animate__animated animate__fadeInRight">
                    <img src="/img/logo_small.png" alt="..." class="alfonso-img"/>
                </div>
            </div>

        </div><!--welcome-container -->
     
    </div><!--root navbar-->

</template>

<script>
export default {
    props: {
        isReg: {
            type: Boolean,  
            default: 1,
        }
    }

}

</script>

<style lang="scss">
    @import '../../sass/welcome.scss'
</style>

