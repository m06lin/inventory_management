<template>
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <router-link class="nav-link" :to="{name: 'product'}"  role="tab">產品清單</router-link>
        <router-link class="nav-link" :to="{name: 'element'}"  role="tab">零配件清單</router-link>
        <router-link class="nav-link" :to="{name: 'group'}"  role="tab">群組列表</router-link>      
    </div>
    <!-- <ul class="nav flex-column">
        <li class="nav-item">
            <router-link class="nav-link" :to="{name: 'product'}">Product</router-link>
        </li>
        <li class="nav-item">
            <router-link class="nav-link" :to="{name:'element'}">Element</router-link>
        </li>
    </ul> -->
</template>

<style scoped>
a {
    color: #343a40;
    text-decoration: none;
    background-color: transparent;
}
.nav-pills .nav-link.active, .nav-pills .show > .nav-link {
    color: #fff;
    background-color: #343a40;
}
</style>>