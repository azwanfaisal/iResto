<template>
  <FullCalendar :options="calendarOptions" />
</template>

<script>
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'

export default {
  components: { FullCalendar },
  data() {
    return {
      calendarOptions: {
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: 'dayGridMonth',
        events: '/api/jadwal/calendar',
        eventContent: this.renderEventContent,
        dateClick: this.handleDateClick
      }
    }
  },
  methods: {
    renderEventContent(eventInfo) {
      return {
        html: `
          <div class="fc-event-content">
            <b>${eventInfo.event.title}</b>
            <div>${eventInfo.event.extendedProps.posisi}</div>
            <div>Status: ${eventInfo.event.extendedProps.status}</div>
          </div>
        `
      }
    },
    handleDateClick(arg) {
      alert('Tanggal dipilih: ' + arg.dateStr)
    }
  }
}
</script>

<style>
.fc-event-content {
  padding: 5px;
  white-space: normal !important;
}
</style>