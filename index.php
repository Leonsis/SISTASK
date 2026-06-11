<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTASKS</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="public/main.css">
    <script src="public/main.js"></script>
</head>
<body>

    <div class="scene">
        <div class="card-container" id="authCard">
            <h1>SISTASKS</h1>

            <div class="card-face card-front">
                <h2>Sign In</h2>
                <p class="desc">Enter your credentials to continue.</p>
                
                <form action="../app/controllers/loginController.php" method="POST">
                    <div class="input-box">
                        <label>Email</label>
                        <input type="email" placeholder="name@email.com" required>
                    </div>
                    <div class="input-box">
                        <label>Password</label>
                        <input type="password" placeholder="••••••••" required>
                    </div>
                    <button type="submit" class="btn-primary">Sign In</button>
                </form>

                <p class="toggle-link">Don't have an account? <span onclick="toggleAuth()">Create Account</span></p>
            </div>


            <div class="card-face card-back">
                <h2>Criar conta</h2>
                <p class="desc">Join our premium fintech ecosystem.</p>
                
                <form action="../app/controllers/loginController.php" method="POST">
                    <div class="input-box">
                        <label>Full Name</label>
                        <input type="text" placeholder="John Doe" required>
                    </div>
                    <div class="input-box">
                        <label>Email Address</label>
                        <input type="email" placeholder="john@example.com" required>
                    </div>
                    <div class="input-box">
                        <label>Password</label>
                        <input type="password" placeholder="••••••••" required>
                    </div>
                    <button type="submit" class="btn-primary">Register Now</button>
                </form>

                <p class="toggle-link">Already a member? <span onclick="toggleAuth()">Log In instead</span></p>
            </div>

        </div>
    </div>

</body>
</html>