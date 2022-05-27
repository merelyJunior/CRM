<div id="layoutSidenav_content">
        <main>
          <div class="container-my px-4">
            <h1 class="mt-4">Добавить диалог в Базу данных</h1>
              <div class="row">
                  <form method="POST" action="" id="dataForm">
                      <h3>Диалоги</h3>
                      <div class="row mt-2 mb-1">
                          <div class="col-md-4">
                              <div class="col">
                                  <label for="typeOfDialogue">Тип диалога:</label>
                                  <input
                                          name="type"
                                          type="text"
                                          id="typeOfDialogue"
                                          class="form-control"
                                          placeholder=""
                                          value=""
                                  />
                              </div>
                          </div>
                          <!-- <div class="col-md-5">
                              <label for="siteLink">URL:</label>
                              <input
                                      id="siteLink"
                                      type="text"
                                      class="form-control mb-3"
                                      placeholder="Ссылка на сайт"
                                      name="siteLink"
                                      value=""
                              />
                          </div> -->
                          <div class="col-md-2">
                              <label for="langSelect">Язык:</label>
                              <select class="form-control mb-3" id="langSelect" name="lang">
                                  <option selected value="RU">RU</option>
                                  <option value="EN">EN</option>
                                  <option value="DE">DE</option>
                                  <option value="ES">ES</option>
                                  <option value="FR">FR</option>
                                  <option value="IT">IT</option>
                              </select>
                          </div>
                      </div>
                      <div id="dialogsSet" class="mb-3">

                      </div>
                      <div>
                          <button type="button"
                                  id="addDialog"
                                  class="mb-3 btn btn-primary rounded-circle">+</button>
                      </div>
                      <div class="text-center">
                          <button
                                  id="postButton"
                                  type="submit"
                                  class="btn btn-primary mb-5"
                          >
                              Добавить диалоги
                          </button>
                      </div>
                  </form>
              </div>
          </div>

         
        </main>
      </div>