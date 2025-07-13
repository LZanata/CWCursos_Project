<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['tipo'] !== 'professor') {
  header('Location: ../../cadastro_login/professor/forms.php');
  exit();
}