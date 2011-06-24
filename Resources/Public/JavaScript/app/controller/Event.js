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
        'History',
        'Location'
    ],
    models: [
        'Event',
        'State',
        'History',
        'Location'
    ],
    refs: [{
        ref: 'detailView',
        selector: 'eventDetail'
    }, {
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
        this.addEvents(
            /**
             * @event showEvent
             * Fired after event shown.
             * @param {String} event name.
             */
            "showEvent"
        );

        this.control({
            'button[action=showEventList]': {
                click: this.indexAction
            },
            'eventList': {
                itemdblclick: this.detailAction
            },
//            'eventEdit button[action=save]': {
//                click: this.updateEvent
//            },
            'eventForm': {
                recordSaved: this.updateEvent
            },
            'eventList button[action=edit]': {
                click: this.editEvent
            },
            'eventList button[action=add]': {
                click: this.addEventRecord
            },
            'eventList button[action=delete]': {
                click: this.deleteEvent
            },
            'eventDetail button[action=getDirection]': {
                click: this.getDirectionAction
            },
            'eventDetail button[action=twitter]': {
                click: this.twitterAction
            },
            'eventDetail button[action=facebook]': {
                click: this.facebookAction
            },
            'eventDetail button[action=update]': {
                click: this.updateAction
            }
        });
    },

    /**
     *
     */
    indexAction: function (skipHistory) {
        if (!skipHistory) {
            AM.History.push('/event/index/');
        }

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
     * Open new window with "Get Directions" of detail view location.
     *
     * @return void
     *
     * @author Michael Klapper <mick.klapper.development@gmail.com>
     */
    getDirectionAction: function () {
        var activeRecordUid = this.getTabContainer().getActiveTab().id,
                activeRecord = this.getEventStore().getById(activeRecordUid),
                location = activeRecord.get('location'),
                url = 'http://maps.google.de/maps?daddr=' + escape(location.street + ' ' + location.number + ', ' + location.zip + ' ' + location.city + ', ' + location.country);

        window.open(url);
    },

    /**
     * Open new window with "twitter" to tweet the event.
     *
     * @return void
     *
     * @author Michael Klapper <mick.klapper.development@gmail.com>
     */
    twitterAction: function () {
        var url = 'http://www.twitter.com/share'

        window.open(url);
    },

    /**
     * Open new window with "twitter" to tweet the event.
     *
     * @return void
     *
     * @author Michael Klapper <mick.klapper.development@gmail.com>
     */
    facebookAction: function () {
        var activeRecordUid = this.getTabContainer().getActiveTab().id,
                activeRecord = this.getEventStore().getById(activeRecordUid),
                url = 'http://www.facebook.com/sharer.php?t=' + escape(activeRecord.get('title'));

        window.open(url);
    },

    /**
     * Open edit event window.
     *
     * @return void
     *
     * @author Michael Klapper <mick.klapper.development@gmail.com>
     */
    updateAction: function () {
        var eventRecord = this.getDetailView().getEventRecord();
        var view = Ext.widget('eventEdit');
        view.down('form').loadRecord(eventRecord);
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
    detailAction: function (grid, record) {
        if (!Ext.isObject(record) && Ext.isString(grid)) {
            record = this.getEventStore().getById(parseInt(grid));
        }
        this.getTabContainer().addDetailTab('eventDetail', record);
        AM.History.push('/event/detail/' + record.getId());
        this.fireEvent('showEvent', record.get('title'));
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
    updateEvent: function(form) {
        var record = form.getRecord(),
        values = form.getValues(), message;
        record.set(values);

        if (record.phantom) {
            this.getEventStore().add(record);
            message = 'Add new event: ';
        } else {
            message = 'Update event: ';
        }

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