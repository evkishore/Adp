<?php
namespace Multiple\Backend\Controllers;

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller {

    // Common Innit for all Controller
    public function initialize() {
        $ControllerName = $this->router->getControllerName();
        $ActionName     = $this->router->getActionName();
        $this->tag->setTitle("{$ControllerName} management");
        $this->view->setVars(array(
            "ControllerName"    => $ControllerName,
            "ActionName"        => $ActionName,
            "base_url"          => $this->base_url()
        ));

        $this->assets
            ->collection('css-mandatory')
            ->addCss('//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all')
            ->addCss('backend/assets/global/plugins/font-awesome/css/font-awesome.min.css')
            ->addCss('backend/assets/global/plugins/simple-line-icons/simple-line-icons.min.css')
            ->addCss('backend/assets/global/plugins/bootstrap/css/bootstrap.min.css')
            ->addCss('backend/assets/global/plugins/uniform/css/uniform.default.css')
            ->addCss('backend/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css');

        $this->assets
            ->collection('css-theme-global')
            ->addCss('backend/assets/global/css/components.min.css')
            ->addCss('backend/assets/global/css/plugins.min.css');

        $this->assets
            ->collection('css-theme-layout')
            ->addCss('backend/assets/layouts/layout/css/themes/darkblue.min.css')
            ->addCss('backend/assets/layouts/layout/css/layout.min.css')
            ->addCss('backend/assets/layouts/layout/css/custom.min.css');

        $this->assets
            ->collection('css-page-level')
            ->addCss('backend/assets/pages/css/style.css')
            ->addCss('backend/assets/global/plugins/morris/morris.css')
            ->addCss('backend/assets/global/plugins/datatables/datatables.min.css')
            ->addCss('backend/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')
            ->addCss('backend/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')
            ->addCss('backend/assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css')
            ->addCss('backend/assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css')
            ->addCss('backend/assets/global/plugins/bootstrap-summernote/summernote.css')
            ->addCss('backend/assets/global/plugins/jquery-notific8/jquery.notific8.min.css')
            ->addCss('backend/assets/global/plugins/dropzone/dropzone.min.css')
            //->addCss('backend/assets/global/plugins/dropzone/basic.min.css')
            ;

        $this->assets
            ->collection('js-ie9')
            ->addJs('backend/assets/global/plugins/respond.min.js')
            ->addJs('backend/assets/global/plugins/excanvas.min.js');

        $this->assets
            ->collection('js-core')
            ->addJs('backend/assets/global/plugins/jquery.min.js')
            ->addJs('backend/assets/global/plugins/bootstrap/js/bootstrap.min.js')
            ->addJs('backend/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')
            ->addJs('backend/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')
            ->addJs('backend/assets/global/plugins/jquery.blockui.min.js')
            ->addJs('backend/assets/global/plugins/uniform/jquery.uniform.min.js')
            ->addJs('backend/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')

            ->addJs('backend/assets/global/plugins/bootstrap-daterangepicker/moment.min.js')
            ->addJs('backend/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js')
            ->addJs('backend/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')
            ->addJs('backend/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js')
            ->addJs('backend/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')
            ->addJs('backend/assets/global/plugins/clockface/js/clockface.js')

            ->addJs('backend/assets/global/scripts/datatable.js')
            ->addJs('backend/assets/global/plugins/datatables/datatables.min.js')
            ->addJs('backend/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')
            ;

        $this->assets
            ->collection('js-theme-global')
            ->addJs('backend/assets/global/scripts/app.min.js')
            ->addJs('backend/assets/global/plugins/jquery-validation/js/jquery.validate.min.js')
            ->addJs('backend/assets/global/plugins/jquery-validation/js/additional-methods.min.js')
            ->addJs('backend/assets/global/plugins/select2/js/select2.full.min.js');


        $this->assets
            ->collection('js-page-level-scripts')
            ->addJs('backend/assets/pages/scripts/dashboard.min.js')
            ->addJs('backend/assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js')
            ->addJs('backend/assets/global/plugins/bootstrap-markdown/lib/markdown.js')
            ->addJs('backend/assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js')
            ->addJs('backend/assets/global/plugins/bootstrap-summernote/summernote.min.js')
            ->addJs('backend/assets/global/plugins/dropzone/dropzone.min.js');

        $this->assets
            ->collection('js-theme-layout')
            ->addJs('backend/assets/layouts/layout/scripts/layout.min.js')
            ->addJs('backend/assets/layouts/layout/scripts/demo.min.js')
            ->addJs('backend/assets/layouts/global/scripts/quick-sidebar.min.js');

        $this->assets
            ->collection('js-page-level-plugins')
            ->addJs('backend/assets/global/plugins/morris/morris.min.js')
            ->addJs('backend/assets/global/plugins/morris/raphael-min.js')
            ->addJs('backend/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')
            ->addJs('backend/assets/global/plugins/jquery-notific8/jquery.notific8.min.js')
            ->addJs('backend/assets/pages/scripts/form-dropzone.js')
            ;

        // Load common Js and css validation form
        $this->assets
            ->collection('js-page-level-plugins')
            ->addJs('backend/assets/pages/scripts/form-validation.js')
            ->addJs('backend/assets/pages/scripts/common.js')
            ;
        $isLogin = $this->isAuthorized();
        if(in_array($ActionName, array("login","logout") )){
            if ($isLogin) { // Check Use not login
                 $this->response->redirect("cpanel/");
            }
        }else{
            if (!$isLogin) {
                 $this->response->redirect("cpanel/login");
            }
        }
    }
    // Common Innit for Login page
    public function initializeLoginPage(){
        $this->view->setVars(array(
            "ControllerName"    => $this->router->getControllerName(),
            "ActionName"        => $this->router->getActionName(),
            "base_url"          => $this->base_url()
        ));
        $this->assets
            ->collection('css-mandatory')
            ->addCss('//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all')
            ->addCss('backend/assets/global/plugins/font-awesome/css/font-awesome.min.css')
            ->addCss('backend/assets/global/plugins/simple-line-icons/simple-line-icons.min.css')
            ->addCss('backend/assets/global/plugins/bootstrap/css/bootstrap.min.css')
            ->addCss('backend/assets/global/plugins/uniform/css/uniform.default.css')
            ->addCss('backend/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css');

        $this->assets
            ->collection('css-theme-global')
            ->addCss('backend/assets/global/css/components.min.css')
            ->addCss('backend/assets/global/css/plugins.min.css');

        $this->assets
            ->collection('css-page-level')
            ->addCss('backend/assets/pages/css/login.min.css');

        $this->assets
            ->collection('js-ie9')
            ->addJs('backend/assets/global/plugins/respond.min.js')
            ->addJs('backend/assets/global/plugins/excanvas.min.js');

        $this->assets
            ->collection('js-core')
            ->addJs('backend/assets/global/plugins/jquery.min.js')
            ->addJs('backend/assets/global/plugins/bootstrap/js/bootstrap.min.js')
            ->addJs('backend/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')
            ->addJs('backend/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')
            ->addJs('backend/assets/global/plugins/jquery.blockui.min.js')
            ->addJs('backend/assets/global/plugins/uniform/jquery.uniform.min.js')
            ->addJs('backend/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')


            ->addJs('backend/assets/global/plugins/bootstrap-daterangepicker/moment.min.js')
            ->addJs('backend/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js')
            ->addJs('backend/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')
            ->addJs('backend/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js')
            ->addJs('backend/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')
            ;

        $this->assets
            ->collection('js-theme-global')
            ->addJs('backend/assets/global/scripts/app.min.js')
            ->addJs('backend/assets/global/plugins/jquery-validation/js/jquery.validate.min.js')
            ->addJs('backend/assets/global/plugins/jquery-validation/js/additional-methods.min.js')
            ->addJs('backend/assets/global/plugins/select2/js/select2.full.min.js')
            ;

        $this->assets
            ->collection('js-page-level-scripts')
            ->addJs('backend/assets/pages/scripts/dashboard.min.js');

        $this->assets
            ->collection('js-page-level-plugins')
            ->addJs('backend/assets/pages/scripts/login.min.js')
            ->addJs('backend/assets/pages/scripts/common.js');
    }

    // Common Innit for Login page
    public function initializeErrorPage(){

        $this->view->setVar("base_url",$this->base_url());
        // Check if the variable is defined
        $this->assets
            ->collection('css-mandatory')
            ->addCss('//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all')
            ->addCss('backend/assets/global/plugins/font-awesome/css/font-awesome.min.css')
            ->addCss('backend/assets/global/plugins/simple-line-icons/simple-line-icons.min.css')
            ->addCss('backend/assets/global/plugins/bootstrap/css/bootstrap.min.css')
            ->addCss('backend/assets/global/plugins/uniform/css/uniform.default.css')
            ->addCss('backend/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css');

        $this->assets
            ->collection('css-theme-global')
            ->addCss('backend/assets/global/css/components.min.css')
            ->addCss('backend/assets/global/css/plugins.min.css');

        $this->assets
            ->collection('css-page-level')
            ->addCss('backend/assets/pages/css/login.min.css');

        $this->assets
            ->collection('js-ie9')
            ->addJs('backend/assets/global/plugins/respond.min.js')
            ->addJs('backend/assets/global/plugins/excanvas.min.js');

        $this->assets
            ->collection('js-core')
            ->addJs('backend/assets/global/plugins/jquery.min.js')
            ->addJs('backend/assets/global/plugins/bootstrap/js/bootstrap.min.js')
            ->addJs('backend/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')
            ->addJs('backend/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')
            ->addJs('backend/assets/global/plugins/jquery.blockui.min.js')
            ->addJs('backend/assets/global/plugins/uniform/jquery.uniform.min.js')
            ->addJs('backend/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js');

        $this->assets
            ->collection('js-theme-global')
            ->addJs('backend/assets/global/scripts/app.min.js')
            ->addJs('backend/assets/global/plugins/jquery-validation/js/jquery.validate.min.js')
            ->addJs('backend/assets/global/plugins/jquery-validation/js/additional-methods.min.js')
            ->addJs('backend/assets/global/plugins/select2/js/select2.full.min.js')
            ;

        $this->assets
            ->collection('js-page-level-scripts')
            ->addJs('backend/assets/pages/scripts/dashboard.min.js');

        $this->assets
            ->collection('js-page-level-plugins')
            ->addJs('backend/assets/pages/scripts/login.min.js')
            ->addJs('backend/assets/pages/scripts/common.js');
    }

    // Function get base url
    public function base_url(){
        return sprintf(
            "%s://%s%s",
            isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
            $_SERVER['SERVER_NAME'],
            ""//$_SERVER['REQUEST_URI']
        );
    }

    /*
    PRIVATE FUNTION
    */

    private function isAuthorized() {
        return $this->session->has("auth");
    }
}
?>
