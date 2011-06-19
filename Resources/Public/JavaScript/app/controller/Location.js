Ext.define('AM.controller.Location', {
    extend: 'Ext.app.Controller',
    views: [
        'location.Edit'
    ],
    stores: [
        'Event',
        'Location'
    ],
    models: [
        'Location'
    ],
    refs: [{
        ref: 'locationComboBox',
        selector: 'eventEdit locationComboBox'
    }, {
        ref: 'statusBar',
        selector: 'tabContainer statusbar'
    }],
    init: function() {
        this.control({
            'eventEdit button[action=addLocation]': {
                click: this.addLocationRecord
            },
            'locationEdit button[action=save]': {
                click: this.createLocation
            }
        });
    },

    /**
     * Add new model of type {AM.model.Location} using the {AM.view.location.Edit} panel.
     *
     * @private
     * @return void
     *
     * @author Michael Klapper <mick.klapper.development@gmail.com>
     */
    addLocationRecord: function () {
        var view = Ext.widget('locationEdit');
        var model = this.getLocationModel();
        var eM = new model();

        view.down('form').loadRecord(eM);
    },

    createLocation: function (button) {
        var win    = button.up('window'),
        form   = win.down('form'),
        record = form.getRecord(),
        values = form.getValues(), message;
        record.set(values);
        win.close();

        if (record.phantom) {
            this.getLocationStore().add(record);
            // this.getLocationComboBox().setValue(record.data);
            this.getEventStore().sync();
            message = 'Add new location: ';
        } else {
            this.getLocationStore().sync();
            message = 'Update location: ';
        }

        this.getStatusBar().setStatus({
            text: message + record.get('title'),
            clear: true
        });
    }
});