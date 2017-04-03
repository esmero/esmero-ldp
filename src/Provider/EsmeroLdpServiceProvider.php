<?php

namespace Esmero\EsmeroLdp\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Esmero\EsmeroLdp\Controller\LdpRestController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\Console\Application as Console;
use Symfony\Component\Console\Helper as Helper;
use Symfony\Component\Console\Output\ConsoleOutput;


class EsmeroLdpServiceProvider implements ServiceProviderInterface
{

    /**
     * @var string
     */
    private $servicename;

    /**
     * The console application.
     *
     * @var Console
     */
    protected $console;

    /**
     * EsmeroLdpServiceProvider constructor.
     * @param string $servicename
     */
    public function __construct($servicename = 'ldp')
    {
        $this->servicename = $servicename;
    }

    /**
     * {@inheritdoc}
     */
    public function register(Container $app)
    {
        // Flexibility Rules
        $servicename = $this->servicename;
        // LDP implements a few basic contained Services

        $app[$servicename] = $app->protect(function ($name) use ($app) {
         return new LdpContainerAccess(
              $app
            );
        });
        $app['ldp.restcontroller'] =  function ($app) {
            return new LdpRestController(
              $app
            );
        };

    }


    /**
     * {@inheritdoc}
     */
    public function subscribe(
      Container $app,
      EventDispatcherInterface $dispatcher
    ) {
        $dispatcher->addListener(
          KernelEvents::REQUEST,
          function (FilterResponseEvent $event) use ($app) {
              // This will help with our Event Bus and all the fanciness involved.
          }
        );
    }

    /**
     * {@inheritdoc}
     */
    public function boot(Container $app)
    {

        $console = $this->getConsole($app);
       // if ($console) {
       //     $servicename = $this->servicename;
       //     $console->setHelperSet($app[$servicename . ".console.helperset"]);
       //     $console->addCommands($app[$servicename . ".console.commands"]);
       // }
    }

    /**
     * Gets the console application.
     *
     * @param Container $app
     * @return Console|null
     */
    private function getConsole(Container $app = null)
    {
        return $this->console ?: (isset($app['console']) ? $app['console'] : new Console(
        ));
    }


}
