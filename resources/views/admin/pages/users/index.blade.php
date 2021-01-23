@extends('layout')

@section('data-tables-css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
@endsection

@section('content')

@if(!empty($systemMessage))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button"
                class="close"
                data-dismiss="alert"
                aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
            {{ $systemMessage }}
    </div>
@endif

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Users</h1>
    
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List of users</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="users_table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Surname</th>
                            <th>Email</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Check</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p  style="margin:0;">Are you sure you want to delete this user?</p>
            </div>
            <div class="modal-footer">
             <button type="button" name="ok_button" id="ok_button" class="btn btn-danger waves-effect"><i class="ion-android-remove"></i> Delete</button>
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Back</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('data-tables-js')

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
<script>
    $(document).ready( function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#users_table').DataTable( {
            processing: true,
            serverSide: true,
            ajax: '{{ route('api.users') }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'surname', name: 'surname' },
                { data: 'email', name: 'email' },
                { data: 'created_at', name: 'created_at' },
                { "render": function ( data, type, full, meta ) {
                        var userShowURL = '{{ route("users.show", ":id") }}';
                        var userEditURL = '{{ route("users.edit", ":id") }}';
                        userShowURL = userShowURL.replace(':id', full.id);
                        userEditURL = userEditURL.replace(':id', full.id);
                        return '<a href="'+userShowURL+'" class="btn btn-secondary btn-small waves-effect"><i class="ion-show"></i> Show</a> <a href="'+userEditURL+'" class="btn btn-primary btn-small waves-effect"><i class="ion-edit"></i> Edit</a> <button type="button" name="delete" id="'+full.id+'" class="delete btn btn-danger btn-small waves-effect"><i class="ion-android-remove"></i> Delete</button>';
                } }
            ],
            "order": [[ 1, "asc" ]],
        } );

        var user_id;

        $(document).on('click', '.delete', function() {
            user_id = $(this).attr('id');
            $('#confirmModal').modal('show');
        });

        $('#ok_button').click(function() {
            
            var _token = "{{ csrf_token() }}";
            var userDeleteUrl = '{{ route("users.destroy", ":id") }}';
            userDeleteUrl = userDeleteUrl.replace(':id', user_id);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: userDeleteUrl,
                type: 'delete',
                dataType: "json",
                data: {
                    'id': user_id,
                    '_token':_token
                },
                success: function(data) {
                        setTimeout(function() {
                            $('#confirmModal').modal('hide');
                            $('#users_table').DataTable().ajax.reload();
                        }, 300);
                    }
                })
        });
    });
</script>    
@endsection