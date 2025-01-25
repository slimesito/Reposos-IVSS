<!DOCTYPE html>
<html lang="en">
<head>
    <title>Regístrate</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{!! asset('assets/css/auth/registerstyles.css') !!}">
    {{-- FONTSAWESOME --}}
    <link href="assets/fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="assets/fontawesome/css/brands.css" rel="stylesheet">
    <link href="assets/fontawesome/css/solid.css" rel="stylesheet">
</head>
<body>

    <nav class="navbar navbar-expand-lg bg-dark border-bottom border-bottom-dark ticky-top bg-body-tertiary" >
        <div class="logo">
            <a href=""><img src="assets/membrete2.jpg" width="1900" height="100" alt=""></a>
        </div>  
    </nav>

    <section>    
        
        <div class="container-fluid page-body-wrapper" align="center">

            @include('auth.alerts.success-message')
            
            @include('auth.alerts.error-message')

            <br>
        
            <div class="form-box">
                <div class="form value">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <h2>Regístrate</h2>

                        <div class="inputbox">
                            <ion-icon name="person-outline"></ion-icon>
                            <input id="user_name" type="text" name="nombres" required>
                            <label for="user_name">Nombres</label>
                        </div>

                        <div class="inputbox">
                            <ion-icon name="person-outline"></ion-icon>
                            <input id="user_name" type="text" name="apellidos" required>
                            <label for="user_name">Apellidos</label>
                        </div>

                        <div class="inputbox">
                            <ion-icon name="person-outline"></ion-icon>
                            <input id="user_name" type="text" name="cedula" required>
                            <label for="user_name">Cédula</label>
                        </div>

                        <div class="inputbox">
                            <ion-icon name="person-outline"></ion-icon>
                            <input id="user_name" type="text" name="email" required>
                            <label for="user_name">Email</label>
                        </div>

                        <div class="inputbox">
                            <ion-icon name="person-outline"></ion-icon>
                            <input id="last_name" type="text" name="nro_mpps" required>
                            <label for="last_name">Número MPPS:</label>
                        </div>

                        <div class="inputbox">
                            <ion-icon name="person-outline"></ion-icon>
                            <select name="cod_cargo" placeholder="Seleccionar Tipo de Cargo">
                                <option disabled hidden selected>Seleccione Tipo de Cargo</option>
                                <option value="1">Analista</option>
                                <option value="2">Comisión</option>
                                <option value="3">Director</option>
                                <option value="4">Master</option>
                                <option value="5">Médico Especialista</option>
                                <option value="6">Médico General</option>
                                <option value="7">Suplente Especialista</option>
                                <option value="8">Suplente General</option>
                              </select>
                            <label for="last_name">Cargo:</label>
                        </div>

                        <div class="inputbox">
                            <ion-icon name="person-outline"></ion-icon>
                            <input id="last_name" type="text" name="telefono" required>
                            <label for="last_name">Teléfono:</label>
                        </div>

                        <div class="inputbox">
                            <ion-icon name="person-outline"></ion-icon>
                            <input id="last_name" type="text" name="telefono_oficina" required>
                            <label for="last_name">Teléfono Oficina:</label>
                        </div>

                        {{-- <div class="inputbox">
                            <ion-icon name="person-outline"></ion-icon>
                            <input id="last_name" type="text" name="PREGUNTA_SECRETA1" :value="{{ old('PREGUNTA_SECRETA1') }}" required>
                            <label for="last_name">Pregunta Secreta:</label>
                        </div>

                        <div class="inputbox">
                            <ion-icon name="person-outline"></ion-icon>
                            <input id="last_name" type="text" name="RESPUESTA_SECRETA1" :value="{{ old('RESPUESTA_SECRETA1') }}" required>
                            <label for="last_name">Respuesta Secreta 1:</label>
                        </div>

                        <div class="inputbox">
                            <ion-icon name="person-outline"></ion-icon>
                            <input id="last_name" type="text" name="PREGUNTA_SECRETA2" :value="{{ old('PREGUNTA_SECRETA2') }}" required>
                            <label for="last_name">Pregunta Secreta 2:</label>
                        </div>

                        <div class="inputbox">
                            <ion-icon name="person-outline"></ion-icon>
                            <input id="last_name" type="text" name="RESPUESTA_SECRETA2" :value="{{ old('RESPUESTA_SECRETA2') }}" required>
                            <label for="last_name">Respuesta Secreta 2:</label>
                        </div>

                        <div class="inputbox">
                            <ion-icon name="person-outline"></ion-icon>
                            <input id="last_name" type="text" name="PREGUNTA_SECRETA3" :value="{{ old('PREGUNTA_SECRETA3') }}" required>
                            <label for="last_name">Pregunta Secreta 3:</label>
                        </div>

                        <div class="inputbox">
                            <ion-icon name="person-outline"></ion-icon>
                            <input id="last_name" type="text" name="RESPUESTA_SECRETA3" :value="{{ old('RESPUESTA_SECRETA3') }}" required>
                            <label for="last_name">Respuesta Secreta 3:</label>
                        </div> --}}

                        <button>Regístrate</button>

                        {{-- <div class="login">
                            <p>Ya tienes una cuenta? <a href="{{route('showLoginForm')}}">Inicia Sesión</a></p>
                        </div> --}}
                    
                    </form>
                </div>
            </div>

        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>