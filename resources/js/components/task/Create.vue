<template>
    <span>
        <!-- Button to Open the Modal -->
        <button type="button" class="btn btn-sm btn-success float-right" data-toggle="modal" data-target="#myModal">
             Add Task
        </button>

        <!-- The Modal -->
        <div class="modal" id="myModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Add Task</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <form @submit.prevent="storeData()">
                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">User</label>
                                <div class="col-sm-10">
                                    <select class="form-control" v-model="form.user">
                                        <option value="">Choose User</option>
                                        <option v-for="(user, index) in users" :key="index" :value="user.id"
                                            :class="{'is-invalid': form.errors.has('user')}">{{ user.name }}</option>
                                    </select>
                                    <has-error :form="form" field="user"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="title" placeholder="Title"
                                        v-model="form.title" :class="{ 'is-invalid': form.errors.has('title') }">
                                    <has-error :form="form" field="title"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="3" name="des" v-model="form.des"
                                        :class="{ 'is-invalid': form.errors.has('des') }"></textarea>
                                    <has-error :form="form" field="des"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Deadline</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="deadline" v-model="form.deadline"
                                        :class="{ 'is-invalid': form.errors.has('deadline') }">
                                    <has-error :form="form" field="deadline"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">File</label>
                                <div class="col-sm-10">
                                    <input @change.prevent="onFileChange" type="file" class="form-control-file"
                                        name="file" id="file">
                                </div>
                            </div>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </span>
</template>
<script>
    export default {
        data() {
            return {
                users: [],
                form: new Form({
                    title: '',
                    des: '',
                    deadline: '',
                    file: '',
                    user: '',
                }),
            }
        },
        methods: {
            getUsers() {
                axios.post(`/admin/json/users`)
                    .then(res => {
                        this.users = res.data;
                    })
            },
            storeData() {
                this.form.post(`/admin/tasks`)
                    .then(res => {
                        this.form.reset();
                        $('#file').val('');
                        this.$emit('getTasks');
                        toast.fire({
                            type: 'success',
                            title: 'Task has been created successfully'
                        })
                    })
            },
            onFileChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                reader.onload = (e) => {
                    this.form.file = e.target.result;
                };
                reader.readAsDataURL(file);
            },
        },
        created() {
            this.getUsers();
        }
    }

</script>
