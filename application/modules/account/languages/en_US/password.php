<?php

/**
 * ————————————————————————————————————————————————————————————————————————————————
 * WEBTIGERS / TIGER PLATFORM
 * Language Translation Keys
 * Password Widget Translations
 * ————————————————————————————————————————————————————————————————————————————————
 */

/**
 * These password options can be found in the account/configs/password.ini file.
 */

return [
    'PASSWORD.WEAK' => 'Weak',
    'PASSWORD.FAIR' => 'Fair',
    'PASSWORD.GOOD' => 'Good',
    'PASSWORD.STRONG' => 'Strong',

    'LABEL.PASSWORD' => 'Password',

    'ERROR.PW_LENGTH' => 'Must have at least %pw_length% characters.',
    'ERROR.PW_UPPER' => 'Must contain %pw_upper% uppercase.',
    'ERROR.PW_LOWER' => 'Must contain %pw_lower% lowercase.',
    'ERROR.PW_DIGIT' => 'Must contain %pw_digit% number(s).',
    'ERROR.PW_SPECIAL' => 'Must contain %pw_special% punctuation.',
    'ERROR.PW_ILLEGAL' => 'Contain illegal characters.',
    'ERROR.PW_REPEATING' => 'More than %pw_repeating% repeat characters.',

    'PASSWORD.DESCRIPTION' => '<p>Double-click field to view / hide password.</p><p><strong>Password Requirements:</strong></p><ul class="list icons list-unstyled"><li><div class="progress"><div class="progress-bar" role="progressbar" style="width: 0%; background-color: red;"><span class="progress-bar-tooltip">&nbsp;</span></div></li><li class="pw-strength"><i class="icon-password-strength fa fa-ban red"></i>Must have a Password Strength of at least: <span class="pw-strength-count">70</span></li><li class="pw-length"><i class="icon-password-length fa fa-ban red"></i>Should be minimum length of <span class="pw-length-count">1</span> characters.</li><li class="pw-lower"><i class="icon-password-lower fa fa-ban red"></i>Should contain at least <span class="pw-lower-count">1</span> lowercase character.</li><li class="pw-upper"><i class="icon-password-upper fa fa-ban red"></i>Should contain at least <span class="pw-upper-count">1</span> uppercase character.</li><li class="pw-digit"><i class="icon-password-digit fa fa-ban red"></i>Should contain at least <span class="pw-digit-count">1</span> number.</li><li class="pw-special"><i class="icon-password-special fa fa-ban red"></i>Should contain at least <span class="pw-special-count">1</span> punctuation character.</li><li class="pw-repeating"><i class="icon-password-repeating fa fa-check green"></i>Cannot contain more than <span class="pw-repeating-count">1</span> repeating characters.</li><li class="pw-illegal"><i class="icon-password-illegal fa fa-check green"></i>Cannot contain any illegal characters.</li></ul>',

];
