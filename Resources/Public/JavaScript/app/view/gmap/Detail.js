/**
 * User: Michael Klapper
 * Date: 21.06.11
 * Time: 23:53
 */
Ext.define('AM.view.gmail.Detail', {
    extend: 'Ext.panel.Panel',
    alias : 'widget.gMapsDetail',

    title : 'Location',
    layout: 'fit',
    autoShow: true,

    /**
     * Location record
     *
     * @var object
     */
    location: {},

    initComponent: function() {
        this.callParent(arguments);
        console.log(location);
        this.add({
            xtype: 'gmappanel',
            zoomLevel: 14,
            gmapType: 'map',
            mapConfOpts: ['enableScrollWheelZoom','enableDoubleClickZoom','enableDragging'],
            mapControls: ['GSmallMapControl','GMapTypeControl','NonExistantControl'],
            setCenter: {
                geoCodeAddr: this.location.street + ' ' + this.location.number + ', ' + this.location.zip + ' ' + this.location.city + ', ' + this.location.country,
                marker: {title: this.location.title}
            }
        });
    }
});