@php
    $isEdit = isset($user) ? true : false;
    $url = $isEdit ? route('users.update',$user->id) : route('users.store');
@endphp


<div class="container-fluid">
    <div class="nk-content-inner">
        <div class="nk-content-body">
           
            <div class="nk-block">
                <div class="row g-gs">
                    <div class="col-xxl-6">
                        <div class="row g-gs">
                            <div class="col-lg-12 col-xxl-12">
                                <div class="card card-bordered">
                                    <div class="card-inner">
                                        <form action="{{$url}}" method="POST" id="user-form" enctype="multipart/form-data"
                                        data-form="ajax-form" data-datatable="#users-table" data-modal="#ajax_model">
                                        @csrf
                                        <div class="modal-header align-center">
                                            <div class="nk-file-title">
                                                <div class="nk-file-icon">
                                                    <em class="icon ni ni-user-add"></em>
                                                </div>
                                                <div class="nk-file-name">
                                                    <div class="nk-file-name-text"><span class="title">{{ $isEdit ? 'Update User' : 'Add New User' }}</span></div>
                                                </div>
                                            </div>
                                            <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                                        </div>
                                        <div class="modal-body p-0">
                                            @csrf
                                            @if($isEdit)
                                            @method('PUT')
                                             @endif
                                            <div class="row g-3">
                                                 <div class="col-12">
                                                     <input type="hidden" name="id" value="{{ $isEdit ? $user->id : '' }}"/>
                                                     <div class="form-group">
                                                         <label class="form-label" for="name">Name</label>
                                                         <div class="form-control-wrap">
                                                             <input type="text" class="form-control" id="name" name="name" value="{{  $isEdit ? $user->name : '' }}">
                                                           
                                                         </div>
                                                         
                                                     </div>
                                                 </div>
                                                 <div class="col-12">
                                                     <div class="form-group">
                                                         <label class="form-label" for="email">Email</label>
                                                         <div class="form-control-wrap">
                                                             <input type="email" class="form-control" id="email" name="email" value="{{ $isEdit ? $user->email : '' }}">
                                                           
                                                         </div>
                                                     </div>
                                                 </div>
                                                 <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="email">Phone</label>
                                                        <div class="form-control-wrap">
                                                            <input type="number" class="form-control" id="phone" name="phone" value="{{ $isEdit ? $user->phone : '' }}">
                                                          
                                                        </div>
                                                    </div>
                                                </div>
                                                 <div class="col-12">
                                                     <div class="form-group">
                                                         <label class="form-label" for="producer">Password</label>
                                                         <div class="form-control-wrap">
                                                             <input type="password" class="form-control" id="password" name="password" value="">
                                                            
                                                         </div>
                                                     </div>
                                                 </div>
                                                
                                             </div>
                                        </div><!-- .modal-body -->
                                        <div class="modal-footer bg-white">
                                            <ul class="btn-toolbar g-3">
                                                <li><a href="#" data-dismiss="modal" class="btn btn-outline-light btn-white">Cancle</a></li>
                                                <li><button href="#" type="submit" class="btn btn-primary">{{ $isEdit ? 'Update User' : 'Add New User' }}</button></li>
                                            </ul>
                                        </div><!-- .modal-footer -->
                                    </form>
                                    </div>
                                </div>
                            </div><!-- .col -->
                           
                        </div><!-- .row -->
                    </div><!-- .col -->
                   
                </div><!-- .row -->
            </div><!-- .nk-block -->
        </div>
    </div>
</div>
