Ext.define('AM.view.event.List' ,{
    extend: 'Ext.grid.Panel',
    alias : 'widget.eventList',
    store: 'Event',
    id: 'eventGrid',

    title : 'All Events',

    tbar: ['->', {
        text: 'Edit',
        tooltip:'Edit existing Event',
        iconCls:'icon-add',
        action: 'edit'
    }, '-', {
        text: 'Add',
        tooltip:'Create new Event',
        iconCls:'icon-add',
        action: 'add'
    }, '-', {
        text: 'Delete',
        tooltip: 'Delete an Event',
        iconCls: 'icon-delete',
        action: 'delete'
    }],
    initComponent: function() {
        this.columns = [
            {header: 'Title',  dataIndex: 'title',  flex: 1},
            {text: 'Appointment',
                columns: [
                    {header: 'Date',  dataIndex: 'date', renderer: this.formatDate},
                    {header: 'Time begin',  dataIndex: 'timeBegin'},
                    {header: 'Time end',  dataIndex: 'timeEnd'}
                ]
            },
            {header: 'Url',  dataIndex: 'url',  flex: 1}
        ];

        this.callParent(arguments);
    },

    /**
     * Date renderer
     * @private
     * renderer : Ext.util.Format.dateRenderer('m/d/Y')
     */
    formatDate: function(date){
        if (!date) {
            return '';
        }
        return Ext.Date.format(date, 'Y-m-d');
    }
});