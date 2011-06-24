Ext.Loader.setConfig({enabled:true});
Ext.QuickTips.init();

Ext.application({
    name: 'AM',
    defaultUrl: 'navigation',     //FIXME default url doesn't work.
    appFolder: 'JavaScript/app',

    controllers: [
        'Event',
        'CalendarController',
        'Location'
    ],

    launch: function() {
        Ext.create('Ext.container.Viewport', {
            layout: 'border',
            padding: 5,
            items: [
                this.createNavigation(),
                {xtype: 'contentArea'}
            ]
        });
    },

    /**
     * Create the navigation toolbar with all available buttons.
     *
     * @private
     * @return {Ext.toolbar.Toolbar}
     *
     * @author Michael Klapper <mick.klapper.development@gmail.com>
     */
    createNavigation: function () {
        return {
            xtype: 'toolbar',
            region: 'north',
            id: 'navigation',
            items: [{
                text: 'Event List',
                action: 'showEventList'
            }, {
                text: 'Event Calendar',
                action: 'showEventCalendar'
            }]
        };
    }
});