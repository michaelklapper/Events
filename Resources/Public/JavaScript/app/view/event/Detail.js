Ext.define('AM.view.event.Detail' ,{
    extend: 'Ext.panel.Panel',
    alias : 'widget.eventDetail',
    cls: 'detail',
    autoScroll: true,
    border: true,

    initComponent: function () {
        Ext.apply(this, {
            tpl: Ext.create('Ext.XTemplate',
                    '<div class="model-data">',
                        '<span class="model-date">{date:this.formatDate}</span>',
                        '<h1 class="model-title">{title}</h1>',
                        '<h2 class="model-title">State: {state.title}</h2>',
                    '</div>',
                    '<br /><br />',
                    '<button action="openLocationInMap">Open lcoation in maps</button>',
                    '<h2 class="model-title">Location: {location:this.getLocationTitle}</h2>',
                    '<div class="model-body">Address: {location.street} {location.number}, {location.zip} {location.city}, {location.country}</div>',
                    '<br /><br />',
                    '<h2 class="model-title">Appointment</h2>',
                    '<div class="model-body">Date: {date:this.formatDate}</div>',
                    '<div class="model-body">Time begin: {timeBegin}</div>',
                    '<div class="model-body">Time end: {timeEnd}</div>',
                    '<br /><br />',
                    '<div class="model-body">Url: <a href="{url}" target="_blank">{url}</a></div>',
                    '<br /><br />',
                    '<h2 class="model-title">Description</h2>',
                    '<div class="model-body">{description}</div>',
                    '<br /><br />',
                    '<h2 class="model-title">Comment</h2>',
                    '<div class="model-body">{comment}</div>',
                    {
                    getLocationTitle: function (location) {
                        if (!Ext.isObject(location)) {
                            return '';
                        }

                        return location.title;
                    },
                    formatDate: function (date) {
                        if (!date)
                            return '';

                        return Ext.Date.format(date, 'Y-m-d');
                    }
                })
        });

        this.callParent(arguments);
    }
});