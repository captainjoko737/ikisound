@extends ('layout.app_home')

@section('content')

    <!-- Main content -->
    <section class="content" id="page">

      <div class="container">
        <!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" hidden id="modal" data-target="#myModal"></button>

        <!-- Modal -->
        <div class="modal modal-primary fade" id="myModal" role="dialog">
          <div class="modal-dialog">
          
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="title-event"></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                
              </div>
              <div class="modal-body">
                <p id="booking-username"></p>
                <p id="booking-fullname"></p>
                <p id="event-location"></p>
                <p id="status-booking"></p>
                <p>Package : </p>

                <div id="package_choices"></div>
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
            
          </div>
        </div>
        
      </div>

      <div class="row">
        <!-- /.col -->
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-body no-padding">
              <!-- THE CALENDAR -->
              <div id="calendar"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>

    <div id="loading"></div>

@endsection

@section('js')
  <script type="text/javascript">

  var dataJson = [];
  var dataJsonPackage = [];

  var date = new Date()
  var d    = date.getDate(),
      m    = date.getMonth(),
      y    = date.getFullYear()

    function onReady(callback) {
        var intervalID = window.setInterval(checkReady, 1000);

        function checkReady() {
            if (document.getElementsByTagName('body')[0] !== undefined) {
                window.clearInterval(intervalID);
                callback.call(this);
            }
        }
    }

    function show(id, value) {
        document.getElementById(id).style.display = value ? 'block' : 'none';
    }

    onReady(function () {
        
        $.ajax({
           type: 'GET',
           url: '{{url("/dataSchedule")}}',
           success: function(data) {  
              // console.log(data.response);
              var res = data.response;

              dataJsonPackage = data.response;

              // console.log(data.response);

              for(i=0; i< res.length; i++) {

                var temp = {
                          id             : res[i].id_booking,
                          title          : res[i].event_name,
                          start          : new Date(res[i].year, res[i].month, res[i].day),
                          allDay         : true,
                          backgroundColor: res[i].status_booking_color,
                          borderColor    : '#000000', //Black
                          textColor      : 'white', // White
                          eventLocation  : res[i].event_location,
                          customerName   : res[i].fullname,
                          customerUser   : res[i].username,
                          status_booking : res[i].status_booking
                        };

                dataJson.push(temp);

              }

              onFinishedLoadPageAndData();            
               
           },
           error: function(data) {
              console.log('Error Get Data');
               
           }
        });

    });



    function onFinishedLoadPageAndData() {
        show('page', true);
        show('loading', false);

        $(function () {

          /* initialize the external events
           -----------------------------------------------------------------*/
          function init_events(ele) {
            ele.each(function () {

              // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
              // it doesn't need to have a start or end
              var eventObject = {
                title: $.trim($(this).text()) // use the element's text as the event title
              }

              // store the Event Object in the DOM element so we can get to it later
              $(this).data('eventObject', eventObject)

              // make the event draggable using jQuery UI
              $(this).draggable({
                zIndex        : 1070,
                revert        : true, // will cause the event to go back to its
                revertDuration: 0  //  original position after the drag
              })

            })
          }

          init_events($('#external-events div.external-event'))

          /* initialize the calendar
           -----------------------------------------------------------------*/
          //Date for the calendar events (dummy data)
          var date = new Date()
          var d    = date.getDate(),
              m    = date.getMonth(),
              y    = date.getFullYear()

          $('#calendar').fullCalendar({
                eventClick: function(calEvent, jsEvent, view) {

            document.getElementById("title-event").innerHTML = calEvent.title;
            document.getElementById("booking-username").innerHTML = 'Username : ' + calEvent.customerUser;
            document.getElementById("booking-fullname").innerHTML = 'Customer Name : ' + calEvent.customerName;
            document.getElementById("event-location").innerHTML = 'Event Location : ' + calEvent.eventLocation;
            document.getElementById("status-booking").innerHTML = 'Status Booking : ' + calEvent.status_booking;
            document.getElementById("modal").click();

            // console.log(dataJson);

            var packageSelected = '';

            for (var i = 0; i < dataJsonPackage.length; i++) {
                
                if (dataJsonPackage[i].id_booking == calEvent.id) {
                    
                    for (j=0; j<dataJsonPackage[i].booking_package.length; j++) {
                        packageSelected += '<p> - ';
                        packageSelected += dataJsonPackage[i].booking_package[j].package_name;
                        packageSelected += '</p>';
                    }
                }
            };

            document.getElementById('package_choices').innerHTML = packageSelected;

            // console.log(calEvent.id);

            // change the border color just for fun
            $(this).css('border-color', 'black');

          },
            header    : {
              left  : 'prev,next today',
              center: 'title',
              right : ''
            },
            buttonText: {
              today: 'today',
              month: 'month',
              week : 'week',
              day  : 'day'
            },
            //Random default events
            events    : dataJson,
            editable  : false,
            droppable : true, // this allows things to be dropped onto the calendar !!!
            drop      : function (date, allDay) { // this function is called when something is dropped

              // retrieve the dropped element's stored Event Object
              var originalEventObject = $(this).data('eventObject')

              // we need to copy it, so that multiple events don't have a reference to the same object
              var copiedEventObject = $.extend({}, originalEventObject)

              // assign it the date that was reported
              copiedEventObject.start           = date
              copiedEventObject.allDay          = allDay
              copiedEventObject.backgroundColor = $(this).css('background-color')
              copiedEventObject.borderColor     = $(this).css('border-color')

              // render the event on the calendar
              // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
              $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

              // is the "remove after drop" checkbox checked?
              if ($('#drop-remove').is(':checked')) {
                // if so, remove the element from the "Draggable Events" list
                $(this).remove()
              }

            }
          })
        })
    }

    

    
  </script>

@endsection
