// Загрузка последних 100 чатов

$(document).ready(function () {
  function getDialog(e, id) {
    if (id != 0) id = $(this).find("td:first").attr("data-id");

    var dataMessagesAjax = JSON.parse($("#dataMessages").val());
    $(".curr-id").text(
      "Текущий пользователь #" + dataMessagesAjax[id]["contact_id"]
    );
    var dialogContentBottom = dataMessagesAjax[id]["text"];
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
                        <div  class="row">
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
  // Onclick table tr
  $(document).on("click", "#messagesTable tr", getDialog);
  $("#messagesTable")
    .parent()
    .prepend("<input type='hidden' id='dataMessages'>");

  $(".preloader").fadeIn();
  $.post({
    url: "/lastMessages.php",
    type: "POST",
    contentType: "application/json",
  }).done(function (dataMessagesAjax) {
    $(".preloader").fadeOut();
    $("#dataMessages").val(dataMessagesAjax);
    // Parse json data
    var dataMessagesAjax = JSON.parse(dataMessagesAjax);
    var len = Object.keys(dataMessagesAjax).length;
    // Generate chats from json
    for (var key = 0; key < len; key++) {
      type = dataMessagesAjax[key]["type"];
      lang = dataMessagesAjax[key]["lang"];
      contactId = dataMessagesAjax[key]["contact_id"];
      botId = dataMessagesAjax[key]["bot_id"];
      dataEnd = dataMessagesAjax[key]["date_end"];
      dataStart = dataMessagesAjax[key]["date_start"];
      dialogId = dataMessagesAjax[key]["dialog_id"];
      lastMessageId = dataMessagesAjax[key]["last_message_id"];
      linksSent = dataMessagesAjax[key]["link_sent"];
      dialogContent = dataMessagesAjax[key]["text"];
      let rowTable = document.createElement("tr");
      rowTable.innerHTML = `
            <tr>
              <td class="new-row" data-id="${key}">${type}</td>
              <td class="new-row">${lang}</td>
              <td class="new-row">${botId}</td>
              <td class="new-row">${contactId}</td>
              <td class="new-row">${dialogId}</td>
              <td class="new-row">${dataEnd}</td>
              <td class="new-row">${dataStart}</td>
              <td class="new-row">${lastMessageId}</td>
              <td class="new-row">${linksSent}</td>
            </tr>
          `;
      $("#messagesTable").append(rowTable);
    }
    getDialog(null, 0);
  });
});
