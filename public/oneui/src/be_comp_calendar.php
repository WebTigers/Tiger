<?php require 'inc/_global/config.php'; ?>
<?php require 'inc/backend/config.php'; ?>
<?php require 'inc/_global/views/head_start.php'; ?>

<!-- Page JS Plugins CSS -->
<?php $one->get_css('js/plugins/fullcalendar/fullcalendar.min.css'); ?>

<?php require 'inc/_global/views/head_end.php'; ?>
<?php require 'inc/_global/views/page_start.php'; ?>

<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
                Calendar <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">A solid foundation to build your calendar based web application. Powered by Full Calendar.</small>
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Components</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Calendar</a>
                    </li>
                </ol>
            </nav>
        </div>
   </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
    <!-- Calendar -->
    <div class="block">
        <div class="block-content">
            <div class="row items-push">
                <div class="col-md-8 col-lg-7 col-xl-9">
                    <!-- Calendar Container -->
                    <div class="js-calendar"></div>
                </div>
                <div class="col-md-4 col-lg-5 col-xl-3">
                    <!-- Add Event Form -->
                    <form class="js-form-add-event push">
                        <div class="input-group">
                            <input type="text" class="js-add-event form-control" placeholder="Add Event..">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fa fa-fw fa-plus-circle"></i>
                                </span>
                            </div>
                        </div>
                    </form>
                    <!-- END Add Event Form -->

                    <!-- Event List -->
                    <ul class="js-events list list-events">
                        <li style="background-color: #fac5a5;">Work</li>
                        <li style="background-color: #b5d0eb;">Relax</li>
                        <li style="background-color: #faeab9;">Gym</li>
                        <li style="background-color: #fac5a5;">Secret Project</li>
                        <li style="background-color: #c8e2b3;">Cinema</li>
                        <li style="background-color: #b6d1ec;">Biking</li>
                        <li style="background-color: #c8e2b3;">Trip</li>
                        <li style="background-color: #faeab9;">Swimming</li>
                    </ul>
                    <div class="text-center">
                        <em class="font-size-sm text-muted">
                            <i class="fa fa-arrows-alt"></i> Drag and drop events on the calendar
                        </em>
                    </div>
                    <!-- END Event List -->
                </div>
            </div>
        </div>
    </div>
    <!-- END Calendar -->
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>

<!-- Page JS Plugins -->
<?php $one->get_js('js/plugins/jquery-ui/jquery-ui.min.js'); ?>
<?php $one->get_js('js/plugins/moment/moment.min.js'); ?>
<?php $one->get_js('js/plugins/fullcalendar/fullcalendar.min.js'); ?>

<!-- Page JS Code -->
<?php $one->get_js('js/pages/be_comp_calendar.min.js'); ?>

<?php require 'inc/_global/views/footer_end.php'; ?>
