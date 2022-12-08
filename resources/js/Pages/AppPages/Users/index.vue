
<template>
    <Layout :active_page="'Users'">
        <Modal>
            <div class="modal-element">
                <component v-bind:is="modalComponent" :componentData="componentData"></component>
            </div>
        </Modal>
        <div class="main-body">
            <page-header/>
            <div class="page-heading">
                <h1>Users</h1>
            </div>

            <div class="form-action-tab">
                <div class="action-button-wrapper">
                    <button @click="openCreateUserModal">Add User</button>
                    <button @click="openTestComponent">Add User</button>
                </div>
            </div>

<!--                        <action-bar/>-->

            <div class="user-pan">
                <div class="table-bolder">
                    <div class="table-header">
                        <h4>Users List</h4>
                        <div class="table-pagination">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item "><a class="page-link" href="#">&laquo;</a></li>
                                    <li class="page-item"><a class="page-link active-page" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Email</th>
                            <th scope="col">Designation</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="user in users" @click="getUserDetails(user.id)" >
                            <th scope="row">{{ user.id }}</th>
                            <td>{{ user.first_name }}</td>
                            <td>{{ user.last_name }}</td>
                            <td>{{ user.email }}</td>
                            <td>{{ user.designation }}</td>
                            <td class="table-action-cell">
                                <div class="holder">
                                    <div class="view-action">
                                        <img src="/storage/icons/icons8-external-link-96-blue.png"
                                             onmouseover="this.src='/storage/icons/icons8-external-link-96.png'"
                                             onmouseout="this.src='/storage/icons/icons8-external-link-96-blue.png'"
                                             title="edit">
                                    </div>
                                    <div class="delete-action">
                                        <img src="/storage/icons/icons8-trash-can-96-red.png"
                                             onmouseover="this.src='/storage/icons/icons8-trash-can-96-white.png'"
                                             onmouseout="this.src='/storage/icons/icons8-trash-can-96-red.png'"
                                             title="delete">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="user-info">
                    <div class="pad-header">
                        <h1>User Info</h1>
                        <span @click="close_panel">X</span>
                    </div>
                    <div class="user-info-body" v-if="selectedData">
                        <div class="input-group">
                            <label for="">First Name</label>
                            <input type="text" v-model="selectedData.first_name" >
                        </div>
                        <div class="input-group">
                            <label for="">Last Name</label>
                            <input type="text" v-model="selectedData.last_name" >
                        </div>
                        <div class="input-group">
                            <label for="">Email</label>
                            <input type="text" v-model="selectedData.email" >
                        </div>
                        <div class="input-group">
                            <label for="">Designation</label>
                            <select v-model="selectedData.designation">
                                <option value="TempEmployee">TempEmployee</option>
                                <option value="Contract">Contract</option>
                                <option value="Intern">Intern</option>
                                <option value="PnPEmployee">PnPEmployee</option>
                                <option value="Manager">Manager</option>
                                <option value="Director">Detractor</option>
                                <option value="Administrator">Administrator</option>
                            </select>
                        </div>
                        <button @click="quickUpdateUser()">Quick Update</button>
                    </div>
                    <div class="unselected-data" v-else>
                        <p>No data to display.Please select a user.</p>
                    </div>
                </div>
            </div>

        </div>
    </Layout>

</template>

<script src="./res/index.js"></script>
<style src="./res/index.scss" lang="scss" scoped></style>

