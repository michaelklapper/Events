Ext.define('AM.form.GenericFieldContainer', {
    extend: 'Ext.form.FieldContainer',
    alias : 'widget.genericFieldContainer',

    initComponent: function() {
        Ext.apply(this, {
            labelStyle: 'font-weight:bold;padding:0',
            layout: 'hbox',
            defaultType: 'textfield',
            defaults: {
                margins: '0 10 0 0'
            },
            fieldDefaults: {
                labelAlign: 'top'
            }
        });

        this.callParent(arguments);
    }
});