document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
  
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      locale: 'fr',
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      events: [
        {
          title: 'Quête spéciale : Sauvetage d\'Athéna',
          start: '2024-07-15',
          description: 'Rejoignez-nous pour sauver Athéna des griffes des Spectres !'
        },
        {
          title: 'Tournoi PvP',
          start: '2024-07-22',
          description: 'Montrez vos compétences de combat et gagnez des récompenses.'
        }
      ],
      eventClick: function(info) {
        alert('Titre : ' + info.event.title + '\n' + 'Description : ' + info.event.extendedProps.description);
      }
    });
  
    calendar.render();
  });