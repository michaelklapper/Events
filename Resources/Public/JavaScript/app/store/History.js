/**
 * History Store
 */
Ext.define('AM.store.History', {
    extend: 'Ext.data.Store',
    model: 'AM.model.History',

    /**
     * Sort history with latest on top
     */
    sorters: [
        { property: 'id', direction: 'DESC' }
    ]
});
