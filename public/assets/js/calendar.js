document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'pt-br',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: 'http://localhost/calendar-app/backend/eventos/listar.php', // Vamos criar isso já já
        selectable: true,
        select: function(info) {
            const titulo = prompt('Título do evento:');
            if (titulo) {
                fetch('http://localhost/calendar-app/backend/eventos/criar.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({
                        title: titulo,
                        start: info.startStr,
                        end: info.endStr
                    })
                }).then(() => calendar.refetchEvents());
            }
        },
        eventClick: function(info) {
            if (confirm('Deseja excluir este evento?')) {
                fetch('http://localhost/calendar-app/backend/eventos/deletar.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({ id: info.event.id })
                }).then(() => calendar.refetchEvents());
            }
        }
    });

    calendar.render();
});
