Ext.define('AM.view.TabContainer' ,{
    extend: 'Ext.tab.Panel',
    alias : 'widget.tabContainer',
    
    maxTabWidth: 230,
    border: false,
    
    initComponent: function() {
        var me = this;
        me.tabBar = {
            border: true
        };

        this.callParent();
    },

    /**
     * Open the detail view of an given {Ext.data.Model}.
     *
     * @private
     * @param string detailViewType xtype of component to use
     * @param {Ext.data.Model} record Model containing the data.
     *
     * @author Michael Klapper <mick.klapper.development@gmail.com>
     * @return void
     */
    addDetailTab: function (detailViewType, record) {
        if (!this.getComponent(record.get('id'))) {
            this.add({
                title: record.get('title'),
                xtype: detailViewType,
                eventRecord: record,
                id: record.get('id'),
                closable: true
            });
        }

        this.setActiveTab(record.get('id'));

    }
});