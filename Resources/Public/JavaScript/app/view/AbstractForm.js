


Ext.form.action.DirectSubmit.override({
    run : function(){
        var form = this.form,
        isNewRecord = this.form.getRecord().phantom,
        values = form.getValues();
        values['id'] = form.getRecord().get('id').toString();
        if (this.clientValidation === false || form.isValid()) {
            if (isNewRecord) {
                form.api.create(values, {
                    success: form.afterAction,
                    failure: form.afterAction,
                    scope: form
                });
            } else {
                form.api.update(values, {
                    success: form.afterAction,
                    failure: form.afterAction,
                    scope: form
                });
            }
        } else {
            this.failureType = Ext.form.action.Action.CLIENT_INVALID;
            form.afterAction(this, false);
        }
    }
});

Ext.define('AM.view.AbstractForm', {
    extend: 'Ext.form.Panel',
    alias : 'widget.genericForm',

    defaultType: 'textfield',
    fieldDefaults: {
        labelWidth: 100,
        labelStyle: 'font-weight:bold'
    },

    initComponent: function() {
        var config = {
            border: false,
            bodyPadding: 10,
            defaults: {
                margins: '0 0 10 0'
            }
        };

        Ext.apply(this.initialConfig, config);

        this.callParent(arguments);

            // add event listeners
        this.on('beforeaction', this._onFormBeforeAction, this);
        this.on('actioncomplete', this._onFormCompleteAction);
        this.on('actionfailed', this._onFormCompleteAction);
    },


    /**
	 * Validate form and submit
	 *
	 * @return {void}
	 */
	doSubmitForm: function() {
        this.getForm().submit();
	},

    onSubmitSuccess: function () {
        console.log('onSubmitSuccess');
        console.log(arguments);
    },

    /**
     * on form before action, triggered before any action is performed.
     *
     * @param {} form
     * @param {} action
     * ®return {void}
     */
    _onFormBeforeAction: function(form, action) {
        this.el.mask('currentlySaving');
    },

    /**
     * on form action complete
     *
     * @param {} form
     * @param {} action
     * ®return {void}
     */
    _onFormCompleteAction: function(form, action) {
        if (action.success === false) {
            form.markInvalid(action.errors);
        } else {
            this.fireEvent('recordSaved', this, this.getRecord());
            this.up('window').close();
        }
        this.el.unmask();
    }
});