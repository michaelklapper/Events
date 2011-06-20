/**
 * User: Michael Klapper
 * Date: 22.06.11
 * Time: 19:31
 */
Ext.define('AM.template.event.Header', {
    extend: 'AM.template.AbstractTemplate',
    alias : 'widget.eventDetailHeader',

    config: {
        location: {},
        contact: {},
        url: ''
    },

    template: [
        '<p>{location.street} {location.number}, {location.zip} {location.city}<br />{location.country}</p>',
        '<br />',
        '<p>{contact.firstName} {contact.lastName}<br />Mobile: {contact.mobile}<br />Email: {contact.email}</p>',
        '<br />',
        '<p>{url}</p>'
    ],

    /**
     * Update the contents of this component's body to be the
     * rendered signature template.
     *
     * @return void
     *
     * @author Michael Klapper <mick.klapper.development@gmail.com>
     */
    reload : function() {

        this.update(this._template.apply({
            location: this.getLocation(),
            contact: this.getContact(),
            url: this.getUrl()
        }));
    }
});