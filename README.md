# JalaliDateTimeBundle
 A bundle to using jlali date time in Symfony applications 

## Install

Via Composer

``` bash
composer require borsaco/jalali-date-time-bundle
```

Edit your app/AppKernel.php to register the bundle in the registerBundles() method as above:


```php
class AppKernel extends Kernel
{

    public function registerBundles()
    {
        $bundles = array(
            // ...
            // register the bundle here
            new Borsaco\JalaliDateTimeBundle\JalaliDateTimeBundle()
        );
    }
}
```

## Usage


Wherever you have access to the service container :
```php
<?php
    // get the jlali date as a service
    $jlaliDateTime = $this->container->get('jalali_date_time');

    $jlaliDateTime->date('l j F Y H:i');
    $jlaliDateTime->date('Y-m-d', false, false);
    $jlaliDateTime->date('Y-m-d', false, false, false);
    $jlaliDateTime->date("l j F Y H:i T", false, null, null, 'America/New_York');
    
    // convert to jalali
    $unixDatetime = date("U");
    $jlaliDateTime->date('l j F Y H:i', $unixDatetime);

?>
```

For use the form type add ```JalaliDateType``` form type and create your view with this library:
https://github.com/beygi/bootstrap-persian-datetimepicker
