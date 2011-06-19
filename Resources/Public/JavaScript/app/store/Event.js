Ext.define('AM.store.Event', {
    extend: 'Ext.data.Store',
    model: 'AM.model.Event',
    autoLoad: true,
    proxy : {
        type: 'direct',
        directFn: Events.Events_Controller_EventController.list,
        reader: {
            type: 'json',
            root: 'data'
        },

        api: {
            create  : Events.Events_Controller_EventController.create,
            read    : Events.Events_Controller_EventController.read,
            update  : Events.Events_Controller_EventController.update,
            destroy : Events.Events_Controller_EventController.destroy
        }
    }
});