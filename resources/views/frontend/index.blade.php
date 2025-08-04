<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Video Feed</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .video-card {
            margin-bottom: 2rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .comment-avatar {
            width: 40px;
            height: 40px;
            font-size: 18px;
            font-weight: bold;
        }

        .comment-bubble {
            font-size: 14px;
            line-height: 1.4;
        }

        .comment-section textarea {
            resize: none;
            font-size: 14px;
        }

        .comments-list {
            max-height: 300px;
            overflow-y: auto;
            padding-right: 5px;
        }
    </style>
</head>

<body>

    <div class="container py-4">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
              <a class="navbar-brand" href="#">SASS</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
          
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left side links -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                  </li>
                  <!-- Add more links here -->
                </ul>
          
                <!-- Right side: user info + logout -->
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                  @auth
                    <li class="nav-item d-flex flex-column align-items-end me-3">
                      <span class="fw-semibold">{{ auth()->user()->name }}</span>
                      <span class="text-muted small">{{ ucfirst(auth()->user()->user_type) }}</span>
                    </li>
                    <li class="nav-item">
                      <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
                      </form>
                    </li>
                  @endauth
                </ul>
              </div>
            </div>
          </nav>
          
         
        <h2 class="mb-4 text-center">Video Gallery</h2>
        @forelse ($videos as $video)
            @php
                $userLiked = $video->likes->where('user_id', auth()->id())->count() > 0;
            @endphp
            <div class="card video-card" data-video-id="{{ $video->id }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $video->title }}</h5>
                    <div class="ratio ratio-16x9 mb-3">
                        <video src="{{ asset('storage/' . $video->file_path) }}" controls></video>
                    </div>
                    <div class="d-flex gap-2 mb-2">
                        <button class="btn btn-sm like-btn {{ $userLiked ? 'btn-primary' : 'btn-outline-primary' }}"
                            data-video-id="{{ $video->id }}">
                            👍 Like <span class="likes-count">{{ $video->likes->count() }}</span>
                        </button>

                        <button class="btn btn-outline-secondary btn-sm comment-counter-btn">
                            💬 Comment ({{ $video->comments->count() }})
                        </button>
                    </div>
                   
                    <div class="comment-section mt-3">
                        <!-- Existing Comments -->
                        <div class="comments-list mb-3">
                            @foreach ($video->comments as $comment)
                                <div class="d-flex align-items-start mb-3">
                                    <div class="me-2">
                                        <div
                                            class="comment-avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center">
                                            {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                                        </div>
                                    </div>
                                    <div class="comment-bubble p-2 bg-light rounded shadow-sm w-100">
                                        <strong>{{ $comment->user->name }}</strong><br>
                                        <span>{{ $comment->comment }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Post New Comment -->
                        <div class="d-flex align-items-start">
                            <div class="me-2">
                                <div
                                    class="comment-avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <textarea class="form-control comment-text" rows="2" placeholder="Write a comment..."></textarea>
                                <button class="btn btn-sm btn-primary mt-1 post-comment-btn">Post Comment</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <span>No Videos Found</span>
            @endforelse
        <!-- Video Post 1 -->


    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Like button click
            $('.like-btn').click(function(e) {
                e.preventDefault();

                let btn = $(this);
                let videoId = btn.data('video-id');

                $.ajax({
                    url: '/video/' + videoId + '/like-toggle',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Update button color
                        if (response.liked) {
                            btn.removeClass('btn-outline-primary').addClass('btn-primary');
                        } else {
                            btn.removeClass('btn-primary').addClass('btn-outline-primary');
                        }
                        // Update like count
                        btn.find('.likes-count').text(response.likes_count);
                    },
                    error: function(xhr) {
                        alert('Please login to like videos.');
                    }
                });
            });

            // Comment post button click
            document.querySelectorAll('.post-comment-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const videoCard = this.closest('.video-card');
                    const videoId = videoCard.dataset.videoId;
                    const textarea = videoCard.querySelector('.comment-text');
                    const comment = textarea.value.trim();

                    if (!comment) {
                        alert('Please write a comment.');
                        return;
                    }

                    fetch(`/videos/${videoId}/comment`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            comment
                        })
                    }).then(async response => {
                        if (response.ok) {
                            
                            const data = await response.json();
                            const commentsList = videoCard.querySelector(
                                '.comments-list');

                            // Append new comment with proper styling
                            const newComment = document.createElement('div');
                            newComment.className = 'd-flex align-items-start mb-3';
                            newComment.innerHTML = `
  <div class="me-2">
    <div class="comment-avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center">
      ${data.user.name.charAt(0).toUpperCase()}
    </div>
  </div>
  <div class="comment-bubble p-2 bg-light rounded shadow-sm w-100">
    <strong>${data.user.name}</strong><br>
    <span>${data.comment.comment}</span>
  </div>
`;
                            commentsList.appendChild(newComment);

                            // Clear textarea
                            textarea.value = '';

                            // Update comment count in button
                            const commentBtn = videoCard.querySelector(
                                '.comment-counter-btn');
                            const currentCount = parseInt(commentBtn.textContent.match(
                                /\d+/)) || 0;
                            commentBtn.textContent = `💬 Comment (${currentCount + 1})`;
                        } else {
                            alert('Error posting comment.');
                        }
                    });
                });
            });
        });
    </script>
</body>

</html>
