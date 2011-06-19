Ext.define('AM.model.State', {
    extend: 'Ext.data.Model',
    fields: [
        {name: 'id',  type: 'integer'},
        {name: 'title',  type: 'string'},
        {name: '__identity',  type: 'string'}
    ],
    idProperty: 'id'
});