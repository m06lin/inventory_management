<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <h1 class="navbar-brand">LOGO</h1>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <router-link class="nav-link" :to="{name:'home'}">首頁</router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" :to="{name:'setting'}">設定</router-link>
                </li>
            </ul>
        </div>
        </nav>
</template>

<script>
    export default {
    }
</script>
