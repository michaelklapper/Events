Ext.define('AM.form.EventForm', {
    extend: 'AM.form.GenericForm',
    alias : 'widget.eventForm',

    initComponent: function() {

        this.items = [{
                name : 'title',
                fieldLabel: 'Title'
            },  {
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
            }
        ];

//TODO this can be removed if nothing happend ...
//        this.paramOrder = ['id', 'title', 'date', 'timeBegin', 'timeEnd', 'url', 'comment'];

        this.callParent(arguments);
    }
});