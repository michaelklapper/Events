Ext.define('AM.view.event.Detail' ,{
    extend: 'Ext.panel.Panel',
    alias : 'widget.eventDetail',
    cls: 'preview',
    autoScroll: true,
    border: true,

    initComponent: function () {
        Ext.apply(this, {
            tpl: Ext.create('Ext.XTemplate',
                    '<div class="model-data">',
                        '<span class="model-date">{date:this.formatDate}</span>',
                        '<h1 class="model-title">{title}</h1>',
                        '<h1 class="model-title">State: {state.title}</h1>',
                        '<h1 class="model-title">Wo: {location:this.getLocationTitle}</h1>',
                    '</div>',
                    '<div class="model-body">Anfang: {timeBegin}</div>',
                    '<div class="model-body">Ende: {timeEnd}</div>',
                    '<div class="model-body">Url: <a href="{url}" target="_blank">{url}</a></div>',
                    '<div class="model-body">{description}</div>',
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