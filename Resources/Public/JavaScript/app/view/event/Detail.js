Ext.define('AM.view.event.Detail' ,{
    extend: 'Ext.panel.Panel',
    alias : 'widget.eventDetail',
    cls: 'detail',
    id: 'eventDetail',
    autoScroll: true,
    border: true,
    layout: {
        type: 'table',
        columns: 2
    },

    initComponent: function () {
        this.items = [{
            title: 'detail',
            html: 'some header'
        }, {
            title: 'Location map',
            html: 'some header',
            rowspan:3
        }, {
            xtype: 'panel',
            title: 'Appointment',
            html : 'some date time datat'
        }, {
            xtype: 'panel',
            title: 'Description',
            html : 'Some details about the event'
        }, {
            xtype: 'panel',
            title: 'Comment',
            html : 'Just some private impressions about ...'
        }];
        /*Ext.apply(this, {
            tpl: Ext.create('Ext.XTemplate',
                    '<div class="model-data">',
                        '<span class="model-date">{date:this.formatDate}</span>',
                        '<h1 class="model-title">{title}</h1>',
                        '<h2 class="model-title">State: {state.title}</h2>',
                    '</div>',
                    '<br /><br />',
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
        });*/

        this.callParent(arguments);
    },

    /**
     * Initializes this components contents. It checks for the properties
     * html, contentEl and tpl/data.
     * @private
     */
    initContent: function() {
        var me = this,
            target = me.getTargetEl(),
            contentEl,
            pre;

        if (me.html) {
            target.update(Ext.core.DomHelper.markup(me.html));
            delete me.html;
        }

        if (me.contentEl) {
            contentEl = Ext.get(me.contentEl);
            pre = Ext.baseCSSPrefix;
            contentEl.removeCls([pre + 'hidden', pre + 'hide-display', pre + 'hide-offsets', pre + 'hide-nosize']);
            target.appendChild(contentEl.dom);
        }

        if (me.tpl) {
            // Make sure this.tpl is an instantiated XTemplate
            if (!me.tpl.isTemplate) {
                me.tpl = Ext.create('Ext.XTemplate', me.tpl);
            }

            if (me.data) {
                me.location = me.data.location;
                me.tpl[me.tplWriteMode](target, me.data);
                delete me.data;
            }
        }
    },

    getLocation: function () {
        return this.location;
    }

});