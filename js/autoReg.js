// кнопка регистрации
$("#startReg").on("click", function (e) {
  // intervalExample = setInterval(function () {
  //   getRegStat();
  //   getBalance();
  // }, 15000);
  e.preventDefault();
  var $dataForm = {};
  $("#autoReg")
    .find("input,select")
    .each(function () {
      $dataForm[this.name] = $(this).val();
    });
  function statusJson() {
    return JSON.stringify($dataForm);
  }
  // console.log(statusJson());
  $.ajax({
    url: "/regStart.php",
    type: "POST",
    contentType: "application/json",
    data: statusJson(),
  }).done(function (data) {
    // alert("Регаем");

    var $dataReg = {};
    $("#autoReg")
      .find("input,select")
      .each(function () {
        $dataReg[this.name] = $(this).val();
      });
    // console.log($dataReg);
    var count = $dataReg["count"];
    var country = $dataReg["country"];
    var currStatus = count + " ботов" + ", в странах - " + country;

    var currStatus = (currStatus.innerHTML = `${currStatus}`);
    $("#currStatus").append(currStatus);
    var time = document.createElement("p");
    time.innerHTML = `${data}`;
    document.querySelector(".start-time").appendChild(time);

    $.post("/regStata.php").done(function (_data) {
      var currData = JSON.parse(_data);
      // console.log(typeof _data);
      // console.log(typeof currData);
      var stage = currData["stage"];
      // console.log(stage);
      if (stage == "choosing country") {
        $("#checkStop").prop("checked", true);
        $("#startReg").attr("disabled", "disabled");
        $("#stopReg").removeAttr("disabled", "disabled");
        $(".reg-note").show(300);
      }
      if (stage == "working") {
        $("#checkReg").prop("checked", true);
        $("#startReg").attr("disabled", "disabled");
        $("#stopReg").removeAttr("disabled", "disabled");
        $(".reg-note").show(300);
      }
      endPost = stage == "done" || stage == "stpped";
      // true value return here
      if (endPost) {
        $("#checkDone").prop("checked", true);
        $("#stopReg").attr("disabled", "disabled");
        $("#startReg").removeAttr("disabled", "disabled");
        $(".reg-note").hide(300);
      }

      var allBot = currData["all"];
      var goodBot = currData["good"];
      var brokenBot = allBot - goodBot;
      var time = currData["time"];

      currAll.innerHTML = `${allBot}`;
      currGood.innerHTML = `${goodBot}`;
      currBroken.innerHTML = `${brokenBot}`;
      currTime.innerHTML = `${time}`;

      $("#currAll").append(currAll);
      $("#currGood").append(currGood);
      $("#currBroken").append(currBroken);
      $("#currTime").append(currTime);
    });
  });

  return false;
});

// кнопка стоп
$("#stopReg").on("click", function () {
  $.post("/regStop.php").done(function () {
    $(".reg-note").hide();
  });
  clearInterval(intervalExample);
  getRegStat();
  getBalance();
  return false;
});
// обновление баланса
function getBalance() {
  $.post("/getBalance.php").done(function (data) {
    var currBal = data;
    currBal.innerHTML = `${currBal}`;
    $("#currBal").text(currBal);
  });
}
function getRegStat() {
  $.post("/regStata.php").done(function (_data) {
    var currData = JSON.parse(_data);
    // console.log(currData);
    var stage = currData["stage"];
    // console.log(stage);
    if (stage == "choosing country") {
      $("#checkStop").prop("checked", true);
      $("#startReg").attr("disabled", "disabled");
      $("#stopReg").removeAttr("disabled", "disabled");
      $(".reg-note").show(300);
    }

    if (stage == "working") {
      $("#checkReg").prop("checked", true);
      $("#startReg").attr("disabled", "disabled");
      $("#stopReg").removeAttr("disabled", "disabled");
      $(".reg-note").show(300);
    }

    var countBot = currData["count"];
    var allBot = currData["all"];
    var goodBot = currData["good"];
    var brokenBot = allBot - goodBot;
    var startTime = currData["timestart"];
    var currtime = currData["time"];

    countBot.innerHTML = `${countBot}`;
    currAll.innerHTML = `${allBot}`;
    currGood.innerHTML = `${goodBot}`;
    currBroken.innerHTML = `${brokenBot}`;
    currTime.innerHTML = `${currtime}`;
    startTime.innerHTML = `${startTime}`;

    $("#currStatus").text(countBot);
    $("#currAll").append(currAll);
    $("#currGood").append(currGood);
    $("#currBroken").append(currBroken);
    $("#currTime").append(currTime);
    $(".start-time").text(startTime);
    endPost = stage == "done" || stage == "stpped";
    if (endPost) {
      clearInterval(intervalExample);
      $("#checkDone").prop("checked", true);
      $("#stopReg").attr("disabled", "disabled");
      $("#startReg").removeAttr("disabled", "disabled");
      $(".reg-note").hide(300);
      $("#currStatus").empty();
      $("#currAll").empty();
      $("#currGood").empty();
      $("#currBroken").empty();
      $("#currTime").empty();
      $(".start-time").empty();
      // console.log("end post done");
    }
  });
}
function lastReg() {
  $.post("/lastReg.php").done(function (data) {
    var currData = JSON.parse(data);

    // console.log(currData);

    var lastGood = currData["good"];
    var lastAll = currData["all"];
    // console.log(lastAll);
    var lastCount = currData["count"];
    var lastBroken = lastAll - lastGood;

    lastAll.innerHTML = `${lastAll}`;
    lastGood.innerHTML = `${lastGood}`;
    lastBroken.innerHTML = `${lastBroken}`;
    lastCount.innerHTML = `${lastCount}`;

    $("#lastAll").text(lastAll);
    $("#lastGood").text(lastGood);
    $("#lastBroken").text(lastBroken);
    $("#lastCount").text(lastCount);
  });
}

$(document).ready(function () {
  getRegStat();
  getBalance();
  lastReg();
  intervalExample = setInterval(function () {
    getRegStat();
    getBalance();
    lastReg();
  }, 15000);
});
