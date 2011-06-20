/**
 * User: Michael Klapper
 * Date: 21.06.11
 * Time: 23:53
 */
Ext.define('AM.view.gmail.Detail', {
    extend: 'Ext.window.Window',
    alias : 'widget.gMapsDetail',

    title : 'Location',
    layout: 'fit',
    autoShow: true,
    width:450,
    height:450,

    initComponent: function() {
        this.callParent(arguments);
    },

    showMap: function (location) {
        this.add({
            xtype: 'gmappanel',
            zoomLevel: 14,
            gmapType: 'map',
            mapConfOpts: ['enableScrollWheelZoom','enableDoubleClickZoom','enableDragging'],
            mapControls: ['GSmallMapControl','GMapTypeControl','NonExistantControl'],
            setCenter: {
                geoCodeAddr: location.get('street') + ' ' + location.get('number') + ', ' + location.get('zip') + ' ' + location.get('city') + ', ' + location.get('country'),
                marker: {title: location.get('title')},
                listeners: {
                    click: function(e){
                        Ext.Msg.alert({title: 'Location: ' + location.get('title'), text: 'to define'});
                    }
                }
            }
        });
    }
});