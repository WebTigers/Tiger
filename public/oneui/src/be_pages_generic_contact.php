<?php require 'inc/_global/config.php'; ?>
<?php require 'inc/backend/config.php'; ?>
<?php require 'inc/_global/views/head_start.php'; ?>
<?php require 'inc/_global/views/head_end.php'; ?>
<?php require 'inc/_global/views/page_start.php'; ?>

<!-- Hero Content -->
<div class="bg-primary-dark">
    <div class="content content-full overflow-hidden">
        <div class="mt-7 mb-5 text-center">
            <h1 class="h2 text-white mb-2 invisible" data-toggle="appear" data-class="animated fadeInDown">Contact Us.</h1>
            <h2 class="h4 font-w400 text-white-75 invisible" data-toggle="appear" data-class="animated fadeInDown">Do you need any assistance with your plan? Let us know!</h2>
        </div>
    </div>
</div>
<!-- END Hero Content -->

<!-- Page Content -->
<div class="bg-white">
    <div class="content">
        <div class="row items-push justify-content-center">
            <div class="col-md-10 col-xl-5">
                <form action="be_pages_generic_contact.php" method="POST" onsubmit="return false;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="frontend-contact-firstname">Firstname</label>
                                <input type="text" class="form-control" id="frontend-contact-firstname" name="frontend-contact-firstname" placeholder="Enter your firstname..">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="frontend-contact-lastname">Lastname</label>
                                <input type="text" class="form-control" id="frontend-contact-lastname" name="frontend-contact-lastname" placeholder="Enter your lastname..">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="frontend-contact-email">Email</label>
                        <input type="email" class="form-control" id="frontend-contact-email" name="frontend-contact-email" placeholder="Enter your email..">
                    </div>
                    <div class="form-group">
                        <label for="frontend-contact-subject">Custom Menu</label>
                        <select class="custom-select" id="frontend-contact-subject" name="frontend-contact-subject" size="1">
                            <option value="1">Support</option>
                            <option value="2">Billing</option>
                            <option value="3">Management</option>
                            <option value="4">Feature Request</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="frontend-contact-msg">Textarea</label>
                        <textarea class="form-control" id="frontend-contact-msg" name="frontend-contact-msg" rows="7" placeholder="Enter your message.."></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-paper-plane mr-1"></i> Send Message
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->

<!-- Maps and Search functionality is initialized in js/pages/be_pages_generic_contact.min.js which was auto compiled from _es6/pages/be_comp_maps_google.js -->
<!-- For more info and examples you can check out https://hpneo.github.io/gmaps/ -->
<div class="bg-white" id="js-map-contact" style="height: 350px;"></div>

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>

<!-- Page JS Plugins -->
<!-- Google Maps API Key (you will have to obtain a Google Maps API key to use Google Maps) -->
<!-- For more info please have a look at https://developers.google.com/maps/documentation/javascript/get-api-key#key -->
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $one->google_maps_api_key; ?>"></script>
<?php $one->get_js('js/plugins/gmaps/gmaps.min.js'); ?>

<!-- Page JS Code -->
<?php $one->get_js('js/pages/be_pages_generic_contact.min.js'); ?>

<?php require 'inc/_global/views/footer_end.php'; ?>
