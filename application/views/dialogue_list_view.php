  <div class="container-fluid px-4">
              <div class="card mb-4 ">
                <div class="bg-dark text-light py-3 px-2 rounded-top">
                  <i class="fas fa-table me-1"></i>
                 Список диалогов в базе данныx
                </div>
                <table
                      style="width: 100%"
                      id="dataTable"
                      class="data-table tbody"
                    >
                     
                      <tbody>
                       
                        <?php
                        $res = json_decode($data[0]);
                        // print_r($res);
                          foreach($res as $row){

                            $dialogID = '<tr><td><a href="/chat/'.$row[0].'" class="tab-link">Диалог: '.$row[4].'<br> ID# '.$row[0].'</a></td></tr>';

                            echo($dialogID);
                            
                          }
                        
                        ?>
                      </tbody>
                    </table>
              </div>
            </div>

