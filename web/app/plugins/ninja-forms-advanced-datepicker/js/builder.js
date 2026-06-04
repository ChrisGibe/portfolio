var customBuilderFlatPickr = Marionette.Object.extend( {
    initialize: function() {
        /*
         * Listen to our date pickers as they are created on the page.
         */
        Backbone.Radio.channel( 'setting-type-datepicker' ).reply( 'filter:settings', this.filterDateSettings, this );    
        
        this.listenTo( Backbone.Radio.channel( 'setting-type-datepicker' ), 'loadComplete', this.setupWeekdayButtons );
    },

    filterDateSettings: function( settings, settingModel, el ) {
        if ( 'restricted_dates' != settingModel.get( 'name' ) ) {
            return settings;
        }
        
        jQuery( el ).hide();
        settings.mode = 'multiple';
        settings.inline = true;
        settings.dateFormat = "Y-m-d";
        settings.conjunction = ',';
        
        return settings;
    },

    setupWeekdayButtons: function( instance, settingModel, dataModel, view  ) {

        instance.config.restricted_weekdays = dataModel.get( 'restricted_weekdays' );

        if ( 'undefined' == typeof dataModel.get( 'restricted_weekdays' ) ) {
            instance.config.restricted_weekdays = [];
        }
        
        instance.set( 'disable', [ function( date ) {
            // If we haven't disabled any weekdays, then return false.
            if ( 0 == instance.config.restricted_weekdays.length ) {
                return false;
            }

            let weekday = date.getDay();
            if ( -1 == instance.config.restricted_weekdays.indexOf( weekday ) ) {
                return false;
            }
        
            return true;
        } ] );

        jQuery( instance.calendarContainer ).find( '.flatpickr-weekdaycontainer > .flatpickr-weekday' ).each( function( index ) {
            jQuery( this ).on( 'click', function() {
                // If the index is already in our array, remove it. Else, add it.
                if ( -1 != instance.config.restricted_weekdays.indexOf( index ) ) {
                    instance.config.restricted_weekdays = _.without( instance.config.restricted_weekdays, index );
                } else {
                    instance.config.restricted_weekdays.push( index );
                }

                dataModel.set( 'restricted_weekdays', instance.config.restricted_weekdays );
                Backbone.Radio.channel( 'app' ).request( 'update:setting', 'clean', false );

                instance.redraw();
            } );
        } );
    }
});

jQuery( document ).ready( function() {
    new customBuilderFlatPickr();
} );