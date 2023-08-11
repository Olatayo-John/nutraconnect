
<!-- -------------view-user----------- -->
<div class="modal fade" id="view" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">View Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="modal-flex">
                                <div class="modal-box1">
                                    <label class="form-label">Name</label>
                                    <h5 class="tab-heading">Anjani Pandey</h5>
                                </div>
                                <div class="modal-box2">
                                    <label class="form-label">Order ID</label>
                                    <h5 class="tab-heading">#00000000000000</h5>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="col-lg-12">
                            <h3 class="tab-heading"> Comment</h3>
                            <div class="border-box">
                                <div class="box-db">
                                    <div class="img-user">
                                        <img src="{{ asset('assets/images/avatars/avatar-1.png') }}" alt="">
                                    </div>
                                    <div class="content-user">
                                        <h6>Anjani Pandey - &nbsp;<span>5 min ago</span></h6>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                    </div>
                                </div>
                                <div class="box-db">
                                    <div class="img-user">
                                        <img src="{{ asset('assets/images/avatars/avatar-1.png') }}" alt="">
                                    </div>
                                    <div class="content-user">
                                        <h6>Anjani Pandey - &nbsp;<span>5 min ago</span></h6>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                    </div>
                                </div>
                                <div class="box-db">
                                    <div class="img-user">
                                        <img src="{{ asset('assets/images/avatars/avatar-1.png') }}" alt="">
                                    </div>
                                    <div class="content-user">
                                        <h6>Anjani Pandey - &nbsp;<span>5 min ago</span></h6>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 mx-auto my-4 text-end">
                            <div class="col-lg-12 margin-20">
                                <div class="flex-button">
                                    <div class="new-search">
                                        <div class="searchbar">

                                            <input class="form-control" type="text" placeholder="Type comment"
                                                data-last-active-input="">


                                        </div>

                                    </div>
                                    <div class="send-btn ">
                                        <button type="button" class="btn btn-success ">Send</button>
                                    </div>
                                </div>
                            </div>

                        </div>




                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- -------modal-user -->


@push('script')
        <script>
            $(document).ready(function() {
                $(document).on('click', '', function() {

                });
            });
        </script>
    @endpush
