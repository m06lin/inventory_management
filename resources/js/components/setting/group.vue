<template>
    <div class="container">
        <div class="row  text-center">
            <h2 class="col">群組分類列表</h2>
        </div>
        <div class="row">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">群組名稱</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">新增</th>
                        <td><input class="form-control form-control-sm" type="text" v-model="newItem.name"></td>
                        <td>
                            <button class="btn btn-outline-primary rounded-circle" @click="createGroup()">
                                <svg class="bi" width="18" height="18" fill="currentColor">
                                    <use xlink:href="images/vendor/bootstrap-icons/bootstrap-icons.svg#plus"/>
                                </svg>
                            </button>
                        </td>
                    </tr>
                    <tr v-for="(group, index) in groupList" :key="group.id">
                        <th scope="row">{{index+1}}</th>
                        <!-- List Mode -->
                        <td v-if="editModeId!=group.id">{{group.name}}</td>
                        <td v-if="editModeId!=group.id">
                            <button class="btn btn-outline-primary rounded-circle" @click="editModeId=group.id">
                                <svg class="bi" width="18" height="18" fill="currentColor">
                                    <use xlink:href="images/vendor/bootstrap-icons/bootstrap-icons.svg#pencil"/>
                                </svg>
                            </button>
                            <button class="btn btn-outline-danger rounded-circle" @click="deleteGroup(index)">
                                <svg class="bi" width="18" height="18" fill="currentColor">
                                    <use xlink:href="images/vendor/bootstrap-icons/bootstrap-icons.svg#trash"/>
                                </svg>
                            </button>
                        </td>
                        <!-- Edit Mode -->
                        <td v-if="editModeId==group.id"><input class="form-control form-control-sm" type="text" v-model="group.name"></td>
                        <td v-if="editModeId==group.id">
                            <button class="btn btn-outline-success rounded-circle" @click="editGroup(index)">
                                <svg class="bi" width="18" height="18" fill="currentColor">
                                    <use xlink:href="images/vendor/bootstrap-icons/bootstrap-icons.svg#check"/>
                                </svg>
                            </button>
                            <button class="btn btn-outline-secondary rounded-circle" @click="editModeId=0">
                                <svg class="bi" width="18" height="18" fill="currentColor">
                                    <use xlink:href="images/vendor/bootstrap-icons/bootstrap-icons.svg#x"/>
                                </svg>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<style>
   
</style>

<script>
    export default {
        data () {
            return {
                editModeId: 0,
                groupList: [],
                newItem: {},
            }
        },
        mounted() {
            this.getAllGroups();
        },
        methods: {
            getAllGroups() {
                axios.get(localUrl+'/group')
                    .then(response => {
                        console.log(response.data);
                        this.groupList = response.data;
                    }).catch(error =>{
                        alert('取得失敗');
                    });
            },
            initSelectMonth() {
                this.selectDate = moment().format('YYYY-MM-DD');
            },
            createGroup() {
                axios.post(localUrl+'/group/create', this.newItem)
                    .then(response => {
                        this.newItem = {};
                        this.getAllGroups();
                    }).catch(error =>{
                        alert('新增失敗');
                    });
            },
            editGroup(index) {
                let updateItem = this.groupList[index];
                axios.post(localUrl+'/group/update', updateItem)
                    .then(response => {
                        this.editModeId = 0;
                        this.getAllGroups();
                    }).catch(error =>{
                        alert('更新失敗');
                    });
            },
            deleteGroup(index) {
                let delItem = this.groupList[index];
                let isSureDel = confirm("是否確認刪除"+ delItem.name +"?")
                if (isSureDel == true) {
                    axios.post(localUrl+'/group/delete', { 'id': delItem.id })
                        .then(response => {
                            this.getAllGroups();
                        }).catch(error =>{
                            alert('刪除失敗');
                        });
                }
            }
        }
    }
</script>