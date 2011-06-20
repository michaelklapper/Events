Ext.define('AM.controller.GMapsController', {
    extend: 'Ext.app.Controller',
    refs: [{
        ref: 'detailView',
        selector: 'eventDetail'
    }],
    models: [
        'Location'
    ],
    init: function() {
        this.control({
            'eventDetail button[action=openLocationInMap]': {
                click: this.indexAction
            }
        });
    },

    indexAction: function (button) {
        var view = Ext.widget('gMapsDetail');
        var model = this.getLocationModel();
        var location = new model(this.getDetailView().getLocation());
        view.showMap(location);
    }
});