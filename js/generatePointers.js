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
