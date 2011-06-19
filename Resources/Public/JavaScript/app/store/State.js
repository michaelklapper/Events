Ext.define('AM.store.State', {
    extend: 'Ext.data.Store',
    model: 'AM.model.State',
    autoLoad: true,
    proxy : {
        type: 'direct',
        directFn: Events.Events_Controller_StateController.list,
        reader: {
            type: 'json',
            root: 'data'
        }
    }
});