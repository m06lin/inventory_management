<template>
    <div class="container">
        <div class="row  text-center">
            <h2 class="col">產品清單</h2>
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
                        <th scope="col">單位</th>
                        <th scope="col">狀態</th>
                        <th scope="col">設定</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">新增</th>
                        <td><input class="form-control" type="text" v-model="newProduct.uuid"></td>
                        <td><input class="form-control" type="text" v-model="newProduct.name"></td>
                        <td>
                            <select class="form-control" v-model="newProduct.group" :required="true">
                                <option v-for="(group, index) in groupList" :value="group.id" :key="group.id" :selected="index==0">
                                    {{ group.name }}
                                </option>
                            </select>
                        </td>
                        <td><input class="form-control" type="text" v-model="newProduct.description"></td>
                        <td><input class="form-control" type="text" v-model="newProduct.unit"></td>
                        <td><input class="form-control" type="text" v-model="newProduct.status"></td>

                        <td>
                            <button class="btn btn-outline-primary rounded-circle" @click="createProduct()">
                                <svg class="bi" width="18" height="18" fill="currentColor">
                                    <use xlink:href="images/vendor/bootstrap-icons/bootstrap-icons.svg#plus"/>
                                </svg>
                            </button>
                        </td>
                    </tr>
                    <template v-for="(product, index) in productList">
                        <tr :key="'product-'+product.id" @click="showElementDetailId=product.id">
                            <th scope="row">{{index+1}}</th>
                            <!-- List Mode -->
                            <td v-if="editModeId!=product.id">{{product.uuid}}</td>
                            <td v-if="editModeId!=product.id">{{product.name}}</td>
                            <td v-if="editModeId!=product.id">{{mappingGroup(product.group_id)}}</td>
                            <td v-if="editModeId!=product.id">{{product.description}}</td>
                            <td v-if="editModeId!=product.id">{{product.unit}}</td>
                            <td v-if="editModeId!=product.id">{{product.status}}</td>
                            <td v-if="editModeId!=product.id">
                                <button class="btn btn-outline-primary rounded-circle" @click="openEditDetailMode(product.id)">
                                    <svg class="bi" width="18" height="18" fill="currentColor">
                                        <use xlink:href="images/vendor/bootstrap-icons/bootstrap-icons.svg#pencil"/>
                                    </svg>
                                </button>
                                <button class="btn btn-outline-danger rounded-circle" @click="deleteProduct(index)">
                                    <svg class="bi" width="18" height="18" fill="currentColor">
                                        <use xlink:href="images/vendor/bootstrap-icons/bootstrap-icons.svg#trash"/>
                                    </svg>
                                </button>
                            </td>
                            <!-- Edit Mode -->
                            <td v-if="editModeId==product.id"><input class="form-control form-control-sm" type="text" v-model="product.uuid"></td>
                            <td v-if="editModeId==product.id"><input class="form-control form-control-sm" type="text" v-model="product.name"></td>
                            <td v-if="editModeId==product.id"><input class="form-control form-control-sm" type="text" v-model="product.group"></td>
                            <td v-if="editModeId==product.id"><input class="form-control form-control-sm" type="text" v-model="product.description"></td>
                            <td v-if="editModeId==product.id"><input class="form-control form-control-sm" type="text" v-model="product.unit"></td>
                            <td v-if="editModeId==product.id"><input class="form-control form-control-sm" type="text" v-model="product.status"></td>
                            <td v-if="editModeId==product.id">
                                <button class="btn btn-outline-success rounded-circle" @click="editProduct(index)">
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
                        <tr :key="'product-'+product.id+'-element-'+elementId"  v-for="(elementId, eIndex) in product.comprise_elements" v-show="product.id==showDetail.id">
                            <th colspan="3" scope="row" class="text-center">{{eIndex+1}}</th>
                            <td colspan="3"></td>
                            <td colspan="2">
                                <button  v-if="editModeId==product.id" class="btn btn-outline-danger rounded-circle" @click="deleteCompriseElement(product.id, elementId)">
                                    <svg class="bi" width="18" height="18" fill="currentColor">
                                        <use xlink:href="images/vendor/bootstrap-icons/bootstrap-icons.svg#trash"/>
                                    </svg>
                                </button>
                                <button  v-if="editModeId==product.id && product.comprise_elements.length==eIndex+1" class="btn btn-outline-primary rounded-circle" @click="deleteCompriseElement(product.id, elementId)">
                                    <svg class="bi" width="18" height="18" fill="currentColor">
                                        <use xlink:href="images/vendor/bootstrap-icons/bootstrap-icons.svg#plus"/>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    </template>
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
                groupList: [ { id: 1, name: 'test1' }],
                editModeId: 0,
                productList: [
                    { 
                        id: 1, uuid: 'p1', name: 'P名稱', group: 'P規格', description: 'P公司P',
                        unit: '日規', status: '使用', comprise_elements: [1,2,3]
                    },
                                        { 
                        id: 2, uuid: 'p2', name: 'P2名稱', group: 'P規格2', description: 'P公司P2',
                        unit: '日規', status: '使用', comprise_elements: [1,3]
                    },

                ],
                newProduct: {},
                showDetail: { id: 0,  elementList:[] },
            }
        },
        created() {
            this.getAllElements();
            this.getAllProducts();
            this.getAllGroups();
        },
        methods: {
            mappingGroup(groupId) {
                return this.groupList.find(x => x.id == groupId).name;
            },
            openEditDetailMode(productId) {
                this.editModeId=productId;
                this.showDetail.id=productId;
                this.showDetail.elementList = productList[index].comprise_elements;
            },
            getGroupName(id) {
                let group = this.groupList.find(x => x.id === id);
                if(group){
                    return group.name;
                }
                return '';
            },
            getAllProducts() {
                axios.get(localUrl+'/product')
                    .then(response => {
                        console.log(response.data);
                        this.productList = response.data;
                    }).catch(error =>{
                        alert('取得失敗');
                    });
            },
            getAllElements() {
                axios.get(localUrl+'/element')
                    .then(response => {
                        console.log(response.data);
                        this.elementList = response.data;
                    }).catch(error =>{
                        alert('取得失敗');
                    });
            },
            initSelectMonth() {
                this.selectDate = moment().format('YYYY-MM-DD');
            },
            createProduct() {
                axios.post(localUrl+'/product/create', this.newProduct)
                    .then(response => {
                        this.newProduct = {};
                        this.getAllProducts();
                    }).catch(error =>{
                        alert('新增失敗');
                    });
            },
            editProduct(index) {
                let updateItem = this.productList[index];
                axios.post(localUrl+'/product/update', updateItem)
                    .then(response => {
                        this.editModeId = 0;
                        this.getAllProducts();
                    }).catch(error =>{
                        alert('更新失敗');
                    });
            },
            deleteProduct(index) {
                let delItem = this.productList[index];
                let isSureDel = confirm("是否確認刪除"+ delItem.name +"?")
                if (isSureDel == true) {
                    axios.post(localUrl+'/product/delete', { 'id': delItem.id })
                        .then(response => {
                            this.getAllProducts();
                        }).catch(error =>{
                            alert('刪除失敗');
                        });
                }
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
        }
    }
</script>