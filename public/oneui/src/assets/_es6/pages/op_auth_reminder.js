/*
 *  Document   : op_auth_reminder.js
 *  Author     : pixelcave
 *  Description: Custom JS code used in Password Reminder Page
 */

class pageAuthReminder {
    /*
     * Init Password Reminder Form Validation, for more examples you can check out https://github.com/jzaefferer/jquery-validation
     *
     */
    static initValidation() {
        // Load default options for jQuery Validation plugin
        One.helpers('validation');

        // Init Form Validation
        jQuery('.js-validation-reminder').validate({
            rules: {
                'reminder-credential': {
                    required: true,
                    minlength: 3
                }
            },
            messages: {
                'reminder-credential': {
                    required: 'Please enter a valid credential'
                }
            }
        });
    }

    /*
     * Init functionality
     *
     */
    static init() {
        this.initValidation();
    }
}

// Initialize when page loads
jQuery(() => { pageAuthReminder.init(); });
