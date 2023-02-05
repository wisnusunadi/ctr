  <!-- Main Sidebar Container -->
  <?php $session = session();


    ?>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
          <span class="brand-text font-weight-light">Sistem Informasi</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="info">
                  <a href="#" class="d-block"> <?php echo $session->get('nama')  ?></a>
              </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <?php if ($session->get('role') == 'murid') { ?>
                      <li class="nav-item">
                          <a href="/murid" class="nav-link">
                              <i class="nav-icon fas fa-th"></i>
                              <p>
                                  Dashboard
                              </p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="/murids/profile" class="nav-link">
                              <i class="nav-icon fas fa-th"></i>
                              <p>
                                  Ubah Profile
                              </p>
                          </a>
                      </li>
                  <?php } ?>
                  <?php if ($session->get('role') == 'admin') { ?>
                      <li class="nav-item">
                          <a href="/admin" class="nav-link">
                              <i class="nav-icon fas fa-th"></i>
                              <p>
                                  Dashboard
                              </p>
                          </a>
                      </li>
                      <li class="nav-header">Master Data</li>
                      <li class="nav-item">
                          <a href="/mapel" class="nav-link">
                              <i class="nav-icon fas fa-th"></i>
                              <p>
                                  Mata Pelajaran
                              </p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="/guru" class="nav-link">
                              <i class="nav-icon fas fa-th"></i>
                              <p>
                                  Guru
                              </p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="/murids" class="nav-link">
                              <i class="nav-icon fas fa-th"></i>
                              <p>
                                  Murid
                              </p>
                          </a>
                      </li>

                  <?php } ?>
                  <!-- Murid -->
              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>

      <!-- /.sidebar -->
  </aside>