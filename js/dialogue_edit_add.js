// Редактирование диалога
$("#dataForms").on("submit", function (event) {
  event.preventDefault();
  var $dataForm = {};
  var $dataMess = [];
  $("#dialogData")
    .find("input,select")
    .each(function () {
      $dataForm[this.name] = $(this).val();
    });

  var _i = 0;

  $("fieldset")
    .find("input, textarea, select")
    .each(function () {
      if (!$dataMess[_i]) {
        $dataMess[_i] = { position: _i + 1 };
      }
      $dataMess[_i][this.name] = $(this).val();
      if (this.name == "text") {
        var txt1 = $(this).val().replace(/"/g, "’").replace(/'/g, "’");
        console.log(txt1);
        $dataMess[_i][this.name] = txt1.split("\n");
        _i++;
      }
    });
  function editJson() {
    return JSON.stringify({
      ...$dataForm,
      id: +$dataForm.id,
      dialogs: $dataMess,

      // access: $dataForm.access,
    });
  }
  // console.log(editJson());
  $.post("/request_edit.php", {
    editData: editJson(),
  }).done(function (_data) {
    _data = _data.replace(/\s/g, "");
    // console.log("https://crm.crazybot.net/chat/" + _data);
    window.location.href = "https://crm.crazybot.net/chat/" + _data;
    alert("Данные сохранены");
  });
});
function editJson() {
  return JSON.stringify({
    dialog: {
      ...$dataForm,
      id: +$dataForm.id,
      dialogs: $dataMess,
    },
    access: $dataForm.access,
  });
}
function dialogInitialState() {
  return {
    position: "",
    type: "message",
    status: "nowait",
    reply: "none",
    time: "",
    file: "",
    location: "private",
    ref: "",
    text: "",
  };
}
var form = DialogForm();
var iter = $("fieldset.card").length;
form.render();
$("body").on("click", ".editAddDialog", form.editAdd);
function DialogForm() {
  let dItem = null;
  let $common = {
    token: "",
    type: "",
    lang: $("#langSelect").val(),
  };
  let $state = {
    byIds: {
      id1: Object.assign({}, dialogInitialState()),
    },
    ids: [],
  };
  let container = $("#dialogsSet");
  container.on("click", "[data-delete]", function (event) {
    // This function for editDialog and add Dialog
    // Delete message from dialog
    event.preventDefault();
    // Send id of block to delete
    remove($(this).closest("fieldset").attr("data-id"));
  });
  $("#dialogueName").on("change", function (event) {
    $common.type = event.target.value;
  });
  $("#langSelect").on("change", function (event) {
    $common.lang = event.target.value;
  });
  function rewriteDialogId() {
    // Rewrite dialogs id
    let i = 1;
    $("#dialogsSet fieldset").each(function () {
      $(this).attr("data-id", i);
      i++;
    });
  }
  function render() {
    let del = 0;
    if (dItem) {
      // Delete message if dItem not null
      let deleted = container.find(`[data-id="${dItem}"]`);
      deleted.fadeOut(400, function () {
        deleted.remove();
        // Rewrite dialogs id
        rewriteDialogId();
        del = 1;
      });
      dItem = null;
    }
    if (!del) {
      // If there new message => append it in needed place
      $state.ids.forEach(function (id) {
        container
          .find("fieldset[data-id='" + (id - 1) + "']")
          .after(Dialog(id, $state.byIds[id]).render());
      });
      // After appending new message => clear array $state
      $state = {
        byIds: {
          id1: Object.assign({}, dialogInitialState()),
        },
        ids: [],
      };
      // Rewrite dialogs id
      rewriteDialogId();
    }
  }
  function editAdd(e) {
    iter++;
    // Write new id by closure filedset
    var curId = $(this).closest("fieldset").attr("data-id");
    curId++;
    //
    let newId = curId;
    // We need $state to save there new id only
    $state.byIds[`${newId}`] = Object.assign({}, dialogInitialState());
    $state.ids.push(`${newId}`);
    render();
  }

  function remove(dataId) {
    // This function for editDialog and add Dialog
    // Save id to dItem to delete in render
    dItem = dataId;
    // $state.ids = $state.ids.filter((item) => item !== id);
    // delete $state.byIds[id];
    iter--;
    if (iter == 1 || iter < 0) {
      $(".delete-message-btn:first").attr("disabled", true);
    }
    render();
  }
  function reset() {
    $state = {
      byIds: {
        id1: Object.assign({}, dialogInitialState()),
      },
      ids: [],
    };
    container.html("");
    render();
  }

  return {
    render: render,
    editAdd: editAdd,
    editJson: editJson,
    reset: reset,
  };
}
function Dialog(id, state) {
  function render() {
    return `
      <fieldset class="card p-2 mt-3" data-id="${id}">
          <div class="row justify-content-between">
          <legend class="col-md-7">Сообщение</legend>
            <div class="col">
                <button type="button" data-delete="${id}" class="btn btn-danger delete-message-btn">x</button>
            </div>            
            
          </div>
          <div class="row">
              <div class="col-md-4">
                  <label for="type">Тип сообщения:</label>
                  <select class="form-control" onchange="changeState(this)" id="type" name="type">
                      <option value="message" ${
                        state.type === "message" ? "selected" : ""
                      }>message</option>
                      <option value="sleep" ${
                        state.type === "sleep" ? "selected" : ""
                      }>sleep</option>
                      <option value="file_photo" ${
                        state.type === "file_photo" ? "selected" : ""
                      }>file_photo</option>
                      <option value="file_audio" ${
                        state.type === "file_audio" ? "selected" : ""
                      }>file_audio</option>
                      <option value="file_video" ${
                        state.type === "file_video" ? "selected" : ""
                      }>file_video</option>
                      <option value="link" ${
                        state.type === "link" ? "selected" : ""
                      }>link</option>
                  </select>
              </div>
              <div class="col-md-4">
                  <label for="statusSelect">Status</label>
                  <select
                          class="form-control mb-3"
                          id="statusSelect"
                          name="status"
                  >
                      <option value="nowait" ${
                        state.status === "nowait" ? "selected" : ""
                      }>nowait</option>
                      <option value="wait" ${
                        state.status === "wait" ? "selected" : ""
                      }>wait</option>
                  </select>
              </div>
              <div class="col-md-4">
                  <label for="replySelect">Reply</label>
                  <select
                          class="form-control mb-3"
                          id="replySelect"
                          name="reply"
                  >
                      <option value="none" ${
                        state.status === "none" ? "selected" : ""
                      }>none</option>
                      <option value="last" ${
                        state.status === "last" ? "selected" : ""
                      }>last</option>
                      <option value="link" ${
                        state.status === "link" ? "selected" : ""
                      }>link</option>
                  </select>
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
                          value="${state.time}"
                  />
              </div>
              <div class="col-md-4 col-md-4 mb-3">
                  <label for="file">File:</label>
                  <input
                          disabled
                          type="text"
                          class="form-control mb-3"
                          id="file"
                          name="file"
                          value="${state.file}"
                  />
              </div>
              <div class="col-md-4 col-md-4 mb-3">
                  <label for="location">Location:</label>
                  <select
                  disabled
                  class="form-control mb-3"
                          id="location"
                          name="location"
                  >
                      <option value="private" ${
                        state.location === "private" ? "selected" : ""
                      }>private</option>
                      <option value="public" ${
                        state.location === "public" ? "selected" : ""
                      }>public</option>
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
                          value="${state.ref}"
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
                  >${[state.text]}</textarea>
              </div>
          </div>
          <div>
          <button type="button"
            class="mb-3 btn btn-primary rounded-circle editAddDialog">+</button>
          </div>
      </fieldset>
    `;
  }

  return {
    render: render,
  };
}

// Создание нового диалога

function AddDialogInitialState() {
  return {
    position: "",
    type: "message",
    status: "nowait",
    reply: "none",
    time: "",
    file: "",
    location: "private",
    ref: "",
    text: "",
  };
}

var formAdd = AddDialogForm();
formAdd.render();
$("body").on("click", ".addDialog", formAdd.add);
$("#dataForm").on("submit", function (event) {
  event.preventDefault();
  const fieldset = document.getElementsByClassName(".fieldset");
  if (fieldset) {
    $.ajax({
      url: "/request_send.php",
      type: "POST",
      contentType: "application/json",
      data: formAdd.toJson(),
    })

      .done(function (_data) {
        alert("Диалог добавлен в базу");
        // console.log(_data);
        // window.location.href = JSON.parse(_data).link;
      })
      .fail(function () {
        alert("error");
        // console.log(form.toJson());
      });
  }
});
function AddDialogForm() {
  let dItem = null;
  let $common = {
    token: "",
    type: "",
    lang: $("#langSelect").val(),
  };
  let $state = {
    byIds: {
      id1: Object.assign({}, AddDialogInitialState()),
    },
    ids: [],
  };
  let container = $("#dialogsSet");
  $("#dialogueName").on("change", function (event) {
    $common.type = event.target.value;
  });
  $("#siteLink").on("change", function (event) {
    $common.siteLink = event.target.value;
  });
  $("#langSelect").on("change", function (event) {
    $common.lang = event.target.value;
  });
  function rewriteDialogId() {
    let i = 1;
    $("#dialogsSet fieldset").each(function () {
      $(this).attr("data-id", i);
      i++;
    });
  }
  function render() {
    let del = 0;
    if (dItem) {
      let deleted = container.find(`[data-id="${dItem}"]`);
      deleted.fadeOut(400, function () {
        deleted.remove();
        rewriteDialogId();
        del = 1;
      });
      dItem = null;
    }
    if (!del) {
      $state.ids.forEach(function (id) {
        if (id == 1) container.append(addDialog(id, $state.byIds[id]).render());
        else
          container
            .find("fieldset[data-id='" + (id - 1) + "']")
            .after(addDialog(id, $state.byIds[id]).render());
      });
      $state = {
        byIds: {
          id1: Object.assign({}, dialogInitialState()),
        },
        ids: [],
      };
      rewriteDialogId();
    }
  }
  function add(e) {
    iter++;
    if ($(this).attr("id") == "firstAddDialog") $(this).remove();

    var curIdAdd = $(this).closest("fieldset").attr("data-id") || 0;
    curIdAdd++;
    //
    let newId = curIdAdd;
    $state.byIds[`${newId}`] = Object.assign({}, AddDialogInitialState());
    $state.ids.push(`${newId}`);
    render();
  }

  function toJson() {
    $state2 = {
      byIds: {
        id1: Object.assign({}, AddDialogInitialState()),
      },
      ids: [],
    };
    $("#dialogsSet fieldset").each(function (e) {
      let id = $(this).attr("data-id");
      let textValue = $(this).find("textarea#exampleFormControlTextarea").val();

      $state2.ids.push(`${id}`);

      $state2.byIds[id] = {
        position: +id,
        type: $(this).find("select#type").val(),
        status: $(this).find("select#statusSelect").val(),
        reply: $(this).find("select#replySelect").val(),
        time: $(this).find("input#time").val(),
        file: $(this).find("input#file").val(),
        location: $(this).find("select#location").val(),
        ref: $(this).find("input#ref").val(),
        text: textValue,
      };
    });
    var res = JSON.stringify({
      type: $common.type,
      lang: $common.lang,
      dialogs: $state2.ids.map(function (id) {
        $state2.byIds[id].position = +id;
        if (typeof $state2.byIds[id].text == "string") {
          var txt1 = $state2.byIds[id].text
            .replace(/"/g, "’")
            .replace(/'/g, "’");
          $state2.byIds[id].text = txt1.split("\n");
        }
        return $state2.byIds[id];
      }),
    });
    return res;
  }
  function reset() {
    $state = {
      byIds: {
        id1: Object.assign({}, AddDialogInitialState()),
      },
      ids: [],
    };
    container.html("");
    render();
  }

  return {
    render: render,
    add: add,
    toJson: toJson,
    reset: reset,
  };
}
function addDialog(id, state) {
  function render() {
    return `
      <fieldset class="card p-2 mt-3" data-id="${id}">
          <div class="row justify-content-between">
          <legend class="col-md-7">Сообщение</legend>
            <div class="col">
                <button type="button" data-delete="${id}" class="btn btn-danger delete-message-btn">x</button>
            </div>            
            
          </div>
          <div class="row">
              <div class="col-md-4">
                  <label for="type">Тип сообщения:</label>
                  <select class="form-control" onchange="changeState(this)" id="type" name="dialog[${id}][type]">
                      <option value="message" ${
                        state.type === "message" ? "selected" : ""
                      }>message</option>
                      <option value="sleep" ${
                        state.type === "sleep" ? "selected" : ""
                      }>sleep</option>
                      <option value="file_photo" ${
                        state.type === "file_photo" ? "selected" : ""
                      }>file_photo</option>
                      <option value="file_audio" ${
                        state.type === "file_audio" ? "selected" : ""
                      }>file_audio</option>
                      <option value="file_video" ${
                        state.type === "file_video" ? "selected" : ""
                      }>file_video</option>
                      <option value="link" ${
                        state.type === "link" ? "selected" : ""
                      }>link</option>
                  </select>
              </div>
              <div class="col-md-4">
                  <label for="statusSelect">Status</label>
                  <select
                          class="form-control mb-3"
                          id="statusSelect"
                          name="dialog[${id}][status]"
                  >
                      <option value="nowait" ${
                        state.status === "nowait" ? "selected" : ""
                      }>nowait</option>
                      <option value="wait" ${
                        state.status === "wait" ? "selected" : ""
                      }>wait</option>
                  </select>
              </div>
              <div class="col-md-4">
                  <label for="replySelect">Reply</label>
                  <select
                          class="form-control mb-3"
                          id="replySelect"
                          name="dialog[${id}][reply]"
                  >
                      <option value="none" ${
                        state.status === "none" ? "selected" : ""
                      }>none</option>
                      <option value="last" ${
                        state.status === "last" ? "selected" : ""
                      }>last</option>
                      <option value="link" ${
                        state.status === "link" ? "selected" : ""
                      }>link</option>
                  </select>
              </div>
          </div>
          <div class="row">
              <div class="col-md-4 col-md-4 ">
                  <label for="time">Time:</label>
                  <input
                          disabled
                          class="form-control mb-3"
                          type="text"
                          id="time"
                          name="dialog[${id}][time]"
                          placeholder="Указывать в мс"
                          maxlength="6"
                          value="${state.time}"
                  />
              </div>
              <div class="col-md-4 col-md-4 ">
                  <label for="file">File:</label>
                  <input
                          disabled
                          type="text"
                          class="form-control mb-3"
                          id="file"
                          name="dialog[${id}][file]"
                          value="${state.file}"
                  />
              </div>
              <div class="col-md-4 col-md-4 ">
                  <label for="location">Location:</label>
                  <select
                  disabled
                  class="form-control "
                          id="location"
                          name="dialog[${id}][location]"
                  >
                      <option value="private" ${
                        state.location === "private" ? "selected" : ""
                      }>private</option>
                      <option value="public" ${
                        state.location === "public" ? "selected" : ""
                      }>public</option>
                  </select>
              </div>
              <div class="col-md-4 col-md-4 mb-3">
              <label for="ref">Reference:</label>
              <input
                      disabled
                      type="text"
                      class="form-control mb-3"
                      id="ref"
                      name="dialog[${id}][ref]"
                      value="${state.ref}"
              />
          </div>
          </div>
          <div class="row">
              <div class="col-md-12">
                  <label for="exampleFormControlTextarea"
                  >Варианты сообщений:</label
                  >
                  <textarea
                          name="dialog[${[id]}][text]"
                          class="form-control mb-3"
                          id="exampleFormControlTextarea"
                          rows="5"
                          placeholder="Ввод каждого варианта с новой строки"
                  >${[state.text]}</textarea>
              </div>
          </div>
          <div>
            <button type="button"
                    class="mb-3 btn btn-primary rounded-circle addDialog">+</button>
          </div>
      </fieldset>
    `;
  }

  return {
    render: render,
  };
}
