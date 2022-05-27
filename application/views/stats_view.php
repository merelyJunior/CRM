<div id="layoutSidenav_content">
        <main>
          <h1 class="py-3 mt-4 mb-5 text-center bg-light">Статистика</h1>
          <div class="container-fluid px-1">
              <div class="card">
                <div class="row align-items-center bg-dark text-light py-3 px-2 rounded-top">
                  <div class="col-md-4 col-sm-4">
                  <i class="far fa-calendar-alt"></i>
                  Статистика кликов
                  </div>
                  <div class="col-md-4 col-sm-4"></div>
                  <div class="col-md-4 col-sm-4">
                  <button id="clear" type="submit" class="btn btn-danger">
                    Очистить таблицу
                    <i class="far fa-calendar-times"></i>
                  </button>
                  </div>
                
                </div>
                
                <?php
                   $res = $data;
                   $botLang = $res['lang'];
                ?>
                <div id="tableContent">
                    <table class="tableStats table table-sm">
                      <thead class="table-light">
                        <tr>
                          <th>Название Диалога</th>
                          <th>Количество кликов</th>
                          <th>Количество регистраций</th>
                          <th>Прекратили диалог на сообщении</th>
                          <th>Количество ссылок</th>
                          <th>Проявили интерес</th>
                        </tr>
                      </thead>
                  </table>
                </div>
                
                <div class="preloader">
                  
                <div class="loader"></div>
                <p>Подождите, идет загрузка...</p>
                </div>
              </div>   
              
              <div class="row">
                <form action="" id="statsForm" class="bg-light my-4 py-3 shadow row ms-auto me-auto px-3 py-3">
                            <h3 class="mb-4 pb-2 border-bottom">Узнать статистику за промежуток времени</h3>
                              <div class="row d-flex justify-content-center align-items-center">
                                <div class="row my-2 align-items-center ">
                                  <div class="col-md-3 col-sm-3 mx-2 my-2 text-center">
                                      <strong>
                                          Начальная дата:
                                      </strong>
                                    </div>
                                    <div class="col-md-2 col-sm-2 mx-2 my-2">
                                      <input name="start" type="text" id="startDate" class="validation form-control " placeholder="гггг-мм-чч" value="" maxlength="10" " required>
                                    </div>
                                    <div class="col-md-3 col-sm-3 mx-2 my-2 text-center">
                                      <strong>
                                        Конечная дата:
                                      </strong>
                                    </div>
                                    <div class="col-md-2 col-sm-2 mx-2 my-2">
                                      <input name="end" type="text" id="endDate" class="validation form-control " placeholder="гггг-мм-чч" value="" maxlength="10" " required>
                                    </div>
                                </div>
                                <div class="row my-2 align-items-center ">
                                  <div class="col-md-3 col-sm-3 mx-2 my-2 text-center">
                                      <strong>
                                          Выберите язык диалога:
                                      </strong>
                                    </div>
                                    <div class="col-md-2 col-sm-2 mx-2 my-2 ">
                                      <select class="form-control " name="lang">
                                        <?php 
                                        foreach($botLang  as $key => $value) { 
                                          foreach ($value as $lang)  {
                                            echo '<option value="'.$lang.'">'.$lang.'</option>';
                                          }
                                        }
                                        ?>  
                                      
                                      </select>
                                    </div>
                                </div>
                                 
                                  
                                <div class="text-center my-4">
                                    <button id="getStats" type="submit" class="btn btn-primary">
                                        Проверить статистику
                                    </button>
                                    
                                </div>
                              </div>
                </form>
                <div class="row wow d-flex justify-content-center  animated tabs" style="visibility: visible;">
                <div class="bg-light mt-5">
                    <h3 class="pt-5 pb-3 text-center">
                      Посмотреть график статистики 
                    </h3>
                    <ul class="text-center mb-5">
                      <li class="btn btn-primary active  tabs__caption my-1 mx-1">
                        За день
                      </li>
                      <li class="btn btn-primary  tabs__caption my-1 mx-1">
                        За месяц</li>
                      <li class="btn btn-primary  tabs__caption my-1 mx-1">
                        За год</li>
                      <li class="btn btn-primary  tabs__caption my-1 mx-1">
                        За последние 4 года</li>
                    </ul>
                </div>
                    <!-- Графики начало-->
                  <div class="col-md-9">
                    <div class="card my-3 tabs__content active">
                      <div class="card-body">
                      <canvas id="dayStats"></canvas>
                      </div>
                    </div>
                    <div class="card my-3 tabs__content">
                      <div class="card-body">
                      <canvas id="monthStats"></canvas>
                      </div>
                    </div>
                    <div class="card my-3 tabs__content">
                      <div class="card-body">
                      <canvas id="lastYearStats"></canvas>
                      </div>
                    </div>
                    <div class="card my-3 tabs__content">
                      <div class="card-body">
                      <canvas id="yearStats"></canvas>
                      </div>
                    </div>
                   <!-- Графики конец графиков -->
                  </div>
                
              </div>
              
        </main>
      </div>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.js"></script>
<script src="/js/statsDay.js"></script>
<script src="/js/statsMonth.js"></script>
<script src="/js/statsLastYear.js"></script>
<script src="/js/statsYear.js"></script>
<script src="/js/statsDefault.js"></script>