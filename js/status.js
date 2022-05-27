$(document).ready(function () {
  $.post("/requestGeo.php").done(function (data) {
    var data = JSON.parse(data);
    // console.log(data);
    var startCord = { lat: 59.922995, lng: 30.289675 };
    var map = new google.maps.Map(document.getElementById("map"), {
      zoom: 5,
      center: startCord,
    });
    for (key in data) {
      lng = Number(data[key]["geo"]["lng"]);
      lt = Number(data[key]["geo"]["lt"]);
      geoId = data[key]["dialog_id"];
      geoPhone = data[key]["phone"];
      title = { ID: geoId, Phone: geoPhone };
      // console.log(title);
      myLatLng = { lat: lt, lng: lng };
      var marker = new google.maps.Marker({
        position: myLatLng,
        title: JSON.stringify(title),
      });
      marker.setMap(map);
    }
  });
  // Инициализация графиков
  new WOW().init();
  // Получение инфы о  живых/не живых ботах за всё время
  var ctx = document.getElementById("myChartAll").getContext("2d");
  var allBot = $("#allBot").val();
  var goodBot = $("#goodBot").val();
  var deadBot = $("#deadBot").val();
  // console.log(deadBot);
  var myChartAll = new Chart(ctx, {
    type: "pie",
    data: {
      labels: [
        "Всего ботов:" + allBot,
        "Живых ботов:" + goodBot,
        "Mёртвых ботов:" + deadBot,
      ],
      datasets: [
        {
          data: [allBot, goodBot, deadBot],
          backgroundColor: ["lightblue", "seagreen", "grey"],
        },
      ],
    },
    options: {
      legend: {
        display: false,
      },
      scales: {
        xAxes: [
          {
            gridLines: {
              display: true,
            },
          },
        ],
        yAxes: [
          {
            gridLines: {
              display: true,
            },
          },
        ],
      },
    },
  });

  // Получение инфы о  живых/не живых ботах за последние дни
  var ctx = document.getElementById("myChart").getContext("2d");
  var myChart = new Chart(ctx, {
    type: "bar",
    data: {
      labels: ["Статистика за период (введите данные для проверки)"],
    },
  });
  $("#checkStatusButton").click(function (e) {
    e.preventDefault();
    var lang;
    $("#statusForm")
      .find("select")
      .each(function () {
        lang = $(this).val();
      });

    function statusJson() {
      return JSON.stringify(lang);
    }
    // console.log(statusJson());
    $.ajax({
      url: "/status.php",
      type: "POST",
      contentType: "application/json",
      data: statusJson(),
    }).done(function (data) {
      var statusData = JSON.parse(data);
      // console.log(statusData);
      (all = statusData.all), (good = statusData.good);
      var allBot = all;
      var goodBot = good;
      var deadBot = allBot - goodBot;

      var myChart = new Chart(ctx, {
        type: "bar",
        data: {
          labels: [
            "Всего ботов:" + allBot,
            "Живых ботов:" + goodBot,
            "Mёртвых ботов:" + deadBot,
          ],
          datasets: [
            {
              data: [allBot, goodBot, deadBot],
              backgroundColor: ["indigo", "seagreen", "black"],

              borderWidth: 2,
            },
          ],
        },
        options: {
          legend: {
            display: false,
          },
          scales: {
            yAxes: [
              {
                ticks: {
                  min: 0,
                },
              },
            ],
          },
          tooltips: {
            callbacks: {
              label: function () {},
            },
          },
        },
      });
    });
  });
});
