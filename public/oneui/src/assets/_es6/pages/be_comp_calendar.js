/*
 *  Document   : be_comp_calendar.js
 *  Author     : pixelcave
 *  Description: Custom JS code used in Calendar Page
 */

// Full Calendar, for more examples you can check out http://fullcalendar.io/
class pageCompCalendar {
    /*
     * Add event to the events list
     *
     */
    static addEvent() {
        let eventInput      = jQuery('.js-add-event');
        let eventInputVal   = '';

        // When the add event form is submitted
        jQuery('.js-form-add-event').on('submit', e => {
            // Get input value
            eventInputVal = eventInput.prop('value');

            // Check if the user entered something
            if (eventInputVal) {
                // Add it to the events list
                jQuery('.js-events')
                    .prepend('<li>' +
                            jQuery('<div />').text(eventInputVal).html() +
                            '</li>');

                // Clear input field
                eventInput.prop('value', '');

                // Re-Init Events
                this.initEvents();
            }

            return false;
        });
    }

    /*
     * Init drag and drop event functionality
     *
     */
    static initEvents() {
        jQuery('.js-events')
            .find('li')
            .each((index, element) => {
                let event = jQuery(element);

                // create an Event Object
                let eventObject = {
                    title: jQuery.trim(event.text()),
                    color: event.css('background-color')
                };

                // store the Event Object in the DOM element so we can get to it later
                event.data('eventObject', eventObject);

                // make the event draggable using jQuery UI
                event.draggable({
                    zIndex: 999,
                    revert: true,
                    revertDuration: 0
                });
            });
    }

    /*
     * Init calendar demo functionality
     *
     */
    static initCalendar() {
        let date = new Date();
        let d    = date.getDate();
        let m    = date.getMonth();
        let y    = date.getFullYear();

        jQuery('.js-calendar').fullCalendar({
            themeSystem: 'bootstrap4',
            firstDay: 1,
            editable: true,
            droppable: true,
            header: {
                left: 'title',
                right: 'prev,next today month,agendaWeek,agendaDay,listWeek'
            },
            drop: function(date, jsEvent, ui, resourceId) { // this function is called when something is dropped
                let event = jQuery(ui.helper);

                // retrieve the dropped element's stored Event Object
                let originalEventObject = event.data('eventObject');

                // we need to copy it, so that multiple events don't have a reference to the same object
                let copiedEventObject = jQuery.extend({}, originalEventObject);

                // assign it the date that was reported
                copiedEventObject.start = date;

                // render the event on the calendar
                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                jQuery('.js-calendar').fullCalendar('renderEvent', copiedEventObject, true);

                // remove the element from the "Draggable Events" list
                event.remove();
            },
            events: [
                {
                    title: 'Free day',
                    start: new Date(y, m, 1),
                    allDay: true,
                    color: '#faeab9'
                },
                {
                    title: 'Skype Meeting',
                    start: new Date(y, m, 2)
                },
                {
                    title: 'Secret Project',
                    start: new Date(y, m, 5),
                    end: new Date(y, m, 8),
                    allDay: true,
                    color: '#fac5a5'
                },
                {
                    title: 'Work',
                    start: new Date(y, m, 9),
                    end: new Date(y, m, 11),
                    allDay: true,
                    color: '#fac5a5'
                },
                {
                    id: 999,
                    title: 'Biking (repeated)',
                    start: new Date(y, m, d - 3, 15, 0)
                },
                {
                    id: 999,
                    title: 'Biking (repeated)',
                    start: new Date(y, m, d + 2, 15, 0)
                },
                {
                    title: 'Landing Template',
                    start: new Date(y, m, d - 1),
                    end: new Date(y, m, d - 1),
                    allDay: true,
                    color: '#faeab9'
                },
                {
                    title: 'Lunch Meeting',
                    start: new Date(y, m, d + 5, 14, 0),
                    color: '#fac5a5'
                },
                {
                    title: 'Admin Template',
                    start: new Date(y, m, d, 9, 0),
                    end: new Date(y, m, d, 12, 0),
                    allDay: true,
                    color: '#faeab9'
                },
                {
                    title: 'Party',
                    start: new Date(y, m, 15),
                    end: new Date(y, m, 16),
                    allDay: true,
                    color: '#faeab9'
                },
                {
                    title: 'Reading',
                    start: new Date(y, m, d + 8, 21, 0),
                    end: new Date(y, m, d + 8, 23, 30),
                    allDay: true
                },
                {
                    title: 'Follow us on Twitter',
                    start: new Date(y, m, 23),
                    end: new Date(y, m, 25),
                    allDay: true,
                    url: 'http://twitter.com/pixelcave',
                    color: '#32ccfe'
                }
            ]
        });
    }

    /*
     * Init functionality
     *
     */
    static init() {
        this.addEvent();
        this.initEvents();
        this.initCalendar();
    }
}

// Initialize when page loads
jQuery(() => { pageCompCalendar.init(); });
