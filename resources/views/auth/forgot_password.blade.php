@extends('auth.layout.layout')

@section('title', 'Recuperar Contraseña')

@section('content')

    <div class="form-box">
        <div class="form value">
            <form method="POST" action="{{ route('validar.email') }}">

                @csrf

                <h2>Reposos | IVSS</h2>

                <div class="inputbox">
                    <ion-icon name="person-outline"></ion-icon>
                    <input id="user_name" type="text" name="email" value="{{ old('email') }}" required autofocus>
                    <label for="user_name">Correo Electrónico:</label>
                </div>

                <button type="submit">Enviar</button>
                
            </form>
        </div>
    </div>

@endsection