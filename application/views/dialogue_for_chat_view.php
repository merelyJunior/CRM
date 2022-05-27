
<!--  форма но без внутренности-->
<div id="layoutSidenav_content">
        <main>
        <h1 class="py-3 mt-4 mb-5 text-center bg-light">Создать диалог для чатов</h1>
          <div class="container-my px-4 ms-auto me-auto">
              <div class="row">
                  <form method="POST" action="" id="dataForm" class="bg-light px-5 py-5 mb-6 shadow"> 
                      <h3 class="mb-4 pb-2 border-bottom">Текущий диалог</h3>
                      <div class="row mt-2 mb-1">
                          <div class="col-md-4">
                              <div class="col">
                                  <label for="dialogueName">Название диалога:</label>
                                  <input
                                          name="dialogueName"
                                          type="text"
                                          id="dialogueName"
                                          class="form-control"
                                          placeholder=""
                                          value=""
                                          required
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
                                      required
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
                                  id="firstAddDialog"
                                  class="mb-3 btn btn-primary rounded-circle addDialog">+</button>
                      </div>
                      <div class="text-center">
                          <button
                                  id="postButton"
                                  type="submit"
                                  class="btn btn-primary mb-5"
                          >
                              Добавить диалог
                          </button>
                      </div>
                  </form>
              </div>
          </div>  
        </main>
        
      </div>
      <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
      <script src="/js/chat_dialogue_edit_add.js"></script>