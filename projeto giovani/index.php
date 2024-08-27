<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            text-align: center;
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
        }
        img.logo {
            width: 150px;
            height: auto;
            margin-bottom: 20px;
        }
        button {
            padding: 10px 20px;
            background: #5cb85c;
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background: #4cae4c;
        }
        a {
            display: block;
            margin-top: 10px;
            font-size: 18px;
            color: #5cb85c;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 90%;
            max-width: 400px;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            z-index: 2;
        }
        .popup.active {
            display: block;
        }
        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1;
        }
        .popup-overlay.active {
            display: block;
        }
        .close {
            cursor: pointer;
            float: right;
            font-size: 20px;
        }
        h2 {
            margin-top: 0;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #5cb85c;
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background: #4cae4c;
        }
        p {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <img src="./images/logo.png" alt="Logo PixNet" class="logo">
    <h1>Bem-vindo ao PixNet</h1>
    <button onclick="openPopup()">Login</button>
    <a href="register.php">Registrar</a>

    <div id="popup-login" class="popup">
        <span class="close" onclick="closePopup()">×</span>
        <h2>Login</h2>
        <form action="login.php" method="post">
            <label for="username">Nome de Usuário:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Entrar</button>
        </form>
        <?php if (isset($error)) echo "<p>$error</p>"; ?>
    </div>
    <div id="popup-overlay" class="popup-overlay"></div>

    <script>
        function openPopup() {
            document.getElementById('popup-login').classList.add('active');
            document.getElementById('popup-overlay').classList.add('active');
        }

        function closePopup() {
            document.getElementById('popup-login').classList.remove('active');
            document.getElementById('popup-overlay').classList.remove('active');
        }
    </script>
</body>
</html>
