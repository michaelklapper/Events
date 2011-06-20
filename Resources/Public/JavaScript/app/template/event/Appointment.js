/**
 * User: Michael Klapper
 * Date: 22.06.11
 * Time: 19:31
 */
Ext.define('AM.template.event.Appointment', {
    extend: 'AM.template.AbstractTemplate',
    alias : 'widget.eventDetailAppointment',

    config: {
        date: '',
        timeBegin: '',
        timeEnd: ''
    },

    template: [
        '<p>Date: {date}</p>',
        '<br />',
        '<p>Time: {timeBegin} - {timeEnd}</p>'
    ],

    /**
     * Update the contents of this component's body to be the
     * rendered signature template.
     *
     * @return void
     *
     * @author Michael Klapper <mick.klapper.development@gmail.com>
     */
    reload : function() {

        this.update(this._template.apply({
            date: this.getDate(),
            timeBegin: this.getTimeBegin(),
            timeEnd: this.getTimeEnd()
        }));
    }
});