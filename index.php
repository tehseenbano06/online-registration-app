<?php
// Process the form only after the user clicks Submit.
$errors = [];
$submitted = false;
$data = [
    "full_name" => "",
    "email" => "",
    "phone" => "",
    "dob" => "",
    "gender" => "",
    "course" => "",
    "address" => ""
];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    foreach ($data as $key => $value) {
        $data[$key] = trim($_POST[$key] ?? "");
    }

    if ($data["full_name"] === "") $errors[] = "Full name is required.";
    if (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) $errors[] = "Enter a valid email address.";
    if (!preg_match('/^[0-9+\-\s]{7,15}$/', $data["phone"])) $errors[] = "Enter a valid phone number.";
    if ($data["dob"] === "") $errors[] = "Date of birth is required.";
    if (!in_array($data["gender"], ["Female", "Male", "Other", "Prefer not to say"], true)) $errors[] = "Choose a gender option.";
    if ($data["course"] === "") $errors[] = "Choose a course.";
    if ($data["address"] === "") $errors[] = "Address is required.";

    $submitted = empty($errors);
}

function h($value) {
    return htmlspecialchars($value, ENT_QUOTES, "UTF-8");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Application & Registration</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="script.js" defer></script>
</head>
<body>
    <main class="page-shell">
        <section class="intro">
            <span class="eyebrow">APPLICATION PORTAL</span>
            <h1>Online Registration</h1>
            <p>Complete the form below to submit your application.</p>
            <div class="intro-note"><span class="note-dot"></span> Please check your details before submitting.</div>
        </section>

        <?php if ($submitted): ?>
            <section class="result-card" aria-live="polite">
                <div class="success-icon">✓</div>
                <p class="eyebrow">SUBMISSION SUCCESSFUL</p>
                <h2>Application received!</h2>
                <p class="result-lead">Thank you, <?= h($data["full_name"]) ?>. Here is a copy of the information you submitted.</p>
                <div class="details">
                    <div><span>Full name</span><strong><?= h($data["full_name"]) ?></strong></div>
                    <div><span>Email address</span><strong><?= h($data["email"]) ?></strong></div>
                    <div><span>Phone number</span><strong><?= h($data["phone"]) ?></strong></div>
                    <div><span>Date of birth</span><strong><?= h($data["dob"]) ?></strong></div>
                    <div><span>Gender</span><strong><?= h($data["gender"]) ?></strong></div>
                    <div><span>Course applied for</span><strong><?= h($data["course"]) ?></strong></div>
                    <div class="full-row"><span>Address</span><strong><?= nl2br(h($data["address"])) ?></strong></div>
                </div>
                <div class="result-actions">
                    <button type="button" class="secondary-btn" onclick="window.print()">Print application</button>
                    <a class="text-link" href="index.php">Submit another application</a>
                </div>
            </section>
        <?php else: ?>
            <?php if (!empty($errors)): ?>
                <div class="error-box" role="alert">
                    <strong>Please correct the following:</strong>
                    <ul><?php foreach ($errors as $error): ?><li><?= h($error) ?></li><?php endforeach; ?></ul>
                </div>
            <?php endif; ?>

            <form class="form-card" id="registrationForm" method="POST" action="index.php" novalidate>
                <div class="form-heading">
                    <div><h2>Applicant details</h2><p>Fields marked with * are required.</p></div>
                    <span class="step-label">01 / DETAILS</span>
                </div>

                <div class="form-grid">
                    <div class="field full-row">
                        <label for="full_name">Full name <em>*</em></label>
                        <input type="text" id="full_name" name="full_name" placeholder="Enter your full name" value="<?= h($data["full_name"]) ?>" required>
                        <small class="field-error"></small>
                    </div>
                    <div class="field">
                        <label for="email">Email address <em>*</em></label>
                        <input type="email" id="email" name="email" placeholder="name@example.com" value="<?= h($data["email"]) ?>" required>
                        <small class="field-error"></small>
                    </div>
                    <div class="field">
                        <label for="phone">Phone number <em>*</em></label>
                        <input type="tel" id="phone" name="phone" placeholder="+91 98765 43210" value="<?= h($data["phone"]) ?>" required>
                        <small class="field-error"></small>
                    </div>
                    <div class="field">
                        <label for="dob">Date of birth <em>*</em></label>
                        <input type="date" id="dob" name="dob" value="<?= h($data["dob"]) ?>" required>
                        <small class="field-error"></small>
                    </div>
                    <div class="field">
                        <label for="gender">Gender <em>*</em></label>
                        <select id="gender" name="gender" required>
                            <option value="">Select an option</option>
                            <?php foreach (["Female", "Male", "Other", "Prefer not to say"] as $option): ?>
                                <option value="<?= h($option) ?>" <?= $data["gender"] === $option ? "selected" : "" ?>><?= h($option) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small class="field-error"></small>
                    </div>
                    <div class="field full-row">
                        <label for="course">Course applied for <em>*</em></label>
                        <select id="course" name="course" required>
                            <option value="">Choose a course</option>
                            <?php foreach (["Computer Science", "Information Science", "Electronics", "Mechanical Engineering", "Business Administration", "Other"] as $option): ?>
                                <option value="<?= h($option) ?>" <?= $data["course"] === $option ? "selected" : "" ?>><?= h($option) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small class="field-error"></small>
                    </div>
                    <div class="field full-row">
                        <label for="address">Postal address <em>*</em></label>
                        <textarea id="address" name="address" rows="3" placeholder="Enter your complete address" required><?= h($data["address"]) ?></textarea>
                        <small class="field-error"></small>
                    </div>
                </div>

                <div class="form-footer">
                    <p>Your information will be shown on the confirmation page after submission.</p>
                    <button type="submit" class="primary-btn">Submit application <span>→</span></button>
                </div>
            </form>
        <?php endif; ?>
        <footer>Online Application Portal <span>•</span> Academic Registration</footer>
    </main>
</body>
</html>
