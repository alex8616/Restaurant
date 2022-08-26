      document.addEventListener('DOMContentLoaded', function() {

        let formulario = document.querySelector("form");
        var calendarEl = document.getElementById('agenda');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          locate:"es",
          headerToolbar:{
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth'
          },

          //click para mostrar el evento
          dateClick:function(info){
            $("#evento").modal("show");
          }
        });
        calendar.render();

        document.getElementById("btnGuardar").addEventListener("click",function(){
            const datos = new FormData(formulario);
            console.log(datos);

            axios.post("http://127.0.0.1:8000/menu", datos).
            then(
              (respuesta) => {
                $("#evento").modal("hide");
              }
            ).catch(
                error=>{
                  if(error.response){
                    console.log(error.response.data);
                  }
                }
            )
        });
      });