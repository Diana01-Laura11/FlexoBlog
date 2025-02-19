<div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
  <div class="layout-container">
    <!-- Navbar -->

    <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
      <div class="container-xxl">
        <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
          <a href="{{ route('dashboard') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                    {{-- <link rel="icon" type="image/x-icon" href="../../assets/img/favicon/blogIco.png" /> --}}
                    <img src="../../assets/img/favicon/blogIco.png" alt="Logo" width="32" height="auto" />
                    {{-- <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                  fill="#7367F0" />
                <path
                  opacity="0.06"
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z"
                  fill="#161616" />
                <path
                  opacity="0.06"
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z"
                  fill="#161616" />
                <path
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                  fill="#7367F0" />
              </svg> --}}
            </span>
            <span class="app-brand-text demo menu-text fw-bold">Flexo Blog</span>
          </a>

          <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-xl-none">
            <i class="ti ti-x ti-md align-middle"></i>
          </a>
        </div>

        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
          <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="ti ti-menu-2 ti-md"></i>
          </a>
        </div>

        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
          <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- Search -->
            <li class="nav-item navbar-search-wrapper">
              <a
                class="nav-link btn btn-text-secondary btn-icon rounded-pill search-toggler"
                href="javascript:void(0);">
                <i class="ti ti-search ti-md"></i>
              </a>
            </li>
            <!-- /Search -->

            <!-- Language -->
            <li class="nav-item dropdown-language dropdown">
              <a
                class="nav-link btn btn-text-secondary btn-icon rounded-pill dropdown-toggle hide-arrow"
                href="javascript:void(0);"
                data-bs-toggle="dropdown">
                <i class="ti ti-language rounded-circle ti-md"></i>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li>
                  <a class="dropdown-item" href="javascript:void(0);" data-language="en" data-text-direction="ltr">
                    <span>English</span>
                  </a>
                </li>
                <li>
                  <a class="dropdown-item" href="javascript:void(0);" data-language="fr" data-text-direction="ltr">
                    <span>French</span>
                  </a>
                </li>
                <li>
                  <a class="dropdown-item" href="javascript:void(0);" data-language="ar" data-text-direction="rtl">
                    <span>Arabic</span>
                  </a>
                </li>
                <li>
                  <a class="dropdown-item" href="javascript:void(0);" data-language="de" data-text-direction="ltr">
                    <span>German</span>
                  </a>
                </li>
              </ul>
            </li>
            <!--/ Language -->

            <!-- Style Switcher -->
            <li class="nav-item dropdown-style-switcher dropdown">
              <a
                class="nav-link btn btn-text-secondary btn-icon rounded-pill dropdown-toggle hide-arrow"
                href="javascript:void(0);"
                data-bs-toggle="dropdown">
                <i class="ti ti-md"></i>
              </a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
                <li>
                  <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                    <span class="align-middle"><i class="ti ti-sun ti-md me-3"></i>Light</span>
                  </a>
                </li>
                <li>
                  <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                    <span class="align-middle"><i class="ti ti-moon-stars ti-md me-3"></i>Dark</span>
                  </a>
                </li>
                <li>
                  <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                    <span class="align-middle"><i class="ti ti-device-desktop-analytics ti-md me-3"></i>System</span>
                  </a>
                </li>
              </ul>
            </li>
            <!-- / Style Switcher-->

            <!-- Quick links  -->
            <li class="nav-item dropdown-shortcuts navbar-dropdown dropdown">
              <a
                class="nav-link btn btn-text-secondary btn-icon rounded-pill btn-icon dropdown-toggle hide-arrow"
                href="javascript:void(0);"
                data-bs-toggle="dropdown"
                data-bs-auto-close="outside"
                aria-expanded="false">
                <i class="ti ti-layout-grid-add ti-md"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-end p-0">
                <div class="dropdown-menu-header border-bottom">
                  <div class="dropdown-header d-flex align-items-center py-3">
                    <h6 class="mb-0 me-auto">Shortcuts</h6>
                    <a
                      href="javascript:void(0)"
                      class="btn btn-text-secondary rounded-pill btn-icon dropdown-shortcuts-add"
                      data-bs-toggle="tooltip"
                      data-bs-placement="top"
                      title="Add shortcuts"><i class="ti ti-plus text-heading"></i></a>
                  </div>
                </div>
                <div class="dropdown-shortcuts-list scrollable-container">
                  <div class="row row-bordered overflow-visible g-0">
                    <div class="dropdown-shortcuts-item col">
                      <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                        <i class="ti ti-calendar ti-26px text-heading"></i>
                      </span>
                      <a href="app-calendar.html" class="stretched-link">Calendar</a>
                      <small>Appointments</small>
                    </div>
                    <div class="dropdown-shortcuts-item col">
                      <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                        <i class="ti ti-file-dollar ti-26px text-heading"></i>
                      </span>
                      <a href="app-invoice-list.html" class="stretched-link">Invoice App</a>
                      <small>Manage Accounts</small>
                    </div>
                  </div>
                  <div class="row row-bordered overflow-visible g-0">
                    <div class="dropdown-shortcuts-item col">
                      <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                        <i class="ti ti-user ti-26px text-heading"></i>
                      </span>
                      <a href="app-user-list.html" class="stretched-link">User App</a>
                      <small>Manage Users</small>
                    </div>
                    <div class="dropdown-shortcuts-item col">
                      <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                        <i class="ti ti-users ti-26px text-heading"></i>
                      </span>
                      <a href="app-access-roles.html" class="stretched-link">Role Management</a>
                      <small>Permission</small>
                    </div>
                  </div>
                  <div class="row row-bordered overflow-visible g-0">
                    <div class="dropdown-shortcuts-item col">
                      <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                        <i class="ti ti-device-desktop-analytics ti-26px text-heading"></i>
                      </span>
                      <a href="index.html" class="stretched-link">Dashboard</a>
                      <small>User Dashboard</small>
                    </div>
                    <div class="dropdown-shortcuts-item col">
                      <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                        <i class="ti ti-settings ti-26px text-heading"></i>
                      </span>
                      <a href="pages-account-settings-account.html" class="stretched-link">Setting</a>
                      <small>Account Settings</small>
                    </div>
                  </div>
                  <div class="row row-bordered overflow-visible g-0">
                    <div class="dropdown-shortcuts-item col">
                      <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                        <i class="ti ti-help ti-26px text-heading"></i>
                      </span>
                      <a href="pages-faq.html" class="stretched-link">FAQs</a>
                      <small>FAQs & Articles</small>
                    </div>
                    <div class="dropdown-shortcuts-item col">
                      <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                        <i class="ti ti-square ti-26px text-heading"></i>
                      </span>
                      <a href="modal-examples.html" class="stretched-link">Modals</a>
                      <small>Useful Popups</small>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            <!-- Quick links -->

            <!-- Notification -->
            <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-2">
              <a
                class="nav-link btn btn-text-secondary btn-icon rounded-pill dropdown-toggle hide-arrow"
                href="javascript:void(0);"
                data-bs-toggle="dropdown"
                data-bs-auto-close="outside"
                aria-expanded="false">
                <span class="position-relative">
                  <i class="ti ti-bell ti-md"></i>
                  <span class="badge rounded-pill bg-danger badge-dot badge-notifications border"></span>
                </span>
              </a>
              <ul class="dropdown-menu dropdown-menu-end p-0">
                <li class="dropdown-menu-header border-bottom">
                  <div class="dropdown-header d-flex align-items-center py-3">
                    <h6 class="mb-0 me-auto">Notification</h6>
                    <div class="d-flex align-items-center h6 mb-0">
                      <span class="badge bg-label-primary me-2">8 New</span>
                      <a
                        href="javascript:void(0)"
                        class="btn btn-text-secondary rounded-pill btn-icon dropdown-notifications-all"
                        data-bs-toggle="tooltip"
                        data-bs-placement="top"
                        title="Mark all as read"><i class="ti ti-mail-opened text-heading"></i></a>
                    </div>
                  </div>
                </li>
                <li class="dropdown-notifications-list scrollable-container">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item list-group-item-action dropdown-notifications-item">
                      <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                          <div class="avatar">
                            <img src="../../assets/img/avatars/1.png" alt class="rounded-circle" />
                          </div>
                        </div>
                        <div class="flex-grow-1">
                          <h6 class="small mb-1">Congratulation Lettie 🎉</h6>
                          <small class="mb-1 d-block text-body">Won the monthly best seller gold badge</small>
                          <small class="text-muted">1h ago</small>
                        </div>
                        <div class="flex-shrink-0 dropdown-notifications-actions">
                          <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                          <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="ti ti-x"></span></a>
                        </div>
                      </div>
                    </li>
                    <li class="list-group-item list-group-item-action dropdown-notifications-item">
                      <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                          <div class="avatar">
                            <span class="avatar-initial rounded-circle bg-label-danger">CF</span>
                          </div>
                        </div>
                        <div class="flex-grow-1">
                          <h6 class="mb-1 small">Charles Franklin</h6>
                          <small class="mb-1 d-block text-body">Accepted your connection</small>
                          <small class="text-muted">12hr ago</small>
                        </div>
                        <div class="flex-shrink-0 dropdown-notifications-actions">
                          <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                          <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="ti ti-x"></span></a>
                        </div>
                      </div>
                    </li>
                    <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                      <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                          <div class="avatar">
                            <img src="../../assets/img/avatars/2.png" alt class="rounded-circle" />
                          </div>
                        </div>
                        <div class="flex-grow-1">
                          <h6 class="mb-1 small">New Message ✉️</h6>
                          <small class="mb-1 d-block text-body">You have new message from Natalie</small>
                          <small class="text-muted">1h ago</small>
                        </div>
                        <div class="flex-shrink-0 dropdown-notifications-actions">
                          <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                          <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="ti ti-x"></span></a>
                        </div>
                      </div>
                    </li>
                    <li class="list-group-item list-group-item-action dropdown-notifications-item">
                      <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                          <div class="avatar">
                            <span class="avatar-initial rounded-circle bg-label-success"><i class="ti ti-shopping-cart"></i></span>
                          </div>
                        </div>
                        <div class="flex-grow-1">
                          <h6 class="mb-1 small">Whoo! You have new order 🛒</h6>
                          <small class="mb-1 d-block text-body">ACME Inc. made new order $1,154</small>
                          <small class="text-muted">1 day ago</small>
                        </div>
                        <div class="flex-shrink-0 dropdown-notifications-actions">
                          <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                          <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="ti ti-x"></span></a>
                        </div>
                      </div>
                    </li>
                    <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                      <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                          <div class="avatar">
                            <img src="../../assets/img/avatars/9.png" alt class="rounded-circle" />
                          </div>
                        </div>
                        <div class="flex-grow-1">
                          <h6 class="mb-1 small">Application has been approved 🚀</h6>
                          <small class="mb-1 d-block text-body">Your ABC project application has been approved.</small>
                          <small class="text-muted">2 days ago</small>
                        </div>
                        <div class="flex-shrink-0 dropdown-notifications-actions">
                          <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                          <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="ti ti-x"></span></a>
                        </div>
                      </div>
                    </li>
                    <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                      <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                          <div class="avatar">
                            <span class="avatar-initial rounded-circle bg-label-success"><i class="ti ti-chart-pie"></i></span>
                          </div>
                        </div>
                        <div class="flex-grow-1">
                          <h6 class="mb-1 small">Monthly report is generated</h6>
                          <small class="mb-1 d-block text-body">July monthly financial report is generated </small>
                          <small class="text-muted">3 days ago</small>
                        </div>
                        <div class="flex-shrink-0 dropdown-notifications-actions">
                          <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                          <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="ti ti-x"></span></a>
                        </div>
                      </div>
                    </li>
                    <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                      <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                          <div class="avatar">
                            <img src="../../assets/img/avatars/5.png" alt class="rounded-circle" />
                          </div>
                        </div>
                        <div class="flex-grow-1">
                          <h6 class="mb-1 small">Send connection request</h6>
                          <small class="mb-1 d-block text-body">Peter sent you connection request</small>
                          <small class="text-muted">4 days ago</small>
                        </div>
                        <div class="flex-shrink-0 dropdown-notifications-actions">
                          <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                          <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="ti ti-x"></span></a>
                        </div>
                      </div>
                    </li>
                    <li class="list-group-item list-group-item-action dropdown-notifications-item">
                      <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                          <div class="avatar">
                            <img src="../../assets/img/avatars/6.png" alt class="rounded-circle" />
                          </div>
                        </div>
                        <div class="flex-grow-1">
                          <h6 class="mb-1 small">New message from Jane</h6>
                          <small class="mb-1 d-block text-body">Your have new message from Jane</small>
                          <small class="text-muted">5 days ago</small>
                        </div>
                        <div class="flex-shrink-0 dropdown-notifications-actions">
                          <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                          <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="ti ti-x"></span></a>
                        </div>
                      </div>
                    </li>
                    <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                      <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                          <div class="avatar">
                            <span class="avatar-initial rounded-circle bg-label-warning"><i class="ti ti-alert-triangle"></i></span>
                          </div>
                        </div>
                        <div class="flex-grow-1">
                          <h6 class="mb-1 small">CPU is running high</h6>
                          <small class="mb-1 d-block text-body">CPU Utilization Percent is currently at 88.63%,</small>
                          <small class="text-muted">5 days ago</small>
                        </div>
                        <div class="flex-shrink-0 dropdown-notifications-actions">
                          <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                          <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="ti ti-x"></span></a>
                        </div>
                      </div>
                    </li>
                  </ul>
                </li>
                <li class="border-top">
                  <div class="d-grid p-4">
                    <a class="btn btn-primary btn-sm d-flex" href="javascript:void(0);">
                      <small class="align-middle">View all notifications</small>
                    </a>
                  </div>
                </li>
              </ul>
            </li>
            <!--/ Notification -->

            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
              <a
                class="nav-link dropdown-toggle hide-arrow p-0"
                href="javascript:void(0);"
                data-bs-toggle="dropdown">
                <div class="avatar avatar-online">
                  <img src="../../assets/img/avatars/1.png" alt class="rounded-circle" />
                </div>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li>
                  <a class="dropdown-item mt-0" href="pages-account-settings-account.html">
                    <div class="d-flex align-items-center">
                      <div class="flex-shrink-0 me-2">
                        <div class="avatar avatar-online">
                          <img src="../../assets/img/avatars/1.png" alt class="rounded-circle" />
                        </div>
                      </div>
                      <!--Muestra la informacio del usuario y podemos colocar tambien que rol tiene -->
                      <div class="flex-grow-1">
                        <h6 class="mb-0">Nombre : "{{ Auth::user()->name }}"</h6>
                        <h6 class="mb-0">Correo : "{{ Auth::user()->email }}"</h6>
                        <h6 class="mb-0">Rol : "{{ Auth::check() && Auth::user()->role ? Auth::user()->role->name : 'Invitado' }}"</h6>
                        <h6 class="mb-0">Permisos : "{{ Auth::check() && Auth::user()->role ? Auth::user()->role->description : 'Sin Permisos, espera al admin' }}"</h6>
                        <h6 class="mb-0">Cliente ID: "{{ Auth::check() && Auth::user()->customers->isNotEmpty() ? Auth::user()->customers->first()->id : 'Sin Cliente' }}"</h6>
                        <h6 class="mb-0">Cliente: "{{ Auth::check() && Auth::user()->customers->isNotEmpty() ? Auth::user()->customers->first()->business_name : 'Sin Cliente' }}"</h6>

                      
                      
                        {{-- <h6 class="mb-0">Rol : "{{ Auth::user()->role->name }}"</h6> --}}
                      </div>
                    </div>
                  </a>
                </li>
                <li>
                  <div class="dropdown-divider my-1 mx-n2"></div>
                </li>
                <li>
                  {{-- <a class="dropdown-item" href="pages-profile-user.html"> --}}
                    {{-- <a class="dropdown-item" href="{{ route('roles.index') }}"><!--Esto es olo pruebas para futuro del cliente o usuario--> --}}
                    <a class="dropdown-item" href="#"><!--Esto es olo pruebas para futuro del cliente o usuario-->
                    <i class="ti ti-user me-3 ti-md"></i><span class="align-middle">Mi perfil</span>
                  </a>
                </li>
                <li>
                  <a class="dropdown-item" href="#">
                    <i class="ti ti-settings me-3 ti-md"></i><span class="align-middle">Configuracion</span>
                  </a>
                </li>
                <li>
                  <!--Para cerrar la sesion del usuario y direcciona al login-->
                  <div class="d-grid px-2 pt-2 pb-1">
                    <a class="btn btn-sm btn-danger d-flex" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();" target="_blank">
                      {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                    </form>
                  </div>
                </li>
              </ul>
            </li>
            <!--/ User -->
          </ul>
        </div>

        <!-- Search Small Screens -->
        <div class="navbar-search-wrapper search-input-wrapper container-xxl d-none">
          <input
            type="text"
            class="form-control search-input border-0"
            placeholder="Search..."
            aria-label="Search..." />
          <i class="ti ti-x search-toggler cursor-pointer"></i>
        </div>
      </div>
    </nav>
    <div class="layout-page">
      <!-- Content wrapper -->
      <div class="content-wrapper">
        <!-- Menu -->
        <aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow">
          <div class="container-xxl d-flex h-100">
            <ul class="menu-inner pb-2 pb-xl-0">
              <!-- Dashboards -->

              <style>
                .color {
                  background-color: rgb(100, 91, 205);
                  /* Color de fondo */
                  border-radius: 8px;
                  /* Bordes redondeados */
                  padding: 6.8px 18px;
                  /* Espaciado interno */
                  margin: 0;
                  /* Eliminar márgenes */
                }

                .custom-menu-link {
                  display: flex;
                  align-items: center;
                  justify-content: center;
                  /* Centra el contenido */
                  color: white;
                  /* Color del texto */
                  text-decoration: none;
                  /* Sin subrayado */
                  padding: 0;
                  /* Sin padding adicional */
                  margin: 0;
                  /* Eliminar márgenes */
                }

                .custom-menu-icon {
                  color: white;
                  /* Color del ícono */
                  font-size: 25px;
                  /* Tamaño del ícono */
                  margin-right: 10px;
                  /* Espaciado entre ícono y texto */
                }

                .custom-menu-text {
                  color: white;
                  /* Color del texto */
                  font-size: 16px;
                  /* Tamaño de la fuente del texto */
                }
              </style>

























































              
              <li class="color menu-item active">
                <a href="{{ route('dashboard') }}" class="custom-menu-link">
                  <i class="custom-menu-icon tf-icons ti ti-smart-home"></i>
                  <div class="custom-menu-text" data-i18n="Dashboard">Dashboard</div>
                </a>
              </li>
             
              {{-- <li class="menu-item">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                 
                  <i class="fa-solid fa-image" style="margin-right: 8px;"></i>
                  <div data-i18n="Imagenes">Imagenes</div>
                </a>

                <ul class="menu-sub">
                  <li class="menu-item">
                    <a href="{{ route('images.create') }}" class="menu-link">
                      <i class="fa-solid fa-cloud-arrow-up" style="margin-right: 8px;"></i>
                      <div data-i18n="Importar Imagen">Importar Imagen</div>
                    </a>
                  </li>
                </ul>
              </li> --}}
              
              <!--imagenes Imagenes img -->
            
            <li class="menu-item">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="fa-solid fa-image" style="margin-right: 8px;"></i>
                    <div data-i18n="Imagenes">Imagenes</div>
                </a>
            
                @php
                      $role = Auth::user()->role->name ?? 'Invitado';
                @endphp
            
                @if ($role == 'admin' || $role == 'editor') <!-- Solo si el rol es admin, editor o sales nos dejara meter info crud -->
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{ route('images.create') }}" class="menu-link">
                                <i class="fa-solid fa-cloud-arrow-up" style="margin-right: 8px;"></i>
                                <div data-i18n="Importar Imagen">Importar Imagen</div>
                            </a>
                        </li>
                    </ul>
                @else
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="javascript:void(0)" class="menu-link">
                                <div data-i18n="'Acceso Imagenes No Autorizado.'">No tienes permisos para acceder</div>
                            </a>
                        </li>
                    </ul>
                @endif
            </li>
            



              {{-- <li class="menu-item">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                  {{-- <i class="menu-icon tf-icons ti ti-layout-sidebar"></i> 
                  <i class="fa-solid fa-folder" style="margin-right: 8px;"></i>
                  <div data-i18n="Categorias">Categorias</div>
                </a>

                <!-- Categories -->
                <ul class="menu-sub">
                  <li class="menu-item">
                    <a href="{{ route('categories.index') }}" class="menu-link"> 
                      {{-- <i class="menu-icon tf-icons ti ti-menu-2"></i> 
                      <i class="fa-solid fa-clipboard-list" style="margin-right: 8px;"></i>

                      <div data-i18n="Listado de categorias">Listado de categorias</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="{{ route('categories.create') }}" class="menu-link"> 
                      {{-- <i class="menu-icon tf-icons ti ti-menu-2"></i> 
                      <i class="fa-regular fa-rectangle-list fa-bounce"  style="margin-right: 8px;"></i>

                      <div data-i18n="Agregar categoria">Agregar categoria</div>
                    </a>
                  </li>
                </ul>
              </li> --}}
              


              <li class="menu-item">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="fa-solid fa-clipboard-list" style="margin-right: 8px;"></i>
                    <div data-i18n="Categorías">Categorías</div>
                </a>
            
                @php
                      $role = Auth::user()->role->name ?? 'Invitado';
                @endphp
            
                @if ($role == 'admin' || $role == 'editor' ) <!-- Solo si el rol es 'admin' -->
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{ route('categories.index') }}" class="menu-link">
                                <i class="fa-solid fa-th-list fa-bounce" style="margin-right: 8px;"></i>
                                <div data-i18n="Listado de categorías">Listado de categorías</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('categories.create') }}" class="menu-link">
                                <i class="fa-regular fa-rectangle-list fa-bounce" style="margin-right: 8px;"></i>
                                <div data-i18n="Agregar categoría">Agregar categoría</div>
                            </a>
                        </li>
                    </ul>
                @else
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="javascript:void(0)" class="menu-link">
                                <div data-i18n="'Acceso Categorías No Autorizado.'">No tienes permisos para acceder </div>
                            </a>
                        </li>
                    </ul>
                @endif
            </li>
            





              {{-- Autores autores chido original--}}
              {{-- <li class="menu-item">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                  <i class="fa-solid fa-user" style="margin-right: 8px;"></i>
                  <div data-i18n="Autores">Autores</div>
                </a>

                <ul class="menu-sub">
                  <li class="menu-item">
                    <a href="{{ route('authors.index') }}" class="menu-link">
                      <i class="fa-solid fa-th-list fa-bounce" style="margin-right: 8px;"></i>
                      <div data-i18n="Listado De Autores">Listado De Autores</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="{{ route('authors.createAuthors') }}" class="menu-link"> 
                      <i class="fa-solid fa-square-plus fa-shake" style="margin-right: 8px;"></i>
                      <div data-i18n="Agregar Autor">Agregar Autor</div>
                    </a>
                  </li>
                </ul>
              </li> --}}



              <li class="menu-item">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="fa-solid fa-user" style="margin-right: 8px;"></i>
                    <div data-i18n="Autores">Autores</div>
                </a>
            
                @php
                      $role = Auth::user()->role->name ?? 'Invitado';
                @endphp
            
                @if ($role == 'editor' ||  $role == 'admin') <!-- Si el rol es editor o admin si es usuariono tendra permisos xd -->
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{ route('authors.index') }}" class="menu-link">
                                <i class="fa-solid fa-th-list fa-bounce" style="margin-right: 8px;"></i>
                                <div data-i18n="Listado De Autores">Listado De Autores</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('authors.createAuthors') }}" class="menu-link">
                                <i class="fa-solid fa-square-plus fa-shake" style="margin-right: 8px;"></i>
                                <div data-i18n="Agregar Autor">Agregar Autor</div>
                            </a>
                        </li>
                    </ul>
                @else
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="javascript:void(0)" class="menu-link">
                                <div data-i18n="'Acceso No Autorizado.'">No tienes permisos para acceder </div>
                            </a>
                        </li>
                    </ul>
                @endif
            </li>




























              













              <!-- Promotioms -->
              {{-- <li class="menu-item">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                  <i class="fa-solid fa-tag" style="margin-right: 8px;"></i>

                  <div data-i18n="Promociones">Promociones</div>
                </a>

                <ul class="menu-sub">
                  <li class="menu-item">
                    <a href="{{ route('promotions.index') }}" class="menu-link">
                      <i class="fa-solid fa-th-list fa-bounce" style="margin-right: 8px;"></i>

                      <div data-i18n="Listado de Promociones">Listado de Promociones</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="{{ route('promotions.create') }}" class="menu-link">
                      <i class="fa-solid fa-square-plus fa-shake" style="margin-right: 8px;"></i>

                      <div data-i18n="Agregar Promocion">Agregar Promocion</div>
                    </a>
                  </li>
                </ul>
              </li> --}}


              <li class="menu-item">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="fa-solid fa-tag" style="margin-right: 8px;"></i>
                    <div data-i18n="Promociones">Promociones</div>
                </a>
                @php
                      $role = Auth::user()->role->name ?? 'Invitado';
                @endphp
            
                @if ($role == 'sales' || $role == 'admin' || $role == 'editor') <!-- Si el rol es 'sales' o 'admin' -->
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{ route('promotions.index') }}" class="menu-link">
                                <i class="fa-solid fa-th-list fa-bounce" style="margin-right: 8px;"></i>
                                <div data-i18n="Listado de Promociones">Listado de Promociones</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('promotions.create') }}" class="menu-link">
                                <i class="fa-solid fa-square-plus fa-shake" style="margin-right: 8px;"></i>
                                <div data-i18n="Agregar Promocion">Agregar Promocion</div>
                            </a>
                        </li>
                    </ul>
                @else
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="javascript:void(0)" class="menu-link">
                                <div data-i18n="'Acceso No Autorizado.'">No tienes permisos para acceder </div>
                            </a>
                        </li>
                    </ul>
                @endif
            </li>
            




              



































           
              <!-- News noticias news -->
              {{-- <li class="menu-item">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                  <i class="fa-solid fa-newspaper" style="margin-right: 8px;"></i>
                  <div data-i18n="Noticias">Noticias</div>
                </a>

                <ul class="menu-sub">
                  <li class="menu-item">
                    <a href="{{ route('news.index') }}" class="menu-link">
                      <i class="fa-solid fa-list-check fa-bounce"  style="margin-right: 8px;"></i>
                      <div data-i18n="Listado de noticias">Listado de noticias</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="{{ route('news.create') }}" class="menu-link">
                      <i class="fa-solid fa-square-plus fa-shake" style="margin-right: 8px;"></i> 

                      <div data-i18n="Agregar noticia">Agregar noticia</div>
                    </a>
                  </li>
                </ul>
              </li> --}}

              <li class="menu-item">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="fa-solid fa-newspaper" style="margin-right: 8px;"></i>
                    <div data-i18n="Noticias">Noticias</div>
                </a>
            
                @php
                      $role = Auth::user()->role->name ?? 'Invitado';
                @endphp
            
                @if ($role == 'editor' || $role == 'admin') <!-- Si el rol es 'sales' o 'admin' -->
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{ route('news.index') }}" class="menu-link">
                                <i class="fa-solid fa-list-check fa-bounce" style="margin-right: 8px;"></i>
                                <div data-i18n="Listado de noticias">Listado de noticias</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('news.create') }}" class="menu-link">
                                <i class="fa-solid fa-square-plus fa-shake" style="margin-right: 8px;"></i>
                                <div data-i18n="Agregar noticia">Agregar noticia</div>
                            </a>
                        </li>
                    </ul>
                @else
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="javascript:void(0)" class="menu-link">
                                <div data-i18n="'Acceso Noticias No Autorizado.'">No tienes permisos para acceder </div>
                            </a>
                        </li>
                    </ul>
                @endif
            </li>
            
                          


              <!-- Article -->
              {{-- <li class="menu-item">
                <a href="javascript:void(0)" class="menu-link menu-toggle"> --}}
                  {{-- <i class="menu-icon tf-icons ti ti-layout-sidebar"></i> 
                  <i class="fa-solid fa-book" style="margin-right: 8px;"></i>
                  <div data-i18n="Articulos">Aritculos</div>
                </a>

                <ul class="menu-sub">
                  <li class="menu-item">
                    <a href="{{ route('articles.index') }}" class="menu-link">
                      {{-- <i class="menu-icon tf-icons ti ti-menu-2"></i> 
                      <i class="fa-solid fa-th-list fa-bounce" style="margin-right: 8px;"></i>
                      <div data-i18n="Listado de articulos">Listado de articulos</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="{{ route('articles.create') }}" class="menu-link">
                      {{-- <i class="menu-icon tf-icons ti ti-menu-2"></i> 
                      <i class="fa-solid fa-square-plus fa-shake" style="margin-right: 8px;"></i>
                      <div data-i18n="Agregar articulo">Agregar articulo</div>
                    </a>
                  </li>
                </ul>
              </li>--}}


                      <li class="menu-item">
                      <a href="javascript:void(0)" class="menu-link menu-toggle">
                          <i class="fa-solid fa-book" style="margin-right: 8px;"></i>
                          <div data-i18n="Articulos">Artículos</div>
                      </a>

                      @php
                            $role = Auth::user()->role->name ?? 'Invitado';
                      @endphp

                      @if ($role == 'editor' || $role == 'admin') <!-- Si el rol es 'sales' o 'admin' -->
                          <ul class="menu-sub">
                              <li class="menu-item">
                                  <a href="{{ route('articles.index') }}" class="menu-link">
                                      <i class="fa-solid fa-th-list fa-bounce" style="margin-right: 8px;"></i>
                                      <div data-i18n="Listado de artículos">Listado de artículos</div>
                                  </a>
                              </li>
                              <li class="menu-item">
                                  {{-- <a href="{{ route('articles.create') }}" class="menu-link"> --}}
                                  <a href="{{ route('articles.createArticle') }}" class="menu-link">
                                      <i class="fa-solid fa-square-plus fa-shake" style="margin-right: 8px;"></i>
                                      <div data-i18n="Agregar artículo">Agregar artículo</div>
                                  </a>
                              </li>
                          </ul>
                      @else
                          <ul class="menu-sub">
                              <li class="menu-item">
                                  <a href="javascript:void(0)" class="menu-link">
                                      <div data-i18n="'Acceso  Articulos No Autorizado.'">No tienes permisos para acceder </div>
                                  </a>
                              </li>
                          </ul>
                      @endif
                  </li>







                  <!-- Categories -->
                {{-- <li class="menu-item">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                      <i class="fa-solid fa-clipboard-list" style="margin-right: 8px;"></i>
                      <div data-i18n="Categoriasass">Categoriasass</div>
                    </a>

                    <ul class="menu-sub">
                      <li class="menu-item">
                        <a href="{{ route('categories.index') }}" class="menu-link">
                          <i class="fa-regular fa-rectangle-list fa-bounce"  style="margin-right: 8px;"></i>
                          <div data-i18n="Listado de categorias">Listado de categorias</div>
                        </a>
                      </li>
                      <li class="menu-item">
                         <a href="{{ route('categories.create') }}" class="menu-link"> 
                          <i class="fa-solid fa-notes-medical fa-shake" style="margin-right: 8px;"></i>
                          <div data-i18n="Agregar categoria">Agregar categoria</div>
                        </a>
                      </li>
                    </ul>
                  </li> --}}

                   <!-- Contacts  contactos-->
                {{-- <li class="menu-item">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                      <i class="menu-icon tf-icons ti ti-layout-sidebar"></i>
                      <div data-i18n="Contactos">Contactos</div>
                    </a>

                    <ul class="menu-sub">
                      <li class="menu-item">
                        <a href="{{ route('contacts.index') }}" class="menu-link">
                          <i class="menu-icon tf-icons ti ti-menu-2"></i>
                          <div data-i18n="Listado de Contacto">Listado de Contactos</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="layouts-without-menu.html" class="menu-link">
                          <i class="menu-icon tf-icons ti ti-menu-2"></i>
                          <div data-i18n="Agregar Contacto">Agregar contacto</div>
                        </a>
                      </li>
                    </ul>
                  </li> --}}

              <!-- Forms -->
              {{-- <li class="menu-item">
                <a href="javascript:void(0)" class="menu-link menu-toggle"> --}}
                  {{-- <i class="menu-icon tf-icons ti ti-layout-sidebar"></i> 
                  <i class="fa-brands fa-wpforms" style="margin-right: 8px;"></i>
                  <div data-i18n="Formularios">Formularios</div>
                </a>

                <ul class="menu-sub">
                  <li class="menu-item">
                    <a href="{{ route('forms.index') }}" class="menu-link">
                      {{-- <i class="menu-icon tf-icons ti ti-menu-2"></i> 
                      <i class="fa-solid fa-th-list fa-bounce" style="margin-right: 8px;"></i>
                      <div data-i18n="Listado de Formulario">Listado de Formularios</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="{{ route('forms.create') }}" class="menu-link">
                      {{-- <i class="menu-icon tf-icons ti ti-menu-2"></i> 
                      <i class="fa-solid fa-square-plus fa-shake" style="margin-right: 8px;"></i>
                      <div data-i18n="Agregar Formulario">Agregar Formulario</div>
                    </a>
                  </li>
                </ul>
              </li>--}}

              <li class="menu-item">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="fa-brands fa-wpforms" style="margin-right: 8px;"></i>
                    <div data-i18n="Formularios">Formularios</div>
                </a>
            
                @php
                      $role = Auth::user()->role->name ?? 'Invitado';
                @endphp
            
                @if ($role == 'editor' || $role == 'admin') <!-- Si el rol es 'sales'editor o 'admin' -->
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{ route('forms.index') }}" class="menu-link">
                                <i class="fa-solid fa-th-list fa-bounce" style="margin-right: 8px;"></i>
                                <div data-i18n="Listado de Formularios">Listado de Formularios</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('forms.create') }}" class="menu-link">
                                <i class="fa-solid fa-square-plus fa-shake" style="margin-right: 8px;"></i>
                                <div data-i18n="Agregar Formulario">Agregar Formulario</div>
                            </a>
                        </li>
                    </ul>
                @else
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="javascript:void(0)" class="menu-link">
                                <div data-i18n="'Acceso Formularios No Autorizado'">No tienes permisos para acceder </div>
                            </a>
                        </li>
                    </ul>
                @endif
            </li>
            



              <!-- Galeries -->
              {{-- <li class="menu-item">
                <a href="javascript:void(0)" class="menu-link menu-toggle"> --}}
                  {{-- <i class="menu-icon tf-icons ti ti-layout-sidebar"></i>
                  <i class="fa-solid fa-photo-video" style="margin-right: 8px;"></i>
                  <div data-i18n="Galeria">Galeria</div>
                </a>

                <ul class="menu-sub">
                  <li class="menu-item">
                    <a href="{{ route('galeries.index') }}" class="menu-link">
                      {{-- <i class="menu-icon tf-icons ti ti-menu-2"></i>
                      <i class="fa-solid fa-th-list fa-bounce" style="margin-right: 8px;"></i>
                      <div data-i18n="Listado de Galeria">Listado de Galeria</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="layouts-without-menu.html" class="menu-link">
                      {{-- <i class="menu-icon tf-icons ti ti-menu-2"></i>
                      <i class="fa-solid fa-square-plus fa-shake" style="margin-right: 8px;"></i>
                      <div data-i18n="Agregar Galeria">Agregar Galeria</div>
                    </a>
                  </li>
                </ul>
              </li>
              --}}

              <li class="menu-item">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="fa-solid fa-photo-video" style="margin-right: 8px;"></i>
                    <div data-i18n="Galería">Galería</div>
                </a>
            
                @php
                      $role = Auth::user()->role->name ?? 'Invitado';
                @endphp
            
                @if ($role == 'admin' || $role == 'editor') <!-- Solo los roles 'admin' y 'editor' pueden acceder -->
                    <ul class="menu-sub">
                        <li class="menu-item">
                            {{-- <a href="{{ route('galeries.index') }}" class="menu-link">ORIGINAL --}}
                            <a href="#" class="menu-link">
                                <i class="fa-solid fa-th-list fa-bounce" style="margin-right: 8px;"></i>
                                <div data-i18n="Listado de Galería">Listado de Galería</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            {{-- <a href="{{ route('galeries.create') }}" class="menu-link"> ORIGINAL--}}
                            <a href="#" class="menu-link">
                                <i class="fa-solid fa-square-plus fa-shake" style="margin-right: 8px;"></i>
                                <div data-i18n="Agregar Galería">Agregar Galería</div>
                            </a>
                        </li>
                    </ul>
                @else
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="javascript:void(0)" class="menu-link">
                                <div data-i18n="'Acceso Galería No Autorizado.'">No tienes permisos para acceder</div>
                            </a>
                        </li>
                    </ul>
                @endif
            </li>
            
             
              <!-- usuarios usuarios user -->
              {{-- <li class="menu-item">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                  <i class="fa-solid fa-users" style="margin-right: 8px;"></i>
                  <div data-i18n="Usuarios">Usuarios</div>
                </a>

                <ul class="menu-sub">
                  <li class="menu-item">
                    <a href="{{ route('users.index') }}" class="menu-link">
                      <i class="fa-solid fa-address-book" style="margin-right: 8px;"></i>
                      <div data-i18n="Listado De Usuarios">Listado De Usuarios</div>
                    </a>
                  </li>
                 
                  <li class="menu-item">
                    <a href="{{ route('roles.index') }}" class="menu-link">
                      <i class="fas fa-users-cog" style="margin-right: 8px;"></i>
                      <div data-i18n="Listado De Roles">Listado De Roles</div>
                    </a>
                  </li>
                 
                </ul>
              </li> --}}


              {{-- ORIGINAL<li class="menu-item">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="fa-solid fa-users" style="margin-right: 8px;"></i>
                    <div data-i18n="Usuarios">Usuarios</div>
                </a>
            
                @php
                      $role = Auth::user()->role->name ?? 'Invitado';
                @endphp
            
                @if ($role == 'admin') <!-- Solo el rol 'admin' puede acceder -->
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{ route('users.index') }}" class="menu-link">
                                <i class="fa-solid fa-address-book" style="margin-right: 8px;"></i>
                                <div data-i18n="Listado De Usuarios">Listado De Usuarios</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('roles.index') }}" class="menu-link">
                                <i class="fas fa-users-cog" style="margin-right: 8px;"></i>
                                <div data-i18n="Listado De Roles">Listado De Roles</div>
                            </a>
                        </li>
                    </ul>
                @else
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="javascript:void(0)" class="menu-link">
                                <div data-i18n="'Acceso Usuarios No Autorizado.'">No tienes permisos para acceder</div>
                            </a>
                        </li>
                    </ul>
                @endif
            </li> --}}
          
          
            <li class="menu-item">
              <a href="javascript:void(0)" class="menu-link menu-toggle">
                  <i class="fa-solid fa-users" style="margin-right: 8px;"></i>
                  <div data-i18n="Usuarios">Usuarios</div>
              </a>
          
              @php
                  use App\Models\User;
          
                  $role = Auth::user()->role->name ?? 'Invitado';
          
                  if ($role == 'admin') {
                      // Solo obtener los usuarios que el administrador ha creado
                      $users = Auth::user()->createdUsers()->where('is_active', true)->get();
                  } else {
                      $users = collect(); // No mostrar usuarios si no es administrador
                  }
              @endphp
          
              @if ($role == 'admin')
              <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('users.index') }}" class="menu-link">
                        <i class="fa-solid fa-address-book" style="margin-right: 8px;"></i>
                        <div data-i18n="Listado De Usuarios">Listado De Usuarios</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('roles.index') }}" class="menu-link">
                        <i class="fas fa-users-cog" style="margin-right: 8px;"></i>
                        <div data-i18n="Listado De Roles">Listado De Roles</div>
                    </a>
                </li>
            </ul>
              @else
                  <ul class="menu-sub">
                      <li class="menu-item">
                          <a href="javascript:void(0)" class="menu-link">
                              <div data-i18n="Acceso Usuarios No Autorizado.">No tienes permisos para acceder</div>
                          </a>
                      </li>
                  </ul>
              @endif
          </li>
          
          
          
            























































               <!-- Contacts -->
               {{-- <li class="menu-item">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                  <i class="fa-solid fa-id-card-clip" style="margin-right: 8px;"></i>
                  <div data-i18n="Contactos">Contactos</div>
                </a>

                <ul class="menu-sub">
                  <li class="menu-item">
                    <a href="{{ route('contacts.index') }}" class="menu-link">
                      <i class="fa-solid fa-address-book" style="margin-right: 8px;"></i>
                      <div data-i18n="Listado de Contacto">Listado de Contactos</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="layouts-without-menu.html" class="menu-link">
                      <i class="fa-solid fa-th-list fa-bounce" style="margin-right: 8px;"></i>
                      <div data-i18n="Agregar Contacto">Agregar contacto</div>
                    </a>
                  </li>
                </ul>
              </li>


              <li class="menu-item">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                  <i class="fa-solid fa-users" style="margin-right: 8px;"></i>
                  <div data-i18n="Clientes">Clientes</div>
                </a>

                <ul class="menu-sub">
                  <li class="menu-item">
                    <a href="{{ route('clients.index') }}" class="menu-link">

                      <i class="fa-solid fa-user-group" style="margin-right: 8px;"></i>
                      <div data-i18n="Listado de Clientes">Listado de Clientes</div>
                    </a>
                  </li>
                </ul>
              </li> --}}


              {{-- <li class="menu-item">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="fa-solid fa-id-card-clip" style="margin-right: 8px;"></i>
                    <div data-i18n="Contactos">Contactos</div>
                </a>
            
                @php
                      $role = Auth::user()->role->name ?? 'Invitado';
                @endphp
            
                @if ($role == 'admin') <!-- Solo el rol 'admin' puede acceder -->
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{ route('contacts.index') }}" class="menu-link">
                                <i class="fa-solid fa-address-book" style="margin-right: 8px;"></i>
                                <div data-i18n="Listado de Contacto">Listado de Contactos</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="layouts-without-menu.html" class="menu-link">
                                <i class="fa-solid fa-th-list fa-bounce" style="margin-right: 8px;"></i>
                                <div data-i18n="Agregar Contacto">Agregar contacto</div>
                            </a>
                        </li>
                    </ul>
                @else
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="javascript:void(0)" class="menu-link">
                                <div data-i18n="'Acceso No Autorizado. contactos'">No tienes permisos para acceder</div>
                            </a>
                        </li>
                    </ul>
                @endif
            </li> --}}
            
            <li class="menu-item">
              <a href="javascript:void(0)" class="menu-link menu-toggle">
                  <i class="fa-solid fa-users" style="margin-right: 8px;"></i>
                  <div data-i18n="Clientes">Clientes</div>
              </a>
              @php
                  $role = Auth::user()->role->name ?? 'Invitado'; 
              @endphp
              @if ($role == 'sales' || $role == 'admin' || $role == 'editor') <!-- Solo el rol 'admin' o 'editor' puede acceder -->
                  <ul class="menu-sub">
                      <li class="menu-item">
                          <a href="{{ route('clients.index') }}" class="menu-link">
                          {{-- <a href="#" class="menu-link"> --}}
                              <i class="fa-solid fa-user-group" style="margin-right: 8px;"></i>
                              <div data-i18n="Listado de Clientes">Listado de Clientes</div>
                          </a>
                      </li>
                  </ul>
              @else
                  <ul class="menu-sub">
                      <li class="menu-item">
                          <a href="javascript:void(0)" class="menu-link">
                              <div data-i18n="Acceso No Autorizado, clientes">No tienes permisos para acceder</div>
                          </a>
                      </li>
                  </ul>
              @endif
          </li>
          
            </ul>
          </div>
        </aside>


              <!-- ESTO FUNCIONA PARA MOSTRAR LA INFORMACION DE USUARIO DEPENDIENDO DE QUE VISTA SE PODRA VER LAS OPCIONES QUE TIENBE EL PERFIL DE UISUARIO -->
      {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <script>
          document.addEventListener("DOMContentLoaded", function () {
              var dropdowns = document.querySelectorAll(".dropdown-toggle");
              dropdowns.forEach(function (dropdown) {
                  new bootstrap.Dropdown(dropdown);
              });
          });
      </script>
      