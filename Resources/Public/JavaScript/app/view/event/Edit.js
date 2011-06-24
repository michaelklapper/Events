Ext.define('AM.view.event.Edit', {
    extend: 'Ext.window.Window',
    alias : 'widget.eventEdit',

    title : 'Edit Event',
    layout: 'fit',
    autoShow: true,

    initComponent: function() {
        this.items = [{
            xtype: 'eventForm'
        }];

        this.buttons = [{
            text: 'Save',
            action: 'save',
            handler: function () {
                this.up('window').down('form').doSubmitForm();
            }
        }, {
            text: 'Cancel',
            scope: this,
            handler: this.close
        }];

        this.callParent(arguments);
    }
});