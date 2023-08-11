<x-auth-layout>
    <main class="page-content">

        <div class="row">
            <div class="col-12 col-lg-12 col-xl-12">
                <div class="card">

                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h6 class="mb-0">Role & Permission</h6>
                        <p class="mb-0">List</p>
                    </div>

                    <div class="d-flex pt-3">
                        <button type="button" class="btn btn-success" id="createRolePermissionModalBtn">
                            <i class="bi bi-person-plus"></i> Add Role
                        </button>

                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#permissionListModal">
                            Permissions
                        </button>
                    </div>

                    <div class="card-body">

                        <div class="row">
                            <div class="col-lg-12">
                                <table id="rolePermissionTable" class="table-sm table" data-search="true"
                                    data-toggle="table" data-pagination="true" data-show-export="true"
                                    data-buttons-prefix="btn-sm btn" data-buttons-align="right">
                                    <thead>
                                        <tr>
                                            <th data-field="role" data-sortable="true" scope="col">Role</th>
                                            <th data-field="status" data-sortable="true" scope="col">Status</th>
                                            <th data-field="action" style="width: 80px; min-width: 80px;">Action</th>
                                        </tr><!-- end tr -->
                                    </thead><!-- end thead -->
                                    <tbody>
                                        @foreach ($roles as $role)
                                            <tr>
                                                <td>{{ $role->name }}</td>
                                                <td> {{ $role->status === '1' ? 'Active' : 'Not Active' }}</td>
                                                <td class="w-25">
                                                    <div class="d-flex">
                                                        <a class="btn btn-sm" id="showrolepermission"
                                                            roleId="{{ $role->id }}">
                                                            <i class="fa fa-eye text-primary"></i>
                                                        </a>

                                                        @if ($role->id !== 1)
                                                            <a class="btn btn-sm" id="editrolepermission"
                                                                roleId="{{ $role->id }}">
                                                                <i class="fa fa-pencil text-primary"></i>
                                                            </a>

                                                            <form method="post"
                                                                action="{{ route('role-permission.destroy', $role->id) }}">
                                                                @csrf @method('delete')
                                                                <button class="btn btn-sm"><i
                                                                        class="fa fa-trash text-danger"></i></button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr><!-- end tr -->
                                        @endforeach
                                    </tbody><!-- end tbody -->
                                </table><!-- end table -->
                            </div>
                        </div>

                        <input class="" type="search" style="opacity: 0;position: absolute;z-index: -1;">

                    </div>
                </div>
            </div>
        </div>

        @include('partials.create_role_permission')
        @include('partials.show_role_permission')
        @include('partials.edit_role_permission')
        @include('partials.permission_list')

    </main>



    @push('script')
        <script>
            $(document).ready(function() {

                //show create role-modal
                $('button#createRolePermissionModalBtn').on('click', function(e) {
                    e.preventDefault();

                    //clear any error or old input value
                    $('form#createRolePermissionForm input[name="role"]').val('');
                    $('form#createRolePermissionForm select[name="status"]').val("");
                    $('form#createRolePermissionForm input[type="checkbox"]').prop('checked',
                        false);

                    $('form#createRolePermissionForm span.err').text('').hide();

                    $('#createRolePermissionModal').modal('show');
                });

                //create role-permission
                $('form#createRolePermissionForm').on('submit', function(e) {
                    e.preventDefault();

                    $.ajax({
                        url: "{{ route('role-permission') }}",
                        method: "post",
                        dataType: "json",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        beforeSend: function() {
                            $('form#createRolePermissionForm span.err').text('').hide();
                        },
                        success: function(res) {

                            if (res.status === true) {
                                $('#alertDivAjaxSucc strong.alertMsgAjax').text(res.msg);
                                $('#alertDivAjaxSucc').show();

                                $('#createRolePermissionModal').modal('hide');
                                window.location.reload();
                            }
                        },
                        error: function(eRes) {
                            const errorKeys = ['role', 'status', 'permissions'];
                            const errors = eRes.responseJSON.errors;

                            if (errors)
                                $(errorKeys).each(function(key, value) {
                                    var errValue = errors['' + value + ''];

                                    if ((errValue) && (errValue !== "") && (errValue !==
                                            null) && (errValue !== undefined)) {
                                        $('form#createRolePermissionForm span#' + value + 'Err')
                                            .text(errValue[0]).show();
                                    }
                                });
                        }
                    });

                });

                // get all permission for the selected role
                $(document).on('click', '#showrolepermission', function(e) {
                    e.preventDefault();

                    var roleId = $(this).attr('roleId');

                    $.ajax({
                        url: "{{ route('role-permission.getPermissions') }}",
                        method: "post",
                        dataType: "json",
                        data: {
                            '_token': '{{ csrf_token() }}',
                            '_method': 'post',
                            'role': roleId
                        },
                        beforeSend: function() {
                            $('form#showRolePermissionForm input[name=role]').val('');
                            $('form#showRolePermissionForm input[name=status]').val('');
                            $('form#showRolePermissionForm #permissionsDiv').children().remove();
                        },
                        success: function(res, status) {

                            if (status === 'success') {

                                $('form#showRolePermissionForm input[name=role]').val(res.role
                                    .name);

                                $('form#showRolePermissionForm input[name=status]').val((res.role
                                    .status == '1') ? 'Active' : 'Not Active');

                                for (let i = 0; i < res.permissionList.length; i++) {
                                    var permissionN = res.permissionList[i].toLowerCase().replace(
                                        / /g, '_');

                                    var icon = "<i class='fa fa-check text-success'></i>";

                                    $('form#showRolePermissionForm #permissionsDiv').append(
                                        '<tr><td>' + res.permissionList[i] +
                                        '</td><td class="text-center">' + (res
                                            .permissionNameKeyList.includes(permissionN +
                                                '_list') ? icon : "") +
                                        '</td><td class="text-center">' + (res
                                            .permissionNameKeyList.includes(permissionN +
                                                '_view') ? icon : "") +
                                        '</td><td class="text-center">' + (res
                                            .permissionNameKeyList.includes(permissionN +
                                                '_create') ? icon : "") +
                                        '</td><td class="text-center">' + (res
                                            .permissionNameKeyList.includes(permissionN +
                                                '_update') ? icon : "") +
                                        '</td><td class="text-center">' + (res
                                            .permissionNameKeyList.includes(permissionN +
                                                '_delete') ? icon : "") + '</td></tr>');
                                }

                                //show modal
                                $('#showRolePermissionModal').modal('show');
                            }
                        }
                    });

                });

                // show role edit form
                $(document).on('click', '#editrolepermission', function(e) {
                    e.preventDefault();

                    var roleId = $(this).attr('roleId');

                    $.ajax({
                        url: "{{ route('role-permission.getPermissions') }}",
                        method: "post",
                        dataType: "json",
                        data: {
                            '_token': '{{ csrf_token() }}',
                            '_method': 'post',
                            'role': roleId
                        },
                        beforeSend: function() {
                            $('form#editRolePermissionForm input[name="role"]').val('');
                            $('form#editRolePermissionForm select[name="status"]').val("");
                            $('form#editRolePermissionForm input[type="checkbox"]').prop('checked',
                                false);

                            $('form#editRolePermissionForm span.err').text('').hide();
                        },
                        success: function(res, status) {

                            if (status === 'success') {

                                $('form#editRolePermissionForm input[name="role_id"]').val(res.role
                                    .id);

                                $('form#editRolePermissionForm input[name="role"]').val(res.role
                                    .name);

                                $('form#editRolePermissionForm select[name="status"]').val(res.role
                                    .status);

                                for (let i = 0; i < res.permissionNameKeyList.length; i++) {
                                    $('form#editRolePermissionForm input[name="permissions[' + res
                                        .permissionNameKeyList[i] + ']"]').prop('checked',
                                        true)
                                }

                                //show modal
                                $('#editRolePermissionModal').modal('show');
                            }
                        }
                    });
                });

                //save edited role
                $('form#editRolePermissionForm').on('submit', function(e) {
                    e.preventDefault();

                    $.ajax({
                        url: "{{ route('role-permission.updateRolePermission') }}",
                        method: "post",
                        dataType: "json",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        beforeSend: function() {
                            $('form#editRolePermissionForm span.err').text('').hide();
                        },
                        success: function(res, status) {

                            if (status === 'success' && res.status === true) {
                                $('#alertDivAjaxSucc strong.alertMsgAjax').text(res.msg);
                                $('#alertDivAjaxSucc').show();

                                $('#editRolePermissionModal').modal('hide');
                            }
                        },
                        error: function(eRes) {
                            const errorKeys = ['role', 'status', 'permissions'];
                            const errors = eRes.responseJSON.errors;

                            if (errors)
                                $(errorKeys).each(function(key, value) {
                                    var errValue = errors['' + value + ''];

                                    if ((errValue) && (errValue !== "") && (errValue !==
                                            null) && (errValue !== undefined)) {
                                        $('form#editRolePermissionForm span#' + value + 'Err')
                                            .text(errValue[0]).show();
                                    }
                                });
                        }
                    });

                });

            });
        </script>
    @endpush
</x-auth-layout>
