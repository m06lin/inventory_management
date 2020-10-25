<template>
    <div class="row mt-2">
        <div class="col-xs-2 col-md-2 text-center">
            <router-view name="sidebar"></router-view>
        </div>
        <div class="col-xs-10 col-md-10">
            <router-view name="content"></router-view>
        </div>
    </div>
</template>