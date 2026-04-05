<?php
declare(strict_types=1);

require __DIR__ . '/includes/bootstrap.php';

$services = [
    ['icon' => 'fa-solid fa-code', 'title' => 'Software Delivery', 'body' => 'Web platforms, internal tools, and business systems built with maintainability in mind.'],
    ['icon' => 'fa-solid fa-network-wired', 'title' => 'ICT and POS Setup', 'body' => 'Hardware rollout, device support, network readiness, and integrated operational workflows.'],
    ['icon' => 'fa-solid fa-palette', 'title' => 'Brand and Creative Support', 'body' => 'Identity design, print-ready materials, and digital assets aligned with your business goals.'],
];

$gatewayCategories = [
    [
        'title' => 'Education and Exam Portals',
        'links' => [
            ['label' => 'WAEC Direct', 'url' => 'https://www.waecdirect.org/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=education'],
            ['label' => 'NECO', 'url' => 'https://www.neco.gov.ng/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=education'],
            ['label' => 'NABTEB', 'url' => 'https://nabteb.gov.ng/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=education'],
            ['label' => 'JAMB', 'url' => 'https://efacility.jamb.gov.ng/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=education'],
            ['label' => 'JAMB CAPS', 'url' => 'https://caps.jamb.gov.ng/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=education'],
            ['label' => 'Federal Ministry of Education', 'url' => 'https://education.gov.ng/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=education'],
            ['label' => 'National Universities Commission', 'url' => 'https://www.nuc.edu.ng/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=education'],
            ['label' => 'NUC Approved Universities', 'url' => 'https://www.nuc.edu.ng/nigerian-univerisities/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=education'],
            ['label' => 'National Board for Technical Education', 'url' => 'https://net.nbte.gov.ng/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=education'],
            ['label' => 'NBTE Institutions Directory', 'url' => 'https://net.nbte.gov.ng/institution?utm_source=mirrorage&utm_medium=gateway&utm_campaign=education'],
            ['label' => 'National Commission for Colleges of Education', 'url' => 'https://ncceonline.edu.ng/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=education'],
            ['label' => 'NCCE Accredited Colleges', 'url' => 'https://ncceonline.edu.ng/colleges/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=education'],
            ['label' => 'Federal Polytechnic Offa', 'url' => 'https://www.fedpoffaonline.edu.ng/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=education'],
            ['label' => 'IJMB', 'url' => 'https://www.ijmb.ng/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=education'],
            ['label' => 'JUPEB', 'url' => 'https://www.jupeb.edu.ng/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=education'],
            ['label' => 'National Open University of Nigeria', 'url' => 'https://nou.edu.ng/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=education'],
            ['label' => 'University of Ilorin', 'url' => 'https://www.unilorin.edu.ng/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=education'],
            ['label' => 'Ahmadu Bello University', 'url' => 'https://abu.edu.ng/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=education'],
            ['label' => 'University of Ibadan', 'url' => 'https://www.ui.edu.ng/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=education'],
            ['label' => 'Obafemi Awolowo University', 'url' => 'https://www.oauife.edu.ng/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=education'],
            ['label' => 'University of Lagos', 'url' => 'https://www.unilag.edu.ng/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=education'],
            ['label' => 'University of Nigeria', 'url' => 'https://www.unn.edu.ng/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=education'],
            ['label' => 'Bayero University Kano', 'url' => 'https://buk.edu.ng/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=education'],
            ['label' => 'Nnamdi Azikiwe University', 'url' => 'https://www.unizik.edu.ng/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=education'],
            ['label' => 'University of Benin', 'url' => 'https://www.uniben.edu/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=education'],
            ['label' => 'University of Port Harcourt', 'url' => 'https://www.uniport.edu.ng/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=education'],
            ['label' => 'Usmanu Danfodiyo University Sokoto', 'url' => 'https://udusok.edu.ng/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=education'],
            ['label' => 'Federal University of Technology Akure', 'url' => 'https://www.futa.edu.ng/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=education'],
            ['label' => 'Federal University of Technology Minna', 'url' => 'https://futminna.edu.ng/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=education'],
            ['label' => 'Federal University of Technology Owerri', 'url' => 'https://futo.edu.ng/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=education'],
            ['label' => 'University of Uyo', 'url' => 'https://www.uniuyo.edu.ng/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=education'],
            ['label' => 'West African Examinations Council', 'url' => 'https://www.waecnigeria.org/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=education'],
        ],
    ],
    [
        'title' => 'Recruitment and Government Portals',
        'links' => [
            ['label' => 'Nigerian Navy', 'url' => 'https://www.joinnigeriannavy.com?utm_source=mirrorage&utm_medium=gateway&utm_campaign=recruitment'],
            ['label' => 'Nigeria Police', 'url' => 'https://www.npf.gov.ng?utm_source=mirrorage&utm_medium=gateway&utm_campaign=recruitment'],
            ['label' => 'Nigerian Army', 'url' => 'https://recruitment.army.mil.ng?utm_source=mirrorage&utm_medium=gateway&utm_campaign=recruitment'],
            ['label' => 'Nigerian Air Force', 'url' => 'https://airforce.mil.ng/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=recruitment'],
            ['label' => 'Nigeria Immigration Service', 'url' => 'https://immigration.gov.ng?utm_source=mirrorage&utm_medium=gateway&utm_campaign=recruitment'],
            ['label' => 'Nigeria Customs Service', 'url' => 'https://www.customs.gov.ng?utm_source=mirrorage&utm_medium=gateway&utm_campaign=recruitment'],
            ['label' => 'NSCDC', 'url' => 'https://www.nscdc.gov.ng?utm_source=mirrorage&utm_medium=gateway&utm_campaign=recruitment'],
            ['label' => 'NYSC', 'url' => 'https://www.nysc.gov.ng/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=recruitment'],
            ['label' => 'DSS', 'url' => 'https://www.dss.gov.ng?utm_source=mirrorage&utm_medium=gateway&utm_campaign=recruitment'],
            ['label' => 'Federal Inland Revenue Service', 'url' => 'https://www.firs.gov.ng/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=government'],
            ['label' => 'National Identity Management Commission', 'url' => 'https://nimc.gov.ng/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=government'],
            ['label' => 'Independent National Electoral Commission', 'url' => 'https://www.inecnigeria.org/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=government'],
            ['label' => 'Federal Ministry of Education', 'url' => 'https://education.gov.ng/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=government'],
        ],
    ],
    [
        'title' => 'Business and Technology',
        'links' => [
            ['label' => 'Corporate Affairs Commission', 'url' => 'https://www.cac.gov.ng?utm_source=mirrorage&utm_medium=gateway&utm_campaign=business'],
            ['label' => 'National Library of Nigeria', 'url' => 'https://www.nln.gov.ng?utm_source=mirrorage&utm_medium=gateway&utm_campaign=business'],
            ['label' => 'HP Official Site', 'url' => 'https://www.hp.com?utm_source=mirrorage&utm_medium=gateway&utm_campaign=tech'],
            ['label' => 'Konica Minolta', 'url' => 'https://www.konicaminolta.com?utm_source=mirrorage&utm_medium=gateway&utm_campaign=tech'],
            ['label' => 'GitHub', 'url' => 'https://github.com/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=tech'],
            ['label' => 'GitLab', 'url' => 'https://gitlab.com/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=tech'],
            ['label' => 'Microsoft', 'url' => 'https://www.microsoft.com/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=tech'],
            ['label' => 'Google Workspace', 'url' => 'https://workspace.google.com/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=tech'],
            ['label' => 'Namecheap', 'url' => 'https://www.namecheap.com/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=business'],
            ['label' => 'Cloudflare', 'url' => 'https://www.cloudflare.com/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=tech'],
        ],
    ],
    [
        'title' => 'Finance and Payments',
        'links' => [
            ['label' => 'Paystack', 'url' => 'https://paystack.com/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=finance'],
            ['label' => 'Flutterwave', 'url' => 'https://flutterwave.com/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=finance'],
            ['label' => 'Remita', 'url' => 'https://www.remita.net/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=finance'],
            ['label' => 'Nigeria Inter-Bank Settlement System', 'url' => 'https://nibss-plc.com.ng/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=finance'],
            ['label' => 'Central Bank of Nigeria', 'url' => 'https://www.cbn.gov.ng/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=finance'],
            ['label' => 'Moniepoint', 'url' => 'https://moniepoint.com/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=finance'],
        ],
    ],
    [
        'title' => 'Jobs and Career Development',
        'links' => [
            ['label' => 'Jobberman', 'url' => 'https://www.jobberman.com/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=career'],
            ['label' => 'LinkedIn Jobs', 'url' => 'https://www.linkedin.com/jobs/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=career'],
            ['label' => 'MyJobMag', 'url' => 'https://www.myjobmag.com/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=career'],
            ['label' => 'Hot Nigerian Jobs', 'url' => 'https://www.hotnigerianjobs.com/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=career'],
            ['label' => 'Coursera', 'url' => 'https://www.coursera.org/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=career'],
            ['label' => 'Udemy', 'url' => 'https://www.udemy.com/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=career'],
        ],
    ],
    [
        'title' => 'Travel and Identity Services',
        'links' => [
            ['label' => 'Nigeria Immigration Passport Portal', 'url' => 'https://passport.immigration.gov.ng/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=travel'],
            ['label' => 'Federal Road Safety Corps', 'url' => 'https://frsc.gov.ng/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=travel'],
            ['label' => 'Nigerian Civil Aviation Authority', 'url' => 'https://ncaa.gov.ng/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=travel'],
            ['label' => 'Air Peace', 'url' => 'https://flyairpeace.com/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=travel'],
            ['label' => 'Dana Air', 'url' => 'https://www.flydanaair.com/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=travel'],
            ['label' => 'Nigerian Railway Corporation', 'url' => 'https://nrc.gov.ng/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=travel'],
        ],
    ],
];

render_head('Gateway Portal', 'Mirror Age Concepts provides a single gateway to consulting, technology services, learning resources, and official company documents.');
render_header();
?>
<main>
  <section class="hero-shell">
    <div class="container">
      <div class="hero-panel" data-aos="fade-up">
        <span class="hero-kicker"><i class="fa-solid fa-shield-halved"></i> Official gateway</span>
        <h1 class="hero-title">One trusted home for services, portals, and resources.</h1>
        <p class="hero-copy">Mirror Age Concepts brings together consulting, technology services, and digital learning in one clear gateway for clients, partners, and learners.</p>
        <div class="d-flex flex-wrap gap-3 mt-4">
          <a href="#resources" class="btn btn-light">Explore resources</a>
          <a href="<?= e(base_url('contact.php')) ?>" class="btn btn-outline-light">Talk to our team</a>
        </div>
      </div>
        <div class="metric-grid">
          <div class="metric"><strong>3</strong><span>Core business units under one brand gateway.</span></div>
          <div class="metric"><strong>24h</strong><span>Target response window for partnership and service enquiries.</span></div>
          <div class="metric"><strong>Official</strong><span>Company documents and quick links published from one location.</span></div>
        </div>
      </div>
    </div>
  </section>

  <section class="section-block">
    <div class="container">
      <div class="section-heading" data-aos="fade-up">
        <span class="section-eyebrow">What we do</span>
        <h2>Reliable support across consulting, systems, and learning.</h2>
        <p class="text-body-secondary mb-0">Our public gateway highlights the main services, resources, and destinations visitors need most.</p>
      </div>
      <div class="row g-4 gateway-grid">
        <?php foreach ($services as $service): ?>
          <div class="col-md-4" data-aos="fade-up">
            <article class="feature-card">
              <div class="feature-icon"><i class="<?= e($service['icon']) ?>"></i></div>
              <h3 class="h5"><?= e($service['title']) ?></h3>
              <p class="text-body-secondary mb-0"><?= e($service['body']) ?></p>
            </article>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section id="resources" class="section-block">
    <div class="container">
      <div class="section-heading" data-aos="fade-up">
        <span class="section-eyebrow">Downloads</span>
        <h2>Official documents and public assets.</h2>
        <p class="text-body-secondary mb-0">Access official company documents and public assets from one trusted location.</p>
      </div>
      <div class="row g-4">
        <?php foreach (RESOURCE_LINKS as $resource): ?>
          <div class="col-md-4" data-aos="fade-up">
            <article class="resource-card">
              <span class="badge-soft mb-3"><i class="fa-solid fa-file-arrow-down"></i> Verified file</span>
              <h3 class="h5"><?= e($resource['label']) ?></h3>
              <p class="text-body-secondary">Open the latest public version in a new tab.</p>
              <a class="btn btn-outline-<?= e($resource['variant']) ?>" href="<?= e(app_url($resource['url'])) ?>" target="_blank" rel="noopener noreferrer">Open document</a>
            </article>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="section-block">
    <div class="container">
      <div class="section-heading" data-aos="fade-up">
        <span class="section-eyebrow">Quick links</span>
        <h2>Curated external portals visitors can actually use.</h2>
        <p class="text-body-secondary mb-0">Browse high-value portals by category and move quickly to the services that matter to you.</p>
      </div>
      <div class="gateway-accordion accordion" id="gatewayCategoriesAccordion">
        <?php foreach ($gatewayCategories as $index => $category): ?>
          <?php $panelId = 'gateway-panel-' . $index; ?>
          <?php $headingId = 'gateway-heading-' . $index; ?>
          <article class="accordion-item gateway-dropdown" data-aos="fade-up">
            <h3 class="accordion-header" id="<?= e($headingId) ?>">
              <button
                class="accordion-button<?= $index === 0 ? '' : ' collapsed' ?>"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#<?= e($panelId) ?>"
                aria-expanded="<?= $index === 0 ? 'true' : 'false' ?>"
                aria-controls="<?= e($panelId) ?>"
              >
                <span>
                  <span class="gateway-dropdown-label"><?= e($category['title']) ?></span>
                  <small><?= count($category['links']) ?> links</small>
                </span>
              </button>
            </h3>
            <div
              id="<?= e($panelId) ?>"
              class="accordion-collapse collapse<?= $index === 0 ? ' show' : '' ?>"
              aria-labelledby="<?= e($headingId) ?>"
              data-bs-parent="#gatewayCategoriesAccordion"
            >
              <div class="accordion-body">
                <ul class="list-clean gateway-dropdown-list">
                  <?php foreach ($category['links'] as $link): ?>
                    <li><a class="text-decoration-none" href="<?= e($link['url']) ?>" target="_blank" rel="noopener noreferrer"><i class="fa-solid fa-arrow-up-right-from-square text-primary me-2"></i><?= e($link['label']) ?></a></li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="section-block pb-4">
    <div class="container">
      <div class="row g-4">
        <div class="col-lg-7" data-aos="fade-up">
          <div class="info-card">
            <span class="section-eyebrow">Why choose us</span>
            <h2 class="h3">A clear gateway backed by practical digital expertise.</h2>
            <p class="text-body-secondary">From official documents to service enquiries and gateway access, everything is organized to help visitors move with confidence.</p>
            <div class="d-flex flex-wrap gap-3 mt-3">
              <a href="<?= e(base_url('about.php')) ?>" class="btn btn-primary">About the company</a>
              <a href="<?= e(base_url('contact.php')) ?>" class="btn btn-outline-secondary">Send an enquiry</a>
            </div>
          </div>
        </div>
        <div class="col-lg-5" data-aos="fade-up">
          <div class="contact-card">
            <span class="section-eyebrow">Contact</span>
            <ul class="list-clean">
              <li><i class="fa-solid fa-envelope text-primary me-2"></i><?= e(contact_email()) ?></li>
              <li><i class="fa-solid fa-phone text-primary me-2"></i><?= e(contact_phone_primary()) ?></li>
              <li><i class="fa-solid fa-phone text-primary me-2"></i><?= e(contact_phone_secondary()) ?></li>
              <li><i class="fa-solid fa-location-dot text-primary me-2"></i><?= e(contact_location()) ?></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<?php render_footer();
