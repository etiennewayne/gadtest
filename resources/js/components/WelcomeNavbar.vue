<template>
    <div>

        <b-navbar>
            <template #brand>
                <b-navbar-item tag="router-link" :to="{ path: '/' }">
                   
                </b-navbar-item>
            </template>
            <template #start>
                
            </template>

            <template #end>
                <b-navbar-item tag="div">
                    <div class="buttons">
                        <a class="button is-primary" href="/login">
                            <strong>Log in</strong>
                        </a>
                    </div>
                </b-navbar-item>
            </template>
        </b-navbar>

        
    </div>
</template>