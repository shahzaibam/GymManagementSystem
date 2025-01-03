@extends('layouts.app')  <!-- Extiende el layout principal -->

@section('content')
    <!-- Contenedor principal de la página -->
    <div class="container">

        <!-- Sección para actualizar la información del perfil -->
        <div class="mt-4 p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                <!-- Incluye el formulario para actualizar la información del perfil -->
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <!-- Sección para actualizar la contraseña -->
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg mt-6">
            <div class="max-w-xl">
                <!-- Incluye el formulario para actualizar la contraseña -->
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <!-- Sección para eliminar el usuario -->
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg mt-6">
            <div class="max-w-xl">
                <!-- Incluye el formulario para eliminar el usuario -->
                @include('profile.partials.delete-user-form')
            </div>
        </div>

    </div>
@endsection
