# Online Application & Registration Form

A responsive PHP registration form built with HTML, CSS, JavaScript, jQuery and PHP.

## Features
- Applicant details form with required-field validation.
- jQuery client-side validation and PHP server-side validation.
- Displays a formatted confirmation page after successful submission.
- Escapes submitted values before displaying them to reduce HTML/script injection risk.
- Print-friendly confirmation page.
- Responsive layout for desktop and mobile.

## Project files
- `index.php` — form, PHP validation, and successful submission display.
- `style.css` — page styling and print styles.
- `script.js` — jQuery validation and user feedback.

## Run locally
PHP must be installed.

1. Extract the project folder.
2. Open a terminal in the project folder.
3. Run:

   ```bash
   php -S localhost:8000
   ```

4. Open `http://localhost:8000` in your browser.
5. Complete the form and click **Submit application**.

> Do not open `index.php` by double-clicking it. PHP must run through a PHP-enabled web server.

## Host it online (PHP hosting)
This project needs a host that supports PHP. GitHub Pages alone will not run the PHP form.

1. Create an account with a PHP-capable hosting provider (for example, InfinityFree or another host that supports PHP).
2. Create a hosting account/site and open its File Manager or FTP details.
3. Upload `index.php`, `style.css`, and `script.js` into the site's document root (often named `htdocs` or `public_html`).
4. Visit the domain/subdomain supplied by the host and test a sample submission.
5. Keep PHP enabled. The jQuery and Google Fonts libraries are loaded from CDNs, so the hosted page needs internet access to load them.

Hosting dashboards and folder names can vary by provider; follow the provider's current upload instructions.

## Important note
This demo validates and displays submitted details, but does not save them to a database or email them. Add a database and appropriate privacy/security controls before using it to collect real applicant information.


## Deploy to Railway (Docker)

This project includes a `Dockerfile` for Railway's Docker-based deployment.

1. Push the files in this folder to a GitHub repository (keep `Dockerfile` in the repository root).
2. In Railway, create a project and choose **Deploy from GitHub repo**.
3. Select the repository. Railway should detect the Dockerfile and build the PHP service.
4. In the service settings, open **Networking** and generate a public domain.
5. Open the generated HTTPS URL and test a form submission.

The container starts PHP's built-in web server on Railway's assigned `PORT`.
Check Railway's current plan, trial limits, and billing settings before deploying: do not assume ongoing hosting is free. Set usage limits or disable/remove the service if you do not want any possible charges.
