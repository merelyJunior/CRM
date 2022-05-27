<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Crazybot Админ панель</title>
    <link rel="shortcut icon" href="../../img/ico.png" type="image/x-icon" />
    <link
      href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css"
      rel="stylesheet"
    />
    <link href="../../css/styles.css" rel="stylesheet" />
    <link href="../../css/styleNew.css" rel="stylesheet" />
    <link href="../../css/magnific-popup.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.3.0/animate.css">
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"
      crossorigin="anonymous"
    ></script>
    <script src = "https://polyfill.io/v3/polyfill.min.js?features=default"> </script>
    <script src="http://maps.google.com/maps/api/js?sensor=false"
              type="text/javascript"></script>
              
  </head>
  <body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
      
      <!-- Sidebar Toggle-->
      <button
        class="btn btn-link btn-sm order-lg-0 me-lg-0"
        id="sidebarToggle"
        href="#!"
      >
        <i class="fas fa-bars"></i>
      </button>
      <!-- Navbar Brand-->
      <a class="navbar-brand ps-5" href="/">Crazybot</a>
      <!-- Navbar Search-->
      <!-- <form
        class="
          d-none d-md-inline-block
          form-inline
          ms-auto
          me-0 me-md-3
          my-2 my-md-0
        "
      > -->
        <!-- <div class="input-group">
          <input
            class="form-control"
            type="text"
            placeholder="Найти...."
            aria-label="Найти...."
            aria-describedby="btnNavbarSearch"
          />
          <button class="btn btn-primary" id="btnNavbarSearch" type="button">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </form> -->
      <!-- Navbar-->
      <!-- <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
          <a
            class="nav-link dropdown-toggle"
            id="navbarDropdown"
            href="#"
            role="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
            ><i class="fas fa-user fa-fw"></i
          ></a>
          <ul
            class="dropdown-menu dropdown-menu-end"
            aria-labelledby="navbarDropdown"
          >
            <li><a class="dropdown-item" href="#!">Settings</a></li>
            <li><a class="dropdown-item" href="#!">Activity Log</a></li> -->
            <li><hr class="dropdown-divider" /></li>
            
          </ul>
        </li>
      </ul> -->
    </nav>
    <div id="layoutSidenav">
      <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
          <div class="sb-sidenav-menu">
            <div class="nav">
              <div class="sb-sidenav-menu-heading">Главная</div>
              <a class="nav-link" href="/dialogue">
                <div class="sb-nav-link-icon">
                <i class="fas fa-plus-square"></i>
                </div>
                Создать новый диалог
              </a>
              <a class="nav-link" href="/dialogue_for_chat">
                <div class="sb-nav-link-icon">
                <i class="fas fa-comment-medical"></i>
                </div>
                Создать новый диалог для чатов
              </a>
              <a class="nav-link" href="/chat">
                <div class="sb-nav-link-icon">
                  <i class="fas fa-comments"></i>
                </div>
                Просмотр и удаление диалогов
              </a>
              <!-- <a class="nav-link" href="/edit_dialogue">
                <div class="sb-nav-link-icon">
                <i class="fas fa-edit"></i>
                </div>
                Редактирование диалога
              </a> -->
              <a class="nav-link" href="/bot_chart">
                <div class="sb-nav-link-icon">
                <i class="fas fa-map-marked-alt"></i>
                
                </div>
                Местоположение и состояние
              </a>
              <a class="nav-link" href="/stats">
                <div class="sb-nav-link-icon">
                <i class="fas fa-chart-bar"></i>
                </div>
                Статистика
              </a>
              <a class="nav-link" href="/messages">
                <div class="sb-nav-link-icon">
                <i class="far fa-eye"></i>
                </div>
                Просмотр чатов
              </a>
              <a class="nav-link" href="/reg">
                <div class="sb-nav-link-icon">
                <i class="fas fa-robot"></i>
                </div>
                Регистрация ботов
              </a>
              <a class="nav-link" href="/profile_add">
                <div class="sb-nav-link-icon">
                <i class="fas fa-user-plus"></i>
                </div>
                Добавление профиля
              </a>
              <a class="nav-link" href="/profile_edit">
                <div class="sb-nav-link-icon">
                <i class="fas fa-user-edit"></i>
                </div>
                Изменение профиля
              </a>
              <a class="nav-link" href="/launch">
                <div class="sb-nav-link-icon">
                <i class="fas fa-rocket"></i>
                </div>
                Запуск ботов
              </a>
            </div>

          </div>
          <div class="sb-sidenav-menu bordered sb-sidenav-menu-bottom ">
            <nav>
              <a class="nav-link" href="logout.php">
                <div class="sb-nav-link-icon">
                
                </div>
                <i class="fas fa-sign-out-alt"></i> Выход
              </a>
              
            </nav>
          </div>
        </nav>
      </div>
      <?php include 'application/views/'.$content_view; ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"
      crossorigin="anonymous"
    ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.js"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/simple-datatables@latest"
      crossorigin="anonymous"
    ></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script src="/js/jquery.magnific-popup.min.js"></script>
    <script src="/js/scripts.js"></script>
    <script src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyBYDDJWlbvqjjmRXXwoHglroy1YEAuQ1ek&callback=initMap&v=weekly&channel=2" async> </script>
 
  </body>
</html>
  