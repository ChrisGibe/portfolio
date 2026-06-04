<?php











namespace Composer;

use Composer\Autoload\ClassLoader;
use Composer\Semver\VersionParser;






class InstalledVersions
{
private static $installed = array (
  'root' => 
  array (
    'pretty_version' => 'dev-develop',
    'version' => 'dev-develop',
    'aliases' => 
    array (
    ),
    'reference' => '555a3a9c3dad8435d92ce20f86567b2f2193790e',
    'name' => 'roots/bedrock',
  ),
  'versions' => 
  array (
    'composer/installers' => 
    array (
      'pretty_version' => 'v2.2.0',
      'version' => '2.2.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'c29dc4b93137acb82734f672c37e029dfbd95b35',
    ),
    'graham-campbell/result-type' => 
    array (
      'pretty_version' => 'v1.1.1',
      'version' => '1.1.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '672eff8cf1d6fe1ef09ca0f89c4b287d6a3eb831',
    ),
    'johnpbloch/wordpress-core-installer' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'oscarotero/env' => 
    array (
      'pretty_version' => 'v2.1.0',
      'version' => '2.1.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '0da22cadc6924155fa9bbea2cdda2e84ab7cbdd3',
    ),
    'phpoption/phpoption' => 
    array (
      'pretty_version' => '1.9.1',
      'version' => '1.9.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'dd3a383e599f49777d8b628dadbb90cae435b87e',
    ),
    'roave/security-advisories' => 
    array (
      'pretty_version' => 'dev-latest',
      'version' => 'dev-latest',
      'aliases' => 
      array (
        0 => '9999999-dev',
      ),
      'reference' => 'e47f876d3b2df4a1354964c32820b4d7c10b8675',
    ),
    'roots/bedrock' => 
    array (
      'pretty_version' => 'dev-develop',
      'version' => 'dev-develop',
      'aliases' => 
      array (
      ),
      'reference' => '555a3a9c3dad8435d92ce20f86567b2f2193790e',
    ),
    'roots/bedrock-autoloader' => 
    array (
      'pretty_version' => '1.0.4',
      'version' => '1.0.4.0',
      'aliases' => 
      array (
      ),
      'reference' => 'f508348a3365ab5ce7e045f5fd4ee9f0a30dd70f',
    ),
    'roots/bedrock-disallow-indexing' => 
    array (
      'pretty_version' => '2.0.0',
      'version' => '2.0.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '6c28192e17cb9e02a5c0c99691a18552b85e1615',
    ),
    'roots/wordpress' => 
    array (
      'pretty_version' => '6.2.2',
      'version' => '6.2.2.0',
      'aliases' => 
      array (
      ),
      'reference' => '41ff6e23ccbc3a1691406d69fe8c211a225514e2',
    ),
    'roots/wordpress-core-installer' => 
    array (
      'pretty_version' => '1.100.0',
      'version' => '1.100.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '73f8488e5178c5d54234b919f823a9095e2b1847',
    ),
    'roots/wordpress-no-content' => 
    array (
      'pretty_version' => '6.2.2',
      'version' => '6.2.2.0',
      'aliases' => 
      array (
      ),
      'reference' => '6.2.2',
    ),
    'roots/wp-config' => 
    array (
      'pretty_version' => '1.0.0',
      'version' => '1.0.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '37c38230796119fb487fa03346ab0706ce6d4962',
    ),
    'roots/wp-password-bcrypt' => 
    array (
      'pretty_version' => '1.1.0',
      'version' => '1.1.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '15f0d8919fb3731f79a0cf2fb47e1baecb86cb26',
    ),
    'squizlabs/php_codesniffer' => 
    array (
      'pretty_version' => '3.7.2',
      'version' => '3.7.2.0',
      'aliases' => 
      array (
      ),
      'reference' => 'ed8e00df0a83aa96acf703f8c2979ff33341f879',
    ),
    'symfony/polyfill-ctype' => 
    array (
      'pretty_version' => 'v1.27.0',
      'version' => '1.27.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '5bbc823adecdae860bb64756d639ecfec17b050a',
    ),
    'symfony/polyfill-mbstring' => 
    array (
      'pretty_version' => 'v1.27.0',
      'version' => '1.27.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '8ad114f6b39e2c98a8b0e3bd907732c207c2b534',
    ),
    'symfony/polyfill-php80' => 
    array (
      'pretty_version' => 'v1.27.0',
      'version' => '1.27.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '7a6ff3f1959bb01aefccb463a0f2cd3d3d2fd936',
    ),
    'vlucas/phpdotenv' => 
    array (
      'pretty_version' => 'v5.5.0',
      'version' => '5.5.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '1a7ea2afc49c3ee6d87061f5a233e3a035d0eae7',
    ),
    'wordpress/core-implementation' => 
    array (
      'provided' => 
      array (
        0 => '6.2.2',
      ),
    ),
    'wpackagist-plugin/custom-post-type-ui' => 
    array (
      'pretty_version' => '1.13.6',
      'version' => '1.13.6.0',
      'aliases' => 
      array (
      ),
      'reference' => 'tags/1.13.6',
    ),
    'wpackagist-plugin/disable-comments' => 
    array (
      'pretty_version' => '2.4.4',
      'version' => '2.4.4.0',
      'aliases' => 
      array (
      ),
      'reference' => 'tags/2.4.4',
    ),
    'wpackagist-plugin/duplicate-post' => 
    array (
      'pretty_version' => '4.5',
      'version' => '4.5.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'tags/4.5',
    ),
    'wpackagist-plugin/post-type-switcher' => 
    array (
      'pretty_version' => '3.2.1',
      'version' => '3.2.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'trunk',
    ),
    'wpackagist-plugin/redirection' => 
    array (
      'pretty_version' => '5.3.10',
      'version' => '5.3.10.0',
      'aliases' => 
      array (
      ),
      'reference' => 'tags/5.3.10',
    ),
    'wpackagist-plugin/safe-svg' => 
    array (
      'pretty_version' => '2.1.1',
      'version' => '2.1.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'tags/2.1.1',
    ),
    'wpackagist-plugin/simple-custom-post-order' => 
    array (
      'pretty_version' => '2.5.6',
      'version' => '2.5.6.0',
      'aliases' => 
      array (
      ),
      'reference' => 'tags/2.5.6',
    ),
    'wpackagist-plugin/wordpress-seo' => 
    array (
      'pretty_version' => '20.9',
      'version' => '20.9.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'tags/20.9',
    ),
    'wpackagist-plugin/wp-change-email-sender' => 
    array (
      'pretty_version' => '1.0',
      'version' => '1.0.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'trunk',
    ),
    'wpackagist-plugin/wp-crontrol' => 
    array (
      'pretty_version' => '1.15.2',
      'version' => '1.15.2.0',
      'aliases' => 
      array (
      ),
      'reference' => 'tags/1.15.2',
    ),
  ),
);
private static $canGetVendors;
private static $installedByVendor = array();







public static function getInstalledPackages()
{
$packages = array();
foreach (self::getInstalled() as $installed) {
$packages[] = array_keys($installed['versions']);
}


if (1 === \count($packages)) {
return $packages[0];
}

return array_keys(array_flip(\call_user_func_array('array_merge', $packages)));
}









public static function isInstalled($packageName)
{
foreach (self::getInstalled() as $installed) {
if (isset($installed['versions'][$packageName])) {
return true;
}
}

return false;
}














public static function satisfies(VersionParser $parser, $packageName, $constraint)
{
$constraint = $parser->parseConstraints($constraint);
$provided = $parser->parseConstraints(self::getVersionRanges($packageName));

return $provided->matches($constraint);
}










public static function getVersionRanges($packageName)
{
foreach (self::getInstalled() as $installed) {
if (!isset($installed['versions'][$packageName])) {
continue;
}

$ranges = array();
if (isset($installed['versions'][$packageName]['pretty_version'])) {
$ranges[] = $installed['versions'][$packageName]['pretty_version'];
}
if (array_key_exists('aliases', $installed['versions'][$packageName])) {
$ranges = array_merge($ranges, $installed['versions'][$packageName]['aliases']);
}
if (array_key_exists('replaced', $installed['versions'][$packageName])) {
$ranges = array_merge($ranges, $installed['versions'][$packageName]['replaced']);
}
if (array_key_exists('provided', $installed['versions'][$packageName])) {
$ranges = array_merge($ranges, $installed['versions'][$packageName]['provided']);
}

return implode(' || ', $ranges);
}

throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}





public static function getVersion($packageName)
{
foreach (self::getInstalled() as $installed) {
if (!isset($installed['versions'][$packageName])) {
continue;
}

if (!isset($installed['versions'][$packageName]['version'])) {
return null;
}

return $installed['versions'][$packageName]['version'];
}

throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}





public static function getPrettyVersion($packageName)
{
foreach (self::getInstalled() as $installed) {
if (!isset($installed['versions'][$packageName])) {
continue;
}

if (!isset($installed['versions'][$packageName]['pretty_version'])) {
return null;
}

return $installed['versions'][$packageName]['pretty_version'];
}

throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}





public static function getReference($packageName)
{
foreach (self::getInstalled() as $installed) {
if (!isset($installed['versions'][$packageName])) {
continue;
}

if (!isset($installed['versions'][$packageName]['reference'])) {
return null;
}

return $installed['versions'][$packageName]['reference'];
}

throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}





public static function getRootPackage()
{
$installed = self::getInstalled();

return $installed[0]['root'];
}







public static function getRawData()
{
return self::$installed;
}



















public static function reload($data)
{
self::$installed = $data;
self::$installedByVendor = array();
}




private static function getInstalled()
{
if (null === self::$canGetVendors) {
self::$canGetVendors = method_exists('Composer\Autoload\ClassLoader', 'getRegisteredLoaders');
}

$installed = array();

if (self::$canGetVendors) {

 foreach (ClassLoader::getRegisteredLoaders() as $vendorDir => $loader) {
if (isset(self::$installedByVendor[$vendorDir])) {
$installed[] = self::$installedByVendor[$vendorDir];
} elseif (is_file($vendorDir.'/composer/installed.php')) {
$installed[] = self::$installedByVendor[$vendorDir] = require $vendorDir.'/composer/installed.php';
}
}
}

$installed[] = self::$installed;

return $installed;
}
}
