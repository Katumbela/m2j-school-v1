<!doctype html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>M2j Technologies - Gestão Escolar</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <!-- Styles -->
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
            }

            .hero-section {
                background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
                color: white;
                padding: 100px 0;
                position: relative;
                overflow: hidden;
            }

            .hero-content {
                position: relative;
                z-index: 2;
            }

            .hero-title {
                font-size: 3.5rem;
                font-weight: 700;
                margin-bottom: 1.5rem;
            }

            .hero-subtitle {
                font-size: 1.25rem;
                margin-bottom: 2rem;
                opacity: 0.9;
            }

            .feature-card {
                padding: 2rem;
                border-radius: 10px;
                background: white;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                transition: transform 0.3s ease;
            }

            .feature-card:hover {
                transform: translateY(-5px);
            }

            .feature-icon {
                font-size: 2.5rem;
                color: var(--primary-color);
                margin-bottom: 1rem;
            }

            .cta-button {
                padding: 12px 30px;
                border-radius: 50px;
                font-weight: 600;
                transition: all 0.3s ease;
            }

            .cta-button-primary {
                background-color: white;
                color: var(--primary-color);
            }

            .cta-button-primary:hover {
                background-color: var(--light-bg);
                transform: translateY(-2px);
            }

            .navbar {
                background-color: transparent;
                padding: 1rem 0;
                transition: background-color 0.3s ease;
            }

            .navbar.scrolled {
                background-color: white;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            .navbar-brand {
                font-weight: 700;
                font-size: 1.5rem;
                color: white;
            }

            .navbar.scrolled .navbar-brand {
                color: var(--primary-color);
            }

            .nav-link {
                color: white;
                font-weight: 500;
                margin: 0 1rem;
            }

            .navbar.scrolled .nav-link {
                color: var(--text-color);
            }

            @media (max-width: 768px) {
                .hero-title {
                    font-size: 2.5rem;
                }
                
                .hero-section {
                    padding: 60px 0;
                }
            }
        </style>
    </head>
    <body>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#">M2j Technologies</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#inicio">Início</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#recursos">Recursos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#sobre">Sobre</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contato">Contato</a>
                        </li>
                        @if (Route::has('login'))
                            @auth
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/home') }}">Área do Usuário</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                                </li>
                            @endauth
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="hero-section" id="inicio">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 hero-content">
                        <h1 class="hero-title">Transforme sua Gestão Escolar</h1>
                        <p class="hero-subtitle">Sistema completo para gerenciamento de escolas, com recursos avançados para administração, professores e alunos.</p>
                        <a href="#contato" class="btn cta-button cta-button-primary">Comece Agora</a>
                    </div>
                    <div class="col-lg-6">
                        <!-- <img src="https://m2jtecnologia.ao/wp-content/uploads/2024/10/logo@2x.png" alt="Gestão Escolar" class="img-fluid rounded-3"> -->
                        <img src="https://ispsml.ao/_next/static/media/logo_p_white.72464d69.png" alt="Gestão Escolar" class="img-fluid rounded-3">
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="py-5" id="recursos">
            <div class="container">
                <h2 class="text-center mb-5">Nossos Recursos</h2>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="feature-card">
                            <i class="fas fa-user-graduate feature-icon"></i>
                            <h3>Gestão de Alunos</h3>
                            <p>Controle completo de matrículas, notas e frequência dos alunos.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="feature-card">
                            <i class="fas fa-chalkboard-teacher feature-icon"></i>
                            <h3>Portal do Professor</h3>
                            <p>Ferramentas para planejamento de aulas e avaliações.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="feature-card">
                            <i class="fas fa-chart-line feature-icon"></i>
                            <h3>Relatórios</h3>
                            <p>Análises detalhadas e relatórios personalizados.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section class="py-5 bg-light" id="contato">
            <div class="container">
                <h2 class="text-center mb-5">Entre em Contato</h2>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <form class="bg-white p-4 rounded-3 shadow-sm">
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Nome">
                            </div>
                            <div class="mb-3">
                                <input type="email" class="form-control" placeholder="Email">
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" rows="4" placeholder="Mensagem"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Enviar Mensagem</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-dark text-white py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h5>M2j Technologies</h5>
                        <p>Soluções inovadoras para gestão escolar</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <p>&copy; 2024 M2j Technologies. Todos os direitos reservados.</p>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Custom JS -->
        <script>
            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    document.querySelector('.navbar').classList.add('scrolled');
                } else {
                    document.querySelector('.navbar').classList.remove('scrolled');
                }
            });
        </script>
    </body>
</html>
