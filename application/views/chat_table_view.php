<div class="container-fluid px-4">
            <div class="card mb-4">
              <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Таблица диалогов
              </div>
              <table
                    style="width: 100%"
                    id="dataTable"
                    class="card-body data-table tbody"
                  >
                    <thead class="thead-dark">
                      <tr>
                        <th class="table-header">Варианты диалогов</th>
                      </tr>
                    </thread>   
                    <tbody>
                      <?php
                      $res = json_decode($data[0]);
                     // echo '<pre>';print_r($res);
                        foreach($res as $row){

                          $dialogID = '<tr><td><a href="/chat/'.$row[0].'" class="tab-link">'.$row[4].'</a></td></tr>';

                          echo($dialogID);
                          
                        }
                      
                      ?>
                    </tbody>
                  </table>
            </div>
          </div>

          <script src="https://code.jquery.com/jquery-3.3.1.js"></script>