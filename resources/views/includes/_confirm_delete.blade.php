<button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteConfirm-{{ $id }}">
         Delete
    </button>
    <!-- Modal -->
    <div class="modal fade" id="deleteConfirm-{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ $action }}" method="post">
                    @csrf @method('delete')
                    <div class="modal-body">
                        <h3>Are You Sure To Delete???</h3>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-success" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-sm btn-danger">Yes</button>
                    </div>
                </form>
    
            </div>
        </div>
    </div>
    