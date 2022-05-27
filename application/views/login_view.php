
  <body class="bg-primary">
    <div id="layoutAuthentication">
      <div id="layoutAuthentication_content">
        <main>
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                  <div class="bg-dark text-light py-3 px-2 rounded-top">
                    <h3 class="text-center font-weight-light my-4">
                      Вход в панель управления <strong>Crazybot</strong>
                    </h3>
                  </div>
                  <div class="card-body">
                    <form action="" method="POST">
                      <div class="form-floating mb-3">
                        <input
                          class="form-control"
                          id="login"
                          type="text"
                          placeholder="Введите логин"
                          name="login"
                        />
                        <label for="inputEmail">Введите логин</label>
                      </div>
                      <div class="form-floating mb-3">
                        <input
                          class="form-control"
                          id="password"
                          type="password"
                          placeholder="Введите пароль"
                          name="password"
                        />
                        <label for="inputPassword">Введите пароль</label>
                      </div>
                      <div class="form-check mb-3">
                        <input
                          class="form-check-input"
                          id="inputRememberPassword"
                          type="checkbox"
                          value=""
                        />
                        <label
                          class="form-check-label"
                          for="inputRememberPassword"
                          >Запомнить пароль</label
                        >
                      </div>
                      <div
                        class="
                          d-flex
                          align-items-center
                          justify-content-between
                          mt-4
                          mb-0
                        "
                      >

                        <button type="submit" id="loginBtn" class="btn btn-primary" >Войти</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </main>
        
      </div>
    </div>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
      crossorigin="anonymous"
    ></script>
  </body>
