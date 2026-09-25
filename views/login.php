<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>Login - Alzikrayat</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">

    <div class="container">

        <a
            class="navbar-brand"
            href="/alzikrayat/"
        >
            Alzikrayat
        </a>

        <a
            href="/alzikrayat/register"
            class="btn btn-outline-light"
        >
            Register
        </a>

    </div>

</nav>


<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow mt-5">

                <div class="card-body p-4">

                    <h2 class="text-center mb-4">
                        Login
                    </h2>


                    <?php if (!empty($last_login)): ?>

                        <div class="alert alert-info text-center">

                            Last login from this computer was:

                            <strong>
                                <?php echo htmlspecialchars($last_login); ?>
                            </strong>

                        </div>

                    <?php endif; ?>


                    <?php if (!empty($errors)): ?>

                        <div class="alert alert-danger">

                            <?php foreach ($errors as $error): ?>

                                <div>
                                    <?php echo htmlspecialchars($error); ?>
                                </div>

                            <?php endforeach; ?>

                        </div>

                    <?php endif; ?>


                    <form
                        method="POST"
                        action="/alzikrayat/login"
                    >

                        <input
                            type="hidden"
                            name="csrf_token"
                            value="<?php echo htmlspecialchars($csrf_token); ?>"
                        >


                        <div class="mb-3">

                            <label class="form-label">
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                required
                            >

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Password
                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                required
                            >

                        </div>


                        <button
                            type="submit"
                            class="btn btn-primary w-100"
                        >
                            Login
                        </button>

                    </form>


                    <p class="text-center mt-3">

                        Don't have an account?

                        <a href="/alzikrayat/register">
                            Register
                        </a>

                    </p>

                </div>

            </div>

        </div>

    </div>

</div>


<script src="/alzikrayat/public/js/validation.js"></script>

</body>

</html>