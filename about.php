<?php
declare(strict_types=1);

require __DIR__ . '/includes/bootstrap.php';

$brands = [
    ['name' => 'Xtreem Data Touch Consulting', 'description' => 'Business advisory, digital transformation planning, and practical support for organizations that need structure as much as technology.'],
    ['name' => 'NextGen Technology', 'description' => 'Application development, automation, cloud-ready delivery, and modern systems that can scale with operational demand.'],
    ['name' => 'Grafix@Mirror LMS', 'description' => 'Training, digital learning experiences, and structured educational delivery for individuals, teams, and institutions.'],
];

$reasons = [
    'Unified ecosystem connecting consulting, technology, and learning.',
    'Execution-focused approach instead of disconnected strategy alone.',
    'Practical support for both organizations and individual learners.',
    'A clear client-facing gateway for services, resources, and enquiries.',
];

render_head('About Us', 'Learn how Mirror Age Concepts brings consulting, technology innovation, and digital learning together through one connected ecosystem.');
render_header();
?>
<main>
  <section class="hero-shell">
    <div class="container">
      <div class="hero-panel" data-aos="fade-up">
        <span class="hero-kicker"><i class="fa-solid fa-building"></i> About the brand</span>
        <h1 class="hero-title">Built as one ecosystem, not a collection of isolated pages.</h1>
        <p class="hero-copy">Mirror Age Concepts exists to help people and organizations access consulting, technical delivery, and learning support through one clear, trusted gateway.</p>
      </div>
    </div>
  </section>

  <section class="section-block">
    <div class="container">
      <div class="row g-4">
        <div class="col-lg-7" data-aos="fade-up">
          <div class="section-panel">
            <span class="section-eyebrow">Who we are</span>
            <h2 class="h3">A practical digital solutions group for real operational needs.</h2>
            <p class="text-body-secondary">Mirror Age Concepts is positioned as a gateway brand that unifies specialized capabilities under one umbrella. That means visitors can understand your offer quickly, while the business keeps flexibility behind the scenes.</p>
            <p class="text-body-secondary mb-0">Our platform is designed to present services, resources, and partnerships with clarity, consistency, and trust.</p>
          </div>
        </div>
        <div class="col-lg-5" data-aos="fade-up">
          <div class="section-panel">
            <span class="section-eyebrow">Mission</span>
            <p class="mb-3">Empower people and organizations with the systems, knowledge, and support needed to succeed in a fast-moving digital environment.</p>
            <span class="section-eyebrow">Vision</span>
            <p class="mb-0">Grow into a leading consulting, technology, and education ecosystem across Africa and beyond.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section-block">
    <div class="container">
      <div class="section-heading" data-aos="fade-up">
        <span class="section-eyebrow">Gateway brands</span>
        <h2>Each business unit has a clear role inside the larger platform.</h2>
      </div>
      <div class="row g-4">
        <?php foreach ($brands as $brand): ?>
          <div class="col-md-4" data-aos="fade-up">
            <article class="feature-card">
              <span class="badge-soft mb-3"><i class="fa-solid fa-layer-group"></i> Business unit</span>
              <h3 class="h5"><?= e($brand['name']) ?></h3>
              <p class="text-body-secondary mb-0"><?= e($brand['description']) ?></p>
            </article>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="section-block pb-4">
    <div class="container">
      <div class="row g-4">
        <div class="col-lg-8" data-aos="fade-up">
          <div class="info-card">
            <span class="section-eyebrow">Why work with us</span>
            <h2 class="h3">One relationship, multiple delivery capabilities.</h2>
            <ul class="list-clean">
              <?php foreach ($reasons as $reason): ?>
                <li><i class="fa-solid fa-circle-check text-primary me-2"></i><?= e($reason) ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
        <div class="col-lg-4" data-aos="fade-up">
          <div class="contact-card">
            <span class="section-eyebrow">Next step</span>
            <p class="text-body-secondary">If you are ready to discuss a project, training plan, partnership, or consultation, our team is ready to hear from you.</p>
            <a href="<?= e(base_url('contact.php')) ?>" class="btn btn-primary">Contact Mirror Age Concepts</a>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<?php render_footer();
