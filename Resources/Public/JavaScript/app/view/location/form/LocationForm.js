Ext.define('AM.view.location.form.LocationForm', {
    extend: 'AM.view.AbstractForm',
    alias : 'widget.locationForm',

    initComponent: function() {
        Ext.apply(this, {
            items: [{
                    name : 'title',
                    fieldLabel: 'Title'
                }, {
                    xtype:'tabpanel',
                    activeTab: 0,
                    defaults:{
                        bodyStyle:'padding:10px'
                    },
                    items: [{
                        title: 'Address',
                        defaultType: 'textfield',
                        items: [{
                            name: 'street',
                            fieldLabel: 'Street'
                        }, {
                            name: 'number',
                            fieldLabel: 'Number'
                        }, {
                            name: 'zip',
                            fieldLabel: 'Zip'
                        }, {
                            name: 'city',
                            fieldLabel: 'City'
                        }, {
                            name: 'country',
                            fieldLabel: 'Country'
                        }]
                    }, {
                        title: 'Contact',
                        items: [{
                            xtype: 'textfield',
                            fieldLabel: 'Dummy'
                        }]
                    }]
                }
            ]
        });

        this.callParent(arguments);
    }
});