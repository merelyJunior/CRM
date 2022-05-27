<div id="layoutSidenav_content">
        <main>
          <div class="row mt-4">
            <div class="col-lg-6 col-md-6 col-11 ms-auto me-1 m-clear">
              
              <div class="p-4 my-4 border bg-light card rounded-top text-center">
                <h3 class="py-2 border-bottom">Добавить Био</h3>
                <form id="addBio"  class="bg-light my-4 py-3 row">
                  <div class="row my-3">
                    <div class="col-lg-8 col-md-8 col-8 me-auto">
                      <label for="fileText" class="my-2 text-start small">Выберите файл био .txt</label>
                      <input type="file" name="fileText" id="fileBio" class="form-control-file d-block" >
                    </div>
                    <div class="col-lg-3 col-md-3 col-3 ms-auto">
                      <label for="lang" class="my-2 text-start small">Язык:</label>
                      <select class="form-control" id="lang" name="lang" >
                        <option selected="" value="en">EN</option>
                        <option value="ru">RU</option>
                        <option value="de">DE</option>
                      </select>
                    </div>
                  </div> 
                  <div class="row my-3 m-auto">
                        <div class="col-lg-8 col-md-8">
                          <strong>Количество био в файле:</strong>
                        </div>
                        <div id ="outBio" class="col-lg-2 col-md-2 me-a">
                         
                        </div>
                  </div>
                  <div class="row my-3 m-auto">
                        <div class="col-lg-8 col-md-8">
                          <strong>Количество био в базе:</strong>
                        </div>
                        <div class="col-lg-2 col-md-2 me-a">
                          124
                        </div>
                  </div>
                  <div class="text-center">
                    <button id="addAbout"  type="submit" class="btn btn-primary mt-4">
                        Сохранить
                    </button>
                  </div>
                </form> 
              </div> 
              <div class="p-4 my-4  border bg-light card rounded-top text-center">
        <h3 class="py-2 border-bottom">Добавить медиа</h3>
          <form id="uploadMedia" class="bg-light my-4 py-3 row">
              <div class="row ">
                  <div class="row">
                      <div class="col-lg-3 col-md-3 col-3 me-auto">
                          <label for="typePhoto" class="my-2 text-start small">Пол:</label>
                          <select class="form-control" id="" name="typePhoto">
                              <option selected="" value="Man">Man</option>
                              <option value="Woman">Woman</option>
                          </select>
                      </div>
                  </div>
                  <div class="col-lg-6 col-8">
                      <label for="fileVideo" class="my-2 text-start small">Выберите видео файл:</label>
                      <input type="file" name="fileVideo" class="form-control-file d-block" id="fileVideo" />
                  </div>
                  <div class="col-lg-4 col-3 me-auto ms-0 m-clear"></div>
              </div>
              <div class="row my-3 align-items-end">
                  <div class="col-lg-8 col-md-8 col-8 ms-0 me-auto">
                      <label for="filePhoto" class="my-2 text-start small">Выберите фото Face:</label>
                      <input type="file" name="addFaceImages" onchange="onChangeHandler(event)" id="addFaceImages"
                          data-filename="face" multiple="" class="d-block" />
                  </div>
                  <div class="col-lg-3 col-md-3 col-3 me-0 ms-auto"></div>
              </div>
              <div class="row">
                  <div id="uploadImagesList" data-list="face" class="d-flex flex-row flex-wrap my-3 ms-a me-a"></div>
                  <div class="clear"></div>
              </div>
              <div class="row my-3 align-items-end">
                  <div class="col-lg-8 col-md-8 col-8 ms-0 me-auto">
                      <label for="filePhoto" class="my-2 text-start small">Выберите фото Nude:</label>
                      <input type="file" name="addNudeImage" id="addNudeImage" onchange="onChangeHandler(event)"
                          data-filename="nude" multiple="" class="d-block" />
                  </div>
                  <div class="col-lg-3 col-md-3 col-3 me-0 ms-auto"></div>
              </div>
              <div class="row">
                  <div id="uploadImagesList" data-list="nude" class="d-flex flex-row flex-wrap my-3 ms-a me-a"></div>
                  <div class="clear"></div>
              </div>
              <div class="text-center">
                  <button id="saveImg" type="submit" class="btn btn-primary mt-4">
                      Сохранить
                  </button>
              </div>
          </form>
            <template id="itemTemplate">
                <div class="item">
                    <div class="img-wrap">
                        <img src="image.jpg" alt="" />
                        <p class="img-name"><span></span></p>
                    </div>
                    <span class="delete-link"><i class="fas fa-trash-alt"></i></span>
                </div>
            </template>
          </div>
            </div>
            <div class="col-lg-5 col-md-5 col-md-5 col-11 me-auto ms-1 m-clear">
              <div class="p-4 my-4 border bg-light card rounded-top text-center">
                  <h3 class="py-2 border-bottom">Добавить имена</h3>
                  <form id ="addNamesForm" class="bg-light my-4 py-3 row">
                    <div class="row my-3">
                      <div class="col-lg-8 col-md-8 col-8 me-auto m-clear">
                        <label for="fileText" class="my-2 text-start small">Выберите файл с именами .txt</label>
                        <input type="file" name="fileText" class="form-control-file d-block" id="nameFile">
                      </div>
                      <div class="col-lg-3 col-md-3 col-3 ms-auto m-clear">
                        <label for="lang" class="my-2 text-start small">Язык:</label>
                        <select class="form-control" id="lang" name="lang" >
                          <option selected="" value="en">EN</option>
                          <option value="ru">RU</option>
                          <option value="de">DE</option>
                        </select>
                      </div>
                    </div> 
                    <div class="row my-3 m-auto">
                        <div class="col-lg-8 col-md-8">
                          <strong>Количество имён в файле:</strong>
                        </div>
                        <div id ="outNames" class="col-lg-2 col-md-2 me-a">
                         
                        </div>
                  </div>
                  <div class="row my-3 m-auto">
                        <div class="col-lg-8 col-md-8">
                          <strong>Количество имён в базе:</strong>
                        </div>
                        <div class="col-lg-2 col-md-2 me-a">
                          124
                        </div>
                  </div>
                    <div class="text-center">
                      <button id="addNames" type="submit" class="btn btn-primary mt-4">
                          Сохранить
                      </button>
                    </div>
                  </form> 
              </div>
              <div class="p-4 my-4 border bg-light card rounded-top text-center h-fix">
                <h3 class="py-2 border-bottom">Добавить аудио</h3>
                <form id ="" class="bg-light my-4 py-3 row">
                  <div class="row my-3">
                    <label for="fileAudio" class="my-2 text-start small">Выберите аудио файл:</label>
                    <input type="file" name="fileAudio" class="form-control-file d-block" id="fileAudio">
                  </div>
                  <div class="text-center">
                    <button id="" type="submit" class="btn btn-primary mt-5 mb-3">
                        Сохранить
                    </button>
                  </div>
                </form>  
              </div> 
               
            </div>
          </div>
          <div class="row my-4 ">
            <div class="col-lg-11 col-md-11 col-11 ms-auto me-auto m-clear">
              <div class="p-4 my-4 border bg-light card rounded-top text-center">
                  <h3 class="py-2 border-bottom">Добавить Гео</h3>
                  <form action="" id="addCord" class="bg-light my-4 py-3 row">
                      <div class="row d-flex justify-content-center align-items-center">
                          <div class="col-lg-4 col-md-5  me-2 ms-auto">
                              <div class="row">
                                <label for="geoName" class="my-2 text-start small" >Название гео:</label>
                                <input name="geoName" type="text" id="geoName" class="form-control" placeholder="Имя" value="" maxlength=""  required="">
                              </div>
                              <div class="row">
                                <label for="coord" class="my-2 text-start small" >Введите центральную координату:</label>
                                <input name="coord" type="text" id="centralCoord" class="form-control" placeholder="Координаты" value="" maxlength=""  required="">
                              </div>
                          </div>
                          <div class="col-lg-4 col-md-5 me-auto ms-2">
                              <div class="row">
                                <label for="amounthPoint" class="my-2 text-start small" >Введите количество точек:</label>
                                <input name="amounthPoint" type="text" id="amounthPoint" class="form-control" placeholder="Количество" value="" maxlength="" required="">
                              </div>
                              <div class="row">
                                <label for="distancePoint" class="my-2 text-start small" >Введите дистанцию между точками в метрах:</label>
                                <input name="distancePoint" type="text" id="distancePoint" class="form-control" placeholder="Метров" value="" maxlength=""  required="">  
                              </div>
                          </div>
                      </div>
                      <div class="text-center">
                              <button id="addGeo" type="submit" class="btn btn-success my-4 p-3">
                                Проверить
                              </button>
                            </div>
                      <div class="row my-3 m-auto">
                      <div id="map" class="row"></div>
                        </div>
                      <div class="text-center">
                        <button id="createGeo" type="submit" class="btn btn-primary mt-4">
                            Сохранить
                        </button>
                      </div>
                  </form>
              </div>
            </div>
            
          </div>
        </main>
      </div>
