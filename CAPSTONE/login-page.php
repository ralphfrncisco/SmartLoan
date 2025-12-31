<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css-files/font-import.css">
        <link rel="stylesheet" href="css-files/login.css">
        <link rel="icon" type="image/x-icon" href="Resources/hfscco-logo-title.ico">
        <title>Login</title>
        <script>
            // JavaScript function to display the error message
            function showError() {
                const urlParams = new URLSearchParams(window.location.search);
                const error = urlParams.get('error');


                if (error) {
                    let errorMessage = '';
                    if (error === 'incorrect_password') {
                        errorMessage = 'Password is incorrect. Please try again.';
                        document.getElementById('validationServerFeedback').innerText = errorMessage;
                        document.getElementById('validationServerFeedback').style.display = 'block';

                        // Correct way to add classes
                        document.getElementById('floatingPassword').classList.add('is-invalid', 'border-danger', 'input-invalid');

                    } 
                    else if (error === 'user_not_exist') {
                        document.getElementById('floatingInput').classList.add('is-invalid', 'border-danger', 'input-invalid');
                        document.getElementById('floatingPassword').classList.add('is-invalid', 'border-danger', 'input-invalid');
                        const userConfirmed = confirm('User does not exist. Would you like to register?');
                        if (userConfirmed) {
                            window.location.href = 'registration.php';
                        } else {

                            document.getElementById('validationServerFeedback').innerText = 'Please try again or register.';
                            document.getElementById('validationServerFeedback').style.display = 'block';

                            document.getElementById('floatingInput').classList.add('is-invalid', 'border-danger', 'input-invalid');
                            document.getElementById('floatingPassword').classList.add('is-invalid', 'border-danger', 'input-invalid');
                        }
                    }
                }
            }

            window.onload = showError;
        </script>
    </head>
    <body>
        <div class="container-fluid">
            <form action="functions-php/login-validation.php" method="post">
                <div class="login-body d-flex justify-content-center align-items-center vh-100">
                    <div class="col-12 col-lg-3 col-md-6 col-sm-8 login-input">
                        <img src="Resources/logo.png" alt="Logo">
                        <h2 class="text-uppercase fw-bold">Welcome, KAMAY-ARI!</h2>
                        <p id="login-sub-header">Login with your Email address and Password</p>

                        <div class="col-12 mb-4" id="text-input">
                            <input type="email" class="form-control" name="Email-txt" id="floatingInput" placeholder="Email Address">
                        </div>
                        <div class="col-12 mb-4" id="text-input">
                            <input type="password" class="form-control" name="Password-txt" id="floatingPassword" placeholder="Password">
                            <p id="validationServerFeedback" class="invalid-feedback"></p>
                        </div>
                        <button type="submit" class="btn btn-success mt-2 mb-3" name="sign-in" id="submitbtn">Login</button>

                        <p class="mt-3" id="register-now">Not a Member?&nbsp;<a href="registration.php">Register now</a></p>
                    </div>
                </div>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>

    </html>
    