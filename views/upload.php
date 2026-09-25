<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>Upload Photo - Alzikrayat</title>

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
            href="/alzikrayat/"
            class="btn btn-outline-light"
        >
            Gallery
        </a>

    </div>

</nav>


<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-7">

            <div class="card shadow mt-5">

                <div class="card-body p-4">

                    <h2 class="mb-4 text-center">
                        Upload Photo
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
                        action="/alzikrayat/photo/upload"
                        enctype="multipart/form-data"
                    >

                        <input
                            type="hidden"
                            name="csrf_token"
                            value="<?php echo htmlspecialchars($csrf_token); ?>"
                        >


                        <div class="mb-3">

                            <label class="form-label">
                                Photo
                            </label>

                            <input
                                type="file"
                                name="photo"
                                class="form-control"
                                accept="image/jpeg,image/png,image/gif,image/webp"
                                required
                            >

                            <div class="form-text">
                                JPG, PNG, GIF or WEBP. Maximum 5 MB.
                            </div>

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Title
                            </label>

                            <input
                                type="text"
                                name="title"
                                class="form-control"
                                required
                            >

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Description
                            </label>

                            <textarea
                                name="description"
                                class="form-control"
                                rows="4"
                            ></textarea>

                        </div>


                        <button
                            type="submit"
                            class="btn btn-primary"
                        >
                            Upload Photo
                        </button>


                        <a
                            href="/alzikrayat/"
                            class="btn btn-secondary"
                        >
                            Cancel
                        </a>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>


<script src="/alzikrayat/public/js/validation.js"></script>

</body>

</html>