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
        var item = this.add({
            title: record.get('title'),
            xtype: detailViewType,
            data: record.data,
            closable: true
        });
        this.setActiveTab(item);
    }
});