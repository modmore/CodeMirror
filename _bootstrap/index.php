<?php
/* Get the core config */
if (!file_exists(dirname(dirname(__FILE__)).'/config.core.php')) {
    die('ERROR: missing '.dirname(dirname(__FILE__)).'/config.core.php file defining the MODX core path.');
}

require_once dirname(dirname(__FILE__)) . '/config.core.php';
require_once MODX_CORE_PATH . 'model/modx/modx.class.php';
$modx= new modX();
$modx->initialize('mgr');
$modx->getService('error','error.modError', '', '');
$modx->setLogTarget('HTML');

$settings = include dirname(dirname(__FILE__)) . '/_build/data/transport.settings.php';
$update = true;

foreach ($settings as $key => $setting) {
    /** @var modSystemSetting $setting */
    $exists = $modx->getObject('modSystemSetting', array('key' => 'codemirror.'.$key));
    if (!($exists instanceof modSystemSetting)) {
        $setting->save();
    }
    elseif ($update && ($exists instanceof modSystemSetting)) {
        $exists->fromArray($setting->toArray(), '', true);
        $exists->save();
    }
}


$componentPath = dirname(dirname(__FILE__));
$codemirror = $modx->getService('codemirror','codemirror', $componentPath.'/core/components/codemirror/model/codemirror/', array(
    'codemirror.core_path' => $componentPath.'/core/components/codemirror/',
));


/* Namespace */
if (!createObject('modNamespace',array(
    'name' => 'codemirror',
    'path' => $componentPath.'/core/components/codemirror/',
    'assets_path' => $componentPath.'/assets/components/codemirror/',
),'name', false)) {
    echo "Error creating namespace codemirror.\n";
}

/* Path settings */
if (!createObject('modSystemSetting', array(
    'key' => 'codemirror.core_path',
    'value' => $componentPath.'/core/components/codemirror/',
    'xtype' => 'textfield',
    'namespace' => 'codemirror',
    'area' => 'Paths',
    'editedon' => time(),
), 'key', false)) {
    echo "Error creating codemirror.core_path setting.\n";
}

if (!createObject('modSystemSetting', array(
    'key' => 'codemirror.assets_path',
    'value' => $componentPath.'/assets/components/codemirror/',
    'xtype' => 'textfield',
    'namespace' => 'codemirror',
    'area' => 'Paths',
    'editedon' => time(),
), 'key', false)) {
    echo "Error creating codemirror.assets_path setting.\n";
}

/* Fetch assets url */
$url = 'http';
if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on')) {
    $url .= 's';
}
$url .= '://'.$_SERVER["SERVER_NAME"];
if ($_SERVER['SERVER_PORT'] != '80') {
    $url .= ':'.$_SERVER['SERVER_PORT'];
}
$requestUri = $_SERVER['REQUEST_URI'];
$bootstrapPos = strpos($requestUri, '_bootstrap/');
$requestUri = rtrim(substr($requestUri, 0, $bootstrapPos), '/').'/';
$assetsUrl = "{$url}{$requestUri}assets/components/codemirror/";

if (!createObject('modSystemSetting', array(
    'key' => 'codemirror.assets_url',
    'value' => $assetsUrl,
    'xtype' => 'textfield',
    'namespace' => 'codemirror',
    'area' => 'Paths',
    'editedon' => time(),
), 'key', false)) {
    echo "Error creating codemirror.assets_url setting.\n";
}

/**
 * Plugin
 */

if (!createObject('modPlugin', array(
    'name' => 'codemirror',
    'static' => true,
    'static_file' => $componentPath.'/_build/elements/plugins/codemirror.plugin.php',
), 'name', true)) {
    echo "Error creating codemirror Plugin.\n";
}

$modx->getCacheManager()->refresh();

/**
 * Creates an object.
 *
 * @param string $className
 * @param array $data
 * @param string $primaryField
 * @param bool $update
 * @return bool
 */
function createObject ($className = '', array $data = array(), $primaryField = '', $update = true) {
    global $modx;
    /* @var xPDOObject $object */
    $object = null;

    /* Attempt to get the existing object */
    if (!empty($primaryField)) {
        $object = $modx->getObject($className, array($primaryField => $data[$primaryField]));
        if ($object instanceof $className) {
            if ($update) {
                $object->fromArray($data);
                return $object->save();
            } else {
                echo "Skipping {$className} {$data[$primaryField]}: already exists.\n";
                return true;
            }
        }
    }

    /* Create new object if it doesn't exist */
    if (!$object) {
        $object = $modx->newObject($className);
        $object->fromArray($data, '', true);
        return $object->save();
    }

    return false;
}
