<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Manajemen Karyawan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --primary-light: #4895ef;
            --primary-dark: #3a0ca3;
            --secondary: #7209b7;
            --accent: #f72585;
            --light: #f8f9fa;
            --dark: #1a1a2e;
            --gray: #6c757d;
            --light-gray: #e9ecef;
            --border-radius: 12px;
            --shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            display: flex;
            width: 100%;
            max-width: 900px;
            background: white;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login-illustration {
            flex: 1;
            background: linear-gradient(135deg, var(--primary-light), var(--accent));
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px;
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .login-illustration::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
        }

        .login-illustration::after {
            content: '';
            position: absolute;
            bottom: -80px;
            left: -80px;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
        }

        .illustration-icon {
            font-size: 5rem;
            margin-bottom: 20px;
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }

        .login-illustration h2 {
            font-size: 2rem;
            margin-bottom: 15px;
            position: relative;
            z-index: 2;
        }

        .login-illustration p {
            font-size: 1rem;
            opacity: 0.9;
            max-width: 300px;
            position: relative;
            z-index: 2;
        }

        .login-form {
            flex: 1;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo h1 {
            font-size: 2rem;
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .logo span {
            background: var(--primary);
            color: white;
            padding: 5px 12px;
            border-radius: 8px;
        }

        .form-title {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-title h2 {
            font-size: 1.8rem;
            color: var(--dark);
            margin-bottom: 10px;
        }

        .form-title p {
            color: var(--gray);
        }

        .input-group {
            margin-bottom: 20px;
            position: relative;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--dark);
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 42px;
            color: var(--gray);
        }

        .input-field {
            width: 100%;
            padding: 14px 20px 14px 45px;
            border: 2px solid var(--light-gray);
            border-radius: var(--border-radius);
            font-size: 1rem;
            transition: var(--transition);
        }

        .input-field:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }

        .input-field:focus + .input-icon {
            color: var(--primary);
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .remember input {
            width: 18px;
            height: 18px;
            accent-color: var(--primary);
        }

        .forgot-password {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .login-button {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            padding: 15px;
            border-radius: var(--border-radius);
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .login-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 7px 14px rgba(0, 0, 0, 0.15);
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 20px 0;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--light-gray);
        }

        .divider span {
            padding: 0 15px;
            color: var(--gray);
            font-size: 0.9rem;
        }

        .social-login {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
        }

        .social-btn {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 12px;
            border: 1px solid var(--light-gray);
            border-radius: var(--border-radius);
            background: white;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
        }

        .social-btn.google {
            color: #DB4437;
        }

        .social-btn.facebook {
            color: #4267B2;
        }

        .social-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .register-link {
            text-align: center;
            margin-top: 10px;
        }

        .register-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: #e53e3e;
            font-size: 0.9rem;
            margin-top: 5px;
            display: block;
        }

        .session-status {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: var(--border-radius);
            background-color: #f0f9ff;
            border-left: 4px solid var(--primary);
            color: var(--dark);
        }

        .session-status.success {
            background-color: #f0fdf4;
            border-left-color: #10b981;
        }

        .session-status.error {
            background-color: #fef2f2;
            border-left-color: #ef4444;
        }

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                max-width: 500px;
            }
            
            .login-illustration {
                padding: 30px 20px;
            }
            
            .login-form {
                padding: 30px;
            }
        }

        @media (max-width: 480px) {
            .remember-forgot {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .social-login {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-illustration">
            <div class="illustration-icon">
                <i class="fas fa-lock"></i>
            </div>
            <h2>Selamat Datang Kembali</h2>
            <p>Masuk ke sistem manajemen karyawan untuk mengelola data perusahaan Anda</p>
        </div>
        
        <div class="login-form">
            <div class="logo">
                <h1><span>SMK</span> Manajemen</h1>
            </div>
            
            <div class="form-title">
                <h2>Masuk ke Akun Anda</h2>
                <p>Silakan masukkan kredensial Anda untuk melanjutkan</p>
            </div>
            
            <!-- Session Status -->
            <x-auth-session-status class="session-status" :status="session('status')" />
            
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="input-group">
                    <label for="email">Email</label>
                    <div class="input-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <input 
                        id="email" 
                        class="input-field" 
                        type="email" 
                        name="email" 
                        placeholder="nama@perusahaan.com" 
                        value="{{ old('email') }}"
                        required 
                        autofocus 
                        autocomplete="email"
                    >
                    <x-input-error :messages="$errors->get('email')" class="error-message" />
                </div>
                
                <!-- Password -->
                <div class="input-group">
                    <label for="password">Password</label>
                    <div class="input-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <input 
                        id="password" 
                        class="input-field" 
                        type="password" 
                        name="password" 
                        placeholder="Masukkan password Anda" 
                        required 
                        autocomplete="current-password"
                    >
                    <x-input-error :messages="$errors->get('password')" class="error-message" />
                </div>
                
                <!-- Remember Me -->
                <div class="remember-forgot">
                    <div class="remember">
                        <input id="remember_me" type="checkbox" name="remember">
                        <label for="remember_me">Ingat saya</label>
                    </div>
                    @if (Route::has('password.request'))
                        <a class="forgot-password" href="{{ route('password.request') }}">
                            Lupa password?
                        </a>
                    @endif
                </div>
                
                <button type="submit" class="login-button">
                    <i class="fas fa-sign-in-alt"></i> Masuk
                </button>
            </form>
            
            <div class="divider">
                <span>atau lanjutkan dengan</span>
            </div>
            
            <div class="social-login">
                <button type="button" class="social-btn google">
                    <i class="fab fa-google"></i> Google
                </button>
                <button type="button" class="social-btn facebook">
                    <i class="fab fa-facebook-f"></i> Facebook
                </button>
            </div>
            
            <div class="register-link">
                Belum punya akun? 
                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Daftar sekarang</a>
                @endif
            </div>
        </div>
    </div>
    
    <script>
        // Menambahkan kelas status sesuai jenis pesan
        document.addEventListener('DOMContentLoaded', function() {
            const statusElement = document.querySelector('.session-status');
            if (statusElement) {
                const text = statusElement.textContent.toLowerCase();
                
                if (text.includes('berhasil') || text.includes('success')) {
                    statusElement.classList.add('success');
                } else if (text.includes('error') || text.includes('gagal') || text.includes('invalid')) {
                    statusElement.classList.add('error');
                }
            }
        });
    </script>
</body>
</html>