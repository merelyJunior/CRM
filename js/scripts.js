/*!
 * Start Bootstrap - SB Admin v7.0.3 (https://startbootstrap.com/template/sb-admin)
 * Copyright 2013-2021 Start Bootstrap
 * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
 */
//
// Scripts
//
window.addEventListener("DOMContentLoaded", (event) => {
  // Toggle the side navigation
  const sidebarToggle = document.body.querySelector("#sidebarToggle");
  if (sidebarToggle) {
    // Uncomment Below to persist sidebar toggle between refreshes
    // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
    //     document.body.classList.toggle('sb-sidenav-toggled');
    // }
    sidebarToggle.addEventListener("click", (event) => {
      event.preventDefault();
      document.body.classList.toggle("sb-sidenav-toggled");
      localStorage.setItem(
        "sb|sidebar-toggle",
        document.body.classList.contains("sb-sidenav-toggled")
      );
    });
  }
});

// Удаление диалога

$("#delDialogueBtn").click(function (e) {
  confirm("!!!!!!!ВНИМАНИЕ УДАЛЕНИЕ РАБОТАЕТ!!!!!!!!!!!");
  // console.log("кнопка тыц");
  if (confirm("Диалог будет полностью удалён!Подтвердить?")) {
    var deleteIdData = $("#delDialogueBtn").attr("data-dialogue-id");
    $.ajax({
      url: "/delete.php",
      type: "POST",
      data: deleteIdData,
      contentType: "application/json",
      dataType: "json",
      success: function () {
        // console.log(deleteIdData);
        $(".chat-body").animate(
          {
            opacity: 0,
          },
          300,
          function () {
            $(this).html("Диалог удален!");
            $(this).css({
              opacity: 1,
              background: "none",
              "text-align": "center",
            });
          }
        );
        setTimeout(function () {
          window.location.href = "https://crm.crazybot.net/chat/";
        }, 100);
      },
      error: function () {
        alert("error");
        // console.log("не отправил");
      },
    });
  }
});

// Корректировка времени
$("body").on("input", "#time", function () {
  this.value = this.value.replace(/[^0-9]/g, "");
});

// условия для отображения инпутов
function changeState(inp) {
  // console.log($(inp).val());
  var parent = $(inp).parent().parent().parent();
  if ($(inp).val() == "message" || $(inp).val() == "link") {
    parent.find("#ref").removeAttr("disabled", "disabled");
    parent.find("#statusSelect").removeAttr("disabled", "disabled");
    parent.find("#replySelect").removeAttr("disabled", "disabled");
    parent
      .find("#exampleFormControlTextarea")
      .removeAttr("disabled", "disabled");

    parent.find("#location").attr("disabled", "disabled");
    // parent.find("#location").val("");
    parent.find("#time").attr("disabled", "disabled");
    parent.find("#time").val("");
    parent.find("#file").attr("disabled", "disabled");
    parent.find("#file").val("");
    // console.log("работает");
    // parent.css( "background", "yellow" );
  } else if ($(inp).val() == "sleep") {
    parent.find("#ref").attr("disabled", "disabled");
    parent.find("#statusSelect").removeAttr("disabled", "disabled");
    parent.find("#time").removeAttr("disabled", "disabled");
    parent.find("#location").attr("disabled", "disabled");
    // parent.find("#location").val("");
    parent.find("#replySelect").attr("disabled", "disabled");
    parent.find("#replySelect").val("none");
    parent.find("#exampleFormControlTextarea").attr("disabled", "disabled");
    parent.find("#exampleFormControlTextarea").val("");
    parent.find("#file").attr("disabled", "disabled");
    parent.find("#file").val("");
    parent.find("#location").attr("disabled", "disabled");
    // parent.find("#location").val("");
    // parent.css( "background", "blue" );
  } else if (
    $(inp).val() == "file_photo" ||
    $(inp).val() == "file_audio" ||
    $(inp).val() == "file_video"
  ) {
    parent.find("#ref").attr("disabled", "disabled");
    parent.find("#statusSelect").removeAttr("disabled", "disabled");
    parent.find("#file").removeAttr("disabled", "disabled");
    parent.find("#location").removeAttr("disabled", "disabled");
    parent.find("#exampleFormControlTextarea").attr("disabled", "disabled");
    parent.find("#time").attr("disabled", "disabled");
    // parent.css( "background", "red" );
  }
  $(inp).css("background", "lightgreen");
}

// Геопозиция по странам

function initMap() {
  var startCord = { lat: 59.922995, lng: 30.289675 };
  var map = new google.maps.Map(document.getElementById("map"), {
    zoom: 5,
    center: startCord,
  });
  new google.maps.Marker({
    position: startCord,
    map,
    title: "Hello World!",
  });
}

$("#getGeo").on("click", function (e) {
  e.preventDefault();
  var $dataForm = {};
  $("#geoForm")
    .find("select")
    .each(function () {
      $dataForm[this.name] = $(this).val();
    });
  function statusJson() {
    return JSON.stringify($dataForm["lang"]);
  }
  // console.log(statusJson());
  $.ajax({
    url: "/geo.php",
    type: "POST",
    contentType: "application/json",
    data: statusJson(),
  }).done(function (_data) {
    var geoData = JSON.parse(_data);
    // console.log(_data);
    var startCord = { lat: 59.922995, lng: 30.289675 };
    var map = new google.maps.Map(document.getElementById("map"), {
      zoom: 5,
      center: startCord,
    });
    for (key in geoData) {
      lt = Number(geoData[key]["geo"]["lt"]);
      lng = Number(geoData[key]["geo"]["lng"]);
      geoId = geoData[key]["dialog_id"];
      geoPhone = geoData[key]["phone"];
      myLatLng = { lat: lt, lng: lng };
      title = { ID: geoId, Phone: geoPhone };
      // console.log(typeof title);
      var marker = new google.maps.Marker({
        position: myLatLng,
        title: JSON.stringify(title),
      });
      marker.setMap(map);
    }
  });
});

$("#getStats").on("click", function (e) {
  e.preventDefault();
  var $dataForm = {};
  $("#statsForm")
    .find("input,select")
    .each(function () {
      $dataForm[this.name] = $(this).val();
    });
  function statusJson() {
    return JSON.stringify($dataForm);
  }
  $(".preloader").fadeIn();
  $.ajax({
    url: "/stats.php",
    type: "POST",
    contentType: "application/json",
    data: statusJson(),
  }).done(function (data) {
    // console.log(data);
    var data = JSON.parse(data);
    for (key in data) {
      type = data[key]["type"];
      click = data[key]["click"];
      reg = data[key]["reg"];
      averageMesId = data[key]["average_mes_id"];
      linksSent = data[key]["links_sent"];
      numDialogs = data[key]["num_dialogs"];
      let row = document.createElement("tr");
      row.innerHTML = `
        <tr>
          <td class="new-row">${type}</td>
          <td class="new-row">${click}</td>
          <td class="new-row">${reg}</td>
          <td class="new-row">${averageMesId}</td>
          <td class="new-row">${linksSent}</td>
          <td class="new-row">${numDialogs}</td>
          
        </tr>
      `;
      document.querySelector(".tableStats").appendChild(row);
    }
  });
  return false;
});

$("#clear").click(function () {
  $(".new-row").remove();
  $("#clear").fadeOut();
});
$("#clearMess").click(function (e) {
  e.preventDefault();
  $(".new-row").remove();
  $(".forTest").remove();
});

$(function () {
  $(".tabs__caption").on("click", function () {
    $(this)
      .addClass("active")
      .siblings()
      .removeClass("active")
      .closest("div.tabs")
      .find("div.tabs__content")
      .removeClass("active")
      .eq($(this).index())
      .addClass("active");
  });
});

document.addEventListener("DOMContentLoaded", () => {
  const getSort = ({ target }) => {
    const order = (target.dataset.order = -(target.dataset.order || -1));
    const index = [...target.parentNode.cells].indexOf(target);
    const collator = new Intl.Collator(["en", "ru"], { numeric: true });
    const comparator = (index, order) => (a, b) =>
      order *
      collator.compare(
        a.children[index].innerHTML,
        b.children[index].innerHTML
      );

    for (const tBody of target.closest("table").tBodies)
      tBody.append(...[...tBody.rows].sort(comparator(index, order)));

    for (const cell of target.parentNode.cells)
      cell.classList.toggle("sorted", cell === target);
  };

  document
    .querySelectorAll(".table_sort thead")
    .forEach((tableTH) =>
      tableTH.addEventListener("click", () => getSort(event))
    );
});

// Просмотр чатов, чаты по датам
function getDialog2(e, id) {
  if (id != 0) id = $(this).find("td:first").attr("data-id");

  var dataMessagesByDate = JSON.parse($("#dataMessages").val());
  // console.log(dataMessagesByDate.dialog[id]);
  $(".curr-id").text(
    "Текущий пользователь #" + dataMessagesByDate.dialog[id]["contact_id"]
  );
  var dialogContentBottom = dataMessagesByDate.dialog[id]["all_dialog"];

  var textId = 0;
  var user = "";
  var date = "";
  var curMessage = "";
  var messBody = "";
  for (i = 0; i < Object.keys(dialogContentBottom).length; i++) {
    textId = dialogContentBottom[i]["id"];
    user = dialogContentBottom[i]["user"];
    date = dialogContentBottom[i]["date"];
    curMessage = dialogContentBottom[i]["message"];
    messBody += `<div class="forTest">
                        <div class="row">
                          <div class="col mess-user">${user}</div>
                          <div class="col mess-id">${textId}</div>
                        </div>
                        <div class="dialogue">
                          <p>${curMessage}</p>
                          <p class="col mess-date">${date}</p>
                        </div>
                      </div>`;
  }
  $("#messBody").html(messBody);
}
$("#getMessages").on("click", function (e) {
  $(document).off();
  $(document).on("click", "#messagesTable tr", getDialog2);
  e.preventDefault();
  $("#messagesTable tr").not(":first").html("");
  var $dataForm = {};
  $("#getMessagesForm")
    .find("input,select")
    .each(function () {
      $dataForm[this.name] = $(this).val();
    });
  function messagesJson() {
    return JSON.stringify($dataForm);
  }
  // console.log(statusJson());
  $(".preloader").fadeIn();
  $.ajax({
    url: "/getMessages.php",
    type: "POST",
    contentType: "application/json",
    data: messagesJson(),
  }).done(function (data) {
    $(".preloader").fadeOut();
    // Save json data in input hidden
    $("#dataMessages").val(data);
    var data = JSON.parse(data);
    data = data["dialog"];
    // console.log(data);
    for (key in data) {
      // console.log(data[key]);
      type = data[key]["type"];
      lang = data[key]["lang"];
      botId = data[key]["bot_id"];
      contId = data[key]["contact_id"];
      dataEnd = data[key]["date_end"];
      dialogId = data[key]["dialog_id"];
      dataStart = data[key]["date_start"];
      lastMessId = data[key]["last_message_id"];
      linkSent = data[key]["link_sent"];
      let rowTable = document.createElement("tr");
      rowTable.innerHTML = `
                <tr>
                  <td class="new-row" data-id="${key}">${type}</td>
                  <td class="new-row">${lang}</td>
                  <td class="new-row">${botId}</td>
                  <td class="new-row">${contId}</td>
                  <td class="new-row">${dialogId}</td>
                  <td class="new-row">${dataEnd}</td>
                  <td class="new-row">${dataStart}</td>
                  <td class="new-row">${lastMessId}</td>
                  <td class="new-row">${linkSent}</td>
                </tr>
              `;
      $("#messagesTable").append(rowTable);
    }
    getDialog2(null, 0);
  });
  return false;
});

const dT = new DataTransfer();
var maxFileSize = 2 * 1024 * 1024; // (байт) Максимальный размер файла (2мб)
var form = $("#uploadMedia");
var queue = {};
var imageList;

//===========Отправка "Добавить Имя"==================

$("#addNames").on("click", function (e) {
  console.log("тыц");
  e.preventDefault();
  var $dataForm = {};
  $("#addBio")
    .find("input,select")
    .each(function () {
      $dataForm[this.name] = $(this).val();
    });
  console.log($dataForm);
  $.ajax({
    url: "/profileAdd.php",
    type: "POST",
    contentType: "application/json",
    data: $dataForm,
  }).done(function () {
    alert("Отправили файл");
  });
  return false;
});

// Слушатель на инпуты
function onChangeHandler(event) {
  const target = event.target;
  let name = $(target).data("filename");
  var files = target.files;
  let filesArray = files;
  let counter;
  for (var i = 0; i < filesArray.length; i++) {
    counter = Object.values(queue).filter((item) =>
      item.name.includes(name)
    ).length;
    var file = files[i];
    if (!file.type.match(/image\/(jpeg|jpg|png|gif)/)) {
      alert("Фотография должна быть в формате jpg, png или gif");
      continue;
    }

    if (file.size > maxFileSize) {
      alert("Размер фотографии не должен превышать 2 Мб");
      continue;
    }
    updateFiles(file, name, counter);
  }
  target.value = "";
}
//Переименование файла
function renameFile(originalFile, newName) {
  return new File([originalFile], newName, {
    type: originalFile.type,
    lastModified: originalFile.lastModified,
  });
}

function clearQueue() {
  for (const prop in queue) {
    delete queue[prop];
  }
}

// Создание превью
function preview(file, name) {
  var reader = new FileReader();

  reader.addEventListener("load", function (event) {
    var img = document.createElement("img");

    var itemPreview = document
      .querySelector("#itemTemplate")
      .content.cloneNode(true);

    $(itemPreview).find(".img-wrap img").attr("src", event.target.result);
    $(itemPreview).find(".item").attr("data-id", file.name);
    $(itemPreview).find(".img-name span").text(file.name);
    $(itemPreview).find(".delete-link").click(onClickDeleteImage);
    $(imageList).append(itemPreview);
  });
  reader.readAsDataURL(file);
}

// Добавление и обновление файлов в очереди
function updateFiles(file, name, index) {
  index++;
  dT.clearData();
  imageList = $(`[data-list="${name}"]`);
  // console.log(file.name);
  let extOfFile = file.name.split(".")[1];
  const newFile = renameFile(file, `${name}${index}.${extOfFile}`);
  dT.items.add(newFile);
  for (dTFile of dT.files) {
    preview(dTFile);
    queue[dTFile.name] = dTFile;
  }
}

// Функция слушатель на удаление превью
function onClickDeleteImage(event) {
  const item = event.currentTarget.parentNode;
  var id = $(item).data("id"),
    name = $(item)
      .data("id")
      .split(".")[0]
      .replace(/[0-9]?/g, "");
  // Временный объект
  const tempQueue = {};
  // Клонируем основной объект во временный объект
  Object.assign(tempQueue, queue);
  // Чистим объект от мусора
  for (const prop of Object.getOwnPropertyNames(queue).filter((item) =>
    item.includes(name)
  )) {
    delete queue[prop];
  }
  // Удаляем картинку по ID из временного объекта
  delete tempQueue[id];
  // Сбрасываем счетчик

  // Очищаем список
  $(`[data-list="${name}"`).find(".item").remove();
  // Перезапрашиваем запись основного объекта.
  const values = Object.values(tempQueue).filter((item) =>
    item.name.includes(name)
  );
  console.log(values);
  for (let idx in values) {
    updateFiles(values[idx], name, idx);
  }
}

// Отправка формы
form.on("submit", function (event) {
  event.preventDefault();
  const formData = new FormData(this);
  const nudesPhoto = Object.values(queue).filter((item) =>
    item.name.includes("nude")
  );
  const facesPhoto = Object.values(queue).filter((item) =>
    item.name.includes("face")
  );
  for (var id in nudesPhoto) {
    formData.append("nudes[]", nudesPhoto[id]);
  }
  for (var id in facesPhoto) {
    formData.append("faces[]", facesPhoto[id]);
  }
  console.log(formData.getAll("nudes[]"));
  console.log(formData.getAll("faces[]"));
  $.ajax({
    url: $(this).attr("action"),
    type: "POST",
    data: formData,
    async: true,
    success: function (res) {
      console.log(res);
    },
    error: (error) => {
      console.log(error);
    },
    cache: false,
    contentType: false,
    processData: false,
  });
});

$(".show-popup").magnificPopup({
  type: "inline",
  removalDelay: 500, //delay removal by X to allow out-animation
  callbacks: {
    beforeOpen: function () {
      this.st.mainClass = this.st.el.attr("data-effect");
    },
  },
  midClick: true, // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
});

// Загрузка файла

// выбираем инпут через который загружем файл и сам файл
var files;

$("#addBio").submit(function (e) {
  e.preventDefault();
  var formData = new FormData($(this)[0]);

  // console.log(formData.entries());
  $.ajax({
    url: "/profileAdd.php",
    type: "POST",
    data: formData,
    cache: false,
    dataType: "json",
    processData: false,
    contentType: false,
    success: function () {},
  });
});

$("#fileBio").on("change", function () {
  readBio();
});
$("#nameFile").on("change", function () {
  readFile();
});

function readFile(object, callback) {
  var file = object.files[0];
  var reader = new FileReader();
  reader.onload = function () {
    callback(reader.result);
    // console.log(reader);
  };
  reader.readAsText(file);
}
function saveFile(data, name) {
  var a = document.createElement("a");
  a.setAttribute("download", name || "file.txt");
  a.setAttribute(
    "href",
    "data:application/octet-stream;base64," + btoa(data || "undefined")
  );
  a.click();
}
function readFile() {
  var file = document.getElementById("nameFile").files[0];

  if (file.size >= 256 * 1024) {
    if (
      !confirm(
        "File size is " +
          Math.round(file.size / 1024) +
          "kBytes! Really want to read it?"
      )
    ) {
      // console.log("Aborting loading file...");
      return;
    }
  }
  var readerNames = new FileReader();
  readerNames.onload = function () {
    var txtData = readerNames.result;
    var txtArray = txtData.split("\n");

    let result = txtArray.filter((name) => name.length > 3 && name.length < 70);

    txtArrayLength = result.length;
    txtArrayLength = JSON.stringify(txtArrayLength);

    console.log(result);
    document.getElementById("outNames").innerHTML = txtArrayLength;
  };
  readerNames.readAsText(file);
}

function readBio(object, callback) {
  var file = object.files[0];
  var reader = new FileReader();
  reader.onload = function () {
    callback(reader.result);
    // console.log(reader);
  };
  reader.readAsText(file);
}
function saveBio(data, name) {
  var a = document.createElement("a");
  a.setAttribute("download", name || "file.txt");
  a.setAttribute(
    "href",
    "data:application/octet-stream;base64," + btoa(data || "undefined")
  );
  a.click();
}
function readBio() {
  var file = document.getElementById("fileBio").files[0];

  if (file.size >= 256 * 1024) {
    if (
      !confirm(
        "File size is " +
          Math.round(file.size / 1024) +
          "kBytes! Really want to read it?"
      )
    ) {
      // console.log("Aborting loading file...");
      return;
    }
  }
  var readerBio = new FileReader();
  readerBio.onload = function () {
    var txtData = readerBio.result;
    var txtArray = txtData.split("\n");

    let result = txtArray.filter((name) => name.length > 3 && name.length < 70);

    txtArrayLength = result.length;
    txtArrayLength = JSON.stringify(txtArrayLength);

    console.log(result);
    document.getElementById("outBio").innerHTML = txtArrayLength;
  };
  readerBio.readAsText(file);
}

function generatePointers() {
  var [geoName, centralCord, count, length] = [
    $("#geoName").val(),
    $("#coord").val().split(","),
    Number($("#amounthPoint").val()),
    Number($("#distancePoint").val()),
  ];
  centralCord = centralCord.map(function (cordinate) {
    return Number(cordinate.trim());
  });
  var [latitude, longitude] = centralCord;
  // Размножение гео по квадратной спирали из одной точки
  // 1 метер в гео координатах
  var meter = 0.00000901;
  // Длинна стороны в координатах
  var part_length = length * 2 ** 0.5 * meter;
  // квадрат точек
  var square_number = 0;
  // Точка поворота
  var point_end = 2;
  // Data
  var [latitude_start, longitude_start] = [latitude, longitude];
  // Массив с координатами
  var result = [[geoName, latitude, longitude]];
  // Количество записаных точек
  point_count = 1;
  // Номер первой точки
  var point_number = 1;
  // Проход по точкам
  while (point_count < count) {
    point_number += 1;
    // Начало нового витка
    if (point_end == point_number) {
      [latitude, longitude] = [
        latitude + part_length / 2,
        longitude - part_length / 2,
      ];
      square_number += 1;
      point_fix = point_end;
      point_end += square_number * 4;
    }
    // Движение по точкам вверх
    else if (Math.floor((point_number - point_fix) / square_number) == 0) {
      [latitude, longitude] = [latitude + part_length, longitude];
    }
    // Движение по точкам на право
    else if (Math.floor((point_number - point_fix) / square_number) == 1) {
      [latitude, longitude] = [latitude, longitude + part_length];
    }
    // Движение по точкам вниз
    else if (Math.floor((point_number - point_fix) / square_number) == 2) {
      [latitude, longitude] = [latitude - part_length, longitude];
    }
    // Движение по точкам на лево
    else if (Math.floor((point_number - point_fix) / square_number) == 3) {
      [latitude, longitude] = [latitude, longitude - part_length];
    }
    // Запись новых координат
    point_count += 1;
    result[result.length] = ["Близкие", latitude, longitude];
  }
  initMap(result);
}
function initMap(coordinates = [[]]) {
  var markers = [...coordinates];
  var [x, y] = [48.84495434343056, 30.581894554120527];
  if (coordinates[0].length != 0) {
    [x, y] = [coordinates[0][1], coordinates[0][2]];
  }
  var map = new google.maps.Map(document.getElementById("map"), {
    zoom: 8,
    center: new google.maps.LatLng(x, y),
    mapTypeId: google.maps.MapTypeId.ROADMAP,
  });

  var infowindow = new google.maps.InfoWindow();
  var marker, i;

  for (i = 0; i < markers.length; i++) {
    marker = new google.maps.Marker({
      position: new google.maps.LatLng(markers[i][1], markers[i][2]),
      map: map,
    });

    google.maps.event.addListener(
      marker,
      "click",
      (function (marker, i) {
        return function () {
          infowindow.setContent(markers[i][0]);
          infowindow.open(map, marker);
        };
      })(marker, i)
    );
  }
}
$("#addGeo").on("click", function (e) {
  e.preventDefault();
  generatePointers();
});

//===========Отправка "добавить био"==================
$("#addAbout").on("click", function (e) {
  e.preventDefault();
  $.ajax({
    url: "/profileAdd.php",
    type: "POST",
    contentType: "application/json",
    data: readBio(),
  }).done(function () {
    alert("Отправили файл");
  });
  return false;
});

//===========Отправка "гео"==================
$("#addCord").on("submit", function (e) {
  e.preventDefault();
  var $dataForm = {};
  $("#addCord")
    .find("input")
    .each(function () {
      $dataForm[this.name] = $(this).val();
    });
  console.log($dataForm);
  $.ajax({
    url: "/create_geo.php",
    type: "POST",
    contentType: "application/json",
    data: JSON.stringify($dataForm),
  }).done(function () {
    alert("Точки добавлены");
  });
  return false;
});
