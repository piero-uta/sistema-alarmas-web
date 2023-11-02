<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- CSRF --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sistema de alarma comunitaria - @yield('title')</title>


    <!-- Custom fonts for this template-->
    <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    {{-- TO DO: descargar esto  --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />


    <!-- Custom styles for this template-->
    <link href="/css/sb-admin-2.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js"></script>

    <!-- TODO: Add SDKs for Firebase products that you want to use
    https://firebase.google.com/docs/web/setup#available-libraries -->



    {{-- Scripts --}}
    @stack('head-scripts')
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        @if (session('comunidad_id'))
            @include('includes.navbar')
        @endif
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                @include('includes.topbar')
                @if (session('comunidad_id'))
                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                    <!-- /.container-fluid -->
                @else
                    <div class="container-fluid">
                        <h2>Debe seleccionar una comunidad</h2>
                    </div>
                @endif

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            {{-- @include('includes.footer') --}}
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->


    {{-- del esteban --}}
    <!-- Header -->
    {{-- @include('includes.header')
    @include('includes.menu-hamburguesa')     --}}

    {{-- @yield('body')
    <div class="container py-5">
        @yield('content')


        </div>
    </div>
    <script src="{{ asset('js/buttons.js') }}"></script>

    @include('includes.footer')  --}}

    <!-- Bootstrap core JavaScript-->
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="/js/demo/chart-area-demo.js"></script>
    <script src="/js/demo/chart-pie-demo.js"></script>

    {{-- TO DO: descargar esto  --}}

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>



    @yield('scripts')
    @stack('scripts')
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


        messaging.onMessage(function(message) {
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
    </script>

</body>

</html>
