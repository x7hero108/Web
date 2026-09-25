<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$isLoggedIn = isset($_SESSION["user_id"]);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>Alzikrayat - Memories Gallery</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>

        .gallery-image {
            height: 250px;
            object-fit: cover;
        }

        .gallery-list .gallery-item {
            width: 100%;
        }

        .gallery-list .card {
            display: flex;
            flex-direction: row;
        }

        .gallery-list .gallery-image {
            width: 300px;
            height: 200px;
            object-fit: cover;
        }

        @media (max-width: 768px) {

            .gallery-list .card {
                display: block;
            }

            .gallery-list .gallery-image {
                width: 100%;
                height: 250px;
            }

        }

    </style>

</head>


<body class="bg-light">


<nav class="navbar navbar-dark bg-dark">

    <div class="container">

        <a
            class="navbar-brand fw-bold"
            href="/alzikrayat/"
        >
            Alzikrayat
        </a>


        <div class="d-flex align-items-center gap-2">

            <?php if ($isLoggedIn): ?>

                <span class="text-white">

                    Hi
                    <strong>
                        <?php echo htmlspecialchars(
                            $_SESSION["first_name"] ?? ""
                        ); ?>
                    </strong>

                </span>


                <a
                    href="/alzikrayat/photo/upload"
                    class="btn btn-primary"
                >
                    Upload Photo
                </a>


                <a
                    href="/alzikrayat/logout"
                    class="btn btn-outline-light"
                >
                    Logout
                </a>

            <?php else: ?>

                <span class="text-white me-2">
                    Please Login
                </span>


                <a
                    href="/alzikrayat/login"
                    class="btn btn-primary"
                >
                    Login
                </a>


                <a
                    href="/alzikrayat/register"
                    class="btn btn-outline-light"
                >
                    Register
                </a>

            <?php endif; ?>

        </div>

    </div>

</nav>


<section class="py-5 bg-dark text-white">

    <div class="container text-center">

        <h1 class="display-4 fw-bold">
            Preserve Your Memories
        </h1>

        <p class="lead mt-3">

            Alzikrayat is a simple photo gallery
            where you can upload, share and remember
            your favorite moments.

        </p>


        <?php if (!$isLoggedIn): ?>

            <a
                href="/alzikrayat/register"
                class="btn btn-primary btn-lg mt-3"
            >
                Get Started
            </a>

        <?php endif; ?>

    </div>

</section>


<section class="py-5">

    <div class="container">

        <div class="row text-center g-4">

            <div class="col-md-4">

                <div class="card shadow-sm h-100">

                    <div class="card-body">

                        <div class="display-4">
                            📸
                        </div>

                        <h4 class="mt-3">
                            Upload Photos
                        </h4>

                        <p class="text-muted">

                            Upload and preserve
                            your favorite memories.

                        </p>

                    </div>

                </div>

            </div>


            <div class="col-md-4">

                <div class="card shadow-sm h-100">

                    <div class="card-body">

                        <div class="display-4">
                            💬
                        </div>

                        <h4 class="mt-3">
                            Share Comments
                        </h4>

                        <p class="text-muted">

                            Leave comments and
                            interact with memories.

                        </p>

                    </div>

                </div>

            </div>


            <div class="col-md-4">

                <div class="card shadow-sm h-100">

                    <div class="card-body">

                        <div class="display-4">
                            🔒
                        </div>

                        <h4 class="mt-3">
                            Secure
                        </h4>

                        <p class="text-muted">

                            Your account and uploaded
                            content are protected.

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


<section class="py-5 bg-white">

    <div class="container">

        <div class="row align-items-center">

            <div class="col-md-6">

                <h2 class="fw-bold">
                    About Alzikrayat
                </h2>

                <p class="text-muted">

                    Alzikrayat is a web-based photo
                    gallery designed to help users
                    keep their memories organized
                    in one place.

                </p>

                <p class="text-muted">

                    Users can create an account,
                    upload photographs, add descriptions,
                    view memories and communicate
                    through comments.

                </p>

            </div>


            <div class="col-md-6">

                <div class="card shadow">

                    <div class="card-body text-center p-5">

                        <div class="display-1">
                            📷
                        </div>

                        <h3 class="mt-3">
                            Your Memories
                        </h3>

                        <p class="text-muted">

                            Every picture tells a story.

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


<section class="py-5">

    <div class="container">

        <h2 class="text-center mb-4">
            Gallery
        </h2>


        <div class="text-center mb-4">

            <button
                type="button"
                class="btn btn-dark me-2"
                onclick="setGalleryStyle('three')"
            >
                3 Columns
            </button>


            <button
                type="button"
                class="btn btn-outline-dark me-2"
                onclick="setGalleryStyle('four')"
            >
                4 Columns
            </button>


            <button
                type="button"
                class="btn btn-outline-dark"
                onclick="setGalleryStyle('list')"
            >
                List
            </button>

        </div>


        <?php if (empty($photos)): ?>

            <div class="alert alert-info text-center">

                No photos have been uploaded yet.

            </div>

        <?php else: ?>

            <div
                id="gallery"
                class="row g-4"
            >

                <?php foreach ($photos as $photo): ?>

                    <div
                        class="gallery-item col-md-6 col-lg-4"
                    >

                        <div class="card shadow-sm h-100">

                            <a
                                href="/alzikrayat/photo/<?php echo (int)$photo["id"]; ?>"
                            >

                                <img
                                    src="/alzikrayat/uploads/<?php echo htmlspecialchars($photo["file_name"]); ?>"
                                    class="card-img-top gallery-image"
                                    alt="<?php echo htmlspecialchars($photo["title"]); ?>"
                                >

                            </a>


                            <div class="card-body">

                                <h5 class="card-title">

                                    <?php echo htmlspecialchars(
                                        $photo["title"]
                                    ); ?>

                                </h5>


                                <p class="card-text text-muted">

                                    <?php echo htmlspecialchars(
                                        $photo["description"]
                                    ); ?>

                                </p>


                                <a
                                    href="/alzikrayat/photo/<?php echo (int)$photo["id"]; ?>"
                                    class="btn btn-dark w-100"
                                >
                                    View Photo
                                </a>

                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

        <?php endif; ?>

    </div>

</section>


<footer class="bg-dark text-white text-center py-4">

    <div class="container">

        <p class="mb-0">
            © <?php echo date("Y"); ?> Alzikrayat
        </p>

    </div>

</footer>


<script>

function setGalleryStyle(style) {

    const gallery =
        document.getElementById("gallery");

    if (!gallery) {
        return;
    }


    const items =
        gallery.querySelectorAll(".gallery-item");


    gallery.classList.remove(
        "gallery-list"
    );


    items.forEach(function (item) {

        item.classList.remove(
            "col-lg-3",
            "col-lg-4",
            "col-12"
        );

        item.classList.add(
            "col-md-6"
        );

    });


    if (style === "three") {

        items.forEach(function (item) {

            item.classList.add(
                "col-lg-4"
            );

        });

    }


    if (style === "four") {

        items.forEach(function (item) {

            item.classList.add(
                "col-lg-3"
            );

        });

    }


    if (style === "list") {

        gallery.classList.add(
            "gallery-list"
        );

        items.forEach(function (item) {

            item.classList.remove(
                "col-md-6"
            );

            item.classList.add(
                "col-12"
            );

        });

    }

}

</script>


</body>

</html>