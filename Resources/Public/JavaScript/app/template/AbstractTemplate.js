/**
 * User: Michael Klapper
 * Date: 22.06.11
 * Time: 19:31
 */
Ext.define('AM.template.AbstractTemplate', {
    extend: 'Ext.panel.Panel',
    alias : 'widget.abstractTemplate',

    /**
     * Default height
     *
     * @var integer
     */
    height:100,

    /**
     * Local object which stores the data to proccess.
     *
     * @var object
     */
    config: {
        message: 'You have to overwrite the default template'
    },

    /**
     * Default template which must be overwritten.
     */
    template: [
        '<p style="color:red;">{message}</p>'
    ],

    /**
     * Initialize header template object
     *
     * @param options
     *
     * @author Michael Klapper <mick.klapper.development@gmail.com>
     */
    constructor: function(options){
        this.callParent(arguments);
        this.initConfig(options);
        this.reloadTemplate();
        return this;
    },

    /**
     * Initialize our template, store in private variable to be recycled
     * Compile the template to save on multiple iterations
     *
     * @return void
     *
     * @author Michael Klapper <mick.klapper.development@gmail.com>
     */
    reloadTemplate:  function(){
        this._template = Ext.isObject(this.template) ?
                                                this.template :
                                                new Ext.XTemplate(this.template);

        this._template.compile();
        this.reload();
    },

    /**
     * Update the contents of this component's body to be the
     * rendered signature template.
     *
     * @return void
     *
     * @author Michael Klapper <mick.klapper.development@gmail.com>
     */
    reload : function() {

        this.update(this._template.apply({
            message: this.getMessage()
        }));
    }
});