<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    @if (auth()->user()->comunidades())
        {{-- selector de comunidades --}}
        <div class="dropdown">
            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                {{-- TO DO: incono de cambiar comunidad --}}
                <i class="fas fa-search fa-sm"></i>
                <div class="d-none d-md-inline">
                    {{ auth()->user()->comunidades()->where('id', session('comunidad_id'))->first()->razon_social ?? 'Seleccionar comunidad' }}
                </div>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                @foreach (auth()->user()->comunidades() as $comunidad)
                    <a class="dropdown-item"
                        href="{{ route('comunidades.seleccionar', ['comunidad_id' => $comunidad->id]) }}">
                        {{ $comunidad->razon_social }}
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">


        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter contador">1+</span>
            </a>
            {{-- TO DO: ocupar esto para alertas reales  --}}

            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    Alertas sin chequeo
                </h6>
                <div id="container-alertas">

                </div>
                {{-- <a class="dropdown-item d-flex align-items-center alertas" href="#">
                    <div class="mr-3">
                        <div class="icon-circle bg-warning">
                            <i class="fas fa-exclamation-triangle text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">December 2, 2019</div>
                        Spending Alert: We've noticed unusually high spending for your account.
                    </div>
                </a> --}}
                {{-- <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a> --}}
            </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->nombre }}
                    {{ auth()->user()->apellido_paterno }}</span>
                <img class="img-profile rounded-circle" src="/img/undraw_profile.svg">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                {{-- TO DO: agregar pagina de perfil ? --}}
                <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Perfil
                </a>

                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Cerrar sesión
                </a>
            </div>
        </li>

    </ul>

</nav>
<!-- End of Topbar -->

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    ¿Estás seguro que deseas cerrar sesión?
                </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">Selecciona "Cerrar sesión" si estás listo para terminar tu sesión actual.</div>

            {{-- fin español --}}
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-primary" href="/logout">Cerrar sesión</a>
            </div>
        </div>
    </div>
</div>

<script>
    // Your web app's Firebase configuration
    const firebaseConfig = {
        apiKey: "AIzaSyAMVS3wzQL30I9DyGV85IC9CDfVDsM6ah0",
        authDomain: "proyecto4-ac1de.firebaseapp.com",
        projectId: "proyecto4-ac1de",
        storageBucket: "proyecto4-ac1de.appspot.com",
        messagingSenderId: "54211334008",
        appId: "1:54211334008:web:68c232361068a07148028d"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);

    const messaging = firebase.messaging();

    function initFirebaseMessagingRegistration() {
        messaging.requestPermission().then(function() {
            return messaging.getToken()
        }).then(function(token) {

            axios.post("{{ route('fcmToken') }}", {
                _method: "PATCH",
                token
            }).then(({
                data
            }) => {
                console.log(data)
            }).catch(({
                response: {
                    data
                }
            }) => {
                console.error(data)
            })

        }).catch(function(err) {
            console.log(`Token Error :: ${err}`);
        });
    }
    initFirebaseMessagingRegistration();

    function updateAlarmas() {
        var token = messaging.getToken();
        axios.post("{{ route('getAlarmas') }}", {
            _method: "POST",
            token
        }).then(({
            data
        }) => {
            var containerAlertas = document.getElementById('container-alertas');
            while (containerAlertas.firstChild) {
                containerAlertas.removeChild(containerAlertas.firstChild);
            }
            var contador = data.length;
            data.forEach(alarma => {
                var nuevoElemento = document.createElement('a');
                nuevoElemento.className = 'dropdown-item d-flex align-items-center alertas';
                nuevoElemento.href = 'red-avisos';
                nuevoElemento.innerHTML = `
                    <div class="mr-3">
                        <div class="icon-circle bg-warning">
                            <i class="fas fa-exclamation-triangle text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">${alarma.fecha}  ${alarma.hora}</div>
                        Alerta de usuario ${alarma.nombre_usuario}
                    </div>
                `;
                containerAlertas.appendChild(nuevoElemento);
            });
            var contadorElement = document.querySelector('.contador');
            contadorElement.textContent = `${contador}+`;

            console.log(data)
        }).catch(({
            response: {
                data
            }
        }) => {
            console.error(data)
        })
    }

    messaging.onMessage(function(message) {
        updateAlarmas();

        const {
            notification,
            data
        } = message;

        // Extract data from the message
        const title = notification.title;
        const body = notification.body;
        const logo = data.logo;
        const userAddress = data.direccion;
        const latitude = data.latitud;
        const longitude = data.longitud;

        // Create a notification
        const notificationOptions = {
            body: body,
            icon: logo, // Set the logo as the notification icon
            image: data.image, // Set an image in the notification
        };
        // Additional information to display
        const additionalInfo = `Dirección: ${userAddress}\nCoordenadas: ${latitude}, ${longitude}`;

        // Combine body and additional information
        notificationOptions.body = `${body}\n${additionalInfo}`;

        const redirectTo = '/monitoreo';

        const not = new Notification(title, notificationOptions);
        not.onclick = function() {
            // Redirigir a la ruta deseada
            window.location.href = redirectTo;
        };
    });
    updateAlarmas();
</script>
