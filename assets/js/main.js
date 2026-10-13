document.addEventListener('DOMContentLoaded', function () {

  // Mobile nav toggle
  var toggle = document.querySelector('.nav-toggle');
  var links = document.querySelector('.nav-links');
  if (toggle && links) {
    toggle.addEventListener('click', function () {
      var isOpen = links.classList.toggle('open');
      toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });
  }

  // Mobile: tap "Services" to toggle its dropdown (don't auto-expand, don't navigate)
  var hasDropdown = document.querySelector('.nav-links .has-dropdown');
  if (hasDropdown) {
    var ddLink = hasDropdown.querySelector('a');
    if (ddLink) {
      ddLink.addEventListener('click', function (e) {
        var navToggle = document.querySelector('.nav-toggle');
        var isMobileMenu = navToggle && getComputedStyle(navToggle).display !== 'none';
        if (isMobileMenu) {
          e.preventDefault();
          hasDropdown.classList.toggle('open');
        }
      });
    }
  }

  // Events page tabs (Upcoming / Past)
  var tabButtons = document.querySelectorAll('.tab-btn');
  var panels = document.querySelectorAll('[data-panel]');
  tabButtons.forEach(function (btn) {
    btn.addEventListener('click', function () {
      tabButtons.forEach(function (b) { b.classList.remove('active'); });
      btn.classList.add('active');
      var target = btn.getAttribute('data-target');
      panels.forEach(function (p) {
        p.style.display = (p.getAttribute('data-panel') === target) ? '' : 'none';
      });
    });
  });

  // Booking calendar: disable past dates
  var dateInput = document.querySelector('#preferred_date');
  if (dateInput) {
    var today = new Date().toISOString().split('T')[0];
    dateInput.setAttribute('min', today);
  }

  // FAQ accordion: only one category open at a time
  var faqCats = document.querySelectorAll('.faq-cat');
  faqCats.forEach(function (cat) {
    cat.addEventListener('toggle', function () {
      if (cat.open) {
        faqCats.forEach(function (other) {
          if (other !== cat) { other.open = false; }
        });
      }
    });
  });

  // ---------- Book Appointment popup modal ----------
  var modal = document.getElementById('bookModal');

  if (modal) {
    var path = location.pathname.replace(/\/+$/, '');
    var onContactPage = (path === '/contact') || path.endsWith('/contact');

    var openModal = function () {
      modal.classList.add('open');
      modal.setAttribute('aria-hidden', 'false');
      document.body.style.overflow = 'hidden';
      var firstInput = document.getElementById('bm_name');
      if (firstInput) setTimeout(function () { firstInput.focus(); }, 50);
    };
    var closeModal = function () {
      modal.classList.remove('open');
      modal.setAttribute('aria-hidden', 'true');
      document.body.style.overflow = '';
    };

    // Intercept EVERY "Book Appointment" CTA (any link to contact#booking,
    // or any element whose text is Book an Appointment), except on the Contact page.
    if (!onContactPage) {
      document.addEventListener('click', function (e) {
        var el = e.target.closest('a, button');
        if (!el) return;
        var href = (el.getAttribute('href') || '');
        var text = (el.textContent || '').trim().toLowerCase();
        var isBookCta =
          href.indexOf('contact#booking') !== -1 ||
          text === 'book an appointment' ||
          text === 'book appointment';
        if (isBookCta) {
          e.preventDefault();
          e.stopPropagation();
          openModal();
        }
      }, true);
    }

    // Close handlers
    modal.querySelectorAll('[data-book-close]').forEach(function (el) {
      el.addEventListener('click', closeModal);
    });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && modal.classList.contains('open')) closeModal();
    });

    // AJAX submit
    var form = document.getElementById('bookForm');
    var alertBox = document.getElementById('bookAlert');
    var submitBtn = document.getElementById('bookSubmit');
    if (form) {
      form.addEventListener('submit', function (e) {
        e.preventDefault();
        alertBox.className = 'book-modal-alert';
        alertBox.textContent = '';

        var data = new FormData(form);
        // CSRF token is included via the hidden field already in the form
        var name = (data.get('name') || '').toString().trim();
        var phone = (data.get('phone') || '').toString().trim();

        if (!name || !phone) {
          alertBox.className = 'book-modal-alert show error';
          alertBox.textContent = 'Please enter your name and phone number.';
          return;
        }

        // Disable submit + show progress
        submitBtn.disabled = true;
        var origBtnText = submitBtn.textContent;
        submitBtn.textContent = 'Sending...';

        // Submit to server (saves to DB + emails admin)
        fetch('/book-appointment', { method: 'POST', body: data })
          .then(function (r) { return r.json().catch(function(){ return {success:true}; }); })
          .then(function (res) {
            if (res && res.success === false) {
              alertBox.className = 'book-modal-alert show error';
              alertBox.textContent = res.error || 'Something went wrong. Please try again.';
              submitBtn.disabled = false;
              submitBtn.textContent = origBtnText;
              return;
            }
            // Success — show confirmation, then auto-close
            alertBox.className = 'book-modal-alert show success';
            alertBox.innerHTML =
              "<strong>✓ Submitted successfully!</strong><br><br>" +
              "We have received your enquiry. We will contact you soon to confirm your appointment.<br><br>" +
              "Thank you for reaching out to CARE Family Counselling &amp; Children's Wellness Center!";
            form.reset();
            submitBtn.textContent = origBtnText;
            // Auto-close after 2.5 seconds
            setTimeout(function () {
              closeModal();
              submitBtn.disabled = false;
            }, 2500);
          })
          .catch(function () {
            alertBox.className = 'book-modal-alert show error';
            alertBox.textContent = 'Network error. Please try again or call us at +91 99658 55184.';
            submitBtn.disabled = false;
            submitBtn.textContent = origBtnText;
          });
      });
    }
  }

});
