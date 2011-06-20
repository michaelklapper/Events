Ext.define('AM.controller.Event', {
    extend: 'Ext.app.Controller',
    views: [
        'event.Detail',
        'event.List',
        'event.Edit'
    ],
    stores: [
        'Event',
        'State',
        'Location'
    ],
    models: [
        'Event',
        'State',
        'Location'
    ],
    refs: [{
        ref: 'contentArea',
        selector: 'viewport panel[id=contentPanel]'
    }, {
        ref: 'tabContainer',
        selector: 'tabContainer'
    }, {
        ref: 'eventList',
        selector: 'eventList'
    }, {
        ref: 'statusBar',
        selector: 'tabContainer statusbar'
    }],

    init: function() {
        this.control({
            'button[action=showEventList]': {
                click: this.indexAction
            },
            'eventList': {
                itemdblclick: this.addDetailTabView
            },
            'eventEdit button[action=save]': {
                click: this.updateEvent
            },
            'eventList button[action=edit]': {
                click: this.editEvent
            },
            'eventList button[action=add]': {
                click: this.addEventRecord
            },
            'eventList button[action=delete]': {
                click: this.deleteEvent
            }
        });
    },

    /**
     *
     */
    indexAction: function () {
        this.getContentArea().addContent({
            xtype: 'tabContainer',
            minWidth: 300,
            region: 'center',
            id: 'eventTabContainer',
            activeTab: 0,
            bbar: this.createStatusBar(),
            items: [{
                title: 'All Events',
                xtype: 'eventList',
                minWidth: 300
            }]
        });
    },

    /**
     * Create the bottom bar.
     *
     * @private
     * @return {}
     *
     * @author Michael Klapper <mick.klapper.development@gmail.com>
     */
    createStatusBar: function () {
        return Ext.create('Ext.ux.StatusBar', {
            defaultText: '',
            id: 'status-id',
            clear: true
        });
    },

    /**
     * Open the detail view for current selected {AM.model.Event}.
     *
     * @private
     * @param {AM.view.event.List} grid
     * @param {AM.model.Event} record
     * @return void
     *
     * @author Michael Klapper <mick.klapper.development@gmail.com>
     */
    addDetailTabView: function (grid, record) {
        this.getTabContainer().addDetailTab('eventDetail', record);
    },

    /**
     * Add new model of type {AM.model.Event} using the {AM.view.event.Edit} panel.
     *
     * @private
     * @return void
     *
     * @author Michael Klapper <mick.klapper.development@gmail.com>
     */
    addEventRecord: function () {
        var view = Ext.widget('eventEdit');
        var eventModel = this.getEventModel();
        var eM = new eventModel({date: new Date()});

        view.down('form').loadRecord(eM);
    },

    /**
     * Delete the current selected {AM.model.Event}.
     *
     * @private
     * @return void
     *
     * @author Michael Klapper <mick.klapper.development@gmail.com>
     */
    deleteEvent: function () {
        var record = this._getModelBySelectedRow();

        if (record) {
            Ext.MessageBox.confirm('Confirm', 'Are you sure you want to delete that model "' + record.get('title') + '"?', function (button) {
                if (button == 'yes') {
                    this.getEventStore().remove(record);
                    this.getEventStore().sync();
                    this.getStatusBar().setStatus({
                        text: 'Event "' + record.get('title') + '" deleted.',
                        clear: true
                    });
                }
           }, this);
        }
    },

    /**
     * Open the selected {AM.model.Event} for editing in the {AM.view.event.Edit} panel.
     *
     * @private
     * @param {AM.view.event.List} grid
     * @param {AM.model.Event} record
     * @return void
     *
     * @author Michael Klapper <mick.klapper.development@gmail.com>
     */
    editEvent: function(grid, record) {
        if (Ext.ClassManager.getName(record) == 'AM.model.Event') {
            var view = Ext.widget('eventEdit');
            view.down('form').loadRecord(record);
        } else {
            var selection = this._getModelBySelectedRow();
            if (selection) {
                var view = Ext.widget('eventEdit');
                view.down('form').loadRecord(selection);
            }
        }
    },

    /**
     * Update the {AM.model.Event} from {AM.view.event.Edit} panel.
     *
     * @private
     * @param {Ext.button.Button} button
     * @return void
     *
     * @author Michael Klapper <mick.klapper.development@gmail.com>
     */
    updateEvent: function(button) {
        var win    = button.up('window'),
        form   = win.down('form'),
        record = form.getRecord(),
        values = form.getValues(), message;
        record.set(values);
        win.close();

        if (record.phantom) {
            this.getEventStore().add(record);
            message = 'Add new event: ';
        } else {
            message = 'Update event: ';
        }

        this.getEventStore().sync();
        this.getStatusBar().setStatus({
            text: message + record.get('title'),
            clear: true
        });
    },

    _getModelBySelectedRow: function () {
        var grid = this.getEventList();
        var selection = grid.getView().getSelectionModel().getSelection()[0];
        return selection;
    },
    onPanelRendered: function() {
        console.log('The panel was rendered');
    }

});