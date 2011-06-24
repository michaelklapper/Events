Ext.define('AM.view.event.form.EventForm', {
    extend: 'AM.view.AbstractForm',
    alias : 'widget.eventForm',


    initComponent: function() {
        var config = {
            items : [{
                name : 'title',
                fieldLabel: 'Title'
            }, {
                xtype: 'stateComboBox',
                name : 'state',
                fieldLabel: 'State'
            }, {
                xtype: 'genericFieldContainer',
                fieldLabel: 'Location',
                items: [{
                    xtype: 'locationComboBox',
                    name : 'location'
                }, {
                    xtype: 'button',
                    text: 'Add',
                    tooltip:'Add new location',
                    action: 'addLocation'
                }]
            }, {
                xtype: 'genericFieldContainer',
                fieldLabel: 'Appointment',
                items: [{
                    xtype: 'datefield',
                    name : 'date',
                    format: 'Y-m-d',
                    fieldLabel: 'Date'
                }, {
                    xtype: 'timefield',
                    name : 'timeBegin',
                    fieldLabel: 'Time begin'
                }, {
                    xtype: 'timefield',
                    name : 'timeEnd',
                    fieldLabel: 'Time end'
                }]
            }, {
                name : 'url',
                fieldLabel: 'Url'
            }, {
                xtype: 'htmleditor',
                enableColors: false,
                enableAlignments: false,
                name : 'description',
                fieldLabel: 'Description'
            }, {
                xtype: 'htmleditor',
                enableColors: false,
                enableAlignments: false,
                name : 'comment',
                fieldLabel: 'Comment'
            }],
            api: {
                load: Events.Events_Controller_EventController.read,
                update: Events.Events_Controller_EventController.update,
                create: Events.Events_Controller_EventController.create
            }
        };

        Ext.apply(this.initialConfig, config);
        Ext.apply(this, config);
        this.callParent(arguments);
    }
});