<div id="layoutSidenav_content">
  <main>
    <div class="row mt-4 mx-5">
      <div class="p-4 border bg-light card rounded-top text-center">
          <h3 class="py-2 border-bottom">Изменить профиль</h3>
          <form id="" class="bg-light my-4 py-3 row">
            <div class="row my-3 align-items-end">
              <div class="col-lg-4 col-6 ms-auto me-0 m-clear">
                <label for="fileAudio" class="my-2 text-start small">Открыть профиль с ID:</label>
                <input type="text" name="" class="form-control" id="" placeholder="Введите ID">
              </div>
              <div class="col-lg-4 col-6 ms-0 me-auto m-clear">
                <a href="#popup" class="btn btn-success px-4 py-3 show-popup " data-effect="mfp-zoom-in">
                  Открыть
                </a>
              </div>
            </div>
          </form>
          <div class="card mt-5">
        <div class="row align-items-center py-3 px-2 rounded-top profile-edit-table">
          <div class="col-md-4 col-sm-4">
            Существующие профили:
          </div>
        </div>       
        <div>
          <div class="table-scroll">
          <table class="table table-sm ">
            <thead class="table-light">
              <tr>
                <th class="text-start">ID:</th>
                <th class="text-start">Фото:</th>
                <th class="text-start">Видео:</th>
                <th class="text-start">Био:</th>
              </tr>
            </thead>
            <tr>
              <td class="px-3 py-2 small">1</td>
              <td class="px-3 py-2 small">face1.jpg;nude1.jpg;face2.jpg;nude2.jpg</td>
              <td class="px-3 py-2 small">video.mp4</td>
              <td class="px-3 py-2 small">i love</td>
            </tr>
            <tr>
              <td class="px-3 py-2 small">2</td>
              <td class="px-3 py-2 small">face1.jpg;nude1.jpg;face2.jpg;nude2.jpg</td>
              <td class="px-3 py-2 small">video.mp4</td>
              <td class="px-3 py-2 small">i love sun</td>
            </tr>
            <tr>
              <td class="px-3 py-2 small">3</td>
              <td class="px-3 py-2 small">face1.jpg;nude1.jpg;face2.jpg;nude2.jpg</td>
              <td class="px-3 py-2 small">video.mp4</td>
              <td class="px-3 py-2 small">i love))</td>
            </tr>
          
          </table>
          </div>
          
        </div>     
      </div>
    </div>
    </div>
   
    <div>
  </main>
 
<div id="popup" class="white-popup mfp-with-anim mfp-hide">
  <div class="popup-inner">
    <div class="p-4 border bg-light card rounded-top text-center">
      <h3 class="py-2 border-bottom">Редактировать профиль</h3>
      <form id="" class="bg-light my-4 py-3 row">
        <div class="row my-3">
          <div class="col-lg-6 col-8 ms-auto me-auto m-clear">
            <label for="fileVideo" class="my-2 text-start small">Выберите видео файл:</label>
            <input type="file" name="fileVideo" class="form-control-file  ms-0 m-left" id="fileVideo">
          </div>
          <div class="col-lg-4 col-3 me-auto ms-0 m-clear"></div>
        </div>
        <div class="row my-3 align-items-end">
          <div class="col-lg-6 col-8 ms-auto me-0 m-clear">
          <label for="addImages" class="my-2 text-start small">Выберите фото:</label>
            <input type="file" name="addImages" id="addImages" multiple="">
          </div>
          <div class="col-lg-4 col-3 me-auto ms-0 m-clear">
            <label for="typePhoto" class="my-2 text-start small">Тип фото:</label>
            <select class="form-control" id="" name="typePhoto">
                <option selected="" value="nude">nude</option>
                <option value="face">face</option>
            </select>
          </div>
          <div class="row">
                      <div id="uploadImagesList" class="d-flex flex-row flex-wrap my-3 ms-a me-a">
                          <div class="item template">
                              <div class="img-wrap">
                                  <img src="image.jpg" alt="">
                              </div>
                              <span class="delete-link" ><i class="fas fa-times"></i></span>
                          </div>
                      </div>
                      <div class="clear"></div>
                    </div>
        </div>
        <div class="text-center">
          <button id="" type="submit" class="btn btn-success my-4 px-3">
              Добавить
          </button>
        </div>
        <div class="col-lg-12 col-12">
          <label for="" class="my-2 text-start small">Био:</label>
          <textarea name="" class="form-control mb-3" id="" rows="5" placeholder="Ввод каждого варианта с новой строки"></textarea>
        </div>
        <div class="text-center">
          <button id="" type="submit" class="btn btn-primary mt-4">
              Сохранить
          </button>
        </div>
      </form>
    </div>
  </div>
  </div>
</div>