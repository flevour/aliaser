<?php

/**
 * Dependency injection container singleton.
 *
 * This singleton should be used in pair with sfDependencyInjectionContainerPlugin in order to make
 * the service container globally accessible.
 *
 * The singleton should be instantiated as soon as possible (typically from ProjectConfiguration) 
 * with the serviceContainer instance created by the plugin.
 *
 * Inside ProjectConfiguration you should hok into service_container.post_initialize event to configure this singleton.:
 *
 * public function setup()
 * {
 *  ...
 *  $this->dispatcher->connect('service_container.post_initialize', array($this, 'listenToServiceContainerConfiguration'));
 * }
 *
 *
 * public function listenToServiceContainerConfiguration(sfEvent $event)
 * {
 *   DI::setInstance($event->getSubject());
 * }
 *
 * @author      Francesco Levorato
 */
class DI
{
  static protected $serviceContainer;

  /**
   * Returns the active instance of the service container.
   *
   * Makes sure that all environments get a container, defaulting to test environment.
   *
   * @return sfServiceContainerBuilder
   */
  static public function getServiceContainer()
  {
    return self::$serviceContainer;
  }

  /**
   * Returns the service given an identifier
   *
   * @param string $service service identifier
   * @return Object         service instance
   */
  static public function getService($service)
  {
    return self::getServiceContainer()->getService($service);
  }

  /**
   * Shortcut for getService()
   * @see self::getService()
   */
  static public function get($service)
  {
    return self::getService($service);
  }

  /**
   * Setter for $serviceContainer property.
   */
  static public function setInstance($serviceContainer)
  {
    self::$serviceContainer = $serviceContainer;
  }
}
