var voicein = new Audio("ios/bell-sorry.mp3");
var voiceout = new Audio("ios/bell-out.mp3");
var vnotfound = new Audio("ios/bell-sorry.mp3");
var vthanks = new Audio("ios/bell-thanks.mp3");
var valert = new Audio("ios/bell-alert.mp3");
var vagain = new Audio("ios/bell-again.mp3");

function pesanbell(pesan) {
  switch (pesan) {
    case 0:
      voicein.currentTime = 0;
      voicein.play();
      break;

    case 1:
      vthanks.currentTime = 0;
      vthanks.play();
      break;

    case 2:
      valert.currentTime = 0;
      valert.play();
      break;

    case 3:
      vagain.currentTime = 0;
      vagain.play();
      break;
  }
}
//https://sweetalert.js.org/docs/

var toastMixin_notused = Swal.mixin({
  toast: true,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener("mouseenter", Swal.stopTimer);
    toast.addEventListener("mouseleave", Swal.resumeTimer);
  },
});

function startTime() {
  var bulansetahun = new Array(
    "Januari",
    "Februari",
    "Maret",
    "April",
    "Mei",
    "Juni",
    "Juli",
    "Agustus",
    "September",
    "Oktober",
    "November",
    "Desember"
  );
  var today = new Date();
  var h = today.getHours();
  var m = today.getMinutes();
  var s = today.getSeconds();

  // 01, 02, 03, ... 29, 30, 31
  var dd = (today.getDate() < 10 ? "0" : "") + today.getDate();
  // 01, 02, 03, ... 10, 11, 12
  var MM = (today.getMonth() + 1 < 10 ? "0" : "") + (today.getMonth() + 1);
  // 1970, 1971, ... 2015, 2016, ...
  var yyyy = today.getFullYear();

  h = checkTime(h);
  m = checkTime(m);
  s = checkTime(s);
  hariini =
    today.getDate() +
    " " +
    bulansetahun[today.getMonth()] +
    " " +
    today.getFullYear();
  document.getElementById("tanggal").innerHTML = hariini;
  document.getElementById("localdate").innerHTML =
    yyyy + "-" + MM + "-" + dd + " " + h + ":" + m + ":" + s;

  var t = setTimeout(function () {
    startTime();
  }, 500);
}

function showlocaltime() {
  var nilai = document.getElementById("localdate").innerHTML;
  //alert(nilai);
  return nilai;
}

function checkTime(i) {
  if (i < 10) {
    i = "0" + i;
  }
  // add zero in front of numbers <script 10
  return i;
}

function bersih() {
  $("#nik").val("");
  $("#nik").focus();
  $("#logpic").hide();
  document.getElementById("namanik").innerHTML = "";
  document.getElementById("logpic").innerHTML = "";
}

function closejam() {
  $("#lblmsk1").hide();
  $("#lblmsk2").hide();
  $("#masuk1").hide();
  $("#masuk2").hide();
  $("#lblklr1").hide();
  $("#lblklr2").hide();
  $("#keluar1").hide();
  $("#keluar2").hide();
}

function viewjam() {
  $("#lblmsk1").show();
  $("#lblmsk2").show();
  $("#masuk1").show();
  $("#masuk2").show();
  $("#lblklr1").show();
  $("#lblklr2").show();
  $("#keluar1").show();
  $("#keluar2").show();
  $("#logpic").show();
}

function carinama() {
  if (event.keyCode == 13) {
    event.preventDefault();
    var cekstring = "$#&$";
    var originalnik = $("#nik").val();
    var nik = originalnik.replace("$#&$", "");
    var lokasi = $("#lok").val();
    var mao = $("#mao").val();
    var localtime = showlocaltime();
    document.getElementById("nik").value = nik;

    $(document).ready(function () {
      $.ajax({
        type: "POST",
        url: "carinamamao.php",
        data: {
          xnik: nik,
          xlokasi: lokasi,
          xmao: mao,
          xlocaltime: localtime,
        },
        success: function (nilai) {
          var cari = JSON.parse(nilai);
          switch (cari.sts) {
            case "0":
              Swal.fire({
                title: cari.pesan,
                toast: true,
                icon: "warning",
                position: "top-right",
                timer: 2000,
                showConfirmButton: false,
              });
              pesanbell(cari.bell);
              bersih();
              break;

            case "1":
              //https://sweetalert.js.org/docs/
              Swal.fire({
                title: "Apakah Anda sedang masuk shift malam ?",
                icon: "question",
                toast: true,
                position: "top-right",
                showCancelButton: true,
                cancelButtonText: "Tidak",
                showconfirmButton: true,
                confirmButtonText: "Ya",
              }).then((result) => {
                if (result.isConfirmed) {
                  updateshiftmalam();
                } else {
                  insertmasuknormal();
                }
              });
              break;

            case "2": // kemugkinan   cek jadwal kosong , masuk salah shift (90 menit)
              if (cari.tampiljam == false) {
                document.getElementById("namanik").innerHTML = cari.nama;
                pesanbell(cari.bell);
                // Swal.fire({
                //   text: cari.pesan,
                //   toast: true,
                //   icon: "warning",
                //   position: "top-right",
                //   timer: 2500,
                //   showConfirmButton: false,
                // });
                // bersih();
                (function () {
                  toastMixin
                    .fire({
                      title: cari.pesan,
                      toast: true,
                      icon: cari.icon,
                      position: "top-right",
                      timer: 2000,
                      showConfirmButton: false,
                      timerProgressBar: false,
                    })
                    .then(function () {
                      bersih();
                    });
                })();
              } else {
                document.getElementById("namanik").innerHTML = cari.nama;
                document.getElementById("masuk1").value = cari.in1;
                document.getElementById("keluar1").value = cari.out1;
                document.getElementById("masuk2").value = cari.in2;
                document.getElementById("keluar2").value = cari.out2;
                viewjam();
                if (window.webcam === true) {
                  take_snapshot();
                }
                pesanbell(cari.bell);
                (function () {
                  toastMixin
                    .fire({
                      toast: true,
                      icon: cari.icon,
                      title: cari.pesan,
                      animation: false,
                      position: "top-right",
                      showConfirmButton: false,
                      timer: 2500,
                      timerProgressBar: true,
                    })
                    .then(function () {
                      if (window.webcam === true) {
                        savePicture();
                      }
                      closejam();
                      bersih();
                    });
                })();
              }
              break;

            case "3":
              // UPDATE KOLOM 2,3,4 TABLE HISABS
              document.getElementById("namanik").innerHTML = cari.nama;
              document.getElementById("masuk1").value = cari.in1;
              document.getElementById("keluar1").value = cari.out1;
              document.getElementById("masuk2").value = cari.in2;
              document.getElementById("keluar2").value = cari.out2;
              viewjam();
              if (window.webcam === true) {
                take_snapshot();
              }
              pesanbell(cari.bell);
              (function () {
                toastMixin
                  .fire({
                    toast: true,
                    icon: cari.icon,
                    title: cari.pesan,
                    animation: false,
                    position: "top-right",
                    showConfirmButton: false,
                    timer: 2500,
                    timerProgressBar: true,
                  })
                  .then(function () {
                    if (window.webcam === true) {
                      savePicture();
                    }
                    closejam();
                    bersih();
                  });
              })();
              break;

            default: // STS = (10,11,12,13)
              //12 : PROTEKSI ISTIRAHAT DINI
              //13 : SALAH MESIN ABSENSI
              document.getElementById("namanik").innerHTML = cari.nama;
              pesanbell(cari.bell);
              (function () {
                toastMixin
                  .fire({
                    //text: cari.pesan,
                    title: cari.pesan,
                    toast: true,
                    icon: cari.icon,
                    position: "top-right",
                    timer: 2000,
                    showConfirmButton: false,
                    timerProgressBar: false,
                  })
                  .then(function () {
                    bersih();
                  });
              })();
          }
        },
      });
    });
  }
}

function updateshiftmalam() {
  var lokasi = $("#lok").val();
  var nik = $("#nik").val();
  var mao = $("#mao").val();
  var localtime = showlocaltime();
  document.getElementById("nik").value = nik;
  $(document).ready(function () {
    $.ajax({
      type: "POST",
      url: "update_abs_malam.php",
      data: {
        nik: nik,
        lokasi: lokasi,
        mao: mao,
        localtime: localtime,
      },
      success: function (nilai) {
        var cari = JSON.parse(nilai);
        if (cari.hasil == "success") {
          document.getElementById("namanik").innerHTML = cari.nama;
          document.getElementById("masuk1").value = cari.in1;
          document.getElementById("keluar1").value = cari.out1;
          document.getElementById("masuk2").value = cari.in2;
          document.getElementById("keluar2").value = cari.out2;
          viewjam();
          if (window.webcam === true) {
            take_snapshot();
          }
          pesanbell(cari.bell);
          (function () {
            toastMixin
              .fire({
                toast: true,
                icon: cari.icon,
                title: cari.pesan,
                animation: false,
                position: "top-right",
                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true,
              })
              .then(function () {
                if (window.webcam === true) {
                  savePicture();
                }
                closejam();
                bersih();
              });
          })();
        } else {
          Swal.fire({
            toast: true,
            icon: cari.icon,
            title: cari.pesan,
            position: "top-right",
            timer: 2000,
            showConfirmButton: false,
          });
          bersih();
        }
      },
    });
  });
}

function insertmasuknormal() {
  var lokasi = $("#lok").val();
  var nik = $("#nik").val();
  var mao = $("#mao").val();
  var localtime = showlocaltime();
  document.getElementById("nik").value = nik;
  $(document).ready(function () {
    $.ajax({
      type: "POST",
      url: "insert_abs_normal.php",
      data: {
        nik: nik,
        lokasi: lokasi,
        mao: mao,
        localtime: localtime,
      },
      success: function (nilai) {
        var cari = JSON.parse(nilai);
        if (cari.hasil == "success") {
          document.getElementById("namanik").innerHTML = cari.nama;
          document.getElementById("masuk1").value = cari.in1;
          document.getElementById("keluar1").value = cari.out1;
          document.getElementById("masuk2").value = cari.in2;
          document.getElementById("keluar2").value = cari.out2;
          viewjam();
          if (window.webcam === true) {
            take_snapshot();
          }
          pesanbell(cari.bell);
          (function () {
            toastMixin
              .fire({
                toast: true,
                icon: cari.icon,
                title: cari.pesan,
                animation: false,
                position: "top-right",
                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true,
              })
              .then(function () {
                if (window.webcam === true) {
                  savePicture();
                }
                closejam();
                bersih();
              });
          })();
        } else {
          Swal.fire({
            toast: true,
            icon: cari.icon,
            title: cari.pesan,
            position: "top-right",
            timer: 2000,
            showConfirmButton: false,
          });
          bersih();
        }
      },
    });
  });
}

function take_snapshot() {
  Webcam.snap(function (data_uri) {
    // display results in page
    document.getElementById("logpic").innerHTML =
      '<img id="imageprev" src="' + data_uri + '"/>';
  });
  // Webcam.reset();
  // $("#my_camera").hide();
}

function saveSnap() {
  take_snapshot();
  // Get base64 value from <img id='imageprev'> source
  var base64image = document.getElementById("imageprev").src;
  Webcam.upload(base64image, "uploadmaopic.php", function (code, text) {
    console.log("Save successfully");
  });
}
