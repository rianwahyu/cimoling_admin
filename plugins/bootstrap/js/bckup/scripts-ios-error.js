var hariseminggu = new Array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
var bulansetahun = new Array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
    
function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    h = checkTime(h);
    m = checkTime(m);
    s = checkTime(s);
        hariini = hariseminggu[today.getDay()] + ", " + today.getDate() + " " + bulansetahun[today.getMonth()] + " " + today.getFullYear();         
        document.getElementById("jam").innerHTML = h + ":" + m + ":" + s;
        document.getElementById("hari").innerHTML = hariini;

    var t = setTimeout(function () {
        startTime();
    }, 500);
    }
    function checkTime(i) {
        if (i < 10) {
        i = "0" + i;
        } // add zero in front of numbers < 10
        return i;
    }

function carinama() {
  if (event.keyCode == 13) {
    event.preventDefault();
    if ($("input[name='pilihan']:checked").val() == "Masuk") {
      km = "Masuk";
    } else {
      km = "Keluar";
    }
    var cekstring = "$#&$";
    var originalnik = $("#nik").val();
    var nik = originalnik.replace("$#&$", "");
    var lokasi = document.getElementById("lokasi").innerHTML;    
    document.getElementById("nik").value = nik;
    
    $(document).ready(function () {
      $.ajax({
        type: "POST", // Metode pengiriman data menggunakan POST
        url: "carinama.php", // File pemroses data
        //data: 'nik=' + nik, // Data yang akan dikirim ke file pemroses || https://www.eplusgo.com/dynamic-select-box-menggunakan-jquery-dan-ajax/
        data: {
          xnik: nik,
          xkm: km,
          xlokasi: lokasi,
        },
        success: function (nilai) {
          // Jika berhasil
          pesanphp = nilai;
          cari00 = pesanphp.search("00"); // NIK = 0
          cari01 = pesanphp.search("01"); // BELUM KELUAR
          cari02 = pesanphp.search("02"); // UPDATE MASUK OK
          cari03 = pesanphp.search("03"); // SEDANG DI LUAR
          cari04 = pesanphp.search("04"); // KELUAR MINTA PASSWORD
          cari05 = pesanphp.search("05"); // MASUK MINTA PASSWORD
          document.getElementById("namanik").innerHTML = "";

          if (cari00 == 0 && $("#nik").val() != "") {
            //swal("", "NIK belum\nterdaftar", "warning") pindah
            (function () {              
              swal({
                title: "NIK",
                text: "Belum terdaftar",
                icon: "warning",
                button : false,
                timer: 1000                 
              }).then(function () {
                document.getElementById("nik").focus();
              });
            })
              
              ();           
            if (km == "Keluar") {
                bersihlayarkeluar();
            } else {
                bersihlayar();
            }

          } else if (cari01 == 0 && $("#nik").val() != "") {
            var nm = pesanphp.replace("01", "");
            (function () {
              swal(nm, "Belum keluar", "warning").then(function () {
                document.getElementById("nik").focus();
              });
            })
              ();
            bersihlayar();
          } else if (cari02 == 0) {
            var nm = pesanphp.replace("02", "");
            var carinama = nm.slice(nm.search("{") + 1, nm.search("}"));
            var kembali = nm.slice(nm.search("}") + 1, nm.length);
            var fkembali = kembali.replace(":", "");
            var ffkembali = "Kembali dari " + fkembali.replace(":", "");
            document.getElementById("namanik").innerHTML = carinama;
            // (function () {
            //   swal(carinama, ffkembali, "success").then(function () {
            //     document.getElementById("nik").focus();
            //   });
            // })
            (function () {
              swal({
                title: carinama,
                text: ffkembali,
                icon: "success",
                button: false,
                timer: 2500,
              }).then(function () {
                document.getElementById("nik").focus();
              });
            })();
            
            bersihlayar();
            iosbell('in');
          } else if (cari03 == 0) {
            var nm = pesanphp.replace("03", "");
            document.getElementById("namanik").innerHTML = nm;
            (function () {
              swal(nm, "Sedang keluar", "warning").then(function () {
                document.getElementById("nik").focus();
              });
            })();
            bersihlayar();
          } else if (cari04 == 0) {              
              document.getElementById("namanik").innerHTML = pesanphp.replace("04", "");
              document.getElementById("alasan").focus();                      
          } else if (cari05 == 0) {
            pesanphp = nilai;
            var nm = pesanphp.replace("02", "");
            var carinama = nm.slice(nm.search("{") + 1, nm.search("}"));
            var kembali = nm.slice(nm.search("}") + 1, nm.length);
            var fkembali = kembali.replace(":", "");
            // var ffkembali = "Dari : " + fkembali.replace(":", "") + "\nApproval diperlukan" ;
            document.getElementById("namanik").innerHTML = carinama;
            (function () {
              swal({
                title: carinama,
                text: fkembali + "\nPenjelasan dan Approval security diperlukan ! ",
                icon: "warning",
                content: "input",
              }).then(function (inputValue) {
                document.getElementById("namanik").innerHTML = carinama;
                window.telatkembali = inputValue;
                approvalmasuk();
              });
            })();
          }
        },
      });
    });
  }
}   

		function approvalsecurity() {
        if (event.keyCode === 13) {
          var alasan = document.getElementById("alasan").value;
          var keperluan = document.getElementById("keperluan").value;
          var approval = document.getElementById("secpassword").value;
          var nik = document.getElementById("nik").value;
          var nama = document.getElementById("namanik").innerHTML;
          var lokasi = document.getElementById("lokasi").innerHTML;
          event.preventDefault();
          // alert(keperluan);
          $(document).ready(function () {
          
            $.ajax({
              type: "POST",
              url: "proses_keluar.php",
              data: {
                xnik: nik,
                xkm: km,
                xalasan: alasan,
                xkeperluan: keperluan,
                xnama: nama,
                xapproval: approval,
                xlokasi: lokasi,
                xtelatkembali: window.telatkembali,
              },
              success: function (response) {
                //alert(response);
                if (response == "00" && $("#secpassword").val() != "") {
                  (function () {
                    swal("", "Invalid password", "warning").then(function () {
                      document.getElementById("secpassword").value = "";
                      document.getElementById("secpassword").focus();
                    });
                  })();
                } else if (response == "01") {
                  var nm = document.getElementById("namanik").innerHTML;
                  (function () {
                    swal({
                      title: nm,
                      text: "Telah keluar",
                      icon: "success",
                      button: false,
                      timer: 2500,
                    }).then(function () {
                      document.getElementById("nik").focus();
                    });
                  })();
                  bersihlayar();
                  iosbell("out");
                  window.telatkembali = '';
                } else if (response == "02") {
                  var nm = document.getElementById("namanik").innerHTML;
                  (function () {
                    swal(nm, "Telah masuk kembali", "success").then(
                      function () {
                        document.getElementById("nik").focus();
                      }
                    );
                  })();
                  bersihlayar();
                  iosbell("in");
                } else if (response == "03") {
                  (function () {
                    swal("", "Alasan/ Keperluan invalid", "warning").then(
                      function () {}
                    );
                  })();
                }
              },
            });
          });
        }
      }     


var voicein = new Audio("ios/bell-in.mp3");
var voiceout = new Audio("ios/bell-out.mp3");      
    function iosbell(ios) {
      if (ios == 'in')
      {
        voicein.currentTime = 0;
        voicein.play();
      } else if (ios == "out") {
        voiceout.currentTime = 0;
        voiceout.play();
      }         
      }

    function pindah() {
      var isi = document.getElementById("alasan").value;
      if (isi == "Gudang/Rcv/QC") {
        $("#keperluan").show();
        document.getElementById("keperluan").focus();
      } else {
        $("#keperluan").hide();
        document.getElementById("secpassword").focus();
      }
    }

function bersihlayar() {
  radiobtn = document.getElementById("pilihanm");
  radiobtn.checked = true;
  document.getElementById("nik").value = "";
  document.getElementById("namanik").innerHTML = "";
  document.getElementById("secpassword").value = "";
  document.getElementById("keperluan").value = "";
  
  document.getElementById("alasan").value = "aa";
  $("#alasan").hide();
  $("#keperluan").hide();
  $("#secpassword").hide();
}

function bersihlayarkeluar() {
  radiobtn = document.getElementById("pilihank");
  radiobtn.checked = true;
  document.getElementById("nik").value = "";
  document.getElementById("namanik").innerHTML = "";
  document.getElementById("secpassword").value = "";
  document.getElementById("keperluan").value = "";
  document.getElementById("alasan").value = "aa";
  $("#keperluan").hide();
}

    function nikfokus() {
      document.getElementById("nik").focus();
    }
        
    function approvalmasuk() {
      $("#secpassword").show();
      pindah(); // focus password
      //alert(window.telatkembali);
    }

		$(document).ready(function() {
				$("#pilihank").click(function() {
					if ($("#pilihank").val() == "Keluar")
						$("#alasan").show();
					$("#secpassword").show();
					document.getElementById("nik").focus();
					document.getElementById("nik").value = "";
					document.getElementById("namanik").innerHTML = "";
          document.getElementById("alasan").value = "aa";
          document.getElementById("keperluan").value = "";
				});
			});

			$(document).ready(function() {
				$("#pilihanm").click(function() {
					if ($("#pilihanm").val() == "Masuk") $("#alasan").hide();
					$("#secpassword").hide();
					$("#keperluan").hide();
					document.getElementById("nik").focus();
					document.getElementById("nik").value = "";
					document.getElementById("namanik").innerHTML = "";
          document.getElementById("alasan").value = "aa";
          document.getElementById("keperluan").value = "";
				});
			});

function getUrlVars(param = null) {
  if (param !== null) {
    var vars = [],
      hash;
    var hashes = window.location.href
      .slice(window.location.href.indexOf("?") + 1)
      .split("&");
    for (var i = 0; i < hashes.length; i++) {
      hash = hashes[i].split("=");
      vars.push(hash[0]);
      vars[hash[0]] = hash[1];
    }
    return vars[param];
  } else {
    return null;
  }
}			

	$(document).ready(function () {
    (function ios() {
      keperluan.addEventListener("keypress", function (event) {
        if (event.keyCode == 13) {
          event.preventDefault();
          document.getElementById("secpassword").focus();
        }
      });
    })();
  });
  

  //https://sweetalert.js.org/docs/