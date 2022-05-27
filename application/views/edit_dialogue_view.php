<div id="layoutSidenav_content">
        <main>
        <h1 class="py-3 mt-4 mb-5 text-center bg-light">Редактор диалогов</h1>
          <div class="row">
                <div class="col-md-3">
                  <?php include 'application/views/dialogue_list_view2.php'; ?> 
                </div>
                <div class="col-md-8">
                  <?php
                      $res = json_decode($data[1], true);
                      $re = json_decode($res[1], true);
                      $dialogID = json_decode($res[0]);
                      // echo "<pre>";
                      // print_r($res);
                      $messageBody = '';
                      $messageID = 0;
                      // правка
                      $incTypeOfDialogue = $res[4];
                      // $incSiteLink = $res[2];
                      $incLang = $res[3];
                      // print_r($incLang);
                      // правка
                        foreach($re as $row){
                            $incTypeOfMessage = $row['type'];
                            $incDialogStatus = $row['status'];
                            $incDialogReply = $row['reply'];
                            // print_r($incDialogReply);
                            $incDialogTime = $row['time'];
                            $incDialogFile = $row['file'];
                            $incDialogLocation = $row['location']; 
                            $incDialogRef = $row['ref'];
                            $incDialogText = "";
                            
                            $textVar = $row['text'];
                            
                            if(is_array($row['text'])){
                            
                              foreach($textVar as $textRow){
                                $incDialogText .= "\n";
                                $incDialogText .= $textRow;
                              }
                            }
                            $messageID = $messageID + 1;
                            // правка
                            $optionsChecked ='<option value="message">message</option>
                                              <option value="sleep">sleep</option>
                                              <option value="file_photo">file_photo</option>
                                              <option value="file_audio">file_audio</option>
                                              <option value="file_video">file_video</option>
                                              <option value="link">link</option>';

                            $res = '';
                            $pos = strpos($optionsChecked, $incTypeOfMessage);
                            $str_to_insert = ' selected="selected"';
                            if ($pos === false) {
                              $res = 'error';
                            } else {
                                $newstr = substr_replace($optionsChecked, $str_to_insert, $pos - 8, 0);
                            }

                            $locationChecked = '<option value="public">public</option>
                                                <option value="private">private</option>';
                            
                            $statusChecked = '<option value="wait">wait</option>
                                              <option value="nowait">nowait</option>';

                            $langChecked = '<option value="RU">RU</option>
                                              <option value="EN">EN</option>
                                              <option value="DE">DE</option>
                                              <option value="ES">ES</option>
                                              <option value="FR">FR</option>
                                              <option value="IT">IT</option>';
                            
                            $replyChecked = '<option selected value="none">none</option>
                                              <option value="link">link</option>
                                              <option value="last">last</option>
                                              ';
                                                                  
                                              
                            
                            $pos1 = strpos($locationChecked, $incDialogLocation);
                            if ($pos1 === false) {
                                $newstr1 = $locationChecked;
                            } else {
                                $newstr1 = substr_replace($locationChecked, $str_to_insert, $pos1 - 8, 0);
                            }
                            // echo('<pre>');
                            // print_r($pos1);
                            $pos2 = strpos($statusChecked, $incDialogStatus);
                            if ($pos2 === false) {
                                $newstr2 = $statusChecked;
                            } else {
                                $newstr2 = substr_replace($statusChecked, $str_to_insert, $pos2 - 8, 0);
                            }
                            
                            $pos3 = strpos($langChecked, $incLang);
                            if ($pos3 === false) {
                                $newstr3 = $langChecked;
                            } else {
                                $newstr3 = substr_replace($langChecked, $str_to_insert, $pos3 - 8, 0);
                            }
                            $pos4 = strpos($replyChecked, $incDialogReply);
                            // print_r($pos4);
                            if ($pos4 === false) {
                                $newstr4 = $replyChecked;
                            } else {
                                $newstr4 = substr_replace($replyChecked, $str_to_insert, $pos4 - 8, 0);
                
                            }
                            //правка
                            $messageBody.=
                              '
                                <fieldset class="card p-2 mt-3" data-id="'.strval($messageID).'">
                                  <div class="row justify-content-between">
                                    <legend class="col-md-7">Сообщение</legend>
                                    <div class="col">
                                        <button type="button" data-delete="'.strval($messageID).'" class="btn btn-danger delete-message-btn ">x</button>
                                    </div>
                                    
                                  </div>
                                  <div class="row">
                                        <div class="col-md-4">
                                          <label for="type">Тип сообщения:</label>
                                          <select class="form-control type" onchange="changeState(this)" name="type">
                                              '.$newstr.''.$res.'
                                              
                                          </select>
                                        </div>
                                        <div class="col-md-4">
                                          <label for="statusSelect">Status</label>
                                          <select
                                                  class="form-control mb-3"
                                                  id="statusSelect "
                                                  name="status"
                                          >'.$newstr2.''.$res.'
                                              
                                          </select>
                                        </div>
                                        <div class="col-md-4">
                                          <label for="replySelect">Reply</label>
                                          <select
                                                  class="form-control mb-3"
                                                  id="replySelect"
                                                  name="reply"
                                          >'.$newstr4.''.$res.'</select>
                                        </div>
                                  </div>       
                                  <div class="row">
                                          <div class="col-md-4 col-md-4 mb-3">
                                              <label for="time">Time:</label>
                                              <input
                                                      disabled
                                                      class="form-control mb-3"
                                                      type="text"
                                                      id="time"
                                                      name="time"
                                                      placeholder="Указывать в мс"
                                                      maxlength="6"
                                                      value="'.$incDialogTime.'"
                                              />
                                          </div>
                                          <div class="col-md-4 col-md-4 mb-3">
                                              <label for="file">File:</label>
                                              <input  disabled
                                                      type="text"
                                                      class="form-control mb-3"
                                                      id="file"
                                                      name="file"
                                                      value="'.$incDialogFile.'"
                                              />
                                          </div>
                                          <div class="col-md-4 col-md-4 mb-3">
                                              <label for="location">Location:</label>
                                              <select
                                                      class="form-control mb-3"
                                                      id="location"
                                                      name="location">
                                                      '.$newstr1.''.$res.'
                                                  
                                                  
                                              </select>
                                          </div>
                                          <div class="col-md-4 col-md-4 mb-3">
                                            <label for="ref">Reference:</label>
                                            <input
                                                    disabled
                                                    type="text"
                                                    class="form-control mb-3"
                                                    id="ref"
                                                    name="ref"
                                                    value="'.$incDialogRef.'"
                                            />
                                          </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-12">
                                        <label for="exampleFormControlTextarea"
                                        >Варианты сообщений:</label
                                        >
                                        <textarea
                                                name="text"
                                                class="form-control mb-3"
                                                id="exampleFormControlTextarea"
                                                rows="5"
                                                placeholder="Ввод каждого варианта с новой строки"
                                        >'.$incDialogText.'</textarea>
                                    </div>
                                  </div>
                                  <div>
                                  <button type="button"
                                          class="mb-3 btn btn-primary rounded-circle editAddDialog">+</button>
                                  </div>
                                
                                </fieldset>
                             ';
                            
                        }
                        $token = $_SESSION['access'];
                            $formBody =
                            '<form method="POST" action="" id="dataForms" class="bg-light px-5 py-5 mb-6 shadow">
                              <h3 class="mb-4 pb-2 border-bottom">Текущий диалог</h3>
                              <div class="row mt-2 mb-1" id="dialogData">
                                <input type="hidden"  name="access" value="'.$token.'">
                                <input type="hidden" name="id" value="'.$dialogID.'">
                                  <div class="col-md-4">
                                      <div class="col">
                                          <label for="typeOfDialogue">Название диалога:</label>
                                          <input
                                                  name="typeOfDialogue"
                                                  type="text"
                                                  id="typeOfDialogue"
                                                  class="form-control"
                                                  placeholder=""
                                                  value="'.$incTypeOfDialogue.'"
                                          />
                                      </div>
                                  </div>
                                 
                                  <div class="col-md-2">
                                      <label for="langSelect">Язык:</label>
                                      <select class="form-control mb-3" id="langSelect" name="lang" >
                                          <option selected>'.$newstr3.'</option>
                                      </select>
                                  </div>
                              </div>
                              <div id="dialogsSet" class="mb-3">
                              '.$messageBody.'
                              </div>
                              <div class="text-center">
                              <button
                                      id="postButton"
                                      type="submit"
                                      class="btn btn-primary mb-2"
                              >
                              Сохранить
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
      <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
      <script src="/js/dialogue_edit_add.js"></script>