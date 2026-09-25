<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>Register - Alzikrayat</title>

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
            href="/alzikrayat/login"
            class="btn btn-outline-light"
        >
            Login
        </a>

    </div>

</nav>


<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-7">

            <div class="card shadow mt-5">

                <div class="card-body p-4">

                    <h2 class="text-center mb-4">
                        Create Account
                    </h2>


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
                        action="/alzikrayat/register"
                    >

                        <input
                            type="hidden"
                            name="csrf_token"
                            value="<?php echo htmlspecialchars($csrf_token); ?>"
                        >


                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    First Name
                                </label>

                                <input
                                    type="text"
                                    name="first_name"
                                    class="form-control"
                                    required
                                >

                            </div>


                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Last Name
                                </label>

                                <input
                                    type="text"
                                    name="last_name"
                                    class="form-control"
                                    required
                                >

                            </div>

                        </div>


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
                                minlength="8"
                            >

                            <div class="form-text">
                                Minimum 8 characters.
                            </div>

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Location
                            </label>

                            <input
                                type="text"
                                name="location"
                                class="form-control"
                            >

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Occupation
                            </label>

                            <input
                                type="text"
                                name="occupation"
                                class="form-control"
                            >

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Description
                            </label>

                            <textarea
                                name="description"
                                class="form-control"
                                rows="3"
                            ></textarea>

                        </div>


                        <button
                            type="submit"
                            class="btn btn-primary w-100"
                        >
                            Create Account
                        </button>

                    </form>


                    <p class="text-center mt-3">

                        Already have an account?

                        <a href="/alzikrayat/login">
                            Login
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