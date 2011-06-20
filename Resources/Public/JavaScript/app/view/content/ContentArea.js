/**
 * User: Michael Klapper
 * Date: 21.06.11
 * Time: 19:49
 */
Ext.define('AM.view.contentArea', {
    extend: 'Ext.panel.Panel',
    alias : 'widget.contentArea',

    layout: 'card',

    id: 'contentPanel',
    region: 'center',

    /**
     * Add content component to display in the viewPort.
     *
     * @param component
     *
     * @author Michael Klapper <mick.klapper.development@gmail.com>
     */
    addContent: function(component) {
        if (!this.getComponent(component.id)) {
			this.add(component);
		}

        this.getLayout().setActiveItem(component.id);
    }
});