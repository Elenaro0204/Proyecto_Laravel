<footer class="bg-gray-900 border-t border-gray-700">
    <div class="max-w-7xl mx-auto px-6 py-8 grid grid-cols-1 md:grid-cols-3 gap-8 text-gray-300">
        <!-- Logo y Descripción -->
        <div>
            <h2 class="text-xl font-semibold text-blue-400 mb-2">GoTogether</h2>
            <p class="text-sm leading-relaxed">
                Conectamos viajeros para compartir experiencias inolvidables.
                Planea, descubre y vive tu próximo viaje con nuestra comunidad.
            </p>
        </div>

        <!-- Navegación -->
        <div>
            <h3 class="text-lg font-semibold mb-3 text-blue-400">Navegación</h3>
            <ul class="space-y-2">
                <li><a href="{{ route('index') }}" class="hover:text-blue-600 transition">Inicio</a></li>

                @if(auth()->user() && !auth()->user()->isAdmin())
                    <li><a href="route('viajes.index')" class="hover:text-blue-600 transition">
                        Viajes
                        </a>
                    </li>
                @endif

                @if(auth()->user() && auth()->user()->isAdmin())
                    <li><a href="route('admin.viajes.index')"  class="hover:text-blue-600 transition">
                        Viajes
                        </a>
                    </li>
                @endif

                <li><a href="{{ route('destinos.index') }}" class="hover:text-blue-600 transition">Destinos</a></li>

                @if(auth()->user() && auth()->user()->isAdmin())
                    <li><ahref="route('admin.index')" class="hover:text-blue-600 transition">
                        Admin
                        </a>
                    </li>
                @endif

                <li><a href="{{ route('profile.index') }}" class="hover:text-blue-600 transition">Perfil</a></li>
            </ul>
        </div>

        <!-- Contacto o Redes sociales -->
        <div>
            <h3 class="text-lg font-semibold mb-3 text-blue-400">Contacto</h3>
            <p class="text-sm mb-2">Correo: soporte@gotogether.com</p>
            <p class="text-sm mb-4">Teléfono: +34 600 123 456</p>
            <div class="flex space-x-4">
                <a href="#" aria-label="Facebook" class="text-gray-400 hover:text-blue-600 transition">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" ><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54v-2.89h2.54v-2.205c0-2.507 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.464h-1.26c-1.243 0-1.63.772-1.63 1.562v1.874h2.773l-.443 2.89h-2.33v6.987C18.343 21.128 22 16.991 22 12z"/></svg>
                </a>
                <a href="#" aria-label="Twitter" class="text-gray-400 hover:text-blue-600 transition">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" ><path d="M23 3a10.9 10.9 0 0 1-3.14.86 4.48 4.48 0 0 0 1.98-2.48 9.14 9.14 0 0 1-2.88 1.1 4.52 4.52 0 0 0-7.72 4.13A12.81 12.81 0 0 1 1.64 2.16 4.51 4.51 0 0 0 3.09 9.7 4.48 4.48 0 0 1 .89 9v.06a4.52 4.52 0 0 0 3.62 4.43 4.51 4.51 0 0 1-2.04.08 4.53 4.53 0 0 0 4.22 3.14A9.06 9.06 0 0 1 0 19.54 12.76 12.76 0 0 0 6.92 21c8.3 0 12.84-6.88 12.84-12.84 0-.2 0-.42-.02-.62A9.22 9.22 0 0 0 23 3z"/></svg>
                </a>
                <a href="#" aria-label="Instagram" class="text-gray-400 hover:text-blue-600 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.5" y2="6.5"></line></svg>
                </a>
            </div>
        </div>
    </div>

    <div class="border-t border-gray-700 mt-8 py-4 text-center text-gray-500 text-xs">
        © {{ date('Y') }} GoTogether. Todos los derechos reservados.
    </div>
    </footer>
