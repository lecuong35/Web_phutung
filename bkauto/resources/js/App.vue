<template>
    <router-view></router-view>    
</template>
<script>
import router from './router'


export default {
    name: 'App',
    methods : {
        adminPage() {
            router.push({name: 'admin'});
        }
    }

}


</script>
<style lang="scss">
    .menu{
        height: 100%;
    }
    @import '~bootstrap/scss/bootstrap';
</style>