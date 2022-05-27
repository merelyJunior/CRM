<div id="layoutSidenav_content">
        <main>
          <h1 class="py-3 mt-4 mb-5 text-center bg-light">Регистрация ботов</h1>
          <div class="container-fluid px-1 text-center">
            <div class="row d-flex justify-content-center">
              <div class="col-lg-5 bg-light ms-2 me-2 px-4 py-4 rounded reg-time my-2">
                <div class="row border-bottom py-3">
                  <div class="row d-flex justify-content-left align-items-top">
                    <div class="col py-3"><h5 class="text-start">Текущий баланс:</h5></div>
                    <div class="col py-3"><p id="currBal" class="text-start my-0" ></p></div>
                  </div>
                </div>

                <div class="row border-bottom py-3 mt-3">
                  <h5 class="text-start">Статус:</h5>
                  <div class="row mt-2 d-flex justify-content-left align-items-center text-start">
                    <div class="col-lg-5 col-md-2  col-sm-3 col-4">
                      Выбор страны
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-1 col-1 custom-radio ">
                      <div class="hidden"></div>
                    <label>
                        <input id="checkStop" type="radio" name="radio">
                        <div class="custom-radio__label custom-radio__label-stop">
                        </div>
                      </label>
                    </div>
                  </div>
                  <div class="row mt-2 d-flex justify-content-left align-items-center text-start">
                    <div  class="col-lg-5  col-md-2  col-sm-3  col-4">
                      Регистрация
                    </div> 
                    <div class="col-lg-1 col-md-1 col-sm-1  col-1 custom-radio pause">
                    <div class="hidden"></div>
                    <label>
                        <input  id="checkReg" type="radio" name="radio">
                        <div class="custom-radio__label custom-radio__label-pause">
                        </div>
                      </label>
                    </div>
                  </div>
                
                  <div class="row mt-2 d-flex justify-content-left align-items-center text-start">
                    <div class="col-lg-5  col-md-2  col-sm-3  col-4">
                      Выполнено
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-1  col-1 custom-radio ">
                    <div class="hidden"></div>
                    <label>
                        <input  id="checkDone" type="radio" name="radio" >
                        <div class="custom-radio__label custom-radio__label-start">
                        </div>
                      </label>
                    </div>
                  </div>
                </div>
                <!-- <div class="row">
                  <div class="col-lg-12 col-md-12 text-start mt-5">
                    <button type="submit" id="getBal" class="btn btn-success float-none py-3 px-3"><i class="fas fa-stop"></i>Посмотреть баланс</button>
                  </div>
                </div>
                 -->
              </div>
              <div class="col-lg-5 bg-light ms-2 me-2 px-4 py-4 rounded my-2">
               
                <div class="row  border-bottom py-3">
                <div class="col-lg-5 py-3">
                  <h5 class="text-start">Время старта:</h5>
                </div>
                <div class="col py-3">
                  <p class="start-time"></p>
                </div>
                </div>
                <div class="row mt-3  border-bottom py-3">
                <div class="col-lg-5 py-3">
                  <h5 class="text-start ">Текущее время:</h5>
                </div>
                <div class="col py-3">
                  <p id="currTime" class=""></p>
                </div>
                </div>
                
              </div>
            </div>
            <form action="" id="autoReg" class="d-flex justify-content-center align-items-center bg-light my-4 py-3 shadow row ms-auto me-auto px-5 py-5">
            <p class="mb-4 pb-2 border-bottom text-start">Введите данные для авторегистрации</p>
                      <div class="row">
                        <div class="col-md-5 col-sm-5 mx-2 my-2 d-flex justify-content-center align-items-center text-left">
                              <strong class="col-sm-5">
                              Количество ботов:
                              </strong>
                            <div class="col-md-6 col-sm-7 mx-2 my-2">
                              <input id="amounth" name="count" type="text" class="validation form-control" required>
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-5 mx-2 my-2 d-flex justify-content-center align-items-center text-left">
                              <strong class="col-sm-5">
                                  Страна приоритет:
                              </strong>
                            <div class="col-md-6 col-sm-7 mx-2 my-2">
                              <select class="form-control " name="country">
                                <option value="tier1">Топ 1 Страны</option>
                                <option value="tier2">Топ 2 Страны</option>
                                <option value="tier3">Топ 3 Страны</option>
                              </select>
                            </div>   
                        </div>   
                      </div> 
                      <div class="row text-start mt-4">
                      <table class="table">
                        <thead class="table-light">
                          <tr>
                            <th scope="col">                     </th>
                            <th scope="col">Текущая регистрация:</th>
                            <th scope="col">Последняя регистрация:</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Поставлено на регистрацию:</td>
                            <td id="currStatus"></td>
                            <td id="lastCount"></td>
                          </tr>
                          <tr>
                            <td>Удачно зарегистрировано:</td>
                            <td id="currGood"></td>
                            <td id="lastGood"></td>
                          </tr>
                          <tr>
                            <td>Попыток регистрации:</td>
                            <td id="currAll"></td>
                            <td id="lastAll"></td>
                          </tr>
                          <tr>
                            <td>Нет регистрации из ошибки:</td>
                            <td id="currBroken"></td>
                            <td id="lastBroken"></td>
                          </tr>
                        </tbody>
                      </table>
                              <div class="row d-flex justify-content-center align-items-center text-center my-3 ">
                               <strong class="reg-note" >Идет регистрация, подождите ...</strong>
                              </div>
                            </div>    
                        <div class="mt-3 mb-4 ">
                          <div class="row d-flex justify-content-center align-items-center">
                           
                            <div class="col-lg-4 col-md-4 col-sm-5 my-2">
                              <button type="submit" id="startReg" class="btn btn-success py-3 px-4"><i class="fas fa-play"></i>Начать регистрацию</button>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-5 my-2">
                              <button type="submit" id="stopReg" class="btn btn-danger float-none py-3 px-5" disabled><i class="fas fa-stop" ></i>Стоп</button>
                            </div>
                          </div>
                        </div>
                      </div>
            </form>
          </div>
        </main>
      </div>
      
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="/js/autoReg.js"></script>