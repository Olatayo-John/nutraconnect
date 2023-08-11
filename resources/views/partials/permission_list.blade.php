<!-- -------modal-permission list -->
<div class="modal fade" id="permissionListModal" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Permissions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">

                            <form action="" method="post" id="permissionListForm">
                                @csrf
                                @method('post')

                                <div class="form-group">
                                    <table id="permissionListTable" class="table" data-toggle="table">
                                        <thead>
                                            <tr>
                                                <th data-field="role"></th>
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

                                                        $icon= '<i class="fa fa-check text-success"></i>';
                                                @endphp

                                                <tr>
                                                    <td>{{ $permission }}</td>
                                                    <td>{!! in_array($permissionN . '_list', $permissionNameKeyList) ? $icon : '' !!}
                                                    </td>
                                                    <td>{!! in_array($permissionN . '_view', $permissionNameKeyList) ? $icon : '' !!}
                                                    </td>
                                                    <td>{!! in_array($permissionN . '_create', $permissionNameKeyList) ? $icon : '' !!}
                                                    </td>
                                                    <td>{!! in_array($permissionN . '_update', $permissionNameKeyList) ? $icon : '' !!}
                                                    </td>
                                                    <td>{!! in_array($permissionN . '_delete', $permissionNameKeyList) ? $icon : '' !!}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody><!-- end tbody -->
                                    </table>
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
