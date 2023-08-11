<x-auth-layout>
    <main class="page-content">

        <div class="row">
            <div class="col-12 col-lg-12 col-xl-12">
                <div class="card">

                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h6 class="mb-0">User</h6>
                        <p class="mb-0">List</p>
                    </div>

                    <div class="d-flex pt-3">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#adduser"><i
                                class="bi bi-person-plus"></i> Add User</button>
                    </div>

                    <div class="card-body">

                        <div class="row">
                            <div class="col-lg-12">
                                <table id="usersTable" class="table-sm table" data-search="true" data-toggle="table"
                                    data-pagination="true" data-show-export="true" data-buttons-prefix="btn-sm btn"
                                    data-buttons-align="right">
                                    <thead>
                                        <tr>
                                            <th data-field="name" data-sortable="true" scope="col">Name</th>
                                            <th data-field="email" data-sortable="true" scope="col">Email</th>
                                            <th data-field="type" data-sortable="true" scope="col">Type</th>
                                            <th data-field="role" data-sortable="true" scope="col">Role</th>
                                            <th data-field="action" style="width: 80px; min-width: 80px;">Action</th>
                                        </tr><!-- end tr -->
                                    </thead><!-- end thead -->
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>
                                                    <img src="{{ $user->profile ? asset('storage/' . $user->profile) : asset('storage/default/no_image.jpg') }}"
                                                        class="avatar-sm rounded-circle me-2">
                                                    <a href="{{ route('user.show', $user->id) }}"
                                                        class="text-body fw-medium">{{ $user->name }}</a>
                                                </td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->type }}</td>
                                                <td>{{ $user->role->first() ? $user->role->first()->name : '' }}
                                                </td>
                                                <td>
                                                    <div class="d-flex">

                                                        @if ($user->id !== 1)
                                                            <a class="btn btn-sm" id="edituserrolepermission"
                                                                userId="{{ $user->id }}">
                                                                <i class="fa fa-key text-primary"></i>
                                                            </a>

                                                            <a href="{{ route('user.edit', $user->id) }}"
                                                                class="btn btn-sm">
                                                                <i class="fa fa-pencil text-primary"></i>
                                                            </a>

                                                            <form method="post"
                                                                action="{{ route('user.destroy', $user->id) }}">
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

        @include('partials.create_user_modal')
        @include('partials.edit_user_role_permission')



    </main>

    @push('script')
        <script>
            $(document).ready(function() {

                // show role edit form
                $(document).on('click', '#edituserrolepermission', function(e) {
                    e.preventDefault();

                    var userId = $(this).attr('userId');

                    $.ajax({
                        url: "{{ route('role-permission.getUserRolePermissions') }}",
                        method: "post",
                        dataType: "json",
                        data: {
                            '_token': '{{ csrf_token() }}',
                            '_method': 'post',
                            'userId': userId
                        },
                        beforeSend: function() {
                            $('form#editUserRolePermissionForm input[name="user_id"]').val('');
                            $('form#editUserRolePermissionForm select[name="role"]').val('').attr(
                                'userId', '');
                            $('form#editUserRolePermissionForm input[type="checkbox"]').prop(
                                'checked', false);
                            $('form#editUserRolePermissionForm #permissionsDiv').children()
                                .remove();

                            $('form#editUserRolePermissionForm span.err').text('').hide();
                        },
                        success: function(res, status) {

                            if (status === 'success') {

                                $('form#editUserRolePermissionForm input[name="user_id"]').val(res
                                    .user.id);

                                if (res.role) {
                                    $('form#editUserRolePermissionForm select[name="role"]').val(res
                                        .role.id).attr('userId', res
                                        .user.id);
                                }

                                if (res.permissionList) {
                                    for (let i = 0; i < res.permissionList.length; i++) {
                                        var permissionN = res.permissionList[i].toLowerCase()
                                            .replace(
                                                / /g, '_');

                                        $('form#editUserRolePermissionForm #permissionsDiv').append(
                                            '<tr><td>' + res.permissionList[i] +
                                            '</td><td class="text-center">' + (res
                                                .permissionNameKeyList.includes(permissionN +
                                                    '_list') ?
                                                "<input type='checkbox' name='permissions[" +
                                                permissionN + "_list]'>" : "") +
                                            '</td><td class="text-center">' + (res
                                                .permissionNameKeyList.includes(permissionN +
                                                    '_view') ?
                                                "<input type='checkbox' name='permissions[" +
                                                permissionN + "_view]'>" : "") +
                                            '</td><td class="text-center">' + (res
                                                .permissionNameKeyList.includes(permissionN +
                                                    '_create') ?
                                                "<input type='checkbox' name='permissions[" +
                                                permissionN +
                                                "_create]'>" : "") +
                                            '</td><td class="text-center">' + (res
                                                .permissionNameKeyList.includes(permissionN +
                                                    '_update') ?
                                                "<input type='checkbox' name='permissions[" +
                                                permissionN +
                                                "_update]'>" : "") +
                                            '</td><td class="text-center">' + (res
                                                .permissionNameKeyList.includes(permissionN +
                                                    '_delete') ?
                                                "<input type='checkbox' name='permissions[" +
                                                permissionN +
                                                "_delete]'>" : "") + '</td></tr>');
                                    }
                                }

                                if (res.userPermissions) {
                                    //checked the permission user has
                                    for (let i = 0; i < res.userPermissions.length; i++) {
                                        $('form#editUserRolePermissionForm input[name="permissions[' +
                                            res
                                            .userPermissions[i]["name_key"] + ']"]').prop(
                                            'checked',
                                            true);
                                    }
                                }
                            }

                            //show modal
                            $('#editUserRolePermissionModal').modal('show');

                        }
                    });
                });

                //on change role and show permission accordinly
                $(document).on('change', 'form#editUserRolePermissionForm select#role', function(e) {
                    e.preventDefault();

                    var userId = $(this).attr('userId');
                    var roleId = $(this).val();

                    $.ajax({
                        url: "{{ route('role-permission.getPermissions') }}",
                        method: "post",
                        dataType: "json",
                        data: {
                            '_token': '{{ csrf_token() }}',
                            '_method': 'post',
                            'role': roleId,
                            'user': userId,
                        },
                        beforeSend: function() {
                            $('form#editUserRolePermissionForm #permissionsDiv').children()
                                .remove();
                            $('form#editUserRolePermissionForm input[type="checkbox"]').prop(
                                'checked', false);

                            $('form#editUserRolePermissionForm span.err').text('').hide();
                        },
                        success: function(res, status) {

                            if (status === 'success') {

                                //show all permission for the role
                                for (let i = 0; i < res.permissionList.length; i++) {
                                    var permissionN = res.permissionList[i].toLowerCase().replace(
                                        / /g, '_');

                                    var icon = "<input type='checkbox' name='permissions[" +
                                        permissionN +
                                        "]'>";

                                    $('form#editUserRolePermissionForm #permissionsDiv').append(
                                        '<tr><td>' + res.permissionList[i] +
                                        '</td><td class="text-center">' + (res
                                            .permissionNameKeyList.includes(permissionN +
                                                '_list') ?
                                            "<input type='checkbox' name='permissions[" +
                                            permissionN + "_list]'>" : "") +
                                        '</td><td class="text-center">' + (res
                                            .permissionNameKeyList.includes(permissionN +
                                                '_view') ?
                                            "<input type='checkbox' name='permissions[" +
                                            permissionN + "_view]'>" : "") +
                                        '</td><td class="text-center">' + (res
                                            .permissionNameKeyList.includes(permissionN +
                                                '_create') ?
                                            "<input type='checkbox' name='permissions[" +
                                            permissionN +
                                            "_create]'>" : "") +
                                        '</td><td class="text-center">' + (res
                                            .permissionNameKeyList.includes(permissionN +
                                                '_update') ?
                                            "<input type='checkbox' name='permissions[" +
                                            permissionN +
                                            "_update]'>" : "") +
                                        '</td><td class="text-center">' + (res
                                            .permissionNameKeyList.includes(permissionN +
                                                '_delete') ?
                                            "<input type='checkbox' name='permissions[" +
                                            permissionN +
                                            "_delete]'>" : "") + '</td></tr>');
                                }

                                if (res.userPermissions) {
                                    // checked the permission user has previously
                                    // for (let i = 0; i < res.userPermissions.length; i++) {
                                    //     $('form#editUserRolePermissionForm input[name="permissions[' +
                                    //         res
                                    //         .userPermissions[i]["name_key"] + ']"]').prop(
                                    //         'checked',
                                    //         true)
                                    // }
                                }
                            }
                        },
                        error: function(eRes) {
                            const errorKeys = ['role', 'permissions'];
                            const errors = eRes.responseJSON.errors;

                            if (errors)
                                $(errorKeys).each(function(key, value) {
                                    var errValue = errors['' + value + ''];

                                    if ((errValue) && (errValue !== "") && (errValue !==
                                            null) && (errValue !== undefined)) {
                                        $('form#editUserRolePermissionForm span#' + value +
                                                'Err')
                                            .text(errValue[0]).show();
                                    }
                                });
                        }
                    });
                });


                //save edited role /user wise
                $('form#editUserRolePermissionForm').on('submit', function(e) {
                    e.preventDefault();

                    $.ajax({
                        url: "{{ route('role-permission.updateUserRolePermissions') }}",
                        method: "post",
                        dataType: "json",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        beforeSend: function() {
                            $('form#editUserRolePermissionForm span.err').text('').hide();
                        },
                        success: function(res, status) {

                            if (status === 'success' && res.status === true) {
                                $('#alertDivAjaxSucc strong.alertMsgAjax').text(res.msg);
                                $('#alertDivAjaxSucc').show();

                                $('#editUserRolePermissionModal').modal('hide');
                            }
                        },
                        error: function(eRes) {
                            const errorKeys = ['role', 'permissions'];
                            const errors = eRes.responseJSON.errors;

                            if (errors)
                                $(errorKeys).each(function(key, value) {
                                    var errValue = errors['' + value + ''];

                                    if ((errValue) && (errValue !== "") && (errValue !==
                                            null) && (errValue !== undefined)) {
                                        $('form#editUserRolePermissionForm span#' + value +
                                                'Err')
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
