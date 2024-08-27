<?php
session_start();
include 'includes/config.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Consulta para obter informações do perfil do usuário
$sql_profile = "SELECT username, profile_picture, is_verified FROM users WHERE id = ?";
$stmt_profile = $conn->prepare($sql_profile);
if ($stmt_profile === false) {
    die('Erro na preparação da consulta: ' . $conn->error);
}
$stmt_profile->bind_param('i', $user_id);
$stmt_profile->execute();
$stmt_profile->bind_result($username, $profile_picture, $is_verified);
$stmt_profile->fetch();
$stmt_profile->close();

$profile_picture_url = $profile_picture ? 'uploads/' . htmlspecialchars($profile_picture) : 'path/to/default/profile/picture.png';

// Consulta para obter todos os posts
$sql_posts = "SELECT posts.id, posts.content, posts.user_id, posts.created_at, users.username, users.profile_picture, users.is_verified 
              FROM posts 
              JOIN users ON posts.user_id = users.id 
              ORDER BY posts.created_at DESC";
$stmt_posts = $conn->prepare($sql_posts);
if ($stmt_posts === false) {
    die('Erro na preparação da consulta: ' . $conn->error);
}
$stmt_posts->execute();
$result_posts = $stmt_posts->get_result();
$stmt_posts->close();

// Consulta para obter os seguidores do usuário (opcional)
$sql_followers = "SELECT COUNT(*) FROM followers WHERE user_id = ?";
$stmt_followers = $conn->prepare($sql_followers);
if ($stmt_followers === false) {
    die('Erro na preparação da consulta: ' . $conn->error);
}
$stmt_followers->bind_param('i', $user_id);
$stmt_followers->execute();
$stmt_followers->bind_result($followers_count);
$stmt_followers->fetch();
$stmt_followers->close();

// Consulta para obter as pessoas que o usuário está seguindo (opcional)
$sql_following = "SELECT COUNT(*) FROM followers WHERE follower_id = ?";
$stmt_following = $conn->prepare($sql_following);
if ($stmt_following === false) {
    die('Erro na preparação da consulta: ' . $conn->error);
}
$stmt_following->bind_param('i', $user_id);
$stmt_following->execute();
$stmt_following->bind_result($following_count);
$stmt_following->fetch();
$stmt_following->close();

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>PixNet</title>
      <style>
          :root {
  --primary-color: black;
  --secondary-color: white;
  --tertiary-color: purple;
}

* {
  margin: 0;
  padding: 0;
  background-color: var(--primary-color);
  font-family: Verdana, Geneva, Tahoma, sans-serif;
  color: white;
}

a {
  text-decoration: none;
  color: white;
  margin-top: 10px;
}
.taskbar-container {
  margin-top: 24px;
  margin-bottom: 16px;
  height: 110px;
  display: flex;
  justify-content: space-evenly;
  border-bottom: 1px solid var(--secondary-color);
}

.taskbar-container > img {
  max-width: 55px;
  max-height: 55px;
  clip-path: circle(50%);
}
      </style>
  </head>
  <body>
    <div  class="taskbar-container">
        <h1>PixNet</h1>
      <img src="gato.jpg" alt="gato" >
      <a href="."><i class="fa-solid fa-house" style="color: #ffffff;"></i>Home</a>
      <a href="."><i class="fa-solid fa-magnifying-glass"></i>Pesquisar</a>
      <a href="."><i class="fa-solid fa-plus"></i>Criar</a>
      <a href="."> <i class="fa-solid fa-user" style="color: #ffffff;"></i> Perfil </a>  
      <a href="."><i class="fa-solid fa-gear"></i>Configurações</a>
    </div>
    <div class="post-container"></div>
</body>
</html>
  </body>
</html>
