/**
 * Browser history management using Ext.util.History.
 */
Ext.define('AM.History', {
    extend: 'AM.LocalStore',
    storeName: 'History',
    singleton: true,

    // Maximum number of items to keep in history store
    maxHistoryLength: 25,

    /**
     * Initializes history management.
     */
    init: function() {
        Ext.util.History.init(function() {
            this.navigate(Ext.util.History.getToken());
        }, this);
        Ext.util.History.on("change", this.navigate, this);
        this.callParent();
    },

    // Parses current URL and navigates to the page
    navigate: function(token) {
        if (this.ignoreChange) {
            this.ignoreChange = false;
            return;
        }

        var request = this.parseToken(token),
                eventContainer = Ext.getCmp('eventTabContainer');

        if (request.controller != undefined && eventContainer != undefined) {
            AM.App.getController(request.controller)[request.action](request.arguments)
        } else if (request.controller != undefined && eventContainer == undefined) {
            AM.App.getController('Event').indexAction(true);
            AM.App.getController(request.controller)[request.action](request.arguments)
        } else {
            AM.App.getController('Event').indexAction(true);
        }
    },

    // Parses current browser location
    parseToken: function(token) {
        var matches = token && token.match(/\/([^\/]+)\/([^\/]+)\/(.*)/),
                request = {};
        if (matches) {
            request = {
                controller: Ext.String.capitalize(matches[1]),
                action: matches[2] + 'Action',
                arguments: matches[3]
            };
        }

        return request;
    },

    // Extracts class name from history token
    // Returns false when it's not class-related token.
    parseRequest: function(token) {
        var request = this.parseToken(token);
        if (request.controller != undefined) {
            return request;
        }
        else {
            return false;
        }
    },

    /**
     * Adds URL to history
     *
     * @param {String} token  the part of URL after #
     */
    push: function(token) {
        this.ignoreChange = true;
        Ext.util.History.add(token);

        // Add class name to history store if it's not there already
        var request = this.parseRequest(token);
        if (request) {

            var oldIndex = this.store.findExact('token', token);
            if (oldIndex > -1) {
                this.store.removeAt(oldIndex);
            }


            // Add new item at the beginning
            this.store.insert(0, {token: token});

            // Remove items from the end of history if there are too many
            while (this.store.getAt(this.maxHistoryLength)) {
                this.store.removeAt(this.maxHistoryLength);
            }
            this.syncStore();
        }
    }
});
