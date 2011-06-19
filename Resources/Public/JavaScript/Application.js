Ext.application({
    name: 'AM',

    appFolder: 'JavaScript/app',

    controllers: [
        'Event',
        'Location'
    ],

    launch: function() {
        Ext.create('Ext.container.Viewport', {
            layout: 'border',
            padding: 5,
            items: [this.createTabContainer()]
        });
    },

    /**
     * Create the bottom bar.
     *
     * @private
     * @return {}
     *
     * @author Michael Klapper <mick.klapper.development@gmail.com>
     */
    createStatusBar: function () {
        return Ext.create('Ext.ux.StatusBar', {
            defaultText: '',
            id: 'status-id',
            clear: true
        });
    },

    /**
     * Create the feed info container
     *
     * @private
     * @return {AM.view.TabContainer} List
     *
     * @author Michael Klapper <mick.klapper.development@gmail.com>
     */
    createTabContainer: function() {
        return {
            xtype: 'tabContainer',
            region: 'center',
            minWidth: 300,
            activeTab: 0,
            bbar: this.createStatusBar(),
            items: [this.createEventList()]
        };
    },

    /**
     * Create the feed info container
     * @private
     * @return {AM.view.event.List} List
     */
    createEventList: function() {
        return {
            title: 'All Events',
            xtype: 'eventList',
            minWidth: 300
        };
    }
});