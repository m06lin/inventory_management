<template>
    <div class="container">
        <div class="row  text-center">
            <h2 class="col">零配件清單</h2>
        </div>
        <div class="row">
            <div class="col-4">
                
            </div>
            <div class="col-8">
                
            </div>
        </div>
        <div class="row">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">代號</th>
                        <th scope="col">品名</th>
                        <th scope="col">群組</th>
                        <th scope="col">描述</th>
                        <th scope="col">設定</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">0</th>
                        <td><input class="form-control form-control-sm" type="text" v-model="newElement.uuid"></td>
                        <td><input class="form-control form-control-sm" type="text" v-model="newElement.name"></td>
                        <td>
                            <select class="form-control" v-model="newElement.group" :required="true">
                                <option v-for="(group, index) in groupList" :value="group.id" :key="group.id" :selected="index==0">
                                    {{ group.name }}
                                </option>
                            </select>
                        </td>
                        <td><input class="form-control form-control-sm" type="text" v-model="newElement.description"></td>
                        <td>
                            <button class="btn btn-outline-primary rounded-circle" @click="createElement()">
                                <svg class="bi" width="18" height="18" fill="currentColor">
                                    <use xlink:href="images/vendor/bootstrap-icons/bootstrap-icons.svg#plus"/>
                                </svg>
                            </button>
                        </td>
                    </tr>
                    <tr v-for="(element, index) in elementList" :key="element.id">
                        <th scope="row">{{index+1}}</th>
                        <!-- List Mode -->
                        <td v-if="editModeId!=element.id">{{element.uuid}}</td>
                        <td v-if="editModeId!=element.id">{{element.name}}</td>
                        <td v-if="editModeId!=element.id">{{mappingGroup(element.group_id)}}</td>
                        <td v-if="editModeId!=element.id">{{element.description}}</td>
                        <td v-if="editModeId!=element.id">
                            <button class="btn btn-outline-primary rounded-circle" @click="editModeId=element.id">
                                <svg class="bi" width="18" height="18" fill="currentColor">
                                    <use xlink:href="images/vendor/bootstrap-icons/bootstrap-icons.svg#pencil"/>
                                </svg>
                            </button>
                            <button class="btn btn-outline-danger rounded-circle" @click="deleteElement(index)">
                                <svg class="bi" width="18" height="18" fill="currentColor">
                                    <use xlink:href="images/vendor/bootstrap-icons/bootstrap-icons.svg#trash"/>
                                </svg>
                            </button>
                        </td>
                        <!-- Edit Mode -->
                        <td v-if="editModeId==element.id"><input class="form-control form-control-sm" type="text" v-model="element.uuid"></td>
                        <td v-if="editModeId==element.id"><input class="form-control form-control-sm" type="text" v-model="element.name"></td>
                        <td v-if="editModeId==element.id"><input class="form-control form-control-sm" type="text" v-model="element.group"></td>
                        <td v-if="editModeId==element.id"><input class="form-control form-control-sm" type="text" v-model="element.description"></td>
                        <td v-if="editModeId==element.id">
                            <button class="btn btn-outline-success rounded-circle" @click="editElement(index)">
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
                elementList: [],
                newElement: {},
                groupList: [],
            }
        },
        created() {
            this.getAllElements();
            this.getAllGroups();
            // this.mappingElements();
        },
        methods: {
            mappingGroup(groupId) {
                return this.groupList.find(x => x.id == groupId).name;
            },
            mappingElements() {
                this.elementList.forEach(function(item, index, array) {
                    let findGroup = this.groupList.find(x => x.id == item.group_id);
                    item.group = name;
                });
                console.log(this.elementList); 
            },
            getAllElements() {
                axios.get(localUrl+'/element')
                    .then(response => {
                        console.log('element');
                        console.log(response.data); 
                        this.elementList = response.data;
                    }).catch(error =>{
                        alert('取得失敗');
                    });
            },
            initSelectMonth() {
                this.selectDate = moment().format('YYYY-MM-DD');
            },
            getAllGroups() {
                axios.get(localUrl+'/group')
                    .then(response => {
                        console.log(response.data);
                        this.groupList = response.data;
                    }).catch(error =>{
                        alert('取得失敗');
                    });
            },
            createElement() {
                axios.post(localUrl+'/element/create', this.newElement)
                    .then(response => {
                        this.newElement = {};
                        this.getAllElements();
                    }).catch(error =>{
                        alert('新增失敗');
                    });
            },
            editElement(index) {
                let updateItem = this.elementList[index];
                axios.post(localUrl+'/element/update', updateItem)
                    .then(response => {
                        this.editModeId = 0;
                        this.getAllElements();
                    }).catch(error =>{
                        alert('更新失敗');
                    });
            },
            deleteElement(index) {
                let delItem = this.elementList[index];
                let isSureDel = confirm("是否確認刪除"+ delItem.name +"?")
                if (isSureDel == true) {
                    axios.post(localUrl+'/element/delete', { 'id': delItem.id })
                        .then(response => {
                            this.getAllElements();
                        }).catch(error =>{
                            alert('刪除失敗');
                        });
                }
            }
        }
    }
</script>