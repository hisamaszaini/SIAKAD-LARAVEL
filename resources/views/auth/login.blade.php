<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN SIAKAD - Sistem Informasi Akademik</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7ff 0%, #e3e9ff 100%);
            min-height: 100vh;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 2rem;
        }

        .main-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 1000px;
            display: flex;
            flex-direction: row;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .vector-container {
            background: #4e73df;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            width: 50%;
        }

        .login-container {
            width: 50%;
            background: white;
        }

        .brand-header {
            background: #96a7db;
            padding: 2rem;
            text-align: center;
            color: white;
        }

        .login-form {
            padding: 2rem;
        }

        .form-control {
            border-radius: 8px;
            padding: 0.8rem 1rem;
        }

        .btn-login {
            background: #4e73df;
            border: none;
            padding: 0.8rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-login:hover {
            background: #2e59d9;
            transform: translateY(-1px);
        }

        .education-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .help-text {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .footer {
            text-align: center;
            padding: 1rem;
            color: #6c757d;
            font-size: 0.9rem;
        }

        .vector-text {
            text-align: center;
            margin-top: 2rem;
        }

        @media (max-width: 768px) {
            .main-container {
                flex-direction: column;
                margin: 2rem;
                position: relative;
                transform: none;
                top: 0;
                left: 0;
            }

            .vector-container,
            .login-container {
                width: 100%;
            }

            .vector-container {
                padding: 2rem 1rem;
            }

            .container {
                padding: 0;
            }
        }

        .warna {
            color: #6884b0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="main-container">
            <div class="vector-container">
                <svg viewBox="0 0 500 500" width="300" height="300">
                    <path d="M250,50 L50,200 L50,400 L450,400 L450,200 Z" fill="#ffffff20" />
                    <path d="M250,80 L100,200 L100,350 L400,350 L400,200 Z" fill="#ffffff40" />
                    <circle cx="250" cy="180" r="50" fill="#ffffff60" />
                    <rect x="150" y="250" width="200" height="100" rx="10" fill="#ffffff80" />
                </svg>
                <div class="vector-text">
                    <h4>Selamat Datang di SIAKAD</h4>
                    <p>Sistem Informasi Akademik Terpadu</p>
                </div>
            </div>

            <div class="login-container">
                <div class="brand-header">
                    <i class="fas fa-graduation-cap education-icon"></i>
                    <h4 class="mb-0">SIAKAD</h4>
                    <p class="mb-0">Sistem Informasi Akademik Sekolah</p>
                </div>

                <div class="login-form">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="login" class="form-label">
                                <i class="fas fa-user me-2 warna"></i>Email / Username
                            </label>
                            <input id="login" name="login" type="text" class="form-control @error('login') is-invalid @enderror" value="" placeholder="Masukan Email / Username..." required>
                            @error('login')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">
                                <i class="fas fa-lock me-2 warna"></i>Password
                            </label>
                            <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" value="" placeholder="Masukan Password..." required>
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <button class="btn btn-login text-white w-100 mb-4">
                            <i class="fas fa-sign-in-alt me-2"></i>Login
                        </button>

                        <div class="text-center help-text">
                            Apakah kamu punya masalah? Hubungi admin
                            <a href="#disini" class="text-decoration-none">di sini</a>
                        </div>
                </div>

                <div class="footer">
                    Copyright © Siakad 2025
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>