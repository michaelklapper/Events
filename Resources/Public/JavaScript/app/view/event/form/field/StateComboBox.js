Ext.define('AM.form.field.StateComboBox', {
    extend: 'Ext.form.field.ComboBox',
    alias : 'widget.stateComboBox',
    displayField: 'title',
    valueField: 'id',
    queryMode: 'local',
    valueNotFound: 'Value not found!',
    triggerAction: 'all',

    store: 'State',

    setValue: function(value, doSelect) {
        var me = this,
            valueNotFoundText = me.valueNotFoundText,
            inputEl = me.inputEl,
            i, len, record,
            models = [],
            displayTplData = [],
            processedValue = [];

        if (me.store.loading) {
            // Called while the Store is loading. Ensure it is processed by the onLoad method.
            me.value = value;
            return me;
        }

        // This method processes multi-values, so ensure value is an array.
        value = Ext.Array.from(value);

        // Loop through values
        for (i = 0, len = value.length; i < len; i++) {
            record = value[i];
            if (!record || !record.isModel) {
                if (Ext.isObject(record)) {
                    record = Ext.ModelManager.create(record, 'AM.model.State');
                } else {
                    record = me.findRecord('id', record.id);
                }
            }
            // record found, select it.
            if (record) {
                models.push(record);
                displayTplData.push(record.data);
                processedValue.push(record.get(me.valueField));
            }
            // record was not found, this could happen because
            // store is not loaded or they set a value not in the store
            else {
                // if valueNotFoundText is defined, display it, otherwise display nothing for this value
                if (Ext.isDefined(valueNotFoundText)) {
                    displayTplData.push(valueNotFoundText);
                }
                processedValue.push(value[i]);
            }
        }

        // Set the value of this field. If we are multiselecting, then that is an array.
        me.value = me.multiSelect ? processedValue : processedValue[0];
        if (!Ext.isDefined(me.value)) {
            me.value = null;
        }
        me.displayTplData = displayTplData; //store for getDisplayValue method
        me.lastSelection = me.valueModels = models;

        if (inputEl && me.emptyText && !Ext.isEmpty(value)) {
            inputEl.removeCls(me.emptyCls);
        }

        // Calculate raw value from the collection of Model data
        me.setRawValue(me.getDisplayValue());
        me.checkChange();

        if (doSelect !== false) {
            me.syncSelection();
        }
        me.applyEmptyText();

        return me;
    },

    /**
     * Returns the current data value of the field. The type of value returned is particular to the type of the
     * particular field (e.g. a Date object for {@link Ext.form.field.Date}), as the result of calling {@link #rawToValue} on
     * the field's {@link #processRawValue processed} String value. To return the raw String value, see {@link #getRawValue}.
     * @return {Mixed} value The field value
     */
    getValue: function() {
        var me = this,
            val = me.rawToValue(me.processRawValue(me.getRawValue())),
            record;

        if (Ext.isString(val)) {
            record = me.findRecord('title', val);
            if (Ext.isObject(record))
                val = record.data;
        }

        me.value = val;
        return val;
    }
});