<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            min-height: 100vh;
            background: linear-gradient(135deg,#4b0082,#6a0dad,#8a2be2);
            font-family: 'Segoe UI', Tahoma, sans-serif;
        }

        .auth-card{
            background: #ffffff;
            border-radius: 22px;
            box-shadow: 0 20px 45px rgba(75,0,130,0.35);
            padding: 40px;
        }

        h1,h2{
            color:#4b0082;
            font-weight: 700;
        }

        label{
            color:#4b0082;
            font-weight: 600;
        }

        .form-control{
            border-radius: 14px;
            border: 2px solid #8a2be2;
        }

        .form-control:focus{
            border-color:#6a0dad;
            box-shadow: 0 0 0 0.25rem rgba(138,43,226,.25);
        }

        .btn-purple{
            background: linear-gradient(135deg,#6a0dad,#8a2be2);
            color:#ffffff;
            border:none;
            border-radius: 16px;
            font-size: 20px;
            padding: 10px;
            width:100%;
            font-weight: 600;
        }

        .btn-purple:hover{
            opacity: 0.9;
            color:#ffffff;
        }

        .auth-link{
            color:#6a0dad;
            font-size:18px;
            text-decoration:none;
            font-weight:500;
        }

        .auth-link:hover{
            text-decoration: underline;
            color:#4b0082;
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center mt-5 mb-5">
    <div class="col-md-7 col-lg-5">
        <div class="auth-card text-center">

            <h1 class="mb-2">login</h1>
            <h2 class="mb-4">Login To Your Account :)</h2>

            <form action="login_Logic.php" method="post">

                <div class="mb-3 text-start">
                    <label>Enter your email :</label>
                    <input type="email" name="email" class="form-control" placeholder="email">
                </div>

                <div class="mb-4 text-start">
                    <label>Enter your password :</label>
                    <input type="password" name="password" class="form-control" placeholder="password">
                </div>

                <button type="submit" name="login" class="btn btn-purple">
                    login
                </button>

            </form>

            <div class="mt-4">
                <h2 class="mb-2">Dont Have An Account??</h2>
                <a href="signUp_ui.php" class="auth-link">Sign up</a>
            </div>

        </div>
    </div>
</div>

</body>
</html>
