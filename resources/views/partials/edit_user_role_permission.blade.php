<!-- -------modal-role-permission edit -->
<div class="modal fade" id="editUserRolePermissionModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Role & Permissions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">

                            <form action="{{ route('role-permission.updatePermission') }}" method="post"
                                id="editUserRolePermissionForm">
                                @csrf
                                @method('put')

                                <input type="hidden" name='user_id' value="">

                                <div class="form-group">
                                    <label for="">Role</label>
                                    <select name="role" id="role" userId="" class="form-control">
                                        <option value=""></option>
                                        @foreach ($roleList as $key => $value)
                                            <option value="{{ $value['id'] }}">{{ $value['name'] }}</option>
                                        @endforeach
                                    </select>

                                    <span class="err text-danger" id="roleErr"></span>
                                </div>

                                <div class="form-group mt-3">
                                    <label for="permissions">Permissions</label>
                                    <table id="editUserPermissionListTable" class="table" data-toggle="table">
                                        <thead>
                                            <tr>
                                                <th data-field="role">
                                                    <input type="checkbox" name="allPermissions" id="allPermissions"
                                                        formName="editUserRolePermissionForm"> Select All
                                                </th>
                                                <th data-field="list" class="text-center">List</th>
                                                <th data-field="view" class="text-center">View</th>
                                                <th data-field="create" class="text-center">Create</th>
                                                <th data-field="update" class="text-center">Update</th>
                                                <th data-field="delete" class="text-center">Delete</th>
                                            </tr><!-- end tr -->
                                        </thead><!-- end thead -->
                                        <tbody id="permissionsDiv">
                                        </tbody><!-- end tbody -->
                                    </table>

                                    <span class="err text-danger" id="permissionsErr"></span>
                                </div>

                                <div class="form-group mt-3">
                                    <button type="submit" class="btn btn-success btn-lg"
                                        id="editUserRolePermissionBtn">Update</button>
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
