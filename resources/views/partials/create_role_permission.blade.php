<!-- -------modal-role-permission -->
<div class="modal fade" id="createRolePermissionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">

                            <form action="" method="post" id="createRolePermissionForm">
                                @csrf
                                @method('post')

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="">Role</label>
                                        <input type="text" class="form-control" name="role">

                                        <span class="err text-danger" id="roleErr"></span>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">Status</label>
                                        <select name="status" id="" class="form-control">
                                            <option value="">Select</option>
                                            @foreach (config('site.status') as $status)
                                                <option value="{{ $status['value'] }}">
                                                    {{ $status['name'] }}</option>
                                            @endforeach
                                        </select>

                                        <span class="err text-danger" id="statusErr"></span>
                                    </div>
                                </div>

                                <div class="form-group mt-3">
                                    <label for="permissions">Permissions</label>
                                    <table id="createPermissionListTable" class="table" data-toggle="table">
                                        <thead>
                                            <tr>
                                                <th data-field="role">
                                                    <input type="checkbox" name="allPermissions" id="allPermissions"
                                                        formName="createRolePermissionForm"> Select All
                                                </th>
                                                <th data-field="list" class="text-center">List</th>
                                                <th data-field="view" class="text-center">View</th>
                                                <th data-field="create" class="text-center">Create</th>
                                                <th data-field="update" class="text-center">Update</th>
                                                <th data-field="delete" class="text-center">Delete</th>
                                            </tr><!-- end tr -->
                                        </thead><!-- end thead -->
                                        <tbody>
                                            @foreach ($permissionList as $permission)
                                                @php
                                                    $permissionN = Str::of($permission)
                                                        ->lower()
                                                        ->replace(' ', '_');
                                                @endphp

                                                <tr>
                                                    <td>{{ $permission }}</td>
                                                    <td>{!! in_array($permissionN . '_list', $permissionNameKeyList)
                                                        ? '<input type="checkbox"
                                                                                                                                                                name="permissions[' .
                                                            $permissionN .
                                                            '_list]">'
                                                        : '' !!}
                                                    </td>
                                                    <td>{!! in_array($permissionN . '_view', $permissionNameKeyList)
                                                        ? '<input type="checkbox"
                                                                                                                                                                name="permissions[' .
                                                            $permissionN .
                                                            '_view]">'
                                                        : '' !!}
                                                    </td>
                                                    <td>{!! in_array($permissionN . '_create', $permissionNameKeyList)
                                                        ? '<input type="checkbox"
                                                                                                                                                                name="permissions[' .
                                                            $permissionN .
                                                            '_create]">'
                                                        : '' !!}
                                                    </td>
                                                    <td>{!! in_array($permissionN . '_update', $permissionNameKeyList)
                                                        ? '<input type="checkbox"
                                                                                                                                                                name="permissions[' .
                                                            $permissionN .
                                                            '_update]">'
                                                        : '' !!}
                                                    </td>
                                                    <td>{!! in_array($permissionN . '_delete', $permissionNameKeyList)
                                                        ? '<input type="checkbox"
                                                                                                                                                                name="permissions[' .
                                                            $permissionN .
                                                            '_delete]">'
                                                        : '' !!}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody><!-- end tbody -->
                                    </table>

                                    <span class="err text-danger" id="permissionsErr"></span>
                                </div>

                                <div class="form-group mt-3">
                                    <button type="submit" class="btn btn-success btn-lg"
                                        id="createRolePermissionBtn">Create</button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- -------modal-user -->
