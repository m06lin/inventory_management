<template>
    <div class="row col-md-6 col-md-offset-3">
       Login

    </div>
</template>

<script>
    export default {
        data () {
            return {
                userName: '',
                userPwd: '',
            };
        },

        methods: {
            logIn: async function () {
                const responseLogin = await this.userLogin({ username: this.userName, password: this.userPwd });
                if (responseLogin) {
                    this.$router.replace('/');
                }
            },
        },
    }
</script>
