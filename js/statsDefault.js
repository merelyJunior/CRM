$(document).ready(function () {
  $(".preloader").fadeIn();
  $.post("/statsDefault.php").done(function (data) {
    $(".preloader").fadeOut();
    $("#clear").fadeIn();
    var data = JSON.parse(data);
    // console.log(data);
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
});
