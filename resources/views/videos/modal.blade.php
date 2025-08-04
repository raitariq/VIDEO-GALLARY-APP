@extends('app')
@section('content')
@php
    $isEdit = isset($video) ? true : false;
    $url = $isEdit ? route('video.update',$video->id) : route('video.store');
@endphp
<div class="container-fluid">
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">{{ $isEdit ? 'Update Video Detail' : 'Add Video Detail' }}</h3>
                        <div class="nk-block-des text-soft">
                        </div>
                    </div><!-- .nk-block-head-content -->
                   
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->
            <div class="nk-block">
                <div class="row g-gs">
                    <div class="col-xxl-6">
                        <div class="row g-gs">
                            <div class=" offset-2 col-lg-8 col-xxl-8">
                                <div class="card card-bordered">
                                    <div class="card-inner">
                                    <form method="POST" action="{{ $url }}" enctype="multipart/form-data">
                                       @csrf
                                       @if($isEdit)
                                       @method('PUT')
                                        @endif
                                       <div class="row g-3">
                                            <div class="col-12">
                                                <input type="hidden" name="id" value="{{ $isEdit ? $video->id : '' }}"/>
                                                <div class="form-group">
                                                    <label class="form-label" for="title">Title</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $isEdit ? $video->title : '') }}">
                                                        @error('title')
                                                            <div style="color: red;">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="publisher">Publisher</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" id="publisher" name="publisher" value="{{ old('publisher', $isEdit ? $video->publisher : '') }}">
                                                        @error('publisher')
                                                        <div style="color: red;">{{ $message }}</div>
                                                    @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="producer">Producer</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" id="producer" name="producer" value="{{ old('producer', $isEdit ? $video->producer : '') }}">
                                                        @error('producer')
                                                        <div style="color: red;">{{ $message }}</div>
                                                    @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="genre">Genre</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" id="genre" name="genre" value="{{ old('genre', $isEdit ? $video->genre : '') }}">
                                                        @error('genre')
                                                        <div style="color: red;">{{ $message }}</div>
                                                    @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="age_rating">Age Rating</label>
                                                    <div class="form-control-wrap">
                                                            <select id="age_rating" class="form-select js-select2" name="age_rating" data-search="on" data-dropdown="xs center">
                                                            <option value="G" {{ $isEdit && $video->age_rating == 'G' ? 'selected' : ''  }}>G</option>
                                                            <option value="PG" {{ $isEdit && $video->age_rating == 'PG' ? 'selected' : ''  }}>PG</option>
                                                            <option value="13+" {{ $isEdit && $video->age_rating == '13+' ? 'selected' : ''  }}>13+</option>
                                                            <option value="18+" {{ $isEdit && $video->age_rating == '18+' ? 'selected' : ''  }} >18+</option>
                                                        </select>
                                                        @error('age_rating')
                                                        <div style="color: red;">{{ $message }}</div>
                                                    @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                               <!-- Custom Select Video Box -->
                                                <!-- Custom Video Selector -->
                                                <div class="video-upload-box">
                                                    <video id="previewPlayer" src="{{ asset('storage/'.($isEdit ? $video->file_path : '')) }}" controls style="{{ $isEdit ? '' : 'display: none;' }} height: 200px; width: 100%"></video>
                                                    <!-- Browse Button (styled nicely) -->
                                                    <button type="button" id="browseButton" class="mt-2 btn btn-primary" onclick="document.getElementById('videoInput').click()" class="browse-btn">
                                                        📁 Browse Video
                                                    </button>
                                                    @error('video')
                                                    <div style="color: red;">{{ $message }}</div>
                                                    @enderror
                                                
                                                    <!-- Video Preview -->
                                                    
                                                </div>
                                                
                                                <input type="file" name="video" id="videoInput" accept="video/*" style="display: none" onchange="previewVideo(event)">
                                            </div>
                                            <div class="col-12">
                                                <button type="submit"  class="mt-2 btn btn-primary">
                                                   Submit
                                                </button>
                                            </div>

                                        </div>
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
<script>
  function previewVideo(event) {
        const file = event.target.files[0];
        const previewPlayer = document.getElementById('previewPlayer');
        const browseButton = document.getElementById('browseButton');

        if (file) {
            const videoURL = URL.createObjectURL(file);
            previewPlayer.src = videoURL;
            previewPlayer.style.display = 'block';
        }
    }
</script>
@endsection