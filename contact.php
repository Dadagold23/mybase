<?php
declare(strict_types=1);

require __DIR__ . '/includes/bootstrap.php';
require __DIR__ . '/includes/database.php';

$formData = [
    'name' => trim((string) ($_POST['name'] ?? '')),
    'email' => trim((string) ($_POST['email'] ?? '')),
    'category' => trim((string) ($_POST['category'] ?? '')),
    'message' => trim((string) ($_POST['message'] ?? '')),
];
$errors = [];
$successMessage = null;
$formError = null;
$honeypot = trim((string) ($_POST['website'] ?? ''));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf_token('contact_form', (string) ($_POST['_token'] ?? ''))) {
        $formError = 'Your session expired. Please refresh the page and try again.';
    }

    if ($honeypot !== '') {
        $formData = ['name' => '', 'email' => '', 'category' => '', 'message' => ''];
        $successMessage = 'Your message has been received. We will follow up shortly.';
    } elseif ($formData['name'] === '') {
        $errors['name'] = 'Full name is required.';
    }

    if ($formError === null && !filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Enter a valid email address.';
    }

    if ($formError === null && $formData['category'] === '') {
        $errors['category'] = 'Select an inquiry type.';
    }

    if ($formError === null && ($formData['message'] === '' || mb_strlen($formData['message']) < 15)) {
        $errors['message'] = 'Please enter at least 15 characters.';
    }

    if ($formError === null && $errors === []) {
        $payload = [
            'name' => $formData['name'],
            'email' => $formData['email'],
            'category' => $formData['category'],
            'message' => $formData['message'],
            'ip_address' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown',
        ];

        try {
            save_contact_message($payload);
            $formData = ['name' => '', 'email' => '', 'category' => '', 'message' => ''];
            $successMessage = 'Your message has been received. We will follow up shortly.';
        } catch (Throwable $exception) {
            error_log('Contact form save failed: ' . $exception->getMessage());
            $formError = 'We could not send your message right now. Please try again shortly.';
        }
    }
}

$categories = [
    'Consulting Services',
    'Technology Solutions',
    'Learning and Training',
    'Partnership or Collaboration',
    'General Inquiry',
];

render_head('Contact Us', 'Contact Mirror Age Concepts for consulting, technology solutions, digital learning support, and partnership enquiries.');
render_header();
?>
<main class="page-main page-main--contact">
  <section class="hero-shell">
    <div class="container">
      <div class="hero-panel" data-aos="fade-up">
        <span class="hero-kicker"><i class="fa-solid fa-comments"></i> Contact</span>
        <h1 class="hero-title">Let's turn enquiries into next steps.</h1>
        <p class="hero-copy">Reach out for consulting support, technical execution, digital learning, or partnership discussions, and our team will respond as quickly as possible.</p>
      </div>
    </div>
  </section>

  <section class="section-block contact-page-section">
    <div class="container">
      <div class="row g-4 align-items-stretch">
        <div class="col-lg-7" data-aos="fade-up">
          <div class="contact-card">
            <span class="section-eyebrow">Send a message</span>
            <h2 class="h3 mb-3">We typically respond within one business day.</h2>

            <?php if ($successMessage !== null): ?>
              <div class="alert alert-success"><?= e($successMessage) ?></div>
            <?php endif; ?>
            <?php if ($formError !== null): ?>
              <div class="alert alert-danger"><?= e($formError) ?></div>
            <?php endif; ?>

            <form method="post" action="<?= e(base_url('contact.php')) ?>" novalidate>
              <input type="hidden" name="_token" value="<?= e(csrf_token('contact_form')) ?>">
              <div class="contact-honeypot" aria-hidden="true">
                <label for="website">Website</label>
                <input id="website" type="text" name="website" tabindex="-1" autocomplete="off">
              </div>
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label" for="name">Full name</label>
                  <input id="name" type="text" name="name" class="form-control<?= isset($errors['name']) ? ' is-invalid' : '' ?>" value="<?= e($formData['name']) ?>" required>
                  <?php if (isset($errors['name'])): ?><div class="invalid-feedback"><?= e($errors['name']) ?></div><?php endif; ?>
                </div>

                <div class="col-md-6">
                  <label class="form-label" for="email">Email address</label>
                  <input id="email" type="email" name="email" class="form-control<?= isset($errors['email']) ? ' is-invalid' : '' ?>" value="<?= e($formData['email']) ?>" required>
                  <?php if (isset($errors['email'])): ?><div class="invalid-feedback"><?= e($errors['email']) ?></div><?php endif; ?>
                </div>

                <div class="col-12">
                  <label class="form-label" for="category">Inquiry type</label>
                  <select id="category" name="category" class="form-select<?= isset($errors['category']) ? ' is-invalid' : '' ?>" required>
                    <option value="">Select inquiry type</option>
                    <?php foreach ($categories as $category): ?>
                      <option value="<?= e($category) ?>"<?= $formData['category'] === $category ? ' selected' : '' ?>><?= e($category) ?></option>
                    <?php endforeach; ?>
                  </select>
                  <?php if (isset($errors['category'])): ?><div class="invalid-feedback"><?= e($errors['category']) ?></div><?php endif; ?>
                </div>

                <div class="col-12">
                  <label class="form-label" for="message">Message</label>
                  <textarea id="message" name="message" rows="6" class="form-control<?= isset($errors['message']) ? ' is-invalid' : '' ?>" required><?= e($formData['message']) ?></textarea>
                  <?php if (isset($errors['message'])): ?><div class="invalid-feedback"><?= e($errors['message']) ?></div><?php endif; ?>
                </div>

                <div class="col-12">
                  <button type="submit" class="btn btn-primary"><i class="fa-solid fa-paper-plane me-2"></i>Send message</button>
                </div>
              </div>
            </form>
          </div>
        </div>

        <div class="col-lg-5" data-aos="fade-up">
          <div class="contact-side-stack">
            <div class="contact-card">
              <span class="section-eyebrow">Direct contact</span>
              <ul class="list-clean">
                <li><span class="contact-icon"><i class="fa-solid fa-envelope"></i></span><div><strong>Email</strong><br><a href="mailto:<?= e(contact_email()) ?>" class="text-decoration-none"><?= e(contact_email()) ?></a></div></li>
                <li><span class="contact-icon"><i class="fa-solid fa-phone"></i></span><div><strong>Phone</strong><br><a href="tel:+2347035627734" class="text-decoration-none"><?= e(contact_phone_primary()) ?></a></div></li>
                <li><span class="contact-icon"><i class="fa-brands fa-whatsapp"></i></span><div><strong>WhatsApp</strong><br><a href="https://wa.me/2347035627734" target="_blank" rel="noopener noreferrer" class="text-decoration-none">Start chat</a></div></li>
                <li><span class="contact-icon"><i class="fa-solid fa-location-dot"></i></span><div><strong>Location</strong><br><?= e(contact_location()) ?></div></li>
              </ul>
            </div>

            <div class="contact-card contact-note-card">
              <span class="section-eyebrow">Production note</span>
              <p class="text-body-secondary mb-0">Every enquiry is captured securely so your message reaches the business through a consistent and dependable workflow.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<?php render_footer();
