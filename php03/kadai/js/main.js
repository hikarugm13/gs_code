
//コメントを書く
$('body').on("click",".write", function () {
  console.log(this)
  $('#stadiumName').html(this.id)
  $('#form').append(`<input type="text" value= ${this.id } name="stadium" style="display:none">`);
  $(".kuchikomi").fadeIn();
  $(".result").fadeOut();
});
//コメントを見る
let sum = 0;
let count = 0;
$('body').on("click",".check", function () {
  $('#aReviewer').empty();
  $('#stars').empty();
  $('#aReview').empty();
  $('#stadiumName2').empty();
  $('#average').empty();
  $('#stadiumName2').append(`<div id="stadiumName">${this.id}</div>`)
  //dataには数字が入る、data2は取得したオブジェクトがいる。
  for (let data in data2) {
    if (data2[data]["stadiumName"]==this.id) {
      $('#reviews').append(`<div id='aReviewer'><div>${data2[data]["reviewer"]}</div></div></br>`);
       if (data2[data]["rating"]>4) {
        $('#reviews').append(`<div id='stars'><img src ="stars/5star.jpeg"></div>`)
       }else if (data2[data]["rating"]>3) {
        $('#reviews').append(`<div id='stars'><img src ="stars/4star.jpeg"></div>`)
       }else if (data2[data]["rating"]>2) {
        $('#reviews').append(`<div id='stars'><img src ="stars/3star.jpeg"></div>`)
       }else if (data2[data]["rating"]>1) {
        $('#reviews').append(`<div id='stars'><img src ="stars/2star.jpeg"></div>`)
       }else if (data2[data]["rating"]>0) {
        $('#reviews').append(`<div id='stars'><img src ="stars/1star.jpeg"></div>`)
       }else if (data2[data]["rating"]=0) {
        $('#reviews').append(`<div id='stars'><img src ="stars/0star.jpeg"></div>`)
       }
       $('#reviews').append(`<div id='aReview'><div>${data2[data]["review"]}</div></div></br>`);
      // $('#stars').append(`<div>${data2[data]["rating"]}</div></br>`);
      $('#reviews').append(`<div id='edit'><p><a href ="commentDetail.php?id=${data2[data]["id"]}">編集</a></p></div>`);
      $('#reviews').append(`<div id ='delete'><p><a href ="commentDelete.php?id=${data2[data]["id"]}">削除</a></p></div></br>`);
      sum += Number(data2[data]["rating"]);
      count++;
    }
  }

  $('#average').append(`<div>${sum/count}</div>`);
  if (sum/count >4) {
  $('#average').append(`<img src ="stars/5star.jpeg">`);
  }else if (sum/count >3) {
  $('#average').append(`<img src ="stars/4star.jpeg">`);
  }else if (sum/count >2) {
  $('#average').append(`<img src ="stars/3star.jpeg">`);
  }else if (sum/count >1) {
  $('#average').append(`<img src ="stars/2star.jpeg">`);
  }else if (sum/count >0) {
  $('#average').append(`<img src ="stars/1star.jpeg">`);
  }else if (sum/count == 0) {
    $('#average').append(`<img src ="stars/0star.jpeg">`);
    };
  $(".result").fadeIn();
  $(".kuchikomi").fadeOut();
});
