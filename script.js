$(function () {
    const $form = $("#registrationForm");

    function showError($field, message) {
        $field.closest(".field").addClass("invalid").find(".field-error").text(message);
    }

    function clearError($field) {
        $field.closest(".field").removeClass("invalid").find(".field-error").text("");
    }

    $form.find("input, select, textarea").on("input change", function () {
        clearError($(this));
    });

    $form.on("submit", function (event) {
        let valid = true;

        const $name = $("#full_name");
        const $email = $("#email");
        const $phone = $("#phone");
        const $dob = $("#dob");
        const $gender = $("#gender");
        const $course = $("#course");
        const $address = $("#address");

        [$name, $email, $phone, $dob, $gender, $course, $address].forEach(clearError);

        if (!$name.val().trim()) {
            showError($name, "Please enter your full name.");
            valid = false;
        }
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test($email.val().trim())) {
            showError($email, "Please enter a valid email address.");
            valid = false;
        }
        if (!/^[0-9+\-\s]{7,15}$/.test($phone.val().trim())) {
            showError($phone, "Please enter a valid phone number.");
            valid = false;
        }
        if (!$dob.val()) {
            showError($dob, "Please select your date of birth.");
            valid = false;
        }
        if (!$gender.val()) {
            showError($gender, "Please select an option.");
            valid = false;
        }
        if (!$course.val()) {
            showError($course, "Please choose a course.");
            valid = false;
        }
        if (!$address.val().trim()) {
            showError($address, "Please enter your address.");
            valid = false;
        }

        if (!valid) {
            event.preventDefault();
            const $firstError = $(".field.invalid").first();
            if ($firstError.length) {
                $("html, body").animate({ scrollTop: $firstError.offset().top - 30 }, 250);
            }
        }
        // If valid, allow normal POST submission to PHP.
    });
});
