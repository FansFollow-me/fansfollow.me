<link href="{{ asset('public/css/core.min.css') }}?v={{$settings->version}}" rel="stylesheet">
<link href="{{ asset('public/admin/bootstrap.min.css') }}?v={{$settings->version}}" rel="stylesheet">
<link href="{{ asset('public/css/bootstrap-icons.css') }}?v={{$settings->version}}" rel="stylesheet">
<link href="{{ asset('public/admin/admin-styles.css') }}?v={{$settings->version}}" rel="stylesheet">
@if (false)
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
  body {
    font-family: 'Inter', system-ui, sans-serif;
    background: linear-gradient(180deg, #050816 0%, #0b1220 42%, #0f172a 100%);
    color: #101828;
  }

  .sidebar,
  .offcanvas-header,
  .offcanvas-body {
    background: rgba(15, 23, 42, 0.88) !important;
  }

  .sidebar {
    border-right: 1px solid rgba(148, 163, 184, 0.12);
    box-shadow: 0 18px 46px rgba(2, 6, 23, 0.24);
  }

  .sidebar .nav-link {
    color: rgba(226, 232, 240, 0.84);
    border-radius: 12px;
    font-weight: 600;
  }

  .sidebar .nav-link.active,
  .sidebar .nav-link:hover {
    background: rgba(59, 130, 246, 0.18);
    color: #ffffff;
  }

  .sidebar .nav-link i {
    color: #2563eb;
  }

  .offcanvas-title img {
    max-width: 150px;
    width: auto !important;
  }

  .topbar,
  .navbar,
  .header,
  .card,
  .modal-content {
    border-color: rgba(15, 23, 42, 0.08);
    border-radius: 14px;
  }

  .card,
  .modal-content {
    box-shadow: 0 12px 36px rgba(15, 23, 42, 0.06);
  }

  .btn-primary,
  .bg-primary {
    background-color: #2563eb !important;
    border-color: #2563eb !important;
  }

  .text-primary {
    color: #2563eb !important;
  }

  .badge.bg-warning,
  .alert-warning {
    background-color: rgba(245, 158, 11, 0.14) !important;
    color: #92400e !important;
  }
</style>
@endif
