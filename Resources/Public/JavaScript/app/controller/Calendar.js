Ext.define('AM.controller.CalendarController', {
    extend: 'Ext.app.Controller',
    refs: [{
        ref: 'contentPanel',
        selector: 'viewport panel[id=contentPanel]'
    }],
    init: function() {
        this.control({
            'button[action=showEventCalendar]': {
                click: this.indexAction
            }
        });
    },


    indexAction: function () {
        this.getContentPanel().addContent({
            xtype: 'panel',
            id: 'dummy-1',
            html: 'hello calendar'
        });
    }
});