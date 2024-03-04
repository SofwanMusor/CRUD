<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="style/index.css">
    <title>Sidebar</title>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-light bg-custom" style="box-shadow: 0px 0px 8px #888888;">
            <button class="navbar-toggler hamburger-button" type="button" data-toggle="collapse" aria-expanded="false"
                aria-label="Toggle navigation" @click="buttonhamburger()" style="z-index: 2">
                <div class="animated-icon"><span></span><span></span><span></span></div>
            </button>

            <div class="mx-auto order-0">
                <a class="navbar-brand mx-auto" href="#">Dashboard</a>
            </div>
        </nav>
        <div class="row">
            <div class="container-fluid mt-3 px-5">
                <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                    data-bs-target="#exampleModal" data-bs-whatever="@mdo">Add</button>
            </div>
        </div>
        <form id="registrationForm" @submit.prevent="addData">
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">ลงทะเบียน</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">ชื่อ-สกุล</label>
                                <input type="text" class="form-control" id="recipient-name" placeholder="ชื่อ-สกุล"
                                    v-model="formData.Name" name="Name" required>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">อายุ</label>
                                <input type="number" class="form-control" id="recipient-name" placeholder="อายุ"
                                    v-model="formData.Age" name="Age" min="0" step="1" required>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">เบอร์</label>
                                <input type="tel" class="form-control" id="recipient-name" placeholder="เบอร์"
                                    v-model="formData.Tel" name="Tel" pattern="[0-9]*" required>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="container-fluid mt-2 px-5">
            <div class="row mt-3">
                <table class="table" border="1">
                    <thead>
                        <tr>
                            <th scope="col">ชื่อ-สกุล</th>
                            <th scope="col">อายุ</th>
                            <th scope="col">เบอร์</th>
                            <th scope="col">เพิ่มเติม</th>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in datasrc">
                            <td>
                                {{item.Name}}
                            </td>
                            <td>
                                {{item.Age}}
                            </td>
                            <td>
                                {{item.Tel}}
                            </td>
                            <td>
                                <button class="button" type="button" @click="preparedata(item)">แก้ไข</button>
                                <span class="space"></span>
                                <button class="button1" type="button" @click="deleteValue(item.id)">ลบ</button>
                            </td>
                            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true" v-show="showEditModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูล</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="edit-recipient-name"
                                                        class="col-form-label">ชื่อ-สกุล</label>
                                                    <input type="text" class="form-control" id="edit-recipient-name"
                                                        placeholder="ชื่อ-สกุล" v-model="editData.Name">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="edit-recipient-age" class="col-form-label">อายุ</label>
                                                    <input type="number" class="form-control" id="edit-recipient-age"
                                                        placeholder="อายุ" v-model="editData.Age" min="0" step="1">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="edit-recipient-tel" class="col-form-label">เบอร์</label>
                                                    <input type="text" class="form-control" id="edit-recipient-tel"
                                                        placeholder="เบอร์" v-model="editData.Tel">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary" @click="updateData">Save
                                                    Changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="js/vue.js"></script>
</body>

</html>