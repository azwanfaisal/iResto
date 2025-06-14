<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Sistem Manajemen Karyawan</title>
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

        .register-container {
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

        .register-illustration {
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

        .register-illustration::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
        }

        .register-illustration::after {
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

        .register-illustration h2 {
            font-size: 2rem;
            margin-bottom: 15px;
            position: relative;
            z-index: 2;
        }

        .register-illustration p {
            font-size: 1rem;
            opacity: 0.9;
            max-width: 300px;
            position: relative;
            z-index: 2;
        }

        .register-form {
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

        .password-strength {
            height: 5px;
            background: var(--light-gray);
            border-radius: 2.5px;
            margin-top: 10px;
            overflow: hidden;
            position: relative;
        }

        .strength-meter {
            height: 100%;
            width: 0;
            background: #e53e3e;
            transition: width 0.3s ease;
        }

        .password-rules {
            margin-top: 10px;
            font-size: 0.85rem;
            color: var(--gray);
        }

        .password-rules ul {
            padding-left: 20px;
            margin-top: 5px;
        }

        .password-rules li {
            margin-bottom: 5px;
        }

        .password-rules .valid {
            color: #10b981;
        }

        .password-rules .invalid {
            color: #e53e3e;
        }

        .register-button {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            padding: 15px;
            border-radius: var(--border-radius);
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            margin-top: 15px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .register-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 7px 14px rgba(0, 0, 0, 0.15);
        }

        .login-link {
            text-align: center;
            margin-top: 10px;
        }

        .login-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
        }

        .login-link a:hover {
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
            .register-container {
                flex-direction: column;
                max-width: 500px;
            }
            
            .register-illustration {
                padding: 30px 20px;
            }
            
            .register-form {
                padding: 30px;
            }
        }

        @media (max-width: 480px) {
            .form-title h2 {
                font-size: 1.5rem;
            }
            
            .register-form {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-illustration">
            <div class="illustration-icon">
                <i class="fas fa-user-plus"></i>
            </div>
            <h2>Buat Akun Baru</h2>
            <p>Bergabunglah dengan sistem manajemen karyawan untuk mulai mengelola data perusahaan Anda</p>
        </div>
        
        <div class="register-form">
            <div class="logo">
                <h1><span>SMK</span> Manajemen</h1>
            </div>
            
            <div class="form-title">
                <h2>Daftar Akun Baru</h2>
                <p>Silakan isi formulir di bawah untuk membuat akun</p>
            </div>
            
            <!-- Session Status -->
            <x-auth-session-status class="session-status" :status="session('status')" />
            
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="input-group">
                    <label for="name">Nama Lengkap</label>
                    <div class="input-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <input 
                        id="name" 
                        class="input-field" 
                        type="text" 
                        name="name" 
                        placeholder="Masukkan nama lengkap Anda" 
                        value="{{ old('name') }}"
                        required 
                        autofocus 
                        autocomplete="name"
                    >
                    <x-input-error :messages="$errors->get('name')" class="error-message" />
                </div>
                
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
                        placeholder="Buat password yang kuat" 
                        required 
                        autocomplete="new-password"
                    >
                    <div class="password-strength">
                        <div class="strength-meter" id="strengthMeter"></div>
                    </div>
                    <div class="password-rules">
                        <p>Password harus memenuhi:</p>
                        <ul>
                            <li id="lengthRule">Minimal 8 karakter</li>
                            <li id="uppercaseRule">Huruf besar (A-Z)</li>
                            <li id="numberRule">Angka (0-9)</li>
                            <li id="specialRule">Karakter khusus (@$!%*?&)</li>
                        </ul>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="error-message" />
                </div>
                
                <!-- Confirm Password -->
                <div class="input-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <div class="input-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <input 
                        id="password_confirmation" 
                        class="input-field" 
                        type="password" 
                        name="password_confirmation" 
                        placeholder="Konfirmasi password Anda" 
                        required 
                        autocomplete="new-password"
                    >
                    <x-input-error :messages="$errors->get('password_confirmation')" class="error-message" />
                </div>
                
                <button type="submit" class="register-button">
                    <i class="fas fa-user-plus"></i> Daftar Akun
                </button>
            </form>
            
            <div class="login-link">
                Sudah punya akun? 
                <a href="{{ route('login') }}">Masuk disini</a>
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
            
            // Password strength checker
            const passwordInput = document.getElementById('password');
            const strengthMeter = document.getElementById('strengthMeter');
            const lengthRule = document.getElementById('lengthRule');
            const uppercaseRule = document.getElementById('uppercaseRule');
            const numberRule = document.getElementById('numberRule');
            const specialRule = document.getElementById('specialRule');
            
            passwordInput.addEventListener('input', function() {
                const password = passwordInput.value;
                let strength = 0;
                
                // Reset rules
                lengthRule.className = '';
                uppercaseRule.className = '';
                numberRule.className = '';
                specialRule.className = '';
                
                // Check password length
                if (password.length >= 8) {
                    strength += 25;
                    lengthRule.className = 'valid';
                }
                
                // Check uppercase letters
                if (/[A-Z]/.test(password)) {
                    strength += 25;
                    uppercaseRule.className = 'valid';
                }
                
                // Check numbers
                if (/[0-9]/.test(password)) {
                    strength += 25;
                    numberRule.className = 'valid';
                }
                
                // Check special characters
                if (/[@$!%*?&]/.test(password)) {
                    strength += 25;
                    specialRule.className = 'valid';
                }
                
                // Update strength meter
                strengthMeter.style.width = strength + '%';
                
                // Update meter color
                if (strength < 50) {
                    strengthMeter.style.backgroundColor = '#e53e3e';
                } else if (strength < 75) {
                    strengthMeter.style.backgroundColor = '#dd6b20';
                } else {
                    strengthMeter.style.backgroundColor = '#38a169';
                }
            });
            
            // Confirm password validation
            const passwordConfirm = document.getElementById('password_confirmation');
            passwordConfirm.addEventListener('input', function() {
                if (passwordInput.value !== passwordConfirm.value) {
                    passwordConfirm.style.borderColor = '#e53e3e';
                } else {
                    passwordConfirm.style.borderColor = '#38a169';
                }
            });
        });
    </script>
</body>
</html>