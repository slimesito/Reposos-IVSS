@extends('auth.layout.layout')

@section('title', 'Iniciar Sesión')

@section('content')

    <div class="form-box">
        <div class="form value">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <h2>Reposos | IVSS</h2>

                <div class="inputbox">
                    <ion-icon name="person-outline"></ion-icon>
                    <input id="user_name" type="text" name="email" value="{{ old('email') }}" required autofocus>
                    <label for="user_name">Correo Electrónico:</label>
                </div>

                <div class="inputbox">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input id="password" type="password" name="password" required>
                    <label for="password">Contraseña</label>
                </div>

                <button type="submit">Inicia Sesión</button>

                {{-- <div class="forgotpass">
                    <p>Olvidaste tu contraseña? <a href="{{route('validar.email.view')}}">Haz click aquí</a></p> 
                </div> --}}
                
            </form>
        </div>
    </div>

@endsection