<template>

    <div>
        <div class="w-container">

            <b-notification
                type="is-warning is-light"
                aria-close-label="Close notification"
                role="alert">
                No online exam is allowed at this moment. Please take the exam on-site.
                For more intormation about the TCGCAT,
                click <a href="https://www.facebook.com/tcgcGAO">here</a>.
            </b-notification>

        </div>
    </div>
</template>

<script>

export default {
    data(){

    },

}
</script>

<style scoped>
    .w-container{
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }


</style>