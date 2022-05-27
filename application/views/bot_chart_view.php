<div id="layoutSidenav_content">
        <main>
          <h1 class="py-3 mt-4 mb-5 text-center bg-light">Состояние Ботов</h1>
                    <div class="row wow d-flex justify-content-center ">
                     
                      <div class="col-md-4 col-sm-10 mx-3 my-2">
                        <?php                   
                        $res = $data;
                        $botLang = $res['lang'];
                        $allBot = $res['bots']['all'];
                        $goodBot =  $res['bots']['good'];
                        $deadBot =  $allBot - $goodBot ;
                        echo '
                        <input type="hidden" id="allBot"value="'.$allBot.'" >
                        <input type="hidden" id="goodBot"value="'.$goodBot.'" >
                        <input type="hidden" id="deadBot"value="'.$deadBot.'" >'
                        ?> 
                        <div class="card">
                          <div class="card-body">
                            <canvas id="myChartAll"></canvas>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-10 mx-3 my-2">
                        <div class="card">
                          <div class="card-body">
                            <canvas id="myChart"></canvas>
                          </div>
                        </div>
                      </div>
                    </div>
                    <form action="" id="statusForm" class="bg-light my-4 shadow row ms-auto me-auto px-3 py-5">
                      <h3 class="mb-4 pb-2 border-bottom">Узнать состояние ботов по странам</h3>
                        <div class="row d-flex justify-content-center align-items-center">
                        
                            <div class="col-md-2 col-sm-2 mx-2 my-2">
                              <strong>
                                  Выберите язык:
                              </strong>
                            </div>
                            <div class="col-md-3 col-sm-2">
                              
                            <select class="form-control " name="lang" id="">
                              <?php 
                              foreach($botLang  as $key => $value) { 
                                foreach ($value as $lang)  {
                                  echo '<option value="'.$lang.'">'.$lang.'</option>';
                                }
                              }
                              ?>
                           
                            </select>
                             
                            </div>
                            <div class="text-center my-4">
                                <small class="text-muted">***что бы узнать состояние ботов по странам, выберите язык</small>
                            </div>
                            <div class="text-center">
                              <button id="checkStatusButton" type="submit" class="btn btn-primary">
                                  Проверить ботов
                              </button>
                            </div>
                          </div>
                      </form>
                      <form action="" id="geoForm" class="bg-light my-4 py-3 shadow row ms-auto me-auto px-5 py-5">
                      <h3 class="mb-4 pb-2 border-bottom">Узнать местоположение ботов</h3>
                        <div class="row d-flex justify-content-center align-items-center">
                            <div class="col-md-2 col-sm-4 ms-2">
                              <strong>
                                  Выберите страну:
                              </strong>
                            </div>
                            <div class="col-md-3 col-sm-3 mx-4">
                            <select class="form-control " name="lang" id="">
                            <?php 
                              foreach($botLang  as $key => $value) { 
                                foreach ($value as $lang)  {
                                  echo '<option value="'.$lang.'">'.$lang.'</option>';
                                }
                              }
                              ?>
                            </select>
                            </div>
                            <div class="col-md-3 col-sm-3  my-3">
                              <button id="getGeo" type="submit" class="btn btn-primary">
                                  Смотреть
                              </button>
                            </div>
                          </div>
                      </form>

                      <div id="map" class="row">

                      </div>

                  
            
        </main>
      </div>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="/js/status.js"></script>
