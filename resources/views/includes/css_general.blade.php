<style>
  :root {
    color-scheme: dark;
    --ffm-text: #e5e7eb;
    --ffm-muted: #94a3b8;
    --ffm-line: rgba(148, 163, 184, 0.14);
    --ffm-accent: #60a5fa;
  }

  html, :root {
    scroll-behavior: auto !important;
    overscroll-behavior: auto;
    overflow-x: hidden;
  }

  body {
    overflow-x: hidden;
    font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    font-weight: 400;
    color: var(--ffm-text);
    background-color: #020617;
    background-image: none;
  }

  /* Font weight scale */
  .fw-regular { font-weight: 400; }
  .fw-medium { font-weight: 500; }
  .fw-semibold { font-weight: 600; }
  .fw-bold { font-weight: 700; }
  .fw-black { font-weight: 900; }

  h1, h2, h3, h4, h5, h6 { font-family: 'Inter', sans-serif; color: var(--ffm-text); }
  h1 { font-weight: 900; }
  h2 { font-weight: 800; }
  h3, h4 { font-weight: 700; }
  h5, h6 { font-weight: 600; }

  a {
    text-decoration: none;
    color: var(--ffm-accent);
  }
  .media-heading a,
  .media-heading {
    color: var(--ffm-text) !important;
  }

  img {
    max-width: 100%;
    height: auto;
  }

  .navbar-brand img,
  .logo {
    max-height: 44px;
    width: auto;
  }

  .btn {
    border-radius: 999px;
    font-weight: 700;
  }

  /* Compensate for fixed-top navbar on logged-in Sponzy pages */
  body > header:has(nav.fixed-top) ~ main {
    padding-top: 95px;
  }
  @media (min-width: 992px) {
    body > header:has(nav.fixed-top) ~ main {
      padding-top: 70px;
    }
  }

  /* Dark theme for mobile navbar collapse */
  @media (max-width: 991.98px) {
    .navbar .navbar-collapse {
      background: #0b0f1a !important;
      padding-top: 1rem !important;
    }
    .navbar .navbar-collapse .navbar-nav .nav-item .nav-link:not(.btn) {
      color: #e2e8f0 !important;
    }
    .navbar .navbar-collapse .close-menu-mobile {
      color: #e2e8f0 !important;
    }
    .navbar .navbar-collapse .search-bar {
      background: rgba(15, 23, 42, 0.8) !important;
      color: #e2e8f0 !important;
      border-color: rgba(148, 163, 184, 0.18) !important;
    }
    .navbar .navbar-collapse .search-bar::placeholder {
      color: #94a3b8 !important;
    }
    .navbar .navbar-collapse .link-menu-mobile {
      color: #e2e8f0 !important;
    }
  }

  /* Fix mobile bottom nav to bottom of screen */
  .menuMobile {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    z-index: 1020;
    background: rgba(15, 23, 42, 0.95) !important;
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border-top: 1px solid rgba(148, 163, 184, 0.12);
    padding-bottom: env(safe-area-inset-bottom, 0);
  }

  /* Hide mobile bottom nav on desktop */
  @media (min-width: 992px) {
    .menuMobile {
      display: none !important;
    }
  }

  /* Bottom nav: ensure page content isn't cut off */
  @media (max-width: 991.98px) {
    main {
      padding-bottom: 60px !important;
    }
  }

  #mobileMenuOverlay {
    position: fixed;
    inset: 0;
    background: rgba(2, 6, 23, 0.58);
    opacity: 0;
    pointer-events: none;
    transition: opacity .2s ease;
    z-index: 1039;
  }

  body.sidebar-overlay #mobileMenuOverlay {
    opacity: 1;
    pointer-events: auto;
  }

  /* Ensure navbar collapse sits above overlay on mobile */
  @media (max-width: 991.98px) {
    #navbarCollapse.show {
      z-index: 10000 !important;
    }
  }

  /* Safety: overlay dismissed on outside click */
  #mobileMenuOverlay { cursor: pointer; }

  @media (min-width: 992px) {
    #mobileMenuOverlay {
      display: none;
    }
  }

  .form-control,
  .custom-select,
  .input-group-text,
  .card,
  .panel,
  .modal-content {
    border-radius: 12px;
  }

  .card,
  .panel,
  .modal-content {
    background: rgba(15, 23, 42, 0.82) !important;
    color: var(--ffm-text) !important;
    border: 1px solid var(--ffm-line) !important;
    box-shadow: 0 12px 36px rgba(15, 23, 42, 0.06);
  }

  .text-muted {
    color: #cbd5e1 !important;
  }

  /* ── Creator name in post cards ── */
  .card-updates h5 a,
  .card-updates .font-montserrat a {
    color: #f1f5f9 !important;
  }
  .card-updates h5 a:hover,
  .card-updates .font-montserrat a:hover {
    color: #fff !important;
  }

  /* ── Post image: maintain aspect ratio ── */
  .img-video-wrap .post-image {
    object-fit: contain !important;
  }
  .post-img-grid {
    position: absolute;
    display: block;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  /* ── Broken image fallback ── */
  .card-updates img,
  .update-media img {
    background: rgba(30, 41, 59, 0.6);
    min-height: 40px;
  }
  .card-updates img:not([src]),
  .card-updates img[src=""] {
    display: none;
  }

  /* ── Locked post grey bar fix ── */
  .content-locked {
    background: rgba(15, 23, 42, 0.82) !important;
    color: #e2e8f0 !important;
  }

  /* ── Post caption text brightness ── */
  .update-text,
  .update-text p,
  .update-text span,
  .update-text div {
    color: #f1f5f9 !important;
  }

  .bg-white {
    background-color: rgba(15,23,42,.82) !important;
    color: #e2e8f0 !important;
  }
  .bg-white img {
    filter: brightness(1.2);
  }

  /* ── Navbar dark theme ── */
  .navbar_background_color,
  nav.navbar {
    background: rgba(15, 23, 42, 0.92) !important;
    backdrop-filter: blur(18px);
    border-bottom: 1px solid rgba(148, 163, 184, 0.12);
  }
  nav.navbar .navbar-brand img { filter: brightness(1.2); }
  nav.navbar .nav-link,
  nav.navbar .icon-navbar {
    color: #e2e8f0 !important;
  }
  nav.navbar .nav-link:hover {
    color: #fb923c !important;
  }
  nav.navbar .search-bar {
    background: rgba(51, 65, 85, 0.6) !important;
    border: 1px solid rgba(148, 163, 184, 0.18) !important;
    color: #e2e8f0 !important;
  }
  nav.navbar .search-bar::placeholder { color: #9ca3af !important; }
  nav.navbar .dropdown-menu {
    background: #151b2c !important;
    border: 1px solid rgba(148, 163, 184, 0.12) !important;
    box-shadow: 0 16px 50px rgba(0, 0, 0, 0.45) !important;
  }
  nav.navbar .dropdown-item {
    color: #e2e8f0 !important;
  }
  nav.navbar .dropdown-item:hover {
    background: rgba(249, 115, 22, 0.14) !important;
    color: #fb923c !important;
  }
  nav.navbar .dropdown-divider {
    border-color: rgba(148, 163, 184, 0.12) !important;
  }
  .icon-navbar { color: #94a3b8; }

  /* ── Left sidebar (menu-left-home) ── */
  .menu-left-home {
    background: rgba(15, 23, 42, 0.84);
    border: 1px solid rgba(148, 163, 184, 0.12);
    border-radius: 16px;
    padding: 0.75rem 0;
    box-shadow: 0 12px 36px rgba(0, 0, 0, 0.18);
    list-style: none;
    margin: 0;
    max-height: calc(100vh - 120px);
    overflow-y: auto;
    z-index: auto !important;
  }

  /* ── Right sidebar: prevent footer from hiding behind fixed bottom nav ── */
  .col-md-4 .sticky-top.d-lg-block {
    padding-bottom: 70px !important;
    z-index: auto !important;
  }
  .menu-left-home li a {
    display: flex;
    align-items: center;
    gap: 0.6rem;
    padding: 0.65rem 1rem;
    color: rgba(226, 232, 240, 0.82);
    font-weight: 600;
    font-size: 0.9rem;
    border-radius: 10px;
    margin: 0 0.4rem;
    transition: background 0.16s, color 0.16s;
  }
  .menu-left-home li a:hover,
  .menu-left-home li a.active {
    background: rgba(249, 115, 22, 0.14);
    color: #fb923c;
  }
  .menu-left-home li a i {
    font-size: 1rem;
    width: 1.2rem;
    text-align: center;
  }

  /* ── Notification cards dark theme ── */
  .notifications-page .card,
  .notifications-page .list-group-item,
  .card-notification,
  .card-settings,
  .card.shadow-sm,
  .list-group-item {
    background: rgba(15, 23, 42, 0.82) !important;
    color: #e2e8f0 !important;
    border-color: rgba(148, 163, 184, 0.12) !important;
  }
  .notifications-page .card:hover,
  .list-group-item:hover {
    border-color: rgba(249, 115, 22, 0.3) !important;
  }
  .list-group-item.active {
    background: rgba(59, 130, 246, 0.18) !important;
    color: #ffffff !important;
    border-color: rgba(96, 165, 250, 0.48) !important;
  }

  /* ── General dark overrides for Sponzy pages ── */
  .section, .section-sm { background: transparent; }
  .jumbotron { background: transparent; }
  .shadow-custom {
    box-shadow: 0 4px 24px rgba(0, 0, 0, 0.22) !important;
  }
  .link-scroll { background: rgba(15, 23, 42, 0.92) !important; }

  /* ── Form controls dark theme ── */
  .form-control,
  .form-select,
  select,
  input[type="text"],
  input[type="email"],
  input[type="password"],
  input[type="number"],
  input[type="date"],
  textarea {
    background: rgba(15, 23, 42, 0.6) !important;
    border: 1px solid rgba(148, 163, 184, 0.18) !important;
    color: #e2e8f0 !important;
  }
  .form-control:focus,
  .form-select:focus,
  input:focus,
  textarea:focus {
    border-color: #f97316 !important;
    box-shadow: 0 0 0 0.2rem rgba(249, 115, 22, 0.15) !important;
  }
  .form-control::placeholder,
  input::placeholder,
  textarea::placeholder {
    color: #64748b !important;
  }
  .form-label,
  label {
    color: #e2e8f0 !important;
  }
  .input-group-text {
    background: rgba(15, 23, 42, 0.8) !important;
    border: 1px solid rgba(148, 163, 184, 0.18) !important;
    color: #94a3b8 !important;
  }

  /* ── Buttons ── */
  .btn-primary,
  .btn-success {
    background: linear-gradient(135deg, #f97316, #9333ea) !important;
    border: none !important;
    color: #fff !important;
    font-weight: 700 !important;
  }
  .btn-primary:hover,
  .btn-success:hover {
    filter: brightness(1.1);
    box-shadow: 0 8px 20px rgba(249, 115, 22, 0.3);
  }
  .btn-danger { color: #fff !important; }

  /* ── Tables dark theme ── */
  .table {
    color: #e2e8f0 !important;
  }
  .table thead th {
    border-color: rgba(148, 163, 184, 0.12) !important;
    color: #94a3b8 !important;
  }
  .table td {
    border-color: rgba(148, 163, 184, 0.08) !important;
  }

  /* ── Messages page layout fix ── */
  .section-msg {
    width: 100vw !important;
    max-width: 100vw !important;
    height: 100vh !important;
    height: 100dvh !important;
    padding-top: 0 !important;
    top: 0 !important;
  }
  .section-msg .container {
    height: 100% !important;
  }
  .section-msg .row {
    height: 100% !important;
  }
  .section-msg .card > .content,
  .section-msg #contentDIV {
    flex: 1 1 auto;
    overflow-y: auto;
    min-height: 0;
  }
  .section-msg .card-footer {
    flex-shrink: 0;
    position: relative;
    z-index: 2;
  }
  @media (min-width: 768px) {
    .section-msg .container {
      max-width: 100% !important;
      width: 100% !important;
    }
    .section-msg .wrapper-msg-inbox {
      order: 0 !important;
    }
    .section-msg .first {
      order: 0 !important;
    }
    .section-msg .col-md-8 {
      position: relative;
      flex: 1 1 0%;
    }
    .section-msg .col-md-8 .card {
      display: flex;
      flex-direction: column;
      position: absolute;
      top: 0;
      bottom: 0;
      left: 0;
      right: 0;
      overflow: hidden;
    }
  }

  /* ── Links ── */
  a.link-border { color: #60a5fa; }
  a.link-border:hover { color: #93c5fd; }

  /* ── Video player: poster(1) < logo(2) < video(3) < play-btn(4) < ctrl-bar(5) ── */
  .video-js .vjs-logo {
    max-width: 80px !important;
    max-height: 40px !important;
    width: auto !important;
    height: auto !important;
    bottom: 10px !important;
    right: 10px !important;
    left: auto !important;
    top: auto !important;
    opacity: 0.6 !important;
    z-index: 2 !important;
    pointer-events: none !important;
  }
  .video-js .vjs-logo img {
    max-width: 100% !important;
    max-height: 100% !important;
    width: auto !important;
    height: auto !important;
  }
  .video-js .vjs-poster { z-index: 1 !important; }
  .video-js video.vjs-tech { z-index: 3 !important; }
  .video-js .vjs-big-play-button { z-index: 4 !important; }
  .video-js .vjs-control-bar { z-index: 5 !important; }
  .video-js.vjs-fullscreen .vjs-logo,
  .vjs-fullscreen .vjs-logo {
    max-width: 100px !important;
    max-height: 50px !important;
    opacity: 0.4 !important;
  }

  /* ── Messaging emoji dropdown fix ── */
  .section-msg .dropdown-emoji {
    position: absolute !important;
    bottom: calc(100% + 8px) !important;
    left: 0 !important;
    right: auto !important;
    top: auto !important;
    transform: none !important;
    z-index: 1050 !important;
    max-height: 300px !important;
    overflow-y: auto !important;
    background: #1e293b !important;
    border: 1px solid rgba(148,163,184,.18) !important;
    border-radius: 12px !important;
    box-shadow: 0 16px 50px rgba(0,0,0,.45) !important;
    padding: .5rem !important;
    width: 300px !important;
  }
  .section-msg .dropdown-emoji.show {
    display: block !important;
  }

  /* ── Conversation list text contrast ── */
  .msg-inbox .text-dark {
    color: #94a3b8 !important;
  }
  .msg-inbox .timeAgo {
    color: #94a3b8 !important;
  }
  .msg-inbox .media-heading {
    color: #e2e8f0 !important;
  }
  .msg-inbox .text-muted {
    color: #94a3b8 !important;
  }

  /* ── Message bubbles dark theme ── */
  .message.bg-light {
    background: rgba(30, 41, 59, 0.9) !important;
    color: #e2e8f0 !important;
  }
  .container-msg .media-body,
  .container-msg .text-word-break {
    color: #e2e8f0 !important;
  }

  /* ── Messages page cards ── */
  .section-msg .col-md-8 .card {
    background: rgba(15, 23, 42, 0.95) !important;
    border-left: 1px solid rgba(148, 163, 184, 0.12) !important;
  }
  .section-msg .card-header.bg-white,
  .section-msg .card-footer.bg-white {
    background: rgba(15, 23, 42, 0.95) !important;
    color: #e2e8f0 !important;
  }
  .section-msg .card-header a,
  .section-msg .card-footer a {
    color: #e2e8f0 !important;
  }
  .section-msg .card-header h6 a {
    color: #e2e8f0 !important;
  }

  /* ── Posts table dark theme ── */
  .table-striped > tbody > tr:nth-of-type(odd) {
    background-color: rgba(30, 41, 59, 0.3) !important;
  }
  .table td, .table th {
    color: #e2e8f0 !important;
    border-color: rgba(255, 255, 255, 0.08) !important;
  }
  .table thead th {
    color: #94a3b8 !important;
    border-bottom-color: rgba(255, 255, 255, 0.15) !important;
  }

  /* ── Global mobile section spacing ── */
  @media (max-width: 767.98px) {
    .section, .section-sm { padding: 1.5rem 0 !important; }
    .section-dark { padding: 1.25rem 0 !important; }
    .section-gradient { padding: 2rem 0 !important; }
    .section-photo { padding: 1.5rem 0 !important; }
    .section-dark h2 { margin-bottom: .25rem !important; }
    .section-sub { margin-bottom: 1.5rem !important; }
    .contact-options { gap: .75rem !important; margin-bottom: 1.5rem !important; }
    .support-options { gap: .75rem !important; margin-bottom: 1.5rem !important; }
    .form-card { padding: 1.25rem !important; }
    .contact-section { padding: 2rem 0 !important; }
  }

  /* ══════════════════════════════════════════════════════════
     Trix toolbar — complete dark-theme rebuild
     Overrides core.min.css light-theme defaults.
     Icons: core.min.css provides bold/link/code/number-list;
            remaining 10 are defined here.
     All use black SVGs + filter:invert(1) for the dark theme.
     ══════════════════════════════════════════════════════════ */

  /* ── Mobile menu: fix height + remove overlay that blocks taps ── */
  @media (max-width: 991.98px) {
    .navbar-collapse.navbar-mobile.collapse.show {
      height: 100vh !important;
    }
  }
  body.sidebar-overlay #mobileMenuOverlay {
    display: none !important;
  }

  /* ── 1. Container: prevent toolbar from forcing parent wider ── */
  .media-body:has(trix-toolbar) {
    min-width: 0 !important;
    max-width: 100% !important;
    overflow-x: visible !important;
  }

  /* ── 2. Toolbar shell ── */
  trix-toolbar {
    display: block !important;
    position: relative !important;
    max-width: 100% !important;
    overflow: hidden !important;
    contain: paint !important;
  }

  /* ── 3. Button row: single line, even spacing ── */
  trix-toolbar .trix-button-row {
    display: flex !important;
    flex-wrap: nowrap !important;
    justify-content: flex-start !important;
    min-width: 0 !important;
    max-width: 100% !important;
    width: 100% !important;
    overflow: hidden !important;
    gap: 6px !important;
    float: none !important;
  }
  trix-toolbar .trix-button {
    float: none !important;
  }
  /* Mobile: allow horizontal scroll for larger tap targets */
  @media (max-width: 1024.98px) {
    trix-toolbar {
      overflow: visible !important;
    }
    trix-toolbar .trix-button-row {
      overflow-x: auto !important;
      overflow-y: hidden !important;
      -webkit-overflow-scrolling: touch !important;
      scrollbar-width: none !important;
    }
    trix-toolbar .trix-button-row::-webkit-scrollbar { display: none !important; }
  }

  /* ── 4. Button groups ── */
  trix-toolbar .trix-button-group {
    flex-shrink: 0 !important;
    min-width: 0 !important;
    border: none !important;
    box-shadow: inset 0 0 0 1px rgba(148,163,184,.18) !important;
    border-radius: 6px !important;
    overflow: hidden !important;
    margin: 0 !important;
  }
  trix-toolbar .trix-button-group-spacer {
    display: none !important;
  }

  /* ── 5. Individual buttons: dark theme ── */
  trix-toolbar .trix-button {
    flex-shrink: 0 !important;
    color: rgba(229,231,235,.7) !important;
    background: transparent !important;
    border-color: rgba(148,163,184,.12) !important;
    transition: background .15s, color .15s !important;
  }
  trix-toolbar .trix-button--icon {
    max-width: none !important;
    text-indent: -9999px !important;
  }

  /* ── 5b. Responsive button widths ── */
  /* Desktop (≥1025px): all 14 fit without scroll */
  trix-toolbar .trix-button--icon {
    width: 30px !important;
  }
  trix-toolbar .trix-button {
    padding: 0 5px !important;
  }
  /* Mobile/tablet (≤1024px): larger buttons, scroll to reach all */
  @media (max-width: 1024.98px) {
    trix-toolbar .trix-button--icon {
      width: 36px !important;
    }
    trix-toolbar .trix-button {
      padding: 0 4px !important;
      font-size: 14px !important;
    }
  }
  trix-toolbar .trix-button:hover {
    background: rgba(148,163,184,.12) !important;
    color: #e5e7eb !important;
  }
  trix-toolbar .trix-button.trix-active {
    background: rgba(249,115,22,.18) !important;
    color: #f97316 !important;
  }
  trix-toolbar .trix-button:disabled {
    color: rgba(148,163,184,.25) !important;
  }

  /* ── 6. Icon base: invert black SVGs → white ── */
  trix-toolbar .trix-button--icon::before {
    filter: invert(1) !important;
    opacity: .85 !important;
  }
  trix-toolbar .trix-button--icon.trix-active::before {
    filter: invert(1) !important;
    opacity: 1 !important;
  }
  trix-toolbar .trix-button--icon:disabled::before {
    filter: invert(1) !important;
    opacity: .25 !important;
  }

  /* ── 7. Icons missing from core.min.css ── */
  trix-toolbar .trix-button--icon-italic::before {
    background-image: url("data:image/svg+xml,%3Csvg width='24' height='24' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M10 4h4l-1 16h-4l1-16z' fill='%23000'/%3E%3C/svg%3E") !important;
  }
  trix-toolbar .trix-button--icon-strike::before {
    background-image: url("data:image/svg+xml,%3Csvg width='24' height='24' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M3 12h18M10 4h4l-1 16h-4l1-16z' stroke='%23000' stroke-width='2'/%3E%3C/svg%3E") !important;
  }
  trix-toolbar .trix-button--icon-heading-1::before {
    content: "H1" !important;
    font-size: 13px !important;
    font-weight: 700 !important;
    color: rgba(229,231,235,.85) !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    background: none !important;
    background-image: none !important;
    text-indent: 0 !important;
    filter: none !important;
  }
  trix-toolbar .trix-button--icon-quote::before {
    background-image: url("data:image/svg+xml,%3Csvg width='24' height='24' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M4 10h4v8H4v-8zm10 0h4v8h-4v-8z' fill='%23000'/%3E%3C/svg%3E") !important;
  }
  trix-toolbar .trix-button--icon-bullet-list::before {
    background-image: url("data:image/svg+xml,%3Csvg width='24' height='24' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Ccircle cx='4' cy='6' r='2' fill='%23000'/%3E%3Ccircle cx='4' cy='12' r='2' fill='%23000'/%3E%3Ccircle cx='4' cy='18' r='2' fill='%23000'/%3E%3Cpath d='M9 6h11M9 12h11M9 18h11' stroke='%23000' stroke-width='2'/%3E%3C/svg%3E") !important;
  }
  trix-toolbar .trix-button--icon-increase-nesting-level::before {
    background-image: url("data:image/svg+xml,%3Csvg width='24' height='24' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M4 6h16M8 12h12M12 18h8' stroke='%23000' stroke-width='2'/%3E%3C/svg%3E") !important;
  }
  trix-toolbar .trix-button--icon-decrease-nesting-level::before {
    background-image: url("data:image/svg+xml,%3Csvg width='24' height='24' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M4 6h16M4 12h12M4 18h8' stroke='%23000' stroke-width='2'/%3E%3C/svg%3E") !important;
  }
  trix-toolbar .trix-button--icon-attach::before {
    background-image: url("data:image/svg+xml,%3Csvg width='24' height='24' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M21.44 11.05l-9.19 9.19a6 6 0 01-8.49-8.49l9.19-9.19a4 4 0 015.66 5.66l-9.2 9.19a2 2 0 01-2.83-2.83l8.49-8.48' stroke='%23000' stroke-width='2' stroke-linecap='round'/%3E%3C/svg%3E") !important;
  }
  trix-toolbar .trix-button--icon-undo::before {
    background-image: url("data:image/svg+xml,%3Csvg width='24' height='24' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M3 10h10a5 5 0 010 10H3' stroke='%23000' stroke-width='2' stroke-linecap='round'/%3E%3Cpath d='M7 6L3 10l4 4' stroke='%23000' stroke-width='2' stroke-linecap='round'/%3E%3C/svg%3E") !important;
  }
  trix-toolbar .trix-button--icon-redo::before {
    background-image: url("data:image/svg+xml,%3Csvg width='24' height='24' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M21 10H11a5 5 0 000 10h10' stroke='%23000' stroke-width='2' stroke-linecap='round'/%3E%3Cpath d='M17 6l4 4-4 4' stroke='%23000' stroke-width='2' stroke-linecap='round'/%3E%3C/svg%3E") !important;
  }

  /* ── 8. Link dialog: fixed position to escape toolbar overflow ── */
  trix-toolbar .trix-dialog {
    position: fixed !important;
    z-index: 100 !important;
    max-width: 400px !important;
    min-width: 280px !important;
    background: #1e293b !important;
    border: 1px solid rgba(148,163,184,.18) !important;
    border-radius: 10px !important;
    box-shadow: 0 8px 30px rgba(0,0,0,.4) !important;
    padding: 12px !important;
  }
  trix-toolbar .trix-dialog input,
  trix-toolbar .trix-input--dialog {
    background: rgba(15,23,42,.8) !important;
    color: #e2e8f0 !important;
    border: 1px solid rgba(148,163,184,.18) !important;
    border-radius: 6px !important;
    padding: 8px 10px !important;
    font-size: .875rem !important;
  }
  trix-toolbar .trix-dialog button,
  trix-toolbar .trix-button--dialog {
    background: linear-gradient(135deg, #f97316, #a855f7) !important;
    color: #fff !important;
    border: none !important;
    border-radius: 6px !important;
    padding: 8px 16px !important;
    font-weight: 600 !important;
    font-size: .875rem !important;
  }

  /* ── 9. Mobile: dialog fills bottom ── */
  @media (max-width: 767.98px) {
    trix-toolbar .trix-dialog {
      position: fixed !important;
      top: auto !important;
      bottom: 0 !important;
      left: 0 !important;
      right: 0 !important;
      max-width: 100% !important;
      border-radius: 14px 14px 0 0 !important;
      padding: 16px !important;
    }
  }

  /* ── Post creation toolbar mobile fix ── */
  @media (max-width: 767.98px) {
    /* Bottom icon row (image, tag, price, lock, live, Aa) */
    .card-footer .btn-upload,
    .card-footer .btn-tooltip-form {
      padding: .5rem .65rem !important;
      min-width: 44px !important;
      min-height: 44px !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      flex-shrink: 0;
    }
    .card-footer .f-size-25 {
      font-size: 20px !important;
    }
    .card-footer > .justify-content-between {
      display: flex !important;
      flex-wrap: wrap !important;
      gap: .5rem !important;
    }
    .card-footer > .justify-content-between > div {
      display: flex !important;
      flex-wrap: wrap !important;
      gap: .35rem !important;
      align-items: center !important;
      width: 100% !important;
    }
    .card-footer .w-100-mobile {
      width: 100% !important;
      margin-top: .5rem;
    }
    .card-footer #the-count {
      float: none !important;
      margin: .5rem 0 !important;
      width: 100% !important;
    }
    /* Reposition stray elements on mobile to prevent overlap */
    .Category-onder.position-absolute { position: relative !important; top: auto !important; right: auto !important; display: inline-block; }
    .dropdown-cat.position-absolute { position: relative !important; top: auto !important; right: auto !important; }
    .tag_cat_post { display: none !important; }
    .triggerEmoji { position: static !important; right: auto !important; top: auto !important; }
  }
</style>
