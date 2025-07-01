<?php
// Caminho padrão da foto de perfil (relativo à raiz do projeto no servidor)
define('DEFAULT_PROFILE_PHOTO', '/CWCursos_Project/funcoes/uploads/profile/default_profile.jpg');

// Caminhos para upload de fotos de perfil
define('PROFILE_UPLOAD_DIR', $_SERVER['DOCUMENT_ROOT'] . '/CWCursos_Project/funcoes/uploads/profile/');
define('PROFILE_UPLOAD_PATH', '/CWCursos_Project/funcoes/uploads/profile/');

// Caminhos para upload de currículos
define('CURRICULO_UPLOAD_DIR', $_SERVER['DOCUMENT_ROOT'] . '/CWCursos_Project/administrador/usuarios/professor/uploads/curriculos/');
define('CURRICULO_UPLOAD_PATH', '/CWCursos_Project/administrador/usuarios/professor/uploads/curriculos/');

// URL base do projeto (ajuste conforme necessário)
define('BASE_URL', 'http://localhost:8080/CWCursos_Project/');