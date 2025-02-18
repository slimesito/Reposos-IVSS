<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\CapitulosController;
use App\Http\Controllers\Admin\CentrosAsistencialesController;
use App\Http\Controllers\Admin\PatologiasEspecificasController;
use App\Http\Controllers\Admin\PatologiasGeneralesController;
use App\Http\Controllers\Admin\ServiciosController;
use App\Http\Controllers\Admin\UsuariosController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Expediente\ExpedienteController;
use App\Http\Controllers\Reposos\GestionController;
use App\Http\Controllers\Reposos\ProrrogasController;
use App\Http\Controllers\Reposos\RepososEnfermedadController;
use App\Http\Controllers\Reposos\RepososMaternidadController;
// use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Users\UserProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('login', [AuthController::class, 'showLoginForm'])->name('showLoginForm');
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::get('/error404', function () {
    return view('layout.alerts.error404');
})->name('error404')->middleware('restrict.error404');

Route::middleware(['auth', 'restrict.error404'])->group(function () {
    
    // Route::get('/inicio', function () {
    //     return view('dashboard')->name('inicio');
    // });

    Route::get('/inicio', [DashboardController::class, 'index'])->name('inicio');

    Route::post('/logout', function () {
        Auth::logout();
    
        return redirect('/');
    })->name('logout');

    // REPOSOS

    Route::get('validar_cedula_reposo_enfermedad', [RepososEnfermedadController::class, 'validarCedulaReposoEnfermedadView'])->name('validar.cedula.reposo.view');
    Route::post('search_cedula_reposo_enfermedad', [RepososEnfermedadController::class, 'validarCedulaReposoEnfermedad'])->name('validar.cedula.reposo');

    Route::get('nuevo_reposo_enfermedad', [RepososEnfermedadController::class, 'nuevoReposoEnfermedadView'])->name('nuevo.reposo.enfermedad.view');
    Route::get('/getPatologiasGenerales/{id}', [RepososEnfermedadController::class, 'getPatologiasGenerales']);
    Route::post('crear_reposo_enfermedad', [RepososEnfermedadController::class, 'createReposoEnfermedad'])->name('create.reposo.enfermedad');

    Route::get('validar_cedula_reposo_maternindad', [RepososMaternidadController::class, 'validarCedulaReposoMaternidadView'])->name('validar.cedula.reposo.maternindad.view');
    Route::post('search_cedula_reposo_maternindad', [RepososMaternidadController::class, 'validarCedulaReposoMaternidad'])->name('validar.cedula.reposo.maternidad');

    Route::get('nuevo_reposo_maternidad', [RepososMaternidadController::class, 'nuevoReposoMaternidadView'])->name('nuevo.reposo.maternidad.view');
    Route::post('crear_reposo_maternidad', [RepososMaternidadController::class, 'createReposoMaternidad'])->name('create.reposo.maternidad');

    Route::get('/reposo-enfermedad/download-pdf/{id}', [RepososEnfermedadController::class, 'downloadPDF'])->name('reposo.enfermedad.downloadPDF');

    // GESTION REPOSOS

    Route::get('gestion_reposos', [GestionController::class, 'gestionRepososView'])->name('gestion.reposos.view');
    Route::get('/buscar_reposos_pendientes', [GestionController::class, 'buscadorRepososPendientes'])->name('buscador.reposos.pendientes');

    Route::patch('/reposos/{id}/aprobar', [GestionController::class, 'aprobarReposo'])->name('aprobar.reposo');
    Route::patch('/reposos/{id}/rechazar', [GestionController::class, 'rechazarReposo'])->name('rechazar.reposo');

    // PRÓRROGAS

    Route::get('validar_cedula_prorroga', [ProrrogasController::class, 'validarCedulaProrrogaView'])->name('validar.cedula.prorroga.view');
    Route::post('search_cedula_prorroga', [ProrrogasController::class, 'validarCedulaProrroga'])->name('validar.cedula.prorroga');

    Route::get('nueva_prorroga', [ProrrogasController::class, 'nuevaProrrogaView'])->name('nueva.prorroga.view');
    Route::get('/getPatologiasGenerales/{capituloId}', [ProrrogasController::class, 'getPatologiasGenerales']);
    Route::get('/getPatologiasEspecificasPorCapitulo/{capituloId}', [ProrrogasController::class, 'getPatologiasEspecificasPorCapitulo']);
    Route::post('crear_prorroga', [ProrrogasController::class, 'createProrroga'])->name('create.prorroga');

    // EXPEDIENTES PACIENTES

    Route::get('expediente_pacientes', [ExpedienteController::class, 'showPacientes'])->name('expediente.pacientes.view');
    Route::get('/buscar_pacientes', [ExpedienteController::class, 'buscadorPacientes'])->name('buscador.pacientes');

    // REPOSOS REGISTRADOS

    Route::get('reposos_registrados', [ExpedienteController::class, 'showReposos'])->name('reposos.registrados.view');
    Route::get('/buscar_reposos', [ExpedienteController::class, 'buscadorReposos'])->name('buscador.reposos');

    Route::get('/reposos_registrados/descargar/{id}', [ExpedienteController::class, 'descargarReposoPDF'])->name('descargar.reposo.pdf');

    // Route::get('/verificar-archivo', function () {
    //     $filePath = storage_path('app/public/app/assets/certificados/F-14-73_ENFERMEDAD_123.pdf'); // Cambia el nombre del archivo según corresponda
    
    //     if (file_exists($filePath)) {
    //         return "El archivo existe.";
    //     } else {
    //         return "El archivo no se encontró.";
    //     }
    // });
    

    // PRÓRROGAS REGISTRADAS
    
    Route::get('prorrogas_registradas', [ExpedienteController::class, 'showProrrogas'])->name('prorrogas.registradas.view');
    Route::get('/buscar_prorrogas', [ExpedienteController::class, 'buscadorProrrogas'])->name('buscador.prorrogas');

    Route::get('/prorrogas_registradas/descargar/{id}', [ExpedienteController::class, 'descargarProrrogaPDF'])->name('descargar.prorroga.pdf');
});

// Route::get('validar_email', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('validar.email.view');
// Route::post('validar_email', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('validar.email.view');

// Route::get('password/security', [ForgotPasswordController::class, 'showSecurityQuestionForm'])->name('password.security');
// Route::post('password/security', [ForgotPasswordController::class, 'showSecurityQuestionForm']);
// Route::post('password/security/verify', [ForgotPasswordController::class, 'verifySecurityAnswers'])->name('password.security.verify');
// Route::post('password/update', [ForgotPasswordController::class, 'updatePassword'])->name('password.update');

Route::middleware(['auth', 'check.user.profile'])->group(function () {
    Route::get('/configuracion/{id}', [UserProfileController::class, 'showProfileSettings'])->name('configuracion.perfil.view');
    Route::post('/configuracion/{id}', [UserProfileController::class, 'profileSettingsUpdate'])->name('configuracion.perfil.update');
});

Route::middleware(['auth', 'admin'])->group(function () {

    // Registro y edición de Usuarios
    Route::get('gestion_usuarios', [UsuariosController::class, 'gestionUsuariosView'])->name('gestion.usuarios.view');

    Route::get('/buscar_usuarios', [UsuariosController::class, 'buscadorUsuarios'])->name('buscador.usuarios');

    Route::get('registro_usuarios', [UsuariosController::class, 'registroUsuariosView'])->name('registro.usuarios.view');
    Route::post('register', [UsuariosController::class, 'registerUsuarios'])->name('registrar.usuario');

    Route::get('/usuarios/{id}/editar', [UsuariosController::class, 'editarUsuariosView'])->name('editar.usuarios.view');
    Route::put('/usuarios/{id}', [UsuariosController::class, 'updateUsuarios'])->name('usuarios.update');

    Route::delete('/usuarios/{id}', [UsuariosController::class, 'destroyUsuarios'])->name('usuarios.destroy');

    // Registro y edición de Capítulos
    Route::get('gestion_capitulos', [CapitulosController::class, 'gestionCapitulosView'])->name('gestion.capitulos.view');

    Route::get('/buscar_capitulos', [CapitulosController::class, 'buscadorCapitulos'])->name('buscador.capitulos');

    Route::get('registro_capitulos', [CapitulosController::class, 'createCapitulosView'])->name('registro.capitulos.view');
    Route::post('registrar_usuario', [CapitulosController::class, 'createCapitulos'])->name('registrar.capitulo');

    Route::get('/capitulos/{id}/editar', [CapitulosController::class, 'editarCapitulosView'])->name('editar.capitulos.view');
    Route::put('/capitulos/{id}', [CapitulosController::class, 'updateCapitulos'])->name('update.capitulos');

    Route::delete('/capitulos/{id}', [CapitulosController::class, 'destroyCapitulos'])->name('destroy.capitulos');

    // Registro y edición de Patologías Generales
    Route::get('gestion_patologias_generales', [PatologiasGeneralesController::class, 'gestionPatologiasGeneralesView'])->name('gestion.patologia-general.view');

    Route::get('/buscar_patologias_generales', [PatologiasGeneralesController::class, 'buscadorPatologiasGenerales'])->name('buscador.patologia-general');

    Route::get('registro_patologia_general', [PatologiasGeneralesController::class, 'createPatologiasGeneralesView'])->name('registrar.patologia-general.view');
    Route::post('registrar_patologia_general', [PatologiasGeneralesController::class, 'createPatologiasGenerales'])->name('registrar.patologia-general');

    Route::get('/patologias_generales/{id}/editar', [PatologiasGeneralesController::class, 'editarPatologiasGeneralesView'])->name('editar.patologia-general.view');
    Route::put('/patologias_generales/{id}', [PatologiasGeneralesController::class, 'updatePatologiasGenerales'])->name('update.patologia-general');

    Route::delete('/patologia_general/{id}', [PatologiasGeneralesController::class, 'destroyPatologiasGenerales'])->name('destroy.patologia-general');

    // Registro y edición de Patologías Específicas
    Route::get('gestion_patologias_especificas', [PatologiasEspecificasController::class, 'gestionPatologiasEspecificasView'])->name('gestion.patologia-especifica.view');

    Route::get('/buscar_patologias_especificas', [PatologiasEspecificasController::class, 'buscadorPatologiasEspecificas'])->name('buscador.patologia-especifica');

    Route::get('registro_patologia_especifica', [PatologiasEspecificasController::class, 'createPatologiasEspecificasView'])->name('registrar.patologia-especifica.view');
    Route::get('/getPatologiasGenerales/{capituloId}', [PatologiasEspecificasController::class, 'getPatologiasGenerales']);
    Route::post('registrar_patologia_especifica', [PatologiasEspecificasController::class, 'createPatologiasEspecificas'])->name('registrar.patologia-especifica');

    Route::get('/patologias_especificas/{id}/editar', [PatologiasEspecificasController::class, 'editarPatologiasEspecificasView'])->name('editar.patologia-especifica.view');
    Route::put('/patologias_especificas/{id}', [PatologiasEspecificasController::class, 'updatePatologiasEspecificas'])->name('update.patologia-especifica');

    Route::delete('/patologia_especifica/{id}', [PatologiasEspecificasController::class, 'destroyPatologiasEspecificas'])->name('destroy.patologia-especifica');

    // Registro y edición de Centros Asistenciales
    Route::get('gestion_centros_asistenciales', [CentrosAsistencialesController::class, 'gestionCentroAsistencialView'])->name('gestion.centro-asistencial.view');

    Route::get('/buscar_centros_asistenciales', [CentrosAsistencialesController::class, 'buscadorCentroAsistencial'])->name('buscador.centro-asistencial');

    Route::get('registro_centro_asistencial', [CentrosAsistencialesController::class, 'createCentroAsistencialView'])->name('registrar.centro-asistencial.view');
    Route::post('registrar_centro_asistencial', [CentrosAsistencialesController::class, 'createCentroAsistencial'])->name('registrar.centro-asistencial');

    Route::get('/centros_asistenciales/{id}/editar', [CentrosAsistencialesController::class, 'editarCentroAsistencialView'])->name('editar.centro-asistencial.view');
    Route::put('/centros_asistenciales/{id}', [CentrosAsistencialesController::class, 'updateCentroAsistencial'])->name('update.centro-asistencial');

    Route::delete('/centro_asistencial/{id}', [CentrosAsistencialesController::class, 'destroyCentroAsistencial'])->name('destroy.centro-asistencial');

    // Registro y edición de Servicios
    Route::get('gestion_servicios', [ServiciosController::class, 'gestionServiciosView'])->name('gestion.servicios.view');

    Route::get('/buscar_servicios', [ServiciosController::class, 'buscadorServicios'])->name('buscador.servicios');

    Route::get('registro_servicio', [ServiciosController::class, 'createServicioView'])->name('registrar.servicio.view');
    Route::post('registrar_servicio', [ServiciosController::class, 'createServicio'])->name('create.servicio');

    Route::get('/servicios/{id}/editar', [ServiciosController::class, 'editarServicioView'])->name('editar.servicio.view');
    Route::put('/servicios/{id}', [ServiciosController::class, 'updateServicio'])->name('update.servicio');

    Route::delete('/servicio/{id}', [ServiciosController::class, 'destroyServicio'])->name('destroy.servicio');

    // EXPEDIENTES PACIENTES

    Route::get('expediente_pacientes', [ExpedienteController::class, 'showPacientes'])->name('expediente.pacientes.view');
    Route::get('/buscar_pacientes', [ExpedienteController::class, 'buscadorPacientes'])->name('buscador.pacientes');
});