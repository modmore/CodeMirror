<?php
/**
 * Resolver to set use_editor to on
 *
 * @package codemirror
 * @subpackage build
 */
$success= true;
if ($pluginid= $object->get('id')) {
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:
            $object->xpdo->log(xPDO::LOG_LEVEL_INFO,'Attempting to set which_element_editor setting to CodeMirror.');
            $setting = $object->xpdo->getObject('modSystemSetting',array('key' => 'which_element_editor'));
            if ($setting) {
                $setting->set('value','CodeMirror');
                $setting->save();
                unset($setting);
            }
            
            $object->xpdo->log(xPDO::LOG_LEVEL_INFO,'Attempting to set use_editor setting to on.');
            $setting = $object->xpdo->getObject('modSystemSetting',array('key' => 'use_editor'));
            if ($setting) {
                $setting->set('value',1);
                $setting->save();
                unset($setting);
            }
            break;
        case xPDOTransport::ACTION_UNINSTALL:
            $success= true;
            break;
    }
}

return $success;