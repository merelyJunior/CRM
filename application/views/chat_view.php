<div id="layoutSidenav_content">
        <main>
        <h1 class="py-3 mt-4 mb-5 text-center bg-light">Crazybot чаты</h1>
          <div class="row">
            <div class="col-md-3">
                <?php include 'application/views/dialogue_list_view.php'; ?> 
            </div>
              <div class="col-md-8">
                <div class="row align-items-center bg-dark text-light py-3 px-2 rounded-top" >
                  <div class="col-md-6 ">
                  <?php  
                  $res = json_decode($data[1], true);
                  //  print_r($res[4]);
                  $curr = $res[4];
                  echo '<h3 class="">Текущий диалог: '.$curr.'</h3>'
                  ?> 
                  </div>
                  <div class="col-md-1 ">
                  </div>
                  <?php
                 
                  $res = json_decode($data[1], true);
                  
                  $dialogID = json_decode($res[0]);
                  
                  echo '<div class="col-md-3 text-end">
                          <a href="https://crm.crazybot.net/edit_dialogue/'.$dialogID.'" class="btn delete-dialogue-btn btn-success" >Редактировать <i class="fas fa-edit"></i></a>
                        </div>';
                        echo '<div class="col-md-2 text-end ">
                        <button type="button" id="delDialogueBtn" class="btn delete-dialogue-btn btn-danger" data-dialogue-id="'.$dialogID.'" >Удалить <i class="fas fa-trash-alt"></i></button>
                      </div>';
                  
                  ?>
                  
                </div>
                <div class="container-fluid  chat-body tab-content py-5">
                <?php
                  $res = json_decode($data[1], true);
                  $re = json_decode($res[1], true);

                  // echo "<pre>";
                  // print_r($res);
                  $ashotDialogue = array(
                    "Привет",
                    "Менэ завут Мурат",
                    "ты у меня вышла люди рядом",
                   
                    "Спасибо за исключения",
                    "Ты даже не посмотрела фото мае",
                    "Ничего вс хорошо на работе !",
                    "Или я не в твоём в кусе ?",
                    "Нет у меня на работе не до скука весь в движений !",
                    "Тебе очень понравится это знакомство ?",
                    "ну и где ты есть ?",
                    "Ну вот первый порок знакомство теперь приезжай ?",
                    "Почему игнорируешь не интересное предложения",
                    "Ну и теперь ты пропала нельзя поставить на зарядку телефон и по переписываться сомною",
                    "Ты красивая",
                    "А есть в инсте?",
                   "Пока что нет, но очень хочится😊",
                   "Приходи согрею",
                   "Давай трахатся",
                    "А тепло наверно может предоставить парень , муж ну и на крайней случай любовник", 
                    "А есть вацап?",
                    "А ты от куда?",
                    "Рановато как-то",
                    "Не че такая",
                    "Ну и теперь ты пропала нельзя поставить на зарядку телефон и по переписываться сомною",
                    "Ты красивая",
                    "Дела идут в гору,заработал вчера миллион",
                    "в какой еще секс инсте",
                    "давай встретимся на свидание",
                    "Зато настроение шикарное",
                    "Будем надеяться что так и есть 😂",
                    "Ко мне приезжай ?",
                    "я очень хочу дать тебе денег",
                    "тело огонь",
                    "скинь еще",
                    "говяжья голова",
                    "Дела идут в гору,заработал вчера миллион",
                    "в какой еще секс инсте",
                    "давай встретимся на свидание",
                    "скинь жопу",
                    "я женица хочу",
                    "что такой сек инста",
                    "э сабака сука",
                    "фотку давай",
                    "я зарегался",
                    "хорошо подпишусь",
                    "ты где?",
                    "куда пропала?",
                    "я уже регисторировался",
                    "как тебя там найти",
                    "э, ты где?",
                    "как тебя там найти",
                    "жопа огонь ",
                    "где мои деньги чучила",
                    "скинь еще сисек",
                    "курва",
                    "найду тебя",
                    "ну пожалуйста верни денег" ,
                    
                  );
                   $ashotDialogue2 = array(
                   "А есть в инсте?",
                   "Пока что нет, но очень хочится😊",
                   "Приходи согрею",
                   "Давай трахатся",
                    "А есть вацап?",
                    "А ты от куда?",
                    "Рановато как-то",
                    "Не че такая",
                    "Ты красивая",
                    "Дела идут в гору,заработал вчера миллион",
                    "в какой еще секс инсте",
                    "давай встретимся на свидание",
                    "Зато настроение шикарное",
                    "Будем надеяться что так и есть 😂",
                    "Ко мне приезжай ?",
                    "я очень хочу дать тебе денег",
                    "тело огонь",
                    "скинь еще",
                    "говяжья голова",
                    "Ничего вс хорошо на работе !",
                    "Или я не в твоём в кусе ?",
                    "Нет у меня на работе не до скука весь в движений !",
                    "Тебе очень понравится это знакомство ?",
                    "ну и где ты есть ?",
                    "Ну вот первый порок знакомство теперь приезжай ?",
                    "Почему игнорируешь не интересное предложения",
                    "Ты красивая",
                    "А есть в инсте?",
                   "Пока что нет, но очень хочится😊",
                   "Приходи согрею",
                   "Давай трахатся",
                    "А тепло наверно может предоставить парень , муж ну и на крайней случай любовник", 
                    "А есть вацап?",
                    "А ты от куда?",
                    "Рановато как-то",
                    "Не че такая",
                    "Ну и теперь ты пропала нельзя поставить на зарядку телефон и по переписываться сомною",
                    "Ты красивая",
                    "Дела идут в гору,заработал вчера миллион",
                    "в какой еще секс инсте",
                    "давай встретимся на свидание",
                    "Зато настроение шикарное",
                    "Будем надеяться что так и есть 😂",
                    "Ко мне приезжай ?",
                    "я очень хочу дать тебе денег",
                    "тело огонь",
                    "скинь еще",
                    "говяжья голова",
                    "Дела идут в гору,заработал вчера миллион",
                    "в какой еще секс инсте",
                    "давай встретимся на свидание",
                    "скинь жопу",
                    "я женица хочу",
                    "что такой сек инста",
                    "э сабака сука",
                    
                    "курва",
                    "найду тебя",
                    "ну пожалуйста верни денег" ,
                    
                  );
                  // print_r($ashotDialogue);
                    $count = 0; 
                    
                    // echo '<pre>';print_r($re);
                    foreach($re as $row){
                      
                          $dialogIDvar = $dialogID;
                            $status = $row['status'];
                            // print_r($status);
                            $sleep = $row['time'];
                            $file = $row['file'];
                            $link = $row['link'];
                            $ref = $row['ref'];
                            $incDialogText = "";
                            $text = $row["text"];
                            if(is_array($row['text'])){
                            
                              foreach($text as $textRow){
                                $incDialogText .= "\n";
                                $incDialogText .= $textRow;
                              }
                            }
                            // print_r($some); 
                            $count = $count + 1; 
                            $ashotText = '<div class="row"><p class="ashot-dialogue">'.$ashotDialogue[$count].'</p></div>'; 
                            $ashotText2 = '<div class="row"><p class="ashot-dialogue">'.$ashotDialogue2[$count].'</p></div>'; 
                            if($row["type"] == "message") {
                              $botDialogue = '
                              <div class="row">
                                <p class="bot-dialogue"><span class="editMessage" data-id="'.$row['position'].'">'.$row["text"][0].'</span><span class="status">'.$status.'</span></p>
                              </div>';
                              // echo $ashotText ;
                               if ($status === 'wait') {
                                echo $ashotText ;
                                }
                                echo $botDialogue;
                             
                            }
                            
                            
                            if ($sleep) {
                              if ($status === 'wait') {
                                echo $ashotText ;
                                }
                              echo '<div class="row"><p class="bot-dialogue"><span class="editMessage" data-d="'.$dialogID.'" data-id="'.
                              $row['position'].'">Ожиданиие:'.$sleep.'</span><span class="status">'.$status.'</span></p></div>';
                            }
                            if ($file) {
                              if ($status === 'wait') {
                                echo $ashotText ;
                                }
                              echo '<div class="row"><p class="bot-dialogue"><span class="editMessage" data-d="'.$dialogID.'" data-id="'.
                              $row['position'].'">'.$file .'</span><span class="status">'.$status.'</span></p></div>';
                             
                            }
                            if ($row["type"] == "link") {
                              if ($status === 'wait') {
                                echo $ashotText ;
                                }
                              echo '<div class="row"><p class="bot-dialogue"><span class="editMessage" data-d="'.$dialogID.'" data-id="'.
                              $row['position'].'">'.$incDialogText.'<br>'.$ref = $row['ref'].'</span><span class="status">'.$status.'</span></p></div>';
                            
                            }
                            
                          // print_r();
                    }
                 
                ?>
                
              </div>
            </div>
          </div>
        </main>
      </div>
      
      <script src="https://code.jquery.com/jquery-3.3.1.js"></script>