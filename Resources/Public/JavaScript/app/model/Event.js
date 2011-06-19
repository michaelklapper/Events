Ext.define('AM.model.Event', {
    extend: 'Ext.data.Model',
    fields: [
        {name: 'id',  type: 'integer'},
        {name: 'title',  type: 'string'},
        {name: 'date',  type: 'date'},
        {name: 'timeBegin',  type: 'string'},
        {name: 'timeEnd',  type: 'string'},
        {name: 'url',  type: 'string'},
        {name: 'description',  type: 'string'},
        {name: 'comment',  type: 'string'},
        {name: 'location',  type: 'object'},
        {name: 'state',  type: 'object'}
    ],
    idProperty: 'id'
});