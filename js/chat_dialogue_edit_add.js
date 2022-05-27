function dialogInitialState() {
  return {
    position: "",
    type: "message",
    status: "nowait",
    reply: "",
    botNumber: "",
    time: "",
    location: "private",
    ref: "",
    file: "",
    text: "",
  };
}
console.log(dialogInitialState());
var iter = $("fieldset.card").length;
var formAdd = AddDialogForm();

formAdd.render();

$("body").on("click", ".addDialog", formAdd.add);

function AddDialogForm() {
  let dItem = null;
  let $common = {
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
  function toJson() {
    $state2 = {
      byIds: {
        id1: Object.assign({}, dialogInitialState()),
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
        reply: $(this).find("input#replySelect").val(),
        botNumber: $(this).find("input#botNumber").val(),
        time: $(this).find("input#time").val(),
        location: $(this).find("select#location").val(),
        ref: $(this).find("input#ref").val(),
        file: $(this).find("input#file").val(),
        text: textValue,
      };
    });
    var res = JSON.stringify({
      type: $common.type,
      lang: $common.lang,
      сhat: "chat",
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
        id1: Object.assign({}, dialogInitialState()),
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
          <legend class="col-md-7">Сообщение #${id}</legend>
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
                  <input
                    id="replySelect"
                    class="form-control mb-3"
                    name="dialog[${id}][reply]"
                    placeholder="Введите значение от 1 до 500"
                    maxlength="3"
                  >
              </div>
          </div>
          <div class="row">
            <div class="col-md-4 col-md-4 ">
              <label for="botNumber">Bot number:</label>
                <input
                  id="botNumber"
                  class="form-control mb-3"
                  name="dialog[${id}][botNumber]"
                  placeholder="Введите значение от 1 до 100"
                  maxlength="3"
                />
            </div>
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
              <div class="col-md-4 col-md-4 mb-3">
                <label for="file">File:</label>
                <input
                        disabled
                        type="text"
                        class="form-control mb-3"
                        id="file"
                        name="dialog[${id}][file]"
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

$("#dataForm").on("submit", function (event) {
  event.preventDefault();
  const fieldset = document.getElementsByClassName(".fieldset");
  console.log(formAdd.toJson());
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
