<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register | Video App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .register-container {
            max-width: 450px;
            margin: 4% auto;
            padding: 2rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);
        }

        .register-container h2 {
            margin-bottom: 1.5rem;
        }

        .form-control::placeholder {
            color: #aaa;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="register-container">
        <h2 class="text-center">Register</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input 
                    type="text" 
                    name="name" 
                    class="form-control @error('name') is-invalid @enderror" 
                    id="name" 
                    placeholder="Enter your name"
                    value="{{ old('name') }}"
                    required autofocus>
                @error('name')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input 
                    type="email" 
                    name="email" 
                    class="form-control @error('email') is-invalid @enderror" 
                    id="email" 
                    placeholder="Enter your email"
                    value="{{ old('email') }}"
                    required>
                @error('email')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input 
                    type="password" 
                    name="password" 
                    class="form-control @error('password') is-invalid @enderror" 
                    id="password" 
                    placeholder="Enter password"
                    required>
                @error('password')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input 
                    type="password" 
                    name="password_confirmation" 
                    class="form-control" 
                    id="password_confirmation" 
                    placeholder="Confirm password"
                    required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Register</button>

            <div class="mt-3 text-center">
                Already have an account? <a href="{{ route('login') }}">Login here</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>

