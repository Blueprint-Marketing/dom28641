<?php

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

define('TCMP_LICENSE_SERVER', 'https://intellywp.com/');
define('TCMP_EDD_NAME', 'Tracking Code Manager PRO');
//if(!class_exists('TCMP_EDD_SL_Plugin_Updater')) {
//    include(dirname(__FILE__) . '/TCMP_EDD_SL_Plugin_Updater.php');
//}

class TCMP_License {

    public function __construct() {
    }
    public function init() {
        //add_filter( 'cron_schedules', array( $this, 'add_schedules'   ) );
        //add_action( 'wp',             array( $this, 'schedule_Events' ) );
        add_action('admin_init', array($this, 'pluginUpdater'));
        add_action('tcmp_daily_scheduled_events', array($this, 'checkLicense'));
    }

    function pluginUpdater() {
        global $tcmp;
        $args=array(
            'version' =>TCMP_PLUGIN_VERSION
            , 'license'=>$tcmp->Options->getLicenseKey()
            , 'item_name' =>TCMP_EDD_NAME
            , 'author' 	=>TCMP_PLUGIN_AUTHOR
        );
        $tcmpUpdater=new TCMP_EDD_SL_Plugin_Updater(TCMP_LICENSE_SERVER, TCMP_PLUGIN_FILE, $args);
    }

    //activate the new license key
    function activate($key) {
        global $tcmp;

        $old=$tcmp->Options->getLicenseKey();
        if($old!==FALSE && $old!='') {
            $this->deactivate();
        }

        $options=array(
            'edd_action'=>'activate_license'
            , 'license'=>$key
            , 'item_name'=>urlencode(TCMP_EDD_NAME)
            , 'url'=>home_url()
        );
        $result=FALSE;
        $data=$tcmp->Utils->remoteGet(TCMP_LICENSE_SERVER, $options);
        $tcmp->Options->setLicense(FALSE);
        if($data!==FALSE && isset($data->license)) {
            $result=strtolower($data->license)=='valid';
            $tcmp->Options->setLicense($data);
            $v=$tcmp->Utils->iget($data, 'license_limit', 0);
            $tcmp->Options->setLicenseSiteCount($v);
            $tcmp->Options->setLicenseSuccess($result);
            if($result) {
                $tcmp->Options->setLicenseKey($key);
            }
        }
        return $result;
    }

    //deactivate the installed license
    function deactivate() {
        global $tcmp;

        // data to send in our API request
        $options=array(
            'edd_action'=>'deactivate_license'
            , 'license'=>$tcmp->Options->getLicenseKey()
            , 'item_name' =>urlencode(TCMP_EDD_NAME) // the name of our product in EDD
            , 'url' =>home_url()
        );
        $result=FALSE;
        $data=$tcmp->Utils->remoteGet(TCMP_LICENSE_SERVER, $options);
        $tcmp->Options->setLicense(FALSE);
        if($data!==FALSE && isset($data->license)) {
            $tcmp->Options->setLicense($data);
            $tcmp->Options->setLicenseSiteCount(FALSE);
            $tcmp->Options->setLicenseKey('');
            $tcmp->Options->setLicenseSuccess(FALSE);
            $result=TRUE;
        }
        return $result;
    }

    //retrieve if the current license used is stil valid or not
    public function hasPremium($override=FALSE) {
        global $tcmp;

        $result=FALSE;
        if($tcmp->Options->getLicenseKey()=='') {
            $result=FALSE;
        } else {
            $check=$tcmp->Options->getLicenseLastCheck();
            if(!$override && $check>strtotime('-1 day')) {
                $result=$tcmp->Options->isLicenseSuccess();
            } else {
                $result=$this->check();
            }
        }
        return $result;
    }
    public function check() {
        global $tcmp;

        $result=FALSE;
        if($tcmp->Options->getLicenseKey()=='') {
            $result=FALSE;
        } else {
            $options=array(
                'edd_action' =>'check_license'
                , 'license' =>$tcmp->Options->getLicenseKey()
                , 'item_name' =>urlencode(TCMP_EDD_NAME)
                , 'url' =>home_url()
            );
            $tcmp->Options->setLicense(FALSE);
            $data=$tcmp->Utils->remoteGet(TCMP_LICENSE_SERVER, $options);
            if($data!==FALSE && isset($data->license)) {
                $tcmp->Options->setLicense($data);
                if($data->license == 'valid') {
                    $tcmp->Options->setLicenseSuccess(TRUE);
                    $result=TRUE;
                } else {
                    $tcmp->Options->setLicenseSuccess(FALSE);
                }
                $tcmp->Options->setLicenseLastCheck(time());
            }
        }
        return $result;
    }
}