document.addEventListener("DOMContentLoaded", function () {

    const forms = document.querySelectorAll("form");

    forms.forEach(function (form) {

        form.addEventListener("submit", function (event) {

            let valid = true;

            const requiredFields =
                form.querySelectorAll("[required]");

            requiredFields.forEach(function (field) {

                field.classList.remove("is-invalid");

                if (field.value.trim() === "") {

                    field.classList.add("is-invalid");

                    valid = false;
                }
            });


            const emailField =
                form.querySelector('input[type="email"]');

            if (emailField && emailField.value.trim() !== "") {

                const emailPattern =
                    /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                if (!emailPattern.test(emailField.value)) {

                    emailField.classList.add("is-invalid");

                    valid = false;
                }
            }


            const passwordField =
                form.querySelector('input[name="password"]');

            if (passwordField && passwordField.value.length > 0) {

                if (passwordField.value.length < 8) {

                    passwordField.classList.add("is-invalid");

                    valid = false;
                }
            }


            if (!valid) {

                event.preventDefault();

                alert(
                    "Please correct the highlighted fields before submitting."
                );
            }

        });

    });

});