<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PawApp Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --pawapp-primary: #8B4513;
            --pawapp-secondary: #D2691E;
            --pawapp-accent: #FFA500;
            --pawapp-light: #F5F5DC;
            --pawapp-dark: #654321;
        }

        body {
            background: linear-gradient(135deg, var(--pawapp-primary) 0%, var(--pawapp-secondary) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(139, 69, 19, 0.2);
            overflow: hidden;
            border: 3px solid var(--pawapp-light);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .login-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(139, 69, 19, 0.3);
        }

        .login-header {
            background: linear-gradient(45deg, var(--pawapp-primary), var(--pawapp-secondary));
            color: white;
            padding: 40px 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .login-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 20px 20px;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-10px) rotate(180deg);
            }
        }

        .paw-icon {
            font-size: 3rem;
            margin-bottom: 15px;
            display: inline-block;
            background: linear-gradient(45deg, var(--pawapp-accent), #FFD700);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.3));
        }

        .login-form {
            padding: 40px;
            background: var(--pawapp-light);
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--pawapp-primary);
            box-shadow: 0 0 0 0.2rem rgba(139, 69, 19, 0.25);
            transform: translateY(-2px);
        }

        .input-group-text {
            background: var(--pawapp-primary);
            border: 2px solid var(--pawapp-primary);
            color: white;
            border-radius: 10px 0 0 10px;
        }

        .btn-primary {
            background: linear-gradient(45deg, var(--pawapp-primary), var(--pawapp-secondary));
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(139, 69, 19, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(139, 69, 19, 0.4);
            background: linear-gradient(45deg, var(--pawapp-secondary), var(--pawapp-primary));
        }

        .back-link {
            color: var(--pawapp-primary);
            transition: color 0.3s ease;
        }

        .back-link:hover {
            color: var(--pawapp-secondary);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="login-container">
                    <div class="login-header">
                        <i class="fas fa-paw fa-3x mb-3 paw-icon"></i>
                        <h2 class="fw-bold">PawApp Admin</h2>
                        <p class="mb-0">Sign in to your account</p>
                    </div>

                    <div class="login-form">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <p class="mb-0">{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email') }}" required autofocus>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-2">
                                <i class="fas fa-sign-in-alt me-2"></i>Sign In
                            </button>
                        </form>

                        <div class="text-center mt-4">
                            <a href="{{ route('home') }}" class="text-decoration-none">
                                <i class="fas fa-arrow-left me-1"></i>Back to Website
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
