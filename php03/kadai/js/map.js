      function initMap() {
        // 現在地を取得
        navigator.geolocation.getCurrentPosition(
          // 取得成功した場合
          function(position) {
            // 緯度・経度を変数に格納
            var mapLatLng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
            // マップオプションを変数に格納
            var mapOptions = {
              zoom : 12,          // 拡大倍率
              center : mapLatLng  // 緯度・経度
            };
            // ルート検索
            var directionsService = new google.maps.DirectionsService();
            var directionsRenderer = new google.maps.DirectionsRenderer();
            // マップオブジェクト作成
            var map = new google.maps.Map(
              document.getElementById("myMap"), // マップを表示する要素
              mapOptions         // マップオプション
            );
            // ルート
            directionsRenderer.setMap(map);
            // マーカーを表示する
            var marker = new google.maps.Marker({
              map : map,             // 対象の地図オブジェクト
              position : mapLatLng   // 緯度・経度
            });
        let currentWindow;

        downloadUrl('toxml.php', function(data) {
          var xml = data.responseXML;
          var markers = xml.documentElement.getElementsByTagName('marker');
          Array.prototype.forEach.call(markers, function(markerElem) {
            var id = markerElem.getAttribute('id');
            var name = markerElem.getAttribute('name');
            var address = markerElem.getAttribute('address');
            var type = markerElem.getAttribute('sportsType');
            var point = new google.maps.LatLng(
                parseFloat(markerElem.getAttribute('lat')),
                parseFloat(markerElem.getAttribute('lng')));

            var infowincontent = document.createElement('div');
            var strong = document.createElement('strong');
            strong.textContent = name
            infowincontent.appendChild(strong);
            infowincontent.appendChild(document.createElement('br'));

            var text = document.createElement('text');
            text.textContent = address
            infowincontent.appendChild(text);
            // var icon = customLabel[type] || {};
            var marker = new google.maps.Marker({
              map: map,
              position: point,
              // label: icon.label,
              icon:{
              url:'images/stadium.jpeg' ,
              scaledSize: new google.maps.Size(50,50)
              }
            });
            // ルート検索
      function calcRoute(end) {
        console.log(end);
        var request = {
          origin: mapLatLng,
          destination: end,
          travelMode: 'DRIVING'
        };
        directionsService.route(request, function(result, status) {
          if (status == 'OK') {
            directionsRenderer.setDirections(result);
          }
        });
      }

            //ルート検索
$('body').on("click","#route", function () {
  calcRoute(this.getAttribute("class"))
});
            // マーカークリックしたら地名をポップアップさせる
    marker.addListener('click', () => {
      currentWindow && currentWindow.close();
      const infoWindow = new google.maps.InfoWindow(
        {content: `<div id="name" value="${name}">${name}</div><br>
      <div id= "${name}" class ="${name} write">口コミをかく！</div>
      <div id= "${name}" class ="${id} check">口コミを見る！</div><br>
      <div id= "route" class="${name}">ルート検索</div><br>
      `});
      infoWindow.open(map, marker);
      currentWindow = infoWindow;
    });
          });
        });
      });
      };

function downloadUrl(url, callback) {
var request = window.ActiveXObject ?
  new ActiveXObject('Microsoft.XMLHTTP') :
  new XMLHttpRequest;

request.onreadystatechange = function() {
if (request.readyState == 4) {
  request.onreadystatechange = doNothing;
  callback(request, request.status);
}
};

request.open('GET', url, true);
request.send(null);
}

function doNothing() {}