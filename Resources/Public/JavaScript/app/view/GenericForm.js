Ext.define('AM.form.GenericForm', {
    extend: 'Ext.form.Panel',
    alias : 'widget.genericForm',

    initComponent: function() {
        Ext.apply(this, {
            border: false,
            bodyPadding: 10,
            defaultType: 'textfield',
            fieldDefaults: {
                labelWidth: 100,
                labelStyle: 'font-weight:bold'
            },
            defaults: {
                margins: '0 0 10 0'
            }
        });

        this.callParent(arguments);
    }
});