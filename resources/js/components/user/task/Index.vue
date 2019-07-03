<template>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">My Tasks</div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Title</th>
                            <th>Deadline</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(task,index) in tasks" :key="index">
                            <td>{{ ++index }}</td>
                            <td class="text-capitalize">{{ task.title }}</td>
                            <td>{{ task.deadline }}</td>
                            <td>{{ task.status }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary"
                                    @click.prevent="showTask(task)">Show</button>
                                <app-user-task-show :task="task" :modalId="'my-task'+task.id"></app-user-task-show>
                                <button v-if="task.pending" @click.prevent="completeTask(task)"
                                    class="btn btn-sm btn-success">
                                    Complete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                tasks: [],
            }
        },
        methods: {
            getTasks() {
                axios.post(`/json/tasks`)
                    .then(res => {
                        this.tasks = res.data.data;
                    })
            },
            completeTask(task) {
                axios.post(`/task/${task.id}/complete`)
                    .then(res => {
                        this.getTasks();
                    })
            },
            showTask(task) {
                $('#my-task' + task.id).modal('show');
            }
        },
        created() {
            this.getTasks();
        }
    }

</script>
