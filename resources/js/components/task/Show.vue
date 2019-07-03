<template>
    <!-- The Modal -->
    <div class="modal" :id="modalId">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Task Details</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <table class="table-borderless">
                        <tr>
                            <td>Title</td>
                            <td>:</td>
                            <td>{{ task.title }}</td>
                        </tr>
                        <tr>
                            <td>User</td>
                            <td>:</td>
                            <td>{{ task.user.name }}</td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td>:</td>
                            <td>{{ task.des }}</td>
                        </tr>
                        <tr>
                            <td>Deadline</td>
                            <td>:</td>
                            <td>{{ task.deadline }}</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>:</td>
                            <td>{{ task.status }}</td>
                        </tr>
                        <tr>
                            <td>File</td>
                            <td>:</td>
                            <td>
                                <a :href="task.attachment" target="_blank" download>{{ task.file }}</a>
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ["task", "modalId"]
    };

</script>
