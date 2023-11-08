<?php include 'include/header.php'; ?>

<body class="hold-transition sidebar-collapse sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <?php include 'include/navbar.php'; ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php
    $page = "index";
    include 'include/sidebar.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Cimoling</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">

            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4>Dashboard</h4>
                </div>
                <div class="card-body">
                  <!-- <div id="calendar"></div> -->
                </div>
              </div>

            </div>
          </div>

        </div>

    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include 'include/footer.php'; ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <?php
  include 'include/footer_jquery.php';
  ?>

  <script>
    $(function() {

      /* initialize the external events
       -----------------------------------------------------------------*/
      function ini_events(ele) {
        ele.each(function() {

          // create an Event Object (https://fullcalendar.io/docs/event-object)
          // it doesn't need to have a start or end
          var eventObject = {
            title: $.trim($(this).text()) // use the element's text as the event title
          }

          // store the Event Object in the DOM element so we can get to it later
          $(this).data('eventObject', eventObject)

          // make the event draggable using jQuery UI
          $(this).draggable({
            zIndex: 1070,
            revert: true, // will cause the event to go back to its
            revertDuration: 0 //  original position after the drag
          })

        })
      }

      ini_events($('#external-events div.external-event'))

      /* initialize the calendar
       -----------------------------------------------------------------*/
      //Date for the calendar events (dummy data)
      var date = new Date()
      var d = date.getDate(),
        m = date.getMonth(),
        y = date.getFullYear()

      var Calendar = FullCalendar.Calendar;
      var Draggable = FullCalendar.Draggable;

      var containerEl = document.getElementById('external-events');
      var checkbox = document.getElementById('drop-remove');
      var calendarEl = document.getElementById('calendar');

      // initialize the external events
      // -----------------------------------------------------------------

      /* new Draggable(containerEl, {
        itemSelector: '.external-event',
        eventData: function(eventEl) {
          return {
            title: eventEl.innerText,
            backgroundColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
            borderColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
            textColor: window.getComputedStyle(eventEl, null).getPropertyValue('color'),
          };
        }
      }); */
      var myEvents = '[{"title": "All Day Event", "start": new Date(y, m, 1),"backgroundColor": "#f56954", "borderColor:"#f56954", "allDay": true}]';

      var calendar = new Calendar(calendarEl, {
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth'
        },
        themeSystem: 'bootstrap',
        events: function(fetchInfo, successCallback, failureCallback) {
          $.ajax({
            url: "api/jo/getDataJoDueDate.php",
            method: "GET",
            data: {

            },
            beforeSend: function() {},

            success: function(result) {
              var object = JSON.parse(result);
              console.log(object);
              var success = object.success;
              console.log(success)

              if (success == true) {
                console.log("events data ditemukan")
                var events = [];
                var data = object.data;
                console.log("events " + data)
                if (data != null) {
                  console.log("events isi data")
                  $.each(data, function(i, item) {
                    console.log("events perulangan")
                    events.push({
                      start: item.dueDate,
                      title: "Order ID " + item.orderID + " - " + item.customerName,
                      backgroundColor: '#00c0ef',
                      borderColor: '#00c0ef',
                      orderID : item.orderID,
                      customerName : item.customerName,
                      statusJO : item.statusJO
                    })
                  });
                } else {
                  console.log("events Jos")
                }
                console.log('events', events);
                successCallback(events);
              }

            }
          })
        },
        editable: true,
        droppable: false, // this allows things to be dropped onto the calendar !!!
        drop: function(info) {
          // is the "remove after drop" checkbox checked?
          if (checkbox.checked) {
            // if so, remove the element from the "Draggable Events" list
            info.draggedEl.parentNode.removeChild(info.draggedEl);
          }
        },
        eventClick: function(info) {
          info.jsEvent.preventDefault();
          console.log(info)

          // change the border color
          info.el.style.borderColor = 'red';

          Swal.fire({
            title: info.event.title,
            icon: 'info',
            // html: '<p>' + info.event.extendedProps.orderID + '</p><a href="' + info.event.orderID + '">Visit event page</a>',
            html: '<p>ORDER ID : ' + info.event.extendedProps.orderID + '<br>Nama Customer : '+info.event.extendedProps.customerName+' <br>Status JO : '+info.event.extendedProps.statusJO+' </p>',
          });
        }
      });

      calendar.render();
      // $('#calendar').fullCalendar()

      /* ADDING EVENTS */
      var currColor = '#3c8dbc' //Red by default
      // Color chooser button
      $('#color-chooser > li > a').click(function(e) {
        e.preventDefault()
        // Save color
        currColor = $(this).css('color')
        // Add color effect to button
        $('#add-new-event').css({
          'background-color': currColor,
          'border-color': currColor
        })
      })
      $('#add-new-event').click(function(e) {
        e.preventDefault()
        // Get value and make sure it is not null
        var val = $('#new-event').val()
        if (val.length == 0) {
          return
        }

        // Create events
        var event = $('<div />')
        event.css({
          'background-color': currColor,
          'border-color': currColor,
          'color': '#fff'
        }).addClass('external-event')
        event.text(val)
        $('#external-events').prepend(event)

        // Add draggable funtionality
        ini_events(event)

        // Remove event from text input
        $('#new-event').val('')
      })
    })
  </script>
</body>

</html>