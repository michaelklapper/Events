Ext.define('AM.view.location.Edit', {
    extend: 'Ext.window.Window',
    alias : 'widget.locationEdit',

    title : 'Edit Location',
    layout: 'fit',
    autoShow: true,

    initComponent: function() {
        Ext.apply(this, {
            items: [{
                xtype: 'locationForm'
            }],
            buttons: [{
                text: 'Save',
                action: 'save'
            }, {
                text: 'Cancel',
                scope: this,
                handler: this.close
            }]
        });


        this.callParent(arguments);
    }
});