<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auto-École Excellence - Votre partenaire pour la réussite</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .hero-section {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('images/driving-school.jpg') }}');
            background-size: cover;
            background-position: center;
            height: 600px;
        }
        .service-card:hover {
            transform: translateY(-10px);
            transition: transform 0.3s ease;
        }
    </style>
</head>
<body class="font-sans antialiased">
    <!-- Header -->
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Auto-École Excellence" class="h-16">
                    <span class="ml-3 text-2xl font-bold text-red-600">Auto-École Excellence</span>
                </div>
                <nav class="hidden md:flex space-x-8">
                    <a href="#" class="text-gray-800 hover:text-red-600 font-medium">Accueil</a>
                    <a href="#services" class="text-gray-800 hover:text-red-600 font-medium">Nos Services</a>
                    <a href="#testimonials" class="text-gray-800 hover:text-red-600 font-medium">Témoignages</a>
                    <a href="#contact" class="text-gray-800 hover:text-red-600 font-medium">Contact</a>
                    <a href="{{ route('login') }}" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">Connexion</a>
                </nav>
                <div class="md:hidden">
                    <button class="text-gray-800 focus:outline-none">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero-section flex items-center justify-center text-center text-white">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">Votre Réussite, Notre Priorité</h1>
            <p class="text-xl md:text-2xl mb-8">Formez-vous à la conduite avec des professionnels expérimentés</p>
            <div class="flex flex-col md:flex-row justify-center gap-4">
                <a href="#contact" class="bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-md text-lg transition duration-300">
                    Prendre Rendez-vous
                </a>
                <a href="#services" class="bg-white hover:bg-gray-100 text-red-600 font-bold py-3 px-6 rounded-md text-lg transition duration-300">
                    Découvrir nos Formations
                </a>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-16 bg-gray-100">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12">Nos Services</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Service 1 -->
                <div class="service-card bg-white rounded-lg shadow-lg p-6 transition duration-300">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-car text-red-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-center mb-3">Permis B</h3>
                    <p class="text-gray-600 text-center">Formation complète pour l'obtention du permis de conduire voiture avec des instructeurs qualifiés.</p>
                    <div class="mt-6 text-center">
                        <a href="#" class="text-red-600 hover:text-red-800 font-medium">En savoir plus <i class="fas fa-arrow-right ml-1"></i></a>
                    </div>
                </div>

                <!-- Service 2 -->
                <div class="service-card bg-white rounded-lg shadow-lg p-6 transition duration-300">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-motorcycle text-red-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-center mb-3">Permis A</h3>
                    <p class="text-gray-600 text-center">Formation pour l'obtention du permis moto avec des parcours adaptés et des instructeurs spécialisés.</p>
                    <div class="mt-6 text-center">
                        <a href="#" class="text-red-600 hover:text-red-800 font-medium">En savoir plus <i class="fas fa-arrow-right ml-1"></i></a>
                    </div>
                </div>

                <!-- Service 3 -->
                <div class="service-card bg-white rounded-lg shadow-lg p-6 transition duration-300">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-book text-red-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-center mb-3">Code de la Route</h3>
                    <p class="text-gray-600 text-center">Préparation à l'examen du code de la route avec des sessions intensives et des tests réguliers.</p>
                    <div class="mt-6 text-center">
                        <a href="#" class="text-red-600 hover:text-red-800 font-medium">En savoir plus <i class="fas fa-arrow-right ml-1"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-red-600 text-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-4xl font-bold mb-2">95%</div>
                    <div class="text-xl">Taux de Réussite</div>
                </div>
                <div>
                    <div class="text-4xl font-bold mb-2">5000+</div>
                    <div class="text-xl">Élèves Formés</div>
                </div>
                <div>
                    <div class="text-4xl font-bold mb-2">15+</div>
                    <div class="text-xl">Années d'Expérience</div>
                </div>
                <div>
                    <div class="text-4xl font-bold mb-2">20+</div>
                    <div class="text-xl">Instructeurs Qualifiés</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12">Ce que disent nos élèves</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-gray-300 rounded-full mr-4"></div>
                        <div>
                            <h4 class="font-bold">Sophie Martin</h4>
                            <div class="text-yellow-500">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">"Grâce à Auto-École Excellence, j'ai obtenu mon permis du premier coup ! Les instructeurs sont patients et pédagogues. Je recommande vivement !"</p>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-gray-300 rounded-full mr-4"></div>
                        <div>
                            <h4 class="font-bold">Thomas Dubois</h4>
                            <div class="text-yellow-500">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">"Une auto-école sérieuse avec des méthodes d'apprentissage efficaces. J'ai apprécié la flexibilité des horaires et la qualité de l'enseignement."</p>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-gray-300 rounded-full mr-4"></div>
                        <div>
                            <h4 class="font-bold">Léa Bernard</h4>
                            <div class="text-yellow-500">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">"J'étais très anxieuse à l'idée de conduire, mais les moniteurs ont su me mettre en confiance. Aujourd'hui, je conduis avec assurance. Merci !"</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-16 bg-gray-100">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12">Contactez-nous</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <form>
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 font-medium mb-2">Nom complet</label>
                            <input type="text" id="name" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-600">
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                            <input type="email" id="email" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-600">
                        </div>
                        <div class="mb-4">
                            <label for="phone" class="block text-gray-700 font-medium mb-2">Téléphone</label>
                            <input type="tel" id="phone" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-600">
                        </div>
                        <div class="mb-4">
                            <label for="message" class="block text-gray-700 font-medium mb-2">Message</label>
                            <textarea id="message" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-600"></textarea>
                        </div>
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-md transition duration-300">
                            Envoyer
                        </button>
                    </form>
                </div>
                <div>
                    <div class="bg-white rounded-lg shadow-lg p-6 h-full">
                        <h3 class="text-xl font-bold mb-4">Informations de contact</h3>
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <i class="fas fa-map-marker-alt text-red-600 mt-1 mr-3"></i>
                                <div>
                                    <h4 class="font-medium">Adresse</h4>
                                    <p class="text-gray-600">123 Avenue de la République, 75011 Paris</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-phone-alt text-red-600 mt-1 mr-3"></i>
                                <div>
                                    <h4 class="font-medium">Téléphone</h4>
                                    <p class="text-gray-600">+33 1 23 45 67 89</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-envelope text-red-600 mt-1 mr-3"></i>
                                <div>
                                    <h4 class="font-medium">Email</h4>
                                    <p class="text-gray-600">contact@auto-ecole-excellence.fr</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-clock text-red-600 mt-1 mr-3"></i>
                                <div>
                                    <h4 class="font-medium">Horaires d'ouverture</h4>
                                    <p class="text-gray-600">Lundi - Vendredi: 9h - 19h</p>
                                    <p class="text-gray-600">Samedi: 9h - 17h</p>
                                    <p class="text-gray-600">Dimanche: Fermé</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-6">
                            <h4 class="font-medium mb-2">Suivez-nous</h4>
                            <div class="flex space-x-4">
                                <a href="#" class="text-red-600 hover:text-red-800"><i class="fab fa-facebook-f text-xl"></i></a>
                                <a href="#" class="text-red-600 hover:text-red-800"><i class="fab fa-twitter text-xl"></i></a>
                                <a href="#" class="text-red-600 hover:text-red-800"><i class="fab fa-instagram text-xl"></i></a>
                                <a href="#" class="text-red-600 hover:text-red-800"><i class="fab fa-youtube text-xl"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">Auto-École Excellence</h3>
                    <p class="text-gray-400">Votre partenaire de confiance pour l'apprentissage de la conduite depuis plus de 15 ans.</p>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Liens Rapides</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">Accueil</a></li>
                        <li><a href="#services" class="text-gray-400 hover:text-white">Nos Services</a></li>
                        <li><a href="#testimonials" class="text-gray-400 hover:text-white">Témoignages</a></li>
                        <li><a href="#contact" class="text-gray-400 hover:text-white">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Nos Formations</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">Permis B</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Permis A</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Code de la Route</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Conduite Accompagnée</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Newsletter</h3>
                    <p class="text-gray-400 mb-4">Inscrivez-vous pour recevoir nos actualités et offres spéciales.</p>
                    <form>
                        <div class="flex">
                            <input type="email" placeholder="Votre email" class="px-4 py-2 w-full rounded-l-md focus:outline-none">
                            <button type="submit" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-r-md transition duration-300">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} Auto-École Excellence. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const menuButton = document.querySelector('.fas.fa-bars').parentElement;
            const mobileMenu = document.createElement('div');
            mobileMenu.className = 'mobile-menu hidden fixed inset-0 bg-white z-50 p-4';
            mobileMenu.innerHTML = `
                <div class="flex justify-between items-center mb-8">
                    <div class="flex items-center">
                        <img src="{{ asset('images/logo.png') }}" alt="Auto-École Excellence" class="h-12">
                        <span class="ml-3 text-xl font-bold text-red-600">Auto-École Excellence</span>
                    </div>
                    <button class="close-menu text-gray-800 focus:outline-none">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>
                <nav class="flex flex-col space-y-4">
                    <a href="#" class="text-gray-800 hover:text-red-600 font-medium text-lg py-2">Accueil</a>
                    <a href="#services" class="text-gray-800 hover:text-red-600 font-medium text-lg py-2">Nos Services</a>
                    <a href="#testimonials" class="text-gray-800 hover:text-red-600 font-medium text-lg py-2">Témoignages</a>
                    <a href="#contact" class="text-gray-800 hover:text-red-600 font-medium text-lg py-2">Contact</a>
                    <a href="{{ route('login') }}" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 text-center mt-4">Connexion</a>
                </nav>
            `;
            document.body.appendChild(mobileMenu);

            menuButton.addEventListener('click', function() {
                mobileMenu.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            });

            mobileMenu.querySelector('.close-menu').addEventListener('click', function() {
                mobileMenu.classList.add('hidden');
                document.body.style.overflow = '';
            });

            // Close mobile menu when clicking on links
            mobileMenu.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', function() {
                    mobileMenu.classList.add('hidden');
                    document.body.style.overflow = '';
                });
            });
        });
    </script>
</body>
</html>