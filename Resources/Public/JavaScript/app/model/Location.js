Ext.define('AM.model.Location', {
    extend: 'Ext.data.Model',
    fields: [
        {name: 'id',  type: 'integer'},
        {name: 'title',  type: 'string'},
        {name: 'street',  type: 'string'},
        {name: 'number',  type: 'string'},
        {name: 'zip',  type: 'string'},
        {name: 'city',  type: 'string'},
        {name: 'country',  type: 'string'},
        {name: '__identity',  type: 'string'}

    ],
    idProperty: 'id'
});