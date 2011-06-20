function getContact() {
    return {
        firstName: 'Mick',
        lastName: 'Klapper',
        mobile: '0170 - 79 44 24 0',
        email : 'michael.klapper@gmail.com'
    };
}

Ext.define('AM.view.event.Detail' ,{
    extend: 'Ext.panel.Panel',
    alias : 'widget.eventDetail',
    cls: 'detail',
    id: 'eventDetail',
    border: true,
    layout:'column',
    margins:'35 5 5 0',
    autoScroll:true,
    defaults: {
        layout: 'anchor',
        defaults: {
            anchor: '100%'
        }
    },
    tbar: [{
        text: 'Get Directions',
        action: 'getDirection'
    }, '-', {
        text: 'Twitter',
        action: 'twitter'
    }, '-', {
        text: 'Facebook',
        action: 'facebook'
    }, '->', {
        text: 'Update',
        action: 'update'
    }],

    eventRecord: {},

    initComponent: function () {
        this.items = [{
            columnWidth: 2/3,
            baseCls:'x-plain',
            bodyStyle:'padding:5px 0 5px 5px',
            items:[{
                xtype: 'eventDetailHeader',
                title: this.eventRecord.get('title'),
                location: this.eventRecord.get('location'),
                contact: getContact(),
                url: this.eventRecord.get('url'),
                height:160
            }, {
                xtype: 'eventDetailAppointment',
                title: 'Appointment',
                date : this.eventRecord.get('date'),
                timeBegin : this.eventRecord.get('timeBegin'),
                timeEnd : this.eventRecord.get('timeEnd')
            }, {
                xtype: 'abstractTemplate',
                title: 'Description',
                message : this.eventRecord.get('description'),
                template: '{message}'
            }, {
                xtype: 'abstractTemplate',
                title: 'Comment',
                message : this.eventRecord.get('comment'),
                template: '{message}'
            }]
        }, {
            columnWidth: 1/3,
            baseCls:'x-plain',
            bodyStyle:'padding:5px 0 5px 5px',
            items:[{
                xtype: 'gMapsDetail',
                location: this.eventRecord.get('location'),
                height:300
            }]
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
     * Get the current events title.
     *
     * @return string
     *
     * @author Michael Klapper <mick.klapper.development@gmail.com>
     */
    getEventTitle: function () {
        return this.eventRecord.get('title');
    },

    /**
     * Get the current events.
     *
     * @return AM.model.event.Event
     *
     * @author Michael Klapper <mick.klapper.development@gmail.com>
     */
    getEventRecord: function () {
        return this.eventRecord;
    },

    /**
     * Get location object from detail view.
     *
     * @return object
     *
     * @author Michael Klapper <mick.klapper.development@gmail.com>
     */
    getLocation: function() {
        return  this.eventRecord.get('location');
    }

});