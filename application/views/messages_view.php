<div id="layoutSidenav_content">
        <main>
          <h1 class="py-3 mt-4 mb-5 text-center bg-light">Просмотр чатов</h1>
          <div class="container-fluid px-1">
            
            <div class="row">
              <div class="card rounded-top">
                        <h3 class="my-0 bg-dark text-light py-3 ps-5">Последние 100 чатов</h3>
                        <div id="tableContent" class="table-scroll mycustom-scroll table_sort" data-mcs-theme="dark-thin" >
                        <table id="messagesTable" class="table table-sm table-bordered">
                            <thead class="">
                              <tr>
                                  <th>Тип диалога</th>
                                  <th>Язык диалога</th>
                                  <th>ID бота</th>
                                  <th>ID пользователя</th>
                                  <th>ID диалога</th>
                                  <th>Закончился на сообщении</th>
                                  <th>Первое сообщение</th>
                                  <th>Последнее сообщение</th>
                                  <th>Отправленные ссылки</th>
                                </tr>
                            </thead>
                        </table>
                        <div class="preloader">
                              <div class="loader"></div>
                              <p class="text-center">Подождите, идет загрузка...</p>
                            </div>
                        </div>
              </div>  
            <div class="row">
              <div class="container-fluid bg-light shadow row ms-auto me-auto rounded-top bg-light ">
              <h3 class=" ps-5 mb-4 pb-2 border-bottom bg-dark text-light py-3">Поиск по чатам за промежуток времени</h3>
                    <form action="" id="getMessagesForm" class="">
                      <div class="row d-flex justify-content-center  pt-2 pb-3">
                      <div class="row my-2 ">
                                <div class="col-md-3 col-sm-3 mx-2 my-2 text-center align-items-center ">
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
                                        $res = $data;
                                        $botLang = $res['lang'];
                                        foreach($botLang  as $key => $value) { 
                                          foreach ($value as $lang)  {
                                            echo '<option value="'.$lang.'">'.$lang.'</option>';
                                          }
                                        }
                                        ?>  
                                      
                                      </select>
                                    </div>
                                </div>              
                        <div class="text-center  mt-3 mb-4 justify-content-center align-items-center">
                          <button id="getMessages" type="submit" class="btn btn-primary me-2">
                            Посмотреть
                          </button>
                          <button id="clearMess" type="submit" class="btn btn-danger  f-fix ms-2">
                            Очистить данные
                            <i class="far fa-calendar-times"></i>
                          </button> 
                        </div>
                      </div>
                    </form>
                  </div>
              
            </div> 
            <div class="row align-items-center bg-dark text-light py-3 px-2 mt-4 rounded-top">
                  <div class="text-center ">
                    <?php 
                     $currId = $re[$dialogID]['contact_id'];

                     echo '<h3 class="curr-id">Текущий пользователь #'.$currId.'</h3>';
                    ?>
                   
                  </div> 
                  <div class="container-fluid  chat-body tab-content py-5">

                  <div id="messBody" class="mess-body">
                    <?php
                             
                              // $message = $re[$dialogID]['text'];

                              // foreach($message as $textRow){
                              //   $messageId = "ID#" . $textRow['id'];
                              //     $userId = "От: " . $textRow['user'];
                              //     $date = $textRow['date'];
                              //     $message = $textRow['message'];
                              //     $someRow = 
                              //       '<div class="mess-body">
                              //         <div class="row">
                              //           <div class="col mess-user">'.$userId.'</div>
                              //           <div class="col mess-id">'.$messageId.'</div>
                              //         </div>
                              //         <div class="dialogue">
                              //           <p>'.$message.'</p>
                              //           <p class="col mess-date">'.$date.'</p>
                              //         </div>
                                     
                              //       </div>';
                              //       echo($someRow);
                              // }
                              
                            ?>
                  </div>      
            </div>
        </main>
      </div>
      
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.js"></script>
<script src="/js/lastDialogs.js"></script>