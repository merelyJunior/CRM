<div id="layoutSidenav_content">
        <main>
        <h1 class="py-3 mt-4 mb-5 text-center bg-light">Редактор диалогов</h1>
          <div class="row">
             
                
                <div class="col-md-3">
                  <?php include 'application/views/dialogue_list_view2.php'; ?> 
                </div>
                <div class="col-md-6">
                  <?php
                      $res = json_decode($data[1], true);
                      $re = json_decode($res[1], true);
                      
                      //  print_r($row['text']);
                      $messageBody = '';
                      $messageID = 0;
                        foreach($re as $row){
                            $incdialogueName = $res[4];
                            $incSiteLink = $res[2];
                            $incLang = $res[3];
                            $incTypeOfMessage = $row['type'];
                            $incDialogStatus = $row['status'];
                            $incDialogReply = $row['reply'];
                            $incDialogTime = $row['time'];
                            $incDialogFile = $row['file'];
                            $incDialogLocation = $row['location']; 
                            $incDialogText = "";
                            $textVar = $row['text'];
                            if(is_array($row['text'])){
                            
                              foreach($textVar as $textRow){
                                $incDialogText .= "\n";
                                $incDialogText .= $textRow;
                              }
                            }
                            $messageID = $messageID + 1;
                            $messageBody.=
                              '
                                <fieldset class="card p-2 mt-3" data-id="id'.strval($messageID).'">
                                  <div class="row justify-content-between">
                                    <legend class="col-md-7">Сообщение</legend>
                                    <div class="col">
                                        <button type="button" data-delete="'.strval($messageID).'" class="btn btn-danger delete-message-btn ">x</button>
                                    </div>
                                    
                                  </div>
                                  <div class="row">
                                        <div class="col-md-4">
                                          <label for="type">Тип сообщения:</label>
                                          <select class="form-control" id="type" name="dialog[id'.strval($messageID).'][type]">
                                              <option>'.$incTypeOfMessage.'</option>
                                              <option value="message">message</option>
                                              <option value="sleep">sleep</option>
                                              <option value="file_photo">file_photo</option>
                                              <option value="file_audio">file_audio</option>
                                              <option value="file_video>file_video</option>
                                              <option value="link">link</option>
                                          </select>
                                        </div>
                                        <div class="col-md-4">
                                          <label for="statusSelect">Status</label>
                                          <select
                                                  class="form-control mb-3"
                                                  id="statusSelect"
                                                  name="dialog[id'.strval($messageID).'][status]"
                                          >
                                              <option>'.$incDialogStatus.'</option>
                                              <option>nowait</option>
                                              <option>wait</option>
                                          </select>
                                        </div>
                                        <div class="col-md-4">
                                          <label for="replySelect">Reply</label>
                                          <select
                                                  class="form-control mb-3"
                                                  id="replySelect"
                                                  name="dialog[id'.strval($messageID).'][reply]"
                                          >
                                              <option>'.$incDialogReply.'</option>
                                              <option value="last">last</option>
                                              <option value="link">link</option>
                                          </select>
                                        </div>
                                  </div>       
                                  <div class="row">
                                          <div class="col-md-4 col-md-4 mb-3">
                                              <label for="time">Time:</label>
                                              <input
                                                      class="form-control mb-3"
                                                      type="text"
                                                      id="time"
                                                      name="dialog[id'.strval($messageID).'][time]"
                                                      placeholder="Указывать в мс"
                                                      maxlength="6"
                                                      value="'.$incDialogTime.'"
                                              />
                                          </div>
                                          <div class="col-md-4 col-md-4 mb-3">
                                              <label for="file">File:</label>
                                              <input
                                                      type="text"
                                                      class="form-control mb-3"
                                                      id="file"
                                                      name="dialog[id'.strval($messageID).'][file]"
                                                      value="'.$incDialogFile.'"
                                              />
                                          </div>
                                          <div class="col-md-4 col-md-4 mb-3">
                                              <label for="location">Location:</label>
                                              <select
                                                      class="form-control mb-3"
                                                      id="location"
                                                      name="dialog[id'.strval($messageID).'][location]"
                                              >
                                                  <option value="">'.$incDialogLocation.'</option>
                                                  <option value="public">public</option>
                                                  <option value="private">private</option>
                                                  
                                              </select>
                                          </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-12">
                                        <label for="exampleFormControlTextarea"
                                        >Варианты сообщений:</label
                                        >
                                        <textarea
                                                name="dialog[id'.strval($messageID).'][text]"
                                                class="form-control mb-3"
                                                id="exampleFormControlTextarea"
                                                rows="3"
                                                placeholder="Ввод каждого из вариантов сообщения делать с новой строки, с любого устройства"
                                        >'.$incDialogText.'</textarea>
                                    </div>
                                  </div>
                                
                                </fieldset>
                             ';
                          
                        }
                        $dialogID = json_decode($res[0]);
                            $formBody =
                            '<form method="POST" action="" id="dataForms" class="bg-light px-5 py-5 mb-6 shadow">
                              <input type="hidden" id="dialogId" data-dialogue-id="'.$dialogID.'">
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
                                                  value="'.$incdialogueName.'"
                                          />
                                      </div>
                                  </div>
                                  <div class="col-md-5">
                                      <label for="siteLink">URL:</label>
                                      <input
                                              id="siteLink"
                                              type="text"
                                              class="form-control mb-3"
                                              placeholder="Ссылка на сайт"
                                              name="siteLink"
                                              value="'.$incSiteLink.'"
                                      />
                                  </div>
                                  <div class="col-md-2">
                                      <label for="langSelect">Язык:</label>
                                      <select class="form-control mb-3" id="langSelect" name="lang" >
                                          <option selected>'.$incLang.'</option>
                                          <option selected value="RU">RU</option>
                                          <option value="EN">EN</option>
                                          <option value="DE">DE</option>
                                      </select>
                                  </div>
                              </div>
                              <div id="dialogsSet" class="mb-3">
                              '.$messageBody.'
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
                                      class="btn btn-primary mb-2"
                              >
                                  Добавить диалог
                              </button>
                              </div>
                              </div>
                            </form>';
                            echo($formBody);
                    ?>
                </div>
            
            
            </div>
          </div>
          
         
         
        </main>
      </div>