// Инициализация графиков

$(document).ready(function () {
  $.post("/yearStatistics.php").done(function (data) {
    var data = JSON.parse(data);
    // console.log(data);

    var arrayData = [[], [], [], []];
    for (i = 0; i < data.length; i++) {
      date = data[i]["date"];
      click = data[i]["click"];
      reg = data[i]["reg"];
      summ = data[i]["sum"];
      arrayData[0].push(date);
      arrayData[1].push(click);
      arrayData[2].push(reg);
      arrayData[3].push(summ);
    }
    // console.log(arrayData);
    var date = arrayData[0];
    var click = arrayData[1];
    var reg = arrayData[2];
    var summ = arrayData[3];
    // console.log(summ);
    new WOW().init();
    var ctx = document.getElementById("lastYearStats").getContext("2d");
    var data = {
      // линии на графике
      datasets: [
        {
          label: "Клики",
          data: click,
          lineTension: 0,
          fill: false,
          borderColor: "#026caa",
          pointBorderColor: "#026caa",
        },
        {
          label: "Регистрации",
          data: reg,
          lineTension: 0,
          fill: false,
          borderColor: "#e45642",
          pointBorderColor: "#e45642",
        },
        {
          label: "Прибыль",
          data: summ,
          lineTension: 0,
          fill: false,
          borderColor: "#468d5b",
          pointBorderColor: "#468d5b",
        },
      ],
      // Дни на графике
      labels: date,
    };
    var monthStats = new Chart(ctx, {
      type: "line",
      data: data,
      options: {
        scales: {
          y: {
            stacked: true,
          },
        },
      },
    });
  });
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
