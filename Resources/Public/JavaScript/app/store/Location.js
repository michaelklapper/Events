Ext.define('AM.store.Location', {
    extend: 'Ext.data.Store',
    model: 'AM.model.Location',
    autoLoad: true,
    autoDestroy: true,
    autoSync: true,
    proxy : {
        type: 'direct',
        directFn: Events.Events_Controller_LocationController.list,
        reader: {
            type: 'json',
            root: 'data'
        },
        api: {
            create  : Events.Events_Controller_LocationController.create,
//            read    : Events.Events_Controller_LocationController.read,
            update  : Events.Events_Controller_LocationController.update,
            destroy : Events.Events_Controller_LocationController.destroy
        }
    }
});