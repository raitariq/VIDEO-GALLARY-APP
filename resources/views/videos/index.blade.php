@extends('app')
@section('content')
<link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<style>
     .video-upload-box {
        width: 360px;
        height: 100px;
        border: 2px dashed #aaa;
        border-radius: 10px;
        background-color: #f9f9f9;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .browse-btn {
        padding: 10px 20px;
        font-size: 16px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .browse-btn:hover {
        background-color: #0056b3;
    }

    #previewPlayer {
        width: 100% ;
        height: 100px ;
        object-fit: cover;
        border-radius: 10px;
    }

    </style>

<div class="container-fluid">
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Videos</h3>
                        <div class="nk-block-des text-soft">
                            @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        </div>
                    </div><!-- .nk-block-head-content -->
                    <div class="nk-block-head-content">
                        <a href="{{ route('video.create') }}" class="btn btn-primary"><em class="icon ni ni-add"></em><span>Create</span></a>
                    </div><!-- .nk-block-head-content -->
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->
            <div class="nk-block">
                <div class="row g-gs">
                    <div class="col-xxl-6">
                        <div class="row g-gs">
                            <div class="col-lg-12 col-xxl-12">
                                <div class="card card-bordered">
                                    <div class="card-inner">
                                        <table class="table table-bordered data-table" id="video-table">
                                            <thead>
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Publisher</th>
                                                    <th>Producer</th>
                                                    <th>Genre</th>
                                                    <th>Age Rating</th>
                                                    <th>Created at</th>
                                                    <th width="100px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
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
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
<script>
 $(function () {
        
        var table = $('#video-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('video-datatable') }}",
            columns: [
                {data: 'title', name: 'title', class:"nk-tb-col",searchable: false},
                {data: 'publisher', name: 'publisher', sClass:"nk-tb-col",  sWidth: '35%'},
                {data: 'producer', name: 'producer', sClass:"nk-tb-col", orderable: false,  sWidth: '35%'},
                {data: 'genre', name: 'genre', sClass:"nk-tb-col" , orderable: false, searchable: false,  sWidth: '15%'},
                {data: 'age_rating', name: 'age_rating', sClass:"nk-tb-col" , orderable: false, searchable: false,  sWidth: '15%'},
                {data: 'date', name: 'date', sClass:"nk-tb-col" , orderable: false, searchable: false,  sWidth: '15%'},
                {data: 'actions', name: 'actions', orderable: false, searchable: false, sClass:"nk-tb-col",  sWidth: '10%'},
            
            ]
        });
            
      });
    </script>
@endsection