@extends('layouts.app')

@section('title', 'Entrar')

@section('content')
<div class="login-container">
    <div class="login-card">
        <div class="card shadow-lg border-0 rounded-lg">
            <div style="margin-top: 2rem;" class="card- py-4">
                <div class="text-center">
                    <img src="https://m2jtecnologia.ao/wp-content/uploads/2024/10/logo@2x.png" alt="Logo" class="mb-3" style="max-width: 190px;">
                    <h3 class="text-black mb-0">Bem-vindo de volta</h3>
                    <p class="text-white-50 mb-0">Por favor, faça login na sua conta</p>
                </div>
            </div>

            <div class="card-body p-4">
                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                </div>
                @endif

                <form style="margin-top: 2rem; width: 30%; margin-left: 35%;" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="form-floating mb-3">
                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autofocus placeholder="Email ou Telefone">
                        <label for="email">Email ou Número de Telefone</label>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required placeholder="Senha">
                        <label for="password">Senha</label>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">Lembrar-me</label>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" style="width: 100%;" class="btn w-full btn-primary btn-sm cta-button">
                            <i class="fas fa-sign-in-alt me-2"></i>Entrar
                        </button>
                    </div>
                </form>

                <div class="text-center mt-3">
                    <a href="{{ route('password.request') }}" class="text-decoration-none text-primary">
                        Esqueceu sua senha?
                    </a>
                </div>

                <div class="text-center mt-4">
                    <p class="text-muted">Ou entre com</p>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="#" class="btn btn-outline-primary social-btn">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="btn btn-outline-primary social-btn">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="btn btn-outline-primary social-btn">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- <div class="card-footer text-center py-3 bg-light">
                <div class="small">
                    Não tem uma conta?
                    <a href="{{ route('register') }}" class="text-decoration-none text-primary">Registre-se agora!</a>
                </div>
            </div> -->
        </div>
    </div>
</div>

@push('styles')
<style>
    :root {
        --primary-color: #2563eb;
        --secondary-color: #1e40af;
        --accent-color: #3b82f6;
        --text-color: #1f2937;
        --light-bg: #f3f4f6;
    }

    body {
        font-family: 'Poppins', sans-serif;
        color: var(--text-color);
        line-height: 1.6;
        background-color: var(--light-bg);
        margin: 0;
        padding: 0;
        min-height: 100vh;
    }

    .login-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 20px;
    }

    .login-card {
        width: 100%;
        max-width: 450px;
    }

    .card {
        border: none;
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .form-floating>.form-control:focus~label,
    .form-floating>.form-control:not(:placeholder-shown)~label {
        color: var(--primary-color);
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(37, 99, 235, 0.25);
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        border: none;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .social-btn {
        width: 40px;
        height: 40px;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: all 0.3s ease;
    }

    .social-btn:hover {
        background-color: var(--primary-color);
        color: white;
        transform: translateY(-2px);
    }

    .form-check-input:checked {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }
</style>
@endpush
@endsection